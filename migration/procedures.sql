use file_hosting;

CREATE PROCEDURE `update_score_user_after_delete_user`(in id int)
begin
	declare received_id, score INT;
    declare my_count INT;
	DECLARE cur1 CURSOR FOR SELECT user_id_received, type_score FROM score_user WHERE user_id = id;

	SELECT COUNT(*) INTO my_count FROM score_user WHERE user_id = id;
	OPEN cur1;
	while my_count > 0 do 
		set my_count = my_count - 1;
		FETCH cur1 INTO received_id, score;
  		if score > 0 then
          UPDATE user SET raiting = raiting - 1 where user.id = received_id;
		else 
          UPDATE user SET raiting = raiting + 1 where user.id = received_id;   
		end if;
	end while;
    
	CLOSE cur1;    
 end

CREATE PROCEDURE `update_count_users`()
BEGIN
	declare number_users, number_moderators, number_administrators, score INT;

	SELECT COUNT(*) INTO number_users FROM user WHERE role_id = 1;
    SELECT COUNT(*) INTO number_moderators FROM user WHERE role_id = 2;
    SELECT COUNT(*) INTO number_administrators FROM user WHERE role_id = 3;
    
	UPDATE statistics SET count_users = number_users where statistics.id = 1;
    UPDATE statistics SET count_moderators = number_moderators where statistics.id = 1;
    UPDATE statistics SET count_administrators = number_administrators where statistics.id = 1;
END

CREATE PROCEDURE `update_score_file_before_delete_user`(in id int)
begin
	declare received_id, score INT;
    declare my_count INT;
	DECLARE cur1 CURSOR FOR SELECT file_id, type_score FROM score_file WHERE user_id = id;

	SELECT COUNT(*) INTO my_count FROM score_file WHERE user_id = id;
	OPEN cur1;
	while my_count > 0 do 
		set my_count = my_count - 1;
		FETCH cur1 INTO received_id, score;
  		if score > 0 then
          UPDATE file SET raiting = raiting - 1 where file.id = received_id;
		else 
          UPDATE file SET raiting = raiting + 1 where file.id = received_id;   
		end if;
	end while;
	CLOSE cur1;    
 end