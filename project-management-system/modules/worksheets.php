<?php

$action = $_GET['action'];
if($action == 'view'){
    $worksheets->findSet($db,$_GET['id']);
    $project->findSet($db,$_GET['pid']);
?>
<div class="row justify-content-center">
    <div class="card worksheetcard col-10 p-0">
        <div class="card-header">
            <h3 class="mb-0"><?php echo $worksheets->name ?></h3>
            <p class="szerzo">Szerző: <?php echo $worksheets->getCreator($db,$worksheets->id) ?></p>
        </div>
        <div class="card-body justify-content-center text-center">
            <div class="row mb-2 line">
                <div class="col-6 text-start">
                    <h6>Projekt neve:</h6>
                    <p><?php echo $project->name?></p>
                </div>
                <div class="col-6 text-end">
                    <h6>Munkaóra:</h6>
                    <p><?php echo $worksheets->worktime?></p>
                </div>
            </div>
            <h5 class="card-title">Leírás:</h5>
            <p class="card-text"><?php echo $worksheets->details ?></p>
            <a href="<?php echo 'index.php?module=projects&id='.$_GET['pid'].'&action=view' ?>"
                class="btn btn-primary">Vissza</a>
        </div>
    </div>
</div>


<?php }elseif($action == 'edit' || $action=='new'){ ?>
<form action="index.php?module=addwork<?php echo '&pid='.$_GET['pid'].'&action='.$action?>" method="POST" class="row justify-content-center">
    <div class="input-group form-row m-3 justify-content-center">
        <?php if(isset($_GET['id'])){
            $worksheets->findSet($db,$_GET['id']);
            ?>
            
        <input type="hidden" name="id" value="<?php echo $worksheets->id?>"></input>
        <?php
    }?>
        <div class="form-group col-4 m-2">
            <label>Név:</label>
            <input type="text" class="form-control col-5" name="name"
                value="<?php echo isset($_GET['id'])!= ''? $worksheets->name : ''?>"></input>
        </div>
        <div class="form-group col-4 m-2">
            <label >Munkaóra:</label>
            <input type="number" class="form-control col-5" name="worktime"
                value="<?php echo isset($_GET['id'])!= ''? $worksheets->worktime : ''?>"></input>
        </div>
    </div>
    <div class="col-8 m-3">
        <label>Leírás:</label>
        <textarea rows="6" class="form-control" name="details"><?php echo isset($_GET['id'])!= ''? $worksheets->details : ''?></textarea>
    </div>
    <input type="submit" name="submit" value="<?php if(isset($_GET['id']) && $_GET['action']== 'edit'){
                                                    echo "Módosít";
                                                    }else{echo "Hozzáad";} ?>" class="btn btn-success col-5"></input>
</form>
<?php }elseif($action =='delete'){
$worksheets->deleteWork($db,$_GET['id']);
header("Location: index.php?module=projects&id=".$_GET['pid']."&action=view");
}
 ?>