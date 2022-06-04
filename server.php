<?php
    session_start();
    $username = "";
    $email = "";
    $errors = array();

    if (!isset($_SESSION['admin']))
        $_SESSION['admin'] = 0;

    $db = mysqli_connect('localhost', 'root', '', 'projekat');

    if (isset($_POST['register'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
        $usql = "select * from korisnici where username = '$username'";
        $uresult = mysqli_query($db, $usql);
        $esql = "select * from korisnici where email = '$email'";
        $eresult = mysqli_query($db, $esql);
        $unum = mysqli_num_rows($uresult);
        $enum = mysqli_num_rows($eresult);

        if (empty($username)) {
            array_push($errors, "Ime ne sme da bude prazno");
        }
        else {
            if (strlen($username) < 5) {
                array_push($errors, "Ime ne sme da bude kraće od 5 karaktera");
            }
            if (strlen($username) > 20) {
                array_push($errors, "Ime ne sme da bude duže od 20 karaktera");
            }
        }
        if (empty($email)) {
            array_push($errors, "Email ne sme da bude prazan");
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email nije tačan");
        }
        if (empty($password_1)) {
            array_push($errors, "Sifra ne sme da bude prazna");
        }
        else {
            if (strlen($password_1) < 5) {
                array_push($errors, "Šifra ne sme da bude kraća od 5 karaktera");
            }
            if (strlen($password_1) > 25) {
                array_push($errors, "Šifra ne sme da bude duža od 20 karaktera");
            }
        }
        if ($password_1 != $password_2) {
            array_push($errors, "Šifre se ne podudaraju");
        }
        if ($unum != 0) {
            array_push($errors, "Korisničko ime je zauzeto");
        }
        if ($enum != 0) {
            array_push($errors, "Email je zauzet");
        }

        if (count($errors) == 0) {
            $password = md5($password_1);
            $sql = "INSERT INTO korisnici (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($db, $sql);
            $_SESSION['username'] = $username;
            header("location: index.php");
        }
    }

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (empty($username)) {
            array_push($errors, "Ime ne sme da bude prazno");
        }
        if (empty($password)) {
            array_push($errors, "Šifra ne sme da bude prazna");
        }
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM korisnici WHERE username='$username' AND password='$password'";
            $result = mysqli_query($db, $query);
            $row=mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['admin'] = 0;
                if ($row['admin']) { $_SESSION['admin'] = $username; }
                header("location: index.php");
            } else {
                array_push($errors, "Ne postoji korisnik sa takvom kombinacijom");
            }
        }
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        $_SESSION['admin'] = 0;
        header('location: login.php');
    }
?>