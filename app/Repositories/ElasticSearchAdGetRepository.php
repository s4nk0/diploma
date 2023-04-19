<?php

namespace App\Repositories;

use App\Enums\CookieNames;
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
        $items = $this->searchOnElasticsearch($query,$filters);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = '',$filters = null): array
    {
        $model = new AdGet;

        $elasticQuery = [
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => [
                "size"=> 500,
                'query' => [
                    "bool"=>[
                        "must"=>
                            [
                                // Add a condition to check if $query is empty
                                $query ? [
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
                                ] : [
                                    // If $query is empty, match all documents
                                    "match_all" => (object)[]
                                ],
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
                            [
                                'term'=>[
                                    'city_id'=>[
                                        'value'=>$_COOKIE[CookieNames::SelectedCity->value]
                                    ],
                                ]
                            ]
                        ],

                    ],
                ],
            ],
        ];

        if (isset($filters['rooms_count'])){
            if ($filters['rooms_count'] == 5){
                $elasticQuery['body']['query']['bool']['filter'][]['range']['rooms_count']['gte'] = $filters['rooms_count'];
            } else{
                $elasticQuery['body']['query']['bool']['filter'][]['term']['rooms_count']['value'] = intval($filters['rooms_count']);
            }

        }

        if (isset($filters['ad_gender_type_id'])){
            $elasticQuery['body']['query']['bool']['filter'][]['term']['ad_gender_type_id']['value'] = intval($filters['ad_gender_type_id']);
        }

        if (isset($filters['city_id'])){
            $elasticQuery['body']['query']['bool']['filter'][]['term']['city_id']['value'] = $filters['city_id'];
        }

        if (isset($filters['price_from']) && $filters['price_from'] !== ''){
            $elasticQuery['body']['query']['bool']['filter'][]['range']['price_from']['gte'] = $filters['price_from'];
        }

        if (isset($filters['price_to']) && $filters['price_to'] !== ''){
            $elasticQuery['body']['query']['bool']['filter'][]['range']['price']['lte'] = $filters['price_to'];
        }

        $items = $this->elasticsearch->search($elasticQuery);
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
