<?php
session_start();
?>
<style>
    /* unvisited link */
a:link {
  color: #000000;
}

/* visited link */
a:visited {
  color: #00FF00;
}

/* mouse over link */
a:hover {
  color: #FF00FF;
}

/* selected link */
a:active {
  color: #0000FF;
}
a {
    text-decoration: none;
    padding: 10px;
    color: #FFFFFF;
}
nav {
    background-color: #123456;
}
</style>
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