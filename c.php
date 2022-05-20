<?php
function authenticate() {
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must enter a valid login ID and password to access this resource\n";
    die();
    
}
// logout();
function logout(){
    $_SESSION['logged'] = false;
    authenticate();
}
function IsAuthenticated(){
    if(isset($_SESSION['logged'])) {
        return true;
    }else{
        return false;
    }
}

if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){

    $Username = $_SERVER['PHP_AUTH_USER'];
    $Password = $_SERVER['PHP_AUTH_PW'];
    
    if ($Username == 'apollo' && $Password == 'atharvak') {
        $_SESSION['logged'] = true;

    }else{
        authenticate();
    }
}else{
        authenticate();
}

?>
