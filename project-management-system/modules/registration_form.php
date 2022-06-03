
<form action="index.php?module=registration<?php echo isset($_GET['id']) ? ('&id='.$_GET['id']) : ''?>" method="POST" class="row justify-content-center">
<div class="col-4 m-3">
    <?php if(isset($_GET['id'])){
        $user->findSet($db,$_GET['id']);
    ?>
    
    
    <input type="hidden" name="id" value="<?php echo $user->id?>"></input>
    <?php
    }
    ?>
    <label>E-mail cím:</label>
    <input type="email" class="form-control" name="email" placeholder="foo@bar.com" value="<?php echo isset($_GET['id']) ? htmlspecialchars($user->email) : ''?>"></input>
    <label>Név:</label>
    <input type="text" class="form-control" name="name" placeholder="John Doe" value="<?php echo isset($_GET['id']) ? htmlspecialchars($user->name) : ''?>"></input>
    <label>Jelszó:</label>
    <input type="password" class="form-control" name="password" placeholder="Jelszó"></input>
    <label>Születési idő:</label>
    <input type="date" class="form-control" name="bdate" placeholder="1900-01-01" value="<?php echo isset($_GET['id']) ? htmlspecialchars($user->bdate) : ''?>"></input>
    
</div>
<div class="col-4 m-3">
<label>Születési hely:</label>
    <input type="text" class="form-control" name="bplace" value="<?php echo isset($_GET['id']) ? htmlspecialchars($user->bplace) : ''?>"></input>
    <label>Adóazonosító:</label>
    <input type="text" class="form-control" name="tax_number" size="10" value="<?php echo isset($_GET['id']) ? htmlspecialchars($user->tax_number) : ''?>"></input>
    <label>Anyja neve:</label>
    <input type="text" class="form-control" name="mname" value="<?php echo isset($_GET['id']) ? htmlspecialchars($user->mother_name) : ''?>"></input>
    <label>Jogosultság</label>
    <select class="form-select" name="permission">
        <option value="1" <?php if (isset($_GET['id']) && ($user->permission == 1))echo "selected"?>>Munkatárs</option>
        <option value="2" <?php if (isset($_GET['id']) && ($user->permission == 2))echo "selected"?>>Csoportvezető</option>
        <option value="3" <?php if (isset($_GET['id']) && ($user->permission == 3))echo "selected"?>>Adminisztrátor</option>
    </select>
</div>
<input type="submit" name="submit" value="<?php if(isset($_GET['id']) && $_GET['action']== 'edit'){
                                                    echo "Módosít";
                                                    }else{echo "Regisztráció";} ?>"
    class="btn btn-success col-5"></input>
</form>
