<?php
	session_start();
	
	$idKorisnik = $_POST['idKorisnik'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$ime = $_POST['ime'];
	$prezime = $_POST['prezime'];
	
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	// UPDATE
		$query = "UPDATE korisnik SET
		          username='" . $username ."',
				  email='" . $email . "',
				  ime='" . $ime . "',
				  prezime='" . $prezime . "'
				  WHERE idKorisnik='" . $idKorisnik ."'";

	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: updateKorisnikForm.php?action='azurirano'");
	} else {
		print("Greska!");
	}
	
?>