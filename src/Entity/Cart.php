<?php

namespace Fortvision\Entity;

/**
 * @property Product[] $products
 * @property float $discountedValue
 * @property int $volume
 * @property string|null $couponId
 * @property float|null $discountValue
 * @property string $cmsStatus
 * @method $this setProducts($products)
 * @method $this setDiscountedValue($discountedValue)
 * @method $this setVolume($volume)
 * @method $this setCouponId($couponId)
 * @method $this setDiscountValue($discountValue)
 * @method $this setCmsStatus($cmsStatus)
 */
class Cart extends AbstractEntity
{
    /**
     * @param Product $product
     * @return $this
     */
    public function addProduct(Product $product)
    {
        $this->_data['products'][] = $product;
        return $this;
    }
}
