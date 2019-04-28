<?php

session_start(); 

function getTitle() {
	echo 'Homepage';
}

include 'partials/head.php';?>

</head>
<body>
	<!-- main header -->
	<?php include 'partials/main_header.php'; ?>

	<?php
	if(isset($_SESSION['current_user'])) {
		echo '<h1>HELLO WORLD!</h1>';
	} else {
		echo date("F j, Y - h:i:s A");
	}

	?>

	<!-- main footer -->
	<?php include 'partials/main_footer.php'; ?>

	<?php include 'partials/foot.php'; ?>
</body>
</html>