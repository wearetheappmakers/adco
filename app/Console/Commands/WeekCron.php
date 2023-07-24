<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Attendance;
use App\Admin;
use App\Weekoff;
use App\Holiday;
use DB;

class WeekCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'WeekCron:check';

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

     public function handle()
    {
        $user = User::where('status',1)->where('role',3)->get();
        foreach($user as $emp)
        {
            $date = date('Y-m-d');
            $day = date('l',strtotime($date));
            $attendance = Attendance::where('employee_id',$emp->id)->where('date',$date)->exists();
            if(!$attendance)
            {
                $check_holiday = Holiday::where('date',$date)->exists();
                $weekoff = Weekoff::where('id',$emp->weekoff_id)->first();
                $narration = 'Absent';
                if($check_holiday)
                {
                    $narration = "Holiday";
                }
                elseif(isset($weekoff))
                {

                    if($weekoff->mon == $day)
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
                    elseif($weekoff->sun == $day)
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
                }

                $attend = new Attendance();
                $attend['employee_id'] = $emp['id'];
                $attend['branch_id'] = $emp['branch_id'];
                $attend['attendance'] = $narration;
                $attend['date'] = $date;
                $attend->save();

            }

        }


    }
}
