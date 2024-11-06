<?php
if(!isset($_SESSION)){
    session_start();
}

require("../model/dbConnect.php");
require("../model/dbInfo.php");
$dbh = dbConnection();

date_default_timezone_set('Asia/Tokyo');

$id = "";
$name = "";
$date = "";
$shift_in = "";
$shift_out = "";
$break_in_1 = "";
$break_out_1 = "";
$break_in_2 = "";
$break_out_2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $date = $_POST["date"];
    $shift_in = $_POST["shift_in"];
    $shift_out = $_POST["shift_out"];
    $break_in_1 = $_POST["break_in_1"];
    $break_out_1 = $_POST["break_out_1"];
    $break_in_2 = $_POST["break_in_2"];
    $break_out_2 = $_POST["break_out_2"];

    $items = selectShift($dbh, $date);
    $in_name = [];
    foreach($items as $item) {
        array_push($in_name,$item["name"]);
    }
    if ($_POST["submit"] == "削除") {
            $result = deleteShift($dbh, $id);
    } else if ($_POST["submit"] == "編集") {
        $result = updateShift($dbh, $id, $name, $date, $shift_in, $shift_out, $break_in_1, $break_out_1, $break_in_2, $break_out_2);
    } else if ($_POST["submit"] == "登録") {
        if (in_array($name, $in_name)) {
            $_SESSION["message"] = "すでにシフト登録されています";
        } else {
            $result = insertShift($dbh, $name, $date, $shift_in, $shift_out, $break_in_1, $break_out_1, $break_in_2, $break_out_2);
        } 
    }
}header('Location: ../view/home.php');