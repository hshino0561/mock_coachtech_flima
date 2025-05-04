# アプリケーション名
フリマアプリ

## 環境構築
Dockerビルド
1. git clone git@github.com:hshino0561/mock_coachtech_flima.git</br>
    ※クローン先ディレクトリは適宜用意お願いします。
2. docker-compose up -d --build

## Laravel環境構築
1. docker-compose exec php bash
2. composer install
3. .env.exampleファイルから.envを作成し、環境変数を変更</br>
    cp src/.env.example src/.env</br>
    ※環境により適宜変更してください。</br>
    ※参考変更例</br>
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass

    MAIL_FROM_ADDRESS=no-reply@example.com
    MAIL_FROM_NAME="COACHTECH"
4. php artisan key:generate
5. docker-compose up -d --build</br>
    ※または下記を実行してください。</br>
    docker-compose down
    docker-compose up -d
6. php artisan migrate
7. php artisan db:seed
8. php artisan storage:link

## テスト：Feature
※誤解があり、単体ではなく機能テストで確認しました。</br>

0. 一括実行(シェル)　※コンテナ内で実行</br>
    sh tests/Feature/FeatureTest.sh</br>
    ※一括実行でうまくいかない場合は、下記単体版を実行してください。</br>
    また、エラー時は、必要により適宜データのリセット後に再実行をお願いします。
1. 会員登録機能</br>
    php artisan test --filter=RegisterTest
2. ログイン、ログアウト機能</br>
    php artisan test --filter=LoginLogoutTest
3. 商品一覧取得</br>
    php artisan test --filter=ItemListTest
4. マイリスト一覧取得</br>
    php artisan test --filter=MyListTest
5. 商品検索機能</br>
    php artisan test --filter=SearchTest
6. 商品詳細情報取得</br>
    php artisan test --filter=ItemDetailTest
7. いいね機能</br>
    php artisan test --filter=LikeFeatureTest
8. コメント送信機能</br>
    php artisan test --filter=CommentFeatureTest
9. 商品購入機能</br>
    php artisan test --filter=PurchaseFeatureTest
10. 支払い方法選択機能</br>
    php artisan test --filter=PaymentSelectionTest 
11. 配送先変更機能</br>
    php artisan test --filter=DeliveryAddressTest
12. ユーザー情報取得</br>
    php artisan test --filter=MypageTest
13. ユーザー情報変更</br>
    php artisan test --filter=ProfileEditTest
14. 出品商品情報登録</br>
    php artisan test --filter=ProductExhibitionTest

## 使用技術(実行環境)
・PHP 8.1.1</br>
・Laravel 10.48.28</br>
・fortify</br>
・formrequest</br>
・mailhog　：US002：FN012：メールを用いた認証機能</br>
・MySQL 8.0.26</br>
・Nginx 1.21.1</br>
・Bootstrap</br>
・PHPFeature</br>

## ER図
・ER.drawio.svg

## URL
・開発環境：http://localhost/</br>
・phpMyAdmin：http://localhost:8080

## 要件修正内容
※一部アナウンスなしの要件変更にて調整不足の内容の可能性あり。また、休業期間にて確認できなかったものを含む</br>
※一部コーチへ確認のうえ変更。その他細かい点はスプレッドシート資料を参照ください。</br>

・テストケース一覧：6.商品検索機能：2. 検索ボタンを押す</br>
&nbsp;&nbsp;⇒デザインその他要件で検索ボタンの存在を確認できなかったため、「キーワード入力後Enterを押す」で対応</br>
・基本設計書（生徒様入力用）：PurchaseRequest.php：配送先：選択必須</br>
&nbsp;&nbsp;⇒自身の誤更新でなければ機能要件、テストケースと合っていないため、機能要件に合わせた設定実施。</br>
・基本設計書（生徒様入力用）：バリデーションメッセージ</br>
&nbsp;&nbsp;⇒一部しか要件がなかったため、その他適宜設定。

## 未実装内容
・機能要件：US006：FN023：支払い方法選択機能</br>
&nbsp;&nbsp;3. 「コンビニ支払い」並びに「カード支払い」を選択して，「購入する」ボタンを押下した際にsripeの決済画面に接続される</br>
&nbsp;&nbsp;⇒納期およびスキルの兼ね合いから実装断念。

## 調整、確認不足内容、補足
・デザイン調整、レスポンシブ対応</br>
・コード整理</br>
・環境変数について、セキュリティ観点でよくありませんが、内部で連携する手段など確認不足のため、今回はREADME内に記載します。</br>
・要件に明記されていないシーダファイルを一部作成済みです。