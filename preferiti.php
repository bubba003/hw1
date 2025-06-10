<?php
	session_start();

	if(!isset($_SESSION["username"])){
		if(isset($_COOKIE["rememberme"])){
			$conn=mysqli_connect("localhost", "root", "", "feltrinelli");
			if(!$conn){
				header("Location: login.php");
				exit();
			}
			$token= mysqli_real_escape_string($conn, $_COOKIE["rememberme"]);
			$data= date("Y-m-d");
			$query="SELECT USERNAME FROM TOKENS WHERE TOKEN='$token' AND SCADENZA > '$data'";

			$result=mysqli_query($conn, $query);
			if(mysqli_num_rows($result)> 0){
				$row=mysqli_fetch_assoc($result);
				$_SESSION["username"]= $row["USERNAME"];
			}
			else{//cioè il cookie potenzialmente è scaduto
				header("Location: logout.php");
			}
			mysqli_free_result($result);
			mysqli_close($conn);
			exit();
		}
	}

	if(!isset($_SESSION["username"])){
		header("Location: login.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>I tuoi preferiti</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="preferiti.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
		<script src="preferiti.js" defer></script>
		
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
				<a href="hw1/index.php" title="Vai alla home" class="icona-nav"><i class="fa-solid fa-house"></i></a>
       	 		<a href="carrello.php" title="Vai al carrello" class="icona-nav"><i class="fa-solid fa-cart-shopping"></i></a>
        		<a href="profilo.php" title="Vai al profilo" class="icona-nav"><i class="fa-regular fa-user"></i></a>
        		<a href="logout.php" class="logout-btn">Logout</a>
    		</div>
    		<h1><?php echo $_SESSION["username"]?>, clicca su uno dei pulsanti <br>per vedere i tuoi preferiti!</h1>
		</header>

		<section>
			<h1>I tuoi elementi preferiti</h1>
			
			<div id="filtri-preferiti">
				<button data-index= "0">Tutti</button>
				<button data-index= "1">Libri</button>
				<button data-index= "2">Film</button>
				<button data-index="3">Musica</button>
				<button data-index="4">Giochi</button>
			</div>
			
			<div id="lista-preferiti">
				
				<div class="messaggio-vuoto">
					<p>Non hai ancora aggiunto elementi ai preferiti</p>
					<a href="hw1/index.php" class="pulsante">Esplora il catalogo</a>
				</div>
				
				<div class="elemento-preferito">
					<!-- 
					<img src="">
					
					<div class="info-preferito">
						
						<h2 class="titolo"></h2>
						<p class="autore"></p>
						<p class="prezzo"></p>

						<div class="azioni">
							<button class="rimuovi-preferiti"><i class="fas fa-heart-broken"></i> Rimuovi</button>
							<button class="aggiungi-carrello"><i class="fas fa-shopping-cart"></i> Carrello</button>
						</div>

					</div>
					-->
				</div>

			</div>

         </section>
		
	</body>
</html>