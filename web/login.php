<?php
session_start();
$_SESSION['action1'] = "";
if (isset($_POST['login']) && $_POST['login']) {
    include_once("./config/config.php");
    include_once ("./config/User.php");
    include_once("functions.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $acc=new Account($connection);
    $email = $_POST['email'];
    $user = $acc->SelectUserByEmail($email);
    if ($user === false)
        loginErrorMessage();

    if (!$acc->CheckPassword($user['id'], $_POST['password']))
        loginErrorMessage();
    $_SESSION['login'] = $email;
    $_SESSION['id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['admin'] = $user['admin'];
    if ($user['status'] == 0) {
        $_SESSION['action1'] = "Erősítse meg e-mail címét! A link az e-mailjei között található.";
    } else {
        header("Location:index.php");
    }
}
?>