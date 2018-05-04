<?php
session_start(); 
?>
<html>
 <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title> ECEPlouf Notifications</title>
		<link rel="icon" type="image/png" href="plouf.jpg" />
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
 <link rel="stylesheet" href="notifications.css"  /> 
 </head>


<body style="background-color:lightblue;">
<center>
	
<!--<h1 class="logo"><img src="logoPlouf.png" alt="Logo" height="150" width="350"/></h1>  -->


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
 <h2>  Vos notifications   </h2>
</div>
	
	
	


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
$mon_id= mysqli_query($connect,"SELECT id FROM utilisateurs WHERE mail='$mail' AND pseudo='$pseudo'");

if(!$connect )
	echo"pb de connexion";
else{
	//on construit la requete
	$sql="SELECT U.Nom,U.Prenom,D.chemin,R.aime,R.partage,R.commentaire 
,R.date_reaction
FROM utilisateurs U, reactions R,documents D

WHERE D.id_doc=R.id_doc

 AND D.id_auteur=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo')
 AND R.id_utilisateur=U.id
GROUP BY R.date_reaction DESC";
	
	// on ecrit notre requete, on l enverra avec jquery
	$res= mysqli_query($connect,$sql);
	if($res){
		//on traite les résultats
		//chaque ligne
		echo"Bonjour, voici vos notifications !";
		echo'</br> </br>';
		while($data=mysqli_fetch_assoc($res)){// tant qu on peut extraire
			
			echo$saut;
			echo"Le ";
			echo$data['date_reaction'];
			echo$saut;
			echo$data['Prenom'];
			echo" ";
			echo$data['Nom'];
			echo$saut;
			if($data['aime']=="oui"){
			echo"a aimé votre publication ";
			}
			if($data['partage']=="oui"){
			echo$saut;
			echo"a partagé votre publication ";
			}
			echo$saut;
			
			if($data['commentaire']==""){ }
			  else{echo"a commenté : ";
			echo$data['commentaire'];
			echo$saut;}
			echo '<img src="'.$data["chemin"].'" alt="Votre photo" height="300" width="300"/>';
			echo'</br> </br>';
			
			
		}
	}
	else{
	echo "erreur requete";
	
	
	}
	mysqli_close($connect);
}

?>


</center>

<div id="footer">
  <div class="container">
    <p class="text-muted">Copyright ©2018 ECE Paris, A. OULALE - M. TREUVELOT - E. VERMEULEN</p>
  </div>
</div>


</body>	
</html>
	