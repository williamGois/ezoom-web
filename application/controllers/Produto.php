<?php

class Produto extends CI_Controller 
{

  public function __construct() 
  {
    parent::__construct();

    $this->load->model('Categoria_Model');
    $this->load->model('Produtos_Model');
    $this->load->model('ProdutosImagens_Model');
    
  }

  public function index($indice = 0) 
  {
    
    $indice = is_numeric($indice) ? $indice : 0;
    $limite = 6;

    $this->_init_library_pagination($this->Produtos_Model->count(), $limite);

    $header['categorias'] = $this->Categoria_Model->get_list();
    $index['produtos'] = $this->Produtos_Model->get_list($indice, $limite);

    $this->load->view('templates/header', $header);
    $this->load->view('produto/index', $index);
    $this->load->view('templates/footer');
  }

  /**
   * Mostra Produto
   */
  public function show($id = NULL) 
  {
    $this->load->helper('html');
    $this->load->helper('url');

    $header['categorias'] = $this->Categoria_Model->get_list();
    $show['produto'] = $this->Produtos_Model->get_where('id', $id);
    $show['produto_imagens'] = $this->ProdutosImagens_Model->get_where_all('produto_id', $id);
    $this->load->view('templates/header', $header);
    $this->load->view('produto/show', $show);
    $this->load->view('templates/footer');
  }

  /**
   * Inicializa Paginação
   */
  private function _init_library_pagination($total, $limite) 
  {
    $this->load->helper('html');
    $this->load->helper('url');
    

    $config['base_url'] = base_url('pagina/');
    $config['total_rows'] = $total;
    $config['per_page'] = $limite;
    $config['first_url'] = base_url();
    $config['num_links'] = 7;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    $config['first_tag_open'] = '<li>';
    $config['first_link'] = 'Primero';
    $config['first_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_link'] = '←';
    $config['prev_tag_close'] = '</li>';
    $config['next_tag_open'] = '<li>';
    $config['next_link'] = '→';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_link'] = 'Ultimo';
    $config['last_tag_close'] = '</li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->load->library('pagination', $config);
  }

}
