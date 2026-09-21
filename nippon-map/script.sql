-- utf8mb4 pour le multilangue (japonais, emojis) ; _ci = insensible à la casse,
-- et l'algorithme unicode ignore aussi les accents (é = e), donc la recherche est moins contraignante
CREATE DATABASE IF NOT EXISTS nippon_map
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE nippon_map;

-- UNSIGNED : uniquement des valeurs positives. AUTO_INCREMENT impose que la colonne soit une clé
CREATE TABLE IF NOT EXISTS users (
    id_user INT UNSIGNED NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    `role` ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user)
) ENGINE = InnoDB;

-- DECIMAL(9,6) : 9 chiffres au total dont 6 après la virgule (précision d'un GPS standard)
-- Les CHECK empêchent des coordonnées impossibles (MySQL 8.0.16+ / MariaDB 10.2+)
CREATE TABLE IF NOT EXISTS places (
    id_place INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_place VARCHAR(100) NOT NULL,
    japanese_name VARCHAR(50) NULL,
    emoji VARCHAR(16) NULL,
    category VARCHAR(50) NOT NULL,
    lat DECIMAL(9, 6) NOT NULL,
    lon DECIMAL(9, 6) NOT NULL,
    `description` TEXT NULL,
    is_suggested BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id_place),
    INDEX idx_places_category (category),
    CONSTRAINT chk_places_lat CHECK (lat BETWEEN -90 AND 90),
    CONSTRAINT chk_places_lon CHECK (lon BETWEEN -180 AND 180)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS routes (
    id_route INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_route VARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_route),
    CONSTRAINT fk_routes_user
        FOREIGN KEY (id_user) REFERENCES users (id_user)
        ON DELETE CASCADE
) ENGINE = InnoDB;

-- Clé primaire composée : un utilisateur ne peut pas mettre deux fois le même lieu en favori
CREATE TABLE IF NOT EXISTS favorites_places (
    id_user INT UNSIGNED NOT NULL,
    id_place INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_user, id_place),
    CONSTRAINT fk_fav_places_user
        FOREIGN KEY (id_user) REFERENCES users (id_user)
        ON DELETE CASCADE,
    CONSTRAINT fk_fav_places_place
        FOREIGN KEY (id_place) REFERENCES places (id_place)
        ON DELETE CASCADE
) ENGINE = InnoDB;

-- Étapes d'un itinéraire : `position` donne l'ordre (1, 2, 3...).
-- Clé (id_route, position) : deux étapes ne peuvent pas avoir la même position,
-- mais un même lieu peut apparaître deux fois (aller-retour Tokyo -> Kyoto -> Tokyo)
CREATE TABLE IF NOT EXISTS waypoints (
    id_route INT UNSIGNED NOT NULL,
    id_place INT UNSIGNED NOT NULL,
    `position` SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (id_route, `position`),
    CONSTRAINT fk_waypoints_routes
        FOREIGN KEY (id_route) REFERENCES routes (id_route)
        ON DELETE CASCADE,
    CONSTRAINT fk_waypoints_place
        FOREIGN KEY (id_place) REFERENCES places (id_place)
        ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS messages (
    id_message INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name_message VARCHAR(100) NOT NULL,
    email_message VARCHAR(255) NOT NULL,
    `subject` VARCHAR(150) NOT NULL,
    content TEXT NOT NULL,
    `status` ENUM('new', 'processed') NOT NULL DEFAULT 'new',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_message)
) ENGINE = InnoDB;
