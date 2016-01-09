<?php
	session_start();
?>

<link rel="stylesheet" type="text/css" href="style.css">
<div id="content">

<head>


<?php

	error_reporting(E_ALL ^ E_NOTICE);
	
	$username = $_SESSION['login_user'];
	$error = $_GET['error'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	
	
	
	
	$query = "SELECT * FROM korisnik WHERE idKorisnik = '" . $idKorisnik . "'";
	$result = mysql_query($query);
	
	print("<table id='profileTable' border='5'>");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			
			
			
			print("<tr>");
			print("<td colspan='2' align='center'><b>Pozdrav <a style=' color:#330000;' href='profil.php'>" . $user_check ."</b></td></tr>");
			print("<tr><td  align='center'><b>Username: </td><td width ='400' align='center'>" . $row["username"] . "<b/></td></tr>");
			print("<tr><td  align='center'> <i>E-mail: </td><td width ='400' align='center'>" . $row["email"] . "<i/></td></tr>");
			print("<tr><td  align='center'> Ime: </td><td width ='400' align='center'>" . $row["ime"] . "</td></tr>");
			print("<tr><td  align='center'><b>Prezime: </td><td width ='400' align='center'>" . $row["prezime"] . "<b/></td></tr>");
			
			
			
			
			$queryKupnjaCount = "SELECT COUNT(*) FROM artikl JOIN kupio JOIN korisnik WHERE artikl.idArtikl=kupio.idArtikl AND kupio.idKorisnik=korisnik.idKorisnik AND korisnik.idKorisnik='" . $idKorisnik ."'";
			$resultKupnjaCount = mysql_query($queryKupnjaCount);
			$rowKupnjaCount = mysql_fetch_array($resultKupnjaCount, MYSQL_NUM);
			$ukupnoKupljenih = $rowKupnjaCount[0];
			
			$queryKupnja = "SELECT naziv FROM artikl JOIN kupio JOIN korisnik WHERE artikl.idArtikl=kupio.idArtikl AND kupio.idKorisnik=korisnik.idKorisnik AND korisnik.idKorisnik='" . $idKorisnik ."'";
			$resultKupnja = mysql_query($queryKupnja);
			
			print("<tr><td colspan='2'><b>Povijest kupnje: </b></td></tr>");
			for($i=0; $i<$ukupnoKupljenih; $i++){
				$rowKupnja = mysql_fetch_array($resultKupnja, MYSQL_ASSOC);
				if($rowKupnja){
					print("<tr><td colspan='2' align='center'>"  . $rowKupnja['naziv'] . "</td></tr>");
				}
			}
			
			print("</table>");
			
	
	
?>



</div>