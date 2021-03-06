<?php

Class User_model extends CI_Model
{
    var $table = 'user';

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

    public function findWithRole($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('role.*, user.*');
        $this->db->join('role', 'role.id = user.role_id');
        $this->db->order_by('user.id', 'DESC');
        $this->db->group_by('user.id');
        $query = $this->db->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

    

    public function login($username, $password)
    {
        $this->db->select('id, username, first_name, last_name, role_id');
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if($query->num_rows() == 1)
        {
            return $query;
        }
        else
        {
            return false;
        }
    }

    public function insertRelRegion($data = array())
    {
        $this->db->trans_start();

        $this->db->insert_batch('region_user', $data); 

        if ($this->db->trans_status()) {
            $this->db->trans_commit();
            return array('status' => 1);
        } else {
            $this->db->trans_rollback();
            return array('status' => 0);
        }
    }

 
    public function deleteRelRegion($condition = array())
    {
        $this->db->trans_start();

        $this->db->where($condition);
        $this->db->delete('region_user'); 

        if ($this->db->trans_status()) {
            $this->db->trans_commit();
            return array('status' => 1);
        } else {
            $this->db->trans_rollback();
            return array('status' => 0);
        }

    }
}
