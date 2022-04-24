<?php
// Include necessary file
require_once('../controller/start.inc.php');
require_once('utility.php');

// Check if user is already logged in
if ($user->is_logged_in()) {
    // Redirect logged in user to their home page
    $user->redirect('../view/index.php');
}

if ($user->admin_is_logged_in()) {
    // Redirect logged in user to their home page
    $user->redirect('../manage/pages/welcome.php');
}

// Check if log-in form is submitted
if (isset($_POST['log_in'])) {
    // Retrieve form input

    $user_email = trim($_POST['user_name_email']);
    $user_password = trim($_POST['user_password']);

    $user_ip =  $_SERVER['REMOTE_ADDR'];
    $token =  generateRandomString();
    $log_status = 1;

    // Check for empty and invalid inputs
    if (empty($user_email)) {
        array_push($errors, "Please enter a valid e-mail address");
    } elseif (empty($user_password)) {
        array_push($errors, "Please enter a valid password.");
    } else {
        // Check if the user may be logged in
        if ($user->login($user_email, $user_password, $user_ip, $log_status, $token)) {

            if (isset($_SESSION['cart_user'])) {
                $tblName = 'cart_log';
                $guestid = $_SESSION['cart_user'];
                $cartData = array(
                    'user_id' => $user_email,
                );

                $conditons = array(
                    'user_id' => $guestid,
                );
                $update = $model->upDate($tblName, $cartData, $conditons);
            }
            $response = '
            <div class="alert alert-success alert-icon alert-dismissible fade show" role="alert">
                <i class="uil uil-check-circle"></i>Successfully Logged in User</a>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            $user->redirect($_SERVER['HTTP_REFERER']);
            $_SESSION['msg'] = $response;
        } else {

            $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-times-circle"></i> Incorrect log-in credentials. </a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            $user->redirect($_SERVER['HTTP_REFERER']);
            $_SESSION['msg'] = $response;
        }
    }
}


// Check if register form is submitted
if (isset($_POST['register'])) {
    // Retrieve form input
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $user_email = trim($_POST['user_email']);
    $user_password = trim($_POST['user_password']);
    $user_ip =  $_SERVER['REMOTE_ADDR'];
    $token =  generateRandomString();
    $log_status = 1;
    // Check for empty and invalid inputs
    if (empty($first_name)) {
        $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
        <i class="uil uil-times-circle"></i> Please enter your first name. </a>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        $user->redirect($_SERVER['HTTP_REFERER']);
        $_SESSION['msg'] = $response;
    } elseif (empty($last_name)) {
        $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
        <i class="uil uil-times-circle"></i> Please enter your last name. </a>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        $user->redirect($_SERVER['HTTP_REFERER']);
        $_SESSION['msg'] = $response;
    } elseif (empty($user_email)) {
        $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-times-circle"></i> Please enter a valid e-mail address. </a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        $user->redirect($_SERVER['HTTP_REFERER']);
        $_SESSION['msg'] = $response;
    } elseif (empty($user_password)) {
        $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-times-circle"></i> Please enter a password. </a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        $user->redirect($_SERVER['HTTP_REFERER']);
        $_SESSION['msg'] = $response;
    } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

        $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-times-circle"></i> Please enter a valid e-mail address. </a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        $user->redirect($_SERVER['HTTP_REFERER']);
        $_SESSION['msg'] = $response;
    } else {
        try {
            // Define query to select matching values
            $sql = "SELECT useremail FROM crunch_user WHERE  useremail=:user_email";

            // Prepare the statement
            $query = $db_conn->prepare($sql);

            // Bind parameters
            $query->bindParam(':user_email', $user_email);

            // Execute the query
            $query->execute();

            // Return clashes row as an array indexed by both column name
            $returned_clashes_row = $query->fetch(PDO::FETCH_ASSOC);

            // Check for usernames or e-mail addresses that have already been used
            if ($query->rowCount() > 0) {
                $response = '<div class="alert alert-danger alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-times-circle"></i> A user with this email address exist. Please choose something different. </a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                $user->redirect($_SERVER['HTTP_REFERER']);
                $_SESSION['msg'] = $response;
            } else {
                // Check if the user may be registered
                $user->register($last_name, $first_name, $user_email, $user_password, $user_ip, $log_status, $token);

                if (isset($_SESSION['cart_user'])) {
                    $tblName = 'cart_log';
                    $guestid = $_SESSION['cart_user'];
                    $cartData = array(
                        'user_id' => $user_email,
                    );

                    $conditons = array(
                        'user_id' => $guestid,
                    );
                    $update = $model->upDate($tblName, $cartData, $conditons);
                }

                $response = '
                        <div class="alert alert-success alert-icon alert-dismissible fade show" role="alert">
                            <i class="uil uil-check-circle"></i>Successfully Created User Account</a>.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                $user->redirect($_SERVER['HTTP_REFERER']);
                $_SESSION['msg'] = $response;
            }
        } catch (PDOException $e) {
            array_push($errors, $e->getMessage());
        }
    }
}

if (isset($_POST['log_out'])) {
    $user->log_out_user();
    session_unset();
    $response = '
    <div class="alert alert-success alert-icon alert-dismissible fade show" role="alert">
        <i class="uil uil-check-circle"></i>Successfully Logged Out User</a>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $user->redirect('../view/index.php');
    $_SESSION['msg'] = $response;
}

// Check if admin log-in form is submitted
if (isset($_POST['admn_log_in'])) {
    // Retrieve form input

    $user_email = trim($_POST['user_name_email']);
    $user_password = trim($_POST['user_password']);

    $user_ip =  $_SERVER['REMOTE_ADDR'];
    $token =  generateRandomString();
    $log_status = 1;

    // Check for empty and invalid inputs
    if (empty($user_email)) {

        $response =
            '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        Enter Username
            </div>
    </div>';

        $user->redirect('../manage/pages/auth-login.php');
        $_SESSION['msg'] = $response;
    } elseif (empty($user_password)) {

        $response =
            '<div class="alert alert-warning alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <div class="alert-title">Ooops</div>
                <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                       Enter Password
            </div>
    </div>';
        $user->redirect('../manage/pages/auth-login.php');
        $_SESSION['msg'] = $response;
    } else {
        // Check if the user may be logged in
        if ($user->admin_login($user_email, $user_password, $user_ip, $log_status, $token)) {


            $response =
                '<div class="alert alert-success alert-has-icon">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                            <div class="alert-title">Success</div>
                            <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                    </button>
                            Successfully Logged in
                        </div>
                </div>';
            $user->redirect('../manage/pages/welcome.php');
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
                                        Incorrect log-in credentials.
                            </div>
                    </div>';
            $user->redirect('../manage/pages/auth-login.php');
            $_SESSION['msg'] = $response;
        }
    }
}
