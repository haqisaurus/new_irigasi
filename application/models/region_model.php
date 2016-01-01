<?php

Class Region_model extends CI_Model
{
    var $table = 'region';

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

    public function regionWithWide($condition = array(), $limit = null, $offset = null)
    {
        $this->db->join('wide', 'region.id = wide.region_id');
        $query = $this->find($condition, $limit, $offset);
        return $query;
    }

    public function regionWithTotalWide($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('sum(wide) as total_wide, wide.*');
        $this->db->join('wide', 'region.id = wide.region_id');
        $query = $this->find($condition, $limit, $offset);
        return $query;
    }

    public function findRelRegion($condition = array(), $limit = null, $offset = null)
    {   
        $this->db->select('user.*, region.*');
        $this->db->where('user.role_id', 2);
        $this->db->join('user', 'region_user.user_id = user.id');
        $this->db->join('region', 'region_user.region_id = region.id');
        $query = $this->db->get_where('region_user', $condition, $limit, $offset);
        return $query;
    }

}
