CREATE TABLE `lenses` ( `id` INT NOT NULL AUTO_INCREMENT , `customer_id` INT(11) NOT NULL , `doctor_id` INT(11) NOT NULL , `invoice_id` INT(11) NOT NULL , `visit_date` TIMESTAMP NULL , `sph_right_sign` VARCHAR(256) NULL , `sph_right` FLOAT NULL , `axis_right` FLOAT NULL , `addition_right` FLOAT NULL , `prism_right` FLOAT NULL , `prism_base_right` FLOAT NULL , `pd_right` FLOAT NULL , `power_right` FLOAT NULL , `base_curve_right` FLOAT NULL , `dec_right` FLOAT NULL , `diameter_right` FLOAT NULL , `cyl_right_sign` VARCHAR(256) NULL , `cyl_right` FLOAT NULL , `sph_left_sign` INT NULL , `sph_left` INT NULL , `axis_left` INT NULL , `addition_left` INT NULL , `prism_left` INT NULL , `prism_base_left` INT NULL , `pd_left` INT NULL , `power_left` INT NULL , `base_curve_left` INT NULL , `dec_left` INT NULL , `diameter_left` INT NULL , `cyl_left_sign` INT NULL , `cyl_left` INT NULL , `right_diagnosis` TEXT NULL , `left_diagnosis` TEXT NULL , `glasses-type` VARCHAR(256) NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;


CREATE TABLE `payments` ( `id` INT NOT NULL AUTO_INCREMENT , `invoice_id` INT(11) NULL , `type` VARCHAR(256) NULL , `bank` VARCHAR(256) NULL , `card_number` INT(11) NULL , `expiration_date` DATE NULL , `currency` VARCHAR(256) NULL , `payed_amount` FLOAT(11) NULL , `exchange_rate` INT(11) NULL , `Local Payment` FLOAT(11) NULL , `created_at` TIMESTAMP NULL , `updated_at` TIMESTAMP NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;