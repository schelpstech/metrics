<?php
if (isset($_GET['editid'])) {
    $_session['id'] = $_GET['editid'];
    include "../include/nav.php";
    include "../include/edit_publication.php";
    include "../include/footer.php";
}elseif(isset($_GET['deleteid'])) {
    $_session['id'] = $_GET['deleteid'];
    include "../include/nav.php";
    include "../include/delete_publication.php";
    include "../include/footer.php";

}else{
    $user->redirect($_SERVER['HTTP_REFERER']);
}
?>


