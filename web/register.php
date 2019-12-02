<?php
if (isset($_POST['submit'])) {
    include_once("./config/config.php");
    include_once("./config/User.php");
    include_once("functions.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $account = new Account($connection);
    passwordVerify($_POST['password'], $_POST['password2']);
    if (strlen($_POST['password']) < 6)
        exitAlert('A jelszó túl rövid! Kérem legalább 6 karakter hosszú jelszavat válasszon!');
    $email = $_POST['email'];
    $nev = $_POST['nev'];
    $Cim = $_POST['Cim'];
    $megye = $_POST['megye'];
    $elerhetoseg = $_POST['elerhetoseg'];
    $ado = $_POST['ado'];
    $weblink = $_POST['weblink'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    if ($account->IsEmailInUse($email)) exitAlertRedirect('Ez az e-mail már használatban van.', 'register.php');
    $userdata =
        [
            'name' => $name,
            'email' => $email,
            'activationcode' =>  md5($email . time())
        ];
    if (!$account->SendVerifyingEmail($userdata)) exitAlertRedirect('Sikertelen email küldés', 'register.php');
    if (!$account->AddUser($userdata, $password)) exitAlertRedirect('Sikertelen adatrögzítés', 'register.php');
    $notuserdata =
        [
            'name' => $nev,
            'Cim' => $Cim,
            'megye' => $megye,
            'elerhetoseg' => $elerhetoseg,
            'ado' => $ado,
            'weblink' => $weblink,
            'id' => (int)$account->SelectUserIdByEmail($email)
        ];
    if (!$account->InsertRecord($notuserdata)) exitAlertRedirect('Sikertelen művelet', 'register.php');
    exitAlertRedirect('Sikeres regisztráció! Kérem erősítse meg e-mail címét.', 'login.php');
}
?>
<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html') ?>
<body>
<?php include_once("nav.php"); ?>
<main class="container-fluid">
    <div class="col-sm-12 ">
        <div class="row">
            <div class="col-xs-12 container border">
                <h3>Regisztráció</h3>
                <hr>
                <form class="modifyform" name="insert" action="" method="post">
                    <div>
                        <label>Név</label>
                                <input type="text" name="name" id="name" value="" placeholder="Felhasználó neve"
                                       class="form-control" required/>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" id="email" value=""
                               placeholder="pelda@pelda.com" class="form-control" required/>
                    </div>
                    <div>
                        <label>Jelszó</label>
                        <input type="password" name="password" id="password"
                               placeholder="minimum 6 karakter" value="" class="form-control"
                               required/>
                    </div>
                    <div>
                        <label>Jelszó megerősítés</label>
                        <td width="71%"><input type="password" name="password2" id="password2"
                                               placeholder="minimum 6 karakter" value="" class="form-control"
                                               required/>
                    </div>
                    <div>
                        <label>Egyesület neve</label>
                        <input type="text" name="nev" id="egyesuletnev" placeholder="Egyesület neve"
                               value="" class="form-control" required/>
                    </div>
                    <div>
                        <label>Cím, ahol található</label>
                        <input type="text" name="Cim" id="Cim" value="" placeholder="Cím"
                               class="form-control" required/>
                    </div>
                    <div>
                        <label>Megye</label>
                        <input type="text" name="megye" id="megye" value="" placeholder="Megye"
                               class="form-control"/>
                    </div>
                    <div>
                        <label>Elérhetőség</label>
                        <input type="text" name="elerhetoseg" id="elerhetoseg" placeholder="Telefon, email cím"
                               value="" class="form-control"/>
                    </div>
                    <div>
                        <label>Adó szám</label>
                        <input type="text" name="ado" id="ado" value="" placeholder="Adó szám"
                               class="form-control"/>
                    </div>
                    <div>
                        <label>
                            Weblink
                        </label>
                        <input type="text" name="weblink" id="link"
                               placeholder="http://weboldal.hu" value="" class="form-control"/>
                    </div>
                    <div class="checkboxclass">
                        <input type="checkbox" name="gdpr" required>
                        <div> Elfogadom az <a href=""> Adatkezelési
                                tájékoztatót.</a></div>
                    </div>
                    <div class="btncontainer">
                        <input type="submit" name="submit" value="Regisztráció"
                               class="btn btn-primary"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>