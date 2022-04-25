<?php
require_once('../controller/start.inc.php');
// logout
session_unset();
session_destroy();

header('Location: ../manage');
?>