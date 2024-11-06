<?php
if(!isset($_SESSION)){
    session_start();
}

require("../model/dbConnect.php");
require("../model/dbInfo.php");
date_default_timezone_set('Asia/Tokyo');
$dbh = dbConnection();
$date = date("Y/m/d");
$time = date("H:i");

$shift_id = [];
$shift_name = [];
$shift_in = [];
$shift_in_flag = [];
$shift_break_in = [];
$shift_break_in_flag = [];
$shift_break_out = [];
$shift_break_out_flag = [];
$shift_break_in_2 = [];
$shift_break_in_2_flag = [];
$shift_break_out_2 = [];
$shift_break_out_2_flag = [];
$shift_out = [];
$shift_out_flag = [];

if($dbh != false){
    $shift = selectShiftTime($dbh, $_POST["date"], preg_replace("/\s|　/", "", $_POST["name"]));

    foreach($shift as $item) {
        array_push($shift_id,$item["id"]);
        array_push($shift_name,$item["name"]);
        array_push($shift_in,$item["shift_in"]);
        array_push($shift_in_flag,$item["shift_in_f"]);
        array_push($shift_break_in,$item["rest_in_1"]);
        array_push($shift_break_in_flag,$item["rest_in_1_f"]);
        array_push($shift_break_out,$item["rest_out_1"]);
        array_push($shift_break_out_flag,$item["rest_out_1_f"]);
        array_push($shift_break_in_2,$item["rest_in_2"]);
        array_push($shift_break_in_2_flag,$item["rest_in_2_f"]);
        array_push($shift_break_out_2,$item["rest_out_2"]);
        array_push($shift_break_out_2_flag,$item["rest_out_2_f"]);
        array_push($shift_out,$item["shift_out"]);
        array_push($shift_out_flag,$item["shift_out_f"]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($shift) {
        if ($_POST["submit"] === "出勤") { # 出勤ボタンが押されたかどうか
            if ($shift_in_flag[0] != 1) {
                $result = updateShift_in($dbh, $shift_id[0], $time);
            } else {
                $_SESSION["message"] = "すでに出勤登録されています";
            }
        } else { #出勤以外のボタンが押された場合
            if ($shift_in_flag[0] == 1) { # 出勤登録がされているか
                if ($shift_out_flag[0] != 1) {
                    if ($_POST["submit"] === "休憩in") {
                        if ($shift_break_in_flag[0] != 1) {
                            $result = updateShift_rest_in_1($dbh, $shift_id[0], $time);
                        } else {
                            $_SESSION["message"] = "すでに休憩登録されています";
                        }
                    }
                    if ($_POST["submit"] === "休憩out") {
                        if ($shift_break_in_flag[0] == 1) {
                            if ($shift_break_out_flag[0] != 1) {
                                $result = updateShift_rest_out_1($dbh, $shift_id[0], $time);
                            } else {
                                $_SESSION["message"] = "すでに休憩登録されています";
                            }
                        } else {
                            $_SESSION["message"] = "休憩登録がされていません";
                        }
                    }

                    if ($_POST["submit"] === "休憩in2") {
                        if ($shift_break_out_flag[0] == 1) {
                            if ($shift_break_in_2_flag[0] != 1) {
                                $result = updateShift_rest_in_2($dbh, $shift_id[0], $time);
                            } else {
                                $_SESSION["message"] = "すでに休憩登録されています";
                            }
                        } else {
                            $_SESSION["message"] = "休憩登録がされていません";
                        }
                    }
                    if ($_POST["submit"] === "休憩out2") {
                        if ($shift_break_in_2_flag[0] == 1) {
                            if ($shift_break_out_2_flag[0] != 1) {
                                $result = updateShift_rest_out_2($dbh, $shift_id[0], $time);
                            } else {
                                $_SESSION["message"] = "すでに休憩登録されています";
                            }
                        } else {
                            $_SESSION["message"] = "休憩登録がされていません";
                        }
                    }
                    if ($_POST["submit"] === "退勤") {
                        if ($shift_break_in_flag[0] == 1 and $shift_break_out_flag[0] == 0 or $shift_break_in_2_flag[0] == 1 and $shift_break_out_2_flag[0] == 0) {
                            $_SESSION["message"] = "休憩登録がされていません";
                        } else {
                            if ($shift_out_flag[0] != 1) {
                                $result = updateShift_out($dbh, $shift_id[0], $time);
                            } else {
                                $_SESSION["message"] = "すでに退勤登録されています";
                            }
                        }
                    }
                } else {
                    $_SESSION["message"] = "すでに退勤登録されています";
                }
            } else {
                $_SESSION["message"] = "出勤登録がされていません";
            }
        }
    } else {
        if ($_POST["submit"] === "出勤") {
            $result = attendShift($dbh, preg_replace("/\s|　/", "", $_POST["name"]), $date, $time, "", "", "", "", "");
        } else {
            $_SESSION["message"] = "出勤登録がされていません";
        }
    }
}
header('Location: ../view/home.php');