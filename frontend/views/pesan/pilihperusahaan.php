<?php
use app\models\Proyek;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Pilih Proyek!</h1>

        <?php
//echo sizeof($projects);

$projects = Proyek::find()->All();
foreach($projects as $project){

 echo '<p><a class="btn btn-default" href="'. Url::toRoute(['pesan/daftarpesan?' . 'proyek_id=' . $project->id]) . '" >'.$project->nama_proyek.' &raquo;</a></p>';

}

        
?>
<?php    
    echo '<br/>';
 //echo '<p><a class="btn btn-success" href="'. Url::toRoute(['sigproject/create']) . '" >Tambah PT &raquo;</a></p>';

?>




    </div>


</div>
