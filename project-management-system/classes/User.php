<?php
class User {
    
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public $bdate;
    public string $bplace;
    public int $tax_number;
    public string $mother_name;
    public $permission;


    public function findSet($db,$id){
        $query = 'SELECT * FROM `users` WHERE `id` = ' . $id .' LIMIT 1';
        $result = mysqli_query($db, $query);
        $user=mysqli_fetch_assoc($result);

        $this->id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->password = $user['password'];
        $this->bdate = $user['bdate'];
        $this->bplace = $user['bplace'];
        $this->tax_number = $user['tax_number'];
        $this->mother_name = $user['mother_name'];
        $this->permission = $user['permission'];
    }

    public function findWhere($db,$searchby,$value){
        $query = 'SELECT * FROM `users` WHERE `'.$searchby.'` = "' . $value .'" LIMIT 1';
        $result = mysqli_query($db, $query);
        return $result;
    }

    public function list($db){
        $query = 'SELECT * FROM users ORDER BY name';
        $result = mysqli_query($db, $query);
        return $result;
    }

    public function deleteUser($db,$id){
        $query= 'DELETE FROM `users` WHERE id ="'.$id .'"';
        $deletethis=mysqli_query($db,$query);
        header("Location: /project-management-system/index.php?module=users");
    }

}
?>