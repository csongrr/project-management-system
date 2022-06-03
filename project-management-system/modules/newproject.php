<?php
if($_SESSION['permission']=='3' || $_SESSION['permission']=='2' && $_POST['submit']){

$open= "1";

$query="INSERT INTO `projects`(`name`, `planned_start`, `planned_end`, `cost`, `description`, `open`) 
        VALUES ('".$_POST['name']."','".$_POST['planned_start']."','".$_POST['planned_end']."',
        '".$_POST['cost']."','".$_POST['description']."','".$open."')";




mysqli_query($db,$query);
header("Location: index.php?module=projects");


}?>