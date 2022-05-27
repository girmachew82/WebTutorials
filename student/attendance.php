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
    require_once('student_header.php');
  
    $conn = mysqli_connect('127.0.0.1','root','');
    $db = mysqli_select_db($conn,'dbu_lms');

    if(isset($_POST['attend']))
    {
        foreach($_POST['schedule_id'] as $schid => $schedule_id)
        {
            echo $_SESSION['user_id'];
            $user_id = $_SESSION['user_id'];
            echo $schedule_id;
            $date= date('Y/m/d');
           
            $sql_insert = mysqli_query($conn,"INSERT INTO `attendance`
            ( `student_id`, `course_id`, `date`)
             VALUES ('$user_id','$schedule_id','$date')");
             if($sql_insert)
             {
                echo "You attended this course";
             }
             else
             {
                 echo "Something want wrong";
             }
            
        }
      
    }

    ?>
    <form action="" method="post">
        <table border=1>
        <thead>
            <tr>
                <th>No</th>
                <th>Course title</th>
                <th>Action</th>
            </tr>
        </thead>
    <?php

    $day = "Friday";
    $sql_select = mysqli_query($conn, " SELECT SCHEDULE.schedule_id,course.course_title
    FROM SCHEDULE
    INNER JOIN course ON course.course_id = schedule.course_id
    WHERE `day` = '$day' ");
        $no=1;
        while($row  = mysqli_fetch_array($sql_select))
        {
            $schedule_id = $row['schedule_id'];
            $user_id = $_SESSION['user_id'];
            $date= date('Y/m/d');
            $sql_select_att = mysqli_query($conn,"SELECT * FROM `attendance`
            WHERE `student_id`='$user_id' AND `course_id`= '$schedule_id'AND `date`='$date'");
        if(mysqli_num_rows( $sql_select_att) <=2)
        {
        ?>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row['course_title']?></td>
            <td>
                <input type="hidden" name ="schedule_id[]" value="<?php echo $schedule_id  ?>">
                <input type="checkbox" name ="attend<?php echo $schedule_id  ?>">
            
            </td>
        </tr>
        <?php
         }
         else
         {
             ?>
             <tr>
                 <td colspan="3"><?php echo "you may attended all"; ?></td>
             </tr>
            <?php 
         }
        $no++;
        }
    
    ?>
    <tr>
        <td>
        <input type="submit" name ="attend" value="Attend">
        </td>
    </tr>

    
    </table>
    </form>
 

</body>
</html>