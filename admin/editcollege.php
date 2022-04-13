<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>college</title>
</head>
<body>
    <?php
    require_once('admin_header.php');
    require_once('dbconnection.php');

    $college_name ='';
    if(isset($_GET['collegeid']))
    {
      
       $coll_id = $_GET['collegeid'];
        $sql_select = mysqli_query($conn, "SELECT  `college_name` FROM `colleges` WHERE college_id='$coll_id'");
       $fecth_college = mysqli_fetch_array($sql_select);
       $college_name = $fecth_college['college_name'];
    }
if(isset($_POST['update']))
{
  $up_coll_name = $_POST['college'];
  $up_coll_id = $_POST['college_id'];
  $sql_update = mysqli_query($conn, "UPDATE `colleges` SET `college_name`='$up_coll_name' WHERE college_id='$up_coll_id'");
  if($sql_update)
  {
      echo "Successfully updated";
  }
  else
  {
      echo mysqli_error($conn);
  }
}
    ?>
    <form action="" method="post">
        <input type="hidden" name ="college_id"value="<?php echo $coll_id?>">
    <label for="forcollege">College</label>
    <input type="text" name="college" value="<?php echo $college_name?>">
    <input type="submit" name ="update" value="Update">
    </form>



</body>
</html>