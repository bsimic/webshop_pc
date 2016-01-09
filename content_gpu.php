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
		
		$query = "SELECT * FROM artikl WHERE vrsta='GPU'";
		$result = mysql_query($query);
	}
		
		//preskakanje artikala koje netreba prikazati
	for ($i=0; $i< ($brojStranice-1)*20; $i++)
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	print("<center>");
	print("<table id='tablica' border='1'>");
	for($i=($brojStranice-1)*20; $i<$brojStranice*20; $i++){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$idArtikl = $row['idArtikl'];
			
			print("<tr>");
			print("<tr>");
			print("<td id='tdSlika' align='center'>");
			print("<a href='artikl.php?idArtikl=" . $idArtikl . "'><img src=\"dohvatiSliku.php?id=" . $row["idArtikl"] . "\" height='200' width='300'></a></td>");
			print("</td>");
			print("<td width='350' align='center'><b>" . $row["naziv"] . "<b/></td>");
			print("<td width='200' align='center'> <i>" . $row["proizvodac"] . "<i/></td>");
			print("<td width='150' align='right'><u>" . $row["cijena"] . "<u/></td>");	
			
			
		}
	}
	// Prikaz stranicnih linkova:
	print("<tr><td colspan='4' align='center'><i> Page: </i>&nbsp; &nbsp;");
	for($i=1; $i<= ceil($ukupanBrojArtikala/20); $i++){
		if ($i != $brojStranice){
			print("<a href=\"index.php?stranica=" . $i . "\">" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print($i . "&nbsp; &nbsp;");
		}
	}
	
	print("</table>");
	print("</center>");
?>