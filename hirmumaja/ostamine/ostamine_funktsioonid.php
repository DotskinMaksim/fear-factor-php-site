<?php


//siin on funktsioonid mis kasutakse ainult ostamise lehel


//ühendage vajalikud failid
require_once('../konf.php');
require_once('../funktsioonid.php');



//funktsioon et ostama valitud piletid
function ostamine()
{

//    see on selese et lisada piletis kehtivus aega
    $praeguneAeg = date("Y-m-d H:i:s"); //praegune aeg
    $polAastatHiljem = date("Y-m-d H:i:s", strtotime($praeguneAeg . " +6 month")); //aeg pool asta hiljem
    $aastaHiljem= date("Y-m-d H:i:s", strtotime($praeguneAeg . " +1 year")); //aeg aasta hiljem



    function lisaPilet($sessionTypp, $typp, $kehtivuseAeg)
    {
        // kontrollime, kas ostukorvis on mingit tüüpi pilet,
        // võtame selle koguse ja lisame koos kasutajatunnusega andmebaasi
        if ( $sessionTypp>0){
            for ($i = 0; $i < $sessionTypp; $i++) {
                global $yhendus;
                $insert_kask = $yhendus->prepare("INSERT INTO pilet (kasutajaId,nimi,ostupaev,kehtivKuni,typp) VALUES (?,?,?,?,?)");
                $insert_kask->bind_param("issss", $_SESSION['kasutajaId'],$_SESSION['kasutajaNimi'],$praeguneAeg,$kehtivuseAeg,$typp);
                if ($insert_kask->execute()) {
            //  saadame kasutaja 'minu piletid' lehtele
                    header("location: ../ostamine/omaPiletid.php");
                }
                $insert_kask->close();
            }

        }
    }
    //helistamisfunktsioonid igat tüüpi piletite parameetritega
    lisaPilet($_SESSION['soodusPiletiOstukorvis'],'soodus',$polAastatHiljem);
    lisaPilet($_SESSION['tavPiletiOstukorvis'],'tavaline',$polAastatHiljem);
    lisaPilet($_SESSION['lapsePiletiOstukorvis'],'lapse',$aastaHiljem);


    //tühjendame ostukorvi
    $_SESSION['soodusPiletiOstukorvis']=0;
    $_SESSION['tavPiletiOstukorvis']=0;
    $_SESSION['lapsePiletiOstukorvis']=0;
}

function arvutaKokku()

//    funktsioon mis arvutab koige pileti summat
{
//    korrutades piletite arvu nende hindadega
    $kokku = $_SESSION['soodusPiletiOstukorvis']*8+
        $_SESSION['lapsePiletiOstukorvis'] *5+
        $_SESSION['tavPiletiOstukorvis']*10;

    echo $kokku . '€';
}

function lisaMakseviis(){
    //funktsioon mis lisab uus makseviis

    //votame andmed
    $number = htmlspecialchars(trim($_POST['kardiNumber']));
    $nimi = htmlspecialchars(trim($_POST['kardiNimi']));
    $kehtivus = htmlspecialchars(trim($_POST['kehtivus']));
    $cvv = htmlspecialchars(trim($_POST['cvv']));


    //ja lisame andmebaasi
    global $yhendus;
    $insert_kask = $yhendus->prepare("INSERT INTO makseviis (number,nimi,kuni,cvv,kasutajaId) VALUES (?,?,?,?,?)");
    $insert_kask->bind_param("sssii", $number,$nimi,$kehtivus,$cvv,$_SESSION['kasutajaId']);
    $insert_kask->execute();
    $insert_kask->close();

}
function naitaMakseviisid($typp)
{
    //funktsioon mis naitab koik kasutaja makseviisid andmebaasist

    global $yhendus;
    $select_kask = $yhendus->prepare("SELECT id ,number FROM makseviis where kasutajaId=?");
    $select_kask->bind_param("i",$_SESSION['kasutajaId']);
    $select_kask->execute();
    $select_kask->bind_result( $id,$number);


    //kui on vaja naidata tabelis
    if ($typp=='tabelis'){
        while ($select_kask->fetch()) {

            //naitame ainult viimased 4 kardi numbrid turvalisuse pärast
            $tekst = substr($number, -4);
            echo "<tr>
                    <td><img src='../pildid/kart.png' alt='kartLogo' width='35' height='25'></td>
                    <td>**** **** **** $tekst</td>
                    <td>
                        <a href='ostamine.php?kustutaMakseViis=$id'><span style=\"color: red;\">Kustuta</span></a>                </td>
                  </tr>";
        }
    }
    //kui on vaja naidata optionis
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
    //funktsioon mis kustutab valutud makseviis tabelist
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
    //funktsioon mis naitab piletid ostukorvis  tabelis

    function naitaPilet($sessionTypp, $typp,$hind, $link){
        if ($sessionTypp>0){
            $arv=$sessionTypp;
            echo "<tr><td><img src='../pildid/pilet.png' alt='piletLogo' width='35' height='35'></td>
                              <td>$arv</td>
                              <td>$typp</td>
                              <td>$hind €</td>
                                <td><a href='$link'><span style=\"color: red;\">Kustuta</span></a></td></tr>";
        }
    }
//  määrata pileti parameetrid ja väljund, kasutades üldfunktsiooni
    naitaPilet($_SESSION['soodusPiletiOstukorvis'], 'Soodus pilet',8 ,'ostamine.php?kustSoodusPilet');
    naitaPilet($_SESSION['lapsePiletiOstukorvis'], 'Lapse pilett', 5,'ostamine.php?kustLapsePilet');
    naitaPilet($_SESSION['tavPiletiOstukorvis'], 'Tavaline pilet', 10,'ostamine.php?kustTavPilet');
}

function naitaOmaPiletid()
{
    //funktsioon mis naitab koik ostatud kasutaja piletid

    global $yhendus;

    //votame piletid andmebaasist
    $select_kask = $yhendus->prepare("SELECT id, kasutajaId, nimi, ostupaev, kehtivKuni, typp FROM pilet where kasutajaId=?");
    $select_kask->bind_param("i", $_SESSION['kasutajaId']);
    $select_kask->execute();
    $select_kask->bind_result($id, $kasutajaId, $nimi,$ostupaevAjaga,$kehtivKuniAjaga,$typp);

    $header="";
    $kirjeldus='';
    $hind=0;

    while ($select_kask->fetch()) {

//        vormingu tõlkimine 'datetime' tüppist 'date' tüppisse
        $ostupaev = date("Y-m-d", strtotime($ostupaevAjaga));
        $kehtivKuni=date("Y-m-d", strtotime($kehtivKuniAjaga));



//        märkige teabe parameetrid sõltuvalt pileti tüübist
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

        //naitame pilet lehel
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