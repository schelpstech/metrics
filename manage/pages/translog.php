<?php
include "../include/nav.php";
?>
<?php
if (isset($_GET['trans_ref'])) {
    $trans_ref = $_GET['trans_ref'];
    include "../include/nav.php";
    include "../include/transview.php";
    include "../include/footer.php";
}else{
    $user->redirect($_SERVER['HTTP_REFERER']);
}
?>
