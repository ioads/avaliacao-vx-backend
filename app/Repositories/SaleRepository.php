<?php


namespace App\Repositories;

use App\Models\Sale;

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
}