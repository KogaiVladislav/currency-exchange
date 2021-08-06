<?php


namespace App\Repositories;


use App\Models\Currency;

class CurrencyExchageRepository extends BaseRepository
{

    /**
     * CurrencyExchageRepository constructor.
     * @param Currency $model
     */
    public function __construct(Currency $model)
    {
        parent::__construct($model);
    }
}
