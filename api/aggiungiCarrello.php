<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: /login.php");
        exit();
    }

    header("Content-Type: application/json");

    $conn= mysqli_connect("localhost", "root", "", "feltrinelli");
    if(!$conn){
        echo json_encode(array("success" => false, "error" => "Connessione al database fallita"));
        exit();
    }
    $input= json_decode(file_get_contents('php://input'), true); //serve a leggere il body grezzo della richiesta http
    /*siccome in lato client (javascript) nella richiesta http vi è headers: content-type: application/json
    bisogna evitare di usare $_POST in PHP perché PHP non popola $_POST*/
    $username= mysqli_real_escape_string($conn, $_SESSION["username"]);
    $titolo= mysqli_real_escape_string($conn, $input["title"]);
    $copertina= mysqli_real_escape_string($conn, $input["copertina"]);
    $autore= mysqli_real_escape_string($conn, $input["author"]);
    $tipologia= mysqli_real_escape_string($conn, $input["type"]);
    $prezzo;
    /*adesso dobbiamo ricavare il prezzo del prodotto facendo un'interrogazione alla 
    tabella 'prodotti'; successivamente, andremo a salvare tutti i dati nel carrello */
    $query4= "SELECT PREZZO FROM PRODOTTI WHERE TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    $result= mysqli_query($conn, $query4);
    if(mysqli_num_rows($result) >0){
        $row=mysqli_fetch_assoc($result);
        $prezzo=$row["PREZZO"];
    }
    else{
        echo json_encode(array("success" => false, "errore" => "non è stato individuato alcun prezzo"));
        mysqli_free_result($result);
        mysqli_close($conn);
        exit();
    }

    mysqli_free_result($result);

    $query1="INSERT INTO CARRELLO(USERNAME, TITOLO, COPERTINA, AUTORE, PREZZO, TIPOLOGIA) VALUES('$username', '$titolo', '$copertina', '$autore', $prezzo, '$tipologia')";
    $query2="SELECT * FROM CARRELLO WHERE USERNAME='$username' AND TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    $query3="UPDATE CARRELLO SET QUANTITY= QUANTITY + 1 WHERE USERNAME='$username' AND TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    
    $result= mysqli_query($conn, $query2);
    if(mysqli_num_rows($result) >0){ //cioè il prodotto è già presente nel carrello dell'utente
        mysqli_free_result($result);

        $result= mysqli_query($conn, $query3);
        if($result){
            echo json_encode (array("success" => true, "add" => false));
        }
        else{
            echo json_encode(array("success" => false, "add" => false));
        }
        
    }
    else{ //cioè il prodotto non è ancora nel carrello dell'utente
        mysqli_free_result($result);

        $result= mysqli_query($conn, $query1);
        if($result){
            echo json_encode(array("success" => true, "add" => true));

        }
        else{
            echo json_encode(array("success" => false, "add" => false));
        }
        
    }
    mysqli_close($conn);
    exit();
    
?>