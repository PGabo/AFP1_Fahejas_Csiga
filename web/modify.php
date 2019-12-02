<?php
session_start();
include_once("functions.php");
if (!isset($_SESSION['login']))
    exitAlertRedirect('Nincs bejelentkezett felhasználó.', 'login.php');
$isAdmin = $_SESSION['admin'];
if ($isAdmin) {
    $isPostModify = isset($_GET['id']);
    $isPwModify = !$isPostModify;
} else {
    $isPwModify = true;
    $isPostModify = true;
}
$id = $isPwModify ? $_SESSION['id'] : $_GET['id'];

if ($isPwModify && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['currentpw'])) {
    include_once("./config/config.php");
    include_once("./config/User.php");

    $db = new Database();
    $connection = $db->DB_Connect();
    $account = new Account($connection);
    $password = $_POST['password'];
    $email = $_SESSION['login'];
    $currentpw = $_POST['currentpw'];
    if (!$account->CheckPassword($id, $currentpw))
        exitAlertRedirect("Nem a jelenlegi jelszót adta meg!", "modify.php");
    passwordVerify($password, $_POST['password2']);
    exitAlertRedirect($account->UpdatePassword($password, $email) ? 'Sikeres módosítás!' : 'Sikertelen módosítás', 'modify.php');
}


include_once("./config/config.php");
include_once("./config/User.php");
include_once("functions.php");
$db = new Database();
$connection = $db->DB_Connect();
$account = new Account($connection);

if ($isPostModify) {
    $adat = $isAdmin ? $account->SelectPostById($_GET['id']) : $account->GetUserPost($id);
    if ($adat === false)
        exitAlertRedirect("Nincs ilyen adat!", "index.php");
}

?>
<!DOCTYPE html>
<html lang='en'>
<?php require('./html/head.html'); ?>
<body>
<?php require('nav.php');
if ($isPostModify) { ?>
    <main class='container border'>
        <h1>Adatok változtatása</h1>
        <form class="modifyform" name='insert' action='update.php' method='post'>
            <?php if ($isAdmin) echo "<input type='hidden' name='id' value = '$id'>"; ?>
            <div>
                <label>Egyesület neve </label>
                <input type='text' name='nev' id='egyesuletnev'
                       value="<?php echo htmlspecialchars($adat['Nev']); ?>" class='form-control' required/>
            </div>

            <div>
                <label>Cím, ahol található </label>
                <input type='text' name='Cim' id='Cim'
                       value='<?php echo htmlspecialchars($adat['Cim']); ?>' class='form-control' required/>
            </div>

            <div>
                <label> Megye</label>
                <input type='text' name='megye' id='megye' value='<?php echo htmlspecialchars($adat['Megye']); ?>'
                       class='form-control'/>
            </div>

            <div>
                <label>Elérhetőség </label>
                <input type='text' name='elerhetoseg' id='elerhetoseg'
                       value='<?php echo htmlspecialchars($adat['Elerhetoseg']); ?>' class='form-control'/>
            </div>

            <div>
                <label> Adó</label>
                <input type='text' name='ado' id='ado' value='<?php echo htmlspecialchars($adat['Ado']); ?>'
                       class='form-control'/>
            </div>

            <div>
                <label> Weblink</label>
                <input type='text' name='weblink' id='link' value='<?php echo htmlspecialchars($adat['Weblink']); ?>'
                       class='form-control' required/>
            </div>
            <div class="btncontainer">
                <input type='submit' name='submit' value='Szerkesztés' class='btn btn-primary'/>
            </div>
        </form>
    </main>
<?php }
if ($isPwModify) {
?>
<div class='container border'>
    <div>
        <h1>Jelszó változtatása</h1>
        <form class="modifyform" name='insert' action='' method='post'>
            <div>
                <label> Jelenlegi Jelszó</label>
                <input type="password" name="currentpw" placeholder="Kérem adja meg aktuális jelszavát"
                       id="currentpw" value="" class="form-control" required/>
            </div>
            <div>
                <label> Jelszó</label>
                <input type="password" name="password" placeholder="Új jelszó" id="password" value=""
                       class="form-control" required/>
            </div>
            <div>
                <label>Jelszó megerősítés</label>
                <input type="password" name="password2" placeholder="Jelszó megerősítése" id="password2" value=""
                       class="form-control" required/>
            </div>
            <div class="btncontainer">
                <input type='submit' name='submit' value='Változtatás' class='btn btn-primary'/>
            </div>
        </form>



    </div>
        <form class="modifyform" action="deleteuser.php" method="post">
            <div>
            <label for="">Fiók törlése</label>
                <input type="password" name="deletepw" placeholder="Add meg a jelszavad..." id="password2" value=""
                       class="form-control" required/>
            </div>
            <div class="btncontainer">
            <input type="submit" class="btn btn-primary" class='deleteuserbtn' value="Fiók törlése"/>
            </div>
        </form>

    </div>
    <?php } ?>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>