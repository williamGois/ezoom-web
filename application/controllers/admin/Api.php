<?php

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categoria_Model');
        $this->load->model('Produtos_Model');
        $this->load->model('ProdutosImagens_Model');
    }

    /**
     *  API para Mostrar os produtos.
     */
    public function produtos()
    {
        $index['produtos'] = $this->Produtos_Model->get_list();
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
     *  API para Mostrar os produtos pela categoria selecionada.
     */
    public function produtoBuscaProdutoPorCategoria($id)
    {
        $show['produto'] = $this->Produtos_Model->get_where_all('categoria_id', $id);
        echo json_encode($show);
    }

    /**
     *  API para Mostrar os produtos pela categoria selecionada.
     */
    public function produtoMostraProduto($id)
    {
        $show['produto'] = $this->Produtos_Model->get_where('id', $id);
        $show['produto_imagens'] = $this->ProdutosImagens_Model->get_where_all('produto_id', $id);
        echo json_encode($show);
    }
}
