<?php




use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
//use yii\grid\GridView;
use kartik\grid\GridView;

use app\modules\attendance\models\Employee;
use app\models\Raw;
use app\modules\attendance\models\EmployeeSchedule;
use app\modules\attendance\models\ScheduleSet;
use app\modules\attendance\models\ScheduleException;
use app\modules\attendance\models\Workhour;
use app\modules\attendance\models\TbKaryawan;
use app\modules\attendance\models\ScheduleItem;

use yii\data\ArrayDataProvider;


use kartik\mpdf\Pdf;

$offset = 0;

$workhour_columns3 = [

[
    'label' => 'date',
    'value' => function($model, $key, $index, $column)
    {
        return $key;
    }
],

[
    'label' => 'Shift pagi masuk',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
            $retvaluejamdatang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                    //if(in_array($workhour_id_list_key,['3']))
        //if(array_key_exists($workhour_id_list_key,$data))
                                            if(($workhour_id_list_key == '3') && array_key_exists('3',$data))
                          {
          
                                if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                               // return '';
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else {
                                                //return 'andrea';
                                             }
                                         }
                         } else {  
                            //return $workhour_id_list_key;
                             //$retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                         }
                        }           
                } else {
                   // return '';
                }

   return $retvaluejamdatang;
    }
],

[
'label' => 'Shift pagi pulang',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
    $retvaluejampulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

      //  echo sizeof($data);
      //  echo ' -> '  . $key . '<br/>';
                            //if(in_array($workhour_id_list_key,['5']))
                                  //if(array_key_exists('5',$data))
                                       if(($workhour_id_list_key == '5') && array_key_exists('5',$data))
                                   //   if(array_key_exists($workhour_id_list_key,$data))
                          {
                           // echo $workhour_id_list_key;
                           // echo '<br/>';
                                 if ($data[$workhour_id_list_key]['raw_status'] == '1') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             }
                             }
                         } else {  
                           // echo $workhour_id_list_key;
                           // echo 'no';
                       //      return '';
                         }
     }           
                } else {
                   // return '';
                }
   return $retvaluejampulang;
    }
],

[

'label' => 'Lama kerja',
'value' => function($data, $key, $index, $column) use ($workhour_id_list, $temp_result) {
            $malampulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                    //if(in_array($workhour_id_list_key,['3']))
        //if(array_key_exists($workhour_id_list_key,$data))
                                            if(($workhour_id_list_key == '3') && array_key_exists('3',$data))
                          {
          
                                if ($data[$workhour_id_list_key]['raw_status'] == '1') {
                                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                               // return '';
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else {
                                                //return 'andrea';
                                             }
                                         }
                         } 
                        }           
                } 


    $pagipulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

      //  echo sizeof($data);
      //  echo ' -> '  . $key . '<br/>';
                            //if(in_array($workhour_id_list_key,['5']))
                                  //if(array_key_exists('5',$data))
                                       if(($workhour_id_list_key == '5') && array_key_exists('5',$data))
                                   //   if(array_key_exists($workhour_id_list_key,$data))
                          {
                           // echo $workhour_id_list_key;
                           // echo '<br/>';
                                 if ($data[$workhour_id_list_key]['raw_status'] == '1') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             }
                             }
                         } 
     }           
                } 




            $pagimasuk = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                    //if(in_array($workhour_id_list_key,['3']))
        //if(array_key_exists($workhour_id_list_key,$data))
                                            if(($workhour_id_list_key == '3') && array_key_exists('3',$data))
                          {
          
                                if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                               // return '';
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else {
                                                //return 'andrea';
                                             }
                                         }
                         } 
                        }           
                } 


$masukkemarin = '';
    $today = new DateTime($key);
     //$yeesterday =  $today->modify('-1 day')->format("Y-m-d");
    $yesterday =  $today->modify('-1 day');
    if (array_key_exists($yesterday->format("Y-m-d"), $temp_result)) {

      if (isset($temp_result[$yesterday->format("Y-m-d")]['5']))
      {
        if ($temp_result[$yesterday->format("Y-m-d")]['5']['raw_status'] == '0')
        $masukkemarin = $temp_result[$yesterday->format("Y-m-d")]['5']['time'];
      }

    }

    $malammasuk = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

      //  echo sizeof($data);
      //  echo ' -> '  . $key . '<br/>';
                            //if(in_array($workhour_id_list_key,['5']))
                                  //if(array_key_exists('5',$data))
                                       if(($workhour_id_list_key == '5') && array_key_exists('5',$data))
                                   //   if(array_key_exists($workhour_id_list_key,$data))
                          {
                           // echo $workhour_id_list_key;
                           // echo '<br/>';
                                 if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             }
                             }
                         } 
     }           
                } 

                              if (($pagipulang == '') && ($pagimasuk == '')){
        return '';
        }

                                $time_malampulang = new DateTime($malampulang);
                            $time_pagipulang = new DateTime($pagipulang);

                             //   $time_malamammasuk = new DateTime($malammasuk);
                                      $time_malammasuk = new DateTime($masukkemarin);
                            $time_pagimasuk = new DateTime($pagimasuk);
                              $interval = $time_pagipulang->diff($time_pagimasuk);
                                          $interval2 = $time_malampulang->diff($time_malammasuk);

return $interval->format('%H h %I m');  
}
],

[
    'label' => 'Shift malam masuk',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
    $retvaluejampulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

      //  echo sizeof($data);
      //  echo ' -> '  . $key . '<br/>';
                            //if(in_array($workhour_id_list_key,['5']))
                                  //if(array_key_exists('5',$data))
                                       if(($workhour_id_list_key == '5') && array_key_exists('5',$data))
                                   //   if(array_key_exists($workhour_id_list_key,$data))
                          {
                           // echo $workhour_id_list_key;
                           // echo '<br/>';
                                 if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             }
                             }
                         } else {  
                           // echo $workhour_id_list_key;
                           // echo 'no';
                       //      return '';
                         }
     }           
                } else {
                   // return '';
                }
   return $retvaluejampulang;
    }
],
[
'label' => 'Shift malam pulang',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
            $retvaluejamdatang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                    //if(in_array($workhour_id_list_key,['3']))
        //if(array_key_exists($workhour_id_list_key,$data))
                                            if(($workhour_id_list_key == '3') && array_key_exists('3',$data))
                          {
          
                                if ($data[$workhour_id_list_key]['raw_status'] == '1') {
                                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                               // return '';
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                                             } else {
                                                //return 'andrea';
                                             }
                                         }
                         } else {  
                            //return $workhour_id_list_key;
                             //$retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                         }
                        }           
                } else {
                   // return '';
                }

   return $retvaluejamdatang;
    }
],
/*[
'label' => 'masuk hari kemarin',
'value' => function($data, $key, $index, $column) use ($workhour_id_list, $temp_result) {

    $today = new DateTime($key);
     //$yeesterday =  $today->modify('-1 day')->format("Y-m-d");
    $yesterday =  $today->modify('-1 day');
    if (array_key_exists($yesterday->format("Y-m-d"), $temp_result)) {

      if (isset($temp_result[$yesterday->format("Y-m-d")]['5']))
      {
        if ($temp_result[$yesterday->format("Y-m-d")]['5']['raw_status'] == '0')
        return $temp_result[$yesterday->format("Y-m-d")]['5']['time'];
      }

    } else {
    return 'OUT OF RANGE';
  }
     //return sizeof($temp_result[$yesterday->format("Y-m-d")]);
//return $today->format('%H h %I m');  

}
],  
*/
[

'label' => 'Lama kerja',
'value' => function($data, $key, $index, $column) use ($workhour_id_list, $temp_result, $offset) {
            $malampulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                    //if(in_array($workhour_id_list_key,['3']))
        //if(array_key_exists($workhour_id_list_key,$data))
                                            if(($workhour_id_list_key == '3') && array_key_exists('3',$data))
                          {
          
                                if ($data[$workhour_id_list_key]['raw_status'] == '1') {
                                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                               // return '';
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                                 $malampulang =  $data[$workhour_id_list_key]['time'];
                                             } else {
                                                //return 'andrea';
                                             }
                                         }
                         } 
                        }           
                } 


    $pagipulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

      //  echo sizeof($data);
      //  echo ' -> '  . $key . '<br/>';
                            //if(in_array($workhour_id_list_key,['5']))
                                  //if(array_key_exists('5',$data))
                                       if(($workhour_id_list_key == '5') && array_key_exists('5',$data))
                                   //   if(array_key_exists($workhour_id_list_key,$data))
                          {
                           // echo $workhour_id_list_key;
                           // echo '<br/>';
                                 if ($data[$workhour_id_list_key]['raw_status'] == '1') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $pagipulang =  $data[$workhour_id_list_key]['time'];
                             }
                             }
                         } 
     }           
                } 




            $pagimasuk = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                    //if(in_array($workhour_id_list_key,['3']))
        //if(array_key_exists($workhour_id_list_key,$data))
                                            if(($workhour_id_list_key == '3') && array_key_exists('3',$data))
                          {
          
                                if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                               // return '';
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                                 $pagimasuk =  $data[$workhour_id_list_key]['time'];
                                             } else {
                                                //return 'andrea';
                                             }
                                         }
                         } 
                        }           
                } 


$masukkemarin = '';
    $today = new DateTime($key);
     //$yeesterday =  $today->modify('-1 day')->format("Y-m-d");
    $yesterday =  $today->modify('-1 day');
    if (array_key_exists($yesterday->format("Y-m-d"), $temp_result)) {

      if (isset($temp_result[$yesterday->format("Y-m-d")]['5']))
      {
        if ($temp_result[$yesterday->format("Y-m-d")]['5']['raw_status'] == '0')
        $masukkemarin = $temp_result[$yesterday->format("Y-m-d")]['5']['time'];
      }

    } else {
      $masukkemarin = 'out-of-range';
    }

    $malammasuk = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

      //  echo sizeof($data);
      //  echo ' -> '  . $key . '<br/>';
                            //if(in_array($workhour_id_list_key,['5']))
                                  //if(array_key_exists('5',$data))
                                       if(($workhour_id_list_key == '5') && array_key_exists('5',$data))
                                   //   if(array_key_exists($workhour_id_list_key,$data))
                          {
                           // echo $workhour_id_list_key;
                           // echo '<br/>';
                                 if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $malammasuk =  $data[$workhour_id_list_key]['time'];
                             }
                             }
                         } 
     }           
                } 


                                $time_malampulang = new DateTime($malampulang);
                            $time_pagipulang = new DateTime($pagipulang);

                             //   $time_malamammasuk = new DateTime($malammasuk);
                            if($masukkemarin !== 'out-of-range') {

                              if ($malampulang == ''){
        return '';
        }
                                      $time_malammasuk = new DateTime($masukkemarin);
                            $time_pagimasuk = new DateTime($pagimasuk);
                              $interval = $time_pagipulang->diff($time_pagimasuk);
                              //$time_malammasuk->modify('+12 hour');
//                              $time_malampulang->modify('-60 minutes ');
  $interval2 = $time_malampulang->diff($time_malammasuk);
  $sec = (60 - ($interval2->s));
  $min = (59 - ($interval2->i));
  $hou = (23 - ($interval2->h));
  return $hou . ' h ' . $min  . ' m ';
//return $interval2->format('%R %H h %I m');  
                              return $time_malampulang->format(' H:i:s') . ' - ' . $time_malammasuk->format(' H:i:s');

}

else {
  return 'OUT OF RANGE';
}

}
],


];

                         if(isset($temp_result[$rawsearch->from_date]['3']['raw_status']))
                         {
                          if($temp_result[$rawsearch->from_date]['3']['raw_status'] == '1'){


                          $offset = 1;
                        }
                         }



echo GridView::widget([
        'dataProvider' => $attendance_data_provider,
       // 'filterModel' => $searchModel,
                  'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> '.$nama .' ('.$role->name.')</h3>',
        //'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false,
        'footer' => ($role->id != 4)?'<h3 class="panel-title"> Masuk : '.$totalmasuk.' -- telat : ' . $totaltelat . '</h3>
<h3 class="panel-title"> Pulang : '.$totalpulang.' -- awal : ' . $totalawal . '</h3>
<h3 class="panel-title"> Alpa : '.($totalalpa / 2).' </h3>
<h3 class="panel-title"> Sakit : '.$totalsakit.' </h3>
<h3 class="panel-title"> Ijin : '.$totalijin.' </h3>
<h3 class="panel-title"> Cuti : '.$totalcuti.' </h3>'

:

'<h3 class="panel-title"> Shift : '.ceil(($totalmasuk + $totaltelat - $offset) / 2) . '</h3>
<h3 class="panel-title"> Sakit : '.$totalsakit.' </h3>
<h3 class="panel-title"> Ijin : '.$totalijin.' </h3>
<h3 class="panel-title"> Cuti : '.$totalcuti.' </h3>'



,
    ],
        'columns' => $workhour_columns3,
        'showFooter' => true,
        //'footerRowOptions'
          //'showPageSummary' => true
            'toolbar'=>[
        '{export}',
      //  '{toggleData}'
    ],
        'toggleDataContainer' => ['class' => 'btn-group-sm'],
    'exportContainer' => ['class' => 'btn-group-sm'],
    'exportConfig' => [
GridView::PDF => [
        'label' => Yii::t('app', 'PDF'),
     //   'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
        'iconOptions' => ['class' => 'text-danger'],
        'showHeader' => true,
        'showPageSummary' => true,
        'showFooter' => true,
        'showCaption' => true,
        'filename' => Yii::t('app', 'export-absensi'),
        'alertMsg' => Yii::t('app', 'The PDF export file will be generated for download.'),
        'options' => ['title' => Yii::t('app', 'Portable Document Format')],
        'mime' => 'application/pdf',
        'config' => [
            'mode' => 'c',
            'format' => 'Legal',
            'destination' => 'D',
            'marginTop' => 5,
            'marginBottom' => 5,
            'marginLeft' => 5,
            'marginRight' => 5,
            'cssInline' => '.kv-wrap{padding:20px;}' .
                '.kv-align-center{text-align:center;}' .
                '.kv-align-left{text-align:left;}' .
                '.kv-align-right{text-align:right;}' .
                '.kv-align-top{vertical-align:top!important;}' .
                '.kv-align-bottom{vertical-align:bottom!important;}' .
                '.kv-align-middle{vertical-align:middle!important;}' .
                '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
           /* 'methods' => [
                'SetHeader' => [
                    ['odd' => $pdfHeader, 'even' => $pdfHeader]
                ],
                'SetFooter' => [
                    ['odd' => $pdfFooter, 'even' => $pdfFooter]
                ],
            ],
            */
            'methods' => [
                'SetHeader' => [
                    ['odd' => 'odd', 'even' => 'even']
                ],
                'SetFooter' => [
                    ['odd' => 'odd', 'even' => 'even']
                ],
            ],
            
            'options' => [
                'title' => 'export',
                'subject' => Yii::t('app', 'PDF export generated by kartik-v/yii2-grid extension'),
                'keywords' => Yii::t('app', 'krajee, grid, export, yii2-grid, pdf')
            ],
                'contentBefore'=>'<h3 class="panel-title"> Periode : '.$rawsearch->from_date . ' - ' . $rawsearch->to_date .' -- Jumlah Shift : ' .  ceil(($totalmasuk + $totaltelat - $offset) / 2) . ' </h3>
    <h3 class="panel-title"> PIN : ' . $rawsearch->pin . ' -- Nama : ' . $nama . '</h3>',

        ]
    ],

    ],

    ]);


/*

echo '<pre>';

echo '<br/>';
echo 'shift : ' . floor(($totalmasuk + $totaltelat) / 2);

echo '<br/>';
echo 'sakit : ' . $totalsakit;
echo '<br/>';
echo 'ijin : ' . $totalijin;
echo '<br/>';
echo 'hadir : ' . $totalhadir;
echo '<br/>';
*/
?>