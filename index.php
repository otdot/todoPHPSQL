<?php 
if (isset($_POST["todo"])) {
    $todo = $_POST["todo"];
}

$dbhost = "db";
$dbname = "tododb";
$dbuser = "root";
$dbpass = "lionPass";

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($connection->connect_error) {
    echo "connection unsuccesful";
}else {
    echo "connected succesfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello</h1>
    <form action="index.php" method="POST">
        <label for="todo">todo</label>
        <input id="todo" name="todo" type="text">
        <input name="submit" type="submit" value="add todo">
    </form>
</body>
</html>