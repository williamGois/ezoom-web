<?php

class Produto extends CI_Controller
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
    $this->load->model('Produtos_Model');
    $this->load->model('ProdutosImagens_Model');
  }

  /**
   * Mostra os registros.
   */
  public function index($indice = 0)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');

    $indice = is_numeric($indice) ? $indice : 0;
    $limite = 6;

    $this->_init_library_pagination($this->Produtos_Model->count(), $limite);

    $index['produtos'] = $this->Produtos_Model->get_list($indice, $limite);

    $this->load->view('admin/templates/header');
    $this->load->view('admin/produto/index', $index);
    $this->load->view('admin/templates/footer');
  }

  /**
   * @param int $id [opcional] identificador.
   */
  public function form($id = NULL)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');

    $form['produto'] = $this->Produtos_Model->get_where('id', $id);
    $form['produto_imagens'] = $this->ProdutosImagens_Model->get_where_all('produto_id', $id);
    $form['categorias'] = $this->Categoria_Model->get_list();

    if ($this->input->method() == 'post')
      $this->save($form['produto']);

    $this->load->view('admin/templates/header');
    $this->load->view('admin/produto/form', $form);
    $this->load->view('admin/templates/footer');
  }


  /**
   * @param int $id [opcional] identificador.
   */
  public function adicional($id = NULL)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');

    $form['produto'] = $this->ProdutosImagens_Model->get_where('produto_id', null);
    $form['categorias'] = $this->Categoria_Model->get_list();

    if ($this->input->method() == 'post')
      $this->saveAdicional($form['produto'], $id);
  }

  /**
   * 
   * @param ProdutosImagens_Model $produtos modelo.
   */
  private function saveAdicional(ProdutosImagens_Model $imagemAdicional, $produto_id)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('text');

    $this->_init_library_upload();
    $imagemAdicional->produto_id = $produto_id;
    if ($this->upload->do_upload('imagemAdicional')) {

      $imagemAdicional->imagem = $this->upload->file_name;
      $this->_init_library_image($imagemAdicional->imagem);
    }

    $imagemAdicional->save();
    redirect('admin/produto/form/' . $produto_id . '');
  }


  /**
   * 
   * @param Produtos_Model $produtos modelo.
   */
  private function save(Produtos_Model $produto)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('text');
    $produto->titulo = $this->input->post('titulo');
    $produto->descricao = $this->input->post('descricao');
    $produto->slug = url_title(convert_accented_characters($produto->titulo), 'dash', TRUE);
    $produto->categoria_id = $this->input->post('categoria');

    $this->_init_library_upload();

    if ($this->upload->do_upload('userfile')) {

      $produto->imagem = $this->upload->file_name;
      $this->_init_library_image($produto->imagem);
    }

    $produto->save();
    redirect('admin/produto');
  }

  /* ----------------------------------------------------------------------- */

  public function is_upload($str = NULL, $field)
  {
    if (is_uploaded_file($_FILES[$field]['tmp_name'])) {
      return TRUE;
    }

    $this->form_validation->set_message('is_upload', 'Usted no seleccionó un archivo para enviar.');
    return FALSE;
  }

  /* ----------------------------------------------------------------------- */

  /**
   * Deleta o registro
   * @param int $id identificador.
   */
  public function delete($id)
  {
    $this->Produtos_Model = $this->Produtos_Model->get_where('id', $id);
    if ($this->Produtos_Model->delete()) {
      if (!is_null($this->Produtos_Model->imagem)) {
        // unlink('./upload/' . $this->Produtos_Model->imagem);
        unlink('./upload/tumb/' . $this->Produtos_Model->imagem);
      }
    }
    // Redireciona para pagina anterior
    redirect($_SERVER['HTTP_REFERER']);
  }


  /**
   * Deleta Imagem Adicional do produto
   * @param int $id identificador.
   */
  public function deleteAdicional($id)
  {
    $this->ProdutosImagens_Model = $this->ProdutosImagens_Model->get_where('id', $id);
    if ($this->ProdutosImagens_Model->delete()) {
      if (!is_null($this->ProdutosImagens_Model->imagem)) {
        unlink('./upload/' . $this->ProdutosImagens_Model->imagem);
        unlink('./upload/tumb/' . $this->ProdutosImagens_Model->imagem);
      }
    }
    // Redireciona para pagina anterior
    redirect($_SERVER['HTTP_REFERER']);
  }



  /* ----------------------------------------------------------------------- */

  /**
   * Inicializa a classe upload para subir as fotos
   */
  private function _init_library_upload()
  {

    $this->load->library('upload', array(
      'upload_path' => './upload/tumb/',
      'allowed_types' => 'jpg|JPG|jpeg|JPEG|png|PNG',
      'encrypt_name' => TRUE,
      'max_size' => 2000,
      'max_width' => 5000,
      // Tamanho maximo da foto.
      'max_height' => 5000
    ));

    $this->load->library('upload', array(
      'upload_path' => './upload/',
      'allowed_types' => 'jpg|JPG|jpeg|JPEG|png|PNG',
      'encrypt_name' => TRUE,
      'max_size' => 2000,
      'max_width' => 5000,
      // Tamanho maximo da foto.
      'max_height' => 5000
    ));
  }

  private function _init_library_image($image_name)
  {
    $this->load->library('image_lib', array(
      'create_thumb' => TRUE,
      'thumb_marker' => NULL,
      'source_image' => './upload/' . $image_name,
      'new_image' => './upload/tumb/' . $image_name,
      'width' => 300,
      'height' => 300
    ));

    return $this->image_lib->resize();
  }

  /**
   * Inicializa paginacao
   */
  private function _init_library_pagination($total, $limite)
  {

    $config['base_url'] = site_url('admin/produto/index/');
    $config['total_rows'] = $total;
    $config['per_page'] = $limite;
    // Numero de paginas.
    $config['num_links'] = 7;

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    // Indice atual.
    $config['cur_tag_open'] = '<li class="active"><a>';
    $config['cur_tag_close'] = '</a></li>';
    // Link para ir para a primeira pagina.
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    // Link para ir para a pagina anterior.
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    // Link para ir para proxima pagina.
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $this->load->library('pagination', $config);
  }
}
