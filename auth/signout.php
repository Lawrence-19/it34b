<?php
require_once '../config/config.php';

$_SESSION = [];

header('Location: ' . BASE_URL . '/index.php');
exit;
?>