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
        $this->db->distinct();
        $this->db->where('date > ', '0000-00-00');
        $this->db->order_by('water.id', 'DESC');
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
        $this->db->distinct();
        // $this->db->where('date > ', '0000-00-00');
        // $this->db->order_by('water.id', 'DESC');
        $query = $this->db->get($this->table, $limit, $offset);
        
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
                                    FROM (SELECT DISTINCT * from `water` GROUP BY date) shortedTable 
                                    WHERE 
                                        date BETWEEN '" . $condition[0] . "' 
                                        AND '" . $condition[1] . "' 
                                        AND region_id = " . $condition[2] ."  
                                    GROUP BY region_id");

        return $query;
    }

    public function intake($condition)
    {
        $query = $this->db->query("select
                
                                        (avg( `right` ) + avg( `left` ) + avg( `limpas`)) as intake
                                    from 
                                        water
                                    where
                                        " . $condition . "
                                    group by
                                        CONCAT( DATE_FORMAT(`date`, '%b %Y Day ' ),
                                             case when dayofmonth( `date` ) < 16
                                                 then '01-15'
                                             else 
                                                 CONCAT( '16-', right( last_day( `date` ), 2)  )
                                             end )    order by
                                        
                                        intake DESC;
                                        
                                   ");

        return $query;
    }
    // select
    //     CONCAT( DATE_FORMAT(`date`, '%b %Y Day ' ),
    //         case when dayofmonth( `date` ) < 16
    //             then '01-15'
    //         else 
    //             CONCAT( '16-', right( last_day( `date` ), 2)  )
    //         end ) as CharMonth,
    //     CONCAT(
    //         case when dayofmonth( `date` ) < 16
    //             then '0'
    //         else 
    //              '1'       
    //         end ) as half,
    //     avg( `right` ) as avRight,
    //     avg( `left` ) as avLeft,
    //     avg( `limpas`) as avLimpas,
    //     (avg( `right` ) + avg( `left` ) + avg( `limpas`)) as intake
    // from 
    //     water
    // where
    //     region_id = 1
    // and 
    //     month(date)=1
    // and 
    //     dayofmonth( `date` ) > 16
    // group by
    //     CONCAT( DATE_FORMAT(`date`, '%b %Y Day ' ),
    //         case when dayofmonth( `date` ) < 16
    //             then '01-15'
    //         else 
    //             CONCAT( '16-', right( last_day( `date` ), 2)  )
    //         end )
    // order by
        
    //     intake DESC
    //     year( `date` ),
    //     month( `date` ),
    //     min( dayofmonth( `date` ))

    public function lastMonthDebit($regionID = 1)
    {

        // SELECT date FROM water WHERE region_id = " . $regionID . " ORDER BY date DESC LIMIT 1 into @lastDate;

        //                             SELECT date FROM water WHERE MONTH(date) = month(@lastDate - INTERVAL 1 MONTH ) and region_id = " . $regionID . " ORDER BY date DESC LIMIT 1 INTO @lastMonth;

        //                             SELECT (avg( `right` ) + avg( `left` ) ) as rata FROM water WHERE 
        //                                     (dayofmonth(@lastDate) < 16 AND 
        //                                     date >= concat(year(@lastMonth),'-', month(@lastMonth),'-01') AND 
        //                                     date < concat(year(@lastMonth),'-', month(@lastMonth),'-16') AND
        //                                     region_id = " . $regionID . "
        //                                     )
                                            
        //                                     or
                                            
        //                                     (dayofmonth(@lastDate) > 15 AND 
        //                                     date > concat(year(@lastMonth),'-', month(@lastMonth),'-15') AND 
        //                                     date <= concat(year(@lastMonth),'-', month(@lastMonth),'-31') AND 
        //                                     region_id = " . $regionID . "
        //                                     )
        $lastDate = $this->db->query("SELECT date FROM water WHERE region_id = " . $regionID . " ORDER BY date DESC LIMIT 1")->row();


        $date = date('Y-m-d', strtotime($lastDate->date));
        $lastMonth = $this->db->query("SELECT date FROM water WHERE MONTH(date) = month(date('" . $date . "') - INTERVAL 1 MONTH ) and region_id = " . $regionID . " ORDER BY date DESC")->row();

        $date = date('d', strtotime($lastDate->date));
        $month = strtotime($lastMonth->date);


        $date1 = date('Y-m-', $month) . '01';
        $date2 = date('Y-m-', $month) . '16';
        $date3 = date('Y-m-', $month) . '15';
        $date4 = date('Y-m-', $month) . '31';

        $sql = "
                                    SELECT (avg( `right` ) + avg( `left` ) ) as rata FROM water WHERE 
                                            (" . $date . " < 16 AND 
                                            date >= '" . $date1 . "' AND 
                                            date < '" . $date2 . "' AND
                                            region_id = " . $regionID . "
                                            )
                                            
                                            or
                                            
                                            (" . $date . " > 15 AND 
                                            date > '" . $date3 . "' AND 
                                            date <= '" . $date4 . "' AND 
                                            region_id = " . $regionID . "
                                            )
                                ";

        return $this->db->query($sql)->row()->rata;
    }
}
