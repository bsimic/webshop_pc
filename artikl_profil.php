<link rel="stylesheet" type="text/css" href="style.css">
<div id="content">

<?php

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
	error_reporting(E_ALL ^ E_NOTICE);
	

	
	$action = $_GET['action'];
	$idArtikl = $_GET['idArtikl'];
	$username = $_SESSION['login_user'];
	$error = $_GET['error'];
	
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	//provjera da li je korisnik vec ocjenio artikl
	$query = "SELECT ocjena FROM ocjena WHERE idKorisnik='" . $idKorisnik . "' AND idArtikl='" . $idArtikl . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	if($row[0] != NULL) $ocjenjeno = true;
	$ocjenaKorisnika = $row[0];
	
	
	
	
	
	$query = "SELECT * FROM artikl WHERE idArtikl = '" . $idArtikl . "'";
	$result = mysql_query($query);
	
	
	print("<table id='tablica' border='5' style=\"border-color : black; font-size:20px;\"");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if($row){
			$naziv = $row["naziv"];
			$kolicina = $row['kolicina'];
			$ocjenaQuery = "SELECT ROUND (avg(ocjena), 1) FROM korisnik JOIN ocjena JOIN artikl WHERE ocjena.idArtikl='" . $idArtikl ."'";
			$ocjenaResult = mysql_query($ocjenaQuery);
			$ocjenaRow = mysql_fetch_array($ocjenaResult, MYSQL_NUM);
		
			print("<tr>");
			print("<td id='tdSlika' align='center'>");
			print("<img src=\"dohvatiSliku.php?id=" . $row["idArtikl"] . "\" height='200' width='200'></td></tr>");
			print("<tr><td width ='600'><b>Naziv: " . $row["naziv"] . "<b/></td></tr>");
			print("<tr><td width ='600'> <i>Proizvodac: " . $row["proizvodac"] . "<i/></td></tr>");
			print("<tr><td width ='600'> Vrsta: " . $row["vrsta"] . "</td></tr>");
			print("<tr><td width ='600'><u>Cijena: " . $row["cijena"] . "<u/></td></tr>");
			print("<tr><td width ='600'>Prosjecna ocjena: ". $ocjenaRow[0] ."</td></tr>");
			if(isset($_SESSION['login_user'])){
				print("<tr><td width ='600' height='20' colspan='2'> ");
				if($ocjenjeno == true)	print ("<center>Vaša Ocjena: " . $ocjenaKorisnika . "</center>");
				else{
					print("<div id='ocjenaRadio' >
					<form name='ocjena' method='GET' action=ocijeni.php>
						<ul align = 'center'>Ocijenite artikl:<br>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='1'><span><b> 1</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='2'><span><b> 2</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='3'><span><b> 3</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='4'><span><b> 4</b> </span></li>
						<li style='display:inline' ><input type='radio' name='ocjenaRadio' value='5'><span><b> 5</b> </span></li>
						<input type='hidden' name='idArtikl' value='" . $idArtikl . "'/>
						&nbsp&nbsp&nbsp<input type='submit' value='Rate' class='button'>");
						if(isset($error) && $error=="true") print("<font color='red'>Greška. Molimo pokušajte ponovno!</font>");
						print("</li>
						</ul>
					</form>
					</div>");	
					}
				print("</td></tr>");
				
			print("<tr><td height='20' colspan='2' align='right'>
					<form name='kosarica' action='dodajUKosaricu.php' method='GET'>
						<input type='hidden' name='idArtikl' value='" . $idArtikl . "' />
						<input type='hidden' name='naziv' value='" . $naziv . "' />
						Quantity: <input type='number' name='kolicina' size='1' min='0' max='" . $kolicina . "'>
						<input type='submit' value='Add to cart' class='button'>
						
						
						
					</form>
					</td></tr>");
					
			
			
			
			if($action=='added'){
				print( "<tr><td height='20' colspan='2' align='center'>" . $naziv . " je dodan u vašu košaricu! </td></tr>");
				}
			if($action=='exists'){
				print( "<tr><td height='20' colspan='2' align='center'>" . $naziv . " je već u vašoj košarici! </td></tr>");
				}
			if($action=='kolicina'){
				print( "<tr><td height='20' colspan='2' align='center'><font color='red'>Molimo unesite količinu! </font></td></tr>");
				}
			}
		}
		
		
	print("</table>");
	
?>



</div>