<?php

namespace App\Repositories;

use App\Enums\CookieNames;
use App\Interfaces\AdSearchRepository;
use App\Interfaces\SearchRepository;
use App\Models\Ad;
use Elastic\Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class ElasticSearchAdRepository implements AdSearchRepository
{
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
        $model = new Ad;

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
                                [
                                    'term'=>[
                                        'city_id'=>$_COOKIE[CookieNames::SelectedCity->value],
                                    ]
                                ]
                            ],

                        ],
                    ],
                ],
            ];

            if (isset($filters['price_from']) && $filters['price_from'] !== ''){
                $elasticQuery['body']['query']['bool']['filter'][]['range']['price']['gte'] = $filters['price_from'];
            }

            if (isset($filters['price_to']) && $filters['price_to'] !== ''){
                $elasticQuery['body']['query']['bool']['filter'][]['range']['price']['lte'] = $filters['price_to'];
            }

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

            if (isset($filters['bathrooms_count'])){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['bathrooms_count']['value'] = $filters['bathrooms_count'];
            }

            if (isset($filters['balconies_count']) && $filters['balconies_count'] !== null){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['balconies_count']['value'] = $filters['balconies_count'];
            }

            if (isset($filters['loggias_count']) && $filters['loggias_count'] !== null){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['loggias_count']['value'] = $filters['loggias_count'];
            }

            if (isset($filters['floor_from']) && $filters['floor_from'] !=''){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['floor_from']['value'] = $filters['floor_from'];
            }

            if (isset($filters['floor']) && $filters['floor'] != ''){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['floor']['value'] = $filters['floor'];
            }

            if (isset($filters['square_general']) && $filters['square_general'] != ''){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['square_general']['value'] = $filters['square_general'];
            }

            if (isset($filters['square_living']) && $filters['square_living'] != ''){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['square_living']['value'] = $filters['square_living'];
            }

            if (isset($filters['square_kitchen']) && $filters['square_kitchen'] != ''){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['square_kitchen'] = $filters['square_kitchen'];
            }

            if (isset($filters['kitchen_studio']) && $filters['kitchen_studio'] != ''){
                $elasticQuery['body']['query']['bool']['filter'][]['term']['kitchen_studio'] = $filters['kitchen_studio'];
            }


            if (isset($filters['roommate_count'])){
                if (isset($filters['roommate_count']) == 5){
                    $elasticQuery['body']['query']['bool']['filter'][]['range']['roommate_count']['gte'] = $filters['roommate_count'];

                } else{
                    $elasticQuery['body']['query']['bool']['filter'][]['term']['roommate_count']['value'] = $filters['roommate_count'];
                }
            }


        $items = $this->elasticsearch->search($elasticQuery);
        return $items ->asArray();
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Ad::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }
}
