<?php
session_start();
include('includes/db_connection.php');
include('includes/header.php');
include('includes/functions.php');
include('classes/Project.php');
include('classes/User.php');
include('classes/Worksheet.php');
$project = new Project;
$worksheets = new Worksheet();
$user = new User();

if (!isset($_SESSION['id'])){
    include('modules/login.php');}

else{ 
    include('includes/navigation.php'); ?>
        <div class="container">
        <div class="row mt-2 mt-lg-2 justify-content-center">
            <div class="col-12 col-lg-10 mb-2 mb-lg-0">
                <?php
                $module = $_GET['module'] ?? 'dashboard';
                include('modules/' . (is_file('modules/' . $module . '.php') ? $module : '404') . '.php');
                ?>
            </div>
        </div>
    </div>
<?php }
?>
</body>
</html>