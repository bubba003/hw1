function checkName(event){
    const input= event.currentTarget;
    const em=document.querySelector('#p-name em');
    formStatus.name = input.value.length;
    if(formStatus.name === 0){
        em.classList.remove('hidden');
    }
    else{
        em.classList.add('hidden');
    }
   
}

function checkSurname(event){
    const input= event.currentTarget;
    formStatus.surname = input.value.length;
     const em=document.querySelector('#p-surname em');

    if(formStatus.surname === 0){
        em.classList.remove('hidden');
    }
    else{
        em.classList.add('hidden');
    }
}

function usernameOnJson(json){
    // Controllo il campo exists ritornato dal JSON
    formStatus.username= !json.exists;
    if(formStatus.username){//cioè se non esiste
        document.querySelector("#p-username em").classList.add('hidden');
    }
    else{//cioè se esiste
        document.querySelector("#p-username em").textContent = "Nome utente già utilizzato";
        document.querySelector("#p-username em").classList.remove('hidden');
    }
}

function emailOnJson(json){
    formStatus.email=!json.exists;
    if(formStatus.email){
        document.querySelector("#p-email em").classList.add('hidden');
    }
    else{
        document.querySelector("#p-email em").textContent = "Email già utilizzata";
        document.querySelector("#p-email em").classList.remove('hidden');
    }
}


function onResponse(response){
	if(!response.ok){
		console.log('RISPOSTA NON VALIDA');
		return null;
	}
	return response.json();
}

function checkUsername(event){
    const input=event.currentTarget;
    const q=encodeURIComponent(input.value);
    const em=document.querySelector('#p-username em');

    if(q.length < 3){
        em.classList.remove('hidden');
        formStatus.username = false; 
    }
    else{
        fetch("api/checkUsername.php?q="+q).then(onResponse).then(usernameOnJson);
    }

}

function checkEmail(event){
    const input=event.currentTarget;
    const q=encodeURIComponent(input.value);
    const em=document.querySelector('#p-email em');
    /*controlliamo se l'email è valida. la condizione usa una espressione regolare (regex)
    per verificare che la stringa inserita sia nel formato di una email valida*/
    if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
        em.classList.remove('hidden');
        formStatus.email = false; //cioè formStatus[email]=false;
    }
    else{
        fetch("api/checkEmail.php?q="+q).then(onResponse).then(emailOnJson);
    }
    
}

function checkPassword(event){
    const input=event.currentTarget;
    const em=document.querySelector('#p-password em');
    formStatus.password= input.value.length;
    if(formStatus.password < 6 || !/[A-Z]/.test(input.value) || !/[!@#$%^&*(),.?":{}|<>]/.test(input.value)){
        em.classList.remove('hidden');
    }
    else{
        em.classList.add('hidden');
    }
    
}

function checkConfirmPassword(event){
    const input= event.currentTarget;
    const password= document.querySelector('#password');
    if(password.value !== input.value){
        document.querySelector('#p-confirm-password em').classList.remove('hidden');
    }
    else{
        document.querySelector('#p-confirm-password em').classList.add('hidden');
    }
}

const formStatus={"upload":true};
document.querySelector('#name').addEventListener('blur', checkName);
document.querySelector('#surname').addEventListener('blur', checkSurname);
document.querySelector('#username').addEventListener('blur', checkUsername);
document.querySelector('#email').addEventListener('blur', checkEmail);
document.querySelector('#password').addEventListener('blur', checkPassword);
document.querySelector('#confirm-password').addEventListener('blur', checkConfirmPassword);