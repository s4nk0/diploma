<?php

namespace App\Repositories;

use App\Interfaces\AdGetSearchRepository;
use App\Models\AdGet;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticSearchAdGetRepository implements AdGetSearchRepository {
    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = '',$filters = null): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new AdGet;

        if ($query == ''){
            $items = $this->elasticsearch->search([
                'type' => $model->getSearchType(),
                'index' => $model->getSearchIndex(),
                'body'=>[
                    'size'=>100,
                    'query'=>[
                        'term'=>[
                            'city_id'=>[
                                'value'=>$_COOKIE['selected_city_id']
                            ]
                        ]
                    ],
                ]
            ]);

        } else {
            $items = $this->elasticsearch->search([
                'type' => $model->getSearchType(),
                'body' => [
                    "size"=> 16,
                    'query' => [
                        "bool"=>[
                            "must"=>
                                [
                                    "multi_match"=>[
                                        "query"=>$query,
                                        "type"=> "bool_prefix",
                                        "fields"=>[
                                            "location",
                                            "location._2gram",
                                            "location._3gram",
                                            "location.ngram",
                                            "location.en_rus_key",
                                            "location.my_ru_RU_dict_stemmer",
                                            "description",
                                            "description._2gram",
                                            "description._3gram",
                                            "description.en_rus_key",
                                            "description.ngram",
                                        ],
                                        "operator"=>"or",
                                    ]
                                ],

                            "should"=>[
                                [
                                    "multi_match"=>[
                                        "query"=>$query,
                                        "type"=> "bool_prefix",
                                        "fields"=>[
                                            "location",
                                            "location._2gram",
                                            "location._3gram",
                                            "location.en_rus_key",
                                            "location.my_ru_RU_dict_stemmer",
                                            "description",
                                            "description._2gram",
                                            "description._3gram",
                                            "description.en_rus_key",
                                        ],
                                        "operator"=>"and",
                                    ]
                                ],
                            ]
                        ],
                    ],
                ],
            ]);
        }


        return $items ->asArray();
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return AdGet::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }
}
