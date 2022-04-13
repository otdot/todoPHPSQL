<?php 
    include ("./db.php");

    $alldataquery = "SELECT * FROM tasks";
    $alldata = mysqli_query($connection, $alldataquery);
    if (!$alldata) {
        die("query failed");
    }
    

    if (isset($_POST["submit2"])) {
        $todo = $_POST["todo"];
        $query = "INSERT INTO tasks (task) VALUES ('$todo')";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query failed");
        }

        $alldataquery = "SELECT * FROM tasks";
        $alldata = mysqli_query($connection, $alldataquery);
        if (!$alldata) {
            die("query failed");
        }

    }

    if (isset($_POST["deletebutton"])) {
        $id = $_POST['delete'];

        $query = "DELETE FROM tasks WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die("query failed");
        }

        $alldataquery = "SELECT * FROM tasks";
        $alldata = mysqli_query($connection, $alldataquery);
        if (!$alldata) {
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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add and delete tasks</h1>
    <form action="index.php" method="POST">
        <label for="todo">todo</label>
        <input id="todo" name="todo" type="text">
        <input name="submit2" type="submit" value="add todo">
    </form>
    <?php
    while ($row2 = mysqli_fetch_assoc($alldata)) { ?>
        <div class="todoitem">
            <p type="text" data-id=<?php echo $row2['id']?>><?= $row2['task'] ?></p>
            <form action="index.php" method="POST">
                <input hidden value="<?php echo $row2['id']?>" name="delete"></input>
                <input class="deletebutton" value="delete" name="deletebutton" type="submit">
            </form>
        </div>
        <?php
		} ?>
</body>
</html>