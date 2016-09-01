<?php

namespace frontend\controllers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use app\models\Pesan;
use app\models\Proyek;
use app\models\Customer;
use app\models\PesanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PesanController implements the CRUD actions for Pesan model.
 */
class PesanController extends Controller
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
     * Lists all Pesan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PesanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDaftarpesanasi($id)
    {
        echo 'user nomer ' . $id;   
    }
    
    public function actionDaftarpesandamar($id)
    {
        echo 'user nomer ' . $id;   
    }
    
    public function actionDaftarpesan()
    {
        $daftarproyek = Customer::find()->asArray()->andWhere(['proyek_id' => $_GET['proyek_id']])->All();
        /*echo '<pre>';
        print_r($daftarproyek);
        echo '</pre>';*/
        $idproyek = ArrayHelper::getColumn($daftarproyek, 'id');
        
        //print_r($idproyek);
        
        $daftarpesans = Pesan::find()->andWhere(['in', 'id', $idproyek])
                                               ->andWhere(['in', 'status', ['recurring','undelivered']])->All();
        /*echo '<pre>';
        print_r($daftarpesan);
        echo '</pre>';*/
        
        foreach($daftarpesans as $daftarpesan) {
            echo 'customer : ' . $daftarpesan->customer_id . '<br>' .'isi pesan : ' . $daftarpesan->isi_pesan . '<br>';
        }
        
        Yii::$app->mailer->compose('home-link')
            ->setFrom('sanggarindah@gmail.com')
            ->setTo('me.arifrahman@gmail.com')
            ->setSubject('Tagihan')
            ->setTextBody('SUP BRO')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        
        
    }
    
    public function actionPilih()
    {
        return $this->render('pilihperusahaan');
    }

    /**
     * Displays a single Pesan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Pesan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pesan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pesan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pesan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pesan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pesan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pesan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
