<?php

use app\entity\user\User;
use app\support\Database;

$picus = User::createUser('picusek123');
$picus->setBalance(999);
var_dump($picus);
$picus->flush();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="app/frontend/style.css">
</head>

<body>
    <?php require 'header.php' ?>
    ahoj nazdar
</body>
</html>