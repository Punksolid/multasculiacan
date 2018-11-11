<?php

namespace App\Console;

use App\Multa;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\LeerMulta::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->call(function(){
             $last_multa = Multa::orderBy('created_at','DESC')->first();
             $start_folio = ltrim($last_multa->folio,'J');
             $start_folio = $start_folio - 200;
             $end_folio = $start_folio + 200;
//             dd($start_folio, $end_folio, );
             \Artisan::call('multas:backup',[
                 'inicio' => $start_folio,
                    'fin' => $end_folio,
                    '--force' => true
                 ]);

         })->everyMinute();
//             ->dailyAt('06:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
        $this->load(__DIR__.'/Commands');
    }
}
