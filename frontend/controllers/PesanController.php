<?php

namespace frontend\controllers;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use app\models\Pesan;
use app\models\PesanPerproyek;
use app\models\Proyek;
use app\models\Customer;
use app\models\PesanSearch;
use app\models\CustomerSearch;
use app\models\BankAccount;
use app\models\ContactInfo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
      use yii\data\ActiveDataProvider;
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

        $idproyek = ArrayHelper::getColumn($daftarproyek, 'id');

        $daftarpesans = Pesan::find()->andWhere(['in', 'id', $idproyek])->andWhere(['in', 'status', ['recurring','undelivered']])->All();

        $idpesan = ArrayHelper::getColumn($daftarpesans, 'customer_id');
        $daftarcustomerinfos = ContactInfo::find()->andWhere(['in', 'customer_id', $daftarpesans])->All();
        
        /*echo '<pre>';
        print_r($daftarpesan);
        echo '</pre>';*/


        $result = count($daftarpesans);

        echo 'jumlah message untuk di send = ' . $result . '<br><br>';
            
        
        
        /*foreach($daftarpesans as $daftarpesan) {
            echo 'customer : ' . $daftarpesan->customer_id . '<br>' .'isi pesan : ' . $daftarpesan->isi_pesan . '<br>' . 'jumlah karakter : ' . strlen($daftarpesan->isi_pesan) . '<br><br>';
        }
        
        foreach($daftarcustomerinfos as $daftarcustomerinfo) {
            echo $daftarcustomerinfo->email;
        }*/
        /*
        foreach($daftarpesans as $pesan => $value1){
            $value2=$daftarcustomerinfos[$pesan];
            echo 'customer id : ' . $value1->customer_id . '<br>' . 'email : ' . $value2->email . '<br>' . 'nomer telfon : ' . $value2->sms . '<br>' . 'jumlah karakter : ' . strlen($value1->isi_pesan) . '<br>' . 'jumlah sms : ' . ceil(strlen($value1->isi_pesan) / 160) . '<br>' . 'isi pesan : ' . $value1->isi_pesan . '<br><br>' .
            Yii::$app->mailer->compose('home-link')
            ->setFrom('sanggarindah@gmail.com')
            ->setTo($value2->email)
            ->setSubject('Sanggar Indah Grup - Reminder')
            ->setTextBody('')
            ->setHtmlBody($value1->isi_pesan)
            ->send();
            
            $value1->status = 'delivered';
            $value1->save();
        }
        */
        
        
        /**/
        
        
        $total_sms_terpakai = 0;

        foreach($daftarpesans as $daftarpesan) {
         $contact = ContactInfo::find()->andWhere(['customer_id' => $daftarpesan->customer_id])->One();
            echo 'customer : ' . $daftarpesan->customer_id . '<br>' .'isi pesan : ' . $daftarpesan->isi_pesan . '<br>' . 'jumlah karakter : ' . strlen($daftarpesan->isi_pesan) .
            '<br>' . 'jumlah sms : ' . ceil(strlen($daftarpesan->isi_pesan) / 160) .
            '<br>' . 'email : ' . $contact->email .
            '<br>' . 'sms : ' . $contact->sms . '<br><br>';



            $total_sms_terpakai = $total_sms_terpakai + ceil(strlen($daftarpesan->isi_pesan) / 160);
        }

$sisa_sms = $this->actionChecksmscredit();
if ($sisa_sms >= $total_sms_terpakai) {


 $ch = curl_init();

 foreach($daftarpesans as $daftarpesan) {
  $contact = ContactInfo::find()->andWhere(['customer_id' => $daftarpesan->customer_id])->One();

  $userkey = "he75cu";
  $passkey = "sukahaji";
  $nohp = $contact->sms;

$bank_string ='';
$pesan_string = '';
$pesan_string = $daftarpesan->isi_pesan;
$banks = BankAccount::find()->andWhere(['customer_id' => $daftarpesan->customer_id])->All();
foreach ($banks as $bank) {
  $bank_string = $bank_string . ' ' .  $bank->bank_name . '/' . $bank->virtual_account_number;
}
//print_r($bank);
  
  $temp_pesan = str_replace('$bankaccount', $bank_string, $pesan_string);
  echo '<br/>';
  //
  //str_replace('uang','nina',$temp_pesan);
  //echo '<br/>temp pesan : ';
  //echo $temp_pesan;
  $pesan = urlencode($temp_pesan);



  $url = "http://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=$nohp&pesan=$pesan";
   echo $url;

  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  //$result = curl_exec($ch);
/**
DISINI YANG BELUM:
1. merubah undelivered jadi delivered
2. kirim email
*/
     
 }

   curl_close($ch);

 echo ' <br/><br/>sms telah di send<br/>';




} else {
 echo ' jumlah kredit sms tidak mencukupi<br/>';
}
        echo '==============================<br/>total sms terpakai = ' . $total_sms_terpakai;
        echo '<br/> kredit sms tersedia = '. $sisa_sms;
         echo '<br/> sisa sms setelah send= '. ($sisa_sms - $total_sms_terpakai);

        /*Yii::$app->mailer->compose('home-link')
            ->setFrom('sanggarindah@gmail.com')
            ->setTo('me.arifrahman@gmail.com')
            ->setSubject('Tagihan')
            ->setTextBody('SUP BRO')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();*/


    }

    public function actionPilih()
    {
        return $this->render('pilihperusahaan');
    }


    public function actionPilih2($id)
    {

        $total_sms_terpakai = 0;
            if($_POST) {
                echo '<br/><br/><br/><br/><br/><pre>';
//              print_r($_POST);
$pesan = $_POST['PesanPerproyek']['isi_pesan'];
           //   echo $pesan = $_POST['PesanPerproyek']['isi_pesan'];
              $users = isset($_POST['selection']) ? $_POST['selection'] : [];
              foreach ($users as $user) {
                # code...
              //  echo $user;



                         $contact = ContactInfo::find()->andWhere(['customer_id' => $user])->One();
                         $email = isset($contact->email) ? $contact->email : '';
                         //$sms = '';
                         $sms = isset($contact->sms) ? $contact->sms : '';
                         $bank_string ='';
$pesan_string = '';
$pesan_string = $pesan;
$banks = BankAccount::find()->andWhere(['customer_id' => $user])->All();
foreach ($banks as $bank) {
  $bank_string = $bank_string . ' ' .  $bank->bank_name . '/' . $bank->virtual_account_number;
}

  $temp_pesan = str_replace('$virtual_account_number', $bank_string, $pesan_string);
  $pesan2 = urlencode($temp_pesan);


            echo 'customer : ' . $user . '<br>' .'isi pesan : ' . $pesan . '<br>' . 'jumlah karakter : ' . strlen($temp_pesan) .
            '<br>' . 'jumlah sms : ' . ceil(strlen($pesan) / 160) .
            '<br>' . 'email : ' .  $email.
            '<br>' . 'sms : ' . $sms . '<br><br>';



            $total_sms_terpakai = $total_sms_terpakai + ceil(strlen($pesan) / 160);

              }




$sisa_sms = $this->actionChecksmscredit();
if ($sisa_sms >= $total_sms_terpakai) {


 $ch = curl_init();

$total_sms_terpakai = 0;
              foreach ($users as $user) {
                # code...
              //  echo $user;

  $userkey = "he75cu";
  $passkey = "sukahaji";

                         $contact = ContactInfo::find()->andWhere(['customer_id' => $user])->One();
                         //$email = '';
                         $email = isset($contact->email) ? $contact->email : '';
                         //$sms = '';
                         $sms = isset($contact->sms) ? $contact->sms : '';



$bank_string ='';
$pesan_string = '';
$pesan_string = $pesan;
$banks = BankAccount::find()->andWhere(['customer_id' => $user])->All();
foreach ($banks as $bank) {
  $bank_string = $bank_string . ' ' .  $bank->bank_name . '/' . $bank->virtual_account_number;
}

  $temp_pesan = str_replace('$virtual_account_number', $bank_string, $pesan_string);

  $pesan2 = urlencode($temp_pesan);



  $url = "http://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=$sms&pesan=$pesan2";

if(isset($contact->sms)) {
              $total_sms_terpakai = $total_sms_terpakai + ceil(strlen($temp_pesan) / 160);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $result = curl_exec($ch);

   echo '<br/>TERKIRIM : ';
           echo $url;
   } else {
       echo '<br/>TIDAK ADA SMS : ';
           echo $url;
   }
      $newpesanindividu = new Pesan();
      $newpesanindividu->isi_pesan = $temp_pesan;
      $newpesanindividu->customer_id = $user;
      $newpesanindividu->status = 'delivered';
      $newpesanindividu->save();

              }




   curl_close($ch);
 echo ' <br/><br/>sms telah di send<br/>';

 $newpesanproyek = new PesanPerproyek();
 $newpesanproyek->proyek_id = $id;
 $newpesanproyek->isi_pesan = $pesan_string . ' [' . date("Y/m/d"). ']';
 $newpesanproyek->status = 'delivered'; 
 $newpesanproyek->save();




} else {
 echo ' jumlah kredit sms tidak mencukupi<br/>';
}
        echo '==============================<br/>total sms terpakai = ' . $total_sms_terpakai;
        echo '<br/> kredit sms tersedia = '. $sisa_sms;
         echo '<br/> sisa sms setelah send= '. ($sisa_sms - $total_sms_terpakai);
























              echo '</pre>';
            } 


      $pesanproyek = new PesanPerproyek();

        $searchModel = new CustomerSearch();
        $params = Yii::$app->request->queryParams;
        $params['CustomerSearch']['proyek_id'] = $id;
        $dataProvider = $searchModel->search($params);


        return $this->render('pilih2', [
          'pesanproyek' => $pesanproyek,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);



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

    public function actionChecksmscredit(){

        $userkey = "he75cu";
        $passkey = "sukahaji";
        $url = "http://reguler.zenziva.net/apps/smsapibalance.php?userkey=$userkey&passkey=$passkey";



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        $xmlobj = simplexml_load_string($result);
        //print_r($result);
        return $xmlobj->message->value;

    }


    public function actionSendsms(){

        $userkey = "he75cu";
        $passkey = "sukahaji";
        $nohp = "0811913848";
        $pesan = "test";

        $ch = curl_init();

        for ($i = 0; $i <10; $i++) {

        $url = "http://reguler.zenziva.net/apps/smsapi.php?userkey=$userkey&passkey=$passkey&nohp=$nohp&pesan=test $i";
        echo $url;
        echo '<br/>';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);


        }

        curl_close($ch);


    }

}
