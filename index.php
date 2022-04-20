
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
        $todo = mysqli_real_escape_string($connection, $todo);
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


    if(isset($_POST['submit'])) {
        $newItem = sanitazeInput($_POST['taskUpdate']);
        $newItem = mysqli_real_escape_string($connection, $newItem);
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
    <title>Todo PHP</title>
    <link rel="stylesheet" href="styles.css">
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
            <p class="todotext" type="text" data-id=<?php echo $row2['id']?>><?= $row2['task'] ?></p>
            <a class="deletebutton" href="index.php?deleteId=<?= $row2['id']?>"><i class="fa-solid fa-trash-can fa-1x"></i></a>
            <form class="updateForm" action="index.php" method="POST">
                <input hidden value="<?php echo $row2['id']?>" name="update">
                <input class="updateInput" type="text" name="taskUpdate" placeholder="Update Task">
                <input class="updateSubmit" value="" name="submit" type="submit">
            </form>
        </div>
        <?php
        } ?>
    </div>
    <script src="https://kit.fontawesome.com/200484ca2d.js" crossorigin="anonymous"></script>
</body>
</html>
