<?php
//võtame sql andmed ja loome sellest sql päring

$kasutaja='d123173_maksdot';
$serverinimi='localhost';
//$serverinimi='d123173.mysql.zonevs.eu';
$parool='Tark123456';
$andmebaas='hirmudemaja';
$yhendus=NEW mysqli($serverinimi,$kasutaja,$parool,$andmebaas);
$yhendus->set_charset('UTF8');