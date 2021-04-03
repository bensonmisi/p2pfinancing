<?php

namespace App\Providers;

use App\Interfaces\accountCreationInterface;
use App\Interfaces\administrator\chargeInterface;
use App\Interfaces\administrator\depositInterface;
use App\Interfaces\administrator\evaluationInterface;
use App\Interfaces\administrator\loansInterface;
use App\Interfaces\administrator\reportsInterface;
use App\Interfaces\assignInterface;
use App\Interfaces\collateral_image_interface;
use App\Interfaces\collateralInterface;
use App\Interfaces\collateraltypeInterface;
use App\Interfaces\currencyInterface;
use App\Interfaces\financing_period_interface;
use App\Interfaces\installmentsInterface;
use App\Interfaces\loan_interface;
use App\Interfaces\modulesInterface;
use App\Interfaces\offersInterface;
use App\Interfaces\percentageInterface;
use App\Interfaces\profileInterface;
use App\Interfaces\repayment_period_interface;
use App\Interfaces\rolesInterface;
use App\Interfaces\statementInterface;
use App\Interfaces\subscriptionInterface;
use App\Interfaces\usersInterface;
use App\Interfaces\withdrawalInterface;
use App\Repository\accountCreationRepository;
use App\Repository\administrator\chargeRepository;
use App\Repository\administrator\depositRepository;
use App\Repository\administrator\evaluationRepository;
use App\Repository\administrator\loansRepository;
use App\Repository\administrator\reportsRepository;
use App\Repository\assignRepository;
use App\Repository\collateral_image_Repository;
use App\Repository\collateral_type_Repository;
use App\Repository\collateralRepository;
use App\Repository\currency_Repository;
use App\Repository\financing_period_Repository;
use App\Repository\installmentsRepository;
use App\Repository\loan_Repository;
use App\Repository\moduleRepository;
use App\Repository\offersRepository;
use App\Repository\percentageRepository;
use App\Repository\profileRepository;
use App\Repository\repayment_period_Repository;
use App\Repository\rolesRepository;
use App\Repository\statementRepository;
use App\Repository\subscriptionRepository;
use App\Repository\usersRepository;
use App\Repository\withdrawalRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->bind(accountCreationInterface::class,accountCreationRepository::class);
         $this->app->bind(profileInterface::class,profileRepository::class);
         $this->app->bind(loan_interface::class,loan_Repository::class);
         $this->app->bind(currencyInterface::class,currency_Repository::class);
         $this->app->bind(repayment_period_interface::class,repayment_period_Repository::class);
         $this->app->bind(financing_period_interface::class,financing_period_Repository::class);
         $this->app->bind(collateraltypeInterface::class,collateral_type_Repository::class);
         $this->app->bind(collateralInterface::class,collateralRepository::class);
         $this->app->bind(collateral_image_interface::class,collateral_image_Repository::class);
         $this->app->bind(percentageInterface::class,percentageRepository::class);
         $this->app->bind(rolesInterface::class,rolesRepository::class);
         $this->app->bind(modulesInterface::class,moduleRepository::class);
         $this->app->bind(assignInterface::class,assignRepository::class);
         $this->app->bind(usersInterface::class,usersRepository::class);
         $this->app->bind(loansInterface::class,loansRepository::class);
         $this->app->bind(loansInterface::class,loansRepository::class);
         $this->app->bind(evaluationInterface::class,evaluationRepository::class);
         $this->app->bind(depositInterface::class,depositRepository::class);
         $this->app->bind(statementInterface::class,statementRepository::class);
         $this->app->bind(offersInterface::class,offersRepository::class);
         $this->app->bind(chargeInterface::class,chargeRepository::class);
         $this->app->bind(withdrawalInterface::class,withdrawalRepository::class);
         $this->app->bind(installmentsInterface::class,installmentsRepository::class);
         $this->app->bind(reportsInterface::class,reportsRepository::class);
         $this->app->bind(subscriptionInterface::class,subscriptionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
