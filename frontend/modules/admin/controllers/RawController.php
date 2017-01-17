<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Raw;
use app\models\RawSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\data\Sort;

/**
 * RawController implements the CRUD actions for Raw model.
 */
class RawController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Raw models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RawSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        //$sort = new Sort


$dataProvider->setSort([
    'attributes' => [
        'pin',
        'datetime' => [
            'asc' => ['datetime' => SORT_ASC],
            'desc' => ['datetime' => SORT_DESC],
            'default' => SORT_DESC,
            'label' => 'Datetime',
        ],
    ],
    'defaultOrder' => ['datetime' => SORT_DESC],
    'params' => [
    //'datetime' => SORT_DESC,
    ],
]);
//echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><pre>';
//print_r($dataProvider->sort);




        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Raw model.
     * @param string $pin
     * @param string $datetime
     * @param string $verified
     * @param string $status
     * @param string $workcode
     * @return mixed
     */
    public function actionView($pin, $datetime, $verified, $status, $workcode)
    {
        return $this->render('view', [
            'model' => $this->findModel($pin, $datetime, $verified, $status, $workcode),
        ]);
    }

    /**
     * Creates a new Raw model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Raw();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pin' => $model->pin, 'datetime' => $model->datetime, 'verified' => $model->verified, 'status' => $model->status, 'workcode' => $model->workcode]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Raw model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $pin
     * @param string $datetime
     * @param string $verified
     * @param string $status
     * @param string $workcode
     * @return mixed
     */
    public function actionUpdate($pin, $datetime, $verified, $status, $workcode)
    {
        $model = $this->findModel($pin, $datetime, $verified, $status, $workcode);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'pin' => $model->pin, 'datetime' => $model->datetime, 'verified' => $model->verified, 'status' => $model->status, 'workcode' => $model->workcode]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Raw model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $pin
     * @param string $datetime
     * @param string $verified
     * @param string $status
     * @param string $workcode
     * @return mixed
     */
    public function actionDelete($pin, $datetime, $verified, $status, $workcode)
    {
        $this->findModel($pin, $datetime, $verified, $status, $workcode)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Raw model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $pin
     * @param string $datetime
     * @param string $verified
     * @param string $status
     * @param string $workcode
     * @return Raw the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($pin, $datetime, $verified, $status, $workcode)
    {
        if (($model = Raw::findOne(['pin' => $pin, 'datetime' => $datetime, 'verified' => $verified, 'status' => $status, 'workcode' => $workcode])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
