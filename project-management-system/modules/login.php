        <?php 
         if(isset($_SESSION['id'])){
             header('index.php');
            exit;
            }
        if(isset($_POST) && isset($_POST['email']) && isset($_POST['password'])){
            $login = $user->findWhere($db,'email',$_POST['email']);
                if (($row = mysqli_fetch_assoc($login)) && password_verify($_POST['password'], $row['password'])){
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['permission'] = $row['permission'];
                header('Location: index.php');
                exit;
            }else{$fail=1;};
        }
            ?>
                           
     
       
<div class="row  justify-content-center mt-5">
    <div class="col-3 m-4">
        <?php
            if(isset($fail)){
             echo '<div class="alert alert-danger text-center" role="alert">
             Hibás E-mail/Jelszó páros!
             </div>';};
        ?>
        <form action="index.php?module=login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email cím</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="foo@bar.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-3">Belépés</button>
            </div>
        </form>
    </div>
</div>