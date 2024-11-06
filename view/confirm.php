<?php
if(!isset($_SESSION)){
    session_start();
}

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
    if ($_POST["submit"] == "削除") {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $date = $_POST["date"];
        $shift_in = $_POST["shift_in"];
        $shift_out = $_POST["shift_out"];
        $break_in_1 = $_POST["break_in_1"];
        $break_out_1 = $_POST["break_out_1"];
        $break_in_2 = $_POST["break_in_2"];
        $break_out_2 = $_POST["break_out_2"];
    } else {
        if ($_POST["submit"] == "編集") {
            $id = $_POST["id"];
        }
        $name = preg_replace("/\s|　/", "", $_POST["name"]);
        $date = $_POST["date"];
        $shift_in = $_POST["shift_in_h"] . ":" . $_POST["shift_in_m"];
        $shift_out = $_POST["shift_out_h"] . ":" . $_POST["shift_out_m"];

        $in = $_POST["shift_in_h"] . $_POST["shift_in_m"];
        $out = $_POST["shift_out_h"] . $_POST["shift_out_m"];
        if (intval($in) >= intval($out)) {
            $_SESSION["message"] = "勤怠情報が不正です。";
            if($_POST["submit"] == "確認") {
                header('Location: ../view/set.php');
            }
            if($_POST["submit"] == "編集") {
                header('Location: ../view/detail.php');
            }
        }

        if ($_POST["break_in_h_1"] and $_POST["break_in_m_1"] and $_POST["break_out_h_1"] and $_POST["break_out_m_1"]) {
            $break_in_1 = $_POST["break_in_h_1"] . ":" . $_POST["break_in_m_1"];
            $break_out_1 = $_POST["break_out_h_1"] . ":" . $_POST["break_out_m_1"];

            $b_in = $_POST["break_in_h_1"] . $_POST["break_in_m_1"];
            $b_out = $_POST["break_out_h_1"] . $_POST["break_out_m_1"];
            if (intval($b_in) >= intval($b_out) or intval($in) >= intval($b_in) or intval($out) <= intval($b_out)) {
                $_SESSION["message"] = "勤怠情報が不正です。";
                if($_POST["submit"] == "確認") {
                    header('Location: ../view/set.php');
                }
                if($_POST["submit"] == "編集") {
                    header('Location: ../view/detail.php');
                }
                
            }
        }

        if ($_POST["break_in_h_2"] and $_POST["break_in_m_2"] and $_POST["break_out_h_2"] and $_POST["break_out_m_2"]) {
            $break_in_2 = $_POST["break_in_h_2"] . ":" . $_POST["break_in_m_2"];
            $break_out_2 = $_POST["break_out_h_2"] . ":" . $_POST["break_out_m_2"];

            $b_in2 = $_POST["break_in_h_2"] . $_POST["break_in_m_2"];
            $b_out2 = $_POST["break_out_h_2"] . $_POST["break_out_m_2"];
            if (intval($b_in2) >= intval($b_out2) or 
                intval($b_out) >= intval($b_in2) or 
                intval($out) <= intval($b_out2)){
                $_SESSION["message"] = "勤怠情報が不正です。";
                if($_POST["submit"] == "確認") {
                    header('Location: ../view/set.php');
                }
                if($_POST["submit"] == "編集") {
                    header('Location: ../view/detail.php');
                }
            }
        }
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
    <h1>確認ページ</h1>
    <p>登録内容</p>

    <table class="shift_table" border="0">
        <tr>
            <th>従業員名</th>
            <th>出勤日</th>
            <th>出勤時間</th>
            <th>退勤時間</th>

            <?php if ($break_in_1) { ?>
            <th>休憩in</th>
            <th>休憩out</th>

            <?php } if ($break_in_2) { ?>
            <th>休憩in（2）</th>
            <th>休憩out（2）</th>
            <?php } ?>
        </tr>
        <tr>
            <td><?=$name;?></td>
            <td><?=$date;?></td>
            <td><?=$shift_in;?></td>
            <td><?=$shift_out;?></td>

            <?php if ($break_in_1) { ?>
            <td><?php echo $break_in_1;?></td>
            <td><?php echo $break_out_1;?></td>

            <?php } if ($break_in_2) { ?>
            <td><?php echo $break_in_2;?></td>
            <td><?php echo $break_out_2;?></td>
            <?php } ?>
        </tr>
    </table>
    <form action="../controler/shiftAdd.php" method="POST">
        <input type="hidden" name="id" value="<?=$id;?>">
        <input type="hidden" name="name" value="<?=$name;?>">
        <input type="hidden" name="date" value="<?=$date;?>">
        <input type="hidden" name="shift_in" value="<?=$shift_in;?>">
        <input type="hidden" name="shift_out" value="<?=$shift_out;?>">
        <input type="hidden" name="break_in_1" value="<?=$break_in_1;?>">
        <input type="hidden" name="break_out_1" value="<?=$break_out_1;?>">
        <input type="hidden" name="break_in_2" value="<?=$break_in_2;?>">
        <input type="hidden" name="break_out_2" value="<?=$break_out_2;?>">
        <input type="submit" name="submit" value="<?=$_POST["submit"];?>" class="shift_regist_button">
        <button onclick="location.href='home.php'" class="shift_regist_button">勤怠画面に戻る</button>
    </form>
</body>
</html>