<?php
require_once('../konf.php');
require_once('../funktsioonid.php');



function ostamine()
{
    $praeguneAeg = date("Y-m-d H:i:s");
    $polAastatHiljem = date("Y-m-d H:i:s", strtotime($praeguneAeg . " +6 month"));
    $aastaHiljem= date("Y-m-d H:i:s", strtotime($praeguneAeg . " +1 year"));


    if ( $_SESSION['soodusPiletiOstukorvis']>0){
        $typp='soodus';
        for ($i = 0; $i < $_SESSION['soodusPiletiOstukorvis']; $i++) {
            global $yhendus;
            $insert_kask = $yhendus->prepare("INSERT INTO pilet (kasutajaId,nimi,ostupaev,kehtivKuni,typp) VALUES (?,?,?,?,?)");
            $insert_kask->bind_param("issss", $_SESSION['kasutajaId'],$_SESSION['kasutajaNimi'],$praeguneAeg,$polAastatHiljem,$typp);
            if ($insert_kask->execute()) {
                header("location: ../sisenes.php");
            }
            $insert_kask->close();
        }

    }
    if ( $_SESSION['tavPiletiOstukorvis']>0){
        $typp='tavaline';
        for ($i = 0; $i < $_SESSION['tavPiletiOstukorvis']; $i++) {
            global $yhendus;
            $insert_kask = $yhendus->prepare("INSERT INTO pilet (kasutajaId,nimi,ostupaev,kehtivKuni,typp) VALUES (?,?,?,?,?)");
            $insert_kask->bind_param("issss", $_SESSION['kasutajaId'],$_SESSION['kasutajaNimi'],$praeguneAeg,$polAastatHiljem,$typp);
            if ($insert_kask->execute()) {
                header("location: ../sisenes.php");
            }
            $insert_kask->close();
            $_SESSION['tavPiletiOstukorvis']=0;
        }

    }
    if ( $_SESSION['lapsePiletiOstukorvis']>0){
        $typp='lapse';
        for ($i = 0; $i < $_SESSION['lapsePiletiOstukorvis']; $i++) {
            global $yhendus;
            $insert_kask = $yhendus->prepare("INSERT INTO pilet (kasutajaId,nimi,ostupaev,kehtivKuni,typp) VALUES (?,?,?,?,?)");
            $insert_kask->bind_param("issss", $_SESSION['kasutajaId'],$_SESSION['kasutajaNimi'],$praeguneAeg,$aastaHiljem,$typp);
            if ($insert_kask->execute()) {
                header("location: ../sisenes.php");
            }
            $insert_kask->close();
            $_SESSION['lapsePiletiOstukorvis']=0;
        }

    }
    if ( $_SESSION['soodusPiletiOstukorvis']>0){
        $typp='soodus';
        for ($i = 0; $i < $_SESSION['soodusPiletiOstukorvis']; $i++) {
            global $yhendus;
            $insert_kask = $yhendus->prepare("INSERT INTO pilet (kasutajaId,nimi,ostupaev,kehtivKuni,typp) VALUES (?,?,?,?,?)");
            $insert_kask->bind_param("issss", $_SESSION['kasutajaId'],$_SESSION['kasutajaNimi'],$praeguneAeg,$polAastatHiljem,$typp);
            if ($insert_kask->execute()) {
                header("location: ../sisenes.php");
            }
            $insert_kask->close();
            $_SESSION['soodusPiletiOstukorvis']=0;
        }

    }
}

function arvutaKokku()
{
    $kokku = $_SESSION['soodusPiletiOstukorvis']*8+
        $_SESSION['lapsePiletiOstukorvis'] *5+
        $_SESSION['tavPiletiOstukorvis']*10;

    echo $kokku . '€';



}
function lisaMakseviis(){
    $number = htmlspecialchars(trim($_POST['kardiNumber']));
    $nimi = htmlspecialchars(trim($_POST['kardiNimi']));
    $kehtivus = htmlspecialchars(trim($_POST['kehtivus']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));

    global $yhendus;
    $insert_kask = $yhendus->prepare("INSERT INTO makseviis (number,nimi,kuni,cvv,kasutajaId) VALUES (?,?,?,?,?)");
    $insert_kask->bind_param("sssii", $number,$nimi,$kehtivus,$cvv,$_SESSION['kasutajaId']);
    $insert_kask->execute();
    $insert_kask->close();

}
function naitaMakseviisid($typp)
{
    global $yhendus;


    $select_kask = $yhendus->prepare("SELECT id ,number FROM makseviis where kasutajaId=?");
    $select_kask->bind_param("i",$_SESSION['kasutajaId']);
    $select_kask->execute();
    $select_kask->bind_result( $id,$number);

    if ($typp=='tabelis'){

        while ($select_kask->fetch()) {
            $tekst = substr($number, -4);
            echo "<tr>
                    <td><img src='../pildid/kart.png' alt='kartLogo' width='35' height='25'></td>
                    <td>**** **** **** $tekst</td>
                    <td>
                        <a href='ostamine.php?kustutaMakseViis=$id'><img src='../pildid/kustuta.png' alt='kustutaLogo' width='35' height='35'></a>                </td>
                  </tr>";
        }
    }
    if ($typp == 'option') {
        echo '<option value="poleValitud">Valige...</option>';

        while ($select_kask->fetch()) {
            $tekst = substr($number, -4);
            echo "<option value='$tekst'>**** $tekst</option>";
        }
    }

    $select_kask->close();

}
function kustutaMakseviis($id)
{
    global $yhendus;

    $delete_kask = $yhendus->prepare("DELETE FROM makseviis WHERE id=?");
    $delete_kask->bind_param("i", $id);
    $delete_kask->execute();
    $delete_kask->close();

    header("location: ostamine.php?makseviisid");
    exit();
}

function naitaOstukorvist()
{
    if ($_SESSION['soodusPiletiOstukorvis']>0){
        $arv=$_SESSION['soodusPiletiOstukorvis'];
        echo "<tr><td><img src='../pildid/pilet.png' alt='piletLogo' width='35' height='35'></td>
                              <td>$arv</td>
                              <td>Soodus pilet</td>
                                <td><a href='ostamine.php?kustSoodusPilet'><img src='../pildid/kustuta.png' alt='kustutaLogo' width='35' height='35'></a></td></tr>";
    }
    if ($_SESSION['lapsePiletiOstukorvis']>0){
        $arv=$_SESSION['lapsePiletiOstukorvis'];
        echo "<tr><td><img src='../pildid/pilet.png' alt='piletLogo' width='35' height='35'></td>
                                <td>$arv</td>
                                <td>Lapse pilet</td>
                                <td><a href='ostamine.php?kustLapsePilet'><img src='../pildid/kustuta.png' alt='kustutaLogo' width='35' height='35'></a></td></tr>";
    }
    if ($_SESSION['tavPiletiOstukorvis']>0){
        $arv=$_SESSION['tavPiletiOstukorvis'];
        echo "<tr><td><img src='../pildid/pilet.png' alt='piletLogo' width='35' height='35'></td>
                                <td>$arv</td>
                                <td>Tavaline pilet</td>
                                <td><a href='ostamine.php?kustTavPilet'><img src='../pildid/kustuta.png' alt='kustutaLogo' width='35' height='35'></a></td></tr>";
    }
}

function naitaOmaPiletid()
{

    global $yhendus;


    $select_kask = $yhendus->prepare("SELECT id, kasutajaId, nimi, ostupaev, kehtivKuni, typp FROM pilet where kasutajaId=?");
    $select_kask->bind_param("i", $_SESSION['kasutajaId']);
    $select_kask->execute();
    $select_kask->bind_result($id, $kasutajaId, $nimi,$ostupaevAjaga,$kehtivKuniAjaga,$typp);

    $header="";
    $kirjeldus='';
    $hind=0;

    while ($select_kask->fetch()) {
        $ostupaev = date("Y-m-d", strtotime($ostupaevAjaga));
        $kehtivKuni=date("Y-m-d", strtotime($kehtivKuniAjaga));

        if ($typp == 'lapse') {
            $header = "Lapse pilet";
            $kirjeldus = 'Tallinna Hirmudemajja ühekordse külastuse pilet alla 7-aastasele lapsele';
            $hind = 5;
        } else if ($typp == 'soodus') {
            $header = "Soodus pilet";
            $kirjeldus = 'Tallinna Hirmudemajja ühekordse külastuse pilet pensionäridele, puuetega inimestele ja õpilastele';
            $hind = 8;

        } else {
            $header = "Tavaline pilet";
            $kirjeldus = 'Tallinna Hirmudemajja ühekordse külastuse pilet täiskasvanule';
            $hind = 10;

        }


        echo "<div class='PiletDiv'>
            <div class='PiletHeader'>
                <h2>$header</h2>
            </div>
            <div class='PiletKirjeldus'>
                <p>$kirjeldus</p>
            </div>
            <div class='PiletInfo'>
                <span>Ostetud: $ostupaev</span>
                <span>Kehtiv kuni: $kehtivKuni</span>
            </div>
            <div class='PiletInfo'>
                <span>Koht: Tallinna hirmude maja | Sõpruse pst 182, 13424 Tallinn</span>
            </div>
            <div class='PiletInfo'>
                <span>Hind: $hind €</span>
            </div>
            <div class='PiletInfo'>
                <span>Pileti id: $id</span>
                <span>Kasutaja id: $kasutajaId</span>
            </div>
        </div>";
    }
    $select_kask->close();

}