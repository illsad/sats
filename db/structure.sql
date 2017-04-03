SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `user_role`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_role` (
  `role_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `role_name` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY (`role_id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user` (
  `user_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `user_name` VARCHAR(100) NULL DEFAULT NULL ,
  `user_full_name` VARCHAR(255) NULL DEFAULT NULL ,
  `user_password` VARCHAR(45) NULL DEFAULT NULL ,
  `user_email` VARCHAR(45) NULL DEFAULT NULL ,
  `user_description` TEXT NULL DEFAULT NULL ,
  `user_role_role_id` INT(11) NULL ,
  `user_is_deleted` TINYINT(1) NULL DEFAULT 0 ,
  `user_input_date` TIMESTAMP NULL DEFAULT NULL ,
  `user_last_update` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP ,
  PRIMARY KEY (`user_id`) ,
  INDEX `fk_user_user_role1_idx` (`user_role_role_id` ASC) ,
  CONSTRAINT `fk_user_user_role1`
    FOREIGN KEY (`user_role_role_id` )
    REFERENCES `user_role` (`role_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `activity_log`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `activity_log` (
  `log_id` INT(11) NOT NULL AUTO_INCREMENT ,
  `log_date` TIMESTAMP NULL DEFAULT NULL ,
  `log_action` VARCHAR(45) NULL DEFAULT NULL ,
  `log_module` VARCHAR(45) NULL DEFAULT NULL ,
  `log_info` TEXT NULL DEFAULT NULL ,
  `user_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`log_id`) ,
  INDEX `fk_g_activity_log_g_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_g_activity_log_g_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `ci_sessions`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ci_sessions` (
  `id` VARCHAR(40) NOT NULL ,
  `ip_address` VARCHAR(45) NOT NULL ,
  `timestamp` INT(10) UNSIGNED NOT NULL DEFAULT '0' ,
  `data` BLOB NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `ci_sessions_timestamp` (`timestamp` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `mediamanager`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mediamanager` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `type` VARCHAR(45) NULL DEFAULT NULL ,
  `isfile` TINYINT(1) NULL DEFAULT '0' ,
  `label` TEXT NULL DEFAULT NULL ,
  `info` TEXT NULL DEFAULT NULL ,
  `upload_at` DATETIME NULL DEFAULT NULL ,
  `album_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `mediamanager_album`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mediamanager_album` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `label` VARCHAR(255) NULL DEFAULT NULL ,
  `upload_at` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;


-- -----------------------------------------------------
-- Table `posts_category`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `posts_category` (
  `category_id` INT NOT NULL AUTO_INCREMENT ,
  `category_name` VARCHAR(100) NULL ,
  PRIMARY KEY (`category_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `posts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `posts` (
  `posts_id` INT NOT NULL AUTO_INCREMENT ,
  `posts_title` VARCHAR(255) NULL ,
  `posts_description` TEXT NULL ,
  `posts_image` VARCHAR(255) NULL ,
  `posts_published_date` TIMESTAMP NULL ,
  `posts_is_published` TINYINT(1) NULL DEFAULT 0 ,
  `posts_category_category_id` INT NULL ,
  `user_user_id` INT(11) NULL ,
  `posts_input_date` TIMESTAMP NULL ,
  `posts_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`posts_id`) ,
  INDEX `fk_posts_posts_category1_idx` (`posts_category_category_id` ASC) ,
  INDEX `fk_posts_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_posts_posts_category1`
    FOREIGN KEY (`posts_category_category_id` )
    REFERENCES `posts_category` (`category_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL,
  CONSTRAINT `fk_posts_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `teachers`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `teachers` (
  `teacher_id` INT NOT NULL AUTO_INCREMENT ,
  `teacher_nik` VARCHAR(20) NULL DEFAULT NULL ,
  `teacher_name` VARCHAR(255) NULL ,
  `teacher_input_date` TIMESTAMP NULL ,
  `teacher_last_update` TIMESTAMP NULL ,
  `teacher_is_deleted` TINYINT(1) NULL DEFAULT 0 ,
  `user_user_id` INT(11) NULL ,
  `teacher_nuptk` INT(25) NULL DEFAULT NULL ,
  `teacher_address` VARCHAR(50) NULL DEFAULT NULL ,
  `teacher_religion` ENUM('Islam','Kristen','Protestan','Budha','Hindu','Konghucu') NOT NULL ,
  `teacher_phone` VARCHAR(20) NULL DEFAULT NULL ,
  `teacher_gender` ENUM('L','P') NOT NULL ,
  `teacher_dob` DATE NOT NULL ,
  `teacher_pob` VARCHAR(50) NOT NULL ,
  PRIMARY KEY (`teacher_id`) ,
  INDEX `fk_teachers_user1_idx` (`user_user_id` ASC) ,
  CONSTRAINT `fk_teachers_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `classes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `classes` (
  `class_id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  `class_level` ENUM('X', 'XI', 'XII') NULL ,
  `class_name` VARCHAR(45) NULL ,
  `class_years` VARCHAR(45) NULL ,
  `class_is_deleted` TINYINT(1) NULL DEFAULT 0 ,
  `user_user_id` INT(11) NULL ,
  `teachers_teacher_id` INT NULL ,
  `class_input_date` TIMESTAMP NULL ,
  `class_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`class_id`) ,
  INDEX `fk_classes_user1_idx` (`user_user_id` ASC) ,
  INDEX `fk_classes_teachers1_idx` (`teachers_teacher_id` ASC) ,
  CONSTRAINT `fk_classes_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_classes_teachers1`
    FOREIGN KEY (`teachers_teacher_id` )
    REFERENCES `teachers` (`teacher_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `students`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `students` (
  `student_id` INT NOT NULL AUTO_INCREMENT ,
  `student_nip` VARCHAR(45) NULL ,
  `student_full_name` VARCHAR(255) NULL ,
  `student_phone` VARCHAR(15) NULL ,
  `student_is_resign` TINYINT(1) NULL DEFAULT 0 ,
  `classes_class_id` INT NULL ,
  `student_is_deleted` TINYINT(1) NULL ,
  `student_input_date` TIMESTAMP NULL ,
  `student_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`student_id`) ,
  INDEX `fk_students_classes1_idx` (`classes_class_id` ASC) ,
  CONSTRAINT `fk_students_classes1`
    FOREIGN KEY (`classes_class_id` )
    REFERENCES `classes` (`class_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `present`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `present` (
  `present_id` INT NOT NULL AUTO_INCREMENT ,
  `present_year` YEAR NULL ,
  `present_month` INT NULL ,
  `present_date` DATE NULL ,
  `present_type` VARCHAR(45) NULL ,
  `present_description` TEXT NULL ,
  `user_user_id` INT(11) NULL ,
  `students_student_id` INT NULL ,
  `classes_class_id` INT NULL ,
  `present_input_date` TIMESTAMP NULL ,
  `present_last_update` TIMESTAMP NULL ,
  PRIMARY KEY (`present_id`) ,
  INDEX `fk_present_user1_idx` (`user_user_id` ASC) ,
  INDEX `fk_present_students1_idx` (`students_student_id` ASC) ,
  INDEX `fk_present_classes1_idx` (`classes_class_id` ASC) ,
  CONSTRAINT `fk_present_user1`
    FOREIGN KEY (`user_user_id` )
    REFERENCES `user` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_present_students1`
    FOREIGN KEY (`students_student_id` )
    REFERENCES `students` (`student_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_present_classes1`
    FOREIGN KEY (`classes_class_id` )
    REFERENCES `classes` (`class_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
