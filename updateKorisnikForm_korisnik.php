<?php
	session_start();

?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$idKorisnik = $_GET['idKorisnik'];
	$action = $_GET['action'];
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	$query = "SELECT * FROM korisnik WHERE idKorisnik='" .$idKorisnik . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if(isset($action)){
		print("Zapis uspijesno azuriran");
	}
	else{
	
	if($row){
?>

		<form name="updateKorisnik" action="updateKorisnik.php" method="POST" enctype="multipart/form-data" accept-charset="utf-8">
	<table border="0" id="tabela">
		<input type="hidden" name="idKorisnik" value='<?php print($row['idKorisnik']); ?>'>
		
		<tr><td>
			E-mail:
			</td><td>
			<input type="text" name="email" value='<?php print($row['email']); ?>' required>
			</td>
		</tr>
		<tr><td>
		<tr><td>
			Ime:
			</td><td>
			<input type="text" name="ime" value='<?php print($row['ime']); ?>' required>
			</td>
		</tr>
		<tr><td>
			Prezime:
			</td><td>
			<input type="text" name="prezime" value='<?php print($row['prezime']); ?>' required>
			</td>
		</tr>
		

		<tr><td> <input type="submit" class="button" name="submit" value="Potvrdi"> </td> </tr>
		<tr><td colspan="2"> <?php 	if(isset($error) && $error=="username") print("<font color='red'>Korisnik s tim imenom vec postoji. Upisite ponovno</font>");
									else if (isset($error) && $error=="baza") print("<font color='red'>Pogreska pri upisu u bazu. Molimo pokusajte ponovno!</font>");
									else if(isset($error) && $error=="false") print("Unos korisnika uspjesan"); ?> </td></tr>
	</table>
</form>

<?php }
}
?>
