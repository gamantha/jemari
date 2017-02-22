<?php

namespace app\modules\attendance\controllers;

use app\models\Hardware;
use app\models\HardwareSearch;
use yii\data\ActiveDataProvider;

use app\models\Raw;
use app\models\RawSearch;
use yii\db\Query;

use Yii;

class AttendanceController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
$model = Raw::find()->andWhere(['pin' => '7004'])
            //->andWhere(['between', 'datetime', $post['from_date'], $post['to_date']])
                      ->andWhere(['between', 'datetime', "", "2016-12-10"])
            ->All();
print_r($model);
    }


    public function actionRecap()
    {
       $rawsearch = new RawSearch();
 $query =  RawSearch::find();

if (Yii::$app->request->post()) {

        if ($rawsearch->load(Yii::$app->request->post())){

            $query =  RawSearch::find()
            //->andWhere(['pin' => $rawsearch->pin])
            //->andWhere(['hardware_id' => $rawsearch->hardware_id])
            ->andWhere(['between', 'datetime', $rawsearch->from_date, $rawsearch->to_date]);

        } else {


        }

} else {

  //   echo '<br><br><br><br><br><br/><br/><br/>';
  //  echo '<br/><br/>POST';
//print_r($_REQUEST);
//echo '<pre>';
//print_r($rawsearch);
}

              
              $provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'defaultOrder' => [
            'datetime' => SORT_ASC,
            //'title' => SORT_ASC, 
        ]
    ],
]);


  return $this->render('recap', ['dataProvider' => $provider, 'rawsearch' => $rawsearch]);
    }

    public function actionSearch()
    {
       $rawsearch = new RawSearch();
 $query =  RawSearch::find();

if (Yii::$app->request->post()) {

        if ($rawsearch->load(Yii::$app->request->post())){

        
//echo '<br><br><br><br><br><br/><br/><br/>';
//print_r(Yii::$app->request->post());
//echo '<pre>';
//print_r($rawsearch);

//$datecounter = new DateTime($rawsearch->from_date);
//$endcounter = new DateTime($rawsearch->to_date);

if($rawsearch->hardware_id == 'all') {
                $query =  RawSearch::find()->andWhere(['pin' => $rawsearch->pin])
            //->andWhere(['hardware_id' => $rawsearch->hardware_id])
            ->andWhere(['between', 'datetime', $rawsearch->from_date, $rawsearch->to_date]);

} else {
            $query =  RawSearch::find()->andWhere(['pin' => $rawsearch->pin])
            ->andWhere(['hardware_id' => $rawsearch->hardware_id])
            ->andWhere(['between', 'datetime', $rawsearch->from_date, $rawsearch->to_date]);
                      //->andWhere(['between', 'datetime', $post['to_date'], $post['to_date']])
}

        } else {

/*

*/
        }

} else {

  //   echo '<br><br><br><br><br><br/><br/><br/>';
  //  echo '<br/><br/>POST';
//print_r($_REQUEST);
//echo '<pre>';
//print_r($rawsearch);
}

              
              $provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'defaultOrder' => [
            'datetime' => SORT_ASC,
            //'title' => SORT_ASC, 
        ]
    ],
]);


  return $this->render('search', ['dataProvider' => $provider, 'rawsearch' => $rawsearch]);
    }

}
