<header>
<a href="index.php"><img class="logo" src="img/logo.png" alt="logo"></a>
    <nav>
        <ul class="nav_links">
            <li><a href="index.php">Home</a></li>
            <li><a href="proizvodi.php">Proizvodi</a></li>
        </ul>
    </nav>
    <div>
        <table>
            <tr>
                <td><p><?php echo $_SESSION['username'];?></p></td>
                <td><a href="korpa_stranica.php"><img src="img/basket.png" style="width:30px;height:30px"/></a></td>
                <td><a class="log" href="index.php?logout='1'"><button>Log Out</button></a></td>
            </tr>
        </table>
    </div>
</header>