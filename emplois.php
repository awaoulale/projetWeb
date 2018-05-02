<html>

 <head>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8" />
 <title> ECE Plouf Emplois </title>
 <link rel="stylesheet" href="emplois.css"  /> 
 </head>


<body>

<header>
<h1 class="logo"><img src="logoECE.png" alt="Logo" height="81" width="289"/></h1>

<div id="menu">
  <ul id="onglets">
    <li class="active"><a href="emplois.php"> Emplois </a></li>
    <li><a href="accueil.html"> Accueil </a></li>
    <li><a href="vous.html"> Vous </a></li>
    <li><a href="reseau.html"> Votre réseau </a></li>
  </ul>
</div>

</header>


	
	
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
		echo '<p>'.$data['description'].'<p>';
		echo '<p>Durée : '.$data['duree'].'<p>';
		echo '<p>Type : '.$data['type'].'<p>';
		echo '<p>Sécialité : '.$data['specialite'].'<p>';
        echo '</article>';

	}
	
	mysqli_free_result($res);
	mysqli_close($connect);
}

?>

	
</body>	

</html>