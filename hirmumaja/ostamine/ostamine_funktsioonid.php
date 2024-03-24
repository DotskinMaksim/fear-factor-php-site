<?php
require_once('../konf.php');
require_once('../funktsioonid.php');



function ostamine()
{
    $praeguneAeg = date("Y-m-d H:i:s");

    for ($i = 0; $i < $_REQUEST['piletiArv']; $i++) {
        global $yhendus;
        $insert_kask = $yhendus->prepare("INSERT INTO pilet (kasutajaId,nimi,ostupaev) VALUES (?,?,?)");
        $insert_kask->bind_param("iss", $_SESSION['kasutajaId'],$_SESSION['kasutajaNimi'],$praeguneAeg); // Assuming $_SESSION['kasutajaId'] holds user's ID

        if ($insert_kask->execute()) {
            echo "Pilet ostetud!";
            header("location: ../index.php");
        }
        $insert_kask->close();
    }
}
