function aggiungiCarrello(event){
    const bottone= event.currentTarget;
    const elemento= bottone.parentNode.parentNode;

    const titolo= elemento.querySelector('.titolo').textContent;
    const immagine= elemento.querySelector('img').src;
    const autore= elemento.querySelector('.autore span').textContent;
    const tipologia= elemento.querySelector('.tipologia span').textContent;

    const dati={
        title: titolo,
        copertina: immagine,
        author: autore,
        type: tipologia
    };
    console.log(dati);

    fetch('api/aggiungiCarrello.php', {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(dati)
	}).then(onResponse).then(checkCarrello);

}
const carrello= document.querySelector('.aggiungi-carrello');
carrello.addEventListener('click', aggiungiCarrello);

function onResponse(response){
	if(!response.ok){
		console.log('RISPOSTA NON VALIDA');
		return null;
	}
	return response.json();
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

function aggiungiPreferiti(event){
    const bottone= event.currentTarget;
    const elemento= bottone.parentNode.parentNode;

    const titolo= elemento.querySelector('.titolo').textContent;
    const immagine= elemento.querySelector('img').src;
    const autore= elemento.querySelector('.autore span').textContent;
    const tipologia= elemento.querySelector('.tipologia span').textContent;

    const dati={
        title: titolo,
        copertina: immagine,
        author: autore,
        type: tipologia
    };
    console.log(dati);

    fetch('api/aggiungiPreferiti.php', {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(dati)
	}).then(onResponse).then(checkPreferiti);

}
const preferiti= document.querySelector('.aggiungi-preferiti');
preferiti.addEventListener('click', aggiungiPreferiti);

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

function mettiLike(event){
	const like= event.currentTarget;
	const elemento= like.parentNode.parentNode.parentNode;

    const titolo= elemento.querySelector('.titolo').textContent;
    const immagine= elemento.querySelector('img').src;
    const autore= elemento.querySelector('.autore span').textContent;
    const tipologia= elemento.querySelector('.tipologia span').textContent;

	const dati={
		title: titolo,
		copertina: immagine,
		author: autore,
		type: tipologia
	};//oggetto js che conterrà i dati che voglio inviare al server
    console.log(dati);

	fetch('api/addLike.php', {
		method: 'POST',
		headers: {'Content-Type': 'application/json'},
		body: JSON.stringify(dati)
	}).then(onResponse).then(checkLike);
	
}

function checkLike(json){
	if(json && json.success){
        const likeCount=document.querySelector('.like-count span');
        let current= parseInt(likeCount.textContent);
		if(json.deleted){
			alert("Hai tolto 'Mi Piace' al prodotto!");
            if(current >0) likeCount.textContent= current -1;
		}
		else{
			alert("Hai messo 'Mi Piace' al prodotto!");
            likeCount.textContent= current + 1;
		}
	}
	else{
		alert("Errore durante l'inserimento del 'Mi piace'");
	}
}

const like= document.querySelector('.like-btn');
like.addEventListener('click', mettiLike);