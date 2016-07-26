<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Heredamos de la clase CI_Controller */
class Login extends CI_Controller {
	
	function index()
	{
		//$this->load->view('headerInicial');
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
		
		
	public function validarUsuario()
	{
	    $nombre=$_POST['inputUsuario']; 
		$contraSenha= md5($_POST['inputPassword']);
		
		$this->load->model("usuarios_model");
	    $usuario=$this->usuarios_model->buscarPorNombreYContraSenha($nombre,$contraSenha);
		
		if($usuario) {
			
			$this->load->model("usuarioPermisos_model");
	    	$permiso=$this->usuarioPermisos_model->buscarUsuarioPermisos($usuario['id']);
			
			
			$usuarioConectado=array(
				'idUsuario'=>$usuario['id'],
				'userName'=>$usuario['nombre'],
				'usuarioLogueado'=>true,
				'usuarioMenu'=>$permiso['menu'],
				'usuarioDeposito'=>$permiso['deposito'],
				'usuarioProceso1'=>$permiso['proceso1'], //... true:1  false:0
				'usuarioProceso2'=>$permiso['proceso2'],
				'usuarioProceso3'=>$permiso['proceso3'],
				'usuarioProceso4'=>$permiso['proceso4'],
				'usuarioProceso5'=>$permiso['proceso5'],
				'usuarioProceso6'=>$permiso['proceso6'],
				'usuarioProceso7'=>$permiso['proceso7'],
				'usuarioProceso8'=>$permiso['proceso8'],
				'usuarioProceso9'=>$permiso['proceso9']
			);
			
			$this->session->set_userdata($usuarioConectado);
			redirect('menuController/index');
		}
		else{
			echo"<div class='alert alert-danger' style='width:400px;height:37px;margin:20px;'>
			    <a href='#' class='close' data-dismiss='alert'>&times;</a>
			        <strong>Error!</strong> Usuario y/o contrase&ntilde;a err&oacute;nea.
			</div>";			

			$this->load->view('header');
			$this->load->view('login');
			$this->load->view('footer');
		}

        	 
	} //... fin validar usuario ...
	
	
	public function logout(){
		$usuarioConectado=array(
				'usuarioLogueado'=>false
	    );
	
	    $this->session->set_userdata($usuarioConectado);
		$this->session->unset_userdata('usuarioLogueado');
		$this->load->view('headerInicial');
		$this->load->view('login');
		$this->load->view('footer');
	}
  
	public function salir()
	{
		exit( utf8_decode("Saliendo del sistema de Información ...") );
	}

}