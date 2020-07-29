<?php

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('Usuario_Model');
  }

  /**
   * Mostra Formulario para login
   */
  public function index()
  {
    $this->load->helper('html');
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');
    $this->load->view('admin/auth/index');
  }

  /**
   * Função de login
   */
  public function login()
  {
    // $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    // Valida dados para login

      $email = $this->input->post('email');
      $password = $this->input->post('password');

      if ($this->Usuario_Model->logar($email, $password)) {
        redirect('admin/');
      }
  }

  /**
   * Faz logout do usuario
   */
  public function logout()
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('session');
    session_destroy();
    redirect('admin/');
  }
}
