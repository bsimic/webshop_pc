<?php
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
?>
<link rel="stylesheet" type="text/css" href="style.css">
<?php

	if(count($_SESSION['cart_items'])>0){
		
		// get the product ids
		foreach($_SESSION['cart_items'] as $id=>$value){
			$ids = $ids . $id . ",";
		}
		$ids = rtrim($ids, ',');
		$id = explode("," ,$ids);
		
		//$kolicina = array();
		$kolicina = implode("", $_SESSION['cart_items']);
		
		
		//spajanje na bazu
		@mysql_connect("localhost", "root", "vertrigo");
		@mysql_select_db("web_shop");
		
		
		$ukupnaCijena = 0;
		print("<center>");
		print("<div id='cart' width='auto' height='auto'>");
		print("<br><br><br><br><br><br>");
		print("<table id='tabela' border='1' style=\"border-color : white; ; font-size:20px;\">
				<tr><td align='center' width='450'><b>Artikli na vasoj listi: </b></td><td align='center'  width='250'><b>Cijena: </b></td><td align='center'  width='50'><b>Kolicina; </b></td></tr>");
		
		for($i=0; $i<count($_SESSION['cart_items']); $i++){
			$query = "SELECT idArtikl, naziv, cijena FROM artikl WHERE idArtikl='" . $id[$i] ."'";
			$result = mysql_query($query);
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			if($row){
				print( "<tr><td align='center'>" . $row["naziv"] . "</td>
							<td align='center'>" . $row["cijena"] . " </td>
							<td align='center'>" . $kolicina[$i] . " </td>
						<td align='right'><input type='button' class='button' value='Remove' onClick=\"location.href='izbrisiIzKosarice.php?idArtikl=" . $row['idArtikl'] ."'\"></td></tr>");
				$ukupnaCijena+=($row['cijena'] * $kolicina[$i]);
			}
		}

		print("<tr><td align='center'><b>Ukupna cijena: </b></td><td align='center' colspan='3'>" . $ukupnaCijena . "kn</td></tr>
				<tr><td colspan='4' align='right' ><input type='button' class='button' value='Checkout' onClick=\"location='checkout.php?ids=" . $ids . "&kolicina=" . $kolicina ."'\"></td></tr>
				<tr><td colspan='4' align='right' ><input type='button' class='button' value='Continue shoping' onClick=\"location='index.php'\"></td></tr>");
		
		
		print("</table>");
		print("</div>");
		print("</center>");
	
	}
	else{
		print("Nema artikala u vasoj kosarici!
				<tr><td><input type='button' class='button' value='Continue shoping' onClick=\"location='index.php'\">");
		
	}
?>