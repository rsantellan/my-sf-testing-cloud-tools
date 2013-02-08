CREATE TABLE my_album (id INT AUTO_INCREMENT, title VARCHAR(64) NOT NULL, description VARCHAR(255), type VARCHAR(255) DEFAULT 'Mixed', deleteallowed bool NOT NULL, my_file_id INT, object_class_name VARCHAR(128) NOT NULL, object_id INT NOT NULL, allowed_types VARCHAR(128), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE my_category_translation (id INT, name VARCHAR(100) NOT NULL, description VARCHAR(255), lang CHAR(2), slug VARCHAR(255), UNIQUE INDEX my_category_translation_sluggable_idx (slug, lang, name, id), PRIMARY KEY(id, lang)) ENGINE = INNODB;
CREATE TABLE my_category (id INT AUTO_INCREMENT, label VARCHAR(100) NOT NULL UNIQUE, object_class_name VARCHAR(100) NOT NULL, my_category_parent_id INT, priority SMALLINT DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX my_category_parent_id_idx (my_category_parent_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE my_category_object (object_id INT, my_category_id INT, object_class_name VARCHAR(250), priority SMALLINT DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(object_id, my_category_id, object_class_name)) ENGINE = INNODB;
CREATE TABLE my_test_translation (id INT, title VARCHAR(255) NOT NULL, body TEXT NOT NULL, lang CHAR(2), slug VARCHAR(255), UNIQUE INDEX my_test_translation_sluggable_idx (slug, lang, title), PRIMARY KEY(id, lang)) ENGINE = INNODB;
CREATE TABLE my_test (id INT AUTO_INCREMENT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE my_uploaded (id INT AUTO_INCREMENT, my_album_id INT, name VARCHAR(64) NOT NULL, filename VARCHAR(64) NOT NULL, description VARCHAR(255), path VARCHAR(255), filetype VARCHAR(64) NOT NULL, priority INT DEFAULT 0, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX my_album_id_idx (my_album_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE my_category_translation ADD CONSTRAINT my_category_translation_id_my_category_id FOREIGN KEY (id) REFERENCES my_category(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE my_category ADD CONSTRAINT my_category_my_category_parent_id_my_category_id FOREIGN KEY (my_category_parent_id) REFERENCES my_category(id) ON DELETE CASCADE;
ALTER TABLE my_category_object ADD CONSTRAINT my_category_object_my_category_id_my_category_id FOREIGN KEY (my_category_id) REFERENCES my_category(id) ON DELETE CASCADE;
ALTER TABLE my_test_translation ADD CONSTRAINT my_test_translation_id_my_test_id FOREIGN KEY (id) REFERENCES my_test(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE my_uploaded ADD CONSTRAINT my_uploaded_my_album_id_my_album_id FOREIGN KEY (my_album_id) REFERENCES my_album(id);
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
