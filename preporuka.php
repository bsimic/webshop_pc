<?php
	session_start();
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	$username = $_SESSION['login_user'];
	
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	
	$preporuka = "SELECT DISTINCT naziv,proizvodac,vrsta,cijena,artikl.idArtikl FROM artikl JOIN kupio JOIN korisnik ON (artikl.idArtikl = kupio.idArtikl AND korisnik.idKorisnik = kupio.idKorisnik) WHERE username IN (SELECT username FROM artikl JOIN kupio JOIN korisnik ON (artikl.idArtikl = kupio.idArtikl AND korisnik.idKorisnik = kupio.idKorisnik) WHERE artikl.idArtikl IN ( SELECT idArtikl FROM kupio WHERE idKorisnik = '".$idKorisnik."') AND korisnik.idKorisnik != '".$idKorisnik."')";
	$preporuka_result = mysql_query($preporuka);
	if ($preporuka_result != NULL){
		print("<table id='contentTable' border='5' style=\"border-color: black; font-size:20px;\"");
		for($i=0; $i<3; $i++){
			$row = mysql_fetch_array($preporuka_result, MYSQL_ASSOC);
			if($row){
				$idArtikl = $row['idArtikl'];
				
				$ocjenaQuery = "SELECT ROUND( avg(ocjena), 2) FROM korisnik JOIN ocjena JOIN artikl WHERE ocjena.idArtikl='" . $idArtikl ."'";
				$ocjenaResult = mysql_query($ocjenaQuery);
				$ocjenaRow = mysql_fetch_array($ocjenaResult, MYSQL_NUM);
				
				print("<tr>");
				print("<td id='tdSlika' rowspan='5' width='300' align='center'>");
				print("<a href='artikl.php?idArtikl=" . $idArtikl . "'><img src=\"dohvatiSliku.php?id=" . $idArtikl . "\" height='200' width='300'></a></td>");
				print("</td>");
				print("<td width ='600'><b>" . $row["naziv"] . "<b/></td></tr>");
				print("<tr><td width ='600'> <i>" . $row["proizvodac"] . "<i/></td></tr>");
				print("<tr><td width ='600'>" . $row["vrsta"] . "</td></tr>");
				print("<tr><td width ='600'><u>" . $row["cijena"] . "<u/></td></tr>");
				print("<tr><td width ='600'><u>" . $ocjenaRow[0] . "<u/></td></tr>");
				print("<tr><td height='20' colspan='2'></td></tr>");		
			}
		}
	}

	
?>