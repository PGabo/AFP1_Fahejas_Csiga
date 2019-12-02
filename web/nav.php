<?php
    if (isset($_SESSION['login']) && $_SESSION['login']) {
        $name = "Kijelentkezés";
        $log = "logout.php";
        $regphp = "modify.php";
        $reg = "Szerkesztés";
    } else {
        $name = "Bejelentkezés";
        $log = "login.php";
        $regphp = "register.php";
        $reg = "Regisztráció";
    }
    echo
    "<nav class='navbar navbar-expand-lg navbar-light bg-light'> 
      <a href='index.php' class='navbar-brand'><img class='logo' src='logo.png' alt='allatmentok_logo' title='allatmentok_logo' /></a>
      <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
      </button>
      <div class='collapse navbar-collapse' id='navbarSupportedContent'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item'>
            <a class='nav-link' href='index.php'>Kezdőlap</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='$regphp'>$reg</a>
          </li>
          <li class='nav-item'>
            <a class='nav-link' href='$log'>$name</a>
          </li>
        </ul>
      </div>
</nav>";
    ?>