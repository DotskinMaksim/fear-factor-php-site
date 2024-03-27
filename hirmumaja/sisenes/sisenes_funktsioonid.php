<?php
require_once ('../konf.php');
require_once ('../funktsioonid.php');

function naidataInimesiSisenes()
{
    global $yhendus;

    $select_kask = $yhendus->prepare("SELECT hirmumaja.id, hirmumaja.kasutajaId, hirmumaja.sisenes, kasutaja.login
                                            FROM hirmumaja
                                            JOIN kasutaja ON hirmumaja.kasutajaId = kasutaja.id
                                            WHERE hirmumaja.lahkus IS NULL");
    $select_kask->execute();
    $select_kask->bind_result($id, $kasutajaId, $sisenes, $nimi);

    $inimesteArv = 0;
    while ($select_kask->fetch()) {

        $praeguneAeg = date("Y-m-d H:i:s");
        $aegSisenes = strtotime($praeguneAeg) - strtotime($sisenes);
        $aegSisenesTundites = gmdate("H", $aegSisenes);
        $aegSisenesMinutites = gmdate("i", $aegSisenes);
        $aegSisenesSekundites = gmdate("s", $aegSisenes);

        $inimesteArv++;
        echo "<tr><td>$nimi</td>
              <td>T: $aegSisenesTundites M: $aegSisenesMinutites S: $aegSisenesSekundites</td>";
        if (onAdmin()){
            echo "<td><a href='sisenes.php?lahkus=$id'><span style=\"color: red;\">Lahkus</span></a></td></tr>";}

    }

    $select_kask->close();
    echo "<tr><td>Kokku: $inimesteArv</td></tr>";
}

function lahkus()
{
    global $yhendus;

    $praeguneAeg = date("Y-m-d H:i:s");
    $id = $_REQUEST['lahkus']; // Retrieve the ID from request parameters

    $update_kask = $yhendus->prepare("UPDATE hirmumaja SET lahkus=? WHERE id=?");
    $update_kask->bind_param("si", $praeguneAeg, $id);
    $update_kask->execute();

    $update_kask->close();
}
function sisenes()
{
    global $yhendus;

    $praeguneAeg = date("Y-m-d H:i:s");

    $kasutajId = $_POST['kasutajaId'];
    $piletId = $_POST['piletId'];

    $select_kask = $yhendus->prepare("SELECT id, kasutajaId, kehtivKuni FROM pilet WHERE id=? AND kasutajaId=?");
    $select_kask->bind_param("ii", $piletId, $kasutajId);
    $select_kask->execute();
    $select_kask->store_result();

    // Проверка успешности выполнения запроса и получение данных
    if ($select_kask->num_rows > 0) {
        $select_kask->bind_result($id, $kasutajaId, $kehtivKuni);
        $select_kask->fetch();

        // Сравнение дат
        if ($kehtivKuni > $praeguneAeg) {
            $delete_kask = $yhendus->prepare("DELETE FROM pilet WHERE id=? AND kasutajaId=?");
            $delete_kask->bind_param("ii", $piletId, $kasutajId);
            $delete_kask->execute();

            if ($delete_kask->affected_rows > 0) {
                $insert_kask = $yhendus->prepare("INSERT INTO hirmumaja (sisenes, kasutajaId) VALUES (?, ?)");
                $insert_kask->bind_param("si", $praeguneAeg, $kasutajId);
                $insert_kask->execute();
                $insert_kask->close();
            }
            $delete_kask->close();
        } else {
            header("location: sisenes.php?piletAegunud");
            exit;
        }
    } else {
        header("location: sisenes.php?valePilet");
        exit;
    }

    $select_kask->close();
}



