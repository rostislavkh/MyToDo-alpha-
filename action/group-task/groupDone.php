<?php
require $_SERVER['DOCUMENT_ROOT'] . '/MyToDo/db/dbconfig.php';
$id = $_GET["id"];
$email = $_COOKIE["email"];

$mysql->query("UPDATE `register` SET `group_task` = '$id' WHERE `register`.`secure_key` = '$email'");

$mysql->query("UPDATE `group_task` SET `activity` = 0 WHERE `group_task`.`user_id` = '$email'");

$mysql->query("UPDATE `group_task` SET `activity` = 1 WHERE `group_task`.`id` = $id");

$result = $mysql->query("SELECT * FROM `group_task` WHERE `id` = '$id'");
$mysql->close();
$gr_id = $result->fetch_assoc();

setcookie("name_group", $gr_id["name"], time() + 3600 * 4, "/");
setcookie("group", $id, time() + 3600 * 4, "/");

header("Location: /MyToDo/index.php");
?>