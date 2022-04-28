<?php
    require_once('utility.php'); 
    $tblName  = 'visit_log';
    $conditions = array(
        'return_type' => 'count',
        'where' => array(
          'token' => $_SESSION['token'],
          'ip' => $_SESSION['visitorip'],
        )
      
      );
      $check_log = $model->getRows($tblName, $conditions);
      if($check_log == 0){
        $browser =  $_SERVER['HTTP_USER_AGENT'];
        $visitorip =  $_SERVER['REMOTE_ADDR'];
        $token = generateRandomText();
        $token .= generateRandomText();
        $checkin = date("Y-m-d");
    
        
        $_SESSION['token'] = $token;
        $_SESSION['visitorip'] = $visitorip;
    
        $userData = array(
          'ip' => $visitorip,
          'browser' => $browser,
          'token' => $token,
          'date' => $checkin,
      );
      $insert = $model->insert_data($tblName, $userData);
      }
?>
