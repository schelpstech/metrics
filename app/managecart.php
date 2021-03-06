<?php
require_once('../controller/start.inc.php');

if (isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    // Retrieve form input
    $prod_sku = trim($_POST['product_sku']);
    $uniqueid = trim($_POST['uniqueid']);
    $token = trim($_POST['token']);
    $tblName = 'cart_log';

    $conditons = array(

        'where' => array(
            'prod_sku' => $prod_sku,
            'user_id' => $uniqueid,
            'token' => $token,
        )
    );
    $check = $model->getRows($tblName, $conditons);

    if (empty($check)) {

        // Insert data into the database

        $cartData = array(

            'prod_sku' => $prod_sku,
            'user_id' => $uniqueid,
            'token' => $token,
            'item_status' => 1,
        );
        $insert = $model->insert_data($tblName, $cartData);

        if ($insert) {
            $conditons = array(

                'where' => array(
                    'user_id' => $uniqueid,
                    'token' => $token,
                    'item_status' => 1,
                )
            );
            $check = $model->countRows($tblName, $conditons);
            unset ($_SESSION['cart_check'] );
            $_SESSION['cart_check'] = $check;
         echo $check;
        } else {
            echo 'Unable to add item to cart ';
        }
    } else {

        // Update data into the database

        $cartData = array(
            'item_status' => 1,
        );

        $conditons = array(

            'prod_sku' => $prod_sku,
            'user_id' => $uniqueid,
            'token' => $token,
            'item_status' => 0,
        );
        $update = $model->upDate($tblName, $cartData, $conditons);

        if ($update) {
            $conditons = array(

                'where' => array(
                    'user_id' => $uniqueid,
                    'token' => $token,
                    'item_status' => 1,
                )
            );
            $check = $model->countRows($tblName, $conditons);
            unset ($_SESSION['cart_check'] );
            $_SESSION['cart_check'] = $check;
            echo $check;
        }
    }
}//delete cart item
elseif (isset($_POST['action']) && $_POST['action'] === 'delete_from_cart') {
    // Retrieve form input
    $prod_sku = trim($_POST['product_sku']);
    $uniqueid = trim($_POST['uniqueid']);
    $token = trim($_POST['token']);
    $tblName = 'cart_log';



    $conditons = array(
        'where' => array(
            'prod_sku' => $prod_sku,
            'user_id' => $uniqueid,
            'token' => $token,
        )
    );
    $check = $model->getRows($tblName, $conditons);

    if ($check == true) {

        // Update data into the database

        $cartData = array(
            'item_status' => 0,
        );

        $conditons = array(

            'prod_sku' => $prod_sku,
            'user_id' => $uniqueid,
            'token' => $token,
            'item_status' => 1,
        );
        $update = $model->upDate($tblName, $cartData, $conditons);

        if ($update) {
            $conditons = array(

                'where' => array(
                    'user_id' => $uniqueid,
                    'token' => $token,
                    'item_status' => 1,
                )
            );
            $check = $model->countRows($tblName, $conditons);
            unset ($_SESSION['cart_check'] );
            $_SESSION['cart_check'] = $check;
            echo $check;
        } else {
            echo 'Unable to add item to cart ';
        }
    } else {

        echo 'Item not found in Cart';
    }
} elseif(isset($_POST['action']) && $_POST['action'] === ' Record Tran.saction') {
        // Retrieve form input
        $payable = trim($_POST['payable']);
        $user = trim($_POST['user']);
        $cart = trim($_POST['cart']);
        $qty = trim($_POST['qty']);
        $ref = trim($_POST['ref']);
        $tblName = 'trans_tbl';

        $cartData = array(

            'trans_amount' => $payable,
            'trans_user' => $user,
            'trans_cart' => $cart,
            'trans_qty' => $qty,
            'trans_ref' => $ref,
            'trans_status' => 0,
        );
        $insert = $model->insert_data($tblName, $cartData);

        if ($insert) {
            echo '11';

        }
        else{
            echo 00;
        }
}

else {
    echo 'We cannot verify your request. Try Again!';
}
