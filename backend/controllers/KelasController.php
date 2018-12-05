<?php

namespace backend\controllers;

use Yii;
use backend\models\Kelas;
use backend\models\KelasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KelasController implements the CRUD actions for Kelas model.
 */
class KelasController extends Controller
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
     * Lists all Kelas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kelas model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($kode, $idajaran, $idjurusan)
    {
        $model = Kelas::find()
                    ->Where(['kode'=>$kode])
                    ->AndWhere(['idajaran'=>$idajaran])
                    ->AndWhere(['idjurusan'=>$idjurusan])
                    ->One();           
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Kelas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kelas();

        if ($model->load(Yii::$app->request->post())){
            
            $model->save();
            return $this->redirect(['view', 'kode' => $model->kode , 'idajaran' => $model->idajaran , 'idjurusan' => $model->idjurusan]);            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Kelas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($kode, $idajaran, $idjurusan)
    {
        $model = Kelas::find()
                ->Where(['kode'=>$kode])
                ->AndWhere(['idajaran'=>$idajaran])
                ->AndWhere(['idjurusan'=>$idjurusan])
                ->One();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {            
            return $this->redirect(['view', 'kode' => $model->kode , 'idajaran' => $model->idajaran , 'idjurusan' => $model->idjurusan]);            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kelas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($kode, $idajaran, $idjurusan)
    {
        $model = Kelas::find()
                ->Where(['kode'=>$kode])
                ->AndWhere(['idajaran'=>$idajaran])
                ->AndWhere(['idjurusan'=>$idjurusan])
                ->One();

        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kelas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kelas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
