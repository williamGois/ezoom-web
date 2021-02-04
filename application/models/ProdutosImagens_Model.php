<?php

class ProdutosImagens_Model extends MY_Model
{
    public $id;
    public $imagem;
    public $produto_id;

    // Mostra todos Imagems do Produtos
    public function get_list($inicio = 0, $limite = 100)
    {
        $this->db->limit($limite, $inicio);
        $this->db->order_by('id', 'desc');

        $result = $this->db->get('produtos_imagens');
        return $result->result();
    }

    // Busca uma Imagems do Produto.
    public function get_where($name, $value)
    {
        if (is_null($value)) return $this;

        $this->db->where($name, $value);
        $result = $this->db->get('produtos_imagens');
        return $result->first_row(self::class);
    }

     // Busca todas Imagems do Produto.
     public function get_where_all($name, $value)
     {
         if (is_null($value)) return $this;
 
         $this->db->where($name, $value);
         $result = $this->db->get('produtos_imagens');
         return $result->result();
     }

    // Salva uma Imagem do produto
    public function save()
    {
        if (is_null($this->id)) {
            return $this->db->insert('produtos_imagens', $this);
        }

        $this->db->where('id', (int) $this->id);
        return $this->db->update('produtos_imagens', $this);
    }

    // Deleta um registro.
    public function delete()
    {
        $this->db->where('id', (int) $this->id);
        return $this->db->delete('produtos_imagens');
    }

    /* ------------------------------------------------------------ */

    // Numero de registros.
    public function count()
    {
        $result = $this->db->query('SELECT COUNT(id) AS count FROM produtos_imagens');
        $row = $result->row_array();

        return (int) $row['count'];
    }

    public function is_unique($name, $value)
    {
        $this->db->limit(1);
        $this->db->where($name, $value);

        if (!is_null($this->id)) {
            $this->db->where('id !=', $this->id);
        }

        return $this->db->get('produtos_imagens')->num_rows() === 0;
    }

    /* ------------------------------------------------------------ */
}
