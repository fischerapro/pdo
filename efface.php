<?php

if (isset($_GET['id'])){

	//echo 'id = ' . $_GET['id'];
	EraseID($_GET['id']);
	}
	else
		 header('Location: liste.php?m=error');
		
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

function EraseID($id){

	try {
	    $bdd = ConnexionBDD();

	    // sql to delete a record
	    $sql = "DELETE FROM acces WHERE id=$id";

	    // use exec() because no results are returned
	    $bdd->exec($sql);
	    echo "Effacé avec succes";
	    header('Location: liste.php?m=success');
	    }
	catch(PDOException $e)
	    {
	    header('Location: liste.php?m=error');
	    }
}
?>