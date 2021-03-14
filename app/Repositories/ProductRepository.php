<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProductRepository
 * @package App\Http
 *
 * @property Product $Product
 */
class ProductRepository
{
    /**
     * @var Product
     */
    protected $Product;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->Product = $product;
    }

    /**
     * @return Product
     */
    public function getModel()
    {
        return $this->Product;
    }
}