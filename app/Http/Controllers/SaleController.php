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
        return $this->SaleRepository->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaleRequest $request
     * @return JsonResponse
     */
    public function store(SaleRequest $request)
    {
        return $this->SaleRepository->save($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Sale|Sale[]|Builder|Builder[]|Collection|Model
     */
    public function show($id)
    {
        return $this->SaleRepository->getSale($id);
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
        return $this->SaleRepository->updateSale($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        return $this->SaleRepository->deleteSale($id);
    }
}
