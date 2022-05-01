<?php
require_once('../controller/start.inc.php');

//update download action
$perm_ref = $_POST['perm_ref'];

$tblName = 'permission_tbl';
$cartData = array(
  'dwn_count' => 0,
);
$conditons = array(
  'perm_id' => $perm_ref
);
$update = $model->upDate($tblName, $cartData, $conditons);

if ($update) {
    echo 11;
}else{
    echo 00;
}
    