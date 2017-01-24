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
/*

[
    'label' => 'Masuk Shift malam',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
            $retvaluejamdatang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                                  if(array_key_exists($workhour_id_list_key,$data))
                          {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                             }
                         } else {  
                          //   return 'ew';
                         }
                        }           
                } else {
                   // return '';
                }

   return $retvaluejamdatang;
    }
],

         [
            'label' => 'selisih waktu',

    'value' => function($data,$key, $index, $column) use ($workhour_id_list) 
    {
        $retvalueselisihwaktu = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                                            if(array_key_exists($workhour_id_list_key,$data))
                          {
                            if ($data[$workhour_id_list_key]['attendance_status'] != 'ABSENT') {
                              $workhour = workhour::findOne($workhour_id_list_key);

if(is_null($data[$workhour_id_list_key]['time'])) {
    //return null;
} else {

                              $time1 = new DateTime($data[$workhour_id_list_key]['time']);
                            $time2 = new DateTime($workhour->ontime);
                              $interval = $time2->diff($time1);
                              if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                $retvalueselisihwaktu =  $interval->format('%H hours %I minutes');  
                              } else  if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
$retvalueselisihwaktu =  $interval->format('%H hours %I minutes');  
                              } else {
                              //  return '';
                              }
                              ;
                            //
}

                             } else {
                              //   return '';
                             }
                         } else {
                       //      return '';
                         }
     }           
                } else {
                 //   return '';
                }
        return $retvalueselisihwaktu;
    }
],


[
    'label' => 'Pulang shift malam',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
    $retvaluejampulang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                                  if(array_key_exists($workhour_id_list_key,$data))
                          {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'pulang') {
                                 $retvaluejampulang =  $data[$workhour_id_list_key]['time'];
                             }
                         } else {  
                       //      return '';
                         }
     }           
                } else {
                   // return '';
                }
   return $retvaluejampulang;
    }
],

*/

];







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

'<h3 class="panel-title"> Shift : '.floor(($totalmasuk + $totaltelat) / 2) . '</h3>
<h3 class="panel-title"> Hadir : '.$totalhadir.' hari</h3>
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
            'format' => 'A4-P',
            'destination' => 'D',
            'marginTop' => 5,
            'marginBottom' => 5,
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
                'contentBefore'=>'<h3 class="panel-title"> Periode : '.$rawsearch->from_date . ' - ' . $rawsearch->to_date .' -- Hari kerja : ' .  floor(($totalhadir + $totalsakit + $totalcuti + $totalijin + floor($totalalpa/2))) . ' hari </h3>
    <h3 class="panel-title"> PIN : ' . $rawsearch->pin . ' -- Nama : ' . $nama . '</h3>',

                'contentAfter'=>($role->id != 4)?'<h3 class="panel-title"> Masuk : '.$totalmasuk.' -- telat : ' . $totaltelat . '</h3>
<h3 class="panel-title"> Pulang : '.$totalpulang.' -- awal : ' . $totalawal . '</h3>
<h3 class="panel-title"> Hadir : '.$totalhadir.' </h3>
<h3 class="panel-title"> Alpa : '.($totalalpa / 2).' </h3>
<h3 class="panel-title"> Sakit : '.$totalsakit.' </h3>
<h3 class="panel-title"> Ijin : '.$totalijin.' </h3>
<h3 class="panel-title"> Cuti : '.$totalcuti.' </h3>'

:

'<h3 class="panel-title"> Shift : '.floor(($totalmasuk + $totaltelat) / 2) . '</h3>
<h3 class="panel-title"> Hadir : '.$totalhadir.' </h3>
<h3 class="panel-title"> Sakit : '.$totalsakit.' </h3>
<h3 class="panel-title"> Ijin : '.$totalijin.' </h3>
<h3 class="panel-title"> Cuti : '.$totalcuti.' </h3>'
        ]
    ],

    ],

    ]);















if ($role->id == 4) {

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
} else {



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
echo '<br/>';
echo 'hadir : ' . $totalhadir;
echo '<br/>';

}


//print_r($workhour_id_list);
//print_r($temp_result);
//print_r($exception_array2);
//echo sizeof($workhour_id_list);
?>