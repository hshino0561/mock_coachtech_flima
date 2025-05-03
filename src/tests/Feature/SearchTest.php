<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchTest extends TestCase
{
    // use RefreshDatabase;

    public function test_1_商品名で部分一致検索ができる()
    {
        $keyword = '時計'; // 既にDBに存在する商品名の一部

        $response = $this->get('/?page=recommend&keyword=' . urlencode($keyword));

        $response->assertStatus(200);
        $response->assertSee($keyword); // 「バッグ」を含む商品名が表示されること
    }

    public function test_2_検索状態がマイリストでも保持されている()
    {
        $keyword = 'HD'; // マイリストにも該当商品が存在している想定

        // 検索後にマイリストタブに切り替える
        $response = $this->get('/?page=mylist&keyword=' . urlencode($keyword));

        $response->assertStatus(200);
        $response->assertSee('マイリスト'); // タブ確認用
        $response->assertSee($keyword);     // キーワードに該当する商品が表示されること
    }
}
