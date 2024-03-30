<?php
//siin on funktsioonid mis kasutakse ainult sisenes lehel

//ühendage vajalikud failid
require_once ('../konf.php');
require_once ('../funktsioonid.php');



//näitamine inimesed mis on juba hirmude majas ja kui palju nad seal asuvad
function naidataInimesiSisenes()
{
    global $yhendus;

//    võtame kõik külastused hirmumajja, kus väljapääs pole veel märgitud -
//    (see tähendab, et kasutaja on veel sees) ja lisame kasutaja andmed
    $select_kask = $yhendus->prepare
    ("SELECT hirmumaja.id, hirmumaja.kasutajaId, hirmumaja.sisenes, kasutaja.login
                                            FROM hirmumaja
                                            JOIN kasutaja ON hirmumaja.kasutajaId = kasutaja.id
                                            WHERE hirmumaja.lahkus IS NULL");
    $select_kask->execute();

//    tulemus
    $select_kask->bind_result($id, $kasutajaId, $sisenes, $nimi);


    $inimesteArv = 0; //sees viibivate inimeste arvu loendur

    while ($select_kask->fetch()) {

        $praeguneAeg = date("Y-m-d H:i:s"); //võtame praegune aeg ja kirjutame seda
        $aegSisenes = strtotime($praeguneAeg) - strtotime($sisenes); //arvutage strotime meetodi abil sisemine-
        // aeg, lahutades praegusest kellaajast tagasiaja

        //poolt jagame
        $aegSisenesTundites = gmdate("H", $aegSisenes); //tundile
        $aegSisenesMinutites = gmdate("i", $aegSisenes); //minutile
        $aegSisenesSekundites = gmdate("s", $aegSisenes); //sekundile

        //suurendage loendurit 1 võrra
        $inimesteArv++;
        // kuvage nimi ja kuvage kellaaeg sisemiselt, määrates reale tunniaja,
        // et hiljem Java skripti kaudu andmeid iga sekund uuendada
        echo "<tr><td>$nimi</td>
     
              <td class='aeg'>$aegSisenesTundites : $aegSisenesMinutites : $aegSisenesSekundites</td>
                      ";
        //kui ksautaja on admin temal on voimalus kirjutada lahenes
        if (onAdmin()){
            echo "<td><a href='sisenes.php?lahkus=$id'><span style=\"color: red;\">Lahkus</span></a></td></tr>";}
    }

    //kaski sulgemine
    $select_kask->close();

    //kokku
    echo "<tr><td>Kokku: $inimesteArv</td></tr>";
}

function lahkus()
{
    global $yhendus;

// võtke külastuse ID ja praegune aeg
    $praeguneAeg = date("Y-m-d H:i:s");
    $id = $_REQUEST['lahkus'];

//  ja lisage ID-ga kodust lahkumise aeg
    $update_kask = $yhendus->prepare("UPDATE hirmumaja SET lahkus=? WHERE id=?");
    $update_kask->bind_param("si", $praeguneAeg, $id); //argumentid
    $update_kask->execute();

    //kaski sulgemine
    $update_kask->close();
}
function sisenes()
{
// see on sisenes pileti kontroll

    global $yhendus;

    $praeguneAeg = date("Y-m-d H:i:s");

// votame paringust
    $kasutajId = $_POST['kasutajaId']; //kasutajate id
    $piletId = $_POST['piletId']; //ja pileti id


    //votame tabelis et vaadata kas on olemad pilet seda pileti ja kasutajate id-ga
    $select_kask = $yhendus->prepare("SELECT id, kasutajaId, kehtivKuni FROM pilet WHERE id=? AND kasutajaId=?");
    $select_kask->bind_param("ii", $piletId, $kasutajId);
    $select_kask->execute();
    $select_kask->store_result();

    // Kontrollime päringu õnnestumist ja võtke vastu andmed
    if ($select_kask->num_rows > 0) {
        $select_kask->bind_result($id, $kasutajaId, $kehtivKuni);
        $select_kask->fetch();

        // Võrdle kuupäevi
        if ($kehtivKuni > $praeguneAeg) {
            //kui ta pole aegunud kustutame tabelis see pilet et kasutaja ei saanud kasutada seda veel kord
            $delete_kask = $yhendus->prepare("DELETE FROM pilet WHERE id=? AND kasutajaId=?");
            $delete_kask->bind_param("ii", $piletId, $kasutajId);
            $delete_kask->execute();

            //kui edukalt  kustutasime
            if ($delete_kask->affected_rows > 0) {
                // lisame kulastuse lahkuse aeg
                $insert_kask = $yhendus->prepare("INSERT INTO hirmumaja (sisenes, kasutajaId) VALUES (?, ?)");
                $insert_kask->bind_param("si", $praeguneAeg, $kasutajId);
                $insert_kask->execute();
                $insert_kask->close();
            }
            //sulge kask
            $delete_kask->close();
        } else {
            //kui pilet on aegunud saadame paringut nimega mis lehel protsessib
            header("location: sisenes.php?piletAegunud");
            exit;
        }
        // ja kui id-ed on valed
    } else {
        header("location: sisenes.php?valePilet");
        exit;
    }

    $select_kask->close();
}