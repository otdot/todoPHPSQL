<?php 
include ("./db.php");

if (isset($_POST["submit"])) {
    $todo = $_POST["todo"];

    $query = "INSERT INTO tasks (task) VALUES ('$todo')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("query failed");
    }
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