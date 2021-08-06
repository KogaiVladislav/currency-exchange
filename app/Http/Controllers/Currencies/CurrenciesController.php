<?php

namespace App\Http\Controllers\Currencies;


use App\Http\Controllers\BaseController;
use App\Http\Requests\CurrencyExchangeRequest;
use App\Repositories\CurrencyExchageRepository;
use App\Services\CurrenciesServices;
use App\Util\Currencies;

/**
 * @group Currencies Exchange
 *
 * API endpoints for exchange managing
 */
class CurrenciesController extends BaseController
{
    /**
     * Class for fetching currencies data.
     *
     * @var string
     */
    protected $currencies;

    /**
     * Currency Exchange Repository to work with model.
     *
     * @var string
     */
    protected $currencyExchageRepository;

    /**
     * Currency Service to make operations with currency.
     *
     * @var string
     */
    protected $currenciesServices;

    /**
     *
     * PlaidController constructor.
     * @param Currencies $currencies
     * @param CurrencyExchageRepository $currencyExchageRepository
     * @param CurrenciesServices $currenciesServices
     */
    public function __construct(Currencies $currencies,
                                CurrencyExchageRepository $currencyExchageRepository,
                                CurrenciesServices $currenciesServices)
    {
        $this->currencies = $currencies;
        $this->currencyExchageRepository = $currencyExchageRepository;
        $this->currenciesServices = $currenciesServices;
    }

    /**
     * @queryParam exist_currency string required Currency to be converted. Example: USD
     * @queryParam required_currency string required Converted currency. Example: EUR
     * @queryParam amount float required Currency amount. Example: 10.25
     *
     * @response {
     *  "status": "success",
     *  "data": "4.478712",
     * }
     */
    public function exchange(CurrencyExchangeRequest $request){
        $data = $request->validated();

        $currency = $this->currencyExchageRepository->last();

        if(!is_null($currency) && $currency->base_currency == $data['exist_currency']){

            $requiredCurrencies = json_decode($currency->exchange_rates, true);

            if(!isset($requiredCurrencies[$data['required_currency']])){

                return $this->error(
                    'The specified required_currency not found!'
                );
            }

            return $this->success(
                $this->currenciesServices->count($requiredCurrencies[$data['required_currency']], $data['amount'])
            );

        }

        $fetchedCurrencies = $this->currencies->fetch($data['exist_currency']);

        if($fetchedCurrencies == strval(403)){

            //hardcoded error because key permission are limited
            return $this->error(
                'Changing the API `base` currency is available for Developer, Enterprise and Unlimited plan clients. Please upgrade, or contact support@openexchangerates.org with any questions.'
            );
        }

        $this->currenciesServices->currenciesSave($fetchedCurrencies);

        $currenciesArray = get_object_vars($fetchedCurrencies->rates);

        return $this->success(
            $this->currenciesServices->count($currenciesArray[$data['required_currency']], $data['amount'])
        );
    }
}
