-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: shopwise
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aboutus`
--

DROP TABLE IF EXISTS `aboutus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aboutus` (
  `about_id` int(11) NOT NULL AUTO_INCREMENT,
  `about_title` varchar(100) NOT NULL,
  `about_desc` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`about_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aboutus`
--

LOCK TABLES `aboutus` WRITE;
/*!40000 ALTER TABLE `aboutus` DISABLE KEYS */;
INSERT INTO `aboutus` VALUES (1,'Company Overview','<p>Konga.com is Nigeria&#39;s largest online mall. We launched in July 2012 and our mission is to become the engine of commerce and trade in Africa.</p>\n\n<p>We serve a retail customer base that continues to grow exponentially, offering products that span various categories including Phones, Computers, Clothing, Shoes, Home Appliances, Books, healthcare, Baby Products, personal care and much more.</p>\n\n<p>Our range of services are designed to ensure optimum levels of convenience and customer satisfaction with the retail process; these services include our lowest price guarantee, 7-day free return policy*, order delivery-tracking, dedicated customer service support and many other premium services.</p>\n\n<p>As we continue to expand the mall, our scope of offerings will increase in variety, simplicity and convenience; join us and enjoy the increasing benefits.</p>\n\n<p>We are highly customer-centric and are committed towards finding innovative ways of improving our customers&#39; shopping experience with us; so give us some feedback on help@konga.com. For any press related questions, kindly send us an email at press@konga.com.</p>\n\n<p>Thank you and we hope you enjoy your experience with us.</p>\n\n<p>*Available for select stores</p>\n','2022-05-11 14:14:36');
/*!40000 ALTER TABLE `aboutus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adverts`
--

DROP TABLE IF EXISTS `adverts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adverts` (
  `ads_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `ads_image` varchar(255) NOT NULL,
  `ads_link` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ads_id`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adverts`
--

LOCK TABLES `adverts` WRITE;
/*!40000 ALTER TABLE `adverts` DISABLE KEYS */;
INSERT INTO `adverts` VALUES (1,'onyedikachukwu62@gmail.com','advert/cf4807c53d.jpg','http://shopwise.web/','2022-05-19 23:53:44'),(2,'onyedikachukwu62@gmail.com','advert/32bc7ba156.jpg','http://shopwise.web/subcategory/Shoes','2022-05-19 23:55:21'),(3,'onyedikachukwu62@gmail.com','advert/c1bb8b80b5.jpg','http://shopwise.web/subcategory/Clothing','2022-05-19 23:56:08'),(4,'onyedikachukwu62@gmail.com','advert/4d78f518a0.jpg','http://shopwise.web/subcategory/Wigs-Accessories','2022-05-19 23:56:28');
/*!40000 ALTER TABLE `adverts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_id` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `discount_price` varchar(20) NOT NULL,
  `product_qty` varchar(20) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `s_id` (`s_id`),
  KEY `user_email` (`user_email`),
  KEY `product_slug` (`product_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_img` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cat_id`),
  KEY `cat_name` (`cat_name`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'onyedikachukwu62@gmail.com','Fashion','catimage/414e543b46.jpg','2022-05-18 07:47:32'),(2,'onyedikachukwu62@gmail.com','Beauty','catimage/68149c7eb1.jpeg','2022-05-18 08:12:38');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(30) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_qty` varchar(20) NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `status` varchar(30) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `date_purchased` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(50) NOT NULL,
  `delivery_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `delivery_date` datetime DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `order_no` (`order_no`),
  KEY `user_email` (`user_email`),
  KEY `product_name` (`product_name`),
  KEY `product_qty` (`product_qty`),
  KEY `email` (`email`),
  KEY `delivery_status` (`delivery_status`),
  KEY `delivery_date` (`delivery_date`),
  KEY `date_purchased` (`date_purchased`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'295543','emmachukwu852@gmail.com','Vintage Striped Shirt','1','10780','../admin/upload/emmachukwu852@gmail.com/01549b8e21.jpg','success','BH342703841','Chukwuneke Onyedika','2022-05-25 22:22:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(2,'295543','onyedikachukwu62@gmail.com','Nike Air Force','1','11400','../admin/upload/onyedikachukwu62@gmail.com/09a8496b0e.jpg','success','BH342703841','Chukwuneke Onyedika','2022-05-25 22:22:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(3,'106719','bradwick789@gmail.com','The Naomi Luxe Unit','1','27000','../admin/upload/bradwick789@gmail.com/eb114e7d0d.jpg','success','BH624628895','Chukwuneke Onyedika','2022-05-25 22:27:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(4,'106719','bradwick789@gmail.com','The Bianca Unit','1','145500','../admin/upload/bradwick789@gmail.com/a2f5e6436e.jpg','success','BH624628895','Chukwuneke Onyedika','2022-05-25 22:27:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(5,'106719','onyedikachukwu62@gmail.com','Nike Air Force','1','11400','../admin/upload/onyedikachukwu62@gmail.com/09a8496b0e.jpg','success','BH624628895','Chukwuneke Onyedika','2022-05-25 22:27:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(6,'38411','bradwick789@gmail.com','The Bianca Unit','1','145500','../admin/upload/bradwick789@gmail.com/a2f5e6436e.jpg','success','BH852329426','Chukwuneke Onyedika','2022-05-25 23:05:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(7,'38411','onyedikachukwu62@gmail.com','Adidas Rod Laver','1','15000','../admin/upload/onyedikachukwu62@gmail.com/d5b56ad371.jpg','success','BH852329426','Chukwuneke Onyedika','2022-05-25 23:05:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(8,'38411','emmachukwu852@gmail.com','Vintage Shirt','1','12740','../admin/upload/emmachukwu852@gmail.com/1405a1e8d9.jpg','success','BH852329426','Chukwuneke Onyedika','2022-05-25 23:05:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(9,'771348','onyedikachukwu62@gmail.com','Versace Shoe','1','23750','../admin/upload/onyedikachukwu62@gmail.com/3314898672.jpg','success','BH290491511','Chukwuneke Onyedika','2022-05-27 19:44:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL),(10,'771348','emmachukwu852@gmail.com','Vintage Shirt','1','12740','../admin/upload/emmachukwu852@gmail.com/1405a1e8d9.jpg','success','BH290491511','Chukwuneke Onyedika','2022-05-27 19:44:00','onyedikachukwu62@gmail.com','08185764594','2 Bello Street','Lagos','Orile Iganmu','Pending',NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privacy`
--

DROP TABLE IF EXISTS `privacy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privacy` (
  `privacy_id` int(11) NOT NULL AUTO_INCREMENT,
  `privacy_title` varchar(100) NOT NULL,
  `privacy_desc` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`privacy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privacy`
--

LOCK TABLES `privacy` WRITE;
/*!40000 ALTER TABLE `privacy` DISABLE KEYS */;
INSERT INTO `privacy` VALUES (1,'Privacy & Cookie Notice','<p>Jumia is the trading name for Ecart Internet Services Nigeria Ltd., registered company number 1191244, and whose buisness address is at 349, Herbert Macaulay Way, Yaba, Lagos State. The email address for service of any legal notices is Nigeria.Legal@Jumia.com</p>\r\n\r\n<p>Contents:<br />\r\n&nbsp;</p>\r\n\r\n<ul>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q1\\\">About this Privacy and Cookie Notice</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q2\\\">The data we collect about you</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q3\\\">Cookies and how we use them</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q4\\\">How we use your personal data</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q5\\\">How we share your personal data</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q6\\\">International transfers</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q7\\\">Data security</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q8\\\">Your legal rights</a></li>\r\n	<li><a href=\\\"https://www.jumia.com.ng/sp-privacy/#q9\\\">Further details</a></li>\r\n</ul>\r\n\r\n<p>1. About this Notice</p>\r\n\r\n<p>This Privacy and Cookie Notice provides information on how Jumia collects and processes your personal data when you visit our website or mobile applications.</p>\r\n\r\n<p>2. The Data We Collect About You?</p>\r\n\r\n<p>We collect your personal data in order to provide and continually improve our products and services. We may collect, use, store and transfer the following different kinds of personal data about you:&nbsp;<a href=\\\"https://www.webtrekk.com/en/home/\\\" target=\\\"_blank\\\">Here</a>&nbsp;for marketing and personal data optimization purposes. Jumia also uses Google Digital Marketing to propose targeted offers.<br />\r\nTo find out more:</p>\r\n\r\n<ul>\r\n	<li>Information you provide to us: We receive and store the information you provide to us including your identity data, contact data, delivery address and financial data.</li>\r\n	<li>Information on your use of our website and/or mobile applications: We automatically collect and store certain types of information regarding your use of the Jumia marketplace including information about your searches, views, downloads and purchases.</li>\r\n	<li>Information from third parties and publicly available sources: We may receive information about you from third parties including our carriers; payment service providers; merchants/brands; and advertising service providers.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3. Cookies and How We Use Them</p>\r\n\r\n<p>A cookie is a small file of letters and numbers that we put on your computer if you agree.<br />\r\nCookies allow us to distinguish you from other users of our website and mobile applications, which helps us to provide you with an enhanced browsing experience. For example we use cookies for the following purposes:</p>\r\n\r\n<ul>\r\n	<li>Recognising and counting the number of visitors and to see how visitors move around the site when they are using it (this helps us to improve the way our website works, for example by ensuring that users can find what they are looking for).</li>\r\n	<li>Identifying your preferences and subscriptions e.g. language settings, saved items, items stored in your basket and Prime membership; and</li>\r\n	<li>Sending you newsletters and commercial/advertising messages tailored to your interests.</li>\r\n</ul>\r\n\r\n<p>Our approved third parties may also set cookies when you use our marketplace. Third parties include search engines, providers of measurement and analytics services, social media networks and advertising companies.</p>\r\n\r\n<p>4. How We Use Your Personal Data</p>\r\n\r\n<p>We use your personal data to operate, provide, develop and improve the products and services that we offer, including the following:</p>\r\n\r\n<ul>\r\n	<li>Registering you as a new customer.</li>\r\n	<li>Processing and delivering your orders.</li>\r\n	<li>Managing your relationship with us.</li>\r\n	<li>Enabling you to participate in promotions, competitions and surveys.</li>\r\n	<li>Improving our website, applications, products and services</li>\r\n	<li>Recommending/advertising products or services which may be of interest to you.</li>\r\n	<li>Complying with our legal obligations, including verifying your identity where necessary.</li>\r\n	<li>Detecting fraud.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>5. How We Share Your Personal Data</p>\r\n\r\n<p>We may need to share your personal data with third parties for the following purposes:</p>\r\n\r\n<ul>\r\n	<li>Sale of products and services: In order to deliver your products and services purchased on our marketplace from third parties, we may be required to provide your personal data to such third parties.</li>\r\n	<li>Working with third party service providers: We engage third parties to perform certain functions on our behalf. Examples include fulfilling orders for products or services, delivering packages, analyzing data, providing marketing assistance, processing payments, transmitting content, assessing and managing credit risk, and providing customer service.</li>\r\n	<li>Business transfers: As we continue to develop our business, we might sell or buy other businesses or services. In such transactions, customer information may be transferred together with other business assets.</li>\r\n	<li>Detecting fraud and abuse: We release account and other personal data to other companies and organizations for fraud protection and credit risk reduction, and to comply with the law.</li>\r\n</ul>\r\n\r\n<p>When we share your personal data with third parties we:</p>\r\n\r\n<ul>\r\n	<li>require them to agree to use your data in accordance with the terms of this Privacy and Cookie Notice, our Privacy Policy and in accordance with the law; and</li>\r\n	<li>only permit them to process your personal data for specified purposes and in accordance with our instructions. We do not allow our third-party service providers to use your personal data for their own purposes.</li>\r\n</ul>\r\n\r\n<p>6. International Transfers</p>\r\n\r\n<p>We may transfer your personal data to locations in another country, if this is permissible pursuant to applicable laws in your location. There are inherent risks in such transfers.<br />\r\nIn the event of international transfers of your personal data, we shall put in place measures necessary to protect your data, and we shall continue to respect your legal rights pursuant to the terms of this Privacy and Cookie Notice and applicable laws in your location.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>7. Data Security</p>\r\n\r\n<p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorised way, altered or disclosed.<br />\r\nIn addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know. They will only process your personal data on our instructions and they are subject to a duty of confidentiality.<br />\r\nWe have put in place procedures to deal with any suspected personal data breach and will notify you and any applicable regulator of a breach where we are legally required to do so.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>8. Your Legal Rights</p>\r\n\r\n<p>It is important that the personal data we hold about you is accurate and current. Please keep us informed if your personal data changes during your relationship with us.<br />\r\nUnder certain circumstances, you have rights under data protection laws in relation to your personal data, including the right to access, correct or erase your personal data, object to or restrict processing of your personal data, and unsubscribe from our emails and newsletters.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>9. Further Details</p>\r\n\r\n<p>If you are looking for more information on how we process your personal data, or you wish to exercise your legal rights in respect of your personal data, please contact&nbsp;<strong>compliance.alert@Jumia.com.</strong></p>\r\n','2022-05-14 09:29:34'),(2,'Privacy & Cookie Notice','<p>Jumia is the trading name for Ecart Internet Services Nigeria Ltd., registered company number 1191244, and whose buisness address is at 349, Herbert Macaulay Way, Yaba, Lagos State. The email address for service of any legal notices is Nigeria.Legal@Jumia.com</p>\r\n\r\n<p>Contents:</p>\r\n\r\n<p>1. About this Notice</p>\r\n\r\n<p>This Privacy and Cookie Notice provides information on how Jumia collects and processes your personal data when you visit our website or mobile applications.</p>\r\n\r\n<p>2. The Data We Collect About You?</p>\r\n\r\n<p>We collect your personal data in order to provide and continually improve our products and services. We may collect, use, store and transfer the following different kinds of personal data about you:&nbsp;<a href=\\\"\\\\\\\" target=\\\"\\\\&quot;_blank\\\\&quot;\\\">Here</a>&nbsp;for marketing and personal data optimization purposes. Jumia also uses Google Digital Marketing to propose targeted offers.<br />\r\nTo find out more:</p>\r\n\r\n<ul>\r\n	<li>Information you provide to us: We receive and store the information you provide to us including your identity data, contact data, delivery address and financial data.</li>\r\n	<li>Information on your use of our website and/or mobile applications: We automatically collect and store certain types of information regarding your use of the Jumia marketplace including information about your searches, views, downloads and purchases.</li>\r\n	<li>Information from third parties and publicly available sources: We may receive information about you from third parties including our carriers; payment service providers; merchants/brands; and advertising service providers.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3. Cookies and How We Use Them</p>\r\n\r\n<p>A cookie is a small file of letters and numbers that we put on your computer if you agree.<br />\r\nCookies allow us to distinguish you from other users of our website and mobile applications, which helps us to provide you with an enhanced browsing experience. For example we use cookies for the following purposes:</p>\r\n\r\n<ul>\r\n	<li>Recognising and counting the number of visitors and to see how visitors move around the site when they are using it (this helps us to improve the way our website works, for example by ensuring that users can find what they are looking for).</li>\r\n	<li>Identifying your preferences and subscriptions e.g. language settings, saved items, items stored in your basket and Prime membership; and</li>\r\n	<li>Sending you newsletters and commercial/advertising messages tailored to your interests.</li>\r\n</ul>\r\n\r\n<p>Our approved third parties may also set cookies when you use our marketplace. Third parties include search engines, providers of measurement and analytics services, social media networks and advertising companies.</p>\r\n\r\n<p>4. How We Use Your Personal Data</p>\r\n\r\n<p>We use your personal data to operate, provide, develop and improve the products and services that we offer, including the following:</p>\r\n\r\n<ul>\r\n	<li>Registering you as a new customer.</li>\r\n	<li>Processing and delivering your orders.</li>\r\n	<li>Managing your relationship with us.</li>\r\n	<li>Enabling you to participate in promotions, competitions and surveys.</li>\r\n	<li>Improving our website, applications, products and services</li>\r\n	<li>Recommending/advertising products or services which may be of interest to you.</li>\r\n	<li>Complying with our legal obligations, including verifying your identity where necessary.</li>\r\n	<li>Detecting fraud.</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>5. How We Share Your Personal Data</p>\r\n\r\n<p>We may need to share your personal data with third parties for the following purposes:</p>\r\n\r\n<ul>\r\n	<li>Sale of products and services: In order to deliver your products and services purchased on our marketplace from third parties, we may be required to provide your personal data to such third parties.</li>\r\n	<li>Working with third party service providers: We engage third parties to perform certain functions on our behalf. Examples include fulfilling orders for products or services, delivering packages, analyzing data, providing marketing assistance, processing payments, transmitting content, assessing and managing credit risk, and providing customer service.</li>\r\n	<li>Business transfers: As we continue to develop our business, we might sell or buy other businesses or services. In such transactions, customer information may be transferred together with other business assets.</li>\r\n	<li>Detecting fraud and abuse: We release account and other personal data to other companies and organizations for fraud protection and credit risk reduction, and to comply with the law.</li>\r\n</ul>\r\n\r\n<p>When we share your personal data with third parties we:</p>\r\n\r\n<ul>\r\n	<li>require them to agree to use your data in accordance with the terms of this Privacy and Cookie Notice, our Privacy Policy and in accordance with the law; and</li>\r\n	<li>only permit them to process your personal data for specified purposes and in accordance with our instructions. We do not allow our third-party service providers to use your personal data for their own purposes.</li>\r\n</ul>\r\n\r\n<p>6. International Transfers</p>\r\n\r\n<p>We may transfer your personal data to locations in another country, if this is permissible pursuant to applicable laws in your location. There are inherent risks in such transfers.<br />\r\nIn the event of international transfers of your personal data, we shall put in place measures necessary to protect your data, and we shall continue to respect your legal rights pursuant to the terms of this Privacy and Cookie Notice and applicable laws in your location.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>7. Data Security</p>\r\n\r\n<p>We have put in place appropriate security measures to prevent your personal data from being accidentally lost, used or accessed in an unauthorised way, altered or disclosed.<br />\r\nIn addition, we limit access to your personal data to those employees, agents, contractors and other third parties who have a business need to know. They will only process your personal data on our instructions and they are subject to a duty of confidentiality.<br />\r\nWe have put in place procedures to deal with any suspected personal data breach and will notify you and any applicable regulator of a breach where we are legally required to do so.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>8. Your Legal Rights</p>\r\n\r\n<p>It is important that the personal data we hold about you is accurate and current. Please keep us informed if your personal data changes during your relationship with us.<br />\r\nUnder certain circumstances, you have rights under data protection laws in relation to your personal data, including the right to access, correct or erase your personal data, object to or restrict processing of your personal data, and unsubscribe from our emails and newsletters.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>9. Further Details</p>\r\n\r\n<p>If you are looking for more information on how we process your personal data, or you wish to exercise your legal rights in respect of your personal data, please contact&nbsp;<strong>compliance.alert@Jumia.com.</strong></p>\r\n','2022-05-14 09:32:03');
/*!40000 ALTER TABLE `privacy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `category` varchar(60) NOT NULL,
  `cat_name` varchar(60) NOT NULL,
  `brand` varchar(60) NOT NULL,
  `product_size` varchar(30) NOT NULL,
  `product_color` varchar(30) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` varchar(30) NOT NULL,
  `discount_price` varchar(20) NOT NULL DEFAULT '0',
  `product_image` varchar(255) NOT NULL,
  `product_qty` varchar(10) NOT NULL,
  `views` varchar(20) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `stock` varchar(20) NOT NULL DEFAULT 'In-stock',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`product_id`),
  KEY `user_email` (`user_email`),
  KEY `user_email_2` (`user_email`),
  KEY `product_name` (`product_name`),
  KEY `product_slug` (`product_slug`),
  KEY `date_created` (`date_created`),
  KEY `stock` (`stock`),
  KEY `cat_name` (`cat_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'bradwick789@gmail.com','The Naomi Luxe Unit','the-naomi-luxe-unit','Beauty','Wigs- Accessories','Luxe','23 - 24','black','<p>ddvd</p>\r\n','30000','10','../admin/upload/bradwick789@gmail.com/eb114e7d0d.jpg','20','1','Seller','In-stock','2022-05-17 08:52:54'),(2,'onyedikachukwu62@gmail.com','Nike Air Force','nike-air-force','Fashion','Shoes','','40 - 45','black','<p>Affordable</p>\r\n','12000','5','../admin/upload/onyedikachukwu62@gmail.com/09a8496b0e.jpg','20','2','Admin','In-stock','2022-05-17 08:58:16'),(3,'bradwick789@gmail.com','Lush Hair','lush-hair','Beauty','Wigs-Accessories','Lush','23-24','gold','<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n','230000','9','../admin/upload/bradwick789@gmail.com/7a5645da96.jpg','25','0','Seller','In-stock','2022-05-18 06:27:42'),(4,'onyedikachukwu62@gmail.com','Adidas Rod Laver','adidas-rod-laver','Fashion','Shoes','Adidas','40 - 45','black','<p>Loius Vuitton</p>\r\n','15000','0','../admin/upload/onyedikachukwu62@gmail.com/d5b56ad371.jpg','20','1','Admin','In-stock','2022-05-20 00:07:21'),(5,'emmachukwu852@gmail.com','Balenciaga Top','balenciaga-top','Fashion','Clothing','Balenciaga','XXL','black','<p>aaaaaaasdsfs</p>\r\n','9000','0','../admin/upload/emmachukwu852@gmail.com/54bf904187.jpg','20','0','Seller','In-stock','2022-05-20 10:12:25'),(6,'emmachukwu852@gmail.com','Vintage Shirt','vintage-shirt','Fashion','Clothing','Vintage','XXL','blue','<p>davdvsdvdv</p>\r\n','13000','2','../admin/upload/emmachukwu852@gmail.com/1405a1e8d9.jpg','15','2','Seller','In-stock','2022-05-20 10:14:44'),(7,'emmachukwu852@gmail.com','Vintage Striped Shirt','vintage-striped-shirt','Fashion','Clothing','Vintage','XXL','mixed','<p>fwesghrhhrf</p>\r\n','11000','2','../admin/upload/emmachukwu852@gmail.com/01549b8e21.jpg','15','1','Seller','In-stock','2022-05-20 10:15:30'),(8,'onyedikachukwu62@gmail.com','Versace Shoe','versace-shoe','Fashion','Shoes','Versace','40 - 45','black','<p>wesgggg</p>\r\n','25000','5','../admin/upload/onyedikachukwu62@gmail.com/3314898672.jpg','10','1','Admin','In-stock','2022-05-20 10:21:55'),(9,'bradwick789@gmail.com','The Bianca Unit','the-bianca-unit','Beauty','Wigs- Accessories','Bianca','23 - 24','black','<p>affserehehtbddbdf</p>\r\n','150000','3','../admin/upload/bradwick789@gmail.com/a2f5e6436e.jpg','15','2','Seller','In-stock','2022-05-20 10:33:06');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `biz_name` varchar(100) NOT NULL,
  `seller_cat` varchar(100) NOT NULL,
  `seller_sub_cat` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `split_code` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `seller_type` varchar(10) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `sub_end` datetime DEFAULT NULL,
  PRIMARY KEY (`seller_id`),
  KEY `email` (`email`),
  KEY `business_name` (`biz_name`),
  KEY `seller_cat` (`seller_cat`),
  KEY `seller_sub_cat` (`seller_sub_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sellers`
--

LOCK TABLES `sellers` WRITE;
/*!40000 ALTER TABLE `sellers` DISABLE KEYS */;
INSERT INTO `sellers` VALUES (1,'Brad','Wick','bradwick789@gmail.com','Bradwick Ventures','Beauty','Wigs-Accessories','08158465878','','Lagos, Nigeria','','','','$2y$10$r2MZHhXHTBoCU3w0pxx06u9wFsVTYwamrEFoPQwtDu9FgbiPFM.H6','active','SPL_e1bGSPPkwE','ACCT_2fgxm4p256r4ily','Seller','2022-05-17 08:43:29','2023-01-01 00:59:00'),(2,'Onyedika','Chukwuneke','onyedikachukwu62@gmail.com','SUREMARTS','Fashion','Shoes','08148465877','','Lagos, Nigeria','','','','$2y$10$Gw/U2uu454/pKZqVXRUQkOri/xcd4Ib5P4022uipdsayVl.2oeSca','active','SPL_e1bGSPPkwE','ACCT_2glhfdfdirciidl','Admin','2022-05-17 08:44:56','2023-01-01 00:59:00'),(3,'Emmanuel','Chukwu','emmachukwu852@gmail.com','Emma Enterprise','Fashion','Clothing','07058475896','','Lagos, Nigeria','','','','$2y$10$xRtcBEZok0QbISKLCGN4qu8f6LUUOA9XS1zHzHoSMUtuqG.bsppfG','active','','ACCT_glfmdl8bj6khjd2','Seller','2022-05-20 10:07:53','2023-01-01 00:00:00');
/*!40000 ALTER TABLE `sellers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `slider_img` varchar(255) NOT NULL,
  `slider_title` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (1,'onyedikachukwu62@gmail.com','slider/c860688f12.jpg','http://shopwise.web/','2022-05-26 09:00:34'),(2,'onyedikachukwu62@gmail.com','slider/b7288d0f3b.jpg','http://shopwise.web/','2022-05-26 09:02:52'),(3,'onyedikachukwu62@gmail.com','slider/43744ef5a5.jpg','http://shopwise.web/','2022-05-26 09:06:34');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategory` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `subcat_name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sub_id`),
  KEY `user_email` (`user_email`),
  KEY `cat_name` (`cat_name`),
  KEY `subcat_name` (`subcat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategory`
--

LOCK TABLES `subcategory` WRITE;
/*!40000 ALTER TABLE `subcategory` DISABLE KEYS */;
INSERT INTO `subcategory` VALUES (1,'onyedikachukwu62@gmail.com','Fashion','Clothing','2022-05-17 07:00:22'),(2,'onyedikachukwu62@gmail.com','Fashion','Shoes','2022-05-17 07:00:29'),(3,'onyedikachukwu62@gmail.com','Beauty','Wigs-Accessories','2022-05-17 07:01:43'),(4,'onyedikachukwu62@gmail.com','Beauty','Body','2022-05-17 07:02:13');
/*!40000 ALTER TABLE `subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sup_admin`
--

DROP TABLE IF EXISTS `sup_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sup_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sup_email` varchar(255) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `sup_password` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sup_email` (`sup_email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sup_admin`
--

LOCK TABLES `sup_admin` WRITE;
/*!40000 ALTER TABLE `sup_admin` DISABLE KEYS */;
INSERT INTO `sup_admin` VALUES (1,'onyedikachukwu62@gmail.com','OnYe','DiKa','827ccb0eea8a706c4c34a16891f84e7b','2022-04-10 21:07:56');
/*!40000 ALTER TABLE `sup_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms`
--

DROP TABLE IF EXISTS `terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms` (
  `terms_id` int(11) NOT NULL AUTO_INCREMENT,
  `terms_title` varchar(100) NOT NULL,
  `terms_desc` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`terms_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms`
--

LOCK TABLES `terms` WRITE;
/*!40000 ALTER TABLE `terms` DISABLE KEYS */;
INSERT INTO `terms` VALUES (1,'General Terms and Conditions of Use of the Marketplace for Buyers','<p>1. Introduction</p>\r\n\r\n<p>Ecart Internet Services Nigeria Limited (&quot;Jumia&quot; or &quot;we&quot;) operates an ecommerce platform consisting of a website and mobile application (&quot;marketplace&quot;), together with supporting logistics and payment infrastructure, for the sale and purchase of consumer products in Nigeria (&quot;territory&quot;).<br />\r\nThese general terms and conditions shall apply to buyers and sellers on the marketplace and shall govern your use of the marketplace and related services.<br />\r\nBy using our marketplace, you accept these general terms and conditions in full. If you disagree with these general terms and conditions or any part of these general terms and conditions, you must not use our marketplace.<br />\r\nIf you use our marketplace in the course of a business or other organizational project, then by so doing you:</p>\r\n\r\n<ul>\r\n	<li>confirm that you have obtained the necessary authority to agree to these general terms and conditions;</li>\r\n	<li>bind both yourself and the person, company or other legal entity that operates that business or organizational project, to these general terms and conditions; and</li>\r\n	<li>agree that &quot;you&quot; in these general terms and conditions shall reference both the individual user and the relevant person, company or legal entity unless the context requires otherwise.</li>\r\n</ul>\r\n\r\n<p>2. Registration and account</p>\r\n\r\n<ol>\r\n	<li>You may not register with our marketplace if you are under 18 years of age (by using our marketplace or agreeing to these general terms and conditions, you warrant and represent to us that you are at least 18 years of age).</li>\r\n	<li>You may register for an account with our marketplace by completing and submitting the registration form on our marketplace</li>\r\n	<li>You represent and warrant that all information provided in the registration form is complete and accurate.</li>\r\n	<li>If you register for an account with our marketplace, you will be asked to provide an email address/user ID and password and you agree to:\r\n	<ul>\r\n		<li>keep your password confidential;</li>\r\n		<li>notify us in writing immediately (using our contact details provided at section 23) if you become aware of any disclosure of your password; and</li>\r\n		<li>be responsible for any activity on our marketplace arising out of any failure to keep your password confidential, and that you may be held liable for any losses arising out of such a failure.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Your account shall be used exclusively by you and you shall not transfer your account to any third party. If you authorize any third party to manage your account on your behalf this shall be at your own risk.</li>\r\n	<li>We may suspend or cancel your account, and/or edit your account details, at any time in our sole discretion and without notice or explanation, providing that if we cancel any products or services you have paid for but not received, and you have not breached these general terms and conditions, we will refund you in respect of the same.</li>\r\n	<li>You may cancel your account on our marketplace by contacting us as provided at section 23.</li>\r\n</ol>\r\n\r\n<p>3. Terms and conditions of sale</p>\r\n\r\n<ol>\r\n	<li>You acknowledge and agree that:\r\n	<ul>\r\n		<li>the marketplace provides an online location for sellers to sell and buyers to purchase products;</li>\r\n		<li>we shall accept binding sales, on behalf of sellers, but Jumia is not a party to the transaction between the seller and the buyer; and</li>\r\n		<li>a contract for the sale and purchase of a product or products will come into force between the buyer and seller, and accordingly you commit to buying or selling the relevant product or products, upon the buyer&rsquo;s confirmation of purchase via the marketplace.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Subject to these general terms and conditions, the seller&rsquo;s terms of business shall govern the contract for sale and purchase between the buyer and the seller. Notwithstanding this, the following provisions will be incorporated into the contract of sale and purchase between the buyer and the seller:\r\n	<ul>\r\n		<li>the price for a product will be as stated in the relevant product listing;</li>\r\n		<li>the price for the product must include all taxes and comply with applicable laws in force from time to time;</li>\r\n		<li>delivery charges, packaging charges, handling charges, administrative charges, insurance costs, other ancillary costs and charges, will only be payable by the buyer if this is expressly and clearly stated in the product listing;</li>\r\n		<li>products must be of satisfactory quality, fit and safe for any purpose specified in, and conform in all material respects to, the product listing and any other description of the products supplied or made available by the seller to the buyer; and</li>\r\n		<li>the seller warrants that the seller has good title to, and is the sole legal and beneficial owner of, the products, and that the products are not subject to any third party rights or restrictions including in respect of third party intellectual property rights and/or any criminal, insolvency or tax investigation or proceedings</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>4. Returns and refunds</p>\r\n\r\n<ol>\r\n	<li>Returns of products by buyers and acceptance of returned products by sellers shall be managed by us in accordance with the returns page on the marketplace, as may be amended from time to time. Acceptance of returns shall be in our discretion, subject to compliance with applicable laws of the territory</li>\r\n	<li>Refunds in respect of returned products shall be managed in accordance with the refunds page on the marketplace, as may be amended from time to time. Our rules on refunds shall be exercised in our discretion, subject to applicable laws of the territory. We may offer refunds, in our discretion:\r\n	<ul>\r\n		<li>in respect of the product price;</li>\r\n		<li>local and/or international shipping fees (as stated on the refunds page); and</li>\r\n		<li>by way of store credits, wallet refunds, vouchers, mobile money transfer, bank transfers or such other method as we may determine from time to time.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Returned products shall be accepted and refunds issued by Jumia, for and on behalf of the seller.</li>\r\n	<li>Changes to our returns page or refunds page shall be effective in respect of all purchases made from the date of publication of the change on our website.</li>\r\n</ol>\r\n\r\n<p>5. Payments</p>\r\n\r\n<p>You must make payments due under these general terms and conditions in accordance with the Payments Information and Guidelines on the marketplace.</p>\r\n\r\n<p>6. Rules about your content</p>\r\n\r\n<ol>\r\n	<li>In these general terms and conditions, &quot;your content&quot; means:\r\n	<ul>\r\n		<li>all works and materials (including without limitation text, graphics, images, audio material, video material, audio-visual material, scripts, software and files) that you submit to us or our marketplace for storage or publication, processing by, or onward transmission; and</li>\r\n		<li>all communications on the marketplace, including product reviews, feedback and comments.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Your content, and the use of your content by us in accordance with these general terms and conditions, must be accurate, complete and truthful.</li>\r\n	<li>Your content must be appropriate, civil and tasteful, and accord with generally accepted standards of etiquette and behaviour on the internet, and must not:\r\n	<ul>\r\n		<li>be offensive, obscene, indecent, pornographic, lewd, suggestive or sexually explicit;</li>\r\n		<li>depict violence in an explicit, graphic or gratuitous manner; or</li>\r\n		<li>be blasphemous, in breach of racial or religious hatred or discrimination legislation;</li>\r\n		<li>be deceptive, fraudulent, threatening, abusive, harassing, anti-social, menacing, hateful, discriminatory or inflammatory;</li>\r\n		<li>cause annoyance, inconvenience or needless anxiety to any person; or</li>\r\n		<li>constitute spam.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Your content must not be illegal or unlawful, infringe any person&#39;s legal rights, or be capable of giving rise to legal action against any person (in each case in any jurisdiction and under any applicable law). Your content must not infringe or breach:\r\n	<ul>\r\n		<li>any copyright, moral right, database right, trademark right, design right, right in passing off or other intellectual property right;</li>\r\n		<li>any right of confidence, right of privacy or right under data protection legislation;</li>\r\n		<li>any contractual obligation owed to any person; or</li>\r\n		<li>any court order</li>\r\n	</ul>\r\n	</li>\r\n	<li>You must not use our marketplace to link to any website or web page consisting of or containing material that would, were it posted on our marketplace, breach the provisions of these general terms and conditions</li>\r\n	<li>You must not submit to our marketplace any material that is or has ever been the subject of any threatened or actual legal proceedings or other similar complaint.</li>\r\n	<li>The review function on the marketplace may be used to facilitate buyer reviews on products. You shall not use the review function or any other form of communication to provide inaccurate, inauthentic or fake reviews.</li>\r\n	<li>You must not interfere with a transaction by: (i) contacting another user to buy or sell an item listed on the marketplace outside of the marketplace; or (ii) communicating with a user involved in an active or completed transaction to warn them away from a particular buyer, seller or item; or (iii) contacting another user with the intent to collect any payments</li>\r\n	<li>You acknowledge that all users of the marketplace are solely responsible for interactions with other users and you shall exercise caution and good judgment in your communication with users. You shall not send them personal information including credit card details.</li>\r\n	<li>We may periodically review your content and we reserve the right to remove any content in our discretion for any reason whatsoever.</li>\r\n	<li>If you learn of any unlawful material or activity on our marketplace, or any material or activity that breaches these general terms and conditions, you may inform us by contacting us as provided at section 23.</li>\r\n</ol>\r\n\r\n<p>7. Our rights to use your content</p>\r\n\r\n<ol>\r\n	<li>You grant to us a worldwide, irrevocable, non-exclusive, royalty-free license to use, reproduce, store, adapt, publish, translate and distribute your content across our marketing channels and any existing or future media.</li>\r\n	<li>You grant to us the right to sub-license the rights licensed under section 7.1</li>\r\n	<li>You grant to us the right to bring an action for infringement of the rights licensed under section 7.1.</li>\r\n	<li>You hereby waive all your moral rights in your content to the maximum extent permitted by applicable law; and you warrant and represent that all other moral rights in your content have been waived to the maximum extent permitted by applicable law</li>\r\n	<li>Without prejudice to our other rights under these general terms and conditions, if you breach our rules on content in any way, or if we reasonably suspect that you have breached our rules on content, we may delete, unpublish or edit any or all of your content.</li>\r\n</ol>\r\n\r\n<p>8. Use of website and mobile applications</p>\r\n\r\n<ol>\r\n	<li>In this section 8 words &quot;marketplace&quot; and &quot;website&quot; shall be used interchangeably to refer to Jumia&rsquo;s websites and mobile applications.</li>\r\n	<li>You may:\r\n	<ul>\r\n		<li>view pages from our website in a web browser;</li>\r\n		<li>download pages from our website for caching in a web browser;</li>\r\n		<li>print pages from our website for your own personal and noncommercial use, providing that such printing is not systematic or excessive;</li>\r\n		<li>stream audio and video files from our website using the media player on our website; and</li>\r\n		<li>use our marketplace services by means of a web browser,</li>\r\n	</ul>\r\n	subject to the other provisions of these general terms and conditions.</li>\r\n	<li>Except as expressly permitted by section 8.2 or the other provisions of these general terms and conditions, you must not download any material from our website or save any such material to your computer</li>\r\n	<li>You may only use our website for your own personal and business purposes in respect of selling or purchasing products on the marketplace</li>\r\n	<li>Except as expressly permitted by these general terms and conditions, you must not edit or otherwise modify any material on our website.</li>\r\n	<li>Unless you own or control the relevant rights in the material, you must not:\r\n	<ul>\r\n		<li>republish material from our website (including republication on another website);</li>\r\n		<li>sell, rent or sub-license material from our website;</li>\r\n		<li>show any material from our website in public;</li>\r\n		<li>exploit material from our website for a commercial purpose; or</li>\r\n		<li>redistribute material from our website.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Notwithstanding section 8.6, you may forward links to products on our website and redistribute our newsletter and promotional materials in print and electronic form to any person.</li>\r\n	<li>We reserve the right to suspend or restrict access to our website, to areas of our website and/or to functionality upon our website. We may, for example, suspend access to the website during server maintenance or when we update the website. You must not circumvent or bypass, or attempt to circumvent or bypass, any access restriction measures on the website.</li>\r\n	<li>You must not:\r\n	<ul>\r\n		<li>use our website in any way or take any action that causes, or may cause, damage to the website or impairment of the performance, availability, accessibility, integrity or security of the website;</li>\r\n		<li>use our website in any way that is unethical, unlawful, illegal, fraudulent or harmful, or in connection with any unlawful, illegal, fraudulent or harmful purpose or activity;</li>\r\n		<li>hack or otherwise tamper with our website;</li>\r\n		<li>probe, scan or test the vulnerability of our website without our permission;</li>\r\n		<li>circumvent any authentication or security systems or processes on or relating to our website;</li>\r\n		<li>use our website to copy, store, host, transmit, send, use, publish or distribute any material which consists of (or is linked to) any spyware, computer virus, Trojan horse, worm, keystroke logger, rootkit or other malicious computer software;</li>\r\n		<li>impose an unreasonably large load on our website resources (including bandwidth, storage capacity and processing capacity);</li>\r\n		<li>decrypt or decipher any communications sent by or to our website without our permission;</li>\r\n		<li>conduct any systematic or automated data collection activities (including without limitation scraping, data mining, data extraction and data harvesting) on or in relation to our website without our express written consent;</li>\r\n		<li>access or otherwise interact with our website using any robot, spider or other automated means, except for the purpose of search engine indexing;</li>\r\n		<li>use our website except by means of our public interfaces;</li>\r\n		<li>violate the directives set out in the robots.txt file for our website;</li>\r\n		<li>use data collected from our website for any direct marketing activity (including without limitation email marketing, SMS marketing, telemarketing and direct mailing); or</li>\r\n		<li>do anything that interferes with the normal use of our website.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>9. Copyright and trademarks</p>\r\n\r\n<ol>\r\n	<li>Subject to the express provisions of these general terms and conditions:\r\n	<ul>\r\n		<li>we, together with our licensors, own and control all the copyright and other intellectual property rights in our website and the material on our website; and</li>\r\n		<li>all the copyright and other intellectual property rights in our website and the material on our website are reserved.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Jumia&rsquo;s logos and our other registered and unregistered trademarks are trademarks belonging to us; we give no permission for the use of these trademarks, and such use may constitute an infringement of our rights.</li>\r\n	<li>The third party registered and unregistered trademarks or service marks on our website are the property of their respective owners and we do not endorse and are not affiliated with any of the holders of any such rights and as such we cannot grant any license to exercise such rights</li>\r\n</ol>\r\n\r\n<p>10. Data Privacy</p>\r\n\r\n<ol>\r\n	<li>Buyers agree to processing of their personal data in accordance with the terms of Jumia&rsquo;s Privacy and Cookie Notice</li>\r\n	<li>Jumia shall process all personal data obtained through the marketplace and related services in accordance with the terms of our Privacy and Cookie Notice and Privacy Policy.</li>\r\n	<li>Sellers shall be directly responsible to buyers for any misuse of their personal data and Jumia shall bear no liability to buyers in respect of any misuse by sellers of their personal data.</li>\r\n</ol>\r\n\r\n<p>11. Due diligence and audit rights</p>\r\n\r\n<ol>\r\n	<li>We operate an anti-money laundering compliance program and reserve the right to perform due diligence checks on all users of the marketplace.</li>\r\n	<li>You agree to provide to us all such information, documentation and access to your business premises as we may require:\r\n	<ul>\r\n		<li>in order to verify your adherence to, and performance of, your obligations under this Agreement;</li>\r\n		<li>for the purpose of disclosures pursuant to a valid order by a court or other governmental body; or</li>\r\n		<li>as otherwise required by law or applicable regulation</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>12. Jumia&rsquo;s role as a marketplace</p>\r\n\r\n<ol>\r\n	<li>You acknowledge that:\r\n	<ul>\r\n		<li>we do not confirm the identity of all marketplace users, check their credit worthiness or bona fides, or otherwise vet them;</li>\r\n		<li>we do not check, audit or monitor all information contained in listings;</li>\r\n		<li>we are not party to any contract for the sale or purchase of products advertised on the marketplace;</li>\r\n		<li>we are not involved in any transaction between a buyer and a seller in any way, save that we facilitate a marketplace for buyers and sellers and process payments on behalf of sellers;</li>\r\n		<li>we are not the agents for any buyer or seller</li>\r\n	</ul>\r\n	and accordingly we will not be liable to any person in relation to the offer for sale, sale or purchase of any products advertised on our marketplace; furthermore we are not responsible for the enforcement of any contractual obligations arising out of a contract for the sale or purchase of any products and we will have no obligation to mediate between the parties to any such contract.</li>\r\n	<li>We do not warrant or represent:\r\n	<ul>\r\n		<li>the completeness or accuracy of the information published on our marketplace;</li>\r\n		<li>that the material on the marketplace is up to date;</li>\r\n		<li>that the marketplace will operate without fault; or</li>\r\n		<li>that the marketplace or any service on the marketplace will remain available.</li>\r\n	</ul>\r\n	</li>\r\n	<li>We reserve the right to discontinue or alter any or all of our marketplace services, and to stop publishing our marketplace, at any time in our sole discretion without notice or explanation.</li>\r\n	<li>We do not guarantee any commercial results concerning the use of the marketplace.</li>\r\n	<li>To the maximum extent permitted by applicable law and subject to section 13.1 below, we exclude all representations and warranties relating to the subject matter of these general terms and conditions, our marketplace and the use of our marketplace.</li>\r\n</ol>\r\n\r\n<p>13. Limitations and exclusions of liability</p>\r\n\r\n<ol>\r\n	<li>Nothing in these general terms and conditions will:\r\n	<ul>\r\n		<li>limit any liabilities in any way that is not permitted under applicable law; or</li>\r\n		<li>exclude any liabilities or statutory rights that may not be excluded under applicable law.</li>\r\n	</ul>\r\n	</li>\r\n	<li>The limitations and exclusions of liability set out in this section 13 and elsewhere in these general terms and conditions:\r\n	<ul>\r\n		<li>are subject to section 13.1; and</li>\r\n		<li>govern all liabilities arising under these general terms and conditions or relating to the subject matter of these general terms and conditions, including liabilities arising in contract, in tort (including negligence) and for breach of statutory duty, except to the extent expressly provided otherwise in these general terms and conditions</li>\r\n	</ul>\r\n	</li>\r\n	<li>In respect of the services offered to you free of charge we will not be liable to you for any loss or damage of any nature whatsoever.</li>\r\n	<li>Our aggregate liability to you in respect of any contract to provide services to you under these general terms and conditions shall not exceed the total amount paid and payable to us under the contract. Each separate transaction on the marketplace shall constitute a separate contract for the purpose of this section 13.4.</li>\r\n	<li>Notwithstanding section 13.4 above, we will not be liable to you for any loss or damage of any nature, including in respect of:\r\n	<ul>\r\n		<li>any losses occasioned by any interruption or dysfunction to the website;</li>\r\n		<li>any losses arising out of any event or events beyond our reasonable control;</li>\r\n		<li>any business losses, including (without limitation) loss of or damage to profits, income, revenue, use, production, anticipated savings, business, contracts, commercial opportunities or goodwill;</li>\r\n		<li>any loss or corruption of any data, database or software; or</li>\r\n		<li>any special, indirect or consequential loss or damage.</li>\r\n	</ul>\r\n	</li>\r\n	<li>We accept that we have an interest in limiting the personal liability of our officers and employees and, having regard to that interest, you acknowledge that we are a limited liability entity; you agree that you will not bring any claim personally against our officers or employees in respect of any losses you suffer in connection with the marketplace or these general terms and conditions (this will not limit or exclude the liability of the limited liability entity itself for the acts and omissions of our officers and employees).</li>\r\n	<li>Our marketplace includes hyperlinks to other websites owned and operated by third parties; such hyperlinks are not recommendations. We have no control over third party websites and their contents, and we accept no responsibility for them or for any loss or damage that may arise from your use of them.</li>\r\n</ol>\r\n\r\n<p>14. Indemnification</p>\r\n\r\n<ol>\r\n	<li>You hereby indemnify us, and undertake to keep us indemnified, against:\r\n	<ul>\r\n		<li>any and all losses, damages, costs, liabilities and expenses (including without limitation legal expenses and any amounts paid by us to any third party in settlement of a claim or dispute) incurred or suffered by us and arising directly or indirectly out of your use of our marketplace or any breach by you of any provision of these general terms and conditions or the Jumia codes, policies or guidelines; and</li>\r\n		<li>any VAT liability or other tax liability that we may incur in relation to any sale, supply or purchase made through our marketplace, where that liability arises out of your failure to pay, withhold, declare or register to pay any VAT or other tax properly due in any jurisdiction.</li>\r\n	</ul>\r\n	</li>\r\n</ol>\r\n\r\n<p>15. Breaches of these general terms and conditions</p>\r\n\r\n<ol>\r\n	<li>If we permit the registration of an account on our marketplace it will remain open indefinitely, subject to these general terms and conditions.</li>\r\n	<li>If you breach these general terms and conditions, or if we reasonably suspect that you have breached these general terms and conditions or any Jumia codes, policies or guidelines in any way we may:\r\n	<ul>\r\n		<li>temporarily suspend your access to our marketplace;</li>\r\n		<li>permanently prohibit you from accessing our marketplace;</li>\r\n		<li>block computers using your IP address from accessing our marketplace;</li>\r\n		<li>contact any or all of your internet service providers and request that they block your access to our marketplace;</li>\r\n		<li>suspend or delete your account on our marketplace; and/or</li>\r\n		<li>commence legal action against you, whether for breach of contract or otherwise.</li>\r\n	</ul>\r\n	</li>\r\n	<li>Where we suspend, prohibit or block your access to our marketplace or a part of our marketplace you must not take any action to circumvent such suspension or prohibition or blocking (including without limitation creating and/or using a different account).</li>\r\n</ol>\r\n\r\n<p>16. Entire Agreement</p>\r\n\r\n<p>These general terms and conditions and the Jumia codes, policies and guidelines (and in respect of sellers the seller terms and conditions) shall constitute the entire agreement between you and us in relation to your use of our marketplace and shall supersede all previous agreements between you and us in relation to your use of our marketplace</p>\r\n\r\n<p>17. Hierarchy</p>\r\n\r\n<p>Should these general terms and conditions, the seller terms and conditions, and the Jumia codes, policies and guidelines be in conflict, these terms and conditions, the seller terms and conditions and the Jumia codes, policies and guidelines shall prevail in the order here stated.</p>\r\n\r\n<p>18. Variation</p>\r\n\r\n<ol>\r\n	<li>We may revise these general terms and conditions, the seller terms and conditions, and the Jumia codes, policies and guidelines from time to time.</li>\r\n	<li>The revised general terms and conditions shall apply from the date of publication on the marketplace.</li>\r\n</ol>\r\n\r\n<p>19. Severability</p>\r\n\r\n<ol>\r\n	<li>If a provision of these general terms and conditions is determined by any court or other competent authority to be unlawful and/or unenforceable, the other provisions will continue in effect.</li>\r\n	<li>If any unlawful and/or unenforceable provision of these general terms and conditions would be lawful or enforceable if part of it were deleted, that part will be deemed to be deleted, and the rest of the provision will continue in effect.</li>\r\n</ol>\r\n\r\n<p>20. Assignment</p>\r\n\r\n<ol>\r\n	<li>You hereby agree that we may assign, transfer, sub-contract or otherwise deal with our rights and/or obligations under these general terms and conditions.</li>\r\n	<li>You may not without our prior written consent assign, transfer, sub-contract or otherwise deal with any of your rights and/or obligations under these general terms and conditions.</li>\r\n</ol>\r\n\r\n<p>21. Third party rights</p>\r\n\r\n<ol>\r\n	<li>A contract under these general terms and conditions is for our benefit and your benefit, and is not intended to benefit or be enforceable by any third party</li>\r\n	<li>The exercise of the parties&#39; rights under a contract under these general terms and conditions is not subject to the consent of any third party</li>\r\n</ol>\r\n\r\n<p>22. Law and jurisdiction</p>\r\n\r\n<ol>\r\n	<li>These general terms and conditions shall be governed by and construed in accordance with the laws of the territory.</li>\r\n	<li>Any disputes relating to these general terms and conditions shall be subject to the exclusive jurisdiction of the courts of the territory</li>\r\n</ol>\r\n\r\n<p>23. Our company details</p>\r\n\r\n<p>The marketplace is operated by Ecart Internet Services Nigeria Limited. We are registered in Nigeria under registration number RC 1034513, and our head office is at 109 Adeniyi Jones Street, Ikeja, Lagos. You can contact us by using our marketplace contact form</p>\r\n','2022-05-14 09:42:23');
/*!40000 ALTER TABLE `terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `birthday` date DEFAULT NULL,
  `address` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` varchar(30) NOT NULL,
  `verify` varchar(5) NOT NULL DEFAULT '0',
  `status` varchar(20) NOT NULL DEFAULT 'active',
  `date_created` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`),
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Onyedika','Chukwuneke','onyedikachukwu62@gmail.com','08185764594','Male','1996-05-18','2 Bello Street','Lagos','Orile Iganmu','$2y$10$kMhP9vpmH.vajbgXzy9bJONVjWGdT./m.6iMXzYt5EiCrTDoOz7CC','810098578','1','active','2022-04-27 00:00:00'),(2,'Rel','Emm','relemmsolutions@gmail.com','08185764594','',NULL,'','','','$2y$10$g.6yOVtRJWGjbUDShy1WO.Kyf8nm.q6eJIIRA.ierqzj.N3KQqDyy','176496838','1','active','2022-04-30 14:26:03');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-28 19:01:14
