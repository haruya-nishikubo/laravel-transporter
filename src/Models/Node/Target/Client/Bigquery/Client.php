<?php

namespace HaruyaNishikubo\Transporter\Models\Node\Target\Client\Bigquery;

use Exception;
use Google\Cloud\BigQuery\BigQueryClient;
use Google\Cloud\BigQuery\QueryResults;
use Google\Cloud\Core\ExponentialBackoff;
use HaruyaNishikubo\Transporter\Models\Node\Collection\Collection;
use HaruyaNishikubo\Transporter\Models\Node\Target\Client\Client as BaseClient;

class Client extends BaseClient
{
    protected BigQueryClient $client;

    public function __construct(array $attributes)
    {
        $this->client = new BigQueryClient([
            'project_id' => $attributes['project_id'],
            'keyFile' => $attributes['key_file'],
        ]);
    }

    public function query(string $query): QueryResults
    {
        $job_config = $this->client->query($query);
        $job = $this->client->startQuery($job_config);

        $backoff = new ExponentialBackoff(10);
        $backoff->execute(function () use ($job) {
            $job->reload();

            if (! $job->isComplete()) {
                throw new Exception('Job has not yet completed', 500);
            }
        });

        return $job->queryResults();
    }

    public function load(string $dataset, string $table_name, Collection $collection): self
    {
        $dataset = $this->client->dataset($dataset);
        $table = $dataset->table($table_name);

        foreach ($collection->chunk(1000) as $chunk) {
            $load_config = $table->load($chunk->toJsonl())
                ->sourceFormat('NEWLINE_DELIMITED_JSON')
                ->writeDisposition('WRITE_APPEND');

            $job = $this->client->runJob($load_config);

            $backoff = new ExponentialBackoff(10);
            $backoff->execute(function () use ($job) {
                $job->reload();

                if (! $job->isComplete()) {
                    throw new Exception('Job has not yet completed', 500);
                }
            });

            if (isset($job->info()['status']['errorResult'])) {
                $error = $job->info()['status']['errorResult']['message'];

                throw new Exception(json_encode([
                    'method' => __METHOD__,
                    'line' => __LINE__,
                    'errorResult' => $job->info()['status']['errorResult'],
                    'errors' => $job->info()['status']['errors'],
                ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), 500);
            }
        }

        return $this;
    }
}
