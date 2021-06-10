CREATE DEFINER=`root`@`83.149.21.177` TRIGGER `file_hosting`.`user_AFTER_INSERT` AFTER INSERT ON `user` FOR EACH ROW
BEGIN
	call update_count_users();
END

CREATE DEFINER=`root`@`83.149.21.177` TRIGGER `file_hosting`.`user_AFTER_UPDATE` AFTER UPDATE ON `user` FOR EACH ROW
BEGIN
	call update_count_users();
END

CREATE DEFINER=`root`@`83.149.21.177` TRIGGER `file_hosting`.`user_BEFORE_DELETE` BEFORE DELETE ON `user` FOR EACH ROW
BEGIN
	call update_score_file_before_delete_user(OLD.id);
END