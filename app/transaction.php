<?php
require_once('../controller/start.inc.php');
if (isset($_POST['tx_reference'])) {
  $reference = $_POST['tx_reference'];
  $status = 'success';
}else{
    echo 111;
}
    //validate transaction reference number in database
  $tblName = 'trans_tbl';
  $conditions = array(
    'return_type' => 'single',
    'where' => array(
      'trans_ref' => $reference,
    )

  );
  $transaction_details = $model->getRows($tblName, $conditions);

  if (!empty($transaction_details)) {
      $trans_user =  $transaction_details['trans_user'];
      $trans_cart =  $transaction_details['trans_cart'];
      $trans_amount =  $transaction_details['trans_amount'];
  }else{
    echo '112'.$reference;
}

  //Get secret key
  $tblName = 'payment';
  $conditions = array(
    'return_type' => 'single',
    'where' => array(
      'payerid' => 1,
    )

  );
  $payment_gateway = $model->getRows($tblName, $conditions);
//Verify transaction reference details with paystack
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.paystack.co/transaction/verify/'.$reference,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$payment_gateway['secret'],
    "Cache-Control: no-cache",
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
if ($err) {
    echo 113;
  }else{
$verify_response = json_decode($response, true);
  }
  if($verify_response['status'] == 'true'){

$paymentstatus = $verify_response['data']['status'];
$transref = $verify_response['data']['reference'];
$chargeamount = $verify_response['data']['amount'];
$paid_at = $verify_response['data']['paid_at'];

    if (  ($paymentstatus ==  $status) 
            && ($transref == $reference)  
            && (($chargeamount/100) == $trans_amount)) {

                $cartData = array(
                    'trans_status' => 1,
                    'trans_date' => $paid_at,
                );
        
                $conditons = array(
                    'trans_ref' => $reference,
                    'trans_user' => $trans_user,
                );
                $update = $model->upDate($tblName, $cartData, $conditons);
        
                if ($update) { 

                    $tblName = 'cart_log';
                     $conditions = array(
                            'where' => array(
                            'token' => $trans_cart,
                            'item_status' => 1,
                            'user_id' => $trans_user,
                            )

                         );
  $get_products = $model->getRows($tblName, $conditions);
    foreach($get_products as $item){
         
                    $tablename = 'permission_tbl';
                    $cartData = array(

                        'user_id' => $trans_user,
                        'trans_ref' => $reference,
                        'cart_ref' => $trans_cart,
                        'prod_sku' => $item['prod_sku'],
                        'dwn_count' => 1,
                    );
                    $insert = $model->insert_data($tablename, $cartData);
                }
                        echo 100;
                    }else{
                        echo 114;
                    }
                }else{
                    echo 115;
                }
  }else{
      echo ' Authorization: Bearer '.$payment_gateway['secret'];
  }        
               
// transaction data
