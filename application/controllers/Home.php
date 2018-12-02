<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

  class Home extends CI_Controller{

  		public function __construct(){

  			parent::__construct();

        $user_id=$this->session->has_userdata('iduser') ? $this->session->userdata('iduser') : false;
        if($user_id == false){
           
           redirect('login/login/halamanlogin');
        }

  		}

  		public function halamanutama(){

  			$this->load->view('partial/header');
  			$this->load->view('halamanutama/home');
  			$this->load->view('partial/footer');
  		}
  }
?>