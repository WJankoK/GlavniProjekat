<?php
    require_once("server.php");
    require_once("korpa.php");
    $idproizvoda = "";
    $idkorisnika = "";
    $kolicina = "";
    $datum = "";
    foreach ($_SESSION["cart"] as $i)
    {
        $idproizvoda .= $_SESSION['cart'][$i] . ",";
        $y = $_SESSION['username'];
        $query = "select id from korisnici where username='$y'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);
        $idkorisnika = $row['id'];
        $kolicina .= $_SESSION["qty"][$i] . ",";
        $datum = date("d-m-Y");
    }
    $sql = "insert into Narudzbine(id_proizvoda, kolicina, id_korisnika, datum) values ('$idproizvoda', '$kolicina', '$idkorisnika', '$datum')";
    mysqli_query($db, $sql);
    header("location: korpa_stranica.php?reset=true");
?>