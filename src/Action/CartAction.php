<?php

namespace Fortvision\Action;

use Fortvision\Client\HttpClient;
use Fortvision\Entity\Cart;
use Fortvision\Entity\Product;
use Fortvision\Entity\UserInfo;

class CartAction extends AbstractAction
{
    const ADD_TO_CART_ENDPOINT = '/cart-management/product/add';
    const UPDATE_CART_ENDPOINT = '/cart-management/cart/status';
    const REMOVE_FROM_CART_ENDPOINT = '/cart-management/product/remove';
    const CHECKOUT_ENDPOINT = '/cart-management/cart/checkout';
    const STATUS_CHECKOUT_ENDPOINT = '/cart-management/cart/checkout/status';

    /**
     * @var HttpClient
     */
    private $client;

    /**
     * @param string $mode
     * @throws \Fortvision\Exception\RuntimeException
     */
    public function __construct(string $mode = '')
    {
        $this->client = new HttpClient($mode);
    }

    /**
     * @param UserInfo $userInfo
     * @param Cart $cart
     * @param Product $product
     * @param $value
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Fortvision\Exception\RequestExeption
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addToCart(UserInfo $userInfo, Cart $cart, Product $product, $value)
    {
        $cart->setCmsStatus('add');
        $cartData['userInfo'] = $userInfo->getData();
        $cartData['cart'] = $cart->getData();
        $cartData['product'] = $product->getData();
        $cartData['volume'] = $value;
        $cartJson = \json_encode($cartData);

        $result = $this->client->doRequest(self::ADD_TO_CART_ENDPOINT, $cartJson, HttpClient::METHOD_PUT);
        return $result;
    }

    /**
     * @param UserInfo $userInfo
     * @param Cart $cart
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Fortvision\Exception\RequestExeption
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateCart(UserInfo $userInfo, Cart $cart)
    {
        $cart->setCmsStatus('update');
        $cartData['userInfo'] = $userInfo->getData();
        $cartData['cart'] = $cart->getData();
        $cartJson = \json_encode($cartData);

        $result = $this->client->doRequest(self::UPDATE_CART_ENDPOINT, $cartJson, HttpClient::METHOD_PUT);
        return $result;
    }

    /**
     * @param UserInfo $userInfo
     * @param Cart $cart
     * @param Product $product
     * @param $value
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Fortvision\Exception\RequestExeption
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeFromCart(UserInfo $userInfo, Cart $cart, Product $product, $value)
    {
        $cart->setCmsStatus('remove');
        $cartData['userInfo'] = $userInfo->getData();
        $cartData['cart'] = $cart->getData();
        $cartData['product'] = $product->getData();
        $cartData['volume'] = $value;
        $cartJson = \json_encode($cartData);

        $result = $this->client->doRequest(self::REMOVE_FROM_CART_ENDPOINT, $cartJson, HttpClient::METHOD_PUT);
        return $result;
    }

    /**
     * @param UserInfo $userInfo
     * @param Cart $cart
     * @param $checkoutId
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Fortvision\Exception\RequestExeption
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkout(UserInfo $userInfo, Cart $cart, $checkoutId)
    {
        $cart->setCmsStatus('processing');
        $cartData['userInfo'] = $userInfo->getData();
        $cartData['cart'] = $cart->getData();
        $cartData['customerCheckoutId'] = $checkoutId;
        $cartData['customerCheckoutStatus'] = 'processing';
        $cartJson = \json_encode($cartData);

        $result = $this->client->doRequest(self::CHECKOUT_ENDPOINT, $cartJson, HttpClient::METHOD_PUT);
        return $result;
    }

    /**
     * @param Cart $cart
     * @param $checkoutId
     * @param $status
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Fortvision\Exception\RequestExeption
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkoutSetStatus(Cart $cart, $checkoutId, $status)
    {
        $cart->setCmsStatus($status);
        $cartData['cart'] = $cart->getData();
        $cartData['customerCheckoutId'] = $checkoutId;
        $cartData['customerCheckoutStatus'] = $status;
        $cartJson = \json_encode($cartData);

        $result = $this->client->doRequest(self::STATUS_CHECKOUT_ENDPOINT, $cartJson, HttpClient::METHOD_PUT);
        return $result;
    }
}
