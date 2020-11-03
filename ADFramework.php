<?php

function baglan($host, $dbname, $username, $password)
{
    try {
        return $db = new PDO("mysql:host=". $host .";dbname=".$dbname, $username, $password);
    } catch (PDOEXception $th) {
        return $th->getMessage();
    }
}

function veriEkle($database, $table, $name, $data)
{
    $sql1 = implode(',', $name);
    $sql2 = implode(',', array_fill(0, count($data), '?'));

    $sql = "INSERT INTO " . $table;
    $sql .= " (". $sql1 .") ";
    $sql .= "VALUES (". $sql2 . ")";

    try {
        $add = $database->prepare($sql);
        $add->execute(array_values($data));

        if($add) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $th) {
        return false;
    }
}

function veriCek($database, $table, $where = null, $data = null)
{
    if($where != null && $data != null){
        $sql = "SELECT * FROM " . $table;
        $sql .= " WHERE " . $where;
        $sql .= " = ?";
    }else{
        $sql = "SELECT * FROM " . $table;
    }

    try {
        $get = $database->prepare($sql);

        if($where != null && $data != null){
            $get->execute(array($data));
            if($get->rowCount()){
                $row = $get->fetch(PDO::FETCH_OBJ);
                return $row;
            }else{
                return false;
            }
        }else{
            $get->execute();
            if($get->rowCount()){
                return $get;
            }else{
                return false;
            }
        }
    } catch (Exception $th) {
        return $th->getMessage;
    }
}

function veriSil($database, $table, $where, $data)
{
    $sql = "DELETE FROM " . $table;
    $sql .= " WHERE " . $where;
    $sql .= " = ?";

    try {
        $delete = $database->prepare($sql);
        $delete->execute(array($data));
        
        if($delete){
            return true;
        }else{
            return false;
        }
    } catch (Exception $th) {
        return false;
    }
}

function veriGuncelle($database, $table, $name, $value, $where = null, $data = null)
{
    $set = "";
    for($i = 0; $i < count($name); $i++){
        $set .= "`$name[$i]` = ?";
        if($i != count($name)-1) $set .= ",";
    }
    if($where != null && $data != null)
        $sql = "UPDATE $table SET " . $set . " WHERE $where = ?";
    else
        $sql = "UPDATE $table SET " . $set;

    try {
        array_push($value, $data);
        $update = $database->prepare($sql);
        $update->execute($value);

        if($update){
            return true;
        }else{
            return false;
        }
    } catch (Exception $th) {
        return false;
    }
}

function satirSay($database, $table)
{
    $sql = "SELECT * FROM " . $table;

    try {
        $say = $database->prepare($sql);
        $say->execute();
        return $say->rowCount();
    } catch (Exception $th) {
        return $th->getMessage();
    }
}

function post($parameter, $slashes = false)
{
    if($slashes == false){
        $result = strip_tags(trim($_POST[$parameter]));
    }elseif($slashes == true){
        $result = strip_tags(trim(addslashes($_POST[$parameter])));
    }

    return $result;
}

function getIP()
{
    if(getenv("HTTP_CLIENT_IP")){
        $ip = getenv("HTTP_CLIENT_IP");
    }elseif(getenv("HTTP_X_FORWARDED_FOR")){
        $ip = getenv("HTTP_X_FORWARDED_FOR");

        if(strstr($ip, ',')){
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }else{
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}