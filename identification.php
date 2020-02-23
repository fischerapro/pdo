<?php

if (isset($_POST['username'], $_POST['password']))
{
	try
		{
		$bdd = new PDO('mysql:host=localhost;dbname=access;charset=utf8', 'root', '');
		$stmt = $bdd->prepare("SELECT * FROM acces WHERE login=:login AND password=:pswd");
		$stmt->execute(['login' => $_POST['username'], 'pswd' => $_POST['password']]); 
		$user = $stmt->fetch();
		if($user == false)
			header('Location: login.php?m=error');
		else
			echo "Connecté :)";
		}
	catch (Exception $e)
		{
	        die('Erreur : ' . $e->getMessage());
	        header('Location: login.php?m=error');
		}
	}
else
	echo "Erreur";

?>