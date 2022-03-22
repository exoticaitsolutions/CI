<?php
class Attachproduct_model extends CI_model{

  public function add_product($product){

    try {
        $result = $this->db->insert('attach_products',$product);
    
        if (!$result)
        {
          throw new Exception('error in query');
          return false;
        }        
    
        return $result;
    
    } catch (Exception $e) {
        return;
    }
}

  public function list($user_id){
  
    $this->db->select('ap.id as ID, ap.price, ap.quantity, p.*');
    $this->db->from('attach_products ap'); 
    $this->db->join('products p', 'p.id=ap.product_id');
    $this->db->where('ap.user_id',$user_id);
    $this->db->order_by("ap.id", "desc");
    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{
      return false;
    }
  }

  public function product_exist($user_id, $product_id){
    $this->db->select('*');
    $this->db->where('user_id',$user_id);
    $this->db->where('product_id',$product_id);
    $this->db->from('attach_products'); 
    $query=$this->db->get();
      if($query->num_rows() == 0){
        return false;
      }else{
        return true;
      }
  }

  public function update_product($product){
    $this->db->where('user_id', $product['user_id']);
    $this->db->where('product_id', $product['product_id']);
    $this->db->update('attach_products', $product);
    return true;
  }

  public function delete_product($id){
    $this->db->where('id', $id);
    $this->db->delete('attach_products');
    return true;
  }

  public function active_user_attach_product(){
    $this->db->join('attach_products ap', 'u.id=ap.user_id');
    $this->db->join('products p', 'p.id=ap.product_id');
    $result = $this->db->get('user u')->num_rows();
    return $result;
  }

  public function active_product_without_attach(){
    $this->db->select('*')->from('products');
    $this->db->where('`id` NOT IN (SELECT `product_id` FROM `attach_products`)', NULL, FALSE);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function active_product_amount(){
    $this->db->select_sum('ap.quantity');
    $this->db->join('products p', 'p.id=ap.product_id');
    $result = $this->db->get('attach_products ap')->row_array();
    return ($result['quantity'])?$result['quantity']:0;
  }


  public function attach_product_list(){
    $this->db->select('ap.price, ap.quantity, p.title, p.id');
    $this->db->from('attach_products ap'); 
    $this->db->join('products p', 'p.id=ap.product_id');
   
    if($query=$this->db->get())
    {
      $result = array();
      foreach ($query->result_array() as $element) {
          $result[$element['id']][] = $element;
      }

      return $result;
    }
    else{
      return false;
    }
  }

  public function attach_list(){
    $this->db->select('ap.price, ap.quantity, u.name, u.id');
    $this->db->from('attach_products ap'); 
    $this->db->join('products p', 'p.id=ap.product_id');
    $this->db->join('user u', 'u.id=ap.user_id');
   
    if($query=$this->db->get())
    {
      $result = array();
      foreach ($query->result_array() as $element) {
          $result[$element['id']][] = $element;
      }
      return $result;
    }
    else{
      return false;
    }
  }
     
}
     