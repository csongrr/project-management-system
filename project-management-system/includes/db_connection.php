<?php
    $db = mysqli_connect(
        'localhost',
        'root',
        'a',
        'project-management-system',
    );
    if(mysqli_connect_error()){
        header('Location: maintenance.php');
        exit;
    }
?>