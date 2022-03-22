<?php
class User_model extends CI_model{

    public function register_user($user){

        try {
            $result = $this->db->insert('user',$user);
        
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
     
    public function login_user($data){

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email',$data['user_email']);
        $this->db->where('password',$data['user_password']);
     
      if($query=$this->db->get())
      {
        return $query->result_array();
      }
      else{
        return false;
      }
    }

    public function user_verified_check($email){
     
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('email',$email);
      $this->db->where('is_active',1);
      $query=$this->db->get();
      if($query->num_rows() == 0){
        return false;
      }else{
        return true;
      }
    }

    public function email_check($email){
     
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('email',$email);
      $query=$this->db->get();
      if($query->num_rows()!=0){
        return false;
      }else{
        return true;
      }
    }

    public function verify_user_email($email){
      $this->db->select('*');
      $this->db->from('user');
      $this->db->where('email',$email);
      $query=$this->db->get();
      if($query->num_rows()!=0){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email',$email);
        $this->db->where('is_active',1);
        $query=$this->db->get();
        if($query->num_rows()!=0){
          return 'Your E-mail address already verified.';
        }else{
          $this->db->set('is_active', 1);
          $this->db->where('email', $email);
          $this->db->update('user'); 
          return '';
        }

      }else{
        return 'Invaild verification link.';
      }
    }
     
    public function active_user(){
      $this->db->where('is_active',1);
      $this->db->where('role','user');
      $result = $this->db->get('user')->num_rows();
      return $result;
    }
     
}
     