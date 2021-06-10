create database file_hosting;

use file_hosting;

create table role(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
name varchar(20) NOT NULL,
description varchar(100) NOT NULL
);

INSERT INTO role (id, name, description) VALUES (1, "user", "small boy");
INSERT INTO role (id, name, description) VALUES (2, "moderator", "middle boy");
INSERT INTO role (id, name, description) VALUES (3, "administrator", "major boy");

create table user (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
email varchar(100) NOT NULL,
name varchar(100) NOT NULL,
avatar varchar(100),
hash_password varchar(100) NOT NULL,
date_create TIMESTAMP NOT NULL,
count_uploaded_files INT(5) NOT NULL DEFAULT 0,
raiting INT(5) NOT NULL DEFAULT 0,
role_id INT NOT NULL DEFAULT 1,
FOREIGN KEY (role_id) REFERENCES role (id)
);

create table file (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
date_upload TIMESTAMP NOT NULL,
raiting INT(5) NOT NULL DEFAULT 0,
name varchar(100) NOT NULL,
hash varchar(100) NOT NULL,
type varchar(100) NOT NULL,
size varchar(100) NOT NULL,
user_id INT NOT NULL,
FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE
);

create table score_file (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
file_id INT NOT NULL,
type_score INT CHECK (type_score = 1 OR type_score = -1),
FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE
);

create table score_user (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
user_id_received INT NOT NULL,
type_score INT CHECK (type_score = 1 OR type_score = -1),
FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
FOREIGN KEY (user_id_received) REFERENCES user (id) ON DELETE CASCADE
);

create table comment (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT NOT NULL,
file_id INT NOT NULL,
content varchar(300) NOT NULL,
date_create TIMESTAMP NOT NULL,
raiting INT(5) NOT NULL DEFAULT 0,
FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE,
FOREIGN KEY (file_id) REFERENCES file (id) ON DELETE CASCADE
);

create table logging (
date TIMESTAMP NOT NULL,
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT,
action varchar(50) NOT NULL,
object_id varchar(50),
ip varchar(25) NOT NULL,
call_from varchar(50) NOT NULL
);

create table statistics (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
count_administrators INT NOT NULL DEFAULT 0,
count_moderators INT NOT NULL DEFAULT 0,
count_users INT NOT NULL DEFAULT 0,
count_upload_files INT NOT NULL DEFAULT 0,
count_comments INT NOT NULL DEFAULT 0,
count_download_files INT NOT NULL DEFAULT 0
);

INSERT INTO statistics (id, count_administrators, count_moderators, count_users, count_upload_files, count_comments, count_download_files) VALUES (1, 0, 0, 0, 0, 0, 0);



