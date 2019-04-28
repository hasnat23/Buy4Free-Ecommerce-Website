<?php 

session_start();

function getTitle() {
	echo 'Log In';
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

	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-centered">
				<div id="validation-message">
				    <?php
				        echo '<div>'.$message.'</div>';
				     ?>
				</div>
				<div class="panel panel-default">	
					<div class="panel-heading"><h4>Log in</h4></div>
						<div class="panel-body">
							<form method="post" id="login_form" action="assets/authenticate.php">
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

								<div class="form-group">
									<label for="password">Password</label>
										<div class="input-group">
												<div class="input-group-addon addon-dif-color">
													<span class="glyphicon glyphicon-lock"></span>
												</div>
										<input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
										</div>
								</div>
													
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="rememberMe">
									<label class="form-check-label" for="rememberMe">Remember Me</label>
								</div>
								
								<button type="submit" name="login" class="btn btn-green pull-right">Sign in</button>	
							
							</form>
						</div> <!-- //.panel-body -->
					<div class="panel-heading">
						<p>Forgot your password? <a href="forgot-password.php">Click here</a></p>
						<p>Create new account? <a href="register.php">Register here!</a></p>
					</div>		
				</div> <!-- //.panel -->
			</div> <!-- //.col -->
		</div> <!-- //.row -->
	</div> <!-- //.container -->

	<!-- main footer -->
	<?php include 'partials/main_footer.php'; ?>

	<?php include 'partials/foot.php'; ?>
</body>
</html>