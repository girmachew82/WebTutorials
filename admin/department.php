<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
</head>
<body>
    <?php
    require_once('admin_header.php');
    require_once('dbconnection.php');
    $college_id =null;
    $department_name = null;
    if(isset($_POST['register']))
    {
       $college_id = $_POST['college_id'];
       $department_name = $_POST['department_name'];
       $sql_check = mysqli_query($conn,"SELECT * FROM `departments`WHERE department_name ='$department_name'");
       $no_rows = mysqli_num_rows($sql_check);
       if($no_rows >0)
       {
           echo "Exist";

       }
       else{
        $sql_insert = mysqli_query($conn,"INSERT INTO `departments`
        (`department_name`, `college_id`)
         VALUES ('$department_name','$college_id')");
         if($sql_insert)
         {
             echo "Successfully inserted";
         }
         else{
             echo mysqli_error($conn);
         }
    }
}
    ?>
    <form action="" method="post">
       <label for="college_id">College</label> 
       <select name="college_id" > 
        <option> Select college</option>
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
       <label for="departmentname">Department</label>
       <input type="text" name ="department_name">
       <br>
    <button type="submit" name ="register">Register</button>


    </form>
    <table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Department</th>
            <th>College</th>
            <th colspan="2">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql_select = mysqli_query($conn,"SELECT departments.*, colleges.college_name
        FROM departments
        INNER JOIN colleges on colleges.college_id = departments.college_id");
        $no=1;
        echo mysqli_error($conn);
        while($row = mysqli_fetch_array($sql_select))
        {
           ?> 
           <tr>
            <td><?php echo $no?></td>   
            <td><?php echo $row['department_name']?></td>
            <td><?php echo $row['college_name']?></td> 
            <td><a href="editdepartment.php?department_id=<?php echo $row['departments_id']?>" >Edit</a></td>
            <td><a href="deletedepartment.php?department_id=<?php echo $row['departments_id']?>" >Delete</a> </td>

            </tr>
            <?php
            $no++;
        }
       
        ?>
    </tbody>
</table>
</body>
</html>