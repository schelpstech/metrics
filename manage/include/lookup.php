<?php
include "../../controller/start.inc.php";
$status = $user->admin_is_logged_in();
// Redirect logged out user to Login  page
if ($status != 1) {
  $user->redirect('../pages/auth-login.php?resp=' . $status);
}
//Count User
$tblName = 'crunch_user';
$conditions = array(
  'return_type' => 'count',
);
$count_user = $model->getRows($tblName, $conditions);

// Users  Today
$date = date("Y-m-d");
$conditions = array(
  'return_type' => 'count',
  'where_greater_equals' => array(
    'rectime' => $date,
  )
);

$count_user_today = $model->getRows($tblName, $conditions);


//Get Latest Users

$conditions = array(
  'order_by' => 'rectime DESC',
  'limit' => '5',
);
$latest_user = $model->getRows($tblName, $conditions);


//Count Orders
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'count',
);
$count_order = $model->getRows($tblName, $conditions);


//Count Successful Orders
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'count',
  'where' => array(
    'trans_status' => 1,
  )
);
$count_success_order = $model->getRows($tblName, $conditions);

//Count Failed Orders
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'count',
  'where' => array(
    'trans_status' => 0,
  )
);
$count_failed_order = $model->getRows($tblName, $conditions);

//Count Fulfilled Orders
$tblName = 'permission_tbl';
$conditions = array(
  'return_type' => 'count',
  'where' => array(
    'dwn_count' => 1,
  )
);
$count_fulfilled_order = $model->getRows($tblName, $conditions);

//Successful Sales Revenue
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'single',
  'select' => 'SUM(trans_amount) as total_revenue',
  'where' => array(
    'trans_status' => 1,
  )
);
$sum_success_order = $model->getRows($tblName, $conditions);

//Failed Sales Revenue
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'single',
  'select' => 'SUM(trans_amount) as total_revenue',
  'where' => array(
    'trans_status' => 0,
  )
);
$sum_failed_order = $model->getRows($tblName, $conditions);

//total revenue
$sum_order = $sum_success_order['total_revenue'] + $sum_failed_order['total_revenue'];
//Sales Revenue today
$conditions = array(
  'return_type' => 'single',
  'select' => 'SUM(trans_amount) as total_revenue',
  'where' => array(
    'trans_status' => 1,
    'trans_date' => $date,
  ),
);
$sum_order_today = $model->getRows($tblName, $conditions);

//Paying Users
$conditions = array(
  'return_type' => 'count',
  'select' => 'DISTINCT trans_user',
  'where' => array(
    'trans_status' => 1,
  )
);
$paying_users = $model->getRows($tblName, $conditions);

//Cart Item Users
$tbl = 'cart_log';
$conditions = array(
  'return_type' => 'count',
  'select' => 'DISTINCT user_id',
);
$cart_users = $model->getRows($tbl, $conditions);

// count visitors
$tbl = 'visit_log';
$conditions = array(
  'return_type' => 'count',
);
$count_visitors = $model->getRows($tbl, $conditions);

// count visitors today

$conditions = array(
  'where' => array(
    'date' => $date,
  ),
  'return_type' => 'count',
);
$count_visitors_today = $model->getRows($tbl, $conditions);

//Successful Logins
$tblName = 'user_log';
$conditions = array(
  'return_type' => 'count',
  'select' => 'DISTINCT userid',
  'where' => array(
    'login_status' => 1,
  )
);
$login_count = $model->getRows($tblName, $conditions);
//Successful Logins Today
$conditions = array(
  'return_type' => 'count',
  'select' => 'DISTINCT userid',

  'where_greater_equals' => array(
    'login_date' => $date,
    'login_status' => 1,
  )
);
$login_count_today = $model->getRows($tblName, $conditions);

//Get Active Users

$conditions = array(
  'select' => 'DISTINCT userid, login_date',
  'where' => array(
    'login_status' => 1,
  ),
  'order_by' => 'login_date DESC',
  'limit' => '5',
);
$login_view = $model->getRows($tblName, $conditions);


if (isset($_POST['delete_incomplete'])) {
  try {
    $tblName = "trans_tbl";
    $conditions = "
      trans_status = 0 
      AND trans_date IS NULL 
      AND trans_time < DATE_SUB(NOW(), INTERVAL 7 DAY)
    ";

    $deleted = $model->delete($tblName, $conditions);

    if ($deleted) {
      echo "<script>alert('Incomplete orders older than 7 days deleted successfully.');</script>";
    } else {
      echo "<script>alert('No incomplete orders older than 7 days found.');</script>";
    }
  } catch (PDOException $e) {
    echo "<script>alert('Error deleting records: " . $e->getMessage() . "');</script>";
  }
}


