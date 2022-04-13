<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
</head>

<body>
<?php 
require_once('admin_header.php');
?>

    <form action="" method="post">
    <label for="collegename">College</label>
    <input type="text" name="college_name" id="">
    <button type="submit" name ="seacrh" >Seacrh</button>
    </form>
    <?php
        $conn = mysqli_connect('127.0.0.1','root','');
        $db = mysqli_select_db($conn,'dbu_lms');
if(isset($_POST['seacrh']))
{
    $query = $_POST['college_name'];
    $sql_search = mysqli_query($conn,"SELECT * FROM `colleges` WHERE `college_name`='$query'");
    $check = mysqli_num_rows($sql_search);
    if($check > 0)
    {
   if($sql_search) 
   {
    $result = mysqli_fetch_array($sql_search);
    echo $result['college_name'];
   }
    }
    else
    {
        echo "No result found";
    }
}
?>



</body>
</html>