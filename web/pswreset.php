<?php
if (isset($_POST['email'])) {
    include_once("./config/config.php");
    include_once("functions.php");
    include_once("./config/User.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $user = new Account($connection);
    $email = $_POST['email'];
    if (!$user->IsVerifiedEmail($email))
        exitAlert("Kérem először regisztráljon be vagy aktiválja regisztrált fiókját!");
    $token = $user->AddNewPwd($email, 600);
    if ($token === false)
        exitAlert("A művelet nem sikerült.");
    $headers = null;
    $to = $email;
    $subject = "E-mail visszaállítása (Állatvedők)";
    $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
    $from = "=?UTF-8?B?" . base64_encode("Állatmentők") . "?=";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: ' . $from . ' <mailing.tester.none@gmail.com>' . "\r\n";
    $ms = null;
    $ms .= "<html lang='hu'></body><div><div>Kedves Felhasználó,</div></br></br>";
    $ms .= "<div style='padding-top:8px;'>Kérem kattinston a linkre az email visszaállítása érdekében.</div>
<div style='padding-top:10px;'><a href='http://172.16.24.192/allatmentok/pswreset.php?email=$email&token=$token'>Katt ide</a></div>
</div>
</body></html>";
    mail($to, $subject, $ms, $headers);
    exitAlertRedirect('Kérem nézze meg email fiókját a jelszó helyreállításához!', 'login.php');
}
?>
<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html');?>
<body class="login-body">
<?php require("nav.php"); ?>
    <main class="container-fluid">
        <div class="col-sm-12>
            <div class="row">
                <div class="col-xs-12 lilpadding container border">
                    <h1>Jelszó Emlékeztető</h1>
                    <?php
                    if (!isset($_GET['email'])) {
                        echo '<form class="pswresetform" action="" method="post">
        <label>Kérem adja meg email címét</label>
        <input type="email" name="email" class="form-control" > <br>
        <input class="btn btn-primary" type="submit" value="Küldés">

    </form>';
                    } else {
                        echo '<form action="" method="post">
        <input type="password" name="password" class="form-control" > <br>
        <input type="password" name="confPassword" class="form-control"> <br>
        <input type="submit"  class="btn" value="Küldés">

    </form>';
                    }
                    if (isset($_POST['password']) && isset($_POST['confPassword'])) {
                        include_once("./config/config.php");
                        include_once("functions.php");
                        include_once("./config/User.php");
                        passwordVerify($_POST['password'], $_POST['confPassword']);
                        $db = new Database();
                        $connection = $db->DB_Connect();
                        $user = new Account($connection);
                        $user->RemoveAllExpired();
                        $options = [
                            'cost' => 15 // the default cost is 10
                        ];
                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);
                        $email = $_GET['email'];
                        $token = $_GET['token'];
                        exitAlertRedirect(($user->UpdatePsw($password, $email, $token) ? "Sikeres" : "Sikertelen") . " Művelet!", 'login.php');
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php require('./html/footer.html'); ?>
</body>
</html>