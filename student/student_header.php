<?php
session_start();
?>
<header>
<nav>
<a href="student.php">Home</a>
<a href="">Course</a>
<?php
if(isset($_SESSION['user_id']))
 {
?>
<a href="attendance.php">Attendance</a>
<a href="../logout.php">Logout</a>
<a>Welcome <?php echo $_SESSION['firstname']." ". $_SESSION['lastname'];?></a>
<?php
 }
 else
 {
     ?>
<a href="../login.html" >Login</a>
<?php
 }
?>

</nav>
</header>