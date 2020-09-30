<?php

session_start();
$_session['username'];
session_unset();
header('location:index.php');

?>