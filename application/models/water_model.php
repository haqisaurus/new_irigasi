<?php

Class Water_model extends CI_Model
{
    var $table = 'water';

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
        $this->db->where('date > ', '0000-00-00');
        $this->db->order_by('water.id', 'DESC');
        $this->db->distinct();
        $query = $this->db->get_where($this->table, $condition, $limit, $offset);

        return $query;
    }

    public function findASCDate($condition = array(), $limit = null, $offset = null)
    {
        $this->db->order_by('water.date', 'ASC');
        $this->db->group_by('date');
        $query = $this->find($condition, $limit, $offset);

        return $query;
    }

    public function findWithRegion($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('region.*, water.*');
        $this->db->join('region', 'region.id = water.region_id');
        $this->db->order_by('water.date', 'DESC');
        $query = $this->find($condition, $limit, $offset);

        return $query;
    }

    public function findLikeWithRegion($condition = array(), $conditionLike = array(), $limit = null, $offset = null)
    {
        $this->db->select('region.*, water.*');
        $this->db->join('region', 'region.id = water.region_id');
        $this->db->like($conditionLike);
        $this->db->group_by('date');
        $this->db->order_by('water.date', 'DESC');
        $query = $this->find($condition, $limit, $offset);

        return $query;
    }

    public function findLikeWithRegionASC($condition = array(), $conditionLike = array(), $limit = null, $offset = null)
    {
        $this->db->select('region.*, water.*');
        $this->db->join('region', 'region.id = water.region_id');
        $this->db->like($conditionLike);
        $this->db->group_by('date');
        $this->db->order_by('water.date', 'ASC');
        $query = $this->find($condition, $limit, $offset);

        return $query;
    }

    // SELECT EXTRACT(YEAR FROM tanggal) AS tahun FROM q_debit group by YEAR(tanggal)
    public function findYear($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('YEAR(date) AS tahun');
        $this->db->where($condition);
        $this->db->order_by('tahun', 'DESC');
        $this->db->group_by('YEAR(date)');
        $query = $this->find($condition, $limit, $offset);
        return $query;
    }

    public function maxYear($condition = array(), $limit = null, $offset = null)
    {
        $this->db->select('MAX(EXTRACT(YEAR FROM date)) AS max_year');
        $this->db->where($condition);
        $query = $this->find($condition, $limit, $offset);
        return $query;
    }

    public function everyHalfMonth($condition = array(), $limit = null, $offset = null)
    {
        $query = $this->db->query("select *,
                            CONCAT( DATE_FORMAT(`date`, '%b %Y Day ' ),
                                    case when dayofmonth( `date` ) < 16
                                        then '01-15'
                                    else 
                                        CONCAT( '16-', right( last_day( `date` ), 2)  )
                                    end ) as CharMonth,
                            avg(`left`) as kiri,
                            avg(`right`) as kanan,
                            avg(`limpas`) as limpas
                        from 
                            water
                        where
                            " . $condition . "
                        group by
                            CharMonth
                        order by
                            year( `date` ),
                            month( `date` ),
                            min( dayofmonth( `date` ))");

        return $query;
    }

    public function debitIntake($condition = array(), $limit = null, $offset = null)
    {
        $query = $this->db->query("select *,  '" . $condition[0] . " - " . $condition[1] . "' as rentang,
                                         sum(`left`), 
                                         sum(`right`), 
                                         (sum(`left`) + sum(`right`) + sum(`limpas`))  / 15 as intake
                                    FROM (SELECT DISTINCT * from `WATER`GROUP BY date) shortedTable 
                                    WHERE 
                                        date BETWEEN '" . $condition[0] . "' 
                                        AND '" . $condition[1] . "' 
                                        AND region_id = " . $condition[2] ."  
                                    GROUP BY region_id");

        return $query;
    }

}
