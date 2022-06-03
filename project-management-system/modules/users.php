<?php 
$action = $_GET['action'] ?? 'list';
if($action == 'list'){    
?>
<table class="table">
    <thead class="thead-dark">
        <th>Név</th>
        <th>E-mail cím</th>
        <th>Jogosultság</th>
        <?php if($_SESSION['permission']==3){
            echo '<th class="text-end"><button class="btn btn-primary"><a href="index.php?module=registration_form" class="reg">Regisztráció</a></button></th>';
        }?>
        <thead>
            </th>
        </thead>
    <tbody>
        <?php
        
$users = $user->list($db);
while ($user = mysqli_fetch_assoc($users)){
    $url = 'index.php?module=users&id=' . $user['id'];
    ?>

        <tr>
            <td><?php echo $user['name']?></td>
            <td><?php echo $user['email']?></td>
            <td><?php switch ($user['permission']) {
                            case 1:
                                echo "Munkatárs";
                                break;
                            case 2:
                                echo "Csoportvezető";
                                break;
                            case 3:
                                echo "Adminisztrátor";
                                break;};?>
            </td>
            <td class="text-end">
                <div class="btn-group" role="group" data-toggle="buttons">
                    <a href="<?php echo $url ?>&action=view" class="btn btn-primary fa fa-eye"></a>

                    <?php if($_SESSION['permission']== 3 || $_SESSION['permission']== 2){
                        echo '<a href="'. $url. '&action=edit" class="btn btn-warning fa fa-edit"></a>';
                    }?>

                    <?php if($_SESSION['permission']== 3){
                        echo '<a href="'. $url. '&action=delete" class="btn btn-danger fa fa-trash" onclick="return confirm(`Biztos törli?`)"></a>';
                    }?>

                </div>
            </td>
        </tr>
        <?php }; ?>

    </tbody>
</table>
<?php } 
elseif($action == 'view'){
    $user->findSet($db,$_GET['id']);
   ?>
<div class="card usercard">
    <h4 class="card-header "><?php echo $user->name?></h4>
    <div class="card-body row justify-content-center">
        <div class="col-6">
            <h5>E-mail cím: </h5>
            <p><?php echo $user->email?></p>
            <h5>Beosztás: </h5>
            <p><?php switch ($user->permission) {
                            case 1:
                                echo "Munkatárs";
                                break;
                            case 2:
                                echo "Csoportvezető";
                                break;
                            case 3:
                                echo "Adminisztrátor";
                                break;};?></p>
        </div>
        <div class="col-6">
            <h5>Születési hely: </h5>
            <p><?php echo $user->bplace?></p>
            <h5>Adószám: </h5>
            <p><?php echo $user->tax_number?></p>
        </div>

        <a class="btn btn-primary backbutton col-4 mt-4" href="/project-management-system/index.php?module=users">Vissza</a>
    </div>
</div>
<?php

}elseif($action == 'edit'){
    $user->findSet($db,$_GET['id']);
    include('modules/registration_form.php');

}elseif($action == 'delete'){
    $user->deleteUser($db, $_GET['id']);
}
?>