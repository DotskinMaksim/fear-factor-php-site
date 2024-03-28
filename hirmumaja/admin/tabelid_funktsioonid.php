<?php
require_once('../konf.php');
require_once('../funktsioonid.php');


function kasutajad()
{
    global $yhendus;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['kasutajaId']) && isset($_POST['adminStatus'])) {
            $kasutajaId = $_POST['kasutajaId'];
            $adminStatus = $_POST['adminStatus'];

            $update_kask = $yhendus->prepare("UPDATE kasutaja SET onAdmin=? WHERE id=?");
            $update_kask->bind_param("ii", $adminStatus, $kasutajaId);
            $update_kask->execute();
            $update_kask->close();
        }
    }

    $select_kask = $yhendus->prepare("SELECT id, login, parool, onAdmin FROM kasutaja");
    $select_kask->execute();
    $select_kask->bind_result($id, $login, $parool, $onAdmin);

    while ($select_kask->fetch()) {
        echo "<tr>
                <td>$id</td>
                <td>$login</td>
                <td>$parool</td>
                <td>
                    <form method='POST'>
                        <input type='hidden' name='kasutajaId' value='$id'>
                        <select name='adminStatus' onchange='this.form.submit()'>
                            <option value='1' ".($onAdmin == 1 ? "selected" : "") .">Jah</option>
                            <option value='0' ". ($onAdmin == 0 ? "selected" : ""). ">Ei</option>
                        </select>
                    </form>
                </td>
                <td>
                    <a href='tabelid.php?kustutaKasutaja=$id'><span style=\"color: red;\">Kustuta</span></a>
                </td>
              </tr>";
    }
    $select_kask->close();
}
function kustutaKasutaja($kasutajaId)
{
    global $yhendus;

    $delete_kask = $yhendus->prepare("DELETE FROM pilet WHERE kasutajaId=?");
    $delete_kask->bind_param("i", $kasutajaId);
    $delete_kask->execute();
    $delete_kask->close();

    $delete_kask2 = $yhendus->prepare("DELETE FROM hirmumaja WHERE kasutajaId=?");
    $delete_kask2->bind_param("i", $kasutajaId);
    $delete_kask2->execute();
    $delete_kask2->close();

    $delete_kask3 = $yhendus->prepare("DELETE FROM makseviis WHERE kasutajaId=?");
    $delete_kask3->bind_param("i", $kasutajaId);
    $delete_kask3->execute();
    $delete_kask3->close();


    $delete_kask4 = $yhendus->prepare("DELETE FROM kasutaja WHERE id=?");
    $delete_kask4->bind_param("i", $kasutajaId);
    $delete_kask4->execute();
    $delete_kask4->close();



    header("location: tabelid.php?kasutajad");
    exit();
}

function piletid()
{
    global $yhendus;


    $select_kask = $yhendus->prepare("SELECT id, kasutajaId, nimi, ostupaev,kehtivKuni,typp FROM pilet");
    $select_kask->execute();
    $select_kask->bind_result($id, $kasutajaId, $nimi,$ostupaev, $kehtivKuni, $typp);

    while ($select_kask->fetch()) {
        echo "<tr>
                <td>$id</td>
                <td>$kasutajaId</td>
                <td>$nimi</td>
                <td>$ostupaev</td>
                <td>$kehtivKuni</td>
                <td>$typp</td>
                <td>
                    <a href='tabelid.php?kustutaPilet=$id'><span style=\"color: red;\">Kustuta</span></a>
                </td>
              </tr>";
    }
    $select_kask->close();
}
function kustutaPilet($piletId)
{
    global $yhendus;

    $delete_kask = $yhendus->prepare("DELETE FROM pilet WHERE id=?");
    $delete_kask->bind_param("i", $piletId);
    $delete_kask->execute();
    $delete_kask->close();


    header("location: tabelid.php?piletid");
    exit();
}
function hirmumaja()
{
    global $yhendus;


    $select_kask = $yhendus->prepare("SELECT id, kasutajaId, sisenes, lahkus FROM hirmumaja");
    $select_kask->execute();
    $select_kask->bind_result($id, $kasutajaId, $sisenes,$lahkus);

    while ($select_kask->fetch()) {
        echo "<tr>
                <td>$id</td>
                <td>$kasutajaId</td>
                <td>$sisenes</td>
                <td>$lahkus</td>
                <td>
                    <a href='tabelid.php?kustutaHirmumaja=$id'><span style=\"color: red;\">Kustuta</span></a>
                </td>
              </tr>";
    }
    $select_kask->close();
}
function kustutaHirmumaja($hirmId)
{
    global $yhendus;

    $delete_kask = $yhendus->prepare("DELETE FROM hirmumaja WHERE id=?");
    $delete_kask->bind_param("i", $hirmId);
    $delete_kask->execute();
    $delete_kask->close();


    header("location: tabelid.php?hirmumaja");
    exit();
}