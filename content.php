<link rel="stylesheet" type="text/css" href="style.css">
<?php
error_reporting(E_ALL ^ E_NOTICE);
	$brojStranice = $_GET['stranica'];
	if(!isset($brojStranice))	$brojStranice = 1;
	
	$search = $_GET['search'];
@mysql_connect("localhost", "root", "vertrigo");
@mysql_select_db("web_shop");

	if(isset($search)){
		$query = "SELECT COUNT(*) FROM artikl WHERE naziv LIKE '%" . $search . "%'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_NUM);
		$ukupanBrojArtikala = $row[0];
		mysql_free_result($result);
		
		$query = "SELECT * FROM artikl WHERE naziv LIKE '%" . $search . "%'";
		$result = mysql_query($query);
	}
	else{
	$query = "SELECT COUNT(*) FROM artikl";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_NUM);
		$ukupanBrojArtikala = $row[0];
		mysql_free_result($result);
		
		$query = "SELECT * FROM artikl GROUP BY naziv";
		$result = mysql_query($query);
	}
		
		//preskakanje artikala koje netreba prikazati
	for ($i=0; $i< ($brojStranice-1)*10; $i++)
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	print("<center>");
	print("<table id='tablica' border='1'>");
	for($i=($brojStranice-1)*10; $i<$brojStranice*10; $i++){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$idArtikl = $row['idArtikl'];
			
			$ocjenaQuery = "SELECT ROUND( avg(ocjena), 2) FROM korisnik JOIN ocjena JOIN artikl WHERE ocjena.idArtikl='" . $idArtikl ."'";
			$ocjenaResult = mysql_query($ocjenaQuery);
			$ocjenaRow = mysql_fetch_array($ocjenaResult, MYSQL_NUM);
			
		
			print("<tr border='0'>");
			print("<td id='tdSlika' rowspan='4' width='300' align='center'>");
			print("<a href='artikl.php?idArtikl=" . $idArtikl . "'><img src=\"dohvatiSliku.php?id=" . $row["idArtikl"] . "\" height='200' width='300'></a></td>");
			print("</td>");
			print("<td width ='350'><b>Naziv: <a href='artikl.php?idArtikl=" .$idArtikl . "'>" . $row[naziv] . "</a><b/></td></tr>");
			print("<tr><td width ='350'> <b>Proizvodac: </b><i>"  . $row["proizvodac"] . "<i/></td></tr>");
			print("<tr><td width ='350'><b>Cijena:</b><u>" . $row["cijena"] . "<u/></td></tr>");
			print("<tr><td width ='350'><b>Ocjena korisnika:</b>". $ocjenaRow[0] ."</td></tr>");
			
			
		}
	}
	// Prikaz stranicnih linkova:
	print("<tr><td colspan='4' align='center'><i> Page: </i>&nbsp; &nbsp;");
	for($i=1; $i<= ceil($ukupanBrojArtikala/10); $i++){
		if ($i != $brojStranice){
			print("<a href=\"index.php?stranica=" . $i . "\">" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print($i . "&nbsp; &nbsp;");
		}
	}
	
	print("</table>");
	print("</center>");
?>