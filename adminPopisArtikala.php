<?php
	session_start();
?>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
	function popitupConfirm(url) {
	newwindow=window.open(url,'name','height=200,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
	}	

</script>
</head>
<div id="content">
	
<?php
	error_reporting(E_ALL ^ E_NOTICE);

	$brojStranice = $_GET['stranica'];
	if(!isset($brojStranice))	$brojStranice = 1;
	
	
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	
	$query = "SELECT COUNT(*) FROM artikl";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$ukupanBrojArtikala = $row[0];
	mysql_free_result($result);
	
	

	$query = "SELECT * FROM artikl GROUP BY naziv";
	$result = mysql_query($query);
	
	
	
	for ($i=0; $i< ($brojStranice-1)*25; $i++)
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
	
	
	print("<table  border='5' style=\"border-color : black; font-family: Times New Roman; font-size:15px;\"");
	print("<tr><td width ='300'><b>Naslov: <b/></td>
			<td width ='300'><b>Proizvodac: <b/></td>
			<td width ='300'><b>Vrsta: <b/></td>
			<td width ='100'><b>Kolicina: <b/></td></tr>");
	for($i=($brojStranice-1)*25; $i<$brojStranice*25; $i++){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$idArtikl = $row['idArtikl'];
				
			print("<tr>");
			print("<td width ='300'><b>" . $row["naziv"] . "<b/></td>");
			print("<td width ='300'> <i>" . $row["proizvodac"] . "<i/></td>");
			print("<td width ='300'>" . $row["vrsta"] . "</td>");
			print("<td width ='100'>" . $row["kolicina"] . "</td>");
			print("<td><input type='button' class='Abutton' onClick=\"javascript:popitup('updateArtiklForm.php?idArtikl=" . $idArtikl . "')\" value='Uredi' ></td>");	
			print("<td><input type='button' class='Abutton' onClick=\"javascript:popitupConfirm('confirmDelete.php?idArtikl=" . $idArtikl . "&naziv=" . $row['naziv'] . "')\" value='Obrisi'></td></tr>");	
			
			
		}
	}
	
	
	// Prikaz stranicnih linkova:
	print("<tr><td colspan='7' align='center'><i> Page: </i>&nbsp; &nbsp;");
	for($i=1; $i<= ceil($ukupanBrojArtikala/25); $i++){
		if ($i != $brojStranice){
			print("<a href=\"adminPanel.php?stranica=" . $i . "\">" .$i . "</a>&nbsp; &nbsp;");
		} else {
			print($i . "&nbsp; &nbsp;");
		}
	}
	print("</table>");
	
?>



</div>