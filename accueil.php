<?php
session_start(); // On démarre la session AVANT toute chose
?>

<!DOCTYPE html>
<html lang="en">

	<body>
<!-- Wrap all page content here -->
<div id="wrap">

 
  
  
<?php include("fixednavbar.php"); ?>
  
<!-- Begin page content -->

<div class="container">
  <div class="col-sm-10 col-sm-offset-1">
    <div class="page-header text-center">
      <h2>Boostez votre carriere</h2>
    </div>
    
    <p class="lead text-center"> 
      L'ECE Paris vous propose une plateforme entierement dediee a votre parcours professionnel
    </p> 
    
    <hr>
    
  </div>
</div>
    

<div class="row">
  	<div class="col-sm-10 col-sm-offset-1">
  	  <h1> <?php 	echo "Bienvenue" . " " . $_SESSION['pseudo'] . "!" . "<br/>";  ?> </h1>
 
      <div class="divider"></div>
      
  	</div><!--/col-->
</div><!--/container-->

<div class="bg-4">
  <div class="container">
	<div class="row">	
	
		<div class="col-sm-12 col-xs-6"> 
	    <div class="panel panel-default">
	    	<div class="panel-body">
	    	<h2>Votre Newsfeed</h2>
      			<hr><hr>
				 <p>
				 	
				 	
				 	
				 	
				 	<?php

session_start(); // On démarre la session AVANT toute chose


	$serveur="localhost";
	$log="root";
	$mdp="root";

	$bdd="projetweb1";
	$connect=mysqli_connect($serveur,$log,$mdp);
	$con=mysqli_select_db($connect,$bdd);

	$mail=$_SESSION['mail'];
	$pseudo=$_SESSION['pseudo'];

if(!$connect )
	echo"pb de connexion";
else
{
		
	$resultat1=mysqli_query($connect, "SELECT id_ami1, chemin, nom, prenom, publication, aime, partage, commentaire, reactions.id_doc, utilisateurs.id
										FROM amis 
										JOIN documents ON amis.id_ami1=documents.id_auteur 
										JOIN utilisateurs ON utilisateurs.id=amis.id_ami1 
										JOIN reactions ON reactions.id_doc=documents.id_doc
										WHERE id_ami2=(SELECT id FROM utilisateurs WHERE pseudo='$pseudo') 
										ORDER BY publication DESC");

	if($resultat1)
	{
		$tableau=array("");
		$tour=0;		
		
		
		$sql=mysqli_query($connect,"SELECT id FROM utilisateurs WHERE pseudo='$pseudo'");
		if($sql)
		{
			$ressql=mysqli_fetch_array($sql);
			$id_utilisateur=$ressql["id"];
		}
		
		
		while($idami=mysqli_fetch_array($resultat1))
		{
			$tour=$tour+1;
			
			$tableau2=array($idami["chemin"]);
			
			//condition pour ne pas afficher 2 fois la meme publication dans le fil d'actualite !
			if (!(in_array($idami["chemin"], $tableau)))
			{
				$tableau=array_merge($tableau, $tableau2);
		
				echo "<strong>" .$idami["prenom"]. " " .$idami["nom"]. "</strong><br/>" .$idami["publication"]. "<br/>";
			
				$id_doc=$idami["id_doc"];
				
				
			
				//on compte le nombre de jaimes
				$resultat2=mysqli_query($connect, "SELECT COUNT(aime) AS nb_1 FROM reactions WHERE id_doc='$id_doc' AND aime='oui'");
				if($resultat2)
				{
					while($nbaime=mysqli_fetch_array($resultat2))
					{
						$nb_1=$nbaime["nb_1"];
						echo $nb_1. " j aime(s) <br/>" ;
					}
				}
			
				//on compte le nombre de partages
				$resultat3=mysqli_query($connect, "SELECT COUNT(partage) AS nb_2 FROM reactions WHERE id_doc='$id_doc' AND partage='oui'");
				if($resultat3)
				{
					while($nbpartage=mysqli_fetch_array($resultat3))
					{
						$nb_2=$nbpartage["nb_2"];
						echo $nb_2. " partage(s) <br/>" ;
					}
				}
			
				//on compte le nombre de commentaires
				$resultat4=mysqli_query($connect, "SELECT COUNT(commentaire) AS nb_3 FROM reactions WHERE id_doc='$id_doc' AND commentaire IS NOT NULL");
				if($resultat4)
				{
					while($nbcommentaire=mysqli_fetch_array($resultat4))
					{
						$nb_3=$nbcommentaire["nb_3"];
						echo $nb_3. " commentaire(s) <br/>" ;
					}
				}
				
				//affichage des commentaires				
				$commentaires=mysqli_query($connect, "SELECT commentaire, pseudo
														FROM reactions 
														JOIN utilisateurs ON utilisateurs.id=reactions.id_utilisateur
														WHERE id_doc='$id_doc' AND commentaire IS NOT NULL");
				if($commentaires)
				{
					while($affichecommentaire=mysqli_fetch_array($commentaires))
					{
						$commentaire=$affichecommentaire["commentaire"];												
						$auteur=$affichecommentaire["pseudo"]; //PB
						echo '"'.$commentaire.'" par '.$auteur.'<br/>';
					}
				}
				
				
			
				//si le document est une photo .jpg
				if( strstr($idami["chemin"], ".jpg"))
				{
					echo '<img src="'.$idami["chemin"].'" alt="photo" />';
				}
			
				//si le document est une video .mp4
				if( strstr($idami["chemin"], ".mp4"))
				{
					echo '<video controls src="'.$idami["chemin"].'" width="800" height="500">Ici la description alternative</video>';
				}
				
				echo "<br/><br/>";
				
				//mise en place des boutons
				echo '<form action="accueil.php" method="post">';
				//bouton aimer
				echo '<input type="submit" name="'.$tour.'aimer" value="Aimer"/>';
				echo " ";
				//bouton ne plus aimer
				echo '<input type="submit" name="'.$tour.'neplusaimer" value="Ne plus aimer"/>';
				echo "<br/><br/>";
				//champ de texte pour le commentaire
				//echo'<label>Entrez un commentaire</label>'; //moche
				echo '<input type="text" name="'.$tour.'commentaire" />';
				echo " ";
				//bouton commenter
				echo '<input type="submit" name="'.$tour.'commenter" value="Commenter"/>';
				echo "<br/><br/>";
				//bouton partager
				echo '<input type="submit" name="'.$tour.'partager" value="Partager"/>';
				echo '</form>';
			
				// si on appuie sur le bouton pour aimer
				if (isset($_POST[$tour."aimer"]))
				{
					$requete1=mysqli_query($connect, "SELECT COUNT(*) AS nombre 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete1)
					{
						while($nbr=mysqli_fetch_array($requete1))
						{
							$nombre=$nbr["nombre"];
							if($nombre==0) // si la ligne n'existe pas, on la crée
							{
								$requete2=mysqli_query($connect, "INSERT INTO reactions VALUES ('$id_doc','$id_utilisateur','oui','non',NULL)");
								header('Location: accueil.php');								
							}
							if($nombre!=0) // si la ligne existe, on la modifie
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET aime='oui' WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')");
								header('Location: accueil.php');								
							}
						}
					}
				}
				
				// si on appuie sur le bouton pour ne plus aimer
				if (isset($_POST[$tour."neplusaimer"]))
				{
					$requete1=mysqli_query($connect, "SELECT COUNT(*) AS nombre2 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete1)
					{
						while($nbr=mysqli_fetch_array($requete1))
						{
							$nombre=$nbr["nombre2"];
							if($nombre!=0) // si la ligne existe, on la modifie
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET aime='non' WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')"); //OK
								header('Location: accueil.php');								
							}
						}
					}
				}
				
				// si on appuie sur le bouton pour commenter (ajouter un commentaire)
				if (isset($_POST[$tour."commenter"]))
				{

					$nvcom=$_POST[$tour."commentaire"];
					echo "$nvcom";
					$requete1=mysqli_query($connect, "SELECT COUNT(*) AS nombre 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete1)
					{
						while($nbr=mysqli_fetch_array($requete1))
						{
							$nombre=$nbr["nombre"];
							if($nombre==0) // si la ligne n'existe pas, on la crée
							{
								$requete2=mysqli_query($connect, "INSERT INTO reactions VALUES ('$id_doc','$id_utilisateur','non','non','$nvcom')");
								header('Location: accueil.php');								
							}
							if($nombre!=0) // si la ligne existe, on la modifie (concatenation avec les commentaires precedents)
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET commentaire=CONCAT(commentaire, ' | ', '$nvcom') WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')");
								header('Location: accueil.php');								
							}
						}
					}
				}
				
				// si on appuie sur le bouton pour partager (ajouter une ligne dans ses propres documents mais en precisant que c'est un PARTAGE
				if (isset($_POST[$tour."partager"]))
				{
					//echo "ok1";
					$id_utilisateur=$ressql["id"];
					$chemin=$idami["chemin"];
					//ajouter la publication dans ses propres documents
					$requete1=mysqli_query($connect, "INSERT INTO documents (id_auteur, chemin) VALUES ('$id_utilisateur', '$chemin') "); //OK
					header('Location: accueil.php');								
					//ajouter la ligne dans ta table reactions
					$requete3=mysqli_query($connect, "SELECT COUNT(*) AS nombre 
													FROM reactions 
													WHERE id_doc='$id_doc' AND id_utilisateur='$id_utilisateur'");								
					if($requete3)
					{
						echo "ok2";
						while($nbr=mysqli_fetch_array($requete3))
						{
							echo "ok3";
							$nombre=$nbr["nombre"];
							if($nombre==0) // si la ligne n'existe pas, on la crée
							{
								$requete2=mysqli_query($connect, "INSERT INTO reactions VALUES ('$id_doc','$id_utilisateur','non','oui',NULL)");
								header('Location: accueil.php');								
							}
							if($nombre!=0) // si la ligne existe, on la modifie
							{
								$requete2=mysqli_query($connect, "UPDATE reactions SET partage='oui' WHERE (id_doc='$id_doc' AND id_utilisateur='$id_utilisateur')");
								header('Location: accueil.php');								
							}
						}
					}
											
				}
				
				
				
				
				
				
				echo "<br/><hr><br/>";
				
			}//fin du if d'affichage
			

		} //fin du while requete
		
		
	} //fin du if requete		
	
	
	
}	//fin du else	
?>






				 	
				 </p>
			</div>

		</div><!--/panel-->
		</div><!--/col-->
      
	</div><!--/row-->
  </div><!--/container-->
</div>



<div class="divider" id="section4"></div>

<?php include("footer.php"); ?>

<ul class="nav pull-right scroll-top">
  <li><a href="#" title="Scroll to top"><i class="glyphicon glyphicon-chevron-up"></i></a></li>
</ul>

	</body>
</html>