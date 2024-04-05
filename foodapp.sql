/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.7.33 : Database - app
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `inventory` */

DROP TABLE IF EXISTS `inventory`;

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `item_img` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `desc` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `inventory` */

insert  into `inventory`(`id`,`user_id`,`item`,`item_img`,`quantity`,`desc`) values (14,2,'Ackee and saltfish ','Ackee_and_Saltfish.jpg',100,'Dive into the heart of Jamaican cuisine with Ackee and Saltfish, the national dish that symbolizes the island\'s rich culture and culinary diversity. This beloved meal pairs the unique, buttery ackee fruit with savory salted cod, creating a harmonious blend of flavors that\'s both comforting and exotic. SautÃ©ed with onions, scotch bonnet peppers, and tomatoes, it\'s a vibrant dish that\'s as colorful as it is delicious.'),(15,2,'Cornish Pasty','Cornish_pasty.jpg',100,'The Cornish Pasty, a staple from Cornwall, England, is a savory hand-held pie filled with beef, potatoes, swede, and onions, wrapped in a D-shaped short crust pastry. This hearty meal has become a beloved symbol of Cornish heritage, enjoyed nationwide for its delicious filling and flaky pastry.'),(16,2,'Pakoras','Pakora.jpg',100,'Pakora is a beloved fried snack from the Indian subcontinent, featuring vegetables, meat, or fish coated in a spiced gram flour batter and deep-fried until golden and crispy. Pakoras are a favorite at gatherings for their crunchy texture and flavorful bite. They are especially enjoyed during rainy and cold seasons, offering a warm and comforting treat.'),(17,2,'Dhokla','Dhokla.jpg',100,'Dhokla is a light and spongy vegetarian snack from Gujarat, India, made from fermented rice and chickpea flour batter. It\'s steamed, then seasoned with mustard seeds, green chilies, and curry leaves, and often garnished with coconut and coriander.'),(18,2,'Dim Sum','Dim_Sum.jpg',100,'Indulge in the exquisite tradition of Dim Sum, the heart of Cantonese cuisine, offering an array of bite-sized delights that promise to tantalize your taste buds. From succulent dumplings to fluffy buns and savory pastries, each piece is a masterpiece of flavor, meticulously prepared to offer a unique dining experience.'),(19,2,'Chow Mein','Chow_Mein.jpg',100,'Dive into the rich flavors of Chow Mein, a cornerstone of Chinese cuisine known for its delightful mix of stir-fried noodles, crisp vegetables, and your choice of protein, all tossed in a savory sauce.'),(20,2,'Fish and chips','Fish_and_chips.jpg',100,'Experience the iconic Fish and Chips, a beloved British dish that\'s become a worldwide favorite. Savor the perfect harmony of crispy, golden-battered fish paired with hot, fluffy chips, creating a comforting, and satisfying meal.'),(21,2,'Chicken Biryani','Chicken_biryani.jpg',100,'Embark on a culinary journey with Chicken Biryani, a majestic dish that marries fragrant basmati rice with spiced, tender chicken, all layered with caramelized onions, fresh herbs, and saffron.'),(22,2,'Sushi','Sushi.jpg',100,'Dive into the delicate art of Sushi, a cornerstone of Japanese culinary tradition renowned for its simple elegance and fresh flavors. This exquisite dish features perfectly seasoned sushi rice paired with a variety of toppings, including fresh fish, seafood, and vegetables, meticulously crafted into bite-sized pieces.');

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sales` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` enum('manager','staff','student') DEFAULT 'student',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`role`) values (2,'manager','$2y$10$sLIWGu9Ldd3BSuYMJXA.cu1LxGutsTQnvAa3kx2iS8LDdLdcLC1Bm','manager'),(3,'staff','$2y$10$hb6YqcCYJd2j5U8YsDBDJu8D84K.A6G1otpdk9kEHP/9yvtSnxm4e','staff'),(4,'student','$2y$10$QJKHu8AKiLbtiqpDILXIjuuDknfLOo/wXCyQZZ.gd.MUN7zXBixsi','student');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
