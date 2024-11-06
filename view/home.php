<?php
if(!isset($_SESSION)){
    session_start();
}

require("../model/dbConnect.php");
require("../model/dbInfo.php");
$dbh = dbConnection();
date_default_timezone_set('Asia/Tokyo');

$id = [];
$name = [];
$shift_in = [];
$shift_in_flag = [];
$break_in_1 = [];
$break_in_1_flag = [];
$break_out_1 = [];
$break_out_1_flag = [];
$break_in_2 = [];
$break_in_2_flag = [];
$break_out_2 = [];
$break_out_2_flag = [];
$shift_out = [];
$shift_out_flag = [];

$date = date("Y/m/d");

if($dbh != false){
    $items = selectShift($dbh, $date);
    foreach($items as $item) {
        array_push($id,$item["id"]);
        array_push($name,$item["name"]);
        array_push($shift_in,$item["shift_in"]);
        array_push($shift_in_flag,$item["shift_in_f"]);
        array_push($break_in_1,$item["rest_in_1"]);
        array_push($break_in_1_flag,$item["rest_in_1_f"]);
        array_push($break_out_1,$item["rest_out_1"]);
        array_push($break_out_1_flag,$item["rest_out_1_f"]);
        array_push($break_in_2,$item["rest_in_2"]);
        array_push($break_in_2_flag,$item["rest_in_2_f"]);
        array_push($break_out_2,$item["rest_out_2"]);
        array_push($break_out_2_flag,$item["rest_out_2_f"]);
        array_push($shift_out,$item["shift_out"]);
        array_push($shift_out_flag,$item["shift_out_f"]);
    }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>勤怠アプリ</title>
</head>
<body>

    <form action="../controler/shiftControl.php" method="POST">
        <table border="0">
            <input type="hidden" name="date" value="<?=$date;?>">
            <tr><td colspan="3" style="text-align:left;"><a style="cursor:default;">従業員名：</a><input type="text" name="name" class="form_name" required></td></tr>
            <tr>
                <td><input type="submit" name="submit" value="出勤" class="form_button"></td>
                <td><input type="submit" name="submit" value="休憩in" class="form_button"></td>
                <td><input type="submit" name="submit" value="休憩in2" class="form_button"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="退勤" class="form_button"></td>
                <td><input type="submit" name="submit" value="休憩out" class="form_button"></td>
                <td><input type="submit" name="submit" value="休憩out2" class="form_button"></td>
            </tr>
        </table>
    </form>

    <?php 
        if (isset($_SESSION["message"])) {
            echo "<p style='color:red;'>" . $_SESSION["message"] . "</p>";
            $_SESSION["message"] = "";
        }
    ?>

    <table class="shift_table" border="0">
        <tr>
            <th>従業員名</th>
            <th>出勤</th>
            <th>休憩in</th>
            <th>休憩out</th>
            <th>休憩in (2)</th>
            <th>休憩out (2)</th>
            <th>退勤</th>
        </tr>
        <?php
            for ($i=0; $i<count($id); $i++) {
                echo "<tr><td>" . $name[$i] . "</td><td style='";

                    if ($shift_in_flag[$i] == 0) {
                        echo "color:blue;";
                    } else {
                        echo "color:black; font-weight:bold;";
                    }
                echo "'>" . $shift_in[$i] . "</td><td style='";

                    if ($break_in_1_flag[$i] == 0) {
                        echo "color:blue;";
                    } else {
                        echo "color:black; font-weight:bold;";
                    }
                echo "'>" . $break_in_1[$i] . "</td><td style='";

                    if ($break_out_1_flag[$i] == 0) {
                        echo "color:blue;";
                    } else {
                        echo "color:black; font-weight:bold;";
                    }
                echo "'>" . $break_out_1[$i] . "</td><td style='";
                    if ($break_in_2_flag[$i] == 0) {
                        echo "color:blue;";
                    } else {
                        echo "color:black; font-weight:bold;";
                    }
                echo "'>" . $break_in_2[$i] . "</td><td style='";

                    if ($break_out_2_flag[$i] == 0) {
                        echo "color:blue;";
                    } else {
                        echo "color:black; font-weight:bold;";
                    }
                echo "'>" . $break_out_2[$i] . "</td><td style='";

                    if ($shift_out_flag[$i] == 0) {
                        echo "color:blue;";
                    } else {
                        echo "color:black; font-weight:bold;";
                    }
                echo "'>" . $shift_out[$i] . "</td></tr>";

            }
        ?>
    </table>

    <a href="set.php">シフト追加ページ</a>
    <br>
    <a href="detail.php">シフト確認ページ</a>
</body>
</html>