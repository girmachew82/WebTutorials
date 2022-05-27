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
       $coursetitle = $_POST['coursetitle'];
       $coursecode = $_POST['coursecode'];
       $chr = $_POST['chr'];
       $year = $_POST['year'];
       $semester = $_POST['semester'];
       $department_id = $_POST['department_id'];
       $category = $_POST['category'];
       $sql_insert = mysqli_query($conn, " SELECT * FROM  `course` WHERE  `coursecode` = '$coursecode'");
       $sql_ckh = mysqli_num_rows($sql_insert);
       if($sql_ckh > 0)
       {
           echo "This course is availble";

       }
       else
       {
         $sql_insert = mysqli_query($conn, "
         INSERT INTO `course`( `course_title`, `course_code`, `chr`, `year`, `semester`,
          `department_id`,
          `category`) VALUES ('$coursetitle','$coursecode','$chr','$year',
          '$semester','$department_id','$category')");
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
    <label for="forcoursetitle">course Title</label>
    <input type="text" name="coursetitle" >
    <label for="forcoursecode">Course code</label>
    <input type="text" name="coursecode" >
    <label for="forcrh">Credit hour</label>
    <input type="text" name="chr" >
    <label for="foryear">Year</label>
 
 <select name="year" required>
 <option value=""> select year</option>
 <option value="1"> 1<sup>st</sup></option>
 <option value="2"> 2<sup>nd</sup></option>
 <option value="3"> 3<sup>rd</sup></option>
 <option value="4"> 4<sup>th</sup></option>
 <option value="5"> 5<sup>th</sup></option>
 <option value="6"> 6<sup>th</sup></option>
 </select>
    <label for="forgender">Semester</label>
 
    <select name="semester" required>
    <option value=""> select semester</option>
    <option value="I"> I</option>
    <option value="II"> I</option>
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
    <label for="category">Category</label>
    <select name="category" required>
    <option value=""> select category</option>
    <option value="major"> Major</option>
    <option value="mainor"> Mainor</option>
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