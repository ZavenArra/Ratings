CREATE TABLE `ratings` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`object_id` int(11) NOT NULL,
	`object_type_id` int(11) NOT NULL,
	`rating` tinyint(4) NOT NULL,
	PRIMARY KEY (`id`)
); 
