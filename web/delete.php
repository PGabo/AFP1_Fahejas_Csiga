<?php
session_start();
if (isset($_GET['id']) && isset($_SESSION['admin']) && $_SESSION['admin'])
{   $row_id = $_GET['id'];
    $own_id = $_SESSION['id'];
    include_once("./config/config.php");
    include_once ("./config/User.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $user=new Account($connection);
    $user_id = $user->GetUserId($row_id);
    if ($user_id === false)
        exitAlertRedirect("Nem található a rekordhoz felhasználó!", "index.php");
    $isSelf = ($user_id == $own_id);
    if ($isSelf) {
        $query = $user->DeleteRecords($row_id);
    }
    else {
        $query = $user->DeleteUser($user_id);
    }
    $db->Disconnect();
    header("Location:index.php");
}
else {
    exitAlert('Nincs jogosultsága ehhez a funkcióhoz.');
}
?>