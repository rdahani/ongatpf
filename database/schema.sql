-- ============================================================
-- ONG ATPF – Schéma MySQL
-- ============================================================
CREATE DATABASE IF NOT EXISTS ongatpf
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE ongatpf;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS contact_messages;
DROP TABLE IF EXISTS page_views;
DROP TABLE IF EXISTS media;
DROP TABLE IF EXISTS resources;
DROP TABLE IF EXISTS testimonials;
DROP TABLE IF EXISTS partners;
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS project_domains;
DROP TABLE IF EXISTS project_regions;
DROP TABLE IF EXISTS projects;
DROP TABLE IF EXISTS domains;
DROP TABLE IF EXISTS regions;
DROP TABLE IF EXISTS impact_stats;
DROP TABLE IF EXISTS site_settings;
DROP TABLE IF EXISTS admin_users;
DROP TABLE IF EXISTS login_attempts;

SET FOREIGN_KEY_CHECKS = 1;

-- Utilisateurs admin
CREATE TABLE admin_users (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('superadmin','editor','viewer') NOT NULL DEFAULT 'editor',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  last_login_at DATETIME NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE login_attempts (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip_address VARCHAR(45) NOT NULL,
  email VARCHAR(190) NULL,
  attempted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ip_time (ip_address, attempted_at)
) ENGINE=InnoDB;

-- Paramètres / chiffres clés administrables
CREATE TABLE site_settings (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(100) NOT NULL UNIQUE,
  setting_value TEXT NULL,
  setting_type ENUM('text','number','json','boolean','html') NOT NULL DEFAULT 'text',
  label VARCHAR(190) NULL,
  group_name VARCHAR(80) DEFAULT 'general',
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE impact_stats (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  stat_key VARCHAR(80) NOT NULL UNIQUE,
  label VARCHAR(190) NOT NULL,
  value_display VARCHAR(80) NOT NULL DEFAULT '—',
  numeric_value INT NULL,
  suffix VARCHAR(40) NULL,
  prefix VARCHAR(20) NULL DEFAULT '',
  icon VARCHAR(60) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  notes VARCHAR(255) NULL COMMENT 'Source / validation ATPF',
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Régions d'intervention
CREATE TABLE regions (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL,
  slug VARCHAR(80) NOT NULL UNIQUE,
  description TEXT NULL,
  photo VARCHAR(255) NULL,
  map_path_id VARCHAR(40) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB;

-- Domaines d'intervention
CREATE TABLE domains (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(160) NOT NULL,
  slug VARCHAR(160) NOT NULL UNIQUE,
  short_description VARCHAR(400) NOT NULL,
  full_description TEXT NULL,
  icon VARCHAR(60) DEFAULT 'leaf',
  image VARCHAR(255) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_published TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Projets
CREATE TABLE projects (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  summary TEXT NOT NULL,
  content LONGTEXT NULL,
  cover_image VARCHAR(255) NULL,
  gallery JSON NULL,
  zone VARCHAR(255) NULL,
  period_start DATE NULL,
  period_end DATE NULL,
  period_label VARCHAR(120) NULL,
  partner_name VARCHAR(255) NULL,
  status ENUM('active','completed','planned','draft') NOT NULL DEFAULT 'draft',
  beneficiaries_note VARCHAR(255) NULL,
  is_featured TINYINT(1) NOT NULL DEFAULT 0,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  published_at DATETIME NULL,
  meta_title VARCHAR(255) NULL,
  meta_description VARCHAR(320) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_status (status),
  INDEX idx_published (is_published)
) ENGINE=InnoDB;

CREATE TABLE project_regions (
  project_id INT UNSIGNED NOT NULL,
  region_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (project_id, region_id),
  FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE project_domains (
  project_id INT UNSIGNED NOT NULL,
  domain_id INT UNSIGNED NOT NULL,
  PRIMARY KEY (project_id, domain_id),
  FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  FOREIGN KEY (domain_id) REFERENCES domains(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Actualités
CREATE TABLE news (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  category VARCHAR(80) NOT NULL DEFAULT 'Actualité',
  excerpt TEXT NOT NULL,
  content LONGTEXT NOT NULL,
  cover_image VARCHAR(255) NULL,
  author_name VARCHAR(120) DEFAULT 'ATPF',
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  published_at DATETIME NULL,
  meta_title VARCHAR(255) NULL,
  meta_description VARCHAR(320) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_news_pub (is_published, published_at)
) ENGINE=InnoDB;

-- Partenaires
CREATE TABLE partners (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(190) NOT NULL,
  slug VARCHAR(190) NOT NULL UNIQUE,
  logo VARCHAR(255) NULL,
  website VARCHAR(255) NULL,
  description TEXT NULL,
  partner_type ENUM('bailleur','technique','institutionnel','reseau','autre') DEFAULT 'bailleur',
  sort_order INT NOT NULL DEFAULT 0,
  is_published TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Témoignages (placeholders jusqu'à validation ATPF)
CREATE TABLE testimonials (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  role_title VARCHAR(160) NULL,
  community VARCHAR(160) NULL,
  quote TEXT NOT NULL,
  photo VARCHAR(255) NULL,
  is_placeholder TINYINT(1) NOT NULL DEFAULT 1,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  sort_order INT NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Ressources / publications
CREATE TABLE resources (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  resource_type ENUM('rapport','publication','brochure','media','autre') DEFAULT 'rapport',
  description TEXT NULL,
  file_path VARCHAR(255) NULL,
  external_url VARCHAR(255) NULL,
  cover_image VARCHAR(255) NULL,
  year SMALLINT NULL,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  published_at DATETIME NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Médias
CREATE TABLE media (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  filename VARCHAR(255) NOT NULL,
  original_name VARCHAR(255) NOT NULL,
  mime_type VARCHAR(100) NOT NULL,
  file_size INT UNSIGNED NOT NULL,
  alt_text VARCHAR(255) NULL,
  folder VARCHAR(80) DEFAULT 'general',
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Messages contact
CREATE TABLE contact_messages (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  organization VARCHAR(190) NULL,
  email VARCHAR(190) NOT NULL,
  phone VARCHAR(60) NULL,
  subject VARCHAR(255) NOT NULL,
  message TEXT NOT NULL,
  ip_address VARCHAR(45) NULL,
  is_read TINYINT(1) NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
