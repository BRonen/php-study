<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>
<body>
    <?php
        $DB = require './db.php';

        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);

        if($username && $email){
            $DB->addUser($username, $email);
        }

        $email = htmlspecialchars($_GET["email"]);

        if($email){
            $DB->deleteUser($email);
        }

        require './new.php';
        require './table.php';

    ?>
</body>
</html>