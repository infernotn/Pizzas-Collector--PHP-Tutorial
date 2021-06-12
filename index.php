<?php
include('./config/db_connect.php');

//write query for all pizzas

$sql='SELECT title,ingredients,id FROM pizzas ORDER BY created_at';
//make query & get results
$results=mysqli_query($conn,$sql);
//fetch the relting rows as an array
$pizzas=mysqli_fetch_all($results,MYSQLI_ASSOC);
// free result from memory
mysqli_free_result($results);
//close connection
mysqli_close($conn);


?>
<!DOCTYPE html>
<html lang="en">


<?php include"./templates/header.php" ?>
<h4 class="center grey_text">Pizzas</h4>
<div class="container">
<div class="row">
<?php 
foreach($pizzas as $pizza){ ?>

<div class="col s6 md3">
<div class="card  z-depth-0">
<div class="card-content center">
<img src="img/pizza.svg" alt="pizza" class='img' >
<h6 class='card-title'><?php echo htmlspecialchars($pizza['title']); ?></h6>
<div> 
<ul>
<?php foreach(explode (',',$pizza['ingredients']) as $ingredient){ ?>
<li>
<?php echo htmlspecialchars($ingredient); ?>
</li>
 <?php  } ?>
 </div>
</ul>
</div>
<div class="card-action right-align">
<a href="details.php?id=<?php echo $pizza['id'] ?>" class="btn brand  ">More info</a>
</div>
</div>
</div> 
<?php } ?>

</div>
<?php if(count($pizzas)>=3): ?>
<p class="center">there are more or egale to 3 pizzas</p>
<?php  else : ?>
    <p class="center">there are less than 3 pizzas</p>
    <?php endif ?>
</div>
<?php include"./templates/footer.php" ?>



</html>