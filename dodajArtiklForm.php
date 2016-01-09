<?php
	session_start();
?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$error = $_GET['error'];
?>

<form name="dodajArtikl" action="dodajArtikl.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
<table border="0" id="tabela1">
<tr><td> 
	Naziv:
	</td><td>
	<input type="text" name="naziv" placeholder="Naziv" required>
	</td>
</tr>
<tr><td>
	Ime proizvodaca:
	</td><td>
	<input type="text" name="proizvodac" placeholder="Ime proizvodaca" required>
	</td>
</tr>
<tr><td>
	Vrsta:
	</td><td>
	<input type="text" name="vrsta" placeholder="Vrsta" required>
	</td>
</tr>
<tr><td>
<tr><td>
	Kolicina:
	</td><td>
	<input type="number" name="kolicina" placeholder="Kolicina" required>
	</td>
</tr>
<tr><td>
	Cijena:
	</td><td>
	<input type="text" name="cijena" placeholder="Cijena" required>
	</td>
</tr>

<tr><td>
	Slika:
	</td><td>
	<input type="file" name="slika" required>
	</td>
</tr>

<tr><td> <input type="submit" class="button" name="submit" value="Potvrdi"> </td> </tr>
<tr><td colspan="2"> <?php 	if(isset($error) && $error=="naziv") print("<font color='red'>Artikl s tim imenom vec postoji. Upisite ponovno</font>");
							else if (isset($error) && $error=="baza") print("<font color='red'>Pogreška pri upisu u bazu. Molimo pokušajte ponovno</font>");
							else if(isset($error) && $error=="false") print("Unos artikla uspjesan"); ?> </td></tr>
</table>
</form>
