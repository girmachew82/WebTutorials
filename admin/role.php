<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role</title>
</head>
<body>
    <?php
    require_once('admin_header.php');
  
    $conn = mysqli_connect('127.0.0.1','root','');
    $db = mysqli_select_db($conn,'dbu_lms');

    if(isset($_POST['register']))
    {
       $role_name = $_POST['role'];
       echo $role_name;
        $sql_insert = mysqli_query($conn, "INSERT INTO
         `tbl_role`(`role_name`) VALUES ('$role_name')");
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
    <label for="forrole">Role</label>
    <input type="text" name="role" >
    <input type="submit" name ="register" value="Register">


    </form>
    <a href="seachcollege.php" >Search</a>
    <table border=1>

<thead>
    <tr>
        <th>No</th>
        <th>Role name</th>
        <th>Actions</th>
    </tr>
</thead>

<?php
     require_once('dbconnection.php');
    $sql_select = mysqli_query($conn,"SELECT * FROM `tbl_role`");
    if($sql_select)
    {
        $no =1;
    while($row = mysqli_fetch_assoc($sql_select))
    {
        $role_id = $row['role_id'];
        ?>
        <tr>
        <td><?php echo $no?></td>
       <td><?php  echo $row['role_name'];?></td>
       <td> <a href="editrole.php?roleid=<?php echo $role_id;?>">Edit</a>
        | <a href="delete_role.php?roleid=<?php echo $role_id;?>">Delete</a></td>
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