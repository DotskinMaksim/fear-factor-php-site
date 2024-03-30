// siin on kõik script mis kasutakse ainult sisenes lehel

function onLoad(){
    // lehe laadimisel muudame sisestusnupu vaikimisi passiivseks kuni andmete sisestamiseni
    document.getElementById('sisenes').disabled=true;
}
function sisenesKontroll(){
    // see on sisendi juhtnupp nupu valgustamiseks

    let piletId  =document.getElementById('piletId'); //pilet id input
    let kasutajaId  =document.getElementById('kasutajaId'); //kasutaja id input


    let sisenes=        document.getElementById('sisenes'); //nupp


    if(piletId.value.trim() !== "" && kasutajaId.value.trim()!== ""
        && piletId.value.trim() >0 && kasutajaId.value.trim()>0){
        // kui sisestusväljad ei ole tühjad ja võrduvad arvudega ning on suuremad kui 0
        sisenes.disabled=false; //nupp on aktiivne
    }
    else {
        //kui mitte siis ebaaktiivne veel
        sisenes.disabled=true;

    }
}

function uuendaAeg() {
    //funktsioon mis votab iga objekt classis 'aeg' ja uuendab tema adnmed iga sekond
    //et lehel oli taimer

    //votame koik aega veergud
    let aegElements = document.getElementsByClassName('aeg');

    for (let i = 0; i < aegElements.length; i++) {
        let aeg = aegElements[i].innerHTML; // aja hankimine praegusest elemendist
        var aegaOsad = aeg.split(":");
        var tundid = parseInt(aegaOsad[0], 10);
        var minutid = parseInt(aegaOsad[1], 10);
        var sekundid = parseInt(aegaOsad[2], 10);

        // suurenda sekundit 1 võrra
        sekundid++;

        // kontrollime, kas sekundid on jõudnud 60-ni
        if (sekundid >= 60) {
            sekundid = 0;
            minutid++;

            // kontrollime, kas minutid on jõudnud 60-ni

            if (minutid >= 60) {
                minutid = 0;
                tundid++;

            // kontrollime, kas kell on jõudnud 24-ni
                if (tundid >= 24) {
                    tundid = 0; // lahtestame kell 0-le,kui see on jõudnud 24-ni
                }
            }
        }
        // moodustage ajastring vormingus t : m : s
        var aegString =
            (tundid < 10 ? "0" : "") + tundid + " : " +
            (minutid < 10 ? "0" : "") + minutid + " : " +
            (sekundid < 10 ? "0" : "") + sekundid;

        // uuendame praeguse elemendi aeg sisu
        aegElements[i].innerHTML = aegString;
    }
}
