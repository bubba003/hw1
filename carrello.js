function mostraCarrello(event){
    fetch('api/mostraCarrello.php').then(onResponse).then(onJson);

}

function onResponse(response){
     if(!response.ok){
		console.log('RISPOSTA NON VALIDA');
		return null;
	}
	return response.json();
}

function onJson(json){
    const contenitore= document.querySelector('#lista-carrello');
    contenitore.innerHTML= '';
    let num_prodotti=0;
    let costo_totale= 0;
    if(!json){
		alert("Nessun risultato o errore nella risposta del server");
		return;
	}

    if(json.success && json.carrello){
        const v=json.carrello;
        for(let i=0; i < v.length; ++i){
            //creiamo il contenitore che appunto conterrà tutte le informazioni del singolo prodotto
            const elemento= document.createElement('div');
            elemento.classList.add('elemento-carrello');

            const img= document.createElement('img');
            img.src= v[i]['COPERTINA'];
            const a= document.createElement('a');
            a.href= '/prodotto.php?title=' +v[i]['TITOLO']
            + '&author=' +v[i]['AUTORE'] 
            + '&type=' +v[i]['TIPOLOGIA'];
            a.appendChild(img);

            const info= document.createElement('div');
            info.classList.add('info-carrello');
            //adesso consideriamo tutte le infomazioni (copertina esclusa) da inserire nel div info
            const titolo= document.createElement('h2');
            titolo.classList.add('titolo');
            titolo.textContent=v[i]['TITOLO'];
            const autore= document.createElement('p');
            autore.classList.add('autore');
            autore.textContent=v[i]['AUTORE'];
            const prezzo= document.createElement('p');
            prezzo.classList.add('prezzo');
            prezzo.textContent= 'Prezzo: ' + v[i]['PREZZO'] + ' euro (singolo prodotto)';
            prezzo.dataset.valore= v[i]['PREZZO'];
            const quantity= document.createElement('p');
            quantity.classList.add('quantita');
            quantity.textContent= 'Quantità: ' + v[i]['QUANTITY'];
            /*setto data-valore a quantity perché mi servirà nel momento in cui
            l'utente vorrà rimuovere l'elemento selezionato dal carrello*/
            quantity.dataset.valore= v[i]['QUANTITY'];
            num_prodotti= num_prodotti + parseInt(v[i]['QUANTITY']);
            costo_totale= costo_totale + (v[i]['PREZZO'] * v[i]['QUANTITY']);
            //creiamo bottone per permettere all'utente di rimuovere dal carrello l'elemento selezionato
            const rimuovi= document.createElement('button');
            rimuovi.innerHTML= '🛒 <br> Rimuovi dal carrello';
            rimuovi.classList.add('rimuovi');
            rimuovi.addEventListener('click', rimuoviElemento);
            console.log('Evento click associato al bottone rimuovi');
            //adesso aggiungiamo in Info titolo, autore, prezzo
            info.appendChild(titolo);
            info.appendChild(autore);
            info.appendChild(prezzo);
            info.appendChild(quantity);
            //adesso aggiungiamo immagine, info e il bottone nell'elemento
            elemento.appendChild(a);
            elemento.appendChild(info);
            elemento.appendChild(rimuovi);
            //infine, aggiungiamo l'elemento al contenitore principale che conterrà tutti gli elementi trovati
            contenitore.appendChild(elemento);
        }
        const riepilogo= document.querySelector('#riepilogo-carrello');
        riepilogo.classList.remove('hidden');
        const totale_prodotti= document.querySelector('#totale-prodotti');
        totale_prodotti.textContent= 'Numero prodotti: ' + num_prodotti;
        totale_prodotti.dataset.valore= num_prodotti;
        const costo= document.querySelector('#costo-totale');
        costo.textContent= 'Totale: ' +costo_totale + 'euro';
        costo.dataset.valore= costo_totale;
        const bottone_nascosto= document.querySelector('#riepilogo-carrello button').classList.remove('hidden');
    }
    else{
        alert("Non hai alcun elemento nei preferiti!");
    }
}
const bottone= document.querySelector('.contenitore-bottone button');
bottone.addEventListener('click', mostraCarrello);

function rimuoviElemento(event){
    const bottone= event.currentTarget;
    const elemento= bottone.parentNode;
    //in questo modo posso trovare in maniera molto semplice i dati che mi servono
    const titolo= elemento.querySelector('.titolo').textContent;
    const autore= elemento.querySelector('.autore').textContent;
    const quantita= elemento.querySelector('.quantita').dataset.valore;

    const dati={
        title: titolo,
        author: autore,
        quantity: quantita
    };

    console.log(dati);

    fetch('api/rimuoviCarrello.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(dati)
    }).then(onResponse).then(json => checkRimozione(json, elemento));
}

function checkRimozione(json, elemento){
    if(json){
        if(json.success && json.deleted){
            const prezzo= parseInt(elemento.querySelector('.prezzo').dataset.valore);
            const quantity = parseInt(elemento.querySelector('.quantita').dataset.valore);

            const totaleProdotti = document.querySelector('#totale-prodotti');
            const costoTotale = document.querySelector('#costo-totale');

            let numProdotti = parseInt(totaleProdotti.dataset.valore);
            let costo = parseInt(costoTotale.dataset.valore);
            numProdotti= numProdotti -quantity;
            costo= costo - prezzo;

            if(numProdotti < 0) numProdotti = 0;
            if(costo < 0) costo = 0;

            totaleProdotti.dataset.valore = numProdotti;
            totaleProdotti.textContent='Numero prodotti: ' +numProdotti;
            costoTotale.dataset.valore = costo;
            costoTotale.textContent= 'Totale:' +costo + 'euro';

            elemento.remove();
            alert("Elemento rimosso dal carrello!");
        }
        else if(json.success && !json.deleted){
            const prezzo= parseInt(elemento.querySelector('.prezzo').dataset.valore);
            let quantity= parseInt(elemento.querySelector('.quantita').dataset.valore);
            const quantita= elemento.querySelector('.quantita');
            quantity= quantity -1;
            quantita.textContent= 'Quantità: ' +quantity;
            quantita.dataset.valore= quantity;

            const totaleProdotti = document.querySelector('#totale-prodotti');
            const costoTotale = document.querySelector('#costo-totale');
            

            let numProdotti = parseInt(totaleProdotti.dataset.valore);
            let costo = parseInt(costoTotale.dataset.valore);
            numProdotti= numProdotti -1;
            costo= costo - prezzo;


            if(numProdotti < 0) numProdotti = 0;
            if(costo < 0) costo = 0;

            totaleProdotti.dataset.valore = numProdotti;
            totaleProdotti.textContent = 'Numero prodotti: ' + numProdotti;
            costoTotale.dataset.valore = costo;
            costoTotale.textContent = 'Totale: ' + costo + ' euro';
            
            alert("Elemento ancora presente nel tuo carrello! E' stato ridotto di una quantità!");
        }
        else if(json.errore){
            alert(json.errore);
        }
        else{
            alert("Problemi nella rimozione dell'elemento dal carrello!");
        }
    }
}