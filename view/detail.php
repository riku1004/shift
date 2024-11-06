<?php
if(!isset($_SESSION)){
    session_start();
}

require("../model/dbConnect.php");
require("../model/dbInfo.php");
$dbh = dbConnection();
$date = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $date = $_POST["date"];
    
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
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <title>勤怠アプリ</title>
</head>
<body>
    <h1>シフト確認ページ</h1>
    <form action="" method="POST">
        <p>・日時検索　<input type="date" name="date" class="date" required></p>
        <?php 
            if (isset($_SESSION["message"])) {
                echo "<p style='color:red;'>" . $_SESSION["message"] . "</p>";
                $_SESSION["message"] = "";
            }
        ?>
        <input type="submit" value="検索" class="shift_regist_button">
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
        <hr style="width:100%;">
        <p>検索日時: <?php echo "20" . substr($date,2 ,2) . "年" . substr($date,5 ,2) . "月" . substr($date,8 ,2 ) . "日"; ?>

    <table class="shift_table" border="0">
        <tr>
            <th>従業員名</th>
            <th>出勤</th>
            <th>休憩in</th>
            <th>休憩out</th>
            <th>休憩in (2)</th>
            <th>休憩out (2)</th>
            <th>退勤</th>
            <th></th>
            <th></th>
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
                echo "'>" . $shift_out[$i] . "</td>";
                ?>
                <td>
                    <form action="edit.php" method="POST">
                        <input type="hidden" name="id" value="<?=$id[$i];?>">
                        <input type="hidden" name="name" value="<?=$name[$i];?>">
                        <input type="hidden" name="date" value="<?=$date;?>">
                        <input type="hidden" name="shift_in" value="<?=$shift_in[$i];?>">
                        <input type="hidden" name="shift_out" value="<?=$shift_out[$i];?>">
                        <input type="hidden" name="break_in_1" value="<?=$break_in_1[$i];?>">
                        <input type="hidden" name="break_out_1" value="<?=$break_out_1[$i];?>">
                        <input type="hidden" name="break_in_2" value="<?=$break_in_2[$i];?>">
                        <input type="hidden" name="break_out_2" value="<?=$break_out_2[$i];?>">
                        <input type="submit" value="編集" class="shift_edit_button">
                    </form>
                </td>
                <td>
                    <form action="confirm.php" method="POST">
                        <input type="hidden" name="id" value="<?=$id[$i];?>">
                        <input type="hidden" name="name" value="<?=$name[$i];?>">
                        <input type="hidden" name="date" value="<?=$date;?>">
                        <input type="hidden" name="shift_in" value="<?=$shift_in[$i];?>">
                        <input type="hidden" name="shift_out" value="<?=$shift_out[$i];?>">
                        <input type="hidden" name="break_in_1" value="<?=$break_in_1[$i];?>">
                        <input type="hidden" name="break_out_1" value="<?=$break_out_1[$i];?>">
                        <input type="hidden" name="break_in_2" value="<?=$break_in_2[$i];?>">
                        <input type="hidden" name="break_out_2" value="<?=$break_out_2[$i];?>">
                        <input type="submit" name="submit" value="削除" class="shift_edit_button">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php } ?>

    <a href="home.php">勤怠入力ページ</a>
    <br>
    <a href="set.php">シフト追加ページ</a>
</body>
</html>