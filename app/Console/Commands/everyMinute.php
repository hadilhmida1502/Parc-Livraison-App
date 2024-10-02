<?php

namespace App\Console\Commands;

use App\Events\MyEvent;
use App\Models\Mission;
use App\Models\Assurance;
use App\Models\Notifications;
use Illuminate\Console\Command;

class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
     * @return int
     */
    public function handle()
    {
        $Assurance = Assurance::all();
        foreach($Assurance as $Ass){
            $exp_date=date('Y/m/d',strtotime($Ass->exp_ass));
            $exp_date1=date('Y/m/d',strtotime($Ass->exp_taxe));
            $exp_date2=date('Y/m/d',strtotime($Ass->proch_vt));
            $today_date=date('Y/m/d');


            $diff=abs(strtotime($today_date) - strtotime($exp_date));
            $days = floor($diff / (60 * 60 * 24));
            if ($days >= 3 ) {
                echo "assurance va s'expirer ";
                event(new MyEvent('assurance va s\'expirer'));
                Notifications::create([
                    'message'=>"assurance va s'expirer",
                    'vehicules'=>$Ass->vehicule,
                    /* 'vu'=>0, */
                    'type'=>'assurance',
                ]);
            }

            $diff1=abs(strtotime($today_date) - strtotime($exp_date1));
            $days1 = floor($diff1 / (60 * 60 * 24));
            if ($days1 >= 3 ) {
                echo "taxe va s'expirer ";
                event(new MyEvent('taxe va s\'expirer'));
                Notifications::create([
                    'message'=>"taxe va s'expirer",
                    'vehicules'=>$Ass->vehicule,
                    /* 'vu'=>0, */
                    'type'=>'taxe',
                ]);
            }

            $diff2=abs(strtotime($today_date) - strtotime($exp_date2));
            $days2 = floor($diff2 / (60 * 60 * 24));
            if ($days2 >= 7 ) {
                echo "visite va s'expirer ";
                event(new MyEvent('visite va s\'expirer'));
                Notifications::create([
                    'message'=>"visite va s'expirer",
                    'vehicules'=>$Ass->vehicule,
                    /* 'vu'=>0, */
                    'type'=>'visite',
                ]);
            }
        }

        /* ****************************************** */
        $Mission = Mission::all();
        foreach($Mission as $Miss){
            $exp_date=date('Y/m/d',strtotime($Miss->date_mission));
            $today_date=date('Y/m/d');

            $diff=abs(strtotime($today_date) - strtotime($exp_date));
            $days = floor($diff / (60 * 60 * 24));
            if ($days >= 1 ) {
                echo "mission proche ";
                event(new MyEvent('mission proche'));
                Notifications::create([
                    'message'=>"mission proche ",
                    'vehicules'=>$Miss->num_mission,
                    /* 'vu'=>0, */
                    'type'=>'mission',
                ]);
            }
        }
    }
}
