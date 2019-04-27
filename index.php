
<?php
  require_once 'core/init.php';
$sql = "SELECT * FROM products WHERE featured = 1";
$featured = $db->query($sql);
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Red Stone Shop</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/main.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>

<?php
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);  ?>

<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
  <div class="container">
    <a href="/tutorial/index.php" class="navbar-brand" id="text">Red Stone Shop</a>
    <ul class="nav navbar-nav">
      <?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
      <?php
      $parent_id = $parent['id'];
      $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id' ";
      $cquery = $db->query($sql2);
       ?>
<!--Drop Down Menu-->
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><?php echo $parent['category']; ?><span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <?php while($child = mysqli_fetch_assoc($cquery)) : ?>
        <li><a href="#"><?php echo $child['category'] ?></a></li>
      <?php endwhile; ?>

      </ul>
    </li>
  <?php endwhile; ?>
    </ul>
  </div>
</nav>
<!--Inserting Images-->
  <div id="background-image">
    <div id="image-1"></div>
    <div id="image-2"></div>
  </div>

<!--remove the spaces and center the products-->
  <div class="col-md-2"></div>

<!--main content of featured products-->
  <div class="col-md-8">
    <div class="row">
      <h2 class="text-center">Featured Products</h2>
      <?php while($product = mysqli_fetch_assoc($featured)) : ?>
      <div class="col-md-3">
        <h4><?= $product['title']; ?></h4>
        <img src="<?=$product['image']; ?>" alt="<?=$product['title']; ?>" id="images"/>
        <p class="list-price text-danger">List Price: <s>$<?=$product['list_price']; ?></s></p>
        <p class="price">Our Price: $<?=$product['price']; ?></p>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#details-1">Details</button>
      </div>
    <?php endwhile; ?>
  </div>

<footer class="text-center" id="footer">&copy; Copyright 2019-2020 Red Stone Shop</footer>
</div>

<!--details modal-->

<?php include 'details-modal-LevisJeans.php';
      include 'details-modal-Football.php';
      include 'details-modal-Watch.php';
      include 'details-modal-HeadBand.php';
      include 'details-modal-Hoodie.php';
      include 'details-modal-Purse.php';
      include 'details-modal-joggers.php';
      include 'details-modal-poloshirt.php';
 ?>
<!--end of details modal-->
</body>
</html>
