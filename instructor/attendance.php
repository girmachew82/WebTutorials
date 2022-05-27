<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>attendance</title>
</head>
<body>
    <?php
    require_once('header.php');
  
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
    <label for="forfirstname">Date</label>
    <input type="date" name="date" >
   
    <input type="submit" name ="show" value="show">


    </form>
    <table border=1>

<thead>
    <tr>
        <th>No</th>
        <th>First name</th>
        <th>Middle name</th>
        <th>Last name</th>
        <th>Gender</th>
        <th>Actions</th>
    </tr>
</thead>

<?php
    $sql_select = mysqli_query($conn,"SELECT
    `attendance`.*,
    users.user_id,
    users.first_name,
    users.middle_name,
    users.last_name,
    users.gender,
    course.course_title
    FROM attendance
INNER JOIN users ON users.user_id = attendance.student_id
INNER JOIN course ON course.course_id = attendance.course_id
WHERE
    DATE = '2022-05-27'");
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
        ?>
        <tr>
        <td><?php echo $no?></td>
       <td><?php  echo $row['first_name'];?></td>
       <td><?php  echo $row['middle_name'];?></td>
       <td><?php  echo $row['last_name'];?></td>
       <td><?php  echo $row['gender'];?></td>

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