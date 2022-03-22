<div class="col-sm-8 well">
  <div class="row justify-content-center">

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
          
          foreach($error_msg as $error){
          ?>
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
          <?php
        }
      }
  ?>

<form class="" method="post" action="<?php echo base_url('admin/product/update/').''.$product->id; ?>" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>PRODUCTS</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-12 control-label" for="product_name">Product Name</label>  
  <div class="col-md-12">
  <input id="product_name" name="product_name" class="form-control input-md" required="" type="text" value="<?= $product->title; ?>">
    
  </div>
</div>


<!-- Textarea -->
<div class="form-group">
  <label class="col-md-12 control-label" for="product_description">Product Descriptions</label>
  <div class="col-md-12">                     
    <textarea class="form-control" id="product_description" name="product_description" value="<?= $product->description; ?>"><?= $product->description; ?></textarea>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-12 control-label" for="filebutton">Product Image</label>
  <div class="col-md-12">
    <input id="filebutton" name="filebutton" class="input-file" type="file">
  </div>
</div>


<!-- File Button --> 
<div class="form-group">
  <label class="col-md-12 control-label" for="filebutton">Product Status</label>
  <div class="col-md-12">
    <input id="status" name="status" <?= ($product->status)?'checked':'' ?> class="input-file" type="checkbox">
  </div>
</div>

<!-- Button -->
<div class="form-group mt-4">
  <div class="col-md-12">
    <button id="singlebutton" name="singlebutton" class="btn btn-success">Save</button>
  </div>
  </div>

</fieldset>
</form>

  </div>
</div>