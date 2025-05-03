<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ExhibitionRequest;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Product;

class SellController extends Controller
{
    public function sell()
    {
        $categories = Category::all(); // 必要に応じて並び替えなど
        $conditions = Condition::all(); // ← これを追加！

        return view('pg08_product_sell', compact('categories', 'conditions'));
    }

    public function store(ExhibitionRequest $request)
    {
        $validated = $request->validated();

        $imagePath = null;
        if ($request->hasFile('product-image')) {
            // 元のファイル名を取得（例: sample.jpg）
            $originalName = $request->file('product-image')->getClientOriginalName();

            // ファイル名と拡張子を分離
            $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME); // ex: sample
            $extension = $request->file('product-image')->getClientOriginalExtension(); // ex: jpg

            // 「sample_20250501_142030.jpg」のように組み立て
            $filename = $nameWithoutExt . '_' . date('Ymd_His') . '.' . $extension;

            // 保存（public/storage/product_img）
            $request->file('product-image')->storeAs('product_img', $filename, 'public');

            // DB用にファイル名のみを保存
            $imagePath = $filename;
        }

        $product = new Product();
        $product->name         = $validated['product_name'];
        $product->user_id      = Auth::id();
        $product->brand        = $validated['brand'];
        $product->description  = $validated['product_description'];
        $product->price        = $validated['price'];
        $product->condition_id = $validated['condition_id'];
        $product->image_path   = $imagePath;
        $product->save();

        if (!empty($validated['category_ids'])) {
            $categoryIds = explode(',', $validated['category_ids']);
            $product->categories()->sync($categoryIds);
        }

        return redirect()->route('top')->with('success', '出品が完了しました！');
    }
}
