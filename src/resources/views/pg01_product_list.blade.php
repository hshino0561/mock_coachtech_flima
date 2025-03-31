<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品一覧</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/pg01_product_list.css') }}" />
</head>
<body>

    <header class="header">
        <div class="logo">COACHTECH</div>
        <div class="search-bar">
            <input type="text" placeholder="なにをお探しですか？">
        </div>
        <nav class="nav-links">
            <a href="/login">ログイン</a>
            <a href="#">マイページ</a>
            <a href="#" class="sell-btn">出品</a>
        </nav>
    </header>

    <div class="tabs">
        <a href="#" class="tab active">おすすめ</a>
        <a href="#" class="tab">マイリスト</a>
    </div>

    <main class="product-grid">
        <?php
            // 商品データのサンプル
            $products = [
                ['name' => '商品名', 'image' => 'placeholder.png'],
                ['name' => '商品名', 'image' => 'placeholder.png'],
                ['name' => '商品名', 'image' => 'placeholder.png'],
                ['name' => '商品名', 'image' => 'placeholder.png'],
                ['name' => '商品名', 'image' => 'placeholder.png'],
                ['name' => '商品名', 'image' => 'placeholder.png']
            ];

            // 商品ループ
            foreach ($products as $product) {
                echo "
                    <div class='product-card'>
                        <div class='product-image'>
                            <img src='{$product['image']}' alt='{$product['name']}'>
                        </div>
                        <div class='product-name'>{$product['name']}</div>
                    </div>
                ";
            }
        ?>
    </main>

</body>
</html>
