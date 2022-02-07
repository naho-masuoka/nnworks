<?php
namespace App\Library;

use App\Timetable;
use App\Title;
use Carbon\Carbon;
use Yasumi\Yasumi;

class Calendar
{

    public function days($fitst_day, $i){
        $start=$fitst_day->copy()->firstOfMonth();
        
        //祝日を取得
        $holidays=[];
        $hs = Yasumi::create("Japan", date('Y',strtotime($start)), "ja_JP");

        foreach($hs as $h){
            $holidays[]=['day'=>date('Y-m-d',strtotime($h)),'name'=>$h->getName()];   
        }
        
        $date=$start;
        $end=$fitst_day->lastOfMonth();
        $ymd=[];
        if($i == 2 ){
            $youbi = date('w', strtotime($date));
            if($youbi <> 1){
                $date=$date->copy()->subday($youbi-1);
            }elseif($youbi == 0){
                $date=$date->copy()->addday(6);
            }
            $youbi =date('w', strtotime($end));
            if($youbi <> 7){
                $end=$end->copy()->addday(7-$youbi);
            }
        }
        //月作成
        while($date <= $end){
            $hd = in_array(date('Y-m-d',strtotime($date)), array_column($holidays, 'day'));
            
            if($hd <>false){      
                $hd = array_search(date('Y-m-d',strtotime($date)), array_column($holidays, 'day'));
                $ymd[]=['day' => $date,
                        'holiday'=>$holidays[$hd]['name'],
                        ];
            }else{
                $ymd[]=['day' => $date,
                        'holiday'=>null,
                        ];
            }    
            $date = $date->copy()->adddays(1);
        }

        return $ymd;
    }
}
