<?php
	session_start();

	if(!isset($_SESSION["username"])){
		if(isset($_COOKIE["rememberme"])){
			$conn=mysqli_connect("localhost", "root", "", "feltrinelli");
			if(!$conn){
				header("Location: ../login.php");
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
				header("Location: ../logout.php");
			}
			mysqli_free_result($result);
			mysqli_close($conn);
			exit();
		}
	}

	if(!isset($_SESSION["username"])){
		header("Location: ../login.php");
		exit();
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>prova</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="mhw3.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
		<script src="mhw3.js" defer></script>
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

		<div id="w">
			<h1>Eccoti, <?php 
							echo $_SESSION["username"];
						?>!
			</h1>
		</div>
		
		<header>
		
			<div id="menu-profilo" class="figli-header">
				<div id="menu">
					<div></div>
					<div></div>
					<div></div>
				</div>
				
				<div id="profilo">
					<a href=""><i class="fa-solid fa-user"></i></a>
					<a href="../preferiti.php"><i class="fa-solid fa-heart"></i></a>
				</div>
			</div>
			
			<div id="logo" class="figli-header">
			
				<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRW2eyggFesnt90uPKnYqMC85yJMpUfadmjP--Qe2NEhxG80z1biw3_uDqvthr5p2BXF7U&usqp=CAU">
				
			</div>
			
			<div id="barra-altro" class="figli-header">
				<em class="hidden"><strong>Consegna</strong> sempre <strong>gratis</strong> nella Tua <strong>libreria</strong></em>
				<form>
					<select>
						<option value="libri">Libri</option>
						<option value="musica">Musica</option>
						<option value="film">Film</option>
						<option value="giochi">Giochi</option>
					</select>
					<input type="text" placeholder="Cerca tra milioni di prodotti" class="principale">
					<input type="submit" value="🔎">
					<a href="https://www.lafeltrinelli.it/search-advanced">ricerca </br> avanzata</a>
				</form>
				
					
				
			</div>
			
			<div id="icone" class="figli-header">
			
				<a href="../preferiti.php" id="cuore"><i class="fa-solid fa-heart"></i></a>
				<a href="../carrello.php" id="carrello"><i class="fa-solid fa-shopping-cart"></i></a>
				<a href="" id="profilo"><i class="fa-solid fa-user"></i></a>
				<a href="../logout.php" id="logout"><i class="fa-solid fa-right-from-bracket"></i></a>
			</div>
			
		</header>
		
		<div id="under-header">
		
			<a href="">Libri</a>
			<a href="">Bambini e Ragazzi</a>
			<a href="">Fumetti e Manga</a>
			<a href="">Libri in inglese</a>
			<a href="">Libri Vintage</a>
			<a href="">eBook e Audiolibri</a>
			<a href="">Film</a>
			<a href="">CD e Vinili</a>
			<a href="">Cartoleria</a>
			<a href="">Giochi</a>
			<a href="">Offerte</a>
			
			<div id="solo-mobile">
				<form>
					<select>
						<option value="libri">Libri</option>
						<option value="musica">Musica</option>
						<option value="film">Film</option>
						<option value="giochi">Giochi</option>
					</select>
					<input type="text" placeholder="Cerca tra milioni di prodotti" class="principale">
					<input type="submit" id="submit" value="🔎">
				</form>
				
			</div>
		</div>
		
		<!--il div "contenitore" corrisponde al contenuto che visualizziamo una volta cliccato sul menu hambuger in modalità mobile-->
		<div id="contenitore" class="hidden">
		
			<div id="x"><strong>X</strong></div>
		
			<div id="hamburger-content">
				<div>Libri <strong>></strong></div>
				<div>Bambini e ragazzi <strong>></strong> </div>
				<div>Fumetti e manga <strong>></strong></div>
				<div>Libri in inglese <strong>></strong></div>
				<div>Libri Vintage <strong>></strong></div>
				<div>eBook e audiolibri <strong>></strong></div>
				<div>Film <strong>></strong></div>
				<div>CD e Vinili <strong>></strong></div>
				<div>Cartoleria <strong>></strong></div>
				<div>Giochi <strong>></strong></div>
				<div>Offerte <strong>></strong></div>
			</div>
		
			<div id="under-content">
				<div>
					<i class="fas fa-calendar-alt"></i> 
					Eventi  
				</div>
				
				<div>
					<i class="fas fa-store"></i> 
					Negozio 
				</div>
					
				<div>
					<i class="fas fa-gift"></i> 
					Gift Card
				</div>
				
				<div>
					<i class="fas fa-headset"></i> 
					Assistenza
				</div>
				
				<div>
					<i class="fas fa-id-card"></i> 
					CartaEffe
				</div>
			</div>
		
		</div>
		
		<div id="risultati-ricerca">
		</div>
		
		<section class="chat1">
			<p>Ogni libro è un viaggio. <br>Parti da qui. <br>
				<a href=""><em>Scopri le novità editoriali e <br> lasciati ispirare da nuove storie.</em></a>
			</p>
			
			<em id="promo" class="pulse">Solo per oggi: <br> -20% su titoli selezionati!</em>
			
		</section>
		
		<div class="bottoni">
			<button data-index="1"></button>
			<button data-index="2"></button>
			<button data-index="3"></button>
			<button data-index="4"></button>
		</div>
		
		<div id="undersection">
			<div class="us-items">
			
				<img src="./us1.png">
				<a href="">Scommetti su un esordio</a>
				
			</div>			
			
			<div class="us-items">
			
				<img src="./us2.png">
				<a href="">Feltrinelli compie 70 anni</a>
				
			</div>
			
			<div class="us-items">
				
				<img src="./us3.png">
				<a href="">Usa i tuoi Bonus su Feltrinelli.it</a>
				
			</div>
		</div>
		
		<div id="classifica">
		
			<h1>La Classifica del giorno</h1>
			
			<div id="sezioni">
			
				<div data-index="1">Libri</div>
				<div data-index="2">Film</div>
				<div data-index="3">Musica</div>
				<div data-index="4">Giochi</div>
				
			</div>
			
		</div>
		
		<div id="immagini">
		
			<div id="first">
				<div id="div1">
					
					<img src="./libro1.png">
					<strong>1</strong>
					
				</div>
				<div id="div2">
					<a href="">Il ritmo della guerra. Le cronache della Folgoluce. Vol.4</a>
					<strong id="autore">di Brandon Sanderson</strong>
					<em>Mondadori, 2020</em>
				</div>
			</div>
			
			<div id="others">
				<div class="libri">
				
					<img src="./libro2.png">
				
					<div class="info">
						<a href="">La strada giovane</a>
						<strong>di Antonio Albanese</strong>
						<em>Feltrinelli, 2025</em>
					</div>
					
				</div>
				
				<div class="libri">
				

					<img src="./libro3.png">
					
					<div class="info">
						<a href="">L'ultimo giorno di un condannato</a>
						<strong>di Victor Hugo</strong>
						<em>Feltrinelli, 2025</em>
					</div>
					
				</div>
				
				<div class="libri">
				
					
					<img src="./libro4.png">
					
					
					<div class="info">
						<a href="">Tutti nella mia famiglia hanno ucciso qualcuno</a>
						<strong>di Benjamin Stevenson</strong>
						<em>Feltrinelli, 2025</em>
					</div>
					
				</div>
				
				<div class="libri">
					
					<img src="./libro5.png">
					
					<div class="info">
					
						<a href="">Il vento conosce il mio nome</a>
						<strong>di Isabel Allende</strong>
						<em>Feltrinelli, 2025</em>
						
					</div>
				</div>
			</div>
		</div>
		
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
