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
		<form id="pforma" method="post">
			<button onclick="sakrij()">X</button>
			<input name="ime" type="text" placeholder="Ime proizvoda"/>
			<input name="cena" type="text" placeholder="Cena"/>
			<textarea name="opis" placeholder="Opis" rows="4" cols="22"></textarea>
			<input name="image" type="text" placeholder="Slika"/>
			<button name="dodaj" type="submit">Dodaj</button>
		</form>
		<div class="levo"></div>
		<?php
			for ($i=0; $i< count($imena); $i++) {
		?>
		<div class="card">
			<?php if($_SESSION['admin']) { ?>
			<form method="post">
				<button name="obrisi" type="submit">X</button>
				<input name="ime_2" type="text" value="<?php echo($imena[$i]) ?>"/>
			</form>
			<?php } ?>
			<p><?php echo("<img src='img/" . $slike[$i] . "'"); ?></p>
			<h1><?php echo($imena[$i]); ?></h1>
			<h2><?php echo($opisi[$i]); ?></h2>
			<h3><?php echo($cene[$i]); ?></h3>
			<?php if(isset($_SESSION['username'])) { ?> <a class="a" href="?add=<?php echo($i); ?>">Dodaj u korpu</a><?php } ?>
		</div>
		<?php
			}
		?>
		<?php if($_SESSION['admin']) { ?>
		<div id="card" class="card">
			<p onclick="Prikazi()">+</p>
		</div>
		<?php } ?>
    </body>
</html> 
<?php
	if (isset($_POST['dodaj']))
	{
		$ime = $_POST['ime'];
		$cena = $_POST['cena'];
		$opis = $_POST['opis'];
		$image = $_POST['image'];
		$query = "insert into proizvodi(ime, cena, opis, image) values('$ime', '$cena', '$opis', '$image')";
		mysqli_query($db, $query);
		header("location:proizvodi.php");
	}
	if (isset($_POST['obrisi']))
	{
		$ime_2 = $_POST['ime_2'];
		$query = "delete from proizvodi where ime = '$ime_2'";
		mysqli_query($db, $query);
		header("location:proizvodi.php");
	}
?>
<script>
function Prikazi() {
  document.getElementById("pforma").style.display = "block";
}
function Sakrij() {
  document.getElementById("pforma").style.display = "none";
}
</script>