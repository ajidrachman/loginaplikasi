<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Panellogout extends CI_Controller{

		public function __construct(){

			parent::__construct();
			$user_id=$this->session->has_userdata('iduser') ? $this->session->userdata('iduser') : false;
			if($user_id == false){

				redirect('/');
			}
		}

		public function logout(){

			$this->session->unset_userdata('iduser');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('level');

			$this->session->set_flashdata('sukseslogout','<span style="color:green;">Logout sukses</span>');

			redirect('login/login/halamanlogin');
		}
	}
?>