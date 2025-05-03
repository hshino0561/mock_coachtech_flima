<?php

namespace App\Providers;

use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\CreateNewUserWithRequest;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\VerifyEmailViewResponse as VerifyEmailViewResponseContract;
use Laravel\Fortify\Contracts\VerifyEmailResponse as VerifyEmailResponseContract;

use App\Http\Responses\RegisterResponse;
use App\Http\Responses\VerifyEmailViewResponse;
// use App\Http\Responses\LoginResponse;
// use App\Http\Responses\VerifiedEmailResponse as VerifiedEmailResponseContract;
use App\Http\Responses\VerifiedEmailResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 会員登録後のリダイレクト制御（認証画面へ）
        $this->app->singleton(VerifyEmailViewResponseContract::class, VerifyEmailViewResponse::class);
        $this->app->singleton(RegisterResponseContract::class, RegisterResponse::class);
        $this->app->singleton(VerifyEmailResponseContract::class, VerifiedEmailResponse::class);
        // カスタム LoginResponse をバインド：無名クラスではなく、クラス名でバインド
        $this->app->singleton(LoginResponseContract::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 会員登録画面のBlade
        Fortify::registerView(function () {
            return view('auth.pg03_member_register');
        });

        // ログイン画面のBlade
        Fortify::loginView(function () {
            return view('auth.pg04_login');
        });

        Fortify::createUsersUsing(CreateNewUserWithRequest::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ログイン試行制限（6回/分）
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(
                Str::lower($request->input(Fortify::username())) . '|' . $request->ip()
            );

            return Limit::perMinute(6)->by($throttleKey);
        });
    }
}
