<?php 
	require_once("server.php");
	require_once("korpa.php");
    if (isset($_SESSION['username']))
        include('navbar_li.php');
    else
        include('navbar_lo.php');
?>
<HTML>
<HEAD>
<TITLE>Jankove Knjige</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>
	<BODY>
		<form class="korpa" method="post" action="naruci.php">
			<h1>Porudžbina</h1>
			<hr>
			<br>
			<table>
				<tr>
					<td><b>Ime</b></td>
					<td><b>Količina</b></td>
					<td><b>Cena</b></td>
					<td><b>Ukupna cena</b></td>
					<td></td>
				</tr>
				<?php
 					if ( isset($_SESSION["cart"]) ) {
 				?>
				<?php
					$total = 0;
					foreach ($_SESSION["cart"] as $i) {
				?>
				<tr>
					<td><?php echo( $imena[$_SESSION["cart"][$i]] ); ?></td>
					<td><?php echo( $_SESSION["qty"][$i] ); ?></td>
					<td><?php echo( $cene[$i] ); ?></td>
					<td><?php echo( $_SESSION["amounts"][$i] ); ?></td>
					<td><a href="?delete=<?php echo($i); ?>">Obriši iz korpe</a></td>
				</tr>
				<?php
					$total = $total + $_SESSION["amounts"][$i];
					}
					$_SESSION["total"] = $total;
				?>
				<?php
 					}
 				?>
			</table>
			<br>
			<hr>
			<?php
				if (isset($_SESSION["cart"]))
				{
			?>
			<h1><?php echo( "Sve ukupno: " . $total ); ?></h1>
			<a href="?reset=true">Isprazni korpu</a>
			<br><br>
			<button type="submit">Kupi</button>
			<?php
				}
			?>
			<br><br><br>
		</form>
	</BODY>
</HTML>