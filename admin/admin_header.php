<?php
session_start();
?>
<header>
<nav>
<?php
if(isset($_SESSION['user_id']))
 {
?>
<a href="index.php">Home</a>
<a href="college.php">College</a>
<a href="department.php">Department</a>
<a href="users.php">Users</a>
<a href="role.php">Role</a>
<a href="../logout.php" >Logout</a>
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