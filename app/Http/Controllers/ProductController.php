<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class ProductController
 * @package App\Http\Controllers
 *
 * @property ProductRepository $ProductRepository
 */
class ProductController extends Controller
{
    private $ProductRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->ProductRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Product[]|Collection
     */
    public function index(Request $request)
    {
        if(isset($request->product_name))
            $query = strtoupper($request->product_name);
        return $this->ProductRepository->getModel()->where('name','LIKE','%'.$query.'%')
            ->orWhere('reference','LIKE','%'.$query.'%')->get();

        return $this->ProductRepository->getModel()->all();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->ProductRepository->getModel()->create($request->all());
        return Response()->json('Produto cadastrado!', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->ProductRepository->getModel()->find($id);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = $this->ProductRepository->getModel()->find($id);
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->price = $request->price;
        $product->delivery_days = $request->delivery_days;
        $product->save();
        return Response()->json('Produto Atualizado!', 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $product = $this->ProductRepository->getModel()->find($id);
        $product->delete();
        return Response()->json('Produto Excluido!', 200);

    }
}
