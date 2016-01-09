<?php
	session_start();// Starting Session
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	@mysql_connect("localhost", "root", "vertrigo");
	// Selecting Database
	@mysql_select_db("web_shop", $connection);
	
	// Storing Session
	if(isset($_SESSION['login_user'])){
		$user_check=$_SESSION['login_user'];
	}
	
?>
<html>
<head>
<title> Webshop</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<header id="header">
	
</header>
<div id='cssmenu'>

	<ul>
   <li><a href='index.php'>Home</a></li>
   <li class='active'><a href='#'>Ponuda</a>
      <ul>
         <li><a href='#'>Komponente</a>
            <ul>
               <li><a href='#'>Procesori</a></li>
               <li><a href='#'>Matične ploče</a></li>
			   <li><a href='#'>Grafičke kartice</a></li>
               <li><a href='#'>Tvrdi diskovi</a></li>
			   <li><a href='#'>Napajanja</a></li>
               <li><a href='#'>Kućišta</a></li>
			   <li><a href='#'>Zvučne kartice</a></li>
               <li><a href='#'>Optički uređaji</a></li>
			   <li><a href='#'>Solid state diskovi</a></li>
			   
            </ul>
         </li>
         <li><a href='#'>Software</a>
            <ul>
               <li><a href='#'>Operativni sustavi(OS)</a></li>
               <li><a href='#'>Antivirus</a></li>
            </ul>
         </li>
		 <li><a href='#'>Periferne jedinice</a>
            <ul>
               <li><a href='#'>Tipkovnice</a></li>
               <li><a href='#'>Miševi</a></li>
			   <li><a href='#'>Monitori</a></li>
               <li><a href='#'>Printeri</a></li>
            </ul>
         </li>
      </ul>
   </li>
   <li><a href='about.php'>O nama</a></li>
   <li><a href='admin.php'>Admin</a></li>
  
	
</ul>
</div>
<body id="body">

OVO JE ABOUT PAGE
</body>
</html>