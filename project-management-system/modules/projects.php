<div class="row justify-content-center">
<?php 
$action = $_GET['action'] ?? 'list';
if($action == 'list'){
    if($_SESSION['permission']== 3 || $_SESSION['permisison']= 2){?>
        <a href="index.php?module=projects&action=newproject" class="btn btn-primary col-4 fas fa-plus"> Új projekt</a>
    <?php }
    
?>
    <table class="table">
        <thead class="thead-dark">
            <th>id</th>
            <th>Név</th>
            <th>Tervezett kezdés</th>
            <th>Tervezett befejezés</th>
            <th>Állapot</th>
            <thead>
                </th>
            </thead>
        <tbody>
            <?php
                $result = $project->all($db);
                while ($projects = mysqli_fetch_assoc($result)){
                    $url = 'index.php?module=projects&id=' . $projects['id'];
                ?>
            <tr>
                <td><?php echo $projects['id']?></td>
                <td><?php echo $projects['name']?></td>
                <td><?php echo $projects['planned_start']?></td>
                <td><?php echo $projects['planned_end']?></td>
                <td><?php echo $projects['open']== 1? 'Nyitott' : 'Lezárt'?></td>
                <td class="text-end">
                    <div class="btn-group" role="group" data-toggle="buttons">
                            <a href="<?php echo $url?>&action=view" class="btn btn-primary fa fa-eye"></a>
                            <a href="<?php echo $url?>&action=edit" class="btn btn-warning fa fa-edit"></a>
                            <a href="<?php echo $url?>&action=delete" class="btn btn-danger fa fa-trash" onclick="return confirm(`Biztos törli?`)"></a>
                    </div>
                </td>
            </tr>
            <?php };?>
        </tbody>
    </table>
</div>



<?php }elseif ($action == 'view'){
     $project->findSet($db,$_GET['id']);
    ?>
<div class="card h-100">
    <h4 class="card-header "><?php echo $project->id. ' - ' . $project->name?></h4>
    <div class="card-body row">
        <div class="col-6">
            <h5>Projekt kezdete:</h5>
            <p><?php echo $project->planned_start?></p>
            <h5>Tervezett befejezés: </h5>
            <p><?php echo $project->planned_end?></p>

        </div>
        <div class="col-6">
            <h5>Költség: </h5>
            <p><?php echo $project->cost?> €</p>
            <h5>Leírás:</h5>
            <p><?php echo $project->description?></p>
        </div>
        <div class="text-center">
        <a href="index.php?module=worksheets&pid=<?php echo $project->id ?>&action=new" class="btn btn-primary col-4">Elvégzett feladat hozzáadása</a>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <th>Név</th>
                <th>Létrehozás dátuma</th>
                <th>Munkaidő</th>
                <th>Szerkesztő</th>
            </thead>
            <tbody>
                <?php
                
                $result = $worksheets->all($db,$_GET['id']);
               
                while ($work = mysqli_fetch_assoc($result)){
                    $url = 'index.php?module=worksheets&pid='.$project->id.'&id=' . $work['id'];
                ?>
                <tr>
                    <td><?php echo $work['workname']?></td>
                    <td><?php echo $work['date']?></td>
                    <td><?php echo $work['worktime']?></td>
                    <td><?php echo $work['name']?></td>
                    <td class="text-end">
                        <div class="btn-group" role="group" data-toggle="buttons">
                                <a href="<?php echo $url ?>&action=view" class="btn btn-primary fa fa-eye"></a>
                            <?php if($_SESSION['permission']=='2' || $_SESSION['permission']=='3'|| $work['uid']==$_SESSION['id']){?>
                                <a href="<?php echo $url ?>&action=edit" class="btn btn-warning fa fa-edit"></a>
                                <a href="<?php echo $url ?>&action=delete" class="btn btn-danger fa fa-trash" onclick="return confirm(`Biztos törli?`)"></a>
                            <?php ;}?>
                        </div>
                    </td>
                </tr>
                <?php };?>
            </tbody>
        </table>
    </div>
</div>
<?php
}elseif($action == "edit"){
    $project->findSet($db,$_GET['id']);
    ?>
    <form action="index.php?module=edit_project" method="POST" class="row justify-content-center text-center">
    <input type="hidden" name="id" value="<?php echo $project->id?>">
    <h4 class="mt-2"><?php echo $project->name?></h4>
    <div class="col-4 m-3">
    <label class="mt-2"><h5>Kezdés: </h5></label>
        <input type="date" class="form-control" value="<?php echo $project->planned_start?>" name="planned_start"></input>
    <label class="mt-2"><h5>Költség: </h5></label>
        <input type="text" class="form-control" value="<?php echo $project->cost?>"name="cost" ></input>
    </div>

    <div class="col-4 m-3">
    <label class="mt-2"><h5>Tervezett befejezés: </h5></label>
        <input type="date" class="form-control" value="<?php echo $project->planned_end?>"name="planned_end"></input>
    <label class="mt-2"><h5>Állapot: </h5></label>
        <select type="name" class="form-control" value="<?php echo $project->open?>" name="open">
            <option value="1">Nyitott</option>
            <option value="0">Lezárt</option>
        </select>
    </div>
    <div class="col-8">
        <label class="m-2"><h5>Leírás: </h5></label>
        <textarea name="description" class="form-control"><?php echo $project->description?></textarea>
    </div>
<input type="submit" name="submit" value="Módosít" class="btn btn-success col-5 mt-3"></input>
</form>



<?php
}elseif($action == "newproject"){ ?>
    <form action="index.php?module=newproject" method="POST" class="row justify-content-center text-center">

    <div class="col-4 m-2 mt-0">
    <label class="mt-2"><h5>Név: </h5></label>
        <input type="text" class="form-control" name="name" required></input>
        <label class="mt-2"><h5>Költség: </h5></label>
        <input type="text" class="form-control" name="cost" required></input>
    </div>
    
    <div class="col-4 m-2 mt-0">
        <label class="mt-2"><h5>Kezdés: </h5></label>
            <input type="date" class="form-control" name="planned_start" required></input>
    <label class="mt-2"><h5>Tervezett befejezés: </h5></label>
        <input type="date" class="form-control" name="planned_end" required></input>
    </div>
    <div class="col-8">
        <label class="m-2"><h5>Leírás: </h5></label>
        <textarea rows="5"name="description" class="form-control" required></textarea>
    </div>
<input type="submit" name="submit" value="Hozzáad" class="btn btn-success col-5 mt-3 mb-5"></input>
</form>
<?php
}elseif($action == "delete"){
    $project->DeleteProject($db,$_GET['id']);
} 
?>