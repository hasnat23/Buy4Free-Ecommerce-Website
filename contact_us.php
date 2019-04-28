<?php

session_start(); 

function getTitle() {
	echo 'About Us';
}

include 'partials/head.php';

?>

</head>
<body>
	<!-- main header -->
	<?php include 'partials/main_header.php'; ?>

	<div class="container">
	<h1>About the Company</h1>

	<p>LGV Enterprise (the company) owns a branch of Grainsmart, the Philippine’s largest Rice Franchisor and Retailer located at Greenland Subdivision Cainta, Rizal. The company decided to franchise this business not only because of the quality and affordability of the rice varieties, but also because of its unique concept of putting the rice into clear glass dispensers for display. This makes sure that customers have access to clean and pure rice varieties.</p>
	<p>Grainsmart Cainta Greenland opened its store last October 2017. It offers 10 varieties of rice which comes from the provinces of Nueva Ecija, Isabela and Mindoro. Our customers are residents from the subdivision, as well as some canteens in Cainta Rizal. Grainsmart Cainta Greenland also offers free delivery for a minimum order of 25kgs of rice.</p>
	<p>To expand the product range of the branch and add another source of profit, the company decided to sell quality frozen products such as Bacon, Tocino, Sausage, Longganisa, etc.  and some grocery items after three months of store operations.</p>
	</div>
	<!-- main footer -->
	<?php include 'partials/main_footer.php'; ?>

	<?php include 'partials/foot.php'; ?>
</body>
</html>