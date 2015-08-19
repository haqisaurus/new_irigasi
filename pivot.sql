DELIMITER $$

DROP PROCEDURE IF EXISTS `dynamic_view2` $$

CREATE  PROCEDURE `dynamic_view2`( in param1 integer )
BEGIN
		declare finish int default 0;
		declare thisyear varchar(20) default "";
		declare str varchar(10000) default "select date,";
		
		declare years cursor for SELECT YEAR(date) AS tahun FROM (`water`) WHERE `region_id` = 1 AND `date` > '0000-00-00' AND `region_id` = 1 GROUP BY YEAR(date) ORDER BY `date` DESC, `water`.`id` DESC;
		declare continue handler for not found set finish = 1;
		
		open years;
			my_loop:loop
				fetch years into thisyear;
				if finish = 1 then
					leave my_loop;
				end if;
			set str = concat(str, "max(case when YEAR(date) = '", thisyear, "' then `right` else 0 end) as `", thisyear, "`,");
			end loop;
		close years;
		
		set str = substr(str,1,char_length(str)-1);
		set @str = concat(str," from water");
		
		prepare stmt from @str;
		execute stmt;
		deallocate prepare stmt;

END $$

DELIMITER ;

call dynamic_view2(1);
