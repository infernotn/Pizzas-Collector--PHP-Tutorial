<?php 
include('./config/db_connect.php');

//delete from db
if(isset($_POST['delete'])){
 
$id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);

$sql="DELETE FROM pizzas WHERE id=$id_to_delete";

if(mysqli_query($conn,$sql)){
    header("location:index.php");

}
else {
    echo "error : ". mysqli_error($conn);
}

}

//check GET request id param
if(isset($_GET['id'])){


    $id=mysqli_real_escape_string($conn,$_GET['id']);
    //make sql
    $sql="SELECT * FROM pizzas WHERE id=$id";
    //get query results
    $result=mysqli_query($conn,$sql);
    //fetch result
    $pizza=mysqli_fetch_assoc ( $result ) ;

    mysqli_free_result($result);
    mysqli_close($conn);
  
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

<div class="container center white">
<?php if(isset($pizza)): ?>
<h4> <?php echo htmlspecialchars($pizza['title']) ?></h4>
<p><strong>created by :</strong> <?php echo htmlspecialchars($pizza['email']) ?></p>
<p><?php echo date($pizza['created_at']) ?></p>
<strong>ingredients : </strong>
<ul>
<?php foreach (explode (',',$pizza['ingredients']) as $ing){ ?>
<li><?php echo htmlspecialchars($ing); ?> </li>
<?php }?>
</ul>

<!--delete form -->
<form action="details.php" method='POST'>
<input type="hidden" name="id_to_delete" value="<?php echo $_GET['id'] ?>">
<input type="submit" name="delete" value="Delete" class="btn brand">
</form>


<?php else: ?>


<?php endif ?>




</div>

<?php include('templates/footer.php'); ?>
</html>