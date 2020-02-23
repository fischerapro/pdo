<?php

if (isset($_GET['id']) && !empty($_GET['id'])){
	//var_dump(SelectByID($_GET['id']));
}

if (isset($_POST['prenom'],$_POST['login'],$_POST['password'],$_POST['password2'],$_POST['statut'],$_POST['age'])){
	Update();
}


function ConnexionBDD(){
	try
	{
		return new PDO('mysql:host=localhost;dbname=access;charset=utf8', 'root', '');
	}
	catch (Exception $e)
	{
	        die('Erreur : ' . $e->getMessage());
	}
}

function Update(){
	try
	{
		$bdd = ConnexionBDD();
		$data = [
			'id' => $_GET['id'],
		    'prenom' => $_POST['prenom'],
		    'login' => $_POST['login'],
		    'password' => $_POST['password'],
		    'statut' => $_POST['statut'],
		    'age' => $_POST['age'],
		];

		$sql = "UPDATE acces SET prenom=:prenom, login=:login, password=:password, statut=:statut, age=:age WHERE id=:id";
		$bdd->prepare($sql)->execute($data);
		header('Location: liste.php');
		//$stmt->execute($data);
		//var_dump($users);
	}
	catch(PDOException $e)
    {
    	header('Location: ajoute.php?m=error');
    }
}

function SelectByID($id){

	try
	{
		$bdd = ConnexionBDD();
		$stmt = $bdd->query("SELECT * FROM acces WHERE id=$id");
		$user = $stmt->fetch();
		return $user;
		//var_dump($users);
	}
	catch(PDOException $e)
    {
    	header('Location: ajoute.php?m=error');
    }
}


function Insert(){

	try {
	    $bdd = ConnexionBDD();

	    $data = [
		    'prenom' => $_POST['prenom'],
		    'login' => $_POST['login'],
		    'password' => $_POST['password'],
		    'statut' => $_POST['statut'],
		    'age' => $_POST['age'],
		];
		
		$sql = "INSERT INTO acces (prenom, login, password, statut, age) VALUES (:prenom, :login, :password, :statut, :age)";
		$stmt= $bdd->prepare($sql);
		$stmt->execute($data);
	    header('Location: ajoute.php?m=success');
	    }
	catch(PDOException $e)
	    {
	    	header('Location: ajoute.php?m=error');
	    }
}

// isset messages 
$alert = "";
if (isset($_GET['m'])){

  	if($_GET['m'] == "success"){
    	$alert = '<div class="alert alert-success" role="alert"> La personne a été ajoutée.</div>';
    }
  else if($_GET['m'] == "error"){
   $alert = '<div class="alert alert-danger" role="alert">Une erreur est survenue.</div>';
	}
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>PHP PDO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/ffe21c2793.js" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">

<h1 class="text-center">PDO - Ajouter</h1>
<?php echo $alert; ?>
<form acion="#" method="POST">
  <div class="form-row">
    <div class="form-group col-md-6">
    	<label for="prenom">Prénom</label>
    	<input name="prenom" type="text" class="form-control" id="prenom" required="" maxlength="20">
    </div>
    <div class="form-group col-md-6">
    	<label for="login">Login</label>
    	<input name="login" type="text" class="form-control" id="login" required="" maxlength="20">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
    	<label for="password">Mot de passe</label>
    	<input name="password" type="password" class="form-control" id="password" required="" maxlength="20">
    </div>
	<div class="form-group col-md-6">
     	<label for="password2">Confirmation mot de passe</label>
    	<input name="password2" type="password" class="form-control" id="password2" required="">
    </div>
  </div>

   <div class="form-row">
    <div class="form-group col-md-6">
    	<label for="inputState">Statut</label>
        <select id="inputState" class="form-control" name="statut" required="">
        	<?php
        	// Connexion à la bdd
				try
				{

					$bdd = new PDO('mysql:host=localhost;dbname=access;charset=utf8', 'root', '');
					$stmt = $bdd->query("SELECT * FROM Statut");
					$statuts = $stmt->fetchall();

					foreach ($statuts as $statut) {
		        	 	echo "<option>". $statut[nom] . "</option>";
		        	 } 

				}
				catch (Exception $e)
				{
				        die('Erreur : ' . $e->getMessage());
				}
        	

        	?>
    	</select>
    </div>
	<div class="form-group col-md-6">
     	<label for="age">Age</label>
    	<input class="form-control" type="number" id="age" name="age" required="" maxlength="20">
    </div>
  </div>
  <button type="submit" class="btn btn-warning">Modifier</button>
  <a class="btn btn-outline-secondary" href="liste.php">Retour</a>
</form>
</html>
