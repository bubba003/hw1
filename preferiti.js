function mostraPreferiti(event){
    const bottone= event.currentTarget;
    
    for(const b of buttons){
        b.classList.remove('filtro-attivo');
    }

    bottone.classList.add('filtro-attivo');
    let type;
    let url;
    switch(bottone.dataset.index){
        case "0":
            console.log("è stato cliccato il tasto 'tutti'");
            type= "all";
            url='api/mostraPreferiti.php?type=' +encodeURIComponent(type);
            break;
        case "1":
            console.log("è stato cliccato il tasto 'libri'");
            type="libri";
            url='api/mostraPreferiti.php?type=' +encodeURIComponent(type);
            break;
        case "2":
            console.log("è stato cliccato il tasto 'film'");
            type= "film";
            url='api/mostraPreferiti.php?type=' +encodeURIComponent(type);
            break;
        case "3":
            console.log("è stato cliccato il tasto 'musica'");
            type="musica";
            url='api/mostraPreferiti.php?type=' +encodeURIComponent(type);
            break;
        case "4":
            console.log("è stato cliccato il tasto 'giochi'");
            type="giochi";
            url='api/mostraPreferiti.php?type=' +encodeURIComponent(type);
            break;
    }
    fetch(url).then(onResponse).then(onJson);
}

const buttons= document.querySelectorAll('#filtri-preferiti button');
for(const bottone of buttons){
    bottone.addEventListener('click', mostraPreferiti);
}

function onResponse(response){
    if(!response.ok){
		console.log('RISPOSTA NON VALIDA');
		return null;
	}
	return response.json();
}

function onJson(json){
    const contenitore= document.querySelector('#lista-preferiti');
    contenitore.innerHTML= '';

    if(!json){
		alert("Nessun risultato o errore nella risposta del server");
		return;
	}

    if(json.success && json.preferiti){
        const v=json.preferiti;
        for(let i=0; i < v.length; ++i){
            //creiamo il contenitore che appunto conterrà tutte le informazioni del singolo prodotto
            const elemento= document.createElement('div');
            elemento.classList.add('elemento-preferito');
            elemento.dataset.categoria= v[i]['TIPOLOGIA'];

            const img= document.createElement('img');
            img.src= v[i]['COPERTINA'];
            const a= document.createElement('a');
            a.href= '/prodotto.php?title=' +v[i]['TITOLO']
            + '&author=' +v[i]['AUTORE'] 
            + '&type=' +v[i]['TIPOLOGIA'];
            a.appendChild(img);

            const info= document.createElement('div');
            info.classList.add('info-preferito');
            //adesso consideriamo tutte le infomazioni (copertina esclusa) da inserire nel div info
            const titolo= document.createElement('h2');
            titolo.classList.add('titolo');
            titolo.textContent=v[i]['TITOLO'];
            const autore= document.createElement('p');
            autore.classList.add('autore');
            autore.textContent= v[i]['AUTORE'];
            const prezzo= document.createElement('p');
            prezzo.classList.add('prezzo');
            prezzo.textContent= v[i]['PREZZO'] + ' euro';

            /*adesso aggiungiamo un sottodiv in info per inserire dei bottoni per rimuovere l'elemento
            dai preferiti oppure per aggiungerlo al carrello*/
            const sottoInfo= document.createElement('div');
            sottoInfo.classList.add('azioni');
            const button1= document.createElement('button');
            button1.classList.add('rimuovi-preferiti');
            button1.innerHTML= '💔 <br> Rimuovi';
            const button2= document.createElement('button');
            button2.classList.add('aggiungi-carrello');
            button2.innerHTML= '🛒 <br> Carrello';
            //aggiungiamo degli event listener ai bottoni
            button1.addEventListener('click', rimuoviPreferiti);
            button2.addEventListener('click', aggiungiCarrello);
            //adesso aggiungiamo in sottoInfo i due bottoni
            sottoInfo.appendChild(button1);
            sottoInfo.appendChild(button2);
            //adesso aggiungiamo in Info titolo, autore, prezzo e sottoInfo
            info.appendChild(titolo);
            info.appendChild(autore);
            info.appendChild(prezzo);
            info.appendChild(sottoInfo);
            //adesso aggiungiamo immagine e info nell'elemento
            elemento.appendChild(a);
            elemento.appendChild(info);
            //infine, aggiungiamo l'elemento al contenitore principale che conterrà tutti gli elementi trovati
            contenitore.appendChild(elemento);
        }
    }
    else{
        alert("Non hai alcun elemento nei preferiti!");
    }
}
//funzionamento quasi identico a quello delle funzioni utilizzate in mhw3.js
function rimuoviPreferiti(event){
    const bottone= event.currentTarget;
    const elemento= bottone.parentNode.parentNode.parentNode; /*questo perché il bottone è 
    annidato in tre div*/
    const titolo= elemento.querySelector('.titolo').textContent;
    const copertina= elemento.querySelector('.elemento-preferito img').src;
    const autore= elemento.querySelector('.autore').textContent;

    const dati={
        title: titolo,
        cover: copertina,
        author: autore
    };

    fetch('api/rimuoviPreferiti.php', {
        method: 'POST',
        headers: {'Content-Type' : 'application/json'} ,
        body: JSON.stringify(dati)
    }).then(onResponse).then(json => checkRimozione(json, elemento));

   
}

function checkRimozione(json, elemento){
    if(json && json.success){
        elemento.remove(); //rimuove l'elemento dal DOM
        alert("Elemento rimosso dai tuoi preferiti!");
        
    }
    else{
        alert("Problemi nella rimozione dell'elemento dai tuoi preferiti!");
    }
}

function aggiungiCarrello(event){
    const bottone= event.currentTarget;
    const elemento= bottone.parentNode.parentNode.parentNode; /*questo perché il bottone è 
    annidato in tre div*/
    const titolo= elemento.querySelector('.titolo').textContent;
    const copertina= elemento.querySelector('.elemento-preferito img').src;
    const autore= elemento.querySelector('.autore').textContent;
    const tipologia= elemento.dataset.categoria;

    const dati={
        title: titolo,
        copertina: copertina,
        author: autore,
        type: tipologia
    };
    console.log(dati);

    fetch('api/aggiungiCarrello.php', {
        method: 'POST',
        headers: {'Content-Type' : 'application/json'} ,
        body: JSON.stringify(dati)
    }).then(onResponse).then(checkCarrello);

}

function checkCarrello(json){
    if(json && json.success){
		if(json.add){
			alert("Elemento inserito nel carrello!");
		}
		else{
			alert("Elemento già presente nel carrello! E' stata aggiunta una copia!");
		}
	}
	else{
        console.log(json.errore);
		alert("Problemi nell'inserimento dell'elemento nel carrello!");
	}
}