<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('user_model');
        $this->load->model('product_model');
        $this->load->model('attachproduct_model');
        $this->load->library('session');
    }
    
    public function index()
    {
        $this->load->view("layouts/header.php");
        $this->load->view("pages/login.php");
        $this->load->view("layouts/footer.php");
    }
    
    public function register_view(){
        $this->load->view("layouts/header.php");
        $this->load->view("pages/register.php");
        $this->load->view("layouts/footer.php");
    }

    public function register_user(){
    
        try{
            $user=array(
                'name'=>$this->input->post('user_name'),
                'email'=>$this->input->post('user_email'),
                'password'=>md5($this->input->post('user_password')),
                'role'=>'user',
                'is_active' => 0
            );
        
            $email_check=$this->user_model->email_check($user['email']);
        
            if($email_check){
                $this->user_model->register_user($user);
                $this->send_email($user['email']);
                $this->session->set_flashdata('success_msg', 'Registered successfully.Please verify your account. Mail sent to your registred Email address.');
                redirect('login');
            }
            else{
                $this->session->set_flashdata('error_msg', 'E-mail '.$user['email'].' address already registered in our system.');
                redirect('register');
            }
        }catch(Exception $e){
            $this->session->set_flashdata('error_msg', $e->getMessage());
            redirect('register');
        }
    
    }
    
    function login_user(){ 

        try{
            $user_login=array(
                'user_email'=>$this->input->post('user_email'),
                'user_password'=>md5($this->input->post('user_password'))
            ); 
            $user_verified_check=$this->user_model->user_verified_check($this->input->post('user_email'));

            if($user_verified_check){
                $data['users']=$this->user_model->login_user($user_login);
                if($data['users']){
                    $this->session->set_userdata('user_id',$data['users'][0]['id']);
                    $this->session->set_userdata('email',$data['users'][0]['email']);
                    $this->session->set_userdata('name',$data['users'][0]['name']);
                    $this->session->set_userdata('role',$data['users'][0]['role']);
                    $this->session->set_userdata('is_active',$data['users'][0]['is_active']);
                    if($data['users'][0]['role'] === 'user'){
                        redirect('user/user_profile', 'refresh');
                    }else{
                        redirect('admin/dashboard', 'refresh');
                    }
                }else{
                    $this->session->set_flashdata('error_msg', 'Enter vaild login details.');
                    $this->load->view("layouts/header.php");
                    $this->load->view("pages/login.php");
                    $this->load->view("layouts/footer.php");
                }
            }else{
                $this->session->set_flashdata('error_msg', 'Please verified your account first.');
                $this->load->view("layouts/header.php");
                $this->load->view("pages/login.php");
                $this->load->view("layouts/footer.php");
            }
        }catch(Execption $e){
            $this->session->set_flashdata('error_msg', $e->getMessage());
            $this->load->view("layouts/header.php");
            $this->load->view("pages/login.php");
            $this->load->view("layouts/footer.php");
        }
    }

    function admin_dashboard(){
        if($this->session->userdata('user_id')){
            $data['active_product']=$this->product_model->active_product();
            $data['active_user_with_product']=$this->attachproduct_model->active_user_attach_product();
            $data['active_user']=$this->user_model->active_user();
            $data['active_product_without_attach']=$this->attachproduct_model->active_product_without_attach();
            $data['active_product_amount']=$this->attachproduct_model->active_product_amount();
            $data['attach_product_list']=$this->attachproduct_model->attach_product_list();
            $data['attach_list']=$this->attachproduct_model->attach_list();
            $this->load->view("admin/header.php");
            $this->load->view("admin/sidebar.php");
            $this->load->view('admin/dashboard.php', $data);
            $this->load->view("admin/footer.php");
        }else{
            $this->load->view("layouts/header.php");
            $this->load->view("pages/login.php");
            $this->load->view("layouts/footer.php");
        }
    }
    
    function user_profile(){
        if($this->session->userdata('user_id')){
            $data['users'] = $this->session->userdata();
            $this->load->view("layouts/header.php");
            $this->load->view('pages/user_profile.php',$data);
            $this->load->view("layouts/footer.php");
        }else{
            $this->load->view("layouts/header.php");
            $this->load->view("pages/login.php");
            $this->load->view("layouts/footer.php");
        }
    
    }

    public function user_logout(){
      $this->session->sess_destroy();
      redirect('login', 'refresh');
    }

    public function send_email($email){
        try{
           $verificationText = rtrim(strtr(base64_encode($email), '+/', '-_'), '=');
            $this->load->config('email');
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->from('kuldeepexoticaitsolutions@gmail.com');
            $this->email->to($email);
            $this->email->subject('test subject');
            $this->email->message("Dear User,\nPlease click on below URL or paste into your browser to verify your Email Address\n\n <a href='".base_url()."verify/".$verificationText."' >Click Here</a>\n"."\n\nThanks\nAdmin Team");
            if($this->email->send()){
               return true;

            }else{
                return false;
            }
        }catch(Exception $e){
            return false;
        }
    }

    public function verify_email($email=NULL){
        $email_decoded = base64_decode(strtr($email, '-_', '+/'));
        $user_check = $this->user_model->verify_user_email($email_decoded);
        if($user_check == ''){
            $this->session->set_flashdata('success_msg', 'Your email address successfully verified.');
    
        }else{
            $this->session->set_flashdata('error_msg', $user_check);
        }
        $this->load->view("layouts/header.php");
        $this->load->view("pages/login.php");
        $this->load->view("layouts/footer.php");
    }


    public function product_list(){
        if($this->session->userdata('user_id')){
            $data['products'] = $this->product_model->list_active();
            $this->load->view("layouts/header.php");
            $this->load->view('pages/product_list.php', $data);
            $this->load->view("layouts/footer.php");
        }else{
            $this->load->view("layouts/header.php");
            $this->load->view("pages/login.php");
            $this->load->view("layouts/footer.php");
        }
    }

    public function attach_product(){
        try{
            $post = $this->input->post();
            $attach = array(
                'user_id' => $this->session->userdata('user_id'),
                'product_id' => $post['product_id'],
                'price' => $post['price'],
                'quantity' => $post['quantity'],
                'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')
            );
            
            $product_exist = $this->attachproduct_model->product_exist($this->session->userdata('user_id'), $post['product_id']);
            if($product_exist){
                $attach = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'product_id' => $post['product_id'],
                    'price' => $post['price'],
                    'quantity' => $post['quantity'],
                    'updated_at' => date('Y-m-d H:i:s')
                );    
                $result = $this->attachproduct_model->update_product($attach);
            }else{
                $result = $this->attachproduct_model->add_product($attach);
            }
            if($result){
                $res = array('status' => true, 'message' => 'Your information saved successfully.');
            }else{
                $res = array('status' => false, 'message' => 'Something went wrong.');
            }
        }catch(Exception $e){
            $res = array('status' =>  false, 'message' => $e->getMessage());
        }
        header('Content-type: application/json');
        echo json_encode($res);
    }

    public function attach_product_list(){
        if($this->session->userdata('user_id')){
            $data['products'] = $this->attachproduct_model->list($this->session->userdata('user_id'));
            $this->load->view("layouts/header.php");
            $this->load->view('pages/attach_product.php', $data);
            $this->load->view("layouts/footer.php");
        }else{
            $this->load->view("layouts/header.php");
            $this->load->view("pages/login.php");
            $this->load->view("layouts/footer.php");
        }
    }

    public function delete_attach($id){
        try{
            $this->attachproduct_model->delete_product($id); 
            $this->session->set_flashdata('success_msg', 'Attachment removed successfully.');
            redirect('attach_product_list', 'refresh');
        }catch(Execption $e){
            $this->session->set_flashdata('error_msg', 'Something went wrong.');
            redirect('attach_product_list', 'refresh');
        }
    }
    
}