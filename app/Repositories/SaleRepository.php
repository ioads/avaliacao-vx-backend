<?php


namespace App\Repositories;

use App\Models\Sale;
use Carbon\Carbon;

/**
 * Class SaleRepository
 * @package App\Repositories
 *
 * @property Sale $Sale
 */
class SaleRepository
{
    /**
     * @var Sale
     */
    protected $Sale;

    /**
     * SaleRepository constructor.
     *
     * @param Sale $sale
     */
    public function __construct(Sale $sale)
    {
        $this->Sale = $sale;
    }

    /**
     * @return Sale
     */
    public function getModel()
    {
        return $this->Sale;
    }

    public function index($request)
    {
        if(isset($request->per_page))
            $per_page = $request->per_page;
        else
            $per_page = 20;

        return $this->getModel()->with('products:name,delivery_days')->paginate($per_page);
    }

    public function save($request)
    {
        $sale = new Sale;
        $sale->purchase_at = Carbon::parse($request['purchase_at']);
        $sale->amount = $request['amount'];
        $sale->delivery_days = $request['delivery_days'];
        $sale->save();
        $sale->products()->sync($request['products']);
        return Response()->json(['message'=>'Venda Concluida com sucesso!'], 201);
    }

    public function getSale($id)
    {
        return $this->getModel()->with('products:name,delivery_days')->find($id);
    }

    public function updateSale($request, $id)
    {
        $sale = $this->getModel()->find($id);
        $sale->purchase_at = Carbon::parse($request->purchase_at);
        $sale->save();

        $sale->products()->sync($request->products);

        return Response()->json('Venda Alterada com sucesso!', 200);
    }

    public function deleteSale($id)
    {
        $sale = $this->getModel()->find($id);
        $sale->products()->detach();
        $sale->delete();
        return Response()->json('Venda Excluida com sucesso!', 200);
    }
}