<div class="col-sm-8 well" id="content">

    <div class="row">
    <div class="col-md-3">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <span class="count-numbers"><?= $active_user; ?></span>
        <span class="count-name">Users</span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-counter success">
        <i class="fa fa-code-fork"></i>
        <span class="count-numbers"><?= $active_product; ?></span>
        <span class="count-name">Product</span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <span class="count-numbers"><?= $active_user_with_product; ?></span>
        <span class="count-name">Active User With Attached Product</span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card-counter success">
        <i class="fa fa-code-fork"></i>
        <span class="count-numbers"><?= $active_product_without_attach; ?></span>
        <span class="count-name">Active Product Without Attached User</span>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card-counter primary">
        <i class="fa fa-code-fork"></i>
        <span class="count-numbers"><?= $active_product_amount; ?></span>
        <span class="count-name">Amount of all active attached products</span>
      </div>
    </div>

    <div class="col-md-12">
      <h4>Summarized price of all active attached products</h4>
      <?php if($attach_product_list){ 
        
     
        ?>
        <table class="table">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Name</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
        <?php
          foreach($attach_product_list as $key => $list){
            $price = 0;
            $name = '';
              foreach($list as $item){
                $price += ($item['quantity']*$item['price']);
                $name = $item['title'];
              }
              echo '<th>'.$key.'</th>';
              echo '<th>'.$name.'</th>';
              echo '<th>$'.$price.'</th>';
              echo '</tr>';

          }
        ?>
        </tbody>
        </table>
        <?php
      } ?>
    </div>

    <div class="col-md-12">
      <h4>Summarized prices of all active products per user</h4>
      <?php if($attach_list){ 
        
     
        ?>
        <table class="table">
          <thead>
            <tr>
              <th>Sr.No</th>
              <th>Name</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
        <?php
          foreach($attach_list as $key => $list){
            $price = 0;
            $name = '';
              foreach($list as $item){
                $price += ($item['quantity']*$item['price']);
                $name = $item['name'];
              }
              echo '<th>'.$key.'</th>';
              echo '<th>'.$name.'</th>';
              echo '<th>$'.$price.'</th>';
              echo '</tr>';

          }
        ?>
        </tbody>
        </table>
        <?php
      } ?>
    </div>
</div>
</div>