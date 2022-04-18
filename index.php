
<?php 
    $dbhost = "db";
    $dbname = "tododb";
    $dbuser = "root";
    $dbpass = "lionPass";
    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    $alldataquery = "SELECT * FROM tasks";
    $alldata = mysqli_query($connection, $alldataquery);
    if (!$alldata) {
        die("query failed");
    }

    function sanitazeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    

    if (isset($_POST["insertData"])) {
        $todo = sanitazeInput($_POST["todo"]);
        $todo = mysqli_real_escape_string($connection, $_POST['todo']);
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

    // if (isset($_POST["deletebutton"])) {
    //     $id = sanitazeInput($_POST['delete']);

    //     $query = "DELETE FROM tasks WHERE id = $id";
    //     $result = mysqli_query($connection, $query);

    //     if (!$result) {
    //         die("query failed");
    //     }

    //     $alldataquery = "SELECT * FROM tasks";
    //     $alldata = mysqli_query($connection, $alldataquery);
    //     if (!$alldata) {
    //         die("query failed");
    //     }

    // }

    if(isset($_POST['submit'])) {
        $newItem = $_POST['taskUpdate'];
        $id = $_POST["update"];
        
        //Updating the database 
        
        $toUpdate = "UPDATE tasks SET ";
        $toUpdate .= "task = '$newItem' ";
        $toUpdate .= "WHERE id = $id";

        $result = mysqli_query($connection, $toUpdate);

        if (!$result) {
            die("query failed");
        }

        $alldataquery = "SELECT * FROM tasks";
        $alldata = mysqli_query($connection, $alldataquery);
        if (!$alldata) {
            die("query failed");
        }

    }


    if (isset($_GET["deleteId"])) {
        $id = sanitazeInput($_GET['deleteId']);

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
    <div class="wrapper">
    <h1>Add and delete tasks</h1>
    <form class="todo-input" action="index.php" method="POST">
        <input id="todo" name="todo" type="text">
        <input class ="add-button"name="insertData" type="submit" value="ADD">
    </form>
    <?php
    while ($row2 = mysqli_fetch_assoc($alldata)) { ?>
        <div class="todoitem">
            <p type="text" data-id=<?php echo $row2['id']?>><?= $row2['task'] ?></p>
            <a class="deletebutton" href="index.php?deleteId=<?= $row2['id']?>">X</a>
            <form action="index.php" method="POST">
                <input hidden value="<?php echo $row2['id']?>" name="update">
                <input type="text" name="taskUpdate" placeholder="Update Task">
                <input class="update" name="submit" type="submit">
            </form>
        </div>
        <?php
        } ?>

</div>
</body>
</html>
