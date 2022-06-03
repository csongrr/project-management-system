<?php
    $query='UPDATE  `projects` SET 
        `planned_start` = "'.$_POST['planned_start'].'",
        `planned_end` = "'.$_POST['planned_end'].'",
        `cost` = "'.$_POST['cost'].'",
        `description` = "'.$_POST['description'].'",
        `open` = "'.$_POST['open'].'"
        WHERE
        id = "'.$_POST['id'].'";
        ';

    $result=mysqli_query($db,$query);

    header("Location: /project-management-system/index.php?module=projects&action=list");
?>