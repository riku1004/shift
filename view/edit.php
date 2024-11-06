<?php

$name = "";
$id = "";
$date = "";
$shift_in = "";
$shift_out = "";
$break_in_1 = "";
$break_out_1 = "";
$break_in_2 = "";
$break_out_2 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $id = $_POST["id"];
    $date = $_POST["date"];
    $shift_in = $_POST["shift_in"];
    $shift_out = $_POST["shift_out"];

    if ($_POST["break_in_1"] and $_POST["break_out_1"]) {
        $break_in_1 = $_POST["break_in_1"];
        $break_out_1 = $_POST["break_out_1"];
    }

    if ($_POST["break_in_2"] and $_POST["break_out_2"]) {
        $break_in_2 = $_POST["break_in_2"];
        $break_out_2 = $_POST["break_out_2"];
    }

} else {
    header('Location: ../view/home.php');
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
    <form action="confirm.php" method="POST">
        <input type="hidden" name="id" value="<?=$id;?>">
        <p style="padding-bottom: 20px;">登録者名：<input type="text" name="name" value="<?=$name;?>" class="form_name" required></p>

        <div class="shift_content">
            <p>勤務日：<input type="date" name="date" class="date" value="<?=$date;?>" required>
        </div>

        <div class="shift_content">
            <p>勤務時間</p>
            <p>
                <select name="shift_in_h" class="time" required>
                    <option value="<?=substr($shift_in, 0, 2);?>" selected><?=substr($shift_in, 0, 2);?></option>
                <?php
                    for ($i=5; $i <= 23; $i++) {
                        $num = $i;
                        if (strlen($i) == 1) {$num = 0 . $i;}
                        echo "<option value='" . $num . "'>" . $num . "</option>";
                    }
                    ?>
                </select>
                :
                <select name="shift_in_m" class="time" required>
                    <option value="<?=substr($shift_in, 3, 2);?>" selected><?=substr($shift_in, 3, 2);?></option>
                    <?php
                        for ($i=0; $i <= 59; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                ～
                <select name="shift_out_h" class="time">
                    <option value="<?=substr($shift_out, 0, 2);?>" selected><?=substr($shift_out, 0, 2);?></option>
                    <?php
                        for ($i=5; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="shift_out_m" class="time">
                    <option value="<?=substr($shift_out, 3, 2);?>" selected><?=substr($shift_out, 3, 2);?></option>
                    <?php
                        for ($i=0; $i <= 59; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
            </p>
        </div>
        
        <div class="shift_content">
            <p>休憩時間</p>
            <p>
                <select name="break_in_h_1" class="time">
                    <option value="<?=substr($break_in_1, 0, 2);?>" selected><?=substr($break_in_1, 0, 2);?></option>
                    <?php
                        for ($i=5; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_in_m_1" class="time">
                    <option value="<?=substr($break_in_1, 3, 2);?>" selected><?=substr($break_in_1, 3, 2);?></option>
                    <?php
                        for ($i=0; $i <= 59; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                        
                    ?>
                </select>
                ～
                <select name="break_out_h_1" class="time">
                    <option value="<?=substr($break_out_1, 0, 2);?>" selected><?=substr($break_out_1, 0, 2);?></option>
                    <?php
                        for ($i=5; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_out_m_1" class="time">
                    <option value="<?=substr($break_out_1, 3, 2);?>" selected><?=substr($break_out_1, 3, 2);?></option>
                    <?php
                        for ($i=0; $i <= 59; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
            </p>
        </div>
        
        <div class="shift_content">
            <p>休憩時間 (2)</p>
            <p>
                <select name="break_in_h_2" class="time">
                    <option value="<?=substr($break_in_2, 0, 2);?>" selected><?=substr($break_in_2, 0, 2);?></option>
                    <?php
                        for ($i=5; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_in_m_2" class="time">
                    <option value="<?=substr($break_in_2, 3, 2);?>" selected><?=substr($break_in_2, 3, 2);?></option>
                    <?php
                        for ($i=0; $i <= 59; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                ～
                <select name="break_out_h_2" class="time">
                    <option value="<?=substr($break_out_2, 0, 2);?>" selected><?=substr($break_out_2, 0, 2);?></option>
                    <?php
                        for ($i=5; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_out_m_2" class="time">
                    <option value="<?=substr($break_out_2, 3, 2);?>" selected><?=substr($break_out_2, 3, 2);?></option>
                    <?php
                        for ($i=0; $i <= 59; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
            </p>
        </div>
        <input type="submit" name="submit" value="編集" class="shift_regist_button">
    </form>
    <a href="home.php">勤怠入力ページ</a>
    <br>
    <a href="detail.php">シフト確認ページ</a>
</body>
</html>