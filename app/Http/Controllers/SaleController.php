<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Repositories\SaleRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

/**
 * Class SaleController
 * @package App\Http\Controllers
 *
 * @property SaleRepository $SaleRepository
 */
class SaleController extends Controller
{
    private $SaleRepository;

    /**
     * SaleController constructor.
     * @param SaleRepository $saleRepository
     */
    public function __construct(SaleRepository $saleRepository)
    {
        $this->SaleRepository = $saleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index(Request $request)
    {
        if(isset($request->per_page))
            $per_page = $request->per_page;
        else 
            $per_page = 20;
        
        return $this->SaleRepository->getModel()->with('products:name,delivery_days')->paginate($per_page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaleRequest $request
     * @return JsonResponse
     */
    public function store(SaleRequest $request)
    {
        $sale = new Sale;
        $sale->purchase_at = Carbon::parse($request->purchase_at);
        $sale->amount = $request->amount;
        $sale->delivery_days = $request->delivery_days;
        $sale->save();
        $sale->products()->sync($request->products);
        return Response()->json(['message'=>'Venda Concluida com sucesso!'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Sale|Sale[]|Builder|Builder[]|Collection|Model
     */
    public function show($id)
    {
        return $this->SaleRepository->getModel()->with('products:name,delivery_days')->find($id);
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
        $sale = $this->SaleRepository->getModel()->find($id);
        $sale->purchase_at = Carbon::parse($request->purchase_at);
        $sale->save();

        $sale->products()->sync($request->products);

        return Response()->json('Venda Alterada com sucesso!', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $sale = $this->SaleRepository->getModel()->find($id);
        $sale->products()->detach();
        $sale->delete();
        return Response()->json('Venda Excluida com sucesso!', 200);
    }
}
