<div class="modal fade details-6" id="details-6" tabindex="-1" role="dialog" aria-labelledby="details-6" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title text-center">Purse</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <div class="center-block">
                <img src="images/Purse.jpg" alt="Purse" class="details img-responsive" />
              </div>
            </div>
            <div class="col-sm-6">
              <h4>Details</h4>
              <p>These Purses are amazing and you must try them. They fit great and look awesome. Get a pair while they last.</p>
              <hr />
              <p>Price: $61.99</p>
              <p>Brand: Aldo</p>
                <form action="add_cart.php" method="post">
                  <div class="form-group">
                    <div class="col-xs-3">
                      <label for="quantity" id="quantity-label">Quantity:</label>
                      <input type="text" class="form-control" id="quantity" name="quantity"/>
                    </div>
                  </div>
                </form>
              </div>
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
</div>
