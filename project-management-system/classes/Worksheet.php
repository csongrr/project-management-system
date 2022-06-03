<?php
class Worksheet {
    public int $id;
    public int $pid;
    public int $userid;
    public $date;
    public string $name;
    public string $details;
    public int $worktime;
    

    public function all($db, $id)
    {
        $query = 'SELECT worksheets.name as workname, worksheets.date, worksheets.worktime, users.name, worksheets.id
        FROM worksheets
        INNER JOIN users ON worksheets.userid=users.id WHERE `pid` = '. $id .'';
       
        return $result = mysqli_query($db, $query);
    }

    public function find($db,$id){
        $query = 'SELECT * FROM `worksheets` WHERE `id` = ' . $id;
        $result = mysqli_query($db, $query);
        return $result;
    }

    public function findSet($db,$id){
        $query = 'SELECT * FROM `worksheets` WHERE `id` = ' . $id .' LIMIT 1';
        $result = mysqli_query($db, $query);
        $worksheet=mysqli_fetch_assoc($result);

        $this->id = $worksheet['id'];
        $this->pid = $worksheet['pid'];
        $this->userid = $worksheet['userid'];
        $this->date = $worksheet['date'];
        $this->name = $worksheet['name'];
        $this->details = $worksheet['details'];
        $this->worktime = $worksheet['worktime'];
    }

    public function getCreator($db,$workid){
        $query = 'SELECT name FROM users WHERE id = '. $this->userid;
        $result = mysqli_query($db,$query);
        $name = mysqli_fetch_assoc($result);
        return $name['name'];
    }

    function deleteWork($db, $id){

        $query= 'DELETE FROM `worksheets` WHERE `id` ="'.$id .'"';
        $deletethis=mysqli_query($db,$query);
        header("Location: /project-management-system/index.php?module=users");
    }
    
}
?>