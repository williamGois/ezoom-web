<?php

class Categorias extends CI_Controller
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

    $this->load->model('Categoria_Model');
  }

  /**
   * Mostra os registros.
   */
  public function index()
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $index['categorias'] = $this->Categoria_Model->get_list();

    $this->load->view('admin/templates/header');
    $this->load->view('admin/categorias/index', $index);
    $this->load->view('admin/templates/footer');
  }

  public function form($id = NULL)
  {

    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');

    $form['categoria'] = $this->Categoria_Model->get_where('id', $id);

    if ($this->input->method() == 'post')
      $this->save($form['categoria']);

    $this->load->view('admin/templates/header');
    $this->load->view('admin/categorias/form', $form);
    $this->load->view('admin/templates/footer');
  }

  /**
   * Cadastra nova Categoria para o curso
   * @param Categoria_Model $categoria modelo.
   */
  private function save(Categoria_Model $categoria)
  {
    $this->load->helper('html');
    $this->load->helper('url'); 
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('text');
    $categoria->nome = $this->input->post('nome');
    $categoria->slug = url_title(convert_accented_characters($categoria->nome), 'dash', TRUE);

    $categoria->save();
    redirect('admin/categorias');
  }

  /**
   * Deleta a categoria do curso
   * @param int $id identificador.
   */
  public function delete($id)
  {
    $this->Categoria_Model->delete($id);
    redirect('admin/categorias');
  }
}
