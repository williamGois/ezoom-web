<?php

class Produtos_Model extends MY_Model
{
  public $id;
  public $titulo;
  public $slug;
  public $imagem;
  public $descricao;
  public $categoria_id;

  // Mostra todos Produtos
  public function get_list($inicio = 0, $limite = 100)
  {
    $this->db->limit($limite, $inicio);
    $this->db->order_by('id', 'desc');

    $result = $this->db->get('produtos');
    return $result->result();
  }

  // Busca um Produto.
  public function get_where($name, $value)
  {
    if (is_null($value)) return $this;

    $this->db->where($name, $value);
    $result = $this->db->get('produtos');
    return $result->first_row(self::class);
  }

  // Busca todos Produtos.
  public function get_where_all($name, $value)
  {
    if (is_null($value)) return $this;

    $this->db->where($name, $value);
    $result = $this->db->get('produtos');
    return $result->result();
  }

  // Salva um produto
  public function save()
  {
    if (is_null($this->id)) {
      return $this->db->insert('produtos', $this);
    }

    $this->db->where('id', (int) $this->id);
    return $this->db->update('produtos', $this);
  }

  // Deleta um registro.
  public function delete()
  {
    $this->db->where('id', (int) $this->id);
    return $this->db->delete('produtos');
  }

  /* ------------------------------------------------------------ */

  // Numero de registros.
  public function count()
  {
    $result = $this->db->query('SELECT COUNT(id) AS count FROM produtos');
    $row = $result->row_array();

    return (int) $row['count'];
  }

  // Verfica se registro é Produto.
  public function is_unique($name, $value)
  {
    $this->db->limit(1);
    $this->db->where($name, $value);

    if (!is_null($this->id)) {
      $this->db->where('id !=', $this->id);
    }

    return $this->db->get('produtos')->num_rows() === 0;
  }

  /* ------------------------------------------------------------ */
}
