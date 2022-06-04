<?php
    require_once("server.php");
    $slike = array();
    $imena = array();
    $cene = array();
    $opisi = array();
    $sql = "select * from proizvodi";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($slike, $row["image"]);
        array_push($imena, $row["ime"]);
        array_push($cene, $row["cena"]);
        array_push($opisi, $row["opis"]);
    }
    if ( !isset($_SESSION["total"]) ) {
        $_SESSION["total"] = 0;
        for ($i=0; $i< count($imena); $i++) {
        $_SESSION["qty"][$i] = 0;
        $_SESSION["amounts"][$i] = 0;
        }
    }
    if ( isset($_GET['reset']) ) {
        if ($_GET["reset"] == 'true') {
          unset($_SESSION["qty"]);
          unset($_SESSION["amounts"]);
          unset($_SESSION["total"]); 
          unset($_SESSION["cart"]); 
        }
    }
    if ( isset($_GET["add"])) {
        $i = $_GET["add"];
        $qty = $_SESSION["qty"][$i] + 1;
        $_SESSION["amounts"][$i] = $cene[$i] * $qty;
        $_SESSION["cart"][$i] = $i;
        $_SESSION["qty"][$i] = $qty;
    }
    if ( isset($_GET["delete"]) )
    {
        $i = $_GET["delete"];
        $qty = $_SESSION["qty"][$i];
        $qty--;
        $_SESSION["qty"][$i] = $qty;
        if ($qty == 0) {
            $_SESSION["amounts"][$i] = 0;
            unset($_SESSION["cart"][$i]);
        }
        else {
            $_SESSION["amounts"][$i] = $cene[$i] * $qty;
        }
    }
?>