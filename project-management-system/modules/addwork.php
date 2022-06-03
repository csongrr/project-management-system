<?php 
if ($_GET['action']== 'new'){
        $query = 'INSERT INTO `worksheets`(`pid`, `userid`,`name`, `details`, `worktime`) 
        VALUES ("'.$_GET['pid'].'","'.$_SESSION['id'].'","'.$_POST['name'].'","'.$_POST['details'].'","'.$_POST['worktime'].'")';
        
        mysqli_query($db,$query);

        header("Location: index.php?module=projects&id=".$_GET['pid']."&action=view");


}elseif($_GET['action']=='edit'){
        $query = 'UPDATE `worksheets` SET `name` = "'.$_POST['name'].'", `details`="'.$_POST['details'].'", `worktime`= "'.$_POST['worktime'].'" WHERE `id`="'.$_POST['id'].'"';
        
        mysqli_query($db,$query);
        
        header("Location: index.php?module=projects&id=".$_GET['pid']."&action=view");
        
}

?>