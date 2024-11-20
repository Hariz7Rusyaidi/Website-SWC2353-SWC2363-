<?php
    
include("kdatabase_connect.php");?>

<?php 

if ($_SERVER["REQUEST_METHOD"] == 'POST') 
{
    $errors = array();
        
    if (empty($_POST['Post'])) 
    {
    $errors[] = 'You forgot to enter your post';
    }
    else 
    {
    $x = mysqli_real_escape_string($connect, trim($_POST['Post']));
    }

    $q = "INSERT INTO personalpost (Post)

    VALUES ('$x')";

    $result = @mysqli_query ($connect, $q); 

    if ($result) 
    {
    echo '<h1>Thank you</h1>';
    exit();
    } 
    else 
    {
    echo '<h1>ERORR</h1>';
    exit();
    }
}
?>