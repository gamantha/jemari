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



$workhour_columns2 = [

[
    'label' => 'date',
    'value' => function($model, $key, $index, $column)
    {
        return $key;
    }
],

[
    'label' => 'Jam Datang',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list)
    {
            $retvaluejamdatang = '';
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                                  if(array_key_exists($workhour_id_list_key,$data))
                          {
                                     if ($data[$workhour_id_list_key]['raw_status'] == '0') {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                               // return '';
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'masuk') {
                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                             } else if ($data[$workhour_id_list_key]['attendance_status'] == 'telat') {
                                 $retvaluejamdatang =  $data[$workhour_id_list_key]['time'];
                             }
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
                                $retvalueselisihwaktu =  $interval->format('%H h %I m');  
                              } else  if ($data[$workhour_id_list_key]['attendance_status'] == 'awal') {
$retvalueselisihwaktu =  $interval->format('%H h %I m');  
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
    'label' => 'Jam Pulang',
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
[
    'label' => 'lama kerja',
    'value' => function($data, $key, $index, $column) use ($workhour_id_list) {



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

   //return $retvaluejamdatang;

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

                              $time1 = new DateTime($retvaluejamdatang);
                            $time2 = new DateTime($retvaluejampulang);
                              $interval = $time2->diff($time1);

                                          if (($retvaluejampulang == '') || ($retvaluejamdatang == '')){
        return '';
        }

        
return $interval->format('%H h %I m');  





    }
],


];


array_push($workhour_columns2,   ['label' => 'Cuti',  'footer' => $totalcuti,'value' => function($data,$key,$index,$column) use($exception_array2){
    if (array_key_exists($key, $exception_array2)) {
        if ($exception_array2[$key]['exception_type'] == 'cuti') {
               //return $exception_array2[$key]['exception_type']; 
            return '1';
           } else {
                       return '';
           }

    } else {
            return '';
    }

}]);

array_push($workhour_columns2,   ['label' => 'Ijin', 'footer' => $totalijin,'value' => function($data,$key,$index,$column) use($exception_array2){
    if (array_key_exists($key, $exception_array2)) {
        if ($exception_array2[$key]['exception_type'] == 'ijin') { return '1';} else { return '';}
    } else {return '';}}]);

array_push($workhour_columns2,   ['label' => 'Sakit',  'footer' => $totalsakit,'value' => function($data,$key,$index,$column) use($exception_array2){
    if (array_key_exists($key, $exception_array2)) {
        if ($exception_array2[$key]['exception_type'] == 'sakit') { return '1';} else { return '';}
    } else {return '';}}]);


array_push($workhour_columns2,   ['label' => 'Alpa',  'footer' => $totalalpa/2,'value' => function($data,$key,$index,$column) use($workhour_id_list){
        $retvalue1 = 0;
                        if (sizeof($data) > 0)
                {
     foreach ($workhour_id_list as $workhour_id_list_key => $workhour_id_list_value) {
                                  if(array_key_exists($workhour_id_list_key,$data))
                          {
                            if ($data[$workhour_id_list_key]['attendance_status'] == 'ABSENT') {
                                $retvalue1++;
                             } else {
                              //  return 'sasa';
                             }
                         } else {  
                            //return $workhour_id_list_key;
                            // return 'dada';
                         }
     }           
     return $retvalue1 ? '1' :  '';
                } else {
                    return '';
                }
   

}]);


array_push($workhour_columns2,   ['label' => 'Keterangan',  'value' => function($data,$key,$index,$column) use($exception_array2){
    if (array_key_exists($key, $exception_array2)) {
        //if ($exception_array2[$key]['exception_type'] == 'sakit') { return '1';} else { return '';}
        return $exception_array2[$key]['exception_reason'];
    } else {
         if (sizeof($data) > 0) {
   return '';
         } else {
            return 'LIBUR';
         }
     

    }}]);










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
        'columns' => $workhour_columns2,
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
                'contentBefore'=>'<h3 class="panel-title"> Periode : '.$rawsearch->from_date . ' - ' . $rawsearch->to_date .' -- Hari kerja : ' .  floor(($totalhadir + $totalsakit + $totalcuti + $totalijin + floor($totalalpa/2))) . ' hari </h3>
    <h3 class="panel-title"> PIN : ' . $rawsearch->pin . ' -- Nama : ' . $nama . '</h3>',

                'contentAfter'=>'<h3 class="panel-title">
<h3 class="panel-title"> Hadir : '.$totalhadir.' </h3>'

        ]
    ],

    ],

    ]);


?>