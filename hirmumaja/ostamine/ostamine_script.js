// siin on script mis kasutakse ainult ostamise lehel


// keelake alglaadimisel olevad nupud
function onLoadOst(){
    document.getElementById('osta').disabled=true;
}
function onLoadMaks(){
    document.getElementById('saada').disabled=true;
}


function ostamineKontroll() {
    // nõusoleku linnukese tiheduse kontroll ja makseviisi valik
    let checkbox = document.getElementById('checkbox');
    let select = document.getElementById('selectMakseviisid');
    let osta = document.getElementById('osta');
    let kokku = document.getElementById('kokku');

    if (checkbox.checked && select.value !== 'poleValitud' && parseInt(kokku.value) > 0) {
        osta.disabled = false;
    } else {
        osta.disabled = true;
    }
}


function saadamineKontroll(){
    // pangakaardi sisestusväljade ja nende tüübi täielikkuse kontroll

    let nimi=document.getElementById('kardiNimi');
    let number  =document.getElementById('kardiNumber');
    let kehtivus  =document.getElementById('kehtivus');
    let cvv  =document.getElementById('cvv').value.trim();


    if (nimi.value.trim() !== "" && number.value.trim() !== "" &&
        kehtivus.value.trim() !== "" &&
        cvv !== "" && /^\d{3}$/.test(cvv) && cvv >0){

        document.getElementById('saada').disabled=false;
    }
    else {
        document.getElementById('saada').disabled=true;

    }
}


