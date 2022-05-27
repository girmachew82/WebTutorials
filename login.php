<?php 
 session_start();
//connecting to the database 
$conn = mysqli_connect('127.0.0.1','root','');
// if($conn)
// {
//     echo "Connected";
// }
// else{
//     echo mysqli_error($conn);
// }

$db = mysqli_select_db($conn,'dbu_lms');
// if($db)
// {
//     echo "DB is selected ";
// }
// else
// echo mysqli_error($conn);

$username = $_POST['username'];
$password = $_POST['password'];

$sql_users = mysqli_query($conn,"SELECT * FROM `users` WHERE username ='$username' AND password ='$password' ");
if(mysqli_num_rows($sql_users) < 1)
{
 function usernotfound()
{
    return "No user is found";
}
header("location:login.html");
}
else{
while($row = mysqli_fetch_array($sql_users))
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
    $_SESSION["user_id"] = $row['user_id'];
    $_SESSION["firstname"] = $row['first_name'];
    $_SESSION["lastname"] = $row['last_name'];
  
    if ($role_id == 1)
    {
        header('location:student/student.php');
    }
    else if ($role_id == 2)
    {
        header('location:hod/index.php');
    }
    else if ($role_id == 3)
    {
        header('location:instructor/index.php');
    }
    else if ($role_id == 4)
    {
        header('location:registrar/index.php');
    }
    else if ($role_id ==5)
    {
        header('location:admin/index.php');
    }

 
}
}
?>