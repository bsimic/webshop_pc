<?php
	session_start();
	
	$idArtikl = $_GET['idArtikl'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	$query = "DELETE FROM artikl WHERE idArtikl='" . $idArtikl . "'";
	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: confirmDelete.php?action='izbrisano'");
	} else {
		print("Greska!");
	}
	
?>