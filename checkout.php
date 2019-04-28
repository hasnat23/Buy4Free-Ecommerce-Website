<?php

session_start();
require "connect.php"; 

function getTitle() {
	echo 'Checkout';
}

$url = parse_url($_SERVER['HTTP_REFERER']);
// var_dump(basename($url['path']));
if(basename($url['path'])=='grocery_bag.php' || basename($url['path'])=='login.php' || basename($url['path'])=='checkout.php'){

} else {
	header('location: grocery_bag.php');	
}

include 'partials/head.php';

$login = 'style="display:visible;"';
$guest = 'style="display:visible;"';

if(isset($_SESSION['email'])) {
	unset($_SESSION['checkout']);
	$guest = 'style="display:none;"';
	$email = $_SESSION['email'];
	$sql = "SELECT * FROM customers WHERE email='$email'";
	$result = mysqli_query($conn, $sql);
} else {
	$_SESSION['checkout'] = 'checkout';
	$login = 'style="display:none;"';
}

?>

</head>
<body>
	<!-- main header -->
	<?php include 'partials/main_header.php'; ?>

	<div class="container">
		<div class="row">
			<?php
				$sql = "SELECT products.id, products.product_image, products.name, products.price_retail, cart.quantity FROM cart INNER JOIN products ON cart.product_id=products.id";				
				$result2 = mysqli_query($conn, $sql);
				$totalAmount = 0;
			?>
			<div class="col-md-5">
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Order Summary</h3>
				  </div>
				  <div class="panel-body">
				  	<div class="table-responsive"> 
					    <table class="table table-striped table-condensed table-responsive">
					    	<thead>
					    		<th>Product</th>
					    		<th>Quantity</th>
					    		<th>Subtotal</th>
					    	</thead>
					    	<tbody>
					    		<?php
					    		
					    		while ($product = mysqli_fetch_assoc($result2)) {
					    			extract($product);
					    			$subtotal = $price_retail * $quantity;
					    			$totalAmount += $subtotal;
					    			echo '
					    			<tr>
					    				<td><strong>'.$name.'</strong></br>PHP <span id="itemPrice'.$id.'">'.$price_retail.'</span></td>
					    				<td>'.$quantity.' (kg)</td>
					    				<td>PHP <span id="price'.$id.'">'.number_format($subtotal).'</span></td>
					    			</tr>
					    			';
					    		}
					    		?>
					    	</tbody>
					    </table>
					</div>
					<?php echo '<div class="text-right"><h3> Total: PHP '.number_format($totalAmount).'</h3>';
					echo '<small>Total weight: '.$_SESSION['item_count'].'</small></div>';?>	
				  </div>
				</div>
			</div>

				<div class="col-md-5 col-md-offset-1" <?php echo $login; ?>>
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Shipping Details</h3>
						  </div>
						  <div class="panel-body">
						    <?php
						    $customer = mysqli_fetch_assoc($result);
						    extract($customer);
						    ?>
						    <p><a href="#editUserModal" data-toggle="modal" data-target="#editUserModal" data-index="<?php echo $id; ?>" id="editUser">Edit shipping details?</a></p>
						    <?php
						    echo 'Name: '.ucfirst($first_name).' '.ucfirst($last_name).'</br>';
						    echo 'Email: '.$email.'</br>';
						    echo 'Mobile #: 0'.$sms.'</br>';
						    echo 'Delivery Address: '.$address;
						    ?>
						  </div>
						</div>
				<!-- <button type="button" class="btn btn-md btn-gold pull-right"><span class="glyphicon glyphicon-lock"></span><a href="order_confirmation.php"> Place your order</a></button> -->
				<a href="assets/process_order.php" class="btn btn-md btn-gold pull-right" role="button"><span class="glyphicon glyphicon-lock"></span> Place your order</a>
				</div>

				<div class="col-md-6 col-md-offset-1" <?php echo $guest; ?>>
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Shipping Details</h3>
						  </div>
						  <div class="panel-body">
						  	<p>Registered customer?<br><a href="login.php"> Log in here</a></p><br>
						  	<form method="post" id="guest_form" action="assets/process_order.php" onsubmit="return validateForm()">
						  		<div class="form-group">
						  				<div class="form-group">
							  				<label for="full_name">First and Last Name</label>
							  				<div class="input-group">
							  					<div class="input-group-addon addon-dif-color">
													<span class="glyphicon glyphicon-user"></span>
												</div>
							  					<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name" required>
							  				</div>
						  				</div>

						  				<div class="form-group">
							  				<label for="email">Email Address</label>
									  		<div class="input-group">
									  			<div class="input-group-addon addon-dif-color">
													<span class="glyphicon glyphicon-envelope"></span>
												</div>
									  			<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
									  		</div>
								  		</div>

								  		<div class="form-group">
								  			<label for="sms">Mobile Number</label>
									  		<div class="input-group">
									  			<div class="input-group-addon addon-dif-color">
													+63
												</div>
									  			<input type="text" class="form-control" name="sms" id="sms" placeholder="9XXXXXXXXX" required>
									  		</div>
								  		</div>

								  		<div class="form-group">
								  			<label for="address">Complete Address</label>
									  		<div class="input-group">
									  			<div class="input-group-addon addon-dif-color">
													<span class="glyphicon glyphicon-home"></span>
												</div>
									  			<textarea type="text" class="form-control" name="address" id="address" placeholder="Delivery Address" rows="3" style="resize: none;" required></textarea>
									  		</div>
								  		</div>


		  						<button type="submit" name="orderBtn" class="btn btn-md btn-gold pull-right" id="orderBtn"><span class="glyphicon glyphicon-lock"></span> Place your order</button>
						  		</div>
						  	</form>
						  </div>
						</div>
				</div>
		</div>
	</div>

		<!-- Edit Modal -->
	<div id="editUserModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">
	  		
	    <!-- Modal content-->
	  	<form method="POST" action="assets/update_user.php">
	  	<input hidden name="user_id" value="<?php echo $id; ?>" style="display: none;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Edit Personal Details</h4>
	      </div>
	      <div id="editUserModalBody" class="modal-body">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="submit" class="btn btn-green">Save</button>
	      </div>
	    </div>
	  	</form>

	  </div>
	</div>

	<!-- main footer -->
	<?php include 'partials/main_footer.php'; 
	mysqli_close($conn);?>

	<?php include 'partials/foot.php'; ?>

	<script type="text/javascript">
		var fname = false;
		var sms = false;
		var email = false;

		$(document).ready(function(){

			$('#editUser').on('click',function(){
				var userID = $(this).data('index');
				
				$.get('assets/edit_user.php',
					{
						id: userID,
						ck: 1

					},
					function(data, status) {
						$('#editUserModalBody').html(data);
					});
			});

			$('#full_name').keyup(function(){
				var regexp = new RegExp(/^[a-zA-Z .]+$/);
				if(regexp.test($('#full_name').val())) {
					$('#full_name').closest('.form-group').removeClass('has-error');
					$('#full_name').closest('.form-group').addClass('has-success');
					fname = true;
				} else {
					$('#full_name').closest('.form-group').addClass('has-error');
					fname = false;
				}
			})

			$('#email').keyup(function(){
				var regexp = new RegExp(/^[a-zA-Z0-9._]+@[a-zA-Z0-9._]+\.[a-zA-Z]{2,4}$/);
				var emailText = $(this).val();
				$('[for="email"]').html("Email Address");
				if(regexp.test(emailText)) {
					$('#email').closest('.form-group').removeClass('has-error');
					$('#email').closest('.form-group').addClass('has-success');
					email = true;
				} else {
					$('#email').closest('.form-group').addClass('has-error');
					email = false;
				}

			$.post('assets/email_validation.php',
				{ email: emailText },
				function(data, status) {
					// console.log('Processed: ' + data);
					if(data.length > 0){
						$('[for="email"]').html(data);
						$('#email').closest('.form-group').addClass('has-error');
						email = false;	
					}
					
				});
			})

			$('#sms').keyup(function(){
				var regexp = new RegExp(/^[9][0-9]{9}$/);
				var smsText = $(this).val();
				$('[for="sms"]').html("Mobile Number");
				if(regexp.test(smsText)) {
					$('#sms').closest('.form-group').removeClass('has-error');
					$('#sms').closest('.form-group').addClass('has-success');
					$('[for="sms"]').html('<span style="color:green;">Valid</span> Mobile Number');
					sms = true;
				} else {
					$('#sms').closest('.form-group').addClass('has-error');
					$('[for="sms"]').html('<span style="color:red;">Invalid</span> Mobile Number');
					sms = false;
				}

				$.post('assets/sms_validation.php',
					{ sms: smsText },
					function(data, status) {
						// console.log('Processed: ' + data);
						if(data.length > 0){
							$('[for="sms"]').html(data);
							$('#sms').closest('.form-group').addClass('has-error');
							sms = false;	
						}
						
					});
			})
		})

		function validateForm() {
			if(!fname || !email || !sms) {
				// errorMessage();
				return false;
			} else {
				// alert('Congratulations!');
				return true;
			}
		}

	</script>

</body>
</html>