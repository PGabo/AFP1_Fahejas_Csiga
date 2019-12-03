<?php
if (!empty($_GET['code']) && isset($_GET['code'])) {
    include_once("./config/config.php");
    include_once ("./config/User.php");
    include_once ("./functions.php");
     $db = new Database();
     $connection = $db->DB_Connect();
     $account = new Account($connection);
     if(!($account->Activate($_GET['code'])))  exitAlertRedirect('Sikertelen aktiválás', 'index.php');
}
?>