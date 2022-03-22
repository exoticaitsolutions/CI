<div class="col-sm-8 well mt-4 mr-4" id="content">
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
          
          foreach($error_msg as $error){
          ?>
          <div class="alert alert-danger">
            <?php echo $error; ?>
          </div>
          <?php
        }
      }
      ?>
      <div class="col-sm-12">
        <a href="<?php echo base_url('admin/product/add');?>" class="pull-right">Add New</a>
      </div>
      <table id="example" class="table table-striped table-bordered" >
        <thead>
          <tr>
            <th>Sr.No.</th>
            <th>Title</th>
            <th>Image</th>
            <th>Descriptions</th>
            <th>Is Active</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if($product){
              foreach($product as $key => $val){ ?>
                  <tr>
                    <td><?= $key+1;?></td>
                    <td><?= $val['title'];?></td>
                    <td><?= ($val['image'])?'<img style="height:60px" src="'.base_url().''.$val['image'].'">':'N/A';?></td>
                    <td><?= $val['description'];?></td>
                    <td><?= ($val['status'])?'Yes':'No';?></td>
                    <td><?= $val['created_at'];?></td>
                    <td>
                      <a href="<?php echo base_url('admin/product/edit').'/'.$val['id']; ?>">Edit</a>
                      <a href="<?php echo base_url('admin/product/delete').'/'.$val['id']; ?>">Delete</a>
                    </td>
                  </tr>
             <?php }
            }
          ?>
        </tbody>
      </table>
    </div>
</div>