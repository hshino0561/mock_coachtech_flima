<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Product;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // pageパラメータがなければ「recommend」にリダイレクト（キーワードは維持）
        if (!$request->has('page')) {
            return redirect()->route('top', [
                'page' => 'recommend',
                'keyword' => $request->input('keyword'),
            ]);
        }

        $keyword = $request->input('keyword');
        $products = collect();
        $mylist = collect();

        // おすすめタブ：他人の商品 + 検索キーワード
        if ($request->page === 'recommend') {
            $query = Product::query()
                ->where('user_id', '!=', Auth::id());

            $products = $query
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->latest()
                ->get();
        }

        // マイリストタブ：いいねした商品
        if ($request->page === 'mylist' && Auth::check()) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $mylist = $user->likedProducts()
                ->when($keyword, function ($query, $keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%');
                })
                ->orderBy('products.created_at', 'desc') // 明示的にテーブル指定
                ->get();
        }

        return view('pg01_product_list', [
            'products' => $products,
            'mylist' => $mylist,
        ]);
    }

    public function showdetail($item_id)
    {
        $product = Product::with('user.prof')->findOrFail($item_id);
        return view('pg05_product_detail', compact('product'));
    }

    public function toggleLike($id)
    {
        $product = Product::findOrFail($id);
        $user = auth()->user();

        $existing = $product->likes()->where('user_id', $user->id)->first();

        if ($existing) {
            $existing->delete(); // いいね取り消し
        } else {
            $product->likes()->create(['user_id' => $user->id]);
        }

        return back(); // Ajax対応なら JSON 返す
    }

    public function storeComment(CommentRequest $request)
    {
        Comment::create([ //\App\Models\
            'user_id' => auth()->id(),
            'product_id' => $request->input('product_id'),
            'comment' => $request->input('comment'),
        ]);

        return back()->with('scrollToCommentForm', true)->with('success', 'コメントを投稿しました');
    }
}
