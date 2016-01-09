<?php
	session_start();
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

	$ids = $_GET['ids'];
	$kolicina = $_GET['kolicina'];
	$user = $_SESSION['login_user'];
	
	$id = explode("," ,$ids);
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $user . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	mysql_free_result($result);

	
	for($i=0; $i<count($id); $i++){
		$query = "INSERT INTO kupio(idKorisnik, idArtikl) VALUES ('" . $idKorisnik . "','" .$id[$i] . "')";
		$result = mysql_query($query);
		
		$query = "SELECT kolicina FROM artikl WHERE idArtikl='" . $id[$i] . "'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_NUM);
		
		$novaKolicina = $row[0] - $kolicina[$i];
		
		$query = "UPDATE artikl SET kolicina='" . $novaKolicina . "' WHERE idArtikl='" . $id[$i] . "'";
		$result = mysql_query($query);
	}
	
	
	mysql_close();
	
	unset($_SESSION['cart_items']);
	header("Location: index.php");
	
	
	
?>