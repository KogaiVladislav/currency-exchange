<?php

namespace App\Services;

use App\Repositories\CurrencyExchageRepository;

class CurrenciesServices
{
    /**
     * Currency Exchange Repository to work with model.
     *
     * @var string
     */
    protected $currencyExchageRepository;

    /**
     *
     * CurrenciesServices constructor.
     * @param CurrencyExchageRepository $currencyExchageRepository
     */
    public function __construct(CurrencyExchageRepository $currencyExchageRepository)
    {
        $this->currencyExchageRepository = $currencyExchageRepository;
    }

    /**
     *
     * currenciesSave

     * @param $fetchedData fetched data from service
     * @return boolean
     */
    public function currenciesSave($fetchedData){
        $currencies = [
            'base_currency' => $fetchedData->base,
            'exchange_rates' => json_encode($fetchedData->rates)
        ];

        $this->currencyExchageRepository->persist($currencies);

        return true;
    }

    /**
     *
     * currenciesSave

     * @param $currency currency value
     * @param $amount currency amount
     * @return float
     */
    public function count($currency, $amount){
        return $currency * $amount;
    }

}