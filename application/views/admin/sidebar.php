<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark col-sm-3 vh-100">
    <a href="admin/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">Exotica</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
      <a href="<?php echo base_url('admin/dashboard');?>"  class="nav-link text-white">
      Dashboard
        </a>
      </li>
      <li>
      <a href="<?php echo base_url('admin/products');?>"  class="nav-link text-white">
          Products
        </a>
      </li>

    </ul>
    <hr>
    <div class="dropdown">
        <?php $users = $this->session->userdata();?>
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="<?= base_url(); ?>images/user.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?= $users['name'];?></strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1" style="">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="<?php echo base_url('user/user_logout');?>">Log out</a></li>
      </ul>
    </div>
  </div>