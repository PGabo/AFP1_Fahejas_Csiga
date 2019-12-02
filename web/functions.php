<?php
function exitAlertRedirect($alert, $url)
{
    exit("
        <script type='text/javascript'>
            alert('$alert');
            document.location='$url';
        </script>");
}
function exitAlert($alert)
{
    exit("
        <script type='text/javascript'>
            alert('$alert');
        </script>");
}
function passwordVerify($password, $password2){
    if (!($password === $password2)) {
        exitAlert('Nem egyeznek a jelszavak!');
    }
}
function loginErrorMessage()
{
    exitAlertRedirect('Helytelen felhasználónév vagy jelszó!', 'index.php');
}
function isProperAddress($str)
{
    if ($str == null || !is_string($str))
        return false;
    else
    {
        preg_match('@\s[0-9]{1,3}(\/\w)?\.?$@', $str, $matches);
        return !empty($matches);
    }
}