<?php
class Product_model extends CI_model{



    public function active_product(){
      $this->db->where('status',1);
      $result = $this->db->get('products')->num_rows();
      return $result;
    }
     
}
     