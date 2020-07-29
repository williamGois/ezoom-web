<?php

class Curso extends CI_Controller
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
    $this->load->model('Cursos_Model');
    $this->load->model('CursosImagens_Model');
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

    $this->_init_library_pagination($this->Cursos_Model->count(), $limite);

    $index['cursos'] = $this->Cursos_Model->get_list($indice, $limite);

    $this->load->view('admin/templates/header');
    $this->load->view('admin/curso/index', $index);
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

    $form['curso'] = $this->Cursos_Model->get_where('id', $id);
    $form['curso_imagens'] = $this->CursosImagens_Model->get_where_all('curso_id', $id);
    $form['categorias'] = $this->Categoria_Model->get_list();

    if ($this->input->method() == 'post')
      $this->save($form['curso']);

    $this->load->view('admin/templates/header');
    $this->load->view('admin/curso/form', $form);
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

    $form['curso'] = $this->CursosImagens_Model->get_where('curso_id', null);
    $form['categorias'] = $this->Categoria_Model->get_list();

    if ($this->input->method() == 'post')
      $this->saveAdicional($form['curso'], $id);
  }

  /**
   * 
   * @param CursosImagens_Model $cursos modelo.
   */
  private function saveAdicional(CursosImagens_Model $imagemAdicional, $curso_id)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('text');

    $this->_init_library_upload();
    $imagemAdicional->curso_id = $curso_id;
    if ($this->upload->do_upload('imagemAdicional')) {

      $imagemAdicional->imagem = $this->upload->file_name;
      $this->_init_library_image($imagemAdicional->imagem);
    }

    $imagemAdicional->save();
    redirect('admin/curso/form/' . $curso_id . '');
  }


  /**
   * 
   * @param Cursos_Model $cursos modelo.
   */
  private function save(Cursos_Model $curso)
  {
    $this->load->helper('html');
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->helper('text');
    $curso->titulo = $this->input->post('titulo');
    $curso->descricao = $this->input->post('descricao');
    $curso->slug = url_title(convert_accented_characters($curso->titulo), 'dash', TRUE);
    $curso->categoria_id = $this->input->post('categoria');

    $this->_init_library_upload();

    if ($this->upload->do_upload('userfile')) {

      $curso->imagem = $this->upload->file_name;
      $this->_init_library_image($curso->imagem);
    }

    $curso->save();
    redirect('admin/curso');
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
    $this->Cursos_Model = $this->Cursos_Model->get_where('id', $id);
    if ($this->Cursos_Model->delete()) {
      if (!is_null($this->Cursos_Model->imagem)) {
        unlink('./upload/' . $this->Cursos_Model->imagem);
        unlink('./upload/tumb/' . $this->Cursos_Model->imagem);
      }
    }
    // Redireciona para pagina anterior
    redirect($_SERVER['HTTP_REFERER']);
  }


  /**
   * Deleta Imagem Adicional do curso
   * @param int $id identificador.
   */
  public function deleteAdicional($id)
  {
    $this->CursosImagens_Model = $this->CursosImagens_Model->get_where('id', $id);
    if ($this->CursosImagens_Model->delete()) {
      if (!is_null($this->CursosImagens_Model->imagem)) {
        unlink('./upload/' . $this->CursosImagens_Model->imagem);
        unlink('./upload/tumb/' . $this->CursosImagens_Model->imagem);
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

    $config['base_url'] = site_url('admin/curso/index/');
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
