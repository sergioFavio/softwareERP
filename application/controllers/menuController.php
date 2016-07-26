<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
class MenuController extends CI_Controller{
  public function index(){
    $this->load->view('menuView');
  }
  
  public function respaldoBaseDatos(){
  	$this->load->view('header');
	$this->load->view('respaldoBaseDatos');
	$this->load->view('footer');
  }
  
  
}
