const scomparso=document.querySelector('#barra-altro em');
const scomparsoMobile= document.querySelector('#solo-mobile em');
const boxes= document.querySelectorAll('#sezioni div'); //funge da variabile globale
const bottoni= document.querySelectorAll('.bottoni button');
const menu= document.querySelector('#menu');
/*l'idea successiva è quella di creare una funzione (changeSection) in cui vado a inserire diverse liste che contengano tutte le informazioni che mi servono per
il processo che ho intenzione di svolgere, in più avevo pensato di aggiungere a ogni elemento che costituisce #sezioni un data-index in modo tale da distinguere
tra di loro gli elementi del contenitore*/
function changeSection(event){
	const scelta= event.currentTarget;
	
	if(scelta.dataset.index==="1"){
		console.log('è stato cliccato LIBRI');
		
		//iniziamo modificando i dati presenti in #first. nel caso in cui dovessero esserci altri errori, provare con createElement e appendChild.
		const new_img= document.querySelector('#first div img');
		new_img.src= './libro1.png';
		const new_title= document.querySelector('#first a');
		new_title.textContent='Il ritmo della guerra. Le cronache della Folgoluce. Vol.4';
		const new_author= document.querySelector('#first #autore');
		new_author.textContent='di Brandon Sanderson';
		const new_editor= document.querySelector('#first em');
		new_editor.textContent='Mondadori, 2020';
		
		//passiamo a #others
		const contenitore= document.querySelector('#others'); //corrisponde al contenitore che conterrà i 4 div 
		contenitore.innerHTML= ''; //rimuoviamo tutto il contenuto di #others in maniera dinamica
		
		const titoli= ['La strada giovane', 'L ultimo giorno di un condannato', 'Tutti nella mia famiglia hanno ucciso qualcuno', 'Il vento conosce il mio nome'];
		const copertine=['./libro2.png', './libro3.png', './libro4.png', './libro5.png'];
		const autori= ['di Antonio Albanese', 'di Victor Hugo', 'di Benjamin Stevenson', 'di Isabel Allende'];
		const editori= ['Feltrinelli, 2025', 'Feltrinelli, 2025', 'Feltrinelli, 2025', 'Feltrinelli, 2025'];
		
		for(let i=0; i < titoli.length; i++){
			const div= document.createElement('div');
			div.classList.add('libri');//aggiungiamo a questo elemento la classe libri, che corrisponde alla classe di cui gode di default il div presente in html
			
			const copertina=document.createElement('img');
			copertina.src=copertine[i];
			div.appendChild(copertina); //inseriamo nel div con classe 'libri' l'immagine. successivamente inseriremo in questo div il sottodiv e tutto ciò che contiene
			
			const sottoDiv= document.createElement('div');
			sottoDiv.classList.add('info');
			
			const titolo= document.createElement('a');
			titolo.textContent= titoli[i];
			const autore= document.createElement('strong');
			autore.textContent= autori[i];
			const editore= document.createElement('em');
			editore.textContent= editori[i];
			//adesso inseriamo nel sottodiv tutte queste informazioni
			sottoDiv.appendChild(titolo);
			sottoDiv.appendChild(autore);
			sottoDiv.appendChild(editore);
			//adesso inseriamo il sottodiv nel div con classe LIBRI
			div.appendChild(sottoDiv);
			//una volta inserito tutto nel div principale, inseriamo il div nel contenitore principale
			contenitore.appendChild(div);
			
		}
		
	}
	else if(scelta.dataset.index==="2"){
		console.log('è stato cliccato FILM');
		//#first
		const new_img= document.querySelector('#first div img'); // se ci sono errori, ricontrolla
		new_img.src= './film1.png';
		const new_title= document.querySelector('#first a');
		new_title.textContent='The Substance (DVD)';
		const new_author= document.querySelector('#first #autore');
		new_author.textContent='di Coralie Fargeat';
		const new_editor= document.querySelector('#first em');
		new_editor.textContent='I Wonder'; 
		
		//passiamo a #others
		const contenitore= document.querySelector('#others'); //corrisponde al contenitore che conterrà i 4 div 
		contenitore.innerHTML= ''; //rimuoviamo tutto il contenuto di #others in maniera dinamica
		
		const titoli= ['Conclave (DVD)', 'Oceania 2 (DVD)', 'Parthenope (DVD)', 'Mufasa. Il Re Leone (DVD)'];
		const copertine=['./film2.png', './film3.png', './film4.png', './film5.png'];
		const registi= ['di Edward Berger', 'di David J. Derrick Jr.', 'di Paolo Sorrentino', 'di Barry Jenkins'];
		const editori= ['Eagle', 'Disney', 'Piper Film', 'Disney'];
		
		for(let i=0; i < titoli.length; i++){
			const div= document.createElement('div');
			div.classList.add('libri');//aggiungiamo a questo elemento la classe libri, che corrisponde alla classe di cui gode di default il div presente in html
			
			const copertina=document.createElement('img');
			copertina.src=copertine[i];
			div.appendChild(copertina); //inseriamo nel div con classe 'libri' l'immagine. successivamente inseriremo in questo div il sottodiv e tutto ciò che contiene
			
			const sottoDiv= document.createElement('div');
			sottoDiv.classList.add('info');
			
			const titolo= document.createElement('a');
			titolo.textContent= titoli[i];
			
			const autore= document.createElement('strong');
			autore.textContent= registi[i];
			
			const editore= document.createElement('em');
			editore.textContent= editori[i];
			
			//adesso inseriamo nel sottodiv tutte queste informazioni
			sottoDiv.appendChild(titolo);
			sottoDiv.appendChild(autore);
			sottoDiv.appendChild(editore);
			//adesso inseriamo il sottodiv nel div con classe LIBRI
			div.appendChild(sottoDiv);
			//una volta inserito tutto nel div principale, inseriamo il div nel contenitore principale
			contenitore.appendChild(div);
			
		}
	}
	else if(scelta.dataset.index==="3"){
		console.log('è stato cliccato MUSICA');
		//iniziamo modificando le informazioni contenute di default in #first nel file html
		const new_img= document.querySelector('#first div img');
		new_img.src= './musica1.png';
		const new_title= document.querySelector('#first a');
		new_title.textContent='Volevo essere un duro';
		const new_author= document.querySelector('#first #autore');
		new_author.textContent='di Lucio Corsi';
		const new_editor= document.querySelector('#first em');
		new_editor.textContent='Super Music, 2025';
		
		//passiamo a #others
		const contenitore= document.querySelector('#others'); //corrisponde al contenitore che conterrà i 4 div 
		contenitore.innerHTML= ''; //rimuoviamo tutto il contenuto di #others in maniera dinamica
		
		const titoli= ['El Galactico', 'Parsifal. Uomo delle stelle', 'Buon compleanno Elvis', 'Libertà negli occhi'];
		const copertine=['./musica2.png', './musica3.png', './musica4.png', './musica5.png'];
		const autori= ['di Baustelle', 'di Roby Facchinetti', 'di Ligabue', 'di Niccolò Fabi'];
		const editori= ['Universal, 2025', 'WM Italy, 2025', 'Warner Music Italy, 2025', 'Universal, 2025'];
		
		for(let i=0; i < titoli.length; i++){
			const div= document.createElement('div');
			div.classList.add('libri');//aggiungiamo a questo elemento la classe libri, che corrisponde alla classe di cui gode di default il div presente in html
			
			const copertina=document.createElement('img');
			copertina.src=copertine[i];
			div.appendChild(copertina); //inseriamo nel div con classe 'libri' l'immagine. successivamente inseriremo in questo div il sottodiv e tutto ciò che contiene
			
			const sottoDiv= document.createElement('div');
			sottoDiv.classList.add('info');
			
			const titolo= document.createElement('a');
			titolo.textContent= titoli[i];
			const autore= document.createElement('strong');
			autore.textContent= autori[i];
			const editore= document.createElement('em');
			editore.textContent= editori[i];
			//adesso inseriamo nel sottodiv tutte queste informazioni
			sottoDiv.appendChild(titolo);
			sottoDiv.appendChild(autore);
			sottoDiv.appendChild(editore);
			//adesso inseriamo il sottodiv nel div con classe LIBRI
			div.appendChild(sottoDiv);
			//una volta inserito tutto nel div principale, inseriamo il div nel contenitore principale
			contenitore.appendChild(div);
			
		}
	}
	else if(scelta.dataset.index==="4"){
		console.log('è stato cliccato GIOCHI');
		//
		const new_img= document.querySelector('#first div img');
		new_img.src= './gioco1.png';
		const new_title= document.querySelector('#first a');
		new_title.textContent='Mercante in fiera';
		const new_author= document.querySelector('#first #autore');
		new_author.textContent='di Clementoni';
		const new_editor= document.querySelector('#first em');
		new_editor.textContent='';
		
		//passiamo a #others
		const contenitore= document.querySelector('#others'); //corrisponde al contenitore che conterrà i 4 div 
		contenitore.innerHTML= ''; //rimuoviamo tutto il contenuto di #others in maniera dinamica
		
		const titoli= ['FABA arriva Lucilla!', 'Toy Band Play. Tromba Cromata Grande', 'BRIO WORLD', 'Computer Kid Smart Laptop'];
		const copertine=['./gioco2.png', './gioco3.png', './gioco4.png', './gioco5.png'];
		const autori= ['di Faba', 'di Bontempi', 'di BRIO', 'di Clementoni'];
		
		for(let i=0; i < titoli.length; i++){
			const div= document.createElement('div');
			div.classList.add('libri');//aggiungiamo a questo elemento la classe libri, che corrisponde alla classe di cui gode di default il div presente in html
			
			const copertina=document.createElement('img');
			copertina.src=copertine[i];
			div.appendChild(copertina); //inseriamo nel div con classe 'libri' l'immagine. successivamente inseriremo in questo div il sottodiv e tutto ciò che contiene
			
			const sottoDiv= document.createElement('div');
			sottoDiv.classList.add('info');
			
			const titolo= document.createElement('a');
			titolo.textContent= titoli[i];
			const autore= document.createElement('strong');
			autore.textContent= autori[i];
			const editore= document.createElement('em');
			editore.textContent= '';
			//adesso inseriamo nel sottodiv tutte queste informazioni
			sottoDiv.appendChild(titolo);
			sottoDiv.appendChild(autore);
			sottoDiv.appendChild(editore);
			//adesso inseriamo il sottodiv nel div con classe LIBRI
			div.appendChild(sottoDiv);
			//una volta inserito tutto nel div principale, inseriamo il div nel contenitore principale
			contenitore.appendChild(div);
			
		}
	}
}
//con questa funzione teoricamente quando clicco su uno dei div segnalati questo deve cambiare colore del font in rosso
function changeColor(event){
	const scelta= event.currentTarget;
	
	for(const box of boxes){
		box.classList.remove('rosso'); //in questo modo eliminiamo la classe rosso a tutti gli elementi cliccati fino a questo momento
	}
	
	scelta.classList.add('rosso');
	// non metto "scelta.removeEventListener('click', changeColor);" perché voglio che possa ripetersi più volte
}

/*
function hamburger(event){
	const menuButton= event.currentTarget;
	menuButton.classList.add('hidden');
	
	const contenitore= document.querySelector('#contenitore');
	contenitore.classList.remove('hidden');
	non so come risolvere
} 

menu.addEventListener('click', hamburger);
console.log(menu);

function clickOnX(event){
	const scelta= event.currentTarget;
	
	const contenitore= document.querySelector('#contenitore');
	contenitore.classList.add('hidden');
	const menu= document.querySelector('#menu');
	menu.classList.remove('hidden');
	incompleto
	
}
const x= document.querySelector('#x');
x.addEventListener('click', clickOnX);
*/

function changeOverlay(event){
	const scelta= event.currentTarget;
	const sezione= document.querySelector('section');
	const promo= document.querySelector('#promo');
	sezione.innerHTML= '';
	sezione.classList.remove('chat1', 'chat2', 'chat3', 'chat4');
	
	if(scelta.dataset.index === "1"){
		sezione.classList.add('chat1');
		
		const paragrafo= document.createElement('p');
		paragrafo.textContent= 'Ogni libro è un viaggio. \n Parti da qui. \n';
		paragrafo.classList.add('white-space');
		const em= document.createElement('em');
		em.textContent='Scopri le novità editoriali e \nlasciati ispirare da nuove storie.';
		const a= document.createElement('a');
		a.href='';
		promo.classList.add('white-space'); //mi serve per mandare a capo le parole che vanno dopo \n
		promo.textContent='Solo per oggi: \n-20% su titoli selezionati!';
		a.appendChild(em);
		paragrafo.appendChild(a);
		sezione.appendChild(paragrafo);
		sezione.appendChild(promo);
	}
	
	else if(scelta.dataset.index === "2"){
		sezione.classList.add('chat2');
		
		const paragrafo= document.createElement('p');
		paragrafo.textContent= 'Il suono autentico. \n Il fascino senza tempo. \n';
		paragrafo.classList.add('white-space');
		const em= document.createElement('em');
		em.textContent='Dal black metal all’indie, \ntrova il tuo sound su Feltrinelli.it';
		const a= document.createElement('a');
		a.href='';
		promo.classList.add('white-space');
		promo.textContent= 'Promo esclusiva!\n Vinili e CD in offerta fino al 31 maggio';
		a.appendChild(em);
		paragrafo.appendChild(a);
		sezione.appendChild(paragrafo);
		sezione.appendChild(promo);
	}
	
	else if(scelta.dataset.index === "3"){
		sezione.classList.add('chat3');
		
		const paragrafo= document.createElement('p');
		paragrafo.textContent= 'Ogni film è una esperienza. \nQuale farai oggi?\n';
		paragrafo.classList.add('white-space');
		const em= document.createElement('em');
		em.textContent='Acquista film e cofanetti \nda collezione, solo su Feltrinelli.it';
		const a= document.createElement('a');
		a.href='';
		promo.classList.add('white-space');
		promo.textContent= 'Offerta imperdibile: \n3×2 su DVD e Blu-ray';
		a.appendChild(em);
		paragrafo.appendChild(a);
		sezione.appendChild(paragrafo);
		sezione.appendChild(promo);
	}
	
	else if(scelta.dataset.index === "4"){
		sezione.classList.add('chat4');
		
		const paragrafo= document.createElement('p');
		paragrafo.textContent= 'Più di un gioco: \nun momento da condividere. \n';
		paragrafo.classList.add('white-space');
		const em= document.createElement('em');
		em.textContent='Strategia, divertimento e risate: \nscegli il tuo gioco da tavolo.';
		const a= document.createElement('a');
		a.href='';
		promo.classList.add('white-space');
		promo.textContent= 'Metti in carrello il divertimento: \nspedizione gratuita su ordini sopra 50€.';
		a.appendChild(em);
		paragrafo.appendChild(a);
		sezione.appendChild(paragrafo);
		sezione.appendChild(promo);
	}
}

console.log(bottoni);
for(const bottone of bottoni){
	bottone.addEventListener('click', changeOverlay);
}

console.log(boxes);
for(const box of boxes){
	box.addEventListener('click', changeColor);
	box.addEventListener('click', changeSection);
}


//REST API
function onJson(json){
	console.log(json);
	const catalogo= document.querySelector('#risultati-ricerca');
	catalogo.innerHTML= '';

	if(!json){
		alert("Nessun risultato o errore nella risposta del server");
		return;
	}
	
	if(json.docs){
		let num_results= json.num_found; //perché num_found è un campo specifico dovuto all'API di openlibrary
		
		if(num_results > 10){
			num_results= 10;
		}
		
		for(let i=0; i < num_results; ++i){
			const doc= json.docs[i]; //accediamo al campo docs, in particolare all'elemento i-esimo dell'array docs
			const title= doc.title;
			let cover_url;
			if(doc.cover_i){
				cover_url= 'http://covers.openlibrary.org/b/id/' + doc.cover_i + '-M.jpg';
			}
			else{ //se non esiste l'immagine, metto un placeholder
				cover_url= '/img/placeholder.png';
			}

			/*effettuo una fetch per salvare nel database i risultati della ricerca */
			const dati={
				titolo: doc.title,
				copertina: cover_url,
				autore: doc.author_name ? doc.author_name[0] : 'Autore sconosciuto',
				tipologia: 'libri',
				url:'prodotto.php?title=' +encodeURIComponent(title)
					+ '&author=' +encodeURIComponent(doc.author_name)
					+ '&type=' +encodeURIComponent('libri')
			};
			fetch('/api/saveResults.php', {
				method: 'POST',
				headers: {'Content-Type' : 'application/json'},
				body: JSON.stringify(dati)
			}).then(onResponse).then(checkResults);
			
			const elemento= document.createElement('div');
			elemento.classList.add('elementi-ricerca');
			const a= document.createElement('a');
			a.href='../prodotto.php?title=' +encodeURIComponent(title)
			+ '&author=' +encodeURIComponent(doc.author_name)
			+ '&type=' +encodeURIComponent('libri'); //inserisco un link che mi permetta di accedere alla pagina del prodotto specifico
			const img= document.createElement('img');
			img.src= cover_url; 
			const titolo= document.createElement('strong');
			titolo.textContent= title;
			const author=doc.author_name ? doc.author_name[0] : 'Autore sconosciuto'; //se il campo author_name esiste, prendo il primo autore, altrimenti metto un testo di default
			const autore= document.createElement('em');
			autore.textContent=author;
			const choices= document.createElement('div');

			const preferiti= document.createElement('button');
			preferiti.textContent='❤️';
			const carrello= document.createElement('button');
			carrello.textContent='🛒';
			const like= document.createElement('button');
			like.textContent= '👍';
			const tipologia= document.createElement('p');
			tipologia.classList.add('hidden');
			tipologia.textContent= 'libri';

			preferiti.addEventListener('click', aggiungiPreferiti);
			carrello.addEventListener('click', aggiungiCarrello);
			like.addEventListener('click', mettiLike);

			a.appendChild(img);
			a.appendChild(titolo);
			a.appendChild(autore);

			choices.appendChild(like);
			choices.appendChild(preferiti);
			choices.appendChild(carrello);

			elemento.appendChild(a);
			elemento.appendChild(choices);
			elemento.appendChild(tipologia);

			catalogo.appendChild(elemento);
		}
	}
	else if(json.results){
		if(json.results.albummatches && json.results.albummatches.album){ //i campi cambiano, poiché dipendono dalle API tramite le quali effettuiamo la richiesta
		//bisogna fissare una lunghezza massima di elementi da mostrare in schermata
			const res= json.results.albummatches.album;
			let c= res.length;
			if(c > 10){
				c= 10;
			}
			for(let i=0; i < c; ++i){
				const album_title= res[i].name;
				let copertina_url;
				if(res[i].image){
					copertina_url= res[i].image[2]['#text']; /*in questo modo trovo l'url della copertina dell'album e 
					ne scelgo la dimensione con [2]['#text']
					che equivale a dimensione media*/
				}
				else{
					copertina_url= '/img/placeholder.png';
				}

				const dati={
					titolo: res[i].name,
					copertina: copertina_url,
					autore: res[i].artist,
					tipologia: 'musica',
					url: 'prodotto.php?title=' +encodeURIComponent(res[i].name)
						+ '&author=' +encodeURIComponent(res[i].artist)
						+ '&type=' +encodeURIComponent('musica')
				};
				fetch('/api/saveResults.php', {
					method: 'POST',
					headers: {'Content-Type' : 'application/json'},
					body: JSON.stringify(dati)
				}).then(onResponse).then(checkResults);
				
				const nome_artista= res[i].artist;
				//creiamo gli elementi affinché possiamo assegnare loro i dati ottenuti sopra
				const elemento= document.createElement('div');
				elemento.classList.add('elementi-ricerca');
				const a= document.createElement('a');
				a.href='../prodotto.php?title=' +encodeURIComponent(res[i].name)
				+ '&author=' +encodeURIComponent(res[i].artist)
				+ '&type=' +encodeURIComponent('musica');
				
				const img= document.createElement('img');
				img.src= copertina_url;
				const album= document.createElement('strong');
				album.textContent= album_title;
				const artista= document.createElement('em');
				artista.textContent= nome_artista;

				const choices= document.createElement('div');

				const preferiti= document.createElement('button');
				preferiti.textContent='❤️';
				const carrello= document.createElement('button');
				carrello.textContent='🛒';
				const like= document.createElement('button');
				like.textContent= '👍';
				const tipologia= document.createElement('p');
				tipologia.classList.add('hidden');
				tipologia.textContent= 'musica';

				preferiti.addEventListener('click', aggiungiPreferiti);
				carrello.addEventListener('click', aggiungiCarrello);
				like.addEventListener('click', mettiLike);

				a.appendChild(img);
				a.appendChild(album);
				a.appendChild(artista);

				choices.appendChild(like);
				choices.appendChild(preferiti);
				choices.appendChild(carrello);

				elemento.appendChild(a);
				elemento.appendChild(choices);
				elemento.appendChild(tipologia);

				catalogo.appendChild(elemento);
			
			}
		}
		
		else if(json.results[0] && json.results[0].poster_path){ /*come condizioni metto che json abbia come campo results,
		nello stesso tempo verifico che l'array results abbia almeno un elemento e che l'eventuale primo elemento dell'array presenti la copertina*/
			const risultati= json.results;
			let count= risultati.length;
			if(count> 10){
				count= 10;
			}
		
			for(let i=0; i < count; ++i){
				const film_title= risultati[i].original_title;
				let copertina_url;
				if(risultati[i].poster_path){
					copertina_url='https://image.tmdb.org/t/p/w342/' + risultati[i].poster_path;
				}
				else{
					copertina_url= '/img/placeholder.png';
				}

				const dati={
					titolo: risultati[i].original_title,
					copertina: copertina_url,
					autore: "N/D",
					tipologia: 'film',
					url:'prodotto.php?title=' +encodeURIComponent(risultati[i].original_title)
						+ '&author=' +encodeURIComponent("N/D")
						+ '&type=' +encodeURIComponent('film')
				};
				fetch('/api/saveResults.php', {
					method: 'POST',
					headers: {'Content-Type' : 'application/json'},
					body: JSON.stringify(dati)
				}).then(onResponse).then(checkResults);
				
				const elemento= document.createElement('div');
				elemento.classList.add('elementi-ricerca');
				const copertina= document.createElement('img');
				copertina.src= copertina_url;
				const titolo= document.createElement('strong');
				titolo.textContent= film_title;
				const autore= document.createElement('em');
				autore.textContent= "N/D";
				const a= document.createElement('a');
				a.href='../prodotto.php?title=' +encodeURIComponent(risultati[i].original_title)
				+ '&author=' +encodeURIComponent("N/D")
				+ '&type=' +encodeURIComponent('film');

				const choices= document.createElement('div');

				const preferiti= document.createElement('button');
				preferiti.textContent='❤️';
				const carrello= document.createElement('button');
				carrello.textContent='🛒';
				const like= document.createElement('button');
				like.textContent= '👍';
				const tipologia= document.createElement('p');
				tipologia.classList.add('hidden');
				tipologia.textContent= 'film';

				preferiti.addEventListener('click', aggiungiPreferiti);
				carrello.addEventListener('click', aggiungiCarrello);
				like.addEventListener('click', mettiLike);

				a.appendChild(copertina);
				a.appendChild(titolo);
				a.appendChild(autore);

				choices.appendChild(like);
				choices.appendChild(preferiti);
				choices.appendChild(carrello);

				elemento.appendChild(a);
				elemento.appendChild(choices);
				elemento.appendChild(tipologia);
			
				catalogo.appendChild(elemento);
			
			}
		}
		
		else if(json.results[0] && json.results[0].name && json.results[0].background_image){
			const risultati=json.results;
			let contatore= json.results.length;
			if(contatore > 10){
				contatore= 10;
			}
			
			for(let i=0; i < contatore; ++i){
				const game_title=risultati[i].name;
				let copertina_url;
				if(risultati[i].background_image){
					copertina_url= risultati[i].background_image;
				}
				else{
					copertina_url= '/img/placeholder.png';
				}
				
				let developer;
				if(risultati[i].developers && risultati[i].developers.length >0){
					developer= risultati[i].developers[0].name; //restituisce il nome del primo sviluppatore se presente
				}
				else{
					developer= "Sviluppatore sconosciuto";
				}

				const dati={
					titolo: risultati[i].name,
					copertina: copertina_url,
					autore: developer,
					tipologia: 'giochi',
					url:'prodotto.php?title=' +encodeURIComponent(risultati[i].name)
						+ '&author=' +encodeURIComponent(developer)
						+ '&type=' +encodeURIComponent('giochi')
				};
				fetch('/api/saveResults.php', {
					method: 'POST',
					headers: {'Content-Type' : 'application/json'},
					body: JSON.stringify(dati)
				}).then(onResponse).then(checkResults);
				
				const elemento= document.createElement('div');
				elemento.classList.add('elementi-ricerca');
				const titolo= document.createElement('strong');
				titolo.textContent= game_title;
				const copertina= document.createElement('img');
				copertina.src= copertina_url;
				const autore= document.createElement('em');
				autore.textContent= developer;
				const a= document.createElement('a');
				a.href='../prodotto.php?title=' +encodeURIComponent(risultati[i].name)
				+ '&author=' +encodeURIComponent(developer)
				+ '&type=' +encodeURIComponent('giochi');

				const choices= document.createElement('div');

				const preferiti= document.createElement('button');
				preferiti.textContent='❤️';
				const carrello= document.createElement('button');
				carrello.textContent='🛒';
				const like= document.createElement('button');
				like.textContent= '👍';
				const tipologia= document.createElement('p');
				tipologia.classList.add('hidden');
				tipologia.textContent= 'giochi';

				preferiti.addEventListener('click', aggiungiPreferiti);
				carrello.addEventListener('click', aggiungiCarrello);
				like.addEventListener('click', mettiLike);

				a.appendChild(copertina);
				a.appendChild(titolo);
				a.appendChild(autore);

				choices.appendChild(like);
				choices.appendChild(preferiti);
				choices.appendChild(carrello);

				elemento.appendChild(a);
				elemento.appendChild(choices);
				elemento.appendChild(tipologia);
				
				catalogo.appendChild(elemento);
			}
		}
	}
	
}

function checkResults(json){
	if(json && json.success){
		console.log("Elemento aggiunto nel database");
	}
	else{
		console.log(json.errore);
	}
}

function mettiLike(event){
	const like= event.currentTarget;
	const elemento= like.parentNode.parentNode; //perché il bottone è figlio di div che a sua volta è figlio di un altro div
	const titolo=elemento.querySelector('strong').textContent; //prendo il titolo dell'elemento all'interno del quale vi è il bottone che ho cliccato
	const immagine=elemento.querySelector('img').src;
	const autore= elemento.querySelector('em').textContent;
	const tipologia= elemento.querySelector('p').textContent;

	const dati={
		title: titolo,
		copertina: immagine,
		author: autore,
		type: tipologia
	};//oggetto js che conterrà i dati che voglio inviare al server

	fetch('/api/addLike.php', {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(dati)
	}).then(onResponse).then(checkLike);
	
}

function checkLike(json){
	if(json && json.success){
		if(json.deleted){
			alert("Hai tolto 'Mi Piace' al prodotto!");
		}
		else{
			alert("Hai messo 'Mi Piace' al prodotto!");
		}
	}
	else{
		alert("Errore durante l'inserimento del 'Mi piace'");
	}
}

function aggiungiPreferiti(event){ //qui dobbiamo fare una richiesta POST per aggiungere l'elemento desiderati nei preferiti
	const preferiti= event.currentTarget;
	const elemento= preferiti.parentNode.parentNode; //perché il bottone è figlio di div che a sua volta è figlio di un altro div
	const titolo=elemento.querySelector('strong').textContent; //prendo il titolo dell'elemento all'interno del quale vi è il bottone che ho cliccato
	const immagine=elemento.querySelector('img').src;
	const autore= elemento.querySelector('em').textContent;
	const tipologia= elemento.querySelector('p').textContent;

	const dati={
		title: titolo,
		copertina: immagine,
		author: autore,
		type: tipologia
	};//oggetto js che conterrà i dati che voglio inviare al server

	fetch('/api/aggiungiPreferiti.php', {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(dati)
	}).then(onResponse).then(checkPreferiti);

}

function checkPreferiti(json){
	if(json &&json.success){
		if(json.deleted){
			alert("Elemento rimosso dai tuoi preferiti!")
		}
		else{
			alert("Elemento aggiunto nei tuoi preferiti!");
		}
	}
	else{
		alert("Errore nell'inserimento dell'elemento nei tuoi preferiti");
	}
}

function aggiungiCarrello(event){
	const carrello= event.currentTarget;
	const elemento= carrello.parentNode.parentNode; //perché il bottone è figlio di div che a sua volta è figlio di un altro div
	const titolo=elemento.querySelector('strong').textContent; //prendo il titolo dell'elemento all'interno del quale vi è il bottone che ho cliccato
	const immagine=elemento.querySelector('img').src;
	const autore= elemento.querySelector('em').textContent;
	const tipologia= elemento.querySelector('p').textContent;

	const dati={
		title: titolo,
		copertina: immagine,
		author: autore,
		type: tipologia
	};//oggetto js che conterrà i dati che voglio inviare al server

	fetch('/api/aggiungiCarrello.php', {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(dati)
	}).then(onResponse).then(checkCarrello);
}

function checkCarrello(json){
	if(json && json.success){
		if(json.add){
			console.log("elemento aggiunto");
			alert("Elemento inserito nel carrello!");
		}
		else{
			alert("Elemento già presente nel carrello! E' stata aggiunta una copia!");
		}
	}
	else{
		alert("Problemi nell'inserimento dell'elemento nel carrello!");
	}
}

function onResponse(response){
	if(!response.ok){
		console.log('RISPOSTA NON VALIDA');
		return null;
	}
	return response.json();
}

function ricerca(event){
	event.preventDefault(); //per impedire il submit del Form
	//
	const q_input= document.querySelector('.principale');
	const q_value=encodeURIComponent(q_input.value);
	console.log('Eseguo ricerca: ' +q_value);
	const selection= document.querySelector('select'); //lo faccio per utilizzare la scelta effettuata come condizione negli if
	let rest_url= '';
	let api_key= '';
	let id;
	if(selection.value==='libri'){
		id=1;
		rest_url= "/api/ricerca.php?id=" +id + "&q=" +q_value;
	}
	
	else if(selection.value === 'musica'){
		id=2;
		rest_url= "/api/ricerca.php?id=" +id + "&q=" +q_value; 
	}
	
	else if(selection.value === 'film'){
		id=3;
		rest_url= "/api/ricerca.php?id=" +id + "&q=" +q_value; 
	}
	
	else if(selection.value=== 'giochi'){
		//impossibile, perché non esistono API pubbliche gratuite. esiste quella di boardgamesgeek, ma è indirizzato per xml
		//al momento, uso un'api che mi permetta di accedere a un catalogo di videogiochi e non di giochi da tavolo
		id=4;
		rest_url= "/api/ricerca.php?id=" +id + "&q=" +q_value; 
	}
	
	console.log('URL: ' +rest_url);
	//esecuzione della fetch
	fetch(rest_url).then(onResponse).then(onJson);
}

const forms= document.querySelectorAll('form');
for(const form of forms){
	form.addEventListener('submit', ricerca);
}

