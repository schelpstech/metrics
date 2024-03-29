<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require '../../controller/start.inc.php';
/*
*  CONFIGURATION
*/

//captcha
$recaptcha = $_POST['g-recaptcha-response'];
$tblName = 'payment';
$conditions = array(
'return_type' => 'single',
'where' => array(
'payerid' => 2,
)

);
$captcha = $model->getRows($tblName, $conditions);
$secret = $captcha['secret'];
$ip = $_SERVER['REMOTE_ADDR'];
$postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
$url = "https://www.google.com/recaptcha/api/siteverify";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
$data = curl_exec($ch);
curl_close($ch);
$res =  json_decode($data, true);
if($res['success']){

  // Send email
if(isset($_POST["email"])) {
  if(!isset($_POST["email"]))
  {
      $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
      die($output);
  }
  else {
      $user_Email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
  }
}
if(isset($_POST["message"])) {
  if(!isset($_POST["message"]))
  {
      $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
      die($output);
  }
  else {
      $user_Message = htmlspecialchars($_POST["message"]);
      
  }
}
if(isset($_POST["feedback"])) {
  if(!isset($_POST["feedback"]))
  {
      $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
      die($output);
  }
  else {
      $feedback = htmlspecialchars($_POST["feedback"]);
      
  }
}
if(isset($_POST["name"])) {
  if(!isset($_POST["name"]))
  {
      $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
      die($output);
  }
  else {
      $user_Name =  htmlspecialchars($_POST["name"]);
  }
}
if(isset($_POST["surname"])) {
  if(!isset($_POST["surname"]))
  {
      $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
      die($output);
  }
  else {
      $surname =  htmlspecialchars($_POST["surname"]);
  }
}

if(!empty($_SESSION['uniqueid'])){
$sent_by = $_SESSION['uniqueid'];
}else {
  $sent_by ='Visitor';
}
$tbl = 'crm';
$data = array(
      'first_name' => $user_Name,
      'last_name' => $surname,
      'email' => $user_Email,
      'contact_type' => $feedback,
      'message' => $user_Message,
      'submitted_by' => $sent_by,
  );
  $insert = $model->insert_data($tbl, $data);

$fullname = $user_Name.' '.$surname;



$tblName = 'payment';
$conditions = array(
'return_type' => 'single',
'where' => array(
'payerid' => 3,
)

);
$mail_find = $model->getRows($tblName, $conditions);

// Recipients
$fromEmail = $user_Email; // Email address that will be in the from field of the message.
$fromName = $fullname; // Name that will be in the from field of the message.
$sendToEmail =  $mail_find['public']; // Email address that will receive the message with the output of the form
$sendToName = 'CrunchEconometrix'; // Name that will receive the message with the output of the form

// Subject
$subject = 'New Enquiry';

// SMTP settings
$smtpUse = true; // Set to true to enable SMTP authentication
$smtpHost =  $mail_find['company']; // Enter SMTP host ie. smtp.gmail.com
$smtpUsername =  $mail_find['public']; // SMTP username ie. gmail address
$smtpPassword =  $mail_find['secret']; // SMTP password ie gmail password
$smtpSecure = 'ssl'; // Enable TLS or SSL encryption
$smtpAutoTLS = false; // Enable Auto TLS
$smtpPort = 465; // TCP port to connect to

// Success and error alerts
$okMessage = 'We have received your message. Stay tuned, we’ll get back to you ASAP!';
$errorMessage = 'There was an error while submitting the form. Please try again later';


/*
*  LET'S DO THE SENDING
*/

// if you are not debugging and don't need error reporting, turn this off by error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE);
try {
  if(count($_POST) == 0) throw new \Exception('Form is empty');
  $emailTextHtml =  '
  <p>Hi there,</p>
                        <p>Someone just sent an enquiry</p>
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Fullname</th>
                                            <th>Email Address</th>
                                            <th>Feedback Type</th>
                                            <th>Message</th>
                                            
                                        </tr>
                                    </thead>  
                                <tbody>
                                    <tr>
                                      <td> '.date("d-m-Y").'</td>
                                      <td> '.$fullname.'</td>
                                      <td> '.$fromEmail.'</td>
                                      <td>'.$feedback.'</td>
                                      <td>'.$user_Message.'</td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
  ';
  
  $mail = new PHPMailer;
  $mail->setFrom($fromEmail, $fromName);
  $mail->addAddress($sendToEmail, $sendToName);
  $mail->addReplyTo($fromEmail);
  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Subject = $subject;
  $mail->Body    = $emailTextHtml;
  $mail->msgHTML($emailTextHtml);
  if($smtpUse == true) {
    // Tell PHPMailer to use SMTP
    $mail->isSMTP();
    // Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->Debugoutput = function ($str, $level) use (&$mailerErrors) {
      $mailerErrors[] = [ 'str' => $str, 'level' => $level ];
    };
    $mail->SMTPDebug = 3;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = $smtpSecure;
    $mail->SMTPAutoTLS = $smtpAutoTLS;
    $mail->Host = $smtpHost;
    $mail->Port = $smtpPort;
    $mail->Username = $smtpUsername;
    $mail->Password = $smtpPassword;
  }
  if(!$mail->send()) {
    throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
  }
  $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e) {
  $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}
// if requested by AJAX request return JSON response
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
  $encoded = json_encode($responseArray); 
  header('Content-Type: application/json');
  echo $encoded;
}
// else just display the message
else {
  echo $responseArray['message'];
}
}else{
  $responseArray = array('type' => 'danger', 'message' => 'Invalid Request. Ensure to check the captcha');
  echo  $responseArray['message'];
}