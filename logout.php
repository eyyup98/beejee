<?php
ob_start();
session_start();
$_SESSION['user_role'] = null;
header("Location: index.php");
