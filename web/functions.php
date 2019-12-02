<?php
function exitAlertRedirect($alert, $url)
{
    exit("
        <script type='text/javascript'>
            alert('$alert');
            document.location='$url';
        </script>");
}