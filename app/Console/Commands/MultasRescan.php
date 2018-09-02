<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MultasRescan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multas:rescan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reescaneo de multas, muestra cambios extraños y ordena nuevo registro';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
    }
}
