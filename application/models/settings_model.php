<?php

Class Settings_model extends CI_Model
{
    var $table = 'settings';

    public function save($data = array())
    {
        $this->db->trans_start();

        $old = $this->db->get($this->table, array('key' => $data['key']));

        if ($old->num_rows()) {
            $this->db->where('id', $old->row()->id);
            $this->db->update($this->table, $data);
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

    public function getItem($key = '')
    {
        return $this->db->get_where('settings', array('key' => $key));
    }
}
?>