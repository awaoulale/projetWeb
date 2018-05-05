<?php
session_start(); // On démarre la session AVANT toute chose
include("fixednavbar.php");

$mail=$_SESSION['mail'];
$pseudo=$_SESSION['pseudo'];

$naissance=$_SESSION['naissance'];
$specialite=$_SESSION['specialite'];
$diplome=$_SESSION['diplome'];
$hobbys=$_SESSION['hobbys'];
$experience=$_SESSION['experience'];

?>

<center>
 <h2> Venez creer ou modifier votre CV sur ECE Plouf!</h2>
   <h3> Postez votre CV pour que tout le monde puisse le consulter !</h3>
 <br/>
 </center>
  
    <form action="cv_traitement.php" method="post">
				
		<label> Votre date de naissance : </label>
		<input type="date" name="naissance" value="<?php echo $naissance; ?>"/><br/>
		
		<br/>
		
		<label> Vos specialites ou points forts : </label>
		<input type="text" name="specialite" value="<?php echo $specialite; ?>"/><br/>
		
		<br/>
		
		<label> Votre dernier diplome obtenu : </label>
		 <input type="text" name="diplome" value="<?php echo $diplome; ?>"/><br/> 
			<br/>
		
					</td>		
		
		<br/>

		<label> Vos hobbies : </label>
		<br/>
		<textarea cols="30" rows="5" name="hobbys" > <?php echo $hobbys; ?> </textarea>
		
		<br/>
		<br/>
		
		<label> Vos experiences professionnelles : </label>
		<br/>
		<textarea cols="75" rows="5" name="experience"> <?php echo $experience; ?> </textarea>
		
		<br/>
		<br/>
		
		<input type="submit" value="Enregistrez"/>
	</form>
	
			
</body>	

</html>
<?php include("footer.php"); ?>