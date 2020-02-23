<?php

// Connexion à la bdd
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=access;charset=utf8', 'root', '');
	$stmt = $bdd->query("SELECT * FROM acces");
	$users = $stmt->fetchall();
	//var_dump($users);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
// isset messages 
$alert = "";
if (isset($_GET['m'])){
  if($_GET['m'] == "success"){
    $alert = '<div class="alert alert-success" role="alert">
  La ligne a été supprimée.
</div>';
  }
  else if($_GET['m'] == "error")
   $alert = '<div class="alert alert-danger" role="alert">
  Une erreur est survenue.
</div>';
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

<h1 class="text-center">PDO</h1>
 <?php echo $alert; ?>
<p>
  <a class="btn btn-primary" href="ajoute.php" role="button"><i class="fas fa-plus"></i> Ajouter</a>
</p>
  

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Prenom</th>
      <th scope="col">Login</th>
      <th scope="col">Password</th>
      <th scope="col">Statut</th>
      <th scope="col">Age</th>
      <th scope="col">Edit</th>
      <th scope="col">Supp.</th>     
    </tr>
  </thead>
 
  <tbody>
  	<?php 
  	foreach ($users as &$user) {
  		echo '<tr>
        <th scope="row">' . $user['id'] . '</th>
        <td>' . $user['prenom'] . '</td>
        <td>' . $user['login'] . '</td>
        <td>' . $user['password'] . '</td>
        <td>' . $user['statut'] . '</td>
        <td>' . $user['age'] . '</td>
        <td><a class="btn btn-outline-warning" href="modif.php?id=' . $user['id'] . '">
  <i class="fas fa-edit"></i></a></td>
  <td><a class="btn btn-outline-danger" href="efface.php?id=' . $user['id'] . '">
  <i class="fas fa-trash-alt"></i></a></td>
      </tr>';
}
  		?>
  </tbody>
</table>
</div>
</body>

</html>
