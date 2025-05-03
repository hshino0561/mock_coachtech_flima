#!/bin/bash

# Laravel のテストを指定順で実行
echo "Start ordered Laravel tests..."

php artisan test --filter=RegisterTest
php artisan test --filter=LoginLogoutTest
php artisan test --filter=ItemListTest
php artisan test --filter=MyListTest
php artisan test --filter=SearchTest
php artisan test --filter=ItemDetailTest
php artisan test --filter=LikeFeatureTest
php artisan test --filter=CommentFeatureTest
php artisan test --filter=PurchaseFeatureTest
php artisan test --filter=PaymentSelectionTest
php artisan test --filter=DeliveryAddressTest
php artisan test --filter=MypageTest
php artisan test --filter=ProfileEditTest
php artisan test --filter=ProductExhibitionTest

echo "All tests completed."
