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
            unset($_SESSION['cart_check']);
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
            unset($_SESSION['cart_check']);
            $_SESSION['cart_check'] = $check;
            echo $check;
        }
    }
} //delete cart item
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
            unset($_SESSION['cart_check']);
            $_SESSION['cart_check'] = $check;
            echo $check;
        } else {
            echo 'Unable to add item to cart ';
        }
    } else {

        echo 'Item not found in Cart';
    }
} elseif (isset($_POST['action']) && $_POST['action'] === ' Record Tran.saction') {
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
    } else {
        echo 00;
    }
} elseif (isset($_POST['action']) && $_POST['action'] === 'remove') {
    $prod_sku = $_POST['prod_sku'];
    $user_id  = $_POST['user_id'];
    $token    = $_POST['token'];

    $tblName = "cart_log";
    $conditions = array(
        'where' => array(
            'user_id' => $user_id,
            'token'   => $token,
            'prod_sku' => $prod_sku
        )
    );

    // Update item_status = 0 (soft delete) or delete row
    $deleted = $model->delete($tblName, $conditions['where']);

    if ($deleted) {
        $_SESSION['msg'] = "Item removed from cart.";
    } else {
        $_SESSION['msg'] = "Failed to remove item.";
    }
    header("Location: ../view/mycart.php");
    exit;
}elseif (isset($_POST['action']) && $_POST['action'] === 'delete_incomplete') {
  try {
    $tblName = "trans_tbl";
    $conditions = [
      'where' => [
        'trans_ref' => $_POST['trans_ref'],
        'trans_status' => 0,
        'trans_date' => "IS NULL"
      ]];

    $deleted = $model->delete($tblName, $conditions);

    if ($deleted) {
         $response = '<div class="alert alert-success alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-check-circle"></i> Incomplete order with reference number ' . $_POST['trans_ref'] . ' deleted successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            $user->redirect($_SERVER['HTTP_REFERER']);
            $_SESSION['msg'] = $response;
    } else {
      $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-times-circle"></i> Incomplete order record not deleted.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
      $user->redirect($_SERVER['HTTP_REFERER']);
      $_SESSION['msg'] = $response;
    }
  } catch (PDOException $e) {
    echo "<script>alert('Error deleting records: " . $e->getMessage() . "');</script>";
  }
}

else {
    echo 'We cannot verify your request. Try Again!';
}
