<?php
	session_start();
	$id = $_GET['idArtikl'];
	$proslaStranica = $_SERVER['HTTP_REFERER'];
	
	//izbrisi iz polja
	unset($_SESSION['cart_items'][$id]);
	
	if(preg_match('/\?/', $proslaStranica)){
		header("Location: " . $proslaStranica . "&a=kosarica");
	}
	else{
		header("Location: " . $proslaStranica . "?a=kosarica");
	}
?>