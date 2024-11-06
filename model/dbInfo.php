<?php
function selectShift($dbh, $date) {
    try {
        $items = 'SELECT * FROM shift_table WHERE shift_date = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1, $date);
        $stmt -> execute();
        $dbh = null;
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function selectShiftTime($dbh, $date, $name) {
    try {
        $items = 'SELECT * FROM shift_table WHERE shift_date = ? AND name = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1, $date);
        $stmt -> bindValue(2, $name);
        $stmt -> execute();
        $dbh = null;
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift_in($dbh, $id, $time) {
    try{
        $items = 'UPDATE `shift_table` SET shift_in_f = 1, shift_in = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$time);
        $stmt -> bindValue(2,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift_rest_in_1($dbh, $id, $time) {
    try{
        $items = 'UPDATE `shift_table` SET rest_in_1_f = 1, rest_in_1 = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$time);
        $stmt -> bindValue(2,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift_rest_in_2($dbh, $id, $time) {
    try{
        $items = 'UPDATE `shift_table` SET rest_in_2_f = 1, rest_in_2 = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$time);
        $stmt -> bindValue(2,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift_out($dbh, $id, $time) {
    try{
        $items = 'UPDATE `shift_table` SET shift_out_f = 1, shift_out = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$time);
        $stmt -> bindValue(2,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift_rest_out_1($dbh, $id, $time) {
    try{
        $items = 'UPDATE `shift_table` SET rest_out_1_f = 1, rest_out_1 = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$time);
        $stmt -> bindValue(2,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift_rest_out_2($dbh, $id, $time) {
    try{
        $items = 'UPDATE `shift_table` SET rest_out_2_f = 1, rest_out_2 = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$time);
        $stmt -> bindValue(2,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function insertShift($dbh, $name, $date, $shift_in, $shift_out, $break_in_1, $break_out_1, $break_in_2, $break_out_2) {
    try{
        $items = 'INSERT INTO `shift_table`(`name`, `shift_in`, `shift_out`, `rest_in_1`, `rest_out_1`, `rest_in_2`, `rest_out_2`, `shift_date`) VALUES (?,?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$name);
        $stmt -> bindValue(2,$shift_in);
        $stmt -> bindValue(3,$shift_out);
        $stmt -> bindValue(4,$break_in_1);
        $stmt -> bindValue(5,$break_out_1);
        $stmt -> bindValue(6,$break_in_2);
        $stmt -> bindValue(7,$break_out_2);
        $stmt -> bindValue(8,$date);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function attendShift($dbh, $name, $date, $shift_in, $shift_out, $break_in_1, $break_out_1, $break_in_2, $break_out_2) {
    try{
        $items = 'INSERT INTO `shift_table`(`name`, `shift_in`, `shift_in_f`, `shift_out`, `rest_in_1`, `rest_out_1`, `rest_in_2`, `rest_out_2`, `shift_date`) VALUES (?,?,1,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$name);
        $stmt -> bindValue(2,$shift_in);
        $stmt -> bindValue(3,$shift_out);
        $stmt -> bindValue(4,$break_in_1);
        $stmt -> bindValue(5,$break_out_1);
        $stmt -> bindValue(6,$break_in_2);
        $stmt -> bindValue(7,$break_out_2);
        $stmt -> bindValue(8,$date);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function updateShift($dbh, $id, $name, $date, $shift_in, $shift_out, $break_in_1, $break_out_1, $break_in_2, $break_out_2) {
    try{
        $items = 'UPDATE `shift_table` SET `shift_in` = ?, `shift_out` = ?, `rest_in_1` = ?, `rest_out_1` = ?, `rest_in_2` = ?, `rest_out_2` = ?, `shift_date` = ? WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$shift_in);
        $stmt -> bindValue(2,$shift_out);
        $stmt -> bindValue(3,$break_in_1);
        $stmt -> bindValue(4,$break_out_1);
        $stmt -> bindValue(5,$break_in_2);
        $stmt -> bindValue(6,$break_out_2);
        $stmt -> bindValue(7,$date);
        $stmt -> bindValue(8,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}

function deleteShift($dbh, $id) {
    try{
        $items = 'DELETE FROM `shift_table` WHERE id = ?';
        $stmt = $dbh->prepare($items);
        $stmt -> bindValue(1,$id);
        $stmt -> execute();
 
        $dbh = null;
        return true;
    }catch (PDOException $e){
        print 'エラーが発生しました';
        var_dump($e);
        return false;
    }
}