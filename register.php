<?php

session_start(); 

function getTitle() {
	echo 'Register';
}
if (isset($_GET['msg'])) {
	$message = $_GET['msg'];

} else {
	$message = '';
}

include 'partials/head.php';?>



</head>
<body>
	<!-- main header -->
	<?php include 'partials/main_header.php'; ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-5 col-md-6 col-sm-8 col-centered">
				<div id="validation-message">
				    <?php
				        echo '<div>'.$message.'</div>';
				     ?>
				</div>
				<div class="panel panel-default">	
					<div class="panel-heading"><h4>Sign up</h4></div>
						<div class="panel-body">

							<form method="post" id="registrationForm" action="assets/registration.php" onsubmit="return validateForm()">
								<div class="row">
									<div class="form-group col-lg-6 col-md-6">
										<label for="first_name">First Name</label>
										<div class="input-group">
											<div class="input-group-addon addon-dif-color">
												<span class="glyphicon glyphicon-user"></span>
											</div>
											<input type="text" class="form-control" name="first_name" id="first_name" required>
										</div>
									</div>

									<div class="form-group col-lg-6 col-md-6">
										<label for="last_name">Last Name</label>
										<div class="input-group">
											<div class="input-group-addon addon-dif-color">
												<span class="glyphicon glyphicon-user"></span>
											</div>
										<input type="text" class="form-control" name="last_name" id="last_name" required>
										</div>
									</div>

								</div> <!-- //.row -->

								<div class="form-group">
									<label for="email">Email Address</label>
									<div class="input-group">
											<div class="input-group-addon addon-dif-color">
												<span class="glyphicon glyphicon-envelope"></span>
											</div>
									<input type="email" class="form-control" name="email" id="email" autocomplete="new-password" required>
									</div>
									<small id="chkUsr" class="form-text text-muted"></small>
								</div>

								<div class="row">
									<div class="form-group col-lg-6 col-md-6">
										<label for="password">Password (at least 6 characters)</label>
										<div class="input-group">
												<div class="input-group-addon addon-dif-color">
													<span class="glyphicon glyphicon-lock"></span>
												</div>
										<input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
										</div>
									</div>

									<div class="form-group col-lg-6 col-md-6">
										<label for="confirmPassword">Confirm Password</label>
										<div class="input-group">
												<div class="input-group-addon addon-dif-color">
													<span class="glyphicon glyphicon-lock"></span>
												</div>
										<input type="password" class="form-control" id="confirmPassword" name="password" autocomplete="new-password" disabled required>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="sms">Mobile Number</label>
									<div class="input-group">
												<div class="input-group-addon addon-dif-color">
													+63
												</div>
									<input type="text" class="form-control" name="sms" id="sms" placeholder="9XXXXXXXXX" required></input>
									</div>
								</div>

								<!-- <div class="form-group">
									<label for="address">Address</label>
									<textarea class="form-control" rows="3" name="address" id="address" required></textarea>
								</div>	 -->

								<input type="submit" name="login" class="btn btn-green btn-block" id="registerBtn" value="Register">
							</form>
						</div>
					<div class="panel-heading text-right">
						<div class="alert alert-danger collapse" id="errorAlert">
							<a id="errorClose" href="#" class="close" data-dismiss="alert">&times;</a>
							<strong>ERROR!</strong> Please check your form!
						</div>
						<p>Already have an account? <a href="login.php">Sign in here</a></p>	
					</div>
				</div>					
			</div>
		</div> <!-- //.row -->
	</div> <!-- //.container -->

	<!-- main footer -->
	<?php include 'partials/main_footer.php'; ?>

	<?php include 'partials/foot.php'; ?>

	<script type="text/javascript">
		var fname = false;
		var lname = false;
		var sms = false;
		var email = false;

		$(document).ready(function(){

			$('#first_name').keyup(function(){
				var regexp = new RegExp(/^[a-zA-Z .]+$/);
				if(regexp.test($('#first_name').val())) {
					$('#first_name').closest('.form-group').removeClass('has-error');
					$('#first_name').closest('.form-group').addClass('has-success');
					fname = true;
				} else {
					$('#first_name').closest('.form-group').addClass('has-error');
					fname = false;
				}
			})

			$('#last_name').keyup(function(){
				var regexp = new RegExp(/^[a-zA-Z .]+$/);
				if(regexp.test($('#last_name').val())) {
					$('#last_name').closest('.form-group').removeClass('has-error');
					$('#last_name').closest('.form-group').addClass('has-success');
					lname = true;
				} else {
					$('#last_name').closest('.form-group').addClass('has-error');
					lname = false;
				}
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

			$('#password').on('input', function(){
				var regexp = new RegExp(/^[a-zA-Z0-9._@#$%^&+=*]{6,50}$/);
				if(regexp.test($('#password').val())) {
					$('#password').closest('.form-group').removeClass('has-error');
					$('#password').closest('.form-group').addClass('has-success');
					confirmPass();
				} else {
					$('#password').closest('.form-group').addClass('has-error');
					confirmPass();
				}
			})

			$('#confirmPassword').on('input', function(){
				var regexp = new RegExp(/^[a-zA-Z0-9._@#$%^&+=*]{6,50}$/);
				if(regexp.test($('#confirmPassword').val())) {
					if($('#confirmPassword').val() == $('#password').val()) {
					$('#confirmPassword').closest('.form-group').removeClass('has-error');
					$('#confirmPassword').closest('.form-group').addClass('has-success');
					$('[for="confirmPassword"]').html('Password <span style="color:green;">match!</span>');
					} else {
						$('#confirmPassword').closest('.form-group').addClass('has-error');
						$('[for="confirmPassword"]').html('Password <span style="color:red;">not match!</span>');
					}
				} else {
					$('#confirmPassword').closest('.form-group').addClass('has-error');
					$('[for="confirmPassword"]').html('Password <span style="color:red;">not match!</span>');
				}
			})

			$('#password').on('input', function(){
				if($('#password').val().length < 6){
					$('#confirmPassword').prop('disabled', true);
				} else {
					$('#confirmPassword').prop('disabled', false);
				}
			});

			function confirmPass() {
				$('[for="confirmPassword"]').html('Confirm Password');
				$('#confirmPassword').closest('.form-group').removeClass('has-error');
				$('#confirmPassword').closest('.form-group').removeClass('has-success');
				$('#confirmPassword').val('');
			}

			
		    window.errorMessage = function errorMessage() {
				
				$('#errorAlert').show('fade');

				setTimeout(function(){
				$('#errorAlert').hide('fade');	
				}, 3500)

				$('#errorClose').click(function(){
					$('#errorAlert').hide('fade');	
				})        
		    }
			
			
		})

		function validateForm() {
			if(!fname || !lname || !email || !sms || ($('#confirmPassword').val() != $('#password').val())) {
				errorMessage();
				return false;
			} else {
				// alert('Congratulations!');
				return true;
			}
		}
	</script>
</body>
</html>