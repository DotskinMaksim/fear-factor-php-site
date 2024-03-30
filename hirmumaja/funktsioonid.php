<!--siin on funktsioonid mis kasutakse igas failis-->

<?php
require_once ('konf.php');

//seadke aja arvutamiseks Eesti ajavöönd
date_default_timezone_set('Europe/Tallinn');

//funktsiooon kis kontrollib kas on kasutaja admin
function onAdmin(){
    //tagastab true või false
    return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
}


