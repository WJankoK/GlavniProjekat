<?php 
    include('server.php');
    include('korpa.php');
    if (isset($_SESSION['username']))
        include('navbar_li.php');
    else
        include('navbar_lo.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Jankove Knjige</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <form class="forma" id="loginbox" method="post" action="login.php">
            <h1>Login</h1>
            <?php include('errors.php'); ?>
            <div class="input-group">
                <input type="text" name="username" placeholder="Ime">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Šifra">
            </div>
            <div class="input-group">
                <button type="submit" name="login" class="btn">Login</button>
            </div>
            <p class="p">
                <a href="register.php">Nemam nalog</a>
            </p>
        </form>
    </body>
</html>