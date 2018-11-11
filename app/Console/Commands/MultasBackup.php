<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class MultasBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multas:backup {inicio} {fin} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Entrada Principal Scanner de Multas';

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
        $inicio = $this->argument('inicio');
        $fin = $this->argument('fin');
        $force = $this->option('force');
        $bar = $this->output->createProgressBar(($fin-$inicio));
        $carbon = Carbon::now();
        for ($folio = $inicio; $folio <= $fin ; $folio++) {
            $output = $this->getOutput(
                $this->call('multas:leer', [
                    'folio' => $folio,
                    '--force' => $force
                ])

            );

            $bar->advance();
        }
        $bar->finish();

        $this->comment('fin');
        $this->comment($carbon->diffForHumans());
    }
}
