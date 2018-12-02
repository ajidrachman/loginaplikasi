<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
  class Login_model extends CI_Model{

  	public function authlogin($email,$pwenc){

       $this->db->where('email',$email);
       $this->db->where('pw',$pwenc);
       return $this->db->get('user');
  	}

  }
?>