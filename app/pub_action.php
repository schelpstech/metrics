<?php
require_once('../controller/start.inc.php');

if (isset($_POST['add_publication']) && $_FILES['pub_file']['error'] === UPLOAD_ERR_OK && $_POST['add_publication'] == 'Publish') {
    // Retrieve form input
    $pub_id = trim($_POST['pub_id']);
    $pub_name = trim($_POST['pub_name']);
    $author = trim($_POST['author']);
    $pub_year = trim($_POST['pub_year']);

    // get details of the uploaded file
    $fileTmpPath = $_FILES['pub_file']['tmp_name'];
    $fileName = $_FILES['pub_file']['name'];
    $fileSize = $_FILES['pub_file']['size'];
    $fileType = $_FILES['pub_file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    // Validate form fields 
    if (empty($pub_name)) {
        $valErr .= 'Please enter Publication Name.<br/>';
    }
    if (empty($author)) {
        $valErr .= 'Please enter author names.<br/>';
    }
    if (empty($pub_year)) {
        $valErr .= 'Please enter Publication Year.<br/>';
    }


    // Check whether user inputs are empty 
    if (empty($valErr)) {

        // sanitize file-name
        $prod_filename = $pub_id . "." . $fileExtension;

        // check if file has one of the following extensions
        $allowedfileExtensions = array('pdf', 'docx', 'doc');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            
            $uploadFileDir = '../resources/publications/';
              
            $dest_path = $uploadFileDir . $prod_filename;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {

                // Insert data into the database
                $tblName  = 'publication_tbl';
                $userData = array(
                    'pub_key' => $pub_id,
                    'pub_name' => $pub_name,
                    'author' => $author,
                    'pub_year' => $pub_year,
                    'pub_file' => $dest_path,
                    'pub_status' => 1,
                );
                $insert = $model->insert_data($tblName, $userData);

                if ($insert) {
                    $response =
                        '<div class="alert alert-success alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Successful</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Article  :: ' . $pub_id . ' :: ' . $pub_name . ' has been successfully published.
            </div>
    </div>';

                    $user->redirect($_SERVER['HTTP_REFERER']);
                    $_SESSION['msg'] = $response;
                } else {

                    $response =
                        '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        We are sorry, it seems like there was a glitch in the service. Try again!
            </div>
    </div>';

                    $user->redirect($_SERVER['HTTP_REFERER']);
                    $_SESSION['msg'] = $response;
                }
            } else {

                $response =
                    '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        There was an error uploading the article. Try again!
            </div>
    </div>';

                $user->redirect($_SERVER['HTTP_REFERER']);
                $_SESSION['msg'] = $response;
            }
        } else {
            $response =
                '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        The Article you are trying to upload is not in the specified format . Try again!
            </div>
    </div>';

            $user->redirect($_SERVER['HTTP_REFERER']);
            $_SESSION['msg'] = $response;
        }
    } else {
        $response =
            '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Please fill all the mandatory fields: ' . trim($valErr) . '
            </div>
    </div>';

        $user->redirect($_SERVER['HTTP_REFERER']);
        $_SESSION['msg'] = $response;
    }
} elseif (isset($_POST['edit_article']) && $_POST['edit_article'] == 'Update Article Details') {

    $pub_id = trim($_POST['pub_id']);
    $pub_name = trim($_POST['pub_name']);
    $author = trim($_POST['author']);
    $pub_year = trim($_POST['pub_year']);
    $pub_status = trim($_POST['pub_status']);

    // Validate form fields 
    if (empty($pub_name)) {
        $valErr .= 'Please enter Publication Name.<br/>';
    }
    if (empty($author)) {
        $valErr .= 'Please enter author names.<br/>';
    }
    if (empty($pub_year)) {
        $valErr .= 'Please enter Publication Year.<br/>';
    }


    // Check whether user inputs are empty 
    if (empty($valErr)) {


        $tblName  = 'publication_tbl';
        $articleData = array(
            
            'pub_name' => $pub_name,
            'author' => $author,
            'pub_year' => $pub_year,
            'pub_status' => $pub_status,
        );

        $conditons = array(
            'pub_key' => $pub_id,
        );
        $update = $model->upDate($tblName, $articleData, $conditons);

        if ($update) {
            $response =
                '<div class="alert alert-success alert-has-icon">
<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
<div class="alert-body">
    <div class="alert-title">Successful</div>
    <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Article  :: ' . $pub_id . ':: ' . $pub_name . ' has been successfully modified
</div>
</div>';
            $user->redirect('../manage/pages/publicationview.php');
            $_SESSION['msg'] = $response;
        } else {
            $response =
                '<div class="alert alert-warning alert-has-icon">
<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
<div class="alert-body">
    <div class="alert-title">Ooops</div>
    <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            We are sorry, it seems like there was a glitch in the service. Try again!
</div>
</div>';

            $user->redirect('../manage/pages/publicationview.php');
            $_SESSION['msg'] = $response;
        }
    } else {
        $response =
            '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Please fill all the mandatory fields: ' . trim($valErr) . '
            </div>
    </div>';

        $user->redirect('../manage/pages/publicationview.php');
        $_SESSION['msg'] = $response;
    }
} else {
    $response =
        '<div class="alert alert-warning alert-has-icon">
    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
            <div class="alert-title">Ooops</div>
            <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                   Undefined Request
        </div>
</div>';

    $user->redirect('../manage/pages/publicationview.php');
    $_SESSION['msg'] = $response;
}
