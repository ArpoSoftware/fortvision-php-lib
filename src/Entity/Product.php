<?php

namespace Fortvision\Entity;

/**
 * @property string $customerProductId
 * @property string $name
 * @property string|null $description
 * @property string|null $category
 * @property string|null $shelf
 * @property string|null $brand
 * @property float $discountedValue
 * @property string|null $currency
 * @property string|null $discountName
 * @property float $discountValue
 * @property string|null $imageUrl
 * @property string|null $productUrl
 * @property Category[]|null $categories
 * @property array|null $attributes
 * @property array|null $tags
 * @property int|null $stock
 * @method $this setCustomerProductId($customerProductId)
 * @method $this setName($name)
 * @method $this setDescription($description)
 * @method $this setCategory($category)
 * @method $this setShelf($shelf)
 * @method $this setBrand($brand)
 * @method $this setDiscountedValue($discountedValue)
 * @method $this setCurrency($currency)
 * @method $this setDiscountName($discountName)
 * @method $this setDiscountValue($discountValue)
 * @method $this setImageUrl($imageUrl)
 * @method $this setProductUrl($productUrl)
 * @method $this setCategories(array $categories)
 * @method $this setAttributes($attributes)
 * @method $this setTags($tags)
 * @method $this setStock($stock)
 */
class Product extends AbstractEntity
{
}
