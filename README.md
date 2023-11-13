## Example of working with cart
~~~
try {
    $category = \Fortvision\Entity\Category::create()
        ->setId(1)
        ->setName('Category 1')
        ->setUrl('');
    $product1 = \Fortvision\Entity\Product::create()
        ->setCustomerProductId(101)
        ->setName('Product 01')
        ->setDescription('Description 01')
        ->setDiscountValue(101)
        ->setDiscountName('Discount 01')
        ->setCategories([$category]);
    $product2 = \Fortvision\Entity\Product::create()
        ->setCustomerProductId(102)
        ->setName('Product 02')
        ->setDescription('Description 02')
        ->setDiscountValue(200)
        ->setDiscountName('Discount 02');
    $cart = \Fortvision\Entity\Cart::create()
        ->addProduct($product1)
        ->addProduct($product2);
    $user = \Fortvision\Entity\UserInfo::create()
        ->setUserId('111')
        ->setEmail('example_test@example.com');

    $cartAction = \Fortvision\Action\CartAction::create();

    // Add product to cart
    $result = $cartAction->addToCart($user, $cart, $product2, 3);

    // Update cart
    $result = $cartAction->updateCart($user, $cart);

    // Remove product from cart
    $result = $cartAction->removeFromCart($user, $cart, $product2, 1);

    // Checkout cart
    $result = $cartAction->checkout($user, $cart, 1);

    // Set cart status
    $result = $cartAction->checkoutSetStatus($cart, 1, 'close');
} catch (\Exception $e) {
    echo $e->getMessage();
}
~~~
## Example of working with user
~~~
try {
    $userInfo = \Fortvision\Entity\UserInfo::create()
        ->setUserId('101')
        ->setFirstName('Jon')
        ->setPhone('+1234567890')
        ->setEmail('example_user@example.com');

    $userAction = \Fortvision\Action\UserAction::create();

    // Register user
    $result = $userAction->register($userInfo);

    // Update user
    $userInfo->setFirstName('Sam');
    $result = $userAction->updateUser($userInfo);

    // Login user
    $result = $userAction->login($userInfo);

    // Subscribe to newletters
    $result = $userAction->subscription($userInfo, 1);
} catch (\Exception $e) {
    echo $e->getMessage();
}
~~~
## Example of exporting entities
~~~
try {
    $data[] = [
        'id' => 1,
        'name' => 'Product 1',
        'sku' => 'SKU_1',
        'price' => '10',
        'description' => 'Description 1',
        'imageUrl' => '',
        'productUrl' => 'https://example.com/product/1/',
        'categories' => [
            'id' => 1,
            'name' => 'Category 1',
            'description' => 'Description 1',
            'url' => 'https://example.com/catugory/1/'
        ]
    ];

    $data[] = [
        'id' => 2,
        'name' => 'Product 2',
        'sku' => 'SKU_2',
        'price' => '20',
        'description' => 'Description 2',
        'imageUrl' => '',
        'productUrl' => 'https://example.com/product/2/',
        'categories' => [
            'id' => 2,
            'name' => 'Category 2',
            'description' => 'Description 2',
            'url' => 'https://example.com/catugory/2/'
        ]
    ];

    $productExport = \Fortvision\Export\Product::create();
    $result = $productExport->export($data);
} catch (\Exception $e) {
    echo $e->getMessage();
}
~~~
### Variables for Laravel .env file
~~~
FORTVISION_URL_PRODUCTION=https://fb.fortvision.com/fb
FORTVISION_URL_TEST=https://3.249.178.183:1337
FORTVISION_URL_EXPORT_PRODUCTION=https://smc2t4kcbb.execute-api.eu-west-1.amazonaws.com/1/plugin/aggregate
FORTVISION_URL_EXPORT_TEST=https://hqn6787tyl.execute-api.eu-west-1.amazonaws.com/1/plugin/aggreate
FORTVISION_MODE=PROD
FORTVISION_PLUGIN=laravel
FORTVISION_PUBLISHER_ID=0
~~~
We can use FORTVISION_MODE - PROD or TEST.
### Core backend cart routes
https://fortvision.atlassian.net/wiki/spaces/FI/pages/1403125761/Core+backend+cart+routes
