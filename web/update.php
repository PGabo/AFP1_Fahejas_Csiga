<?php
session_start();
if (isset($_SESSION['login'])) {
    include_once("./config/config.php");
    include_once("./config/User.php");
    include_once("./functions.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $update = new Account($connection);
    $nev = $_POST['nev'];
    $Cim = $_POST['Cim'];
    $megye = $_POST['megye'];
    $elerhetoseg = $_POST['elerhetoseg'];
    $ado = $_POST['ado'];
    $weblink = $_POST['weblink'];
    if ($_SESSION['admin']) {
        $id = $_POST['id'];
        $prop = "id";
    } else {
        $id = $_SESSION['id'];
        $prop = 'madeby';
    }
    $data =
        [
            'nev' => $nev,
            'Cim' => $Cim,
            'megye' => $megye,
            'elerhetoseg' => $elerhetoseg,
            'ado' => $ado,
            'weblink' => $weblink,
            'id' => $id
        ];
    $sql = $update->UpdateRecords($data, $prop);
    $db->Disconnect();
    if ($sql)
        exitAlertRedirect('Sikeres módosítás', 'index.php');
    else
        exitAlertRedirect('Sikertelen módosítás', 'modify.php');
}