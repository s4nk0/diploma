<?php

namespace App\Console\Commands;

use App\Models\Ad;
use App\Models\AdGet;
use Elastic\Elasticsearch\Client;
use Illuminate\Console\Command;

class ElasticSearchReindex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Indexes all articles to Elasticsearch';

    /** @var \Elasticsearch\Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        parent::__construct();

        $this->elasticsearch = $elasticsearch;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Indexing all ad. This might take a while...');

        foreach (Ad::cursor() as $data)
        {

            $this->elasticsearch->index([
                'index' => $data->getSearchIndex(),
                'type' => $data->getSearchType(),
                'id' => $data->getKey(),
                'body' => $data->toSearchArray(),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }

        $this->info("\nDone!");

        $this->info('Indexing all ad_get. This might take a while...');

        foreach (AdGet::cursor() as $data)
        {
            $this->elasticsearch->index([
                'index' => $data->getSearchIndex(),
                'type' => $data->getSearchType(),
                'id' => $data->getKey(),
                'body' => $data->toSearchArray(),
            ]);

            // PHPUnit-style feedback
            $this->output->write('.');
        }

        $this->info("\nDone!");
    }
}
