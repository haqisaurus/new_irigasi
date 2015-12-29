<?php

Class Plant_model extends CI_Model
{
    var $table = 'plan_plant';

    public function save($data = array())
    {
        $this->db->trans_start();

        foreach ($data as $key => $item) {
            
            $old = $this->find(array('start' => $item['start'], 'region_id' => $item['region_id'], 'half' => $item['half']));
            if ($old->num_rows()) {
                $this->update(array('id' => $old->row()->id), $item);
                $id = $old->row()->id;
            } else {
                $this->db->insert($this->table, $item);
                $id = $this->db->insert_id();
            }
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
        $query = $this->db->order_by('id', 'DESC')->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

    public function findWithRegion($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('region.*, plan_plant.*');
        $this->db->join('region', 'region.id = plan_plant.region_id');
        $query = $this->db->order_by('plan_plant.id', 'DESC')->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

    public function findRange($value='')
    {
        # code...
    }


}
