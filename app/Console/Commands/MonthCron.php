<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Attendance;
use App\Admin;
use App\Weekoff;
use App\Holiday;
use DB;

class MonthCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MonthCron:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ABC';

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
        $employee = User::where('role',3)->where('status',1)->get();
        foreach($employee as $emp)
        {
            $year = date('Y');
            $month = date('m');
            $current = date('Y-m-d');
            $lastdate = date('t',strtotime($current));

            for ($i=1; $i <= $lastdate ; $i++) { 
                $date = $year.'-'.$month.'-'.$i;
                $date = date('Y-m-d',strtotime($date));
                $attendance = Attendance::where('employee_id',$emp->id)->where('date',$date)->exists();
                if(!$attendance)
                {
                    $day = date('l',strtotime($date));
                    $check_holiday = Holiday::where('date',$date)->exists();
                    $weekoff = Weekoff::where('id',$emp->weekoff_id)->first();
                    // dump($weekoff);
                    $narration = '';
                    if($check_holiday)
                    {
                        $narration = "Holiday";
                    }
                    elseif(isset($weekoff))
                    {

                        if($weekoff->sunday == $day)
                        {
                            if($weekoff->sun_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->sun_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                        elseif($weekoff->mon == $day)
                        {
                            if($weekoff->mon_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->mon_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                        elseif($weekoff->tue == $day)
                        {
                            if($weekoff->tue_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->tue_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                        elseif($weekoff->wed == $day)
                        {
                            if($weekoff->wed_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->wed_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                        elseif($weekoff->thu == $day)
                        {
                            if($weekoff->thu_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->thu_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                        elseif($weekoff->fri == $day)
                        {
                            if($weekoff->fri_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->fri_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                        elseif($weekoff->sat == $day)
                        {
                            if($weekoff->sat_type == 1)
                            {
                                $narration = 'Weekoff';
                            }
                            else
                            {
                                $wo_type = 'Second half';
                                if($weekoff->sat_type == 2)
                                {
                                    $wo_type = 'First half';
                                }
                                $narration = 'Weekoff('.$wo_type.')';
                            }
                        }
                    }
                    else
                    {
                        $narration = '';
                    }
                    if($narration)
                    {
                        $attend = new Attendance();
                        $attend['branch_id'] = $emp['branch_id'];
                        $attend['employee_id'] = $emp['id'];
                        $attend['attendance'] = $narration;
                        $attend['date'] = $date;
                        $attend->save();
                    }

                }
            }

        }

    }
}
