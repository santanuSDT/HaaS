<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Config;
use App\Models\Horoscope;

class HoroscopeController extends Controller {

    public function generate(Request $request){
        $zodiac_list = Config::get('common.zodiac'); 
        $year = $request->year;
        //check the existence of the selected year horoscope
        $find_this_year = Horoscope::where('year',$year)->first();

        //dd($zodiac_list);
        foreach($zodiac_list as $key => $value){
            $yearly_score = 0;
            for ($i = 1; $i <= 12; $i++){
                $month_total_score = 0;
                //getting the total days of the month
                $days = cal_days_in_month(CAL_GREGORIAN,$i,$year);
    
                if($i <10){
                    $i = '0'.$i;
                }
                //First date of the month
                $first_date = '01'.'-'.$i.'-'.$year;
                //Last date of the month
                $last_date = $days.'-'.$i.'-'.$year;
    
                $begin = new DateTime($first_date);
                $end   = new DateTime($last_date);

                for ($j = $begin; $j <= $end ; $j->modify('+1 day')){
                    // $horoscope[$key][$j->format("Y-m-d")]['zodiac_key'] = $key;
                    
                    // $horoscope[$key][$j->format("Y-m-d")]['zodiac_key'] = $key;
                    // $horoscope[$key][$j->format("Y-m-d")]['date'] = [$j->format("Y-m-d")] ;
                    $horoscope[$key][$j->format("Y-m-d")]['zodiac'] = $key;
                    $horoscope[$key][$j->format("Y-m-d")]['date'] = $j->format("Y-m-d");
                    $horoscope[$key][$j->format("Y-m-d")]['score'] = rand(1,10);
                    $month_total_score = $month_total_score + $horoscope[$key][$j->format("Y-m-d")]['score'];
                }
                $monthly_score[$key][$i]['total_in_month'] = $month_total_score;
                $yearly_score = $yearly_score + $month_total_score;
                
                
            }
            
            
        }
        $yearly_total_score[$key] = $yearly_score;

        //best month of a zodiac
        foreach($monthly_score as $zod => $score){
            $best_month[$zod] = array_search(max($score),$score);    
        }
    
        //best zodiac of the year calculation
        $max_zodiac = array_search(max($yearly_total_score),$yearly_total_score);

        if($find_this_year){
            $new_horoscope = $find_this_year;
        }
        else{
            $new_horoscope = new Horoscope;
        }
        
        $new_horoscope->year = $year;
        $new_horoscope->horoscope_details = json_encode($horoscope);
        $new_horoscope->save();
        
        $data['horoscope_data']  = Horoscope::where('year',$year)->first();
        // dd($data['horoscope_data']->horoscope_details);
        $data['year'] = $year;
        // $data['horoscope_details'] = json_decode($data['horoscope_data']->horoscope_details,true);
        $data['horoscope_details'] = $data['horoscope_data']->horoscope_details;
        //dd($data['horoscope_details']);

        $data['decoded'] = json_decode($data['horoscope_details'],true);
       
        // dd($data['decoded']);
        return view('full-calendar',['data'=>$data]);   
                
    }
}