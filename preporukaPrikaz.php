<?php
	session_start();// Starting Session
	error_reporting(E_ALL ^ E_NOTICE);
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	@mysql_connect("localhost", "root", "vertrigo");
	@mysql_select_db("web_shop");
	
	$username = $_SESSION['login_user'];
	
	//uzimanje id korisnika iz baze
	$query = "SELECT idKorisnik FROM korisnik WHERE username='" . $username . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result, MYSQL_NUM);
	$idKorisnik = $row[0];
	
	// Storing Session
	if(isset($_SESSION['login_user'])){
		$user_check=$_SESSION['login_user'];
	}
	
?>
<html>

<head>
	<title>Webshop</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	
<script type="text/javascript">


	function popitup(url) {
	newwindow=window.open(url,'name','height=500,width=500');
	if (window.focus) {newwindow.focus()}
	return false;
	}	



    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
    }

</script>
</head>

<?php
	
	$error = $_GET['error'];
	$akcija = $_GET['a'];
?>

</head>

<body>
<center>
				<?php if($akcija=='kosarica'){ ?>
					<div id="cartB" class="pposition" style="display:block;">
						<div id="pwrapper">
							<div id="pcontainer">
				<?php include("kosarica.php"); ?>
							<a href="javascript:void(0)" onClick="toggle_visibility('cartB');">
								<input type= "button" class="button"  value="Back">
							</a>
							</div>
						</div>
					</div>
				
				<?php }
				else{
				?>
					<div id="cartB" class="pposition" style="display:none;">
						<div id="pwrapper">
							<div id="pcontainer">
					<?php include("kosarica.php"); ?>
							<a href="javascript:void(0)" onClick="toggle_visibility('cartB');">
								<input type= "button" class="button"  value="Back">
							</a>
							</div>
						</div>
					</div>
				<?php }
				?>
				<div id="topRated" class="pposition" style="display:none;">
					<div id="pwrapper">
						<div id="pcontainer">
				<?php include("best_rate.php"); ?>
						<a href="javascript:void(0)" onClick="toggle_visibility('topRated');">
							<input type= "button" class="button"  value="Back">
						</a>
						</div>
					</div>
				</div>
				<!--popups-->
	<?php 
		if(!isset($_SESSION['login_user'])){
	?>
			<div id="top">
				<ul>
				<li>
				<div id="loginForm">
		<?php include("loginForm.php"); 
				if(isset($error) && $error=="login") { 
					print("<font color='red'>Error: Invalid login. Try again</font>"); 
				}
				if(isset($error) && $error=="nevazece") { 
					print("<font color='red'>Error: Please log-in.</font>"); 
				}
		?>
				</div>
				</li>
				</ul>
			
	<?php 
		}
		else
		{
	?>
	
	<div id="loggedin">
			<b id="welcome">Dobrodosao : <i><?php print("<a style=' color:white;' href='profil.php'>" . $user_check . "</a>"); ?></i></b>
			<input type= "button"  class="button" onClick="toggle_visibility('cartB');" value="Cart!">
			<input type='button' class='button' onClick=location.href='logout.php' value='Log Out'>
			
	</div>
	<?php
		}
	?>

<header id="header">
	
</header>

<div id='cssmenu'>

	<ul>
   <li style='margin-left: 30%'><a href='index.php'>Home</a></li>
   <li><a href='#'>Search</a>
		<ul>
			<li>
			<form id="searchbox" action="index.php" method="GET">
				<input id="search" type="text" placeholder="Search" name="search">
				<input class="button" type="submit" value="Search">
			</form>
			</li>
		</ul>
	</li>
   <li class='active'><a href='#'>Ponuda</a>
      <ul>
         <li><a href='#'>Komponente</a>
            <ul>
               <li><a href='index1.php?search1=CPU'>Procesori</a></li>
               <li><a href='index1.php?search1=Maticna'>Matične ploče</a></li>
			   <li><a href='index1.php?search1=GPU'>Grafičke kartice</a></li>
               <li><a href='index1.php?search1=HDD'>Tvrdi diskovi</a></li>
			   <li><a href='index1.php?search1=Napajanje'>Napajanja</a></li>
			   <li><a href='index1.php?search1=Zvucna'>Zvučne kartice</a></li>
               <li><a href='index1.php?search1=Opticki'>Optički uređaji</a></li>
			   <li><a href='index1.php?search1=SSD'>Solid state diskovi</a></li>
			   
            </ul>
         </li>
         <li><a href='#'>Software</a>
            <ul>
               <li><a href='index1.php?search1=OS'>Operativni sustavi(OS)</a></li>
               <li><a href='index1.php?search1=Antivirus'>Antivirus</a></li>
            </ul>
         </li>
		 <li><a href='#'>Periferne jedinice</a>
            <ul>
               <li><a href='index1.php?search1=Tipkovnica'>Tipkovnice</a></li>
               <li><a href='index1.php?search1=Mouse'>Miševi</a></li>
			   <li><a href='index1.php?search1=Monitor'>Monitori</a></li>
               <li><a href='index1.php?search1=Printer'>Printeri</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a  href="#" onClick="toggle_visibility('topRated');"><span>Top Rated</span></a></li>
   <li><a href='about.php'>O nama</a></li>
   <li style='margin-left: 25%'><a href='adminPanel.php'>Admin</a></li>
   
</ul>
</div>
<body id="body">
	<center>
	<?php include("preporuka.php"); ?>
	</center>
</body>
</html>