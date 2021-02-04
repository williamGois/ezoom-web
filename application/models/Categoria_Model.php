<?php

class Categoria_Model extends MY_Model
{

  public $id;
  public $nome;
  public $slug;

  // Busca todos registros
  public function get_list()
  {
    $result = $this->db->get('categoria');
    return $result->result();
  }

  // Busca por um registro especifico
  public function get_where($name, $value)
  {
    if (is_null($value)) return $this;

    $this->db->where($name, $value);
    $result = $this->db->get('categoria');
    return $result->first_row(self::class);
  }

  // Busca os produtos por Categoria
  public function get_produtos($slug)
  {
    $this->db->select('produtos.*');
    $this->db->from('produtos');
    $this->db->join('categoria', 'produtos.categoria_id = categoria.id');
    $this->db->where('categoria.slug', $slug);

    $result = $this->db->get();
    return $result->result();
  }

  // Salva a categoria
  public function save()
  {
    //Verfica se exite id
    if (is_null($this->id)) {
      return $this->db->insert('categoria', $this);
    }

    $this->db->where('id', (int) $this->id);
    return $this->db->update('categoria', $this);
  }

  // Deleta uma categoria
  public function delete($id)
  {
    $this->db->where('id', (int) $id);
    return $this->db->delete('categoria');
  }
}
