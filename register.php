<?php 
    include('server.php'); 
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
        <form class="forma" id="registerbox" method="post" action="register.php">
            <h1>Register</h1>
            <?php include('errors.php'); ?>
            <div class="input-group">
                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="Ime">
            </div>
            <div class="input-group">
                <input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email">
            </div>
            <div class="input-group">
                <input type="password" name="password_1" placeholder="Šifra">
            </div>
            <div class="input-group">
                <input type="password" name="password_2" placeholder="Potvrdi šifru">
            </div>
            <div class="input-group">
                <button type="submit" name="register" class="btn">Register</button>
            </div>
            <p class="p">
                <a href="login.php">Već imam nalog</a>
            </p>
        </form>
    </body>
</html>