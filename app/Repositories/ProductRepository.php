<?php

namespace App\Repositories;

use App\Models\Product;

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

    public function index($query)
    {
        if(isset($query))
            return $this->getModel()->where('name','LIKE','%'.strtoupper($query).'%')
                ->orWhere('reference','LIKE','%'.$query.'%')->get();

        return $this->getModel()->findAll();
    }

    public function save($data)
    {
        $this->getModel()->create($data);
        return Response()->json('Produto cadastrado!', 201);
    }

    public function getProduct($id)
    {
        return $this->getModel()->find($id);
    }

    public function updateProduct($request, $id)
    {
        $product = $this->getModel()->find($id);
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->price = $request->price;
        $product->delivery_days = $request->delivery_days;
        $product->save();
        return Response()->json('Produto Atualizado!', 200);
    }

    public function deleteProduct($id)
    {
        $product = $this->getModel()->find($id);
        $product->delete();
        return Response()->json('Produto Excluido!', 200);
    }
}