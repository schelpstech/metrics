

}
if($update){

$response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
    <i class="uil uil-times-circle"></i> Incorrect log-in credentials. </a>.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$user->redirect($_SERVER['HTTP_REFERER']);
$_SESSION['msg'] = $response;
}