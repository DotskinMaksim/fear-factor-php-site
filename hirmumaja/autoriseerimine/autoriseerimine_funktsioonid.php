<?php

//siin on funktsioonid mis kasutakse ainult autorisserimis formides

require_once ('../konf.php');
require_once ('../funktsioonid.php');
//ühendage vajalikud failid


function parooliValideerimine($parool)
{
    //funktsioon, mis kontrollib paroolis vähemalt ühe sümboli, numbri ja ka 5 tähe olemasolu

//    muidu tuleb tagastab false
    if (!preg_match('/\d/', $parool)) {
        return false;
    }
    if (!preg_match('/[a-zA-Z]/', $parool)) {
        return false;
    }
    if (!preg_match('/[^a-zA-Z0-9]/', $parool)) {
        return false;
    }
    if (strlen($parool) < 5) {
        return false;
    }
    return true;
}


function logiSisse()
{       //sisse logimis funktsioon

        //votamr nimi ja parool inputist
        $nimi = htmlspecialchars(trim($_POST['nimi']));
        $parool = htmlspecialchars(trim($_POST['parool']));

        //krüptidame parool
        $cool="superpaev";
        $krypt = crypt($parool, $cool);

        global $yhendus;

        //votame kasutaja andmebaasist et kontrollida nimi ja parool
        $select_kask=$yhendus-> prepare("SELECT id, login, onAdmin FROM kasutaja WHERE login=? AND parool=?");
        $select_kask->bind_param("ss", $nimi, $krypt);
        $select_kask->bind_result($id,$kasutaja, $onAdmin);
        $select_kask->execute();


        //kui nad on oiget ja kask on teginud hasti
        if ($select_kask->fetch()) {
            $_SESSION['kasutajaNimi'] = $nimi; //paneme sessioni kasutaja nimi
            $_SESSION['kasutajaId'] = $id; //id
            $_SESSION['onAdmin'] = $onAdmin; //kas ta on admin voi pole
            $_SESSION['soodusPiletiOstukorvis'] =0; //ja ostukorv
            $_SESSION['lapsePiletiOstukorvis'] =0;
            $_SESSION['tavPiletiOstukorvis'] =0;
            header("location: ../index.php");

        }
        else{
            //kui vale tagastame viga kirjega
            header("location: logiSisse.php?vale");

        }
        $yhendus->close();

}

function register()
{    //registreerimis funktsioon

    global $yhendus;

    //votame andmed inputist
    $nimi = htmlspecialchars(trim($_POST['nimi'])); //nimi
    $parool1 = htmlspecialchars(trim($_POST['parool1']));//parool
    $parool2 = htmlspecialchars(trim($_POST['parool2']));//parooli kinnitamine

    //kontrollime et tabelis pole sama kasutajat
    $select_kask=$yhendus-> prepare("select id, login from kasutaja where login=?");
    $select_kask->bind_param("s", $nimi);
    $select_kask->bind_result($id,$user);
    $select_kask->execute();
    if (!$select_kask->fetch()) {    //kui pole
        if ($parool2 == $parool1) { //kui parool on linnitatud oige
            if (parooliValideerimine($parool1)) { //kui parool pole nõrk

                //krüptidame parool
                $cool = "superpaev";
                $krypt = crypt($parool1, $cool);

                //lisame andmebaasi uue kasutajat
                $insert_kask = $yhendus->prepare("insert into kasutaja(login,parool,onAdmin) values(?,?,0)"); //lisane uue konto
                $insert_kask ->bind_param("ss", $nimi, $krypt);
                $insert_kask ->execute();

                //saadame tema sisse logida
                header("location: logiSisse.php");
                $yhendus->close();
                exit();
            }
            //kui vigad tagastame viga kirjega
            else{//notk parool
                header("location: registreerimine.php?norkParool");
            }
        }
        else{ //pole samad paroolid
            header("location: registreerimine.php?poleSamadParoolid");
        }
    }
    else{// ta on juba registreeritud
        header("location: registreerimine.php?onJubaRegistreeritud");
    }
}