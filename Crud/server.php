<?php

    session_start();

    $dataBase = new mysqli('localhost', 'root','','crud') or die (mysqli_error($dataBase));
    $list = '';
    if(isset($_POST['save'])){

        $list = $_POST['list'];
        $dataBase->query ("INSERT INTO todolist(list) VALUES ('$list')" ) or die($dataBase->error);
        
        $_SESSION['message']= "Added to the list";

        header('location: index.php');
    }

    if(isset($_GET['delete'])){

        $id=$_GET['delete'];
        $dataBase->query("DELETE FROM todolist WHERE id=$id" ) or die($dataBase->error);

        $_SESSION['message']= "To do list has been Deleted";

        header('location: index.php');
    }

    if(isset($_POST['update'])){

        $id=$_POST['id'];
        $list = $_POST['list'];
                                            
        $dataBase->query("UPDATE todolist SET list='$list' WHERE id=$id ");
        

        $_SESSION['message']= "List has been Updated";

        header('location: index.php');
    }

?>