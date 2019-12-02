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
<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html');?>
<body class="login-body">
<?php require("nav.php"); ?>
<main>
<div class="container-fluid">
    <div class="col-sm-6">
        <div class="row">
            <div class="col-xs-12 container border">
                <h3>Bejelentkezés </h3>
                <hr>
                <form class="modifyform" name="insert" action="" method="post">
                    <h3><?php echo $_SESSION['action1']; ?></h3>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" id="email" value="" class="form-control" required/>
                    </div>
                    <div>
                        <label>Jelszó</label>
                        <input type="password" name="password" id="password" value="" class="form-control" required/>
                    </div>
                    <div><input type="submit" name="login" value="Bejelentkezés" class="submitbtn btn btn-primary"/>
                    </div>
                    <div class="pswremcon">
                                    Elfelejtetted a jelszavad? Akkor kattints <a href="pswreset.php" class="btn btn-success">ide.</a>
                                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>