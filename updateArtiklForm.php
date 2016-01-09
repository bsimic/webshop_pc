<?php
	session_start();

?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$idArtikl = $_GET['idArtikl'];
	$action = $_GET['action'];
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	$query = "SELECT * FROM artikl WHERE idArtikl='" .$idArtikl . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if(isset($action)){
		print("Zapis uspijesno azuriran");
	}
	else{
	
	if($row){
?>

		<form name="updateArtikl" action="updateArtikl.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
		<table border="0" id="tabela1">
		<input type="hidden" name="idArtikl" value='<?php print($row['idArtikl']); ?>'>
		<tr><td> 
			Naziv Artikla:
			</td><td>
			<input type="text" name="naziv" value='<?php print($row['naziv']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Ime proizvodaca:
			</td><td>
			<input type="text" name="proizvodac" value='<?php print($row['proizvodac']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Vrsta:
			</td><td>
			<input type="text" name="vrsta" value='<?php print($row['vrsta']); ?>' required>
			</td>
		</tr>
		<tr><td>
		<tr><td>
			Kolicina:
			</td><td>
			<input type="number" name="kolicina" value='<?php print($row['kolicina']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Cijena:
			</td><td>
			<input type="text" name="cijena" value='<?php print($row['cijena']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Slika:
			</td><td>
			<?php print("<img src=\"dohvatiSliku.php?id=" . $idArtikl . "\" height='100' width='75'>"); ?>
			</td>
		</tr>
		<tr><td>
			Slika(nova):
			</td><td>
			<input type="file" name="slika">
			</td>
		</tr>

		<tr><td> <input type="submit" class="button" name="submit" value="Potvrdi"> </td> </tr>
		<tr><td colspan="2"> <?php 	if(isset($error) && $error=="naziv") print("<font color='red'>Artikl s tim imenom vec postoji. Upisite ponovno</font>");
									else if (isset($error) && $error=="baza") print("<font color='red'>Greska pri zapisu u bazu. Molimo pokusajte ponovno!</font>");
									else if(isset($error) && $error=="false") print("Unos artikla uspjesan"); ?> </td></tr>
</table>
</form>

<?php }
}
?>
