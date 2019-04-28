<?php

session_start(); 

require 'connect.php';

function getTitle() {
	echo 'Shopping';
}

include 'partials/head.php';?>

</head>
<body>

	<!-- main header -->
	<?php include 'partials/main_header.php'; ?>

	<?php

	if (isset($_GET['category']) && $_GET['category']!='All') {
	$cat = $_GET['category'];

	if($cat=='Rice') {
		$query = "WHERE category_id = 1";
	} else if ($cat=='Meat') {
		$query = "WHERE category_id = 2";
	} else if ($cat=='Price: Low to High') {
		$query = "ORDER BY price_retail";
	} else if ($cat=='Price: High to Low') {
		$query = "ORDER BY price_retail DESC";
	}

	} else {
		$query = "";
	}

	$sort = array("0"=>"Price: Low to High", "1"=>"Price: High to Low", "2"=>"Rice", "3"=>"Meat");
	?>

	<div class="container-fluid">
		<div class="row">
	<form method="GET" id="myForm" class="col-lg-3">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Filter by: </h4></div>
			<div class="panel-body">
		<select class="form-control" name="category" onchange="myForm()">
			<option>All</option>
			<?php
				foreach ($sort as $key => $value) {

					if ($value==$_GET['category']) {
						echo '<option selected>'.$value.'</option>';	
					} else {
						echo '<option>'.$value.'</option>';
					}
				}		
			?>
		</select>
	</div>
	<div class="panel-heading text-right">
		<p><a href="grocery_bag.php">Check your grocery bag?</a></p>
	</div>	
</div>
	</form>

	<div class="col-lg-9">	
	<?php
	$sql = "select * from products $query";				
	$result = mysqli_query($conn, $sql);
	while($product = mysqli_fetch_assoc($result)){
		extract($product);
		echo '<div class="card text-center" style="width: 20rem; display: inline-block; margin:20px;">
			<img class="img-responsive" src="'.$product_image.'">
			<div class="card-block">
			<h4 class="card-title" id="itemName'.$id.'"><strong>'.$name.'</strong></h4>
			<div class="card-text"><h5>PHP '.$price_retail.' per (kg)</h5></div>
			<div><input class="text-center" id="itemQuantity'.$id.'" type="number" name="quantity" value="1" size="4" style="width: 4em;" /><input type="submit" value="Add to cart" class="btnAddAction" onclick="addToCart('.$id.')"/></div>
			</div>
		</div>';
	}
?>
	</div>
</div>
</div>

	<!-- main footer -->
	
	<?php include 'partials/main_footer.php'; ?>

	<?php include 'partials/foot.php';
		  mysqli_close($conn);
	 ?>



	 <script type="text/javascript">
	 	$(document).ready(function(){
	 		 
	 	})
	 	function myForm(){
	 		document.getElementById('myForm').submit();
	 	}

	 	function addToCart(itemId) {
	 		// console.log(itemId);
	 		var id = itemId;

	 		// retrieve value of item quantity
	 		var quantity = $('#itemQuantity' + id).val();
	 		var name = $('#itemName' + id).html();
	 		// console.log(name);
	 		$.bootstrapGrowl('<strong><span style="color: red;">'+ quantity + ' (kg)</span></strong> of ' + name + ' has successfully added to your cart.',{
	 			type: 'warning'
	 		});

	 		// create a post request to update session cart variable
	 		$.post('assets/add_to_cart.php',
	 			{
	 				item_id: id,
	 				item_quantity: quantity 
	 			},
	 			function(data, status) {
	 				
 					$('.badge').html(data);
	 				// if(data == 'not') {
	 				// 	window.location='login.php';
	 				// } else {
	 				// }			
	 				

	 			});

	 	}
	 </script>

	 
</body>
</html>