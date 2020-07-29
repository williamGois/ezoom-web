<?php

class Usuario_Model extends MY_Model
{

  // Autenticacao do usuario
  public function logar($email, $password)
  {
    $this->db->where('email', $email);
    $this->db->where('password', md5($password));
    $usuario = $this->db->get('usuario')->row_array();
    if (isset($usuario)) {
      $this->load->library('session');
      //Guarda usuario na sessao
      $this->session->set_userdata('usuario', $usuario);
      return true;
    }
    return false;
  }
}
