<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
 
$idArtikl = $_GET['idArtikl'];
$naziv =  $_GET['naziv'];
$kolicina = $_GET['kolicina'];

/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
 
if($kolicina == ""){
	header('Location: artikl.php?action=kolicina&idArtikl=' . $idArtikl . '&naziv=' . $naziv);
}

else{
	if(!isset($_SESSION['cart_items'])){
		$_SESSION['cart_items'] = array();
	}
	 
	// check if the item is in the array, if it is, do not add
	if(array_key_exists($idArtikl, $_SESSION['cart_items'])){
		// redirect to product list and tell the user it was added to cart
		header('Location: artikl.php?action=exists&idArtikl=' . $idArtikl . '&naziv=' . $naziv);
	}
	 
	// else, add the item to the array
	else{
		$_SESSION['cart_items'][$idArtikl]=$kolicina;
		
		
	 
		// redirect to product list and tell the user it was added to cart
		header('Location: artikl.php?action=added&idArtikl=' . $idArtikl . '&naziv=' . $naziv);
	}
	}
?>

