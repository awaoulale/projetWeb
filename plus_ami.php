<html>
 <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> ECEPlouf</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
 <link rel="stylesheet" href="emplois.css"  /> 
 </head>

 
<body>

<!-- Fixed navbar -->
<div class="navbar navbar-custom navbar-inverse navbar-static-top" id="nav">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav nav-justified">
          <li><a href="accueil.html">Accueil</a></li>
          <li><a href="monreseau.php">Mon reseau</a></li>
          <li><a href="vous.php">Vous</a></li>
          <li><a href="notifications.php">Notifications</a></li>
          <li><a href="emplois.php">Emplois</a></li>
          <li><a href="messagerie.php">Messagerie</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container -->
</div><!--/.navbar -->


<div id="infos">
 <h2>  Ajouter un ami   </h2>
</div>
	



<?php

$id_ami = $_POST['id_ami'];
//echo "ami:".$id_ami."<br/>";

session_start(); // On démarre la session AVANT toute chose
	$serveur="localhost";
    $log="root";
    $mdp="";

	$bdd="projetweb";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);
	$mail=$_SESSION['mail'];
	$pseudo=$_SESSION['pseudo'];

	
	if(!$connect )
	echo"pb de connexion";
	else
	{
		// Recherche de l'id de l'utilisateur et enregistrement de id_ami en tant qu'ami
		$resultat1=mysqli_query($connect, "SELECT id FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'");
		if($resultat1)
		{
			if($data=mysqli_fetch_array($resultat1))
			{
				$iduser = $data["id"];
				echo "user: ".$iduser."<br/>";
				//$resultat1=mysqli_query($connect, "INSERT INTO amis VALUES ('$iduser','$id_ami'), ('$id_ami','$iduser')"); 
				$resultat1=mysqli_query($connect, "DELETE FROM `amis` WHERE id_ami1='$iduser' AND id_ami2='$id_ami'");
                $resultat2=mysqli_query($connect, "DELETE FROM `amis` WHERE id_ami2='$iduser' AND id_ami1='$id_ami'");				
				if($resultat1){
					if($resultat2){
				
					echo "Ami supprimé";
					 header('Location: monreseau.php');
					}}
			}
		
		}
	}	
			
	
		
?>





<div id="footer">
  <div class="container">
    <p class="text-muted">Copyright ©2018 ECE Paris, A. OULALE - M. TREUVELOT - E. VERMEULEN</p>
  </div>
</div>
</body>
	


</html>