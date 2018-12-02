<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

   class Login extends CI_Controller{

   	  public function __construct(){

   	  	parent::__construct();
   	  	$this->load->helper('security');
   	  	$this->load->model('login_model');

   	  	$user_id=$this->session->has_userdata('iduser') ? $this->session->userdata('iduser') : false;
              if($user_id){
                 
                 redirect('/');
              }

   	  }

   	  public function halamanlogin(){

   	  	$data['sukseslogout']=$this->session->flashdata('sukseslogout');
   	  	$data['notiflogin']=$this->session->flashdata('notiflogin');

   	  	$this->form_validation->set_rules('email','EMAIL','required|valid_email',array('required' => '<span style="color:red;">Maaf kolom email tidak boleh kosong</span>','valid_email' => '<span style="color:red;">Maaf email tidak valid</span>'));

   	  	$this->form_validation->set_rules('pw','PW','required|alpha_numeric',array('required' => '<span style="color:red;">Maaf kolom password tidak boleh kosong</span>', 'alpha_numeric' => '<span style="color:red;">Maaf kolom password hanya boleh huruf dan angka saja</span>'));

   	  	if($this->form_validation->run() === TRUE){
   	  		
   	  		$email=$this->input->post('email',TRUE);
   	  		$pw=$this->input->post('pw',TRUE);
   	  		$pwenc=do_hash($pw,'md5');

   	  		$loginproses=$this->login_model->authlogin($email,$pwenc);
   	  		if($loginproses->num_rows() == 0){
   	  			
   	  			$this->session->set_flashdata('notiflogin','<span style="color:red;">maaf email dan password tidak valid</span>');

   	  			redirect('login/login/halamanlogin');
   	  		}else{

   	  			$row=$loginproses->row();
   	  			$iduser= $row->id_user;
   	  			$email1=$row->email;
   	  			$username=$row->username;
   	  			$level=$row->level;

   	  			$this->session->set_userdata('iduser',$iduser);
   	  			$this->session->set_userdata('email',$email1);
   	  			$this->session->set_userdata('username',$username);
   	  			$this->session->set_userdata('level',$level);

   	  			redirect('/');
   	  		}
   	  	}

   	  	$this->load->view('Login/halaman_login',$data);
   	  }


   }
?>