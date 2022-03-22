<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered table-striped">
        <tr>
          <th colspan="2"><h4 class="text-center">Users Details</h3></th>
        </tr>
		<?php 

    if($users){       
      ?>
          <tr>
            <td>User Name</td>
            <td><?php echo $users['name']; ?></td>
          </tr>
          <tr>
            <td>User Email</td>
            <td><?php echo $users['email']; ?></td>
          </tr>
          <tr>
            <td>Status</td>
            <td><?php echo  ($users['is_active'])?'Verified':'Unverified';  ?></td>
          </tr>
		  <tr> <td style="padding-top: 20px;"> </td></tr>
		  <?php } ?>
      </table>
    </div>
  </div>
<a href="<?php echo base_url('user/user_logout');?>" >  <button type="button" class="btn-primary">Logout</button></a>
</div>