<?php

class Categoria extends CI_Controller 
{

  public function __construct() 
  {
    parent::__construct();

    $this->load->model('Categoria_Model');
  }

  public function index($slug = FALSE) 
  {

    $this->load->helper('html');
    $this->load->helper('url');

    $header['categorias'] = $this->Categoria_Model->get_list();
    $index['categoria'] = $this->Categoria_Model->get_where('slug', $slug);
    $index['cursos'] = $this->Categoria_Model->get_cursos($slug);

    $this->load->view('templates/header', $header);
    $this->load->view('categorias/index', $index);
    $this->load->view('templates/footer');
  }

}
