<?php include 'includes/header.php'?>
<?php
//adder.php

if (isset($_POST['num1']))
{
  	$num1 = $_POST['num1'];
  	$num2 = $_POST['num2'];
  	$myTotal = $num1 + $num2;
  	echo "<h2 align=center>You added <font color=blue>". $num1 ."</font> and ";
  	echo "<font color=blue>" . $num2 . "</font> and the answer is <font color=red>" . $myTotal . "</font>!";
  	echo "<br><a href=" . $_SERVER['PHP_SELF'] . ">Reset page</a>";
        
}else{//show form
    echo '
    <div class="bg-faded p-4 my-4">
        <hr class="divider">
        <h2 class="text-center text-lg text-uppercase my-0">V.2 
          <strong>Adder.PHP</strong>
        </h2>
        <hr class="divider">
        <form action=' . $_SERVER['PHP_SELF'] . ' method="post" >
          <div class="row">
            <div class="form-group col-lg-4">
              <label class="text-heading">Enter the first Number here: </label>
              <input 
              type="number"
              required="required"
              name="num1" 
              class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-lg-4">
              <label class="text-heading">Enter the second number here:</label>
              <input 
              type="number" 
              required="required" 
              name="num2" 
              class="form-control">
            </div>
            <div class="form-group col-lg-12">
              <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    ';
  }  
?>
<?php include 'includes/footer.php'?>

