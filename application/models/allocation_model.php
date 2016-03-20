<?php

Class Allocation_model extends CI_Model
{
    var $table = 'allocation';

    public function save($data = array())
    {
        $this->db->trans_start();

            
        $old = $this->find(array('year' => $data['year'], 'region_id' => $data['region_id'], 'periode' => $data['periode']));
        if ($old->num_rows()) {
            $this->update(array('id' => $old->row()->id), $data);
            $id = $old->row()->id;
        } else {
            $this->db->insert($this->table, $data);
            $id = $this->db->insert_id();
        }


        if ($this->db->trans_status()) {
            $this->db->trans_commit();
            return array('status' => 1, 'data' => $id );
        } else {
            $this->db->trans_rollback();
            return array('status' => 0);
        }
    }

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

    public function find($condition = array(), $limit = null, $offset = null)
    {
        $query = $this->db->order_by('id', 'DESC')->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

    public function findWithRegion($condition = array(), $limit = null, $offset = null)
    {
        $query = $this->db
                ->join('region', 'region.id = region_id')
                ->order_by('allocation.id', 'DESC')
                ->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

}