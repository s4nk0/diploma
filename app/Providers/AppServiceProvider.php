<?php

namespace App\Providers;

use App\Interfaces\AdSearchRepository;
use App\Interfaces\SearchRepository;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $models= [
            'Ad',
            'AdGet',
        ];

        foreach ($models as $model){

            $this->app->bind("App\Interfaces\\".$model."SearchRepository", function ($app) use ($model) {
                // This is useful in case we want to turn-off our
                // search cluster or when deploying the search
                // to a live, running application at first.

                $eloquentSearch = '\App\Repositories\EloquentSearch'.$model.'Repository';
                $elasticSearch = '\App\Repositories\ElasticSearch'.$model.'Repository';

                if (! config('services.search.enabled')) {
                    return new $eloquentSearch();
                }

                return new $elasticSearch(
                    $app->make(Client::class)
                );
            });
        }


        $this->bindSearchClient();
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->setBasicAuthentication(env('ELASTICSEARCH_USERNAME'),env('ELASTICSEARCH_PASSWORD'))
                ->setCABundle('C:\Users\Intel\Desktop\http_ca.crt')
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
