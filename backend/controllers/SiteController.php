<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */

include './inc/table.php';
include './inc/models.php';

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','tunggakan-list'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(){
        
        $connection = \Yii::$app->db;
        $sql = $connection->createCommand("SELECT SUM(a.nominal) nominal, 
                                                  c.keterangan, 
                                                  a.tahun_ajaran
                                          FROM v_tagihan_siswa_all a 
                                          JOIN kelas b ON a.kode_kelas = b.key_ 
                                          JOIN kategori c ON b.idkategori = c.idkategori
                                          GROUP BY c.keterangan");
        $model = $sql->queryAll();

        return $this->render('index',[
            'model'=>$model
        ]);
    }

    public function actionTunggakanList($thn,$grade){

        return $this->render('list-tagihan', [
            'arrFields' => AttributeListTunggakan(),                   
            'tahun' => $thn,                   
            'grade' => $grade,                   
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
