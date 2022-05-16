<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
</head>
<body>
    <?php
    require_once('admin_header.php');
  
    $conn = mysqli_connect('127.0.0.1','root','');
    $db = mysqli_select_db($conn,'dbu_lms');

    if(isset($_POST['register']))
    {
       $first_name = $_POST['firstname'];
       $middle_name = $_POST['middlename'];
       $last_name = $_POST['lastname'];
       $gender = $_POST['gender'];
       $college_id = $_POST['college_id'];
       $department_id = $_POST['department_id'];
       $role_id = $_POST['role_id'];
       $username = $_POST['username'];
       $sql_insert = mysqli_query($conn, " SELECT * FROM  `users` WHERE  `username` = '$username'");
       $sql_ckh = mysqli_num_rows($sql_insert);
       if($sql_ckh > 0)
       {
           echo "This user id is availble";

       }
       else
       {
         $sql_insert = mysqli_query($conn, "
        INSERT INTO `users`( `first_name`, `middle_name`, `last_name`,
         `gender`, `college_id`, `department_id`, `role_id`, `username`, 
         `password`) 
        VALUES ('$first_name','$middle_name','$last_name',
        '$gender','$college_id','$department_id','$role_id','$username',
        '123456789')");
         if($sql_insert)
         {
             echo "Succesfully registred";
         }
         else
         {
             echo mysqli_error($conn);
         }
        }
        
    }

    ?>
    <form action="" method="post">
    <label for="forfirstname">First name</label>
    <input type="text" name="firstname" >
    <label for="formiddlename">Middle name</label>
    <input type="text" name="middlename" >
    <label for="forlastname">last name</label>
    <input type="text" name="lastname" >
    <label for="forgender">Gender</label>
    <label for="forgender">Female</label>
    <input type="radio" name="gender" value="Female" >
    <label for="forgender">Male</label>
    <input type="radio" name="gender" value="Male" >
    <select name="college_id" required>
    <option value=""> select college</option>
        <?php
     
     $sql_select = mysqli_query($conn, "SELECT * FROM `colleges`");
     while($row = mysqli_fetch_array($sql_select))
     {
         ?>
<option value="<?php echo $row['college_id']?>">    <?php echo $row['college_name']?>
     </option>
         <?php
     }
 ?>
     
    </select>
    <select name="department_id" required>
    <option value=""> select department</option>
        <?php
     
     $sql_select = mysqli_query($conn, "SELECT * FROM `departments`");
     while($row = mysqli_fetch_array($sql_select))
     {
         ?>
<option value="<?php echo $row['departments_id']?>">    <?php echo $row['department_name']?>
     </option>
         <?php
     }
 ?>
     
    </select>
    <select name="role_id" required>
    <option value=""> select role</option>
        <?php
     
     $sql_select = mysqli_query($conn, "SELECT * FROM `tbl_role`");
     while($row = mysqli_fetch_array($sql_select))
     {
         ?>
<option value="<?php echo $row['role_id']?>">    <?php echo $row['role_name']?>
     </option>
         <?php
     }
 ?>
     
    </select>
    <input text="text" name="username">
    <input type="submit" name ="register" value="Register">


    </form>
    <a href="seachcollege.php" >Search</a>
    <table border=1>

<thead>
    <tr>
        <th>No</th>
        <th>First name</th>
        <th>Middle name</th>
        <th>Last name</th>
        <th>Gender</th>
        <th>College</th>
        <th>Department</th>
        <th>Role</th>
        <th>username</th>
        <th>password</th>
        <th>Actions</th>
    </tr>
</thead>

<?php
     require_once('dbconnection.php');
    $sql_select = mysqli_query($conn,"SELECT users.*, colleges.college_name,departments.department_name, tbl_role.role_name
    FROM users
    INNER JOIN colleges on colleges.college_id = users.college_id
    INNER JOIN departments on departments.departments_id = users.department_id
    INNER JOIN tbl_role ON tbl_role.role_id = users.role_id");
    if($sql_select)
    {
        $no =1;
    while($row = mysqli_fetch_assoc($sql_select))
    {
        $user_id = $row['user_id'];
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $college_id = $row['college_id'];
        $department_id = $row['department_id'];
        $role_id = $row['role_id'];
        $username = $row['username'];
        $password = $row['password'];
        ?>
        <tr>
        <td><?php echo $no?></td>
       <td><?php  echo $row['first_name'];?></td>
       <td><?php  echo $row['middle_name'];?></td>
       <td><?php  echo $row['last_name'];?></td>
       <td><?php  echo $row['gender'];?></td>
       <td><?php  echo $row['college_name'];?></td>
       <td><?php  echo $row['department_name'];?></td>
       <td><?php  echo $row['role_name'];?></td>

       <td><?php  echo $row['username'];?></td>
       <td><?php  echo $row['password'];?></td>
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