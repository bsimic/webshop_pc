<?php
	session_start();
	
	//preuzimanje poslanih vrijednosti post metodom
	$naziv = $_POST['naziv'];
	$vrsta = $_POST['vrsta'];
	$proizvodac = $_POST['proizvodac'];
	$kolicina = $_POST['kolicina'];
	$cijena = $_POST['cijena'];
	
	$BASEDIR = "images/";
	if (!file_exists($BASEDIR)) mkdir($BASEDIR, 755);
	
	$_FILES['slika']['name'] = explode(' ', $_FILES['slika']['name']);
	$_FILES['slika']['name'] = implode('_', $_FILES['slika']['name']);
	
	if (!file_exists($BASEDIR.$_FILES['slika']['name'])) {
		move_uploaded_file($_FILES['slika']['tmp_name'], $BASEDIR.$_FILES['slika']['name']);
	}
	
	$filename= $BASEDIR.$_FILES['slika']['name'];
	
	$data = addslashes(fread(fopen($filename, "r"), filesize($filename)));
	
	
	//spajanje na bazu
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	//trazenje artikla sa tim imenom
	$query = "SELECT naziv FROM artikl WHERE naziv='" . $naziv . "'";
	$result = mysql_query($query);
	
	if(mysql_num_rows($result) > 0){
		mysql_close();
		header("Location:dodajArtiklForm.php?error=user");
	}
	else {
				
				$query = "INSERT INTO artikl (idArtikl, naziv, vrsta, kolicina, proizvodac, cijena, slika) VALUES 
							('null', '" . $naziv . "','" . $vrsta . "','" .  $kolicina . "','" . $proizvodac . "','" . $cijena . "','" . $data . "')";
				$result = mysql_query($query);
				if($result){
					//uspjesan upis
					mysql_close();
					header("Location: dodajArtiklForm.php?error=false");
				}
				else{
					//neuspjesan upis
					mysql_close();
					header("Location: dodajArtiklForm.php?error=baza");
				}
			}
		
	
?>