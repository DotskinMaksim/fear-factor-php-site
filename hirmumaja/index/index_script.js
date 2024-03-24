function onLoad(){
    document.getElementById('sisenes').disabled=true;

}
function sisenesKontroll(){
    let piletId  =document.getElementById('piletId');
    let kasutajaId  =document.getElementById('kasutajaId');

    let sisenes=        document.getElementById('sisenes');

    if(piletId.value.trim() !== "" && kasutajaId.value.trim()!== ""
        && piletId.value.trim() >0 && kasutajaId.value.trim()>0){
        sisenes.disabled=false;
    }
    else {
        sisenes.disabled=true;

    }
}