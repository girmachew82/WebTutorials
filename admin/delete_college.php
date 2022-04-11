<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <?php
    $conn = mysqli_connect('127.0.0.1','root','');
    $db = mysqli_select_db($conn,'dbu_lms');
    if(isset($_GET['collegeid']))
    {
        $coll_id = $_GET['collegeid'];
        $sql_delete = mysqli_query($conn,"DELETE FROM `colleges` WHERE college_id='$coll_id'");
        if($sql_delete)
        {
            echo "Deleted successfully";
        
        }
        else
        {
            echo mysqli_error($conn);
        }
    }
    ?>
</body>
</html>