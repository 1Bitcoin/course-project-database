DELIMITER //  
  
CREATE PROCEDURE `update_scores` (in id int)  
BEGIN  

    DECLARE done INT DEFAULT FALSE;
    DECLARE received_id, score INT;
    DECLARE cur1 CURSOR FOR SELECT file_id, type_score FROM score_file;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur1;
    
    read_loop: LOOP
        IF done THEN
            LEAVE read_loop;
        END IF;
        
        FETCH cur1 INTO received_id, score;

    END LOOP;
    
    CLOSE cur1;    
          

END //  