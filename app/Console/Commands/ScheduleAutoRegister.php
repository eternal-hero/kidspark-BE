<?php

namespace App\Console\Commands;

use App\Models\SupporterSchedule;
use App\Models\SupporterScheduleAutoRegister;
use Illuminate\Console\Command;

class ScheduleAutoRegister extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:auto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '毎月5日0時に、自動更新設定のデータを各サポーターのスケジュールに登録する';

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
        $data = SupporterScheduleAutoRegister::get()->groupBy('day_of_week');
        
        $month = date('Y-m', strtotime('+ 1month'));
        $first_date = date("Y-m-d", strtotime('first day of ' . $month));
        $last_date = date("Y-m-d", strtotime('last day of ' . $month));
        $date = $first_date;
        
        for($date; $date <= $last_date; $date = date("Y-m-d", strtotime('+ 1day' . $date))) {
            if (!isset($data[date('w', strtotime($date))])) continue;
            foreach ($data[date('w', strtotime($date))] as $schedule) {
                if ($schedule['is_available_all_day'] == 0) {
                    $schedule_data[] = [
                        'supporter_user_id' => $schedule['supporter_user_id'],
                        'working_date' => $date,
                        'start_at' => NULL,
                        'end_at' => NULL,
                        'is_available_all_day' => 0,
                        'is_reservable' => 0
                    ];
                } else {
                    $schedule_data[] = [
                        'supporter_user_id' => $schedule['supporter_user_id'],
                        'working_date' => $date,
                        'start_at' => $schedule['start_at'],
                        'end_at' => $schedule['end_at'],
                        'is_available_all_day' => 1,
                        'is_reservable' => 1
                    ];
                }
            }
        }

        SupporterSchedule::insert($schedule_data);
    }
}
