<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Exotica IT</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"  media="screen" title="no title">
  </head>
  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>user/user_profile">Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>attach_product_list">Attach Product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url(); ?>product">Product</a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('user/user_logout');?>" class="nav-link">Logout</a>
      </li>
    </ul>
  </div>
</nav>
</header>
  <body>