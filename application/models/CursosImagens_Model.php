<?php

class CursosImagens_Model extends MY_Model
{
    public $id;
    public $imagem;
    public $curso_id;

    // Mostra todos Imagems do Cursos
    public function get_list($inicio = 0, $limite = 100)
    {
        $this->db->limit($limite, $inicio);
        $this->db->order_by('id', 'desc');

        $result = $this->db->get('cursos_imagens');
        return $result->result();
    }

    // Busca uma Imagems do Curso.
    public function get_where($name, $value)
    {
        if (is_null($value)) return $this;

        $this->db->where($name, $value);
        $result = $this->db->get('cursos_imagens');
        return $result->first_row(self::class);
    }

     // Busca todas Imagems do Curso.
     public function get_where_all($name, $value)
     {
         if (is_null($value)) return $this;
 
         $this->db->where($name, $value);
         $result = $this->db->get('cursos_imagens');
         return $result->result();
     }

    // Salva uma Imagem do curso
    public function save()
    {
        if (is_null($this->id)) {
            return $this->db->insert('cursos_imagens', $this);
        }

        $this->db->where('id', (int) $this->id);
        return $this->db->update('cursos_imagens', $this);
    }

    // Deleta um registro.
    public function delete()
    {
        $this->db->where('id', (int) $this->id);
        return $this->db->delete('cursos_imagens');
    }

    /* ------------------------------------------------------------ */

    // Numero de registros.
    public function count()
    {
        $result = $this->db->query('SELECT COUNT(id) AS count FROM cursos_imagens');
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

        return $this->db->get('cursos_imagens')->num_rows() === 0;
    }

    /* ------------------------------------------------------------ */
}
