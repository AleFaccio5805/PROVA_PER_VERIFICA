var porta = 80;
var indirizzoServer = "http://localhost:"+porta+"/FACCIO/PROVA_PER_VERIFICA/PHP/";

function login(){
    let ut = document.getElementById("txtUtente").value;
    let pw = document.getElementById("txtPassword").value;

    let dati = {"ut":ut, "pwd":pw};
    let promise = fetch(indirizzoServer + "login.php", {
        method:'POST',
        headers:{
            /* TIPO DI DATI INVIATI */
            'Content-Type':'application/json'
        },
        /* CONVERSIONE DA JSON a STRINGA */
        body:JSON.stringify(dati)
    });
    promise.then(
        async (risposta)=>{
            let dati = await risposta.json();
            console.log(dati);
            if(dati.login == true && dati.cod == 1){
                alert("Login Avvenuto con Successo");
                let txt = document.getElementById("testo");
                txt.innerHTML += dati.cod + ": info ==>  ";
                richiediInfo();
            }
        }
    )
}

function richiediInfo(){
    let ut = document.getElementById("txtUtente").value;
    let dati = {"ut":ut};

    let promise = fetch(indirizzoServer + "informazioni.php", {
        method:'POST',
        headers:{
            /* TIPO DI DATI INVIATI */
            'Content-Type':'application/json'
        },
        /* CONVERSIONE DA JSON a STRINGA */
        body:JSON.stringify(dati)
    });
    promise.then(
        async (risposta)=>{
            let dati = await risposta.json();
            console.log(dati);
            if(dati.trovato == 1){
                alert("Informazioni Ottenute con Successo");
                let txt = document.getElementById("testo");
                txt.innerHTML += dati.info;
            }
        }
    )
}