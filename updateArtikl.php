<?php
	session_start();
	
	$idArtikl = $_POST['idArtikl'];
	$naziv = $_POST['naziv'];
	$proizvodac = $_POST['proizvodac'];
	$vrsta = $_POST['vrsta'];
	$kolicina = $_POST['kolicina'];
	$cijena = $_POST['cijena'];
	
	//ako je odabrana nova slika
	if ($_FILES['slika']['name']!=""){
		$BASEDIR = "images/";
		if (!file_exists($BASEDIR)) mkdir($BASEDIR, 755);

		$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
		$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);

		if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
			move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
		}
		$filename= $BASEDIR.$_FILES['slika']['name'];
		$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	}
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	// UPDATE bez slike
	
	if ($_FILES['slika']['name']==""){
		$query = "UPDATE artikl SET
		          naziv='" . $naziv ."',
				  proizvodac='" . $proizvodac . "',
				  vrsta='" . $vrsta . "',
				  kolicina='" . $kolicina . "',
				  cijena='" . $cijena . "'
				  WHERE idArtikl='" . $idArtikl ."'";

	} 
	// UPDATE sa slikom!
	else {
		$query = "UPDATE artikl SET
		          naziv='" . $naziv ."',
				  proizvodac='" . $proizvodac . "',
				  vrsta='" . $vrsta . "',
				  kolicina='" . $kolicina . "',
				  cijena='" . $cijena . "',
				  slika='" . $data . "' WHERE idArtikl='" . $idArtikl ."'";
	}
	
	$result = mysql_query($query);
	mysql_close();
	
	if($result){
		header("Location: updateArtiklForm.php?action='azurirano'");
	} else {
		print("Greska!");
	}
	
?>