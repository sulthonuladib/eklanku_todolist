<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $options = array(
        //     'cluster' => 'ap1',
        //     'encrypted' => true
        // );

        // //Remember to set your credentials below.
        // $pusher = new Pusher(
        //     '347a9f8368ae5c56f4a0',
        //     'e2212980fc8bde8a300a',
        //     '928914', $options
        // );
        // $end =  DB::select("SELECT user_id, title, DATE_FORMAT(end_at,'%i %H %d %m *')as akhir from tasks");
        // foreach($end as $end_at){
        //     $schedule->call(function(){
        //          //membuat kalimat
        //         $nama_task = $end_at->title;
        //         $user_id = $end_at->user_id;
        //         $nama_orang = DB::table('users')->where('id',$user_id)->first()->name;
        //         $kalimat = " Task ".$nama_task." yang dikerjakan oleh ".$nama_orang."Telah mencapai deathline";
        //         //Trigger custom event
        //         $pusher->trigger('my-channel', 'my-event', $kalimat);
        //     })->cron($end_at->akhir);
        //     Log::info("Cron is working at ".$end_at->akhir);
        // }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
