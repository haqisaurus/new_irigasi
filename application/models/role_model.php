<?php

Class Role_model extends CI_Model
{
    var $table = 'role';

    public function find($condition = array(), $limit = null, $offset = null)
    {
        $query = $this->db->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }
}
