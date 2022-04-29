<?php
if (isset($_GET['pubid'])) {
    $pubid = $_GET['pubid'];
    include '../assets/php/header.php';
    include '../assets/php/navbar.php';
    include "../app/process_download.php";
    include '../assets/php/footer.php';
}elseif(isset($_GET['fileid'])) {
    $_session['fileid'] = $_GET['fileid'];
    include '../assets/php/header.php';
    include '../assets/php/navbar.php';
    include "../app/process_download.php";
    include '../assets/php/footer.php';
}else{
    require_once('../controller/start.inc.php');
   if(isset($_SERVER['HTTP_REFERER'])){
       $user->redirect($_SERVER['HTTP_REFERER']);
   }else{
    $user->redirect('./index.php');
   }
   
}
?>