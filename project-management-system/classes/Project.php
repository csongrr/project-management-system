<?php
class Project {
    public int $id;
    public string $name;
    public $planned_start;
    public $planned_end;
    public int $cost;
    public string $description;
    public int $open;


    public function NearestProject($db){

        $nearest=mysqli_fetch_assoc(mysqli_query($db,'SELECT * FROM projects WHERE open= 1  ORDER BY planned_end LIMIT 1'));
        return($nearest);
    }


    public function ClosedProjects($db){

        $closed=mysqli_fetch_object(mysqli_query($db,'SELECT COUNT(*) as cnt FROM projects WHERE open = 0'));
        echo($closed->cnt);
    }


    public function OpenProject($db){

        $open=mysqli_fetch_object(mysqli_query($db,'SELECT COUNT(*) as cnt FROM projects WHERE open = 1'));
        echo($open->cnt);
    }

    public function DeleteProject($db, $id){

        $query= 'DELETE FROM `projects` WHERE id ="'. $id .'"';
        mysqli_query($db,$query);
        $workquery= 'DELETE FROM `worksheets` WHERE pid="'. $id .'"';
        mysqli_query($db,$workquery);
        header("Location: /project-management-system/index.php?module=projects");
    }

    public function all($db){
        $query = 'SELECT * FROM projects ORDER BY id';
        $result = mysqli_query($db, $query);
        
        return $result;
    }

    public function find($db,$id){
        $query = 'SELECT * FROM `projects` WHERE `id` = ' . $id;
        $result = mysqli_query($db, $query);
        return $result;
    }

    public function findBy($db,$searchby,$searchvalue){
        $query = 'SELECT * FROM `projects` WHERE `'.$searchby.'` = ' . $searchvalue .' ORDER BY `id`';
        $result = mysqli_query($db, $query);
        return $result;
    }

    public function findSet($db,$id){
        $query = 'SELECT * FROM `projects` WHERE `id` = ' . $id .' LIMIT 1';
        $result = mysqli_query($db, $query);
        $project=mysqli_fetch_assoc($result);

        $this->id = $project['id'];
        $this->name = $project['name'];
        $this->planned_start = $project['planned_start'];
        $this->planned_end = $project['planned_end'];
        $this->cost = $project['cost'];
        $this->description = $project['description'];
        $this->open = $project['open'];
    }
}
?>