<?php
include "../../controller/start.inc.php";
$status = $user->admin_is_logged_in();
    // Redirect logged out user to Login  page
if ($status != 1){
    $user->redirect('../pages/auth-login.php?resp='.$status);
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
    'order_by'=> 'rectime DESC',
    'limit'=> '5',
  );
  $latest_user = $model->getRows($tblName, $conditions);


//Count Orders
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'count',
  
);
$count_order = $model->getRows($tblName, $conditions);

//Sales Revenue
$tblName = 'trans_tbl';
$conditions = array(
  'return_type' => 'single',
  'select' => 'SUM(trans_amount) as total_revenue',
  'where' => array(
    'trans_status' => 1,
  )
);
$sum_order = $model->getRows($tblName, $conditions);
//Sales Revenue
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
    'select' => 'DISTINCT userid',
    'where' => array(
      'login_status' => 1,
    ),
    'order_by'=> 'login_date DESC',
    'limit'=> '5',
  );
  $login_view = $model->getRows($tblName, $conditions);
?>
