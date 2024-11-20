<?php 

include ("kdatabase_connect.php");?>

<?php

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) 
{
    $id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) 
{
    $id = $_POST['id'];
} else {
    echo '<p class="error">This page has been accessed in error.</p>';

    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $error = array();
    
    if (empty($_POST['UserName'])) 
    {
        $error[] = 'You forgot to enter your username.';
    }
    else 
    {
        $u = mysql_real_escape_string($connect, trim($_POST['UserName']));
    }

    if (empty($_POST['Password'])) 
    {
        $error[] = 'You forgot to enter your password.';
    }
    else 
    {
        $p = mysql_real_escape_string($connect, trim($_POST['Password']));
    }

    if (empty($_POST['Email'])) 
    {
        $error[] = 'You forgot to enter the email';
    } 
    else 
    {
        $e = mysql_real_escape_string($connect, trim($_POST['Email']));
    }

}

if (!empty($error)) 
{
    
$q = "SELECT FROM login WHERE UserName='$u', Password='$p', Email='$e',;

$result = @mysqli_query($connect, $q);

if (mysql_num_rows($result) == 0) 
{
    $q ="UPDATE account SET UserName='$u' , Password='$p' ,  Email='$e' ;
}

$result = @mysqli_query($connect, $q);

if (mysqli_affected_rows($connect) == 1);
{
    echo "<h3>The user has been edited</h3>";
}
else 
{
    echo "<p class='error'>The user has not been edited due to the system error. We apologize for any inconvenience.</p>";
    echo '<p>' .mysqli_error($connect). '<br/> query: ' .$q. '</p>';
}
else
{
    echo "<p class='error'>The no id has already been registered.</p>";
}
else
{
    echo "<p class='error'>The following error occurred:</p>";
    foreach ($error as $msg)
    {
        echo " -$msg<br/> \n ";
    }
    echo '</p><p>Please try again</p>';
}
}

$q ="SELECT UserName, Password, Email FROM account WHERE ID=$id";
$result = @mysqli_query ($connect, $q);


mysqli_close ($connect);

?>