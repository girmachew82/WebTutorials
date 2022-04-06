<?php 
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
$sql_users = mysqli_query($conn,"SELECT * FROM `users`");

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
    if ($role_id ==1)
    {
        include_once('student.php');
    }
    else if ($role_id ==2)
    {
        echo "HOD";
    }
    else if ($role_id ==3)
    {
        echo "Instructor";
    }
    else if ($role_id ==4)
    {
        echo "Registrar";
    }
}
?>