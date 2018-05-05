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


 <h3> Venez créer votre CV sur ECE Plouf!</h3>
   <p> ECE Plouf vous propose de poster votre CV !</p>
 <br/>
 
 	</center>
 
    <form action="cv_traitement.php" method="post">
				
		<label> Entrez votre date de naissance : </label>
		<input type="date" name="naissance" value="<?php echo $naissance; ?>"/><br/>
		
		<br/>
		
		<label> Entrez vos spécialités : </label>
		<input type="text" name="specialite" value="<?php echo $specialite; ?>"/><br/>
		
		<br/>
		
		<label> Entrez votre dernier diplôme obtenu : </label>
		 <input type="text" name="diplome" value="<?php echo $diplome; ?>"/><br/> 
			<br/>
		
			<!--		<td> Dernier diplôme obtenu :</td>
						<td><select name="diplome"> -->
							<!--	<option value="" disabled="disabled" selected="selected">Sélectionnez votre dernier diplôme</option> -->
							<!--	<option value="" disabled="disabled" selected="selected"><?php echo $diplome; ?></option>
								<option value="brevet">Pas de diplôme</option>
								<option value="brevet">Brevet des collèges</option>
								<option value="bac">Bac</option>
								<option value="bac2">Bac+2 : DUT, BTS, etc.</option>
								<option value="bac3">Bac+3 ou 4 : Licence, etc.</option>
								<option value="bac5">Bac+5 : Doctorat, Master, etc.</option>
								<option value="autre">Autre veuillez preciser svp</option>
							</select></td><br> -->
					</td>		
		
		<br/>

		<label> Entrez vos hobbies : </label>
		<br/>
		<textarea cols="30" rows="5" name="hobbys" > <?php echo $hobbys; ?> </textarea>
		
		<br/>
		<br/>
		
		<label> Entrez vos expériences : </label>
		<br/>
		<textarea cols="75" rows="5" name="experience"> <?php echo $experience; ?> </textarea>
		
		<br/>
		<br/>
		
		<input type="submit" value="Enregistrez"/>
	</form>
			
</body>	

</html>
<?php include("footer.php"); ?>