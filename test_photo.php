
<html>

<form action="test_photo_traitement.php" method="post" enctype="multipart/form-data"> 
  <div>
    <label for="profile_pic">Sélectionnez le fichier à utiliser pour changer votre photo de profil</label>
    <input type="file" id="profile_pic" name="profile_pic"
          accept=".jpg, .jpeg, .png, .txt">
		  <br/>
		  <br/>
		  <label> Entrez le lieu : </label>
		  <input type="text" name="lieu"/><br/>
		  <br/>
		  <br/>
		  <label> Le statut de votre publication : </label>
		  <input type="radio" name="statut" value="public" checked>public
		  <input type="radio" name="statut" value="private">private
		  <br/>
		  <br/>
		  <input type="submit" name="valider" value="OK"/>

 	</form>
	
</html>


