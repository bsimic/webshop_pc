<link rel="stylesheet" type="text/css" href="style.css">

<?php
	error_reporting(E_ALL ^ E_NOTICE);
	$error = $_GET['error'];
?>

<form name="register" action="register.php" method="post" accept-charset="utf-8">
<table border="0" id="tabela">
<tr><td> 
	Username:
	</td><td>
	<input type="username" name="username" placeholder="Username:" required>
	</td>
</tr>
<tr><td>
	Password:
	</td><td>
	<input type="password" name="password" placeholder="Password:" required>
	</td>
</tr>
<tr><td>
<tr><td>
	Confirm password:
	</td><td>
	<input type="password" name="passwordConfirm" placeholder="Confirm password:" required>
	</td>
</tr>
<tr><td>
	E-mail:
	</td><td>
	<input type="text" name="email" placeholder="E-mail" required>
	</td>
</tr>
<tr><td>
	First name:
	</td><td>
	<input type="text" name="ime" placeholder="First name" required>
	</td>
</tr>
<tr><td>
	Last name:
	</td><td>
	<input type="text" name="prezime" placeholder="Last name" required>
	</td>
</tr>
<tr><td align="center" colspan="2"> <input type="submit" class="button" name="submit" value="Register!"> </td> </tr>
<tr><td colspan="2"> <?php 	if(isset($error) && $error=="user") print("<font color='red'>Korisnik s tim aliasom vec postoji. Molimo unesite drugi alias</font>");
							else if(isset($error) && $error=="password") print("<font color='red'>Error: Lozinke se ne podudaraju. Molimo pokusajte ponovno</font>"); 
							else if (isset($error) && $error=="mail") print("<font color='red'>Error: Mail nije valjan. Upisite valjani mail</font>");
							else if (isset($error) && $error=="baza") print("<font color='red'>Pogreska pri upisu u bazu. Molimo pokusajte ponovno</font>");
							else if(isset($error) && $error=="false") print("Registracija uspjesna!"); ?> </td></tr>
</table>
</form>