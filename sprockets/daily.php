<?php include 'includes/config.php'?>

<?php
//daily php code goes here

if(isset($_GET['day']))
{//show selected day
	$day = $_GET['day'];
}else{//show current day
	$day = date('l');
}

?>
<?php get_header()?>
<h3>Daily</h3>
<p>The contentof day is currently: <?=$day?></p>
<p><a href="?day=Monday">Monday</a></p>
<p><a href="?day=Tuesday">Tuesday</a></p>
<p><a href="?day=Wednesday">Wednesday</a></p>


<?php get_footer()?>