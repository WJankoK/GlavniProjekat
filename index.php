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
        <div class="kontakt">
            <table>
                <tr>
                    <td><img src="img/location.png"/></td>
                    <td><p>Bulevar Zorana Đinđića 137</p></td>
                </tr>
                <tr>
                    <td><img src="img/telephone.png"/></td>
                    <td><p>0695380027<br>(011)2133716</p></td>
                </tr>
                <tr>
                    <td><img src="img/mail.png"/></td>
                    <td><p>jankoveknjige@business.com</p></td>
                </tr>
            </table>
            <hr color=black>
            <a href="http://www.facebook.com" target="_blank"><img src="img/facebook.png"/></a>
            <a href="http://www.instagram.com" target="_blank"><img src="img/instagram.png"/></a>
            <a href="http://www.twitter.com" target="_blank"><img src="img/twitter.png"/></a>
            <a href="http://rs.linkedin.com" target="_blank"><img src="img/linkedin.png"/></a>
        </div>
        <div class="ss">
            <img id="ssimg" src="img/instagram.png"/>
            <a onclick="Prev()">&#10094;</a>
            <a onclick="Next()">&#10095;</a>
        </div>
        <div class="noviproizvodi">
            <h1>najnoviji proizvodi</h1>
            <?php for ($i = count($imena) - 1; $i >= count($imena) - 3; $i--) { ?>
		    <div class="newcard">		    
			    <p><?php echo("<img src='img/" . $slike[$i] . "'"); ?></p>
			    <h2><?php echo($imena[$i]); ?></h2>
		    </div>
		    <?php } ?>
        </div>
    </body>
    <script>
        const BrojSlika = 3;
        var x = 1;
        SlideShow();
        function SlideShow() {
            document.getElementById("ssimg").src = "img/ss" + x + ".jpg";
            x++;
            
            if (x > BrojSlika) { x = 1; }
            setTimeout(SlideShow, 10000);
        }
        function Next() {
            if (x == BrojSlika) { x = 1; }
            else { x++; }
            document.getElementById("ssimg").src = "img/ss" + x + ".jpg";
        }
        function Prev() {
            if (x == 1) { x = BrojSlika; }
            else { x--; }
            document.getElementById("ssimg").src = "img/ss" + x + ".jpg";
        }
    </script>
</html>