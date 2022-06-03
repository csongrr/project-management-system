<?php 
if(!isset($_GET['folder'])){
?>

<div class="row ">
    <div class="col-sm-6">
        <div class="card text-center">
            <div class="card-body open-card">
                <h5 class="card-title m-3">Nyitott projektek</h5>
                <p class="card-text m-2">Az összes új és nyitott projekt.</p>
                <a href="index.php?module=folders&folder=open" class="btn btn-primary m-2">Megnyitás</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-center ">
            <div class="card-body closed-card">
                <h5 class="card-title m-3">Lezárt projektek</h5>
                <p class="card-text m-2">Eddigi kész projektek egy helyen.</p>
                <a href="index.php?module=folders&folder=closed" class="btn btn-primary m-2">Megnyitás</a>
            </div>
        </div>
    </div>
</div>
<?php
}elseif(isset($_GET['folder'])){
if($_GET['folder']== "open") $open= 1; else $open=0;
?>
<div class="row justify-content-center">
    <h1 class="text-center mb-3"><?php echo $open == 1 ? 'Nyitott Projektek'  : 'Lezárt Projektek'?></h1>
    <table class="table">
        <thead class="thead-dark">
            <th>id</th>
            <th>Név</th>
            <th>Tervezett kezdés</th>
            <th>Tervezett befejezés</th>
            <?php if($_SESSION['permission']== 3 || $_SESSION['permission']==2){
                        echo '<th>Költség</th>';}?>
        </thead>
        <tbody>
            <?php
            $result = $project->findBy($db,'open',$open);
        while ($folderproject = mysqli_fetch_assoc($result)){
        $url = 'index.php?module=projects&id=' . $folderproject['id'];
        ?>
            <tr>
                <td><?php echo $folderproject['id']?></td>
                <td><?php echo $folderproject['name']?></td>
                <td><?php echo $folderproject['planned_start']?></td>
                <td><?php echo $folderproject['planned_end']?></td>
                <?php if($_SESSION['permission']== 3 || $_SESSION['permission']==2){
                        echo '
                <td> '.$folderproject['cost'].'</td>';}?>
                <td class="text-end">
                    <div class="btn-group" role="group" data-toggle="buttons">
                        <button type="button" class="btn btn-primary">
                            <a href="<?php echo $url ?>&action=view" class="fa fa-eye"></a>
                        </button>
                        <?php if($_SESSION['permission']== 3 || $_SESSION['permission']==2){
                        echo '
                        <button type="button" class="btn btn-warning">
                            <a href="'.$url.'&action=edit" class="fa fa-edit"></a>
                        </button>
                        <button type="button" class="btn btn-danger">
                            <a href="'.$url.'&action=delete" class="fa fa-trash"></a>
                        </button>';}?>
                    </div>
                </td>
            </tr>
<?php
}
?>
        </tbody>
    </table>
</div>
<?php
}
?>