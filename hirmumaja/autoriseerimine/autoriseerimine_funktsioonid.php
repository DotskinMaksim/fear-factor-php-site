<?php
require_once ('../konf.php');
require_once ('../funktsioonid.php');


function parooliValideerimine($parool)
{
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
{
        $nimi = htmlspecialchars(trim($_POST['nimi']));
        $parool = htmlspecialchars(trim($_POST['parool']));

        $cool="superpaev";
        $krypt = crypt($parool, $cool);

        global $yhendus;

        $select_kask=$yhendus-> prepare("SELECT id, login, onAdmin FROM kasutaja WHERE login=? AND parool=?");
        $select_kask->bind_param("ss", $nimi, $krypt);
        $select_kask->bind_result($id,$kasutaja, $onAdmin);
        $select_kask->execute();

        if ($select_kask->fetch()) {
            $_SESSION['kasutajaNimi'] = $nimi;
            $_SESSION['kasutajaId'] = $id;
            $_SESSION['onAdmin'] = $onAdmin;
            header("location: ../index.php");

        }
        else{

            header("location: logiSisse.php?vale");

        }
        $yhendus->close();

}

function register()
{

            global $yhendus;
            $nimi = htmlspecialchars(trim($_POST['nimi']));
            $parool1 = htmlspecialchars(trim($_POST['parool1']));
            $parool2 = htmlspecialchars(trim($_POST['parool2']));

            $select_kask=$yhendus-> prepare("select id, login from kasutaja where login=?");
            $select_kask->bind_param("s", $nimi);
            $select_kask->bind_result($id,$user);
            $select_kask->execute();
            if (!$select_kask->fetch()) {
                if ($parool2 == $parool1) {
                    if (parooliValideerimine($parool1)) {

                        $cool = "superpaev";
                        $krypt = crypt($parool1, $cool);
                        $insert_kask = $yhendus->prepare("insert into kasutaja(login,parool,onAdmin) values(?,?,0)"); //lisane uue konto
                        $insert_kask ->bind_param("ss", $nimi, $krypt);
                        $insert_kask ->execute();

                        header("location: logiSisse.php");
                        $yhendus->close();
                        exit();
                    }
                    else{
                        header("location: registreerimine.php?norkParool");
                    }
                }
                else{
                    header("location: registreerimine.php?poleSamadParoolid");
                }
            }
            else{
                header("location: registreerimine.php?onJubaRegistreeritud");
            }
}
