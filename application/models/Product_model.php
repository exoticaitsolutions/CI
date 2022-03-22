<?php
class Product_model extends CI_model{

  public function add_product($product){

    try {
        $result = $this->db->insert('products',$product);
    
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

  public function list(){
  
    $this->db->select('*');
    $this->db->order_by("id", "desc");
    $this->db->from('products'); 
    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{
      return false;
    }
  }


  public function list_active(){
    $this->db->select('*');
    $this->db->where('status',1);
    $this->db->order_by("id", "desc");
    $this->db->from('products'); 
    if($query=$this->db->get())
    {
      return $query->result_array();
    }
    else{
      return false;
    }
  }

  public function active_product(){
    $this->db->where('status',1);
    $result = $this->db->get('products')->num_rows();
    return $result;
  }

  public function product_details($id){
    $this->db->select('*');
    $this->db->from('products');
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function update_product($id, $product){
    $this->db->where('id', $id);
    $this->db->update('products', $product);
    return true;
  }

  public function delete_product($id){
    $this->db->where('id', $id);
    $this->db->delete('products');
    return true;
  }
     
}
     