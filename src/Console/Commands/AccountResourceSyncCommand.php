<?php

namespace TheBachtiarz\AccountResource\Console\Commands;

use Illuminate\Console\Command;
use TheBachtiarz\AccountResource\Services\ResourceSyncronizeService;

class AccountResourceSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thebachtiarz:resources:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Do Syncronize for all account resource';

    public function __construct(
        private ResourceSyncronizeService $resourceSyncronizeService
    ) {
        parent::__construct();
        $this->resourceSyncronizeService = $resourceSyncronizeService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('------> Account Resource Syncronize Start');

        $this->resourceSyncronizeService->execute();

        $this->info('------> Account Resource Syncronize Finish');
    }
}
