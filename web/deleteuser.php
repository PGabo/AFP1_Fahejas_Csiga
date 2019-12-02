<?php
include_once('functions.php');
session_start();
if (!isset($_POST['deletepw']))
    exitAlertRedirect('Sikertelen törlés - nem adott meg jelszót', 'modify.php');
if (!isset($_SESSION['login']))
    exitAlertRedirect('Sikertelen törlés - nincs bejelentkezett felhasználó!', 'logout.php');

include_once("./config/config.php");
include_once("./config/User.php");

$db = new Database();
$connection = $db->DB_Connect();
$user = new Account($connection);
if (!$user->CheckPassword($_SESSION['id'], $_POST['deletepw']))
    exitAlertRedirect('Rossz jelszót adtál meg!', 'modify.php');
$sql = $user->DeleteUser($_SESSION['id']);
$db->Disconnect();
exitAlertRedirect($sql ? 'Sikeres törlés!' : 'Sikertelen törlés!', 'logout.php');
?>

