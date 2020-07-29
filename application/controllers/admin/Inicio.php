<?php

class Inicio extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->library('session');
    $usuario = $this->session->get_userdata('usuario');
    if (!isset($usuario['usuario'])) {
      redirect('admin/auth');
    }
  }

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   * 	- or -
   * 		http://example.com/index.php/welcome/index
   * 	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
  {
    $usuario = $this->session->get_userdata('usuario');
    $this->load->view('admin/templates/header', $usuario);
    $this->load->view('admin/inicio/index');
    $this->load->view('admin/templates/footer');
  }
}
