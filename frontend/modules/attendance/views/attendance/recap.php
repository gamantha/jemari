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
use app\modules\attendance\models\ExtraAttendance;

use yii\data\ArrayDataProvider;


use kartik\mpdf\Pdf;


/* @var $this yii\web\View */
/* @var $model app\models\Raw */
/* @var $form yii\widgets\ActiveForm */






?>

<div class="raw-form">









        <?php $form = ActiveForm::begin(); ?>


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

$role = '';
$nama = '';
echo GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,

          'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i>Raw</h3>',
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



$days = array(
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    4 => 'Thursday',
    5 => 'Friday',
    6 => 'Saturday',
    0 => 'Sunday'
);




$recap_array = [];

$role = new ScheduleSet();

$pin = '';

$pins = Employee::find()->andWhere(['status' => 'active'])->All();

foreach ($pins as $pins_key => $pins_value)
{

$attendance_array = [];
$attendance_array_yii = [];
$exception_array = [];

    $totalcuti = 0;
$totaltelat = 0;
$totalsakit = 0;
$totalmasuk = 0;
$totalalpa = 0;
$totalijin = 0;
$totalawal = 0;
$totalpulang = 0;
$totalawal = 0;

$totallibur = 0;
$totalhadir = 0;


$pin = $pins_value->pin;
    $employee = Employee::find()
    ->andWhere(['pin' => $pin])
    ->andWhere(['status' => 'active'])
    ->One();
    //print_r($employee);
    if (!is_null($employee)) {


        $profil_karyawan = TbKaryawan::find()->andWhere(['PIN' => $pin])->One();
        if (isset($profil_karyawan)) {
            $nama = $profil_karyawan->Nama;
        }

        $schedules = EmployeeSchedule::find()
        ->andWhere(['employee_id' => $employee->id])
            ->andWhere(['status' => 'active'])
            ->orderBy(['order' => SORT_ASC])
        ->All();

        $schedule_array = [];
        foreach ($schedules as $key => $value) {
            $role = ScheduleSet::findOne($value->schedule_set_id);
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
$datecounter2 = new DateTime($rawsearch->from_date);

$endcounter = new DateTime($rawsearch->to_date);



while ($datecounter <= $endcounter)
{
$temp_exception_array = [];
$rawsofday = Raw::find()
->andWhere(['pin' => $pin])
//->andWhere(['in', 'hardware_id',[$rawsearch->hardware_id]])
->andWhere(['between', 'datetime',$datecounter->format("Y-m-d"), $datecounter->modify('+1 day')->format("Y-m-d")])
->All();
$attendance_array[$datecounter->modify('-1 day')->format("Y-m-d")] = $rawsofday;

    
    $exceptions =  ScheduleException::find()
                    //->andWhere(['employee_id' => $employee->id])
                    ->andWhere(['in', 'employee_id',[$employee->id,0]])
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
                                                                    'raw_status' => $rawofdayvalue->status,
                                                                'time' => $time,
                                                                'attendance_status' => $sched_item_value->workhour->pretime_value,

                                                                ]);
                                                        } else {
                                                          //  $attendance_array[$dateday]['attendance'][$sched_item_value->workhour->id][$sched_item_value->workhour->posttime_value] = $time;
                                                            array_push($attendance_array_yii, ['date' => $dateday, 'workhour_id' => $sched_item_value->workhour->id,
                                                                'optional' => $sched_item_value->optional,
                                                                'time' => $time,
                                                                 'raw_status' => $rawofdayvalue->status,
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

                                                 if(array_key_exists($datecounter->format("Y-m-d"),$temp_exception_array_transformed))
                                                 {
                                                //if (is_null($temp_exception_array_transformed[])){
                                                    $status2 = 'Exception';
                                                } else {
                                                    $status2 = 'ABSENT';
                                                }

                                           
                                                             array_push($attendance_array_yii, ['date' => $datecounter->format("Y-m-d"), 
                                                                'workhour_id' => $sched_item_value->workhour->id, 
                                                                'optional' => $sched_item_value->optional,
                                                                 'raw_status' => null,
                                                                'time' => null,
                                                                'attendance_status' => ($sched_item_value->optional == 'true') ? null : $status2,


                                                                ]);


                                                }
                                            } else {

                              array_push($attendance_array_yii, ['date' => $datecounter->format("Y-m-d"), 
                                //'workhour_id' => 'none', 
                                'optional' => 'none',
                                    'time' => null,
                                     'raw_status' => null,
                                     'attendance_status' => 'none',
                                                                
                                ]);
                                            }
                                    }

                            }
                            
$datecounter->modify('+1 day');
}






$final_attendance_array = [];
$final_exception_array = [];
$temp_result_value2 = [];



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
    $hadir = 0;
    //echo $temp_result_key;
    //echo '<hr/>';
    foreach ($temp_result_value as $temp_result_key2 => $temp_result_value2) {
        if ($temp_result_value2['attendance_status'] == 'telat') {
             $hadir = 1;
            $totaltelat++;
        } else if ($temp_result_value2['attendance_status'] == 'ABSENT') {
            $totalalpa++;
        } else if ($temp_result_value2['attendance_status'] == 'masuk') {
               $hadir = 1;
            $totalmasuk++;
        } else if ($temp_result_value2['attendance_status'] == 'pulang') {
             $hadir = 1;
            $totalpulang++;
        } else if ($temp_result_value2['attendance_status'] == 'awal') {
             $hadir = 1;
            $totalawal++;
        /*} else if (($temp_result_value2['attendance_status'] == 'Exception') && ($temp_result_value2['exception_type'] == 'sakit'))  {
            $totalsakit++;
        } else if (($temp_result_value2['attendance_status'] == 'Exception') && ($temp_result_value2['exception_type'] == 'ijin'))  {
            $totalijin++;
        } else if (($temp_result_value2['attendance_status'] == 'Exception') && ($temp_result_value2['exception_type'] == 'cuti'))  {
            $totalcuti++;
            */
        } else if ($temp_result_value2['attendance_status'] == 'libur') {
            $totallibur++;
        }
        # code...
    }

    $totalhadir = $totalhadir + $hadir;
}

$offset = 0;

                         if(isset($temp_result[$rawsearch->from_date]['3']['raw_status']))
                         {
                          if($temp_result[$rawsearch->from_date]['3']['raw_status'] == '1'){


                          $offset = 1;
                        }
                         }


$empl = Employee::find()->andWhere(['pin' => $pin])->andWhere(['status' => 'active'])->One();
$empl_sched = EmployeeSchedule::find()->andWhere(['employee_id' => $empl->id])->andWhere(['status' => 'active'])->One();
if(isset($empl_sched)) {
if ($empl_sched->schedule_set_id == '4'){
    $totalhadir = ceil(($totalmasuk + $totaltelat - $offset) / 2);
//$totalhadir = 0;
}
}

$recap_array[$pin]['nama'] = $nama;
//echo ' : ';
 $recap_array[$pin]['kehadiran'] = $totalhadir;
//echo '<br/>';
$recap_array[$pin]['cuti'] = $totalcuti;
$recap_array[$pin]['ijin'] = $totalijin;
$recap_array[$pin]['sakit'] = $totalsakit;
$recap_array[$pin]['alpa'] = floor($totalalpa/2);
}


$extra_attendances = ExtraAttendance::find()
->andWhere(['between', 'datetime',$datecounter2->format("Y-m-d"), $endcounter->format("Y-m-d")])
->andWhere(['status' => 'active'])
->All();


foreach ($extra_attendances as $extra_attendances_key => $extra_attendances_value) {
    $nama_extra = '';
            $profil_extra = TbKaryawan::find()->andWhere(['PIN' => $extra_attendances_value->nik])->One();
        if (isset($profil_extra)) {
            $nama_extra = $profil_extra->Nama;
           // echo 'yte';
        } else {
           // echo 'lkl';
        }


    $recap_array[$extra_attendances_value->nik]['nama'] = $nama_extra;
$recap_array[$extra_attendances_value->nik]['kehadiran'] = $extra_attendances_value->kehadiran;
$recap_array[$extra_attendances_value->nik]['cuti'] = $extra_attendances_value->cuti;
$recap_array[$extra_attendances_value->nik]['ijin'] = $extra_attendances_value->ijin;
$recap_array[$extra_attendances_value->nik]['sakit'] = $extra_attendances_value->sakit;
$recap_array[$extra_attendances_value->nik]['alpa'] = floor($extra_attendances_value->alpa / 2);
}

unset($recap_array[0]);


$recap_data_provider = new ArrayDataProvider([
    'allModels' => $recap_array,
    'pagination' => [
        'pageSize' => -1,
    ],
    'sort' => [
        //'attributes' => ['id', 'name'],
    ],
]);

echo GridView::widget([
        'dataProvider' => $recap_data_provider,
       // 'filterModel' => $searchModel,
                  'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i> RECAP </h3>',
        //'type'=>'success',
        //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        //'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        //'footer'=>false,
    ],
        'columns' => [
        [
            'label' => 'NIK',
            'value' => function($data,$key,$index, $column) {
                return $key;
            }
        ],
        'nama',
        'kehadiran',
        'cuti',
        'ijin',
        'sakit',
        'alpa',
        ],
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
        'filename' => Yii::t('app', 'export-recap-absensi'),
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
                'contentBefore'=>'<h1>Rekap Absensi</h1><h3 class="panel-title"> Periode : '.$rawsearch->from_date . ' - ' . $rawsearch->to_date .' </h3>',
        ]
    ],

    ],





    ]);



//echo '<pre>';
//print_r($recap_array);
?>
