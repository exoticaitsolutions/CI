<div class="container mt-4">
  <div class="row">
  <?php
              $success_msg= $this->session->flashdata('success_msg');
              $error_msg= $this->session->flashdata('error_msg');

                  if($success_msg){
                    ?>
                    <div class="alert alert-success">
                      <?php echo $success_msg; ?>
                    </div>
                  <?php
                  }
                  if($error_msg){
                    ?>
                    <div class="alert alert-danger">
                      <?php echo $error_msg; ?>
                    </div>
                    <?php
                  }
                  ?>

      <table class="table">
        <thead>
          <tr>
            <th>Sr.No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php if($products){
          foreach($products as $key => $product){ 
        ?>
          <tr>
            <td><?= $key+1; ?></td>
            <td><?= $product['title']; ?></td>
            <td>$<?= $product['price']; ?></td>
            <td><?= $product['quantity']; ?></td>
            <td><a href="<?= base_url()?>attach_product/delete/<?= $product['ID'];?>">Delete</a></td>
          </tr>
          <?php  
            }
            }  ?>
        </tbody>
      </table>
  </div>
</div>