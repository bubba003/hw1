<?php

    session_start();

    if(!isset($_SESSION["username"])){
        echo json_encode(["errore" => "Sessione non attiva"]);
        exit();
    }

    header("Content-type: application/json");

    //effettuiamo una richiesta a un'API REST tramite php
    $curl= curl_init();
    //in base all'id ricevuto, componiamo l'url corrispondente
    if($_GET["id"]==1){
        $url="https://openlibrary.org/search.json?q=" .urlencode($_GET["q"]);
    }
    else if($_GET["id"]==2){
        $api_key="secret";
        $url="https://ws.audioscrobbler.com/2.0/?method=album.search&album=" .urlencode($_GET["q"]) . "&api_key=" . $api_key . "&format=json";
    }
    else if($_GET["id"] ==3){
        $api_key= "secret";
        $url= "https://api.themoviedb.org/3/search/movie?api_key=" .$api_key ."&query=" .urlencode($_GET["q"]);
    }
    else if($_GET["id"] == 4){
        $api_key= "secret";
        $url= "https://api.rawg.io/api/games?key=" .$api_key ."&search=" .urlencode($_GET["q"]);
    }
    else{
        echo json_encode(["errore" => "Parametro id non valido"]);
        exit();
    }
    
    curl_setopt($curl, CURLOPT_URL, $url); //impostiamo l'url
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //restituisce il risultato come stringa
    $result= curl_exec($curl);
    $http_code= curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if($result === false || empty($result)){
        echo json_encode(["errore" => "Errore nella richiesta cURL",
                        "dettaglio" => curl_error($curl),
                        "http_code" => $http_code,
                         "url" => $url]);
        exit();
    }

    echo $result;
    
?>
