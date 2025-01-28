<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: welcome.blade.php');
    exit;
}
?>
