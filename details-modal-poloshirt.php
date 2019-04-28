<div class="modal fade details-4" id="details-4" tabindex="-1" role="dialog" aria-labelledby="details-4" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center">Polo Shirt</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="center-block">
                <img src="images/PoloShirt.png" alt="Polo Shirt" class="details img-responsive" />
              </div>
            </div>
            <div class="col-sm-6">
              <h4>Details</h4>
              <p>These Shirts are amazing and you must try them. They fit great and look awesome. Get a pair while they last.</p>
              <hr />
              <p>Price: $19.99</p>
              <p>Brand: Polo</p>
              <form action="add_cart.php" method="post">
                <div class="form-group">
                  <div class="col-xs-3">
                    <label for="quantity" id="quantity-label">Quantity:</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"/>
                  </div>
                </div><br /><br />
                <div class="form-group">
                  <label for="size">Size:</label>
                  <select name="size" id="size" class="form-control">
                    <option value=""></option>
                    <option value="small">small</option>
                    <option value="medium">medium</option>
                    <option value="large">large</option>
                  </select>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal">Close</button>
        <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Cart</button>
      </div>
    </div>
  </div>
</div>
