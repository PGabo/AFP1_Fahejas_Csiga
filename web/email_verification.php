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
<!DOCTYPE html>
<html lang="hu">
<?php require ('./html/head.html');?>
<body>
<?php require('nav.php');?>
<div class="container-fluid">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-xs-12">
                <h3>Verifikálta e-mail címét </h3>
                <hr>
                <p></p>
                <p> Most már be tud jelentkezni.</p>
                <p>A bejelentkezéshez <a href="login.php">kattintson ide</a>.</p>
            </div>
        </div>
        <hr>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
        </div>
    </div>
    <hr>
</div>
<?php require('./html/footer.html'); ?>
</html>