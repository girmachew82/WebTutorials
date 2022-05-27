<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>course</title>
</head>
<body>
    <?php
    require_once('header.php');
  
    $conn = mysqli_connect('127.0.0.1','root','');
    $db = mysqli_select_db($conn,'dbu_lms');

    if(isset($_POST['register']))
    {
       $course_id = $_POST['course_id'];
       $day = $_POST['day'];
       $department_id = $_POST['department_id'];
       $session = $_POST['session'];
       $sql_insert = mysqli_query($conn, " SELECT * FROM  `schedule`
        WHERE  `day` = '$day' AND `department_id` ='$department_id' AND 
        `session` = '$session'");
       $sql_ckh = mysqli_num_rows($sql_insert);
       if($sql_ckh > 0)
       {
           echo "This schedule is availble";

       }
       else
       {
         $sql_insert = mysqli_query($conn, "
         INSERT INTO `schedule`( `day`, `course_id`, `department_id`,`session`)
          VALUES ('$day','$course_id','$department_id','$session')");
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
    <label for="forday">Day</label>
 
 
 <select name="day" required>
 <option value=""> select day</option>
 <option value="Moday"> Moday</option>
 <option value="Tuesday"> Tuesday</option>
 <option value="Wednesday"> Wednesday</option>
 <option value="Thursday"> Thursday</option>
 <option value="Friday">Friday</option>
 </select>
    <label for="forcourse">Course</label>
 
    <select name="course_id" required>
    <option value=""> select course</option>
    <?php
     
     $sql_select = mysqli_query($conn, "SELECT * FROM `course`");
     while($row = mysqli_fetch_array($sql_select))
     {
         ?>
<option value="<?php echo $row['course_id']?>">    <?php echo $row['course_title']?>
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
    <label for="forsession">Session</label>
 
 
 <select name="session" required>
 <option value=""> select session</option>
 <option value="lab"> Lab</option>
 <option value="Lecture"> Lecture</option>

 </select>
 
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