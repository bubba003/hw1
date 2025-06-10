<?php
	session_start();
	//verificare l'accesso
	if(isset($_SESSION["username"])){ //significa che l'utente ha già fatto l'accesso e quindi il suo username è stato salvato nella sessione
		header("Location: ./hw1/index.php");
		exit();
	}
	$errore= false;

	if(isset($_POST["username"]) && isset($_POST["password"])){
		//connessione al database
		$conn=mysqli_connect("localhost", "root", "", "feltrinelli") or die("Errore: " .mysqli_connect_error());
		//per evitare problemi effettuiamo sempre l'escape dei caratteri
		$username= mysqli_real_escape_string($conn, $_POST["username"]);
		$password= mysqli_real_escape_string($conn, $_POST["password"]);

		$query="SELECT * FROM UTENTI WHERE USERNAME='$username'";

		//esecuzione della query
		$result= mysqli_query($conn, $query) or die("ERRORE: " .mysqli_error($conn));

		//lettura dei risultati
		$row=mysqli_fetch_assoc($result);
		//tra le condizioni metto pure $row, per verificare che non sia null
		if($row){//prima condizione: se $row non è null, significa che è stata trovato un utente
			if($username==$row["USERNAME"] && password_verify($password, $row["PASSWORD"])){
				//se l'utente ha inserito le credenziali corrette, salviamo il suo username nella sessione.
				//viene quindi impostata la variabile di sessione "username"
				$_SESSION["username"]= $username;
				/*se l'utente clicca sul tasto 'ricordami', impostiamo un cookie valido per due settimane
				che gli evita di effettuare login futuri alla pagina*/
				if(isset($_POST["rememberme"])){
					/*l'utente ha cliccato sul tasto 'ricordami', adesso uso una funzione che 
					mi permette di generare casualmente un token da inserire nel cookie. questo
					token sarà associato all'utente e il tutto verrà salvato nel database*/
					/*vengono generati 32 byte casuali e vengono convertiti in una stringa esadecimale */
					$token=mysqli_real_escape_string($conn, bin2hex(random_bytes(32)));
					/*uso un'altra funzione per settare la data di scadenza del token stesso*/ 
					$scadenza=mysqli_real_escape_string($conn, date("Y-m-d", time() + (60 * 60 * 24 * 14)));//validità due settimane
					//adesso inseriamo nel database questi dati
					$query="INSERT INTO TOKENS(USERNAME, TOKEN, SCADENZA) VALUES('$username', '$token', '$scadenza')";
					$result=mysqli_query($conn, $query);

					if($result){//cioè il token è stato salvato
						setcookie("rememberme", $token, time() + (60 * 60 * 24 * 14), "/");	
					}
					else{
						$errore=true;
						$messaggio_errore= "<strong>Errore nel salvataggio del cookie</strong>";
					}
					
				}
				//e reindirizziamo l'utente alla pagina principale
				header("Location: ./hw1/index.php");
				mysqli_free_result($result); //liberiamo lo spazio occupato dai risultati della $query
				mysqli_close($conn); //chiudiamo la connessione
				exit();
			}
			else{
				$errore= true;
				$messaggio_errore= "<strong>Username o Password non corretto</strong>";
			}

		}
		else{
			$errore= true;
			$messaggio_errore= "<strong>Username o Password non corretto</strong>";
		}
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<title>Login Page</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="login.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		
	</head>

	<body>
		<?php
		if($errore) echo $messaggio_errore;
		?>

		<section>
			<form action="login.php" method="post">	
				<h1>Accedi al tuo account</h1>
				<p>
					<label for="username">
						Nome utente
						<input type="text" id="username" name="username">
					</label>
				</p>

				<p>
					<label for="password">
						Password
						<input type="password" id="password" name="password">
					</label>
				</p>

				<p>
					<label>
						<input type="checkbox" name="rememberme" id="rememberme">
						Ricordami
					</label>
				</p>

				<input type="submit" value="Accedi" id="submit">

				<p class="forgot-password">
					<a href="./registrazione.php">Non hai un account? Registrati</a>
				</p>
				
			</form>
		</section>

	</body>
</html>
