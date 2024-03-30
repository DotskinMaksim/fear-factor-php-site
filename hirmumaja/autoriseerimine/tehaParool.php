<?php
//fail et teha parool adminile
$parool="1";
$cool="superpaev";
$krypt=crypt($parool, $cool);
echo $krypt;