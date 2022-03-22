<div class="container">
      <div class="row m-auto mt-4">
          <div class="col-md-8">
                  <div class="panel-heading">
                      <h3 class="panel-title">Please do Registration here</h3>
                  </div>
                  <div class="panel-body">

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

                      <form role="form" class="p-4" method="post" action="<?php echo base_url('user/register_user'); ?>">
                          <fieldset>
                              <div class="form-group p-3">
                                  <input class="form-control" required placeholder="Please enter Name" name="user_name" type="text">
                              </div>

                              <div class="form-group p-3">
                                  <input class="form-control" required placeholder="Please enter E-mail" name="user_email" type="email">
                              </div>
                              <div class="form-group p-3">
                                  <input class="form-control" required placeholder="Enter Password" name="user_password" type="password">
                              </div>


                              <input class="btn btn-lg btn-success btn-block" type="submit" value="Register" name="register" >

                          </fieldset>
                      </form>
                      <center><b>You have Already registered ?</b> <br></b><a href="<?php echo base_url('login'); ?>"> Please Login</a></center><!--for centered text-->
                  </div>
              </div>
          </div>
      </div>
  </div>