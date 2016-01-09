
<?php
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	$query = "SELECT k.idArtikl, k.naziv, ROUND(AVG(o.ocjena),2) AS srednja_ocjena
			FROM artikl k
			INNER JOIN ocjena o
  			ON k.idArtikl = o.idArtikl
			GROUP BY o.idArtikl
			ORDER BY srednja_ocjena DESC
			LIMIT 5";
	$result = mysql_query($query);

	print("<table id='tabela' border='1'  style=\"border-color : #333333; font-size:20px;\">");
	print("<tr><th> Artikl </th><th> Ocjena </th></tr>");

	while($row = mysql_fetch_array($result, MYSQL_BOTH)){
			
		print("<tr>
		<td id='tdSlika' align='center'>");
		print("<img src=\"dohvatiSliku.php?id=" . $row["idArtikl"] . "\" height='100' width='100'></td>;
		<td>" . $row["naziv"] . "</td><td>"  . $row["srednja_ocjena"]."</td></tr>");

	}
	print("</table>");
	mysql_close();
?>

