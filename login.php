<?php


if(isset($_POST['login'])){

session_start();
$_SESSION['name']=empty($_POST["name"])? 'guest':$_POST["name"];
header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>
<div class="container  ">
<form action="login.php" method="POST" class=" white  center">
<input type="text" name="name"  placeholder='enter your name' class='center'>
<input type="submit" name="login" value="Login" class="brand btn">

</form>
</div>

<?php include('templates/footer.php'); ?>
</html>