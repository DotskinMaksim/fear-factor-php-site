// skript mis kasutakse ainult autoriseerimis lehtel


// keelake alglaadimisel olevad nupud
function onLoadSisse(){
    document.getElementById('logiSisse').disabled=true;
}
function onLoadReg(){
    document.getElementById('register').disabled=true;
}

function logiSisseKontroll(){
    // nuppude valgustuse täiteväljade juhtimine - sisse logimine
    let nimi  =document.getElementById('nimi');
    let parool  =document.getElementById('parool');

    let logiSisse=        document.getElementById('logiSisse');

    if(nimi.value.trim() !== "" && parool.value.trim()!== "" ){
        logiSisse.disabled=false;
    }
    else {
        logiSisse.disabled=true;

    }
}
function registreeriKontroll(){
    // nuppude valgustuse täiteväljade juhtimine - registreerimine

    let nimi  =document.getElementById('nimiReg');
    let parool1  =document.getElementById('parool1');
    let parool2  =document.getElementById('parool2');


    let registreeri=        document.getElementById('register');

    if(nimi.value.trim() !== "" && parool1.value.trim()!== "" && parool2.value.trim()!== "" ){
        registreeri.disabled=false;
    }
    else {
        registreeri.disabled=true;

    }
}