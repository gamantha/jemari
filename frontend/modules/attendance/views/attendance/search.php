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
use app\modules\attendance\models\ScheduleItem;

use yii\data\ArrayDataProvider;


use kartik\mpdf\Pdf;


/* @var $this yii\web\View */
/* @var $model app\models\Raw */
/* @var $form yii\widgets\ActiveForm */


$totalcuti = 0;
$totaltelat = 0;
$totalsakit = 0;
$totalmasuk = 0;
$totalalpa = 0;
$totalijin = 0;
$totalawal = 0;
$totalpulang = 0;
$totalawal = 0;



?>

<div class="raw-form">









        <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($rawsearch, 'hardware_id')->textInput(['maxlength' => true]) ?>


    <?= $form->field($rawsearch, 'pin')->textInput(['maxlength' => true]) ?>

<?php

echo 'from';
echo DatePicker::widget([
    'name'  => 'from_date',
    'attribute' => 'from_date',
    'model' => $rawsearch,
    'value'  => '',
    'options'=>['class' => 'form-control'],
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
]);

echo 'to';
echo DatePicker::widget([
    'name'  => 'to_date',
        'attribute' => 'to_date',
    'model' => $rawsearch,
    'value'  => '',
        'options'=>['class' => 'form-control'],
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
]);


?>
    <div class="form-group">
     <?= Html::submitButton('Submit', ['class' => 'submit']) ?>
    </div>



    <?php ActiveForm::end(); ?>



</div>

<hr/>

<?php
/*
echo GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,

          'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '.$rawsearch->pin.' Raw</h3>',
        //'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    ],


        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'hardware_id',
            'pin',
            'datetime',
            'verified',
            'status',
            // 'workcode',

            //['class' => 'yii\grid\ActionColumn'],

        ],
           'resizableColumns'=>true,
         'responsive'=>true,
    'hover'=>true,
            'toolbar' => [
        [

        ],
        '{export}',
      //  '{toggleData}'
    ],
                'toggleDataContainer' => ['class' => 'btn-group-sm'],
    'exportContainer' => ['class' => 'btn-group-sm']
    ]);
*/


$days = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    0 => 'Sunday'
);


$attendance_array = [];
$attendance_array_yii = [];
$exception_array = [];


if ($rawsearch->pin)
{

  //  echo '<br/>Employee :'. $rawsearch->pin.' <br/>';
    $employee = Employee::find()
    ->andWhere(['pin' => $rawsearch->pin])
    ->andWhere(['status' => 'active'])
    ->One();
    //print_r($employee);
    if (!is_null($employee)) {



        $schedules = EmployeeSchedule::find()
        ->andWhere(['employee_id' => $employee->id])
            ->andWhere(['status' => 'active'])
            ->orderBy(['order' => SORT_ASC])
        ->All();

        $schedule_array = [];
        foreach ($schedules as $key => $value) {
            $schedule_items = ScheduleItem::find()
                ->andWhere(['schedule_set_id' => $value->schedule_set_id])
                ->orderBy(['dayofweek' => SORT_ASC])
                ->All();
                foreach ($schedule_items as $key2 => $value2) {
                    $schedule_array[$value->schedule_set_id] = $value2;


                }
        }
    }



$datecounter = new DateTime($rawsearch->from_date);

$endcounter = new DateTime($rawsearch->to_date);

while ($datecounter <= $endcounter)
{
$temp_exception_array = [];
$rawsofday = Raw::find()
->andWhere(['pin' => $rawsearch->pin])
->andWhere(['hardware_id' => $rawsearch->hardware_id])
->andWhere(['between', 'datetime',$datecounter->format("Y-m-d"), $datecounter->modify('+1 day')->format("Y-m-d")])
->All();
$attendance_array[$datecounter->modify('-1 day')->format("Y-m-d")] = $rawsofday;

    
    $exceptions =  ScheduleException::find()
                    ->andWhere(['employee_id' => $employee->id])
                   ->andWhere(['between', 'datetime',$datecounter->format("Y-m-d"), $datecounter->modify('+1 day')->format("Y-m-d")])
                    ->All();

                     $datecounter->modify('-1 day')->format("Y-m-d");

        foreach ($exceptions as $exception_key => $exception_value) {
            array_push($exception_array, 
                [
                'datecounter' => $datecounter->format("Y-m-d"),
                                'date' => date("Y-m-d", strtotime($exception_value->datetime)),
                'time' => date("H:i:s", strtotime($exception_value->datetime)),
                'exception_type' => $exception_value->exception_type,
                'exception_reason' => $exception_value->exception_reason,
                'status' => $exception_value->status,
                ]);

            array_push($temp_exception_array, 
                [
                'datecounter' => $datecounter->format("Y-m-d"),
                                'date' => date("Y-m-d", strtotime($exception_value->datetime)),
                'time' => date("H:i:s", strtotime($exception_value->datetime)),
                'exception_type' => $exception_value->exception_type,
                'exception_reason' => $exception_value->exception_reason,
                'status' => $exception_value->status,
                ]);

        }


//print_r($temp_exception_array);
//echo '<hr/>';
$temp_exception_array_transformed = ArrayHelper::index($temp_exception_array,'datecounter');



    if(sizeof($rawsofday) > 0) {
          foreach ($rawsofday as $rawofdaykey => $rawofdayvalue) {
                                     foreach ($schedule_array as $schedule_array_key => $schedule_array_value) {
                                            $schedule_item_list = ScheduleItem::find()
                                                    ->andWhere(['schedule_set_id' => $schedule_array_key])
                                                    ->andWhere(['dayofweek' => date("w", strtotime($rawofdayvalue->datetime))])
                                                    ->All();
                                $dateday = date("Y-m-d", strtotime($rawofdayvalue->datetime));
                                $nextday = date("Y-m-d", strtotime($rawofdayvalue->datetime . ' +1 day'));
                                $time = date("H:i:s", strtotime($rawofdayvalue->datetime));
                                    foreach ($schedule_item_list as $sched_item_key => $sched_item_value) {
                                               //   echo '<br/>';
                                                 //       echo $sched_item_value->workhour_id . ' -> ' . $sched_item_value->workhour->ontime;
                                                  if (($time >= $sched_item_value->workhour->start_scan) && ($time <= $sched_item_value->workhour->end_scan)) {
                                                        //echo 'YES';





                                                        if($time <= $sched_item_value->workhour->ontime)
                                                        {
                                                          //   $attendance_array[$dateday]['attendance'][$sched_item_value->workhour->id][$sched_item_value->workhour->pretime_value] = $time;
                                                             array_push($attendance_array_yii, [
                                                                'date' => $dateday, 
                                                                'workhour_id' => $sched_item_value->workhour->id,
                                                                'optional' => $sched_item_value->optional,
                                                                'time' => $time,
                                                                'attendance_status' => $sched_item_value->workhour->pretime_value,

                                                                ]);
                                                        } else {
                                                          //  $attendance_array[$dateday]['attendance'][$sched_item_value->workhour->id][$sched_item_value->workhour->posttime_value] = $time;
                                                            array_push($attendance_array_yii, ['date' => $dateday, 'workhour_id' => $sched_item_value->workhour->id,
                                                                'optional' => $sched_item_value->optional,
                                                                'time' => $time,
                                                                'attendance_status' => $sched_item_value->workhour->posttime_value,

                                                                ]);
                                                        }
                                                             // $attendance_array[$dateday]['exception']= [];
                                                  }
                                                
                                        }

                                    }

                            }
                        } else { 
                        //if no raw data
                            //1. DECIDE IF tidak ada schedule atau memang tidak masuk

                                foreach ($schedule_array as $schedule_array_key => $schedule_array_value) {
                                            $schedule_item_list = ScheduleItem::find()
                                                    ->andWhere(['schedule_set_id' => $schedule_array_key])
                                                    ->andWhere(['dayofweek' => date("w", strtotime($datecounter->format("Y-m-d")))])
                                                    ->All();
                               // $dateday = date("Y-m-d", strtotime($rawofdayvalue->dateti));
                               // $time = date("H:i:s", strtotime($rawofdayvalue->datetime));
                                                    if(sizeof($schedule_item_list) > 0) {
                                            foreach ($schedule_item_list as $sched_item_key => $sched_item_value) {

                                                $status2 = '';
//echo 'DATE : ' . $datecounter->format("Y-m-d") . '<br/>';
//print_r($temp_exception_array_transformed);
                                                 if(array_key_exists($datecounter->format("Y-m-d"),$temp_exception_array_transformed))
                                                 {
                                                //if (is_null($temp_exception_array_transformed[])){
                                                    $status2 = 'Exception';
                                                } else {
                                                    $status2 = 'ABSENT';
                                                }

                                              //    echo '<br/>';
                                                //        echo $sched_item_value->workhour_id . ' -> ' . $sched_item_value->workhour->ontime;
                                                          //   $attendance_array[$datecounter->format("Y-m-d")]['attendance'][$sched_item_value->workhour->id] = $sched_item_value->optional;
                                                             array_push($attendance_array_yii, ['date' => $datecounter->format("Y-m-d"), 
                                                                'workhour_id' => $sched_item_value->workhour->id, 
                                                                'optional' => $sched_item_value->optional,
                                                                'time' => null,
                                                                'attendance_status' => ($sched_item_value->optional == 'true') ? null : $status2,


                                                                ]);
                                                                //   $attendance_array[$datecounter->format("Y-m-d")]['exception']= [];
                                                            //$attendance_array[$datecounter->format("Y-m-d")]['attendance']['no data'] = 'NO DATA';

                                                }
                                            } else {
                         //  $attendance_array[$datecounter->format("Y-m-d")]['attendance']= [];
                            //  $attendance_array[$datecounter->format("Y-m-d")]['exception']= [];
                              array_push($attendance_array_yii, ['date' => $datecounter->format("Y-m-d"), 
                                //'workhour_id' => 'none', 
                                'optional' => 'none',
                                    'time' => null,
                                     'attendance_status' => 'none',
                                                                
                                ]);
                                            }
                                    }

                            }
                            
$datecounter->modify('+1 day');
}

}




$final_attendance_array = [];
$final_exception_array = [];

/*

foreach ($attendance_array as $attendance_array_key_a => $attendance_array_value_a) {
    # code...
        //echo 'attendance array key : ' .$attendance_array_key_a;
        $final_attendance_array[$attendance_array_key_a] = $attendance_array_value_a['attendance'];
                $final_exception_array[$attendance_array_key_a] = $attendance_array_value_a['exception'];
     //   echo '<br/>';

}
*/

$temp_result = ArrayHelper::index($attendance_array_yii, 'workhour_id','date');
$workhour_id_list = ArrayHelper::index($attendance_array_yii,'workhour_id');
$exception_array2 = ArrayHelper::index($exception_array,'datecounter');

    
foreach ($exception_array2 as $exception_array_key => $exception_array_value) {
    if($exception_array_value['exception_type'] == 'cuti') {
        $totalcuti++;
    } else if($exception_array_value['exception_type'] == 'sakit') {
        $totalsakit++;
    } else if($exception_array_value['exception_type'] == 'ijin') {
        $totalijin++;
    }
    
}

foreach ($temp_result as $temp_result_key => $temp_result_value) {
    foreach ($temp_result_value as $temp_result_key2 => $temp_result_value2) {
        if ($temp_result_value2['attendance_status'] == 'telat') {
            $totaltelat++;
        } else if ($temp_result_value2['attendance_status'] == 'ABSENT') {
            $totalalpa++;
        } else if ($temp_result_value2['attendance_status'] == 'masuk') {
            $totalmasuk++;
        } else if ($temp_result_value2['attendance_status'] == 'pulang') {
            $totalpulang++;
        } else if ($temp_result_value2['attendance_status'] == 'awal') {
            $totalawal++;
        /*} else if (($temp_result_value2['attendance_status'] == 'Exception') && ($temp_result_value2['exception_type'] == 'sakit'))  {
            $totalsakit++;
        } else if (($temp_result_value2['attendance_status'] == 'Exception') && ($temp_result_value2['exception_type'] == 'ijin'))  {
            $totalijin++;
        } else if (($temp_result_value2['attendance_status'] == 'Exception') && ($temp_result_value2['exception_type'] == 'cuti'))  {
            $totalcuti++;
            */
        }
        # code...
    }
}


$attendance_data_provider = new ArrayDataProvider([
    'allModels' => $temp_result,
    'pagination' => [
        'pageSize' => -1,
    ],
    'sort' => [
        //'attributes' => ['id', 'name'],
    ],
]);


$workhour_column = [];


$workhour_columns = [
         //   ['class' => 'yii\grid\SerialColumn'],

[
    'label' => 'date',
    'value' => function($model, $key, $index, $column)
    {
        return $key;
    }
],
          
            ];




foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {

        array_push($workhour_columns, [
            'label' => 'time' . $workhour_id_list_key,
                       'attribute' => $workhour_id_list_key,
    'value' => function($data,$key, $index, $column) {
                if (sizeof($data) > 0)
                {
                  
        
                          if(array_key_exists($column->attribute,$data))
                          {
                            if ($data[$column->attribute]['attendance_status'] != 'ABSENT') {
                                 return $data[$column->attribute]['time'];
                             } else {
                                 //return $data[$column->attribute]['time'];
                                 return '';
                             }
                            
                         } else {
                            
                             return '';
                         }

                               
                } else {
                    return '';
                }

        
    }
]);

        
    array_push($workhour_columns, [
            'label' => 'status',
            'attribute' => $workhour_id_list_key,
    'value' => function($data,$key, $index, $column) use (&$totalcuti){
                if (sizeof($data) > 0)
                {
                        //$this->addCuti();
                    $totalcuti = 8;
                          if(array_key_exists($column->attribute,$data))
                          {
                            if ($data[$column->attribute]['attendance_status'] != 'ABSENT') {
                                 return $data[$column->attribute]['attendance_status'];
                             } else {
                                 return $data[$column->attribute]['attendance_status'];
                             }
                         } else {
                             return '';
                         }
                } else {
                    return '';
                }
                    },
               //     'footer' => $totalcuti,
                ]);


    array_push($workhour_columns, [
            'label' => 'exception',
                  'attribute' => $workhour_id_list_key,
    'value' => function($data,$key, $index, $column) use(&$exception_array2){
                if (sizeof($data) > 0)
                {
                          if(array_key_exists($column->attribute,$data))
                          {
                            if ($data[$column->attribute]['attendance_status'] != 'Exception') {
                                // return $data[$column->attribute]['attendance_status'];
                                return '';
                             } else {
                               // return '';
                                return $exception_array2[$key]['exception_type'];
                                 //return $data[$column->attribute]['attendance_status'];
                             }
                         } else {  
                             return '';
                         }     
                } else {
                    return '';
                }
                    }
                ]);

                array_push($workhour_columns, [
            'label' => 'selisih waktu',
                       'attribute' => $workhour_id_list_key,
    'value' => function($data,$key, $index, $column) {
        
                        if (sizeof($data) > 0)
                {
                                            if(array_key_exists($column->attribute,$data))
                          {
                            if ($data[$column->attribute]['attendance_status'] != 'ABSENT') {
                              $workhour = workhour::findOne($column->attribute);

if(is_null($data[$column->attribute]['time'])) {
    return null;
} else {

                              $time1 = new DateTime($data[$column->attribute]['time']);
                            $time2 = new DateTime($workhour->ontime);
                              $interval = $time2->diff($time1);
                            return $interval->format('%I minutes');  
}

                             } else {
                                 return '';
                             }
                         } else {
                             return '';
                         }
                } else {
                    return '';
                }
        
    }
]);

}





//array_push($workhour_columns,   ['label' => 'exception', 'value' => ' ']);
//array_push($workhour_columns,   ['class' => 'yii\grid\ActionColumn']);
//echo '<hr/><hr/>';
//print_r($exception_array);

echo GridView::widget([
        'dataProvider' => $attendance_data_provider,
       // 'filterModel' => $searchModel,
                  'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> '.$rawsearch->pin.' ABSENSI</h3>',
        //'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false,
        'footer' => '<h3 class="panel-title"> Masuk : '.$totalmasuk.' -- telat : ' . $totaltelat . '</h3>
<h3 class="panel-title"> Pulang : '.$totalpulang.' -- awal : ' . $totalawal . '</h3>
<h3 class="panel-title"> Alpa : '.($totalalpa / 2).' </h3>
<h3 class="panel-title"> Sakit : '.$totalsakit.' </h3>
<h3 class="panel-title"> Ijin : '.$totalijin.' </h3>
<h3 class="panel-title"> Cuti : '.$totalcuti.' </h3>

        ',
    ],
        'columns' => $workhour_columns,
        //'showFooter' => true,
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
        'filename' => Yii::t('app', 'grid-export-reno'),
        'alertMsg' => Yii::t('app', 'The PDF export file will be generated for download.'),
        'options' => ['title' => Yii::t('app', 'Portable Document Format')],
        'mime' => 'application/pdf',
        'config' => [
            'mode' => 'c',
            'format' => 'A4-L',
            'destination' => 'D',
            'marginTop' => 20,
            'marginBottom' => 20,
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
            'options' => [
                'title' => 'export',
                'subject' => Yii::t('app', 'PDF export generated by kartik-v/yii2-grid extension'),
                'keywords' => Yii::t('app', 'krajee, grid, export, yii2-grid, pdf')
            ],
            'contentBefore'=>'',
            'contentAfter'=>'<h3 class="panel-title"> Masuk : '.$totalmasuk.' -- telat : ' . $totaltelat . '</h3>
<h3 class="panel-title"> Pulang : '.$totalpulang.' -- awal : ' . $totalawal . '</h3>
<h3 class="panel-title"> Alpa : '.($totalalpa / 2).' </h3>
<h3 class="panel-title"> Sakit : '.$totalsakit.' </h3>
<h3 class="panel-title"> Ijin : '.$totalijin.' </h3>
<h3 class="panel-title"> Cuti : '.$totalcuti.' </h3>

        '
        ]
    ],

    ],

    ]);















/*
echo '<pre>';

echo '<br/>';
echo 'masuk : ' . $totalmasuk . ' -- telat : ' . $totaltelat;
echo '<br/>';
echo 'pulang : ' . $totalpulang . ' --- awal : ' . $totalawal;
echo '<br/>';
echo 'alpa : ' . $totalalpa / 2;
echo '<br/>';
echo 'sakit : ' . $totalsakit;
echo '<br/>';
echo 'ijin : ' . $totalijin;

print_r($exception_array);

*/
?>
