<?php

Class Wide_model extends CI_Model
{
    var $table = 'wide';

    public function insert($data = array())
    {
        $this->db->trans_start();

        $this->db->insert($this->table, $data); 

        if ($this->db->trans_status()) {
            $this->db->trans_commit();
            return array('status' => 1);
        } else {
            $this->db->trans_rollback();
            return array('status' => 0);
        }

    }

    public function update($condition = array(), $data = array())
    {
        $this->db->trans_start();

        $this->db->where($condition);
        $this->db->update($this->table, $data); 

        if ($this->db->trans_status()) {
            $this->db->trans_commit();
            return array('status' => 1);
        } else {
            $this->db->trans_rollback();
            return array('status' => 0);
        }

    }

    public function delete($condition = array())
    {
        $this->db->trans_start();

        $this->db->where($condition);
        $this->db->delete($this->table); 

        if ($this->db->trans_status()) {
            $this->db->trans_commit();
            return array('status' => 1);
        } else {
            $this->db->trans_rollback();
            return array('status' => 0);
        }

    }

    public function find($condition = array(), $limit = null, $offset = null)
    {
        $query = $this->db->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

    public function findWithRegion($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('region.*, wide.*');
        $this->db->join('region', 'region.id = wide.region_id');
        $query = $this->find($condition, $limit, $offset);

        return $query;
    }

    public function findRegionWide($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('sum(wide) as total_wide');
        $query = $this->find($condition, $limit, $offset);
        
        return $query;
    }
}
