
function onLoad(){
    document.getElementById('osta').disabled=true;

}

function ostamineKontroll(){
    let checkbox=document.getElementById('checkbox');
    let input  =document.getElementById('piletiArv');
    let osta=  document.getElementById('osta');

    if (checkbox.checked && input.value.trim() !== "" && input.value.trim() >0){
        osta.disabled=false;
    }
    else {
        osta.disabled=true;

    }
}