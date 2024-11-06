<?php
if(!isset($_SESSION)){
    session_start();
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
    <?php 
        if (isset($_SESSION["message"])) {
            echo "<p style='color:red;'>" . $_SESSION["message"] . "</p>";
            $_SESSION["message"] = "";
        }
    ?>
    <form action="confirm.php" method="POST">
        <p style="padding-bottom: 20px;">登録者名：<input type="text" name="name" class="form_name" required></p>

        <div class="shift_content">
            <p>勤務日：<input type="date" name="date" class="date" required>
        </div>

        <div class="shift_content">
            <p>勤務時間</p>
            <p>
                <select name="shift_in_h" class="time" required>
                    <option value="" selected></option>
                <?php
                    for ($i=7; $i <= 23; $i++) {
                        $num = $i;
                        if (strlen($i) == 1) {$num = 0 . $i;}
                        echo "<option value='" . $num . "'>" . $num . "</option>";
                    }
                    ?>
                </select>
                :
                <select name="shift_in_m" class="time" required>
                    <option value="" selected></option>
                    <?php
                        for ($i=0; $i <= 55; $i++) {
                            if ($i % 5 == 0) {
                                $num = $i;
                                if (strlen($i) == 1) {$num = 0 . $i;}
                                echo "<option value='" . $num . "'>" . $num . "</option>";
                            }
                        }
                    ?>
                </select>
                ～
                <select name="shift_out_h" class="time" required>
                    <option value="" selected></option>
                    <?php
                        for ($i=7; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="shift_out_m" class="time" required>
                    <option value="" selected></option>
                    <?php
                        for ($i=0; $i <= 55; $i++) {
                            if ($i % 5 == 0) {
                                $num = $i;
                                if (strlen($i) == 1) {$num = 0 . $i;}
                                echo "<option value='" . $num . "'>" . $num . "</option>";
                            }
                        }
                    ?>
                </select>
            </p>
        </div>
        
        <div class="shift_content">
            <p>休憩時間</p>
            <p>
                <select name="break_in_h_1" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=7; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_in_m_1" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=0; $i <= 55; $i++) {
                            if ($i % 5 == 0) {
                                $num = $i;
                                if (strlen($i) == 1) {$num = 0 . $i;}
                                echo "<option value='" . $num . "'>" . $num . "</option>";
                            }
                        }
                    ?>
                </select>
                ～
                <select name="break_out_h_1" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=7; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_out_m_1" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=0; $i <= 55; $i++) {
                            if ($i % 5 == 0) {
                                $num = $i;
                                if (strlen($i) == 1) {$num = 0 . $i;}
                                echo "<option value='" . $num . "'>" . $num . "</option>";
                            }
                        }
                    ?>
                </select>
            </p>
        </div>
        
        <div class="shift_content">
            <p>休憩時間 (2)</p>
            <p>
                <select name="break_in_h_2" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=7; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_in_m_2" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=0; $i <= 55; $i++) {
                            if ($i % 5 == 0) {
                                $num = $i;
                                if (strlen($i) == 1) {$num = 0 . $i;}
                                echo "<option value='" . $num . "'>" . $num . "</option>";
                            }
                        }
                    ?>
                </select>
                ～
                <select name="break_out_h_2" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=7; $i <= 23; $i++) {
                            $num = $i;
                            if (strlen($i) == 1) {$num = 0 . $i;}
                            echo "<option value='" . $num . "'>" . $num . "</option>";
                        }
                    ?>
                </select>
                :
                <select name="break_out_m_2" class="time">
                    <option value="" selected></option>
                    <?php
                        for ($i=0; $i <= 55; $i++) {
                            if ($i % 5 == 0) {
                                $num = $i;
                                if (strlen($i) == 1) {$num = 0 . $i;}
                                echo "<option value='" . $num . "'>" . $num . "</option>";
                            }
                        }
                    ?>
                </select>
            </p>
        </div>
        <input type="submit" name="submit" value="登録" class="shift_regist_button">
    </form>
    <a href="home.php">勤怠入力ページ</a>
    <br>
    <a href="detail.php">シフト確認ページ</a>
</body>
</html>