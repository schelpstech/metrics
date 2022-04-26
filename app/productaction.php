<?php
require_once('../controller/start.inc.php');

if (isset($_POST['add_product']) && $_FILES['product_file']['error'] === UPLOAD_ERR_OK && $_POST['add_product'] == 'Submit') {
    // Retrieve form input
    $product_name = trim($_POST['product_name']);
    $product_desc = htmlspecialchars($_POST["product_desc"]);
    $product_price = trim($_POST['product_price']);
    $product_type = trim($_POST['product_type']);
    $product_tag = htmlspecialchars($_POST["product_tag"]);
    $sku = $_SESSION['sku'];

    // get details of the uploaded file
    $fileTmpPath = $_FILES['product_file']['tmp_name'];
    $fileName = $_FILES['product_file']['name'];
    $fileSize = $_FILES['product_file']['size'];
    $fileType = $_FILES['product_file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    $product_price = !empty($product_price) ? $product_price : 0;
    // Validate form fields 
    if (empty($product_name)) {
        $valErr .= 'Please enter Product Name.<br/>';
    }
    if (empty($product_desc)) {
        $valErr .= 'Please enter Product Description.<br/>';
    }

    if (empty($product_type)) {
        $valErr .= 'Please Select Product Type.<br/>';
    }
    if (empty($product_tag)) {
        $valErr .= 'Please enter one or more Product Tag.<br/>';
    }


    // Check whether user inputs are empty 
    if (empty($valErr)) {

        // sanitize file-name
        $prod_filename = $product_type . $sku . "." . $fileExtension;

        // check if file has one of the following extensions
        $allowedfileExtensions = array('xlsx', 'xls', 'pdf', 'docx', 'doc', 'do', 'dta');

        if (in_array($fileExtension, $allowedfileExtensions)) {
            // directory in which the uploaded file will be moved
            if ($product_type == 'Dataset') {
                $uploadFileDir = '../manage/resources/datasets/';
                $prod_image = '../assets/img/web/file.png';
            } elseif ($product_type == 'DoFile') {
                $uploadFileDir = '../manage/resources/dofiles/';
                $prod_image = '../assets/img/web/dofile.png';
            }
            $dest_path = $uploadFileDir . $prod_filename;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {

                // Insert data into the database
                $tblName  = 'prod_sku';
                $userData = array(
                    'prod_sku' => $sku,
                    'prod_name' => $product_name,
                    'prod_desc' => $product_desc,
                    'prod_price' => $product_price,
                    'prod_type' => $product_type,
                    'prod_tag' => $product_tag,
                    'prod_path' => $dest_path,
                    'prod_img' => $prod_image,
                    'prod_status' => 1,
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
                        Product File with SKU :: ' . $sku . ' for :: ' . $product_name . ' has been successfully uploaded
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
                        There was an error uploading the product. Try again!
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
                        The Product File you are trying to upload is not in the specified format . Try again!
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
} elseif (isset($_POST['edit_product']) && $_POST['edit_product'] == 'Update Product Details') {

    $product_name = trim($_POST['product_name']);
    $product_desc = htmlspecialchars($_POST["product_desc"]);
    $product_price = trim($_POST['product_price']);
    $product_type = trim($_POST['product_type']);
    $product_tag = htmlspecialchars($_POST["product_tag"]);
    $product_status = htmlspecialchars($_POST["product_status"]);
    $sku = trim($_POST['product_sku']);

    $product_price = !empty($product_price) ? $product_price : 0;

    // Validate form fields 
    if (empty($product_name)) {
        $valErr .= 'Please enter Product Name.<br/>';
    }
    if (empty($product_desc)) {
        $valErr .= 'Please enter Product Description.<br/>';
    }

    if (empty($product_type)) {
        $valErr .= 'Please Select Product Type.<br/>';
    }
    if (empty($product_tag)) {
        $valErr .= 'Please enter one or more Product Tag.<br/>';
    }

    if (empty($valErr)) {

        if ($product_type == 'Dataset') {
            $uploadFileDir = '../manage/resources/datasets/';
            $prod_image = '../assets/img/web/file.png';
        } elseif ($product_type == 'DoFile') {
            $uploadFileDir = '../manage/resources/dofiles/';
            $prod_image = '../assets/img/web/dofile.png';
        }

        $tblName  = 'prod_sku';
        $prodData = array(
            'prod_name' => $product_name,
            'prod_desc' => $product_desc,
            'prod_price' => $product_price,
            'prod_type' => $product_type,
            'prod_tag' => $product_tag,
            'prod_img' => $prod_image,
            'prod_status' => $product_status,
        );

        $conditons = array(
            'prod_sku' => $sku,
        );
        $update = $model->upDate($tblName, $prodData, $conditons);

        if ($update) {
            $response =
                '<div class="alert alert-success alert-has-icon">
<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
<div class="alert-body">
    <div class="alert-title">Successful</div>
    <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            Product File with SKU :: ' . $sku . ' for :: ' . $product_name . ' has been successfully modified
</div>
</div>';
            $user->redirect('../manage/pages/productview.php');
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

            $user->redirect('../manage/pages/productview.php');
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

    $user->redirect('../manage/pages/productview.php');
        $_SESSION['msg'] = $response;
    }
}else {
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

    $user->redirect('../manage/pages/productview.php');
    $_SESSION['msg'] = $response;
}
