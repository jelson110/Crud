
    <?php include('server.php');
      $update_s="";
      if(isset($_GET['edit'])){
        $id=$_GET['edit'];
        $update_s=true;
        $result=$dataBase->query("SELECT * FROM todolist WHERE id=$id" ) or die($dataBase->error);
        $row=$result->fetch_array();
        $list=$row['list'];
      }
    ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>php crud</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

    <?php 
    
        if(isset( $_SESSION['message'])): ?>

        <div class="warning">
           <?php
                echo $_SESSION['message'];
                unset ($_SESSION['message']);
             ?>
          </div>
    <?php endif ?>

    <?php 
      $dataBase = new mysqli('localhost', 'root','','crud') or die (mysqli_error($dataBase));
      $display = $dataBase->query("SELECT * FROM todolist") or die($dataBase->error); 
    ?>  
      <form method="POST" action="server.php">
        <div class="form-group">
          <input type="text" name="list" value="<?php echo $list; ?>"
          placeholder="Type your To Do List">
          <i class="fas fa-file" aria-hidden="true"></i>
        </div>
        <br>
        <div class="form-group">
          <?php if($update_s == false):?>
           <button type="submit" name="save" class="btn">ADD</button>
           <?php else:?>
           <button type="submit" name="update" class="btn">UPDATE</button>
           <?php endif?>
        </div>
        <div class="table">
         <table>
            <?php while($row = $display->fetch_assoc()): ?>
              <tr> 
                <td><?php echo $row['list'] ?> </td>
                <td>
                  <a class="btn-info" href="index.php?edit=<?php echo $row['id'];?>">Edit</a>
                  <a class="btn-danger" href="server.php?delete=<?php echo $row['id'];?>">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </table>
        </div>
      </form>
  </body>
</html>