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
  
    $conn = mysqli_connect('127.0.0.1','root','');
    $db = mysqli_select_db($conn,'dbu_lms');

    if(isset($_POST['register']))
    {
       $college_name = $_POST['college'];
       echo $college_name;
        $sql_insert = mysqli_query($conn, "INSERT INTO
         `colleges`(`college_name`) VALUES ('$college_name')");
         if($sql_insert)
         {
             echo "Succesfully registred";
         }
         else
         {
             echo mysqli_error($conn);
         }
    }

    ?>
    <form action="" method="post">
    <label for="forcollege">College</label>
    <input type="text" name="college" >
    <input type="submit" name ="register" value="Register">


    </form>
    <a href="seachcollege.php" >Search</a>
    <table border=1>

<thead>
    <tr>
        <th>No</th>
        <th>College name</th>
        <th>Actions</th>
    </tr>
</thead>

<?php
     require_once('dbconnection.php');
    $sql_select = mysqli_query($conn,"SELECT * FROM `colleges`");
    if($sql_select)
    {
        $no =1;
    while($row = mysqli_fetch_array($sql_select))
    {
        $college_id = $row['college_id'];
        ?>
        <tr>
        <td><?php echo $no?></td>
       <td><?php  echo $row['college_name'];?></td>
       <td> <a href="editcollege.php?collegeid=<?php echo $college_id;?>">Edit</a>
        | <a href="delete_college.php?collegeid=<?php echo $college_id;?>">Delete</a></td>
        </tr>
       <?php
       $no++;
    }
}
else{
    echo mysqli_error($conn);
}
?>
    </table>


</body>
</html>