<?php

namespace App\Console\Commands;

use App\Repositories\CurrencyExchageRepository;
use App\Services\CurrenciesServices;
use App\Util\Currencies;
use Illuminate\Console\Command;

class FetchCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:fetch 
                            {exist_currency : Currency that need to exchange example USD}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching current exchange rates';

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
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Currencies $currencies,
                                CurrencyExchageRepository $currencyExchageRepository,
                                CurrenciesServices $currenciesServices)
    {
        parent::__construct();

        $this->currencies = $currencies;
        $this->currencyExchageRepository = $currencyExchageRepository;
        $this->currenciesServices = $currenciesServices;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = $this->currencies->fetch($this->argument('exist_currency'));

        $this->currenciesServices->currenciesSave($data);
    }
}
