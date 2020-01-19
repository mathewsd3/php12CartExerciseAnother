<?php
// begin the session
session_start();
var_dump($_SESSION);

//Add one item the cart 
function addone($cart ,$name){
  if(isset($cart[$name]))
  $cart[$name]+=1;
	else
  $cart[$name]=1;	
  $_SESSION['cart']=$cart;	
}

//Add one item from the cart  
function removeone($cart ,$name){
  if(isset($cart[$name]))
	if($cart[$name]!=0)
		$cart[$name]-=1;
  $_SESSION['cart']=$cart;	
}

//Remove all the items from the car
function removeall($cart ,$name){
  if(isset($cart[$name]))
	$cart[$name]=0;
  $_SESSION['cart']=$cart;	
}

// Empty the cart
function emptycart(){
	unset($_SESSION['cart']);
}

// Check if I have a cart on the Session
if(isset($_SESSION['cart']))
	$cart=$_SESSION['cart'];
else
	$cart=array();

// Check the URL params
if(isset($_GET["key"])&&isset($_GET["action"])){
  $name=$_GET["key"];
  $action=$_GET["action"];
  //Check the action
  if($action=='add'){
    addone($cart ,$name);
  }else if($action=='removeOne'){
	removeone($cart ,$name);  
  }else if($action=='removeAll'){
	removeall($cart ,$name);  
  }
}elseif(isset($_GET["action"])){//Empty all case	
	if($_GET["action"]=='empty'){
		emptycart();  
}
}

?>
 
<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
crossorigin="anonymous">
  <style>
    td{
      text-align:center;
    }
  </style>
</head>

<body>
<hr>
<div class="container">

<div class="alert alert-primary" role="alert">
Exercise - cart
</div>

<div>
<table border='1'>
<tr>
<th> add to basket</th>
<th>remove from basket</th>
<th>remove all</th>
<th>numbers</th>
</tr>
<tr>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=apple&action=add";?>">an apple</a></td>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=apple&action=removeOne";?>">an apple</a></td>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=apple&action=removeAll";?>">all the apples</a></td>
<td>apples:<?php echo (isset($_SESSION['cart']['apple']) ?  $_SESSION['cart']['apple'] : 0);?></td>
</tr>
<tr>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=banana&action=add";?>">a banana</a></td>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=banana&action=removeOne";?>">a banana</a></td>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=banana&action=removeAll";?>">all the banana</a></td>
<td>banana:<?php echo (isset($_SESSION['cart']['banana']) ?  $_SESSION['cart']['banana'] : 0);?></td>
</tr>
<tr>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=pear&action=add";?>">a pear</a></td>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=pear&action=removeOne";?>">a pear</a></td>
<td><a href="<?php echo $_SERVER['PHP_SELF']."?key=pear&action=removeAll";?>">all the pears</a></td>
<td>pear:<?php echo (isset($_SESSION['cart']['pear']) ?  $_SESSION['cart']['pear'] : 0);?></td>
</tr>

<tr>
<td colspan="4" ><a href="<?php echo $_SERVER['PHP_SELF']."?action=empty";?>">empty cart</a></td>
</tr>

</table>
</div>