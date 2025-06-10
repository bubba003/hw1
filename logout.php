<?php
    session_start();

    if(isset($_COOKIE["rememberme"])){
        //bisogna andare nel database e rimuovere la riga corrispondente
        $conn= mysqli_connect("localhost", "root", "", "feltrinelli")or die("Errore: " .mysqli_connect_error());
        $token= mysqli_real_escape_string($conn, $_COOKIE["rememberme"]);

        $query="DELETE FROM TOKENS WHERE TOKEN='$token'";

        $result=mysqli_query($conn, $query) or die("ERRORE: " .mysqli_error($conn));
        if($result){
            setcookie("rememberme", "", time() -3600, "/");
        }
        mysqli_close($conn);
    }
    session_destroy();
    header("Location: login.php");
    exit();
?>