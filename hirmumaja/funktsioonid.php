<?php
require_once ('konf.php');
date_default_timezone_set('Europe/Tallinn');

function onAdmin(){
    return isset($_SESSION['onAdmin']) && $_SESSION['onAdmin'];
}


