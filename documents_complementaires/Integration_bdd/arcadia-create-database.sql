--
-- Base de données : `arcadia`
--
CREATE DATABASE IF NOT EXISTS `arcadiadb`;
USE `arcadiadb`;

-- CREATE TABLE IF NOT EXISTS `veterinarian_report`

-- Structure de la table `animals`
CREATE TABLE `animals` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `status` varchar(100) NULL,
  `image` longblob NOT NULL,
  `habitat_id` int(11) NOT NULL,
  `race_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `avis`
CREATE TABLE `avis` (
  `id` int(11) NOT NULL auto_increment,
  `pseudo` varchar(50) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `isVisible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `food_consumption`
CREATE TABLE `food_consumption` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `food_type` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `animal_id` int(11) NOT NULL,
  `user_username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `habitats`
CREATE TABLE `habitats` (
  `id` int(11) NOT NULL auto_increment,
  `nom` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `comment` varchar(255) NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `habitat_image`
CREATE TABLE `habitat_image` (
  `id` int(11) NOT NULL auto_increment,
  `habitat_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `images`
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `race`
CREATE TABLE `race` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `role`
CREATE TABLE `role` (
  `id` int(11) NOT NULL auto_increment,
  `label` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `services`
CREATE TABLE `services` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` longblob NOT NULL,
  `description_additional` varchar(155) NULL,
  PRIMARY KEY (`id`)
);


-- Structure de la table `users`
CREATE TABLE `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`username`)
);


-- Structure de la table `veterinarian_report`
CREATE TABLE `veterinarian_report` (
  `id` int(11) NOT NULL auto_increment,
  `date` date NOT NULL,
  `food_type` varchar(50) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `status_detail` varchar(200) NULL,
  `animal_id` int(11) NOT NULL,
  `veterinarian_username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
);


-- Contraintes pour les tables déchargées

-- Contraintes pour la table `animals`
ALTER TABLE `animals`
  ADD CONSTRAINT `FK_habitats_animals` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`),
  ADD CONSTRAINT `FK_race_animals` FOREIGN KEY (`race_id`) REFERENCES `race` (`id`);


-- Contraintes pour la table `food_consumption`
ALTER TABLE `food_consumption`
  ADD CONSTRAINT `FK_users_food_consumption` FOREIGN KEY (`user_username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `FK_animals_food_consumption` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`);


-- Contraintes pour la table `habitat_image`
ALTER TABLE `habitat_image`
  ADD CONSTRAINT `FK_habitats_habitat_image` FOREIGN KEY (`habitat_id`) REFERENCES `habitats` (`id`),
  ADD CONSTRAINT `FK_images_habitat_image` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);


-- Contraintes pour la table `users`
ALTER TABLE `users`
  ADD CONSTRAINT `FK_role_users` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);


-- Contraintes pour la table `veterinarian_report`
ALTER TABLE `veterinarian_report`
  ADD CONSTRAINT `FK_users_report` FOREIGN KEY (`veterinarian_username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `FK_animal_report` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`id`);
