<?php
session_start(); 
?>

<html>

 <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> ECEPlouf emplois</title>
		<link rel="icon" type="image/png" href="plouf.jpg" />
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

<?php
 //session_start();
$serveur="localhost";
$log="root";
$mdp="";
$saut="</br>";
$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);
$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];



//<!-- Fixed navbar -->
echo'<div class="navbar navbar-custom navbar-inverse navbar-static-top" id="nav">';
 echo'   <div class="container">';
 echo'     <div class="navbar-header">';
 echo'       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'         <span class="icon-bar"></span>';
 echo'       </button>';
 echo'     </div>';
 echo'     <div class="collapse navbar-collapse">';
  echo'      <ul class="nav navbar-nav nav-justified">';
  echo'        <li><a href="accueil.html">Accueil</a></li>';
  echo'        <li><a href="monreseau.php">Mon reseau</a></li>';
  echo'        <li><a href="vous.php">Vous</a></li>';
  echo'        <li><a href="notifications.php">Notifications</a></li>';
  echo'        <li><a href="emplois.php">Emplois</a></li>';
  echo'        <li><a href="messagerie.php">Messagerie</a></li>';
  
 $sql="SELECT type FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'";
  
  	$res= mysqli_query($connect,$sql);
	
	if($res){
		    $data=mysqli_fetch_assoc($res);
	        if($data["type"]=="Auteur"){}
			else{
				echo'<li><a href="admin.php">Admin</a></li>';
				}
	}
 
  
  echo'      </ul>';
  echo'    </div><!--/.nav-collapse -->';
  echo'  </div><!--/.container -->';
echo'</div><!--/.navbar -->';



?>




	
	
<div id="infos">
 <h2>  Offres d'emplois et de stages disponibles   </h2>
</div>
	

	
<?php

$serveur="localhost";
$log="root";
$mdp="";

$bdd="projetweb";
$connect=mysqli_connect($serveur,$log,$mdp);
$con=mysqli_select_db($connect,$bdd);
		
if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
	$sql="SELECT * FROM emplois" ;
		
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	
	while($data=mysqli_fetch_assoc($res)){

        echo '<article>';
		echo '<h2 class=titre_job>'.$data['titre'].'</h2>';
		echo '<h2 class=titre_job>'.$data['societe'].'</h2>';
		echo '<p>'.$data['description'].'<p>';
		echo '<p>Durée : '.$data['duree'].'<p>';
		echo '<p>Type : '.$data['type'].'<p>';
		echo '<p>Spécialité : '.$data['specialite'].'<p>';
		echo '<p>Contact : '.$data['mail'].'<p>';
	    
		
        echo '</article>';

	}
	
	mysqli_free_result($res);
	mysqli_close($connect);
}

?>


<div id="footer">
  <div class="container">
    <p class="text-muted">Copyright ©2018 ECE Paris, A. OULALE - M. TREUVELOT - E. VERMEULEN</p>
  </div>
</div>
	
</body>	

</html>