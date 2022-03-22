<div class="container mt-4">
  <div class="row">
    <?php if($products){ 
    foreach($products as $product){  
    ?>
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?= base_url().''.$product['image']; ?>" alt="<?= $product['title']; ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $product['title']; ?></h5>
          <p class="card-text"><?= $product['description']; ?></p>
          <a href="#" class="btn btn-primary attach" data-id="<?= $product['id']; ?>" data-name="<?= $product['title']; ?>">Attach</a>
        </div>
      </div>
    </div>
    <?php  }
    } ?>

  </div>
</div>

<div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attach Product</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                <form method="post" id="attach_form">
                  <div class="form-group">
                    <input type="hidden" name="product_id" id="product_id">
                    <label for="exampleInputTitle">Product Title</label>
                    <input type="text" readonly class="form-control" id="exampleInputTitle"  placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPrice">Price</label>
                    <input type="number" class="form-control" name="price" id="exampleInputPrice" placeholder="Price Per Item">
                    <span class="error text-danger price"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputQyt">Quantity</label>
                    <input type="number" class="form-control" name="quantity" id="exampleInputQyt" placeholder="Quantity">
                    <span class="error text-danger quantity"></span>
                  </div>
                  <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>