<?php
session_start();

if(isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
} else {
    $username = null;
}