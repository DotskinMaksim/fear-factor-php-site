<?php
session_start();
session_destroy();
header("location: ../index.php");       //kui otsustakse oma kontolt välja logida, taaskäivitage seanss ja saatke see avalehele
