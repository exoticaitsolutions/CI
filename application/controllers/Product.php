<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('product_model');
        $this->load->library('session');
		$this->load->library('upload');
    }
    
    public function index()
    {
        if($this->session->userdata()){
            $data['product']=$this->product_model->list();
            $this->load->view("admin/header.php");
            $this->load->view("admin/sidebar.php");
            $this->load->view('admin/product/list.php', $data);
            $this->load->view("admin/footer.php");
        }else{
            $this->load->view("layouts/header.php");
            $this->load->view("pages/login.php");
			$this->load->view("layouts/footer.php");
		}
    }

	public function add(){
		$this->load->view("admin/header.php");
		$this->load->view("admin/sidebar.php");
		$this->load->view('admin/product/add.php');
		$this->load->view("admin/footer.php");
	}

	public function store(){
		$this->load->config('upload');
        $this->load->library('upload');
        if (!$this->upload->do_upload('filebutton')) {
            $error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error_msg', $error);
			redirect('admin/product/add', 'refresh');
        } else {
			$image = $this->upload->data();
			$product=array(
                'title'=>$this->input->post('product_name'),
                'description'=>$this->input->post('product_description'),
                'image'=>$this->config->item('path').''.$image['file_name'],
                'status' => ($this->input->post('status'))?1:0,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
            );
			$this->product_model->add_product($product);
			$this->session->set_flashdata('success_msg', 'Product successfully added.');
			redirect('admin/products', 'refresh');
        }

	}

	public function edit($id){
		try{
			$data['product'] = $this->product_model->product_details($id);
			$this->load->view("admin/header.php");
			$this->load->view("admin/sidebar.php");
			$this->load->view('admin/product/edit.php', $data);
			$this->load->view("admin/footer.php");
		}catch(Exception $e){
			redirect('admin/products', 'refresh');
		}
	}

	public function update($id){
		try{
			$product=array(
                'title'=>$this->input->post('product_name'),
                'description'=>$this->input->post('product_description'),
                'status' => ($this->input->post('status'))?1:0,
				'updated_at' => date('Y-m-d H:i:s'),
            );
			$data['product'] = $this->product_model->update_product($id, $product);
			$this->session->set_flashdata('success_msg', 'Product successfully updated.');
			redirect('admin/products', 'refresh');

		}catch(Exception $e){
			$this->session->set_flashdata('error_msg', array('Something went worng'));
			redirect('admin/products', 'refresh');
		}
	}

	public function delete($id){
		try{
			$data['product'] = $this->product_model->delete_product($id);
			$this->session->set_flashdata('success_msg', 'Product successfully deleted.');
			redirect('admin/products', 'refresh');
		}catch(Exception $e){
			$this->session->set_flashdata('error_msg', array('Something went worng'));
			redirect('admin/products', 'refresh');
		}
	}
    
}