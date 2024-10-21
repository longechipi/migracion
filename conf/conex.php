<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "paymedglobal";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$mysqli->set_charset("utf8");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
