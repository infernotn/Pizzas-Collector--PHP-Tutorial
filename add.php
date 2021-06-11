<?php

include('./config/db_connect.php');


$email='';
$title='';
$ingredients='';
$errors=array('email'=>'','title'=>'','ingredients'=>'');

if(isset($_POST['submit'])){

    //email validation

   if (empty($_POST["email"])){
    $errors['email']= "an email is required <br/>";
   }
   else { 
       $email=$_POST['email'];
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
      
        $errors['email']= "a correct email is required <br/>"; 
       }
   }
 //title validation

   if (empty($_POST["title"])){
    $errors['title']= "a title is required <br/>";
    }
    else { 
    $title=$_POST['title'];
    if(!preg_match('/^[a-zA-Z\s]+$/',$title)){
   
        $errors['title']= "a correct title is required <br/>"; 
    }
}
//ingredients validation

if (empty($_POST["ingredients"])){
    $errors['ingredients']= "a ingredients is required <br/>";
}
else { 
    $ingredients=$_POST['ingredients'];
    if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/',$ingredients)){
   
        $errors['ingredients']= "a correct ingredients is required <br/>"; 
    }
}
if( !array_filter($errors)){
    
$email=mysqli_real_escape_string($conn,$_POST['email']);
$title=mysqli_real_escape_string($conn,$_POST['title']);
$ingredients=mysqli_real_escape_string($conn,$_POST['ingredients']);

//create sql
$sql="INSERT INTO pizzas(title,email,ingredients) VALUES('$title','$email','$ingredients') ";
//save to db and check

if(mysqli_query($conn,$sql)){
//success
header('location:index.php');
}else {
    //error
    echo 'query error : '. mysqli_error($conn);}

}

}



?>
<!DOCTYPE html>
<html lang="en">


<?php include"./templates/header.php" ?>
<section class="container white  grey-text" >
<h4 class="center"> Add a Pizza</h4>
<form action="add.php" method="POST" class="white">
<label >Your email :</label>
<input type="text" name="email" value='<?php echo htmlspecialchars($email) ?>'>
<p class='red-text'> <?php echo $errors['email'] ?></p>
<label >Pizza Title : </label>
<input type="text" name="title" value='<?php echo htmlspecialchars($title) ?>'>
<p class='red-text'> <?php echo $errors['title'] ?></p>
<label >Ingredients :</label>
<input type="text" name="ingredients" value='<?php echo htmlspecialchars($ingredients) ?>'>
<p class='red-text'> <?php echo $errors['ingredients'] ?></p>
 <div class="center">
 <input class="btn brand" type="submit" value="submit" name="submit">
 </div>
</form>

</section>
<?php include"./templates/footer.php" ?>



</html>