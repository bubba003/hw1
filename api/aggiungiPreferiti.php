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

    /*anche qui bisogna ricavare il prezzo facendo una query alla tabella 'prodotti' */
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

    $query1= "SELECT * FROM PREFERITI WHERE USERNAME= '$username' AND TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    $query2= "INSERT INTO PREFERITI(USERNAME, TITOLO, COPERTINA, AUTORE, PREZZO, TIPOLOGIA) VALUES('$username', '$titolo', '$copertina', '$autore', $prezzo, '$tipologia')";
    $query3= "DELETE FROM PREFERITI WHERE USERNAME= '$username' AND TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$tipologia'";
    $result= mysqli_query($conn, $query1);

    if(mysqli_num_rows($result) > 0){
        //significa che il prodotto è già presente tra i preferiti dell'utente. se è già presente, si rimuove
        mysqli_free_result($result);

        $result= mysqli_query($conn, $query3);
        if($result){
            echo json_encode(array("deleted" => true, "success" => true));
        }
        else{
            echo json_encode(array("deleted" => false, "success" => false));
        }
        
    }
    else{ //cioè il prodotto non è presente tra i preferiti dell'utente, quindi possiamo aggiungerlo
        mysqli_free_result($result);

        $result= mysqli_query($conn, $query2);
        if($result){
            echo json_encode(array("deleted" => false, "success" => true));
        }
        else{
            echo json_encode(array("deleted" => false, "success" => false));
        }
        
    }
    mysqli_close($conn);
    exit();
    
    
?>