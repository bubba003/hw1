<?php
	$errore=false;
    //verifichiamo che siano stati riempiti tutti i campi
	if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){
		$conn= mysqli_connect("localhost", "root", "", "feltrinelli");
		$username=mysqli_real_escape_string($conn, $_POST["username"]);
		$email=mysqli_real_escape_string($conn, $_POST["email"]);

		if(strlen($username) >= 3){//cioè lo username rispetta i requisiti
			$query="SELECT * FROM REGISTRAZIONI WHERE USERNAME='$username'";
			$result=mysqli_query($conn, $query);
		
			if(mysqli_num_rows($result)==0){//se il numero di righe di result è 0, cioè l'username inserito è disponibile
				$query="SELECT * FROM REGISTRAZIONI WHERE EMAIL='$email'";
				$result=mysqli_query($conn, $query);

				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){//verifichiamo che la struttura della email sia corretta
					$errore=true;
					$messaggio_errore="<strong>Email non valida!</strong>";
				}

				if(mysqli_num_rows($result)== 0){ //ora controlliamo se è stata trovata una corrispondenza con l'email
					//significa che la registrazione può avvenire con successo
					//per evitare problemi di sicurezza, effettuiamo l'escape dei caratteri
					$name=mysqli_real_escape_string($conn, $_POST["name"]);
					$surname=mysqli_real_escape_string($conn, $_POST["surname"]);
					$password=mysqli_real_escape_string($conn, $_POST["password"]);
					$confirm_password=mysqli_real_escape_string($conn, $_POST["confirm_password"]);
					//verifichiamo che la password rispetti i requisiti
					//la funzione preg_match verifica se la password contiene almeno un carattere maiuscolo e uno speciale (!, @, #, $, ecc.) 
					if(strlen($password) < 6 || !preg_match('/[A-Z]/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)){
						$errore=true;
						$messaggio_errore= "<strong>Password non corretta</strong>";
					}
					else if(strcmp($password, $confirm_password) != 0){
							$errore=true;
							$messaggio_errore="<strong>Password non confermata correttamente</strong>";
					}

					else{//password corretta, adesso ridefiniamo la query
						$password_hash= password_hash($password, PASSWORD_DEFAULT);
						$query="INSERT INTO REGISTRAZIONI (NAME, SURNAME, USERNAME, EMAIL, PASSWORD) VALUES ('$name', '$surname', '$username', '$email', '$password_hash')";
						$result=mysqli_query($conn, $query);	

						if($result){//cioè l'inserimento nella tabella registrazioni è avvenuto
							$query="INSERT INTO UTENTI (USERNAME, PASSWORD) VALUES ('$username', '$password_hash')";
							$result=mysqli_query($conn, $query);

							if($result){//cioè l'inserimento nella tabella utenti è avvenuto
								header("Location: ./login.php");
								mysqli_free_result($result);
								mysqli_close($conn);
								exit();
							}

							else{//cioè l'inserimento nella tabella utenti non è avvenuto
								$errore=true;
								$messaggio_errore="<strong>Errore durante la registrazione!</strong>";
							}

						}
						else{//cioè l'inserimento nella tabella registrazioni non è avvenuto
							$errore=true;
							$messaggio_errore="<strong>Errore durante la registrazione!</strong>";
						}
					}
					
				}

				else{ //cioè è stata trovata una corrispondenza con l'email
					$errore=true;
					$messaggio_errore="<strong>email già in uso!</strong>";
				}

			}
			else{//cioè è stata trovata una corrispondenza con l'username
				$errore=true;
				$messaggio_errore="<strong>Username già in uso!</strong>";

			}

		}
		else{//cioè lo username non rispetta i requisiti
			$errore=true;
			$messaggio_errore="<strong>Username troppo corto!</strong>";

		}
	
	}
	//se non sono stati riempiti tutti i campi
	else{
		$errore= true;
		$messaggio_errore= "<strong>Compila tutti i campi!</strong>";
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione</title>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="registrazione.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
		<script src="registrazione.js" defer></script>
    </head>

    <body>
		<?php
			if($errore) echo $messaggio_errore;
		?>

        <section>
			<form action="registrazione.php" method="post">	
				<h1>Registrati alla Feltrinelli</h1>
				<p id="p-name">
					<label for="name">
						Nome 
						<input type="text" id="name" name="name">
						<em class="hidden"> Non hai inserito il nome</em>
					</label>
				</p>

                <p id="p-surname">
					<label for="surname">
						Cognome
						<input type="text" id="surname" name="surname">
						<em class="hidden"> Non hai inserito il cognome</em>
					</label>
				</p>

                <p id="p-username">
					<label for="username">
						Username 
						<input type="text" id="username" name="username">
						<em class="hidden"> L'username deve essere lungo almeno di tre caratteri</em>
					</label>
				</p>

                <p id="p-email">
					<label for="email">
						Email
						<input type="text" id="email" name="email">
						<em class="hidden"> Indirizzo email non valido</em>
					</label>
				</p>

				<p id="p-password">
					<label for="password">
						Password
						<input type="password" id="password" name="password">
                        <em class="hidden">NB: la password deve avere almeno 6 caratteri,un carattere maiuscolo e uno speciale (!, @, #...)</em>
					</label>
				</p>

				<p id="p-confirm-password">
					<label for="confirm_password">
						Conferma Password
						<input type="password" id="confirm-password" name="confirm_password">
                        <em class="hidden">Le password non corrispondono</em>
					</label>
				</p>

				<input type="submit" value="Registrati" id="submit">

			</form>
		</section>
    </body>
</html>