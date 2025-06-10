<?php
    session_start();

    if(!isset($_SESSION["username"])){
        header("Location: login.php");
        exit();
    }

    $conn=mysqli_connect("localhost", "root", "", "feltrinelli") or die("Errore:" .mysqli_connect_error());
    $titolo= mysqli_real_escape_string($conn, $_GET["title"]);
    $autore= mysqli_real_escape_string($conn, $_GET["author"]);
    $categoria= mysqli_real_escape_string($conn, $_GET["type"]);

    $query="SELECT * FROM PRODOTTI WHERE TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$categoria' ";
    $result=mysqli_query($conn, $query);
    $prodotto;

    if(mysqli_num_rows($result) >0){
        $prodotto= mysqli_fetch_assoc($result);
    }
    else{
        header("Location: login.php");
        mysqli_free_result($result);
        mysqli_close($conn);
        exit();
    }

    $query="SELECT COUNT(*) as NUM_LIKE FROM LIKES WHERE TITOLO='$titolo' AND AUTORE='$autore' AND TIPOLOGIA='$categoria'";
    $result=mysqli_query($conn, $query);
    $likes;
    if(mysqli_num_rows($result) > 0){
        $likes=mysqli_fetch_assoc($result);
    }
    else{
        header("Location: login.php");
        mysqli_free_result($result);
        mysqli_close($conn);
        exit();
    }
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
		<title><?php echo $prodotto["TITOLO"]?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="prodotto.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
		<script src="prodotto.js" defer></script>
	</head>

    <body>

        <nav>
			
			<div id="second">
	  
				<a href="https://www.lafeltrinelli.it/cartaeffe/cartaeffe-pagina"> CartaEffe </a>
				<a href="https://www.lafeltrinelli.it/gift-card"> Gift Card </a>
				<a href="https://www.lafeltrinelli.it/negozi"> Negozi </a>
				<a href="https://www.lafeltrinelli.it/punti-di-ritiro/punti-ritiro-pagina"> Punti di Ritiro </a>
				<a href="https://www.lafeltrinelli.it/eventi"> Eventi </a>
				<a href="https://www.lafeltrinelli.it/convenzioni"> Convenzioni </a>
				<a href=""> | </a>
				<a href="https://www.lafeltrinelli.it/assistenza"> Assistenza Clienti </a>
		
			</div>
		
		</nav>

        <header>
            <div id="icone-bar">
                <a href="hw1/index.php" class="icona-nav" title="Home"><i class="fa-solid fa-house"></i></a>
                <a href="preferiti.php" class="icona-nav" title="Preferiti"><i class="fa-solid fa-heart"></i></a>
                <a href="carrello.php" class="icona-nav" title="Carrello"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="profilo.php" class="icona-nav" title="Profilo"><i class="fa-regular fa-user"></i></a>
                <a href="logout.php" class="icona-nav logout-btn" title="Logout"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </header>
        
        <section class="prodotto">
            <img src="<?php echo $prodotto["COPERTINA"]?>" class="copertina">
            <div class="info">
                <h1 class="titolo"><?php echo $prodotto["TITOLO"]?></h1>
                <p class="autore">Autore: <span><?php echo $prodotto["AUTORE"]?></span></p>
                <p class="tipologia">Categoria: <span><?php echo $prodotto["TIPOLOGIA"]?></span></p>
                <p class="prezzo">Prezzo: <span>€ <?php echo $prodotto["PREZZO"]?></span></p>
                <p class="like">
                    <button class="like-btn">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </button>
                    <span class="like-count"><span><?php echo $likes['NUM_LIKE']; ?></span> Mi piace</span>  
                </p>
                <button class="aggiungi-carrello"><i class="fa-solid fa-cart-plus"></i> Aggiungi al carrello</button>
                <button class="aggiungi-preferiti"><i class="fa-solid fa-heart"></i> Aggiungi ai preferiti</button>
            </div>
        </section>

        <footer>
		
			<div class="footer-items fratelli">
				<h1>SERVIZI BUSINESS</h1>
				<a href="">Apri un franchising </a> 
				<a href="">Affiliazioni</a> 
				<a href="">Gift card business</a> 
				<a href="">Vendi su Marketplace</a> 
				<a href="">Collaborazioni online</a> 
				<a href="">Prima Effe</a> 
			</div>
			
			<div class="footer-items fratelli">
				<h1>TERMINI E CONDIZIONI</h1>
				<a href="">Condizioni generali di vendita</a>
				<a href="">Informativa sul diritto di recesso</a>
				<a href="">Informativa sulla privacy</a>
				<a href="">Informativa privacy servizi chat Whatsapp</a>
			</div>
			
			<div class="footer-items fratelli">
				<h1>I SITI DEL GRUPPO</h1>
				<a href="">Gruppo Feltrinelli</a>
				<a href="">Giangiacomo Feltrinelli Editore</a>
				<a href="">Fondazione Giangiacomo Feltrinelli</a>
				<a href="">Feltrinelli Education</a>
				<a href="">Razzismo Brutta Storia</a>
			</div>
			
			<div class="footer-items fratelli">
				<h1>SERVIZI PER IL CLIENTE</h1>
				<a href="">Carta Effe</a>
				<a href="">Prenota e ritira</a>
				<a href="">Gift Card Feltrinelli</a>
				<a href="">Carte Cultura</a>
				<a href="">Carte del docente</a>
				<a href="">Punti di ritiro</a>
				<a href="">Indici</a>
				<a href="">Stampa foto online</a>
			</div>
			
			<div class="footer-items fratelli">
				<h1>SUPPORTO CLIENTE</h1>
				<a href="">Area personale</a>
				<a href="">I miei ordini</a>
				<a href="">Assistenza clienti</a>
				<a href="">Contattaci</a>
				<a href="">Spese di consegna</a>
			</div>
			<div class="footer-items fratelli">
				<h1>SITO REPLICATO DA</h1>
				<a href="https://github.com/bubba003">Sebastiano Salerno</a>
				<a href="https://github.com/bubba003">1000045431</a>
				</div> 
 			
		</footer>
    </body>
</html>