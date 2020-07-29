<?php

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categoria_Model');
        $this->load->model('Cursos_Model');
        $this->load->model('CursosImagens_Model');
    }

    /**
     *  API para Mostrar os cursos.
     */
    public function cursos()
    {
        $index['cursos'] = $this->Cursos_Model->get_list();
        echo json_encode($index);
    }

    /**
     *  API para Mostrar as categorias.
     */
    public function categorias()
    {
        $index['categorias'] = $this->Categoria_Model->get_list();
        echo json_encode($index);
    }


    /**
     *  API para Mostrar os cursos pela categoria selecionada.
     */
    public function cursoBuscaCursoPorCategoria($id)
    {
        $show['curso'] = $this->Cursos_Model->get_where_all('categoria_id', $id);
        echo json_encode($show);
    }

    /**
     *  API para Mostrar os cursos pela categoria selecionada.
     */
    public function cursoMostraCurso($id)
    {
        $show['curso'] = $this->Cursos_Model->get_where('id', $id);
        $show['curso_imagens'] = $this->CursosImagens_Model->get_where_all('curso_id', $id);
        echo json_encode($show);
    }
}
