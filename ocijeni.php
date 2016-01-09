<?php
	session_start();
	
	//error_reporting(E_ALL ^ E_NOTICE);
	
	$ocjena = $_GET['ocjenaRadio'];
	$idArtikl = $_GET['idArtikl'];
	$username = $_SESSION['login_user'];
	
	
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	//provjera da li je korisnik komentirao artikl
	$query = "SELECT * FROM ocjena WHERE idKorisnik='" . $idKorisnik . "' AND idArtikl='" . $idArtikl . "'";
	$result = mysql_query($query);
	//ako je
	if(mysql_num_rows($result) > 0){
		//update zapisa
		$query = "UPDATE ocjena SET ocjena='" . $ocjena . "' WHERE idKorisnik='" . $idKorisnik . "' AND idArtikl='" . $idArtikl . "'";
		$result = mysql_query($query);
		if($result){
			//uspjesan upis
			mysql_close();
			header("Location: artikl.php?idArtikl=" . $idArtikl . "");
			}
		else{
			mysql_close();
			header("Location: artikl.php?error=true&idArtikl=" . $idArtikl . "");
		}
	}
	else{
		$query = "INSERT INTO ocjena(idKorisnik, idArtikl, ocjena) VALUES
					('" . $idKorisnik . "','" . $idArtikl . "','" .  $ocjena . "')";
		$result = mysql_query($query);
		
		
		if($result){
			//uspjesan upis
			mysql_close();
			header("Location: artikl.php?idArtikl=" . $idArtikl . "");
			}
		else{
			mysql_close();
			header("Location: artikl.php?error=true&idArtikl=" . $idArtikl . "");
	}
	}
	
	
	
	
?>