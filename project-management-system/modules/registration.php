<?php 
  
  
$valid = true;
if (isset($_POST["submit"])) {
    $errors = [];

    if ($_POST['email'] == '') {
        $valid = false;
        $errors[] = 'Az email megadása kötelező!';
    }
    if ($_POST['name'] == '') {
        $valid = false;
        $errors[] = 'A név megadása kötelező!';
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        $errors[] = 'Az email formátuma nem megfelelő!';
    }
    if ($_POST['password'] == '') {
        $valid = false;
        $errors[] = 'A jelszó megadása kötelező!';
    }
    if ($_POST['bdate'] == '') {
        $valid = false;
        $errors[] = 'A születési dátum megadása kötelező!';
    }
    if ($_POST['tax_number'] == '' || strlen($_POST['tax_number'])!== 10) {
      $valid = false;
      if($_POST['tax_number'] == ''){
          $errors[] = 'Az adószám megadása kötelező!';
      }else{
          $errors[]= 'Az adószám 10 karakter hosszúságú.';
      }
    }
    if ($_POST['mname'] == '') {
      $valid = false;
      $errors[] = 'Az anyja neve megadása kötelező!';
    }
  
   }
if($_POST["submit"] == "Regisztráció"){
   $email = $_POST['email'];
   $name = $_POST['name'];
   $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
   $bdate = $_POST['bdate'];
   $bplace = $_POST['bplace'];
   $tax_number = $_POST['tax_number'];
   $mname = $_POST['mname'];
   $permission = $_POST['permission'];

   $exists=(mysqli_query($db,"SELECT * FROM users WHERE email = '$email'"));


    if($exists->num_rows == 0 && $valid){

    $query = "INSERT INTO `users`(`name`, `email`, `password`, `bdate`, `bplace`, `tax_number`, `mother_name`, `permission`) VALUES ('$name','$email','$password','$bdate','$bplace','$tax_number','$mname','$permission')";
    $result=mysqli_query($db,$query);
    
        }if($result){?>

        <div class="alert alert-success">Sikeres regisztráció!</div>
        <div class="text-center">
            <a href="index.php?module=registration_form" class="btn btn-success">Vissza</a>
        </div>

    <?php
    }else{?>

        <div class="alert alert-danger">
            Hiányzó adatok!
            <ul class="m-0">
                <?php
                        foreach ($errors as $error) {
                            echo '<li>' . $error . '</li>';
                        }
                ?>
            </ul>
        </div>
        <div class="text-center">
            <a href="index.php?module=registration_form" class="btn btn-danger">Vissza</a>
        </div>
<?php
}
}elseif($_POST["submit"]== "Módosít"){
    $user->findSet($db,$_GET['id']);

    $queryfirst="UPDATE `users` SET";
    if($user->email !== $_POST['email']){
        $queryitems[] = (' `email` = "'.$_POST['email'].'"');
    }
    if($user->name !== $_POST['name']){
        $queryitems[] = ' `name` = "'.$_POST['name'].'"';
    }
    if($user->bdate !== $_POST['bdate']){
        $queryitems[] = ' `bdate` = "'.$_POST['bdate'].'"';
    }
    if($user->bplace !== $_POST['bplace']){
        $queryitems[] = ' `bplace` = "'.$_POST['bplace'].'"';
    }
    if($user->tax_number !== $_POST['tax_number']){
        $queryitems[] = ' tax_number = "'.$_POST['tax_number'].'"';
    }
    if($user->mother_name !== $_POST['mname']){
        $queryitems[] = ' `mother_name` = "'.$_POST['mname'].'"';
    }
    if($_POST['password'] !== ''){
        $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
        $queryitems [] = ' password = "'.$password.'"';
    }
    if($user->permission !== $_POST['permission']){
        $queryitems[] = ' `permission` = "'.$_POST['permission'].'"';
    }

    $querylast = ' WHERE `id` = '. $user->id;
    $query = "";
    $query .= $queryfirst;
    if(isset($queryitems) && count($queryitems)>1){
            for ($i = 0; $i <= count($queryitems)-2; $i++){
                $query .= $queryitems[$i].' , ';
            }
        $query .= $queryitems[count($queryitems)-1];
        $query .= $querylast;
        $result=mysqli_query($db,$query);
       
        header("Location: /project-management-system/index.php?module=users");
    
    }elseif(isset($queryitems) && count($queryitems) == 1){
        $query .= $queryitems[0];
        $query .= $querylast;
        $result=mysqli_query($db,$query);

        header("Location: /project-management-system/index.php?module=users");
        
    }else{
        ?>
        <div class="alert alert-warning">Nincs módosítás a felhasználó profiljában.</div>
        <div class="text-center">
            <a href="index.php?module=users" class="btn btn-success">Vissza</a>
        </div>
        <?php
    }
    
}
?>