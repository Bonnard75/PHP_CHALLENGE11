<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenge 11</title>
</head>
<body>

<?php

require_once 'connec.php'; 
include('header.php');

$pdo = new \PDO(DSN, USER, PASS);    

?>

<form action="" method="post">
    <div>
        <label for="firstname">Prénom</label>
        <input type="text" id="firstname" name="firstname" required></input>
    </div>
    <br>
    <div>
        <label for="lastname">Nom</label>
        <input type="text" id="lastname" name="lastname" required autofocus></input>
    </div>
    <br>
    <button type="submit">Valider</button>
</form>

<?php
$firstname = trim($_POST['firstname']); 
$lastname = trim($_POST['lastname']);  

$query = "INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)"; 

$statement = $pdo->prepare($query); 
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR); 
$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);

$statement->execute();
$friends =$statement->fetchAll(); 

$query = 'SELECT * FROM friend'; 
$statement = $pdo->query($query); 
$friends = $statement->fetchAll(); 


foreach ($friends as $arrayFriend) {
    echo "<br>";
    echo $arrayFriend['firstname'] . ' ' . $arrayFriend['lastname'];
}
?>

</body>
</html>