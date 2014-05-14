<?php
  require("bd.php");
  function migrate_offices_add_pkField(){
         $sql = 'ALTER TABLE `user_profile`
ADD `district_home` VARCHAR( 255 ) NOT NULL ,
ADD `district_work` VARCHAR( 255 ) NOT NULL ,
ADD `region` VARCHAR( 255 ) NOT NULL ,
ADD `foreign` VARCHAR( 255 ) NOT NULL ,
ADD `known_computer` VARCHAR( 255 ) NOT NULL ,
ADD `sport` VARCHAR( 255 ) NOT NULL ,
ADD `food` VARCHAR( 255 ) NOT NULL ,
ADD `travel` VARCHAR( 255 ) NOT NULL ,
ADD `hobby` VARCHAR( 255 ) NOT NULL ,
ADD `have_children` VARCHAR( 25 ) NOT NULL ,
ADD `have_auto` tinyint( 1 ) NOT NULL ,
ADD `have_estate` tinyint( 1 ) NOT NULL ,
ADD `sex` tinyint( 1 ) NOT NULL ,
ADD `age` VARCHAR( 3 ) NOT NULL ,
ADD `income` VARCHAR( 25 ) NOT NULL ,
ADD `marital` VARCHAR( 25 ) NOT NULL ,
ADD `education` VARCHAR( 25 ) NOT NULL ,
ADD `profession` VARCHAR( 25 ) NOT NULL ,
ADD `occupation` VARCHAR( 25 ) NOT NULL
';


         mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );


         $sql = 'ALTER TABLE  `user_profile` CHANGE  `region`  `city` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL';
         mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

         $sql = 'ALTER TABLE  `user_profile` ADD  `country` VARCHAR( 255 ) NOT NULL AFTER  `city`';
         mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

         $sql = 'ALTER TABLE  `user_profile` ADD  `image` VARCHAR( 255 ) NOT NULL';
         mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

         $sql = 'ALTER TABLE  `user_profile` CHANGE  `city_id`  `city_id` INT( 11 ) NULL ,
CHANGE  `country_id`  `country_id` INT( 11 ) NOT NULL   ';
         mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

 }

 function migrate_add_field_role(){
    $sql = "ALTER TABLE  `user` ADD  `role` ENUM(  '1',  '2',  '3',  '4' ) NOT NULL";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
 }

 function migrate_add_delivery_zero(){
        $sql = " INSERT INTO  `tmn_new`.`storedeliverymethod` (`id` , `price` , `free_from` , `position` , `active` ) VALUES ( '0',  '0.00',  '0.00',  '0',  '1') ";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

    $sql = "INSERT INTO  `tmn_new`.`storedeliverypayment` ( `id` , `delivery_id` , `payment_id` ) VALUES (
NULL ,  '0',  '17'
), (
NULL ,  '0',  '18'
), (
NULL ,  '0',  '19'
), (
NULL ,  '0',  '20'
), (
NULL ,  '0',  '21'
);";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

 }


   function  migrate_add_order_options()
        {
     $sql = "
                        ALTER TABLE  `Order` ADD  `user_sex` TINYINT NOT NULL AFTER  `user_comment` ,
                        ADD  `user_country` INT NOT NULL AFTER  `user_sex` ,
                        ADD  `user_city` INT NOT NULL AFTER  `user_country` ,
                        ADD  `user_age` INT NOT NULL AFTER  `user_city`";

            mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

        $sql = "INSERT INTO  `Countries` ( `country_id` , `name` , `sort` )
              VALUES ( '0',  '-не выбран-',  '10001' ) ;
            INSERT INTO  `Cities` ( `city_id`, `country_id` , `name`)
              VALUES ( '0', '0',  '-не выбран-') ;
              ALTER TABLE  `countries` ORDER BY  `country_id`; ";

        mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );



        $sql = "CREATE TABLE IF NOT EXISTS `OrderTesterAgeFilter` (
  `filter_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `from_age` int(11) NOT NULL,
  `to_age` int(11) NOT NULL,
  PRIMARY KEY (`filter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


INSERT INTO `OrderTesterAgeFilter` (`filter_id`, `title`, `from_age`, `to_age`) VALUES
(0, '-не выбран-', 0, 0),
(1, '15-20', 15, 20),
(2, '20-30', 20, 30),
(3, '30-40', 30, 40),
(4, '40-50', 40, 50),
(5, '50-60', 50, 60),
(6, '60-70', 60, 70),
(7, 'от 70', 70, 150);";


        mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
    }




 
function migrate_add_link_type_tester_table()
    {
		$sql = "CREATE TABLE IF NOT EXISTS `StoreProductTypeTester` (
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM;";
    }
 migrate_add_link_type_tester_table();
  
function alter_FK(){
    $sql = "ALTER TABLE tbl_post drop foreign key FK_post_author;";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
    $sql = "ALTER TABLE `user` ENGINE=InnoDb;";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
    $sql = "ALTER TABLE `tbl_post` ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
}


//migrate_add_order_options();
//alter_FK();

function alter_orderProduct_add_testerId(){
        $sql = "ALTER TABLE  `OrderProduct` ADD  `tester_id` INT( 11 ) NOT NULL;";
        mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
}


function add_commentStatusTable(){

    $sql = "CREATE TABLE IF NOT EXISTS `tbl_commentStatus` (
`id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8; ";

    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

    $sql = "INSERT INTO `tbl_commentStatus` (`id`, `title`) VALUES
(1, 'ожидает рассмотрения'),
(2, 'одобрено'),
(3, 'одобрено с отключенными комментариями'),
(4, 'отклонено'),
(5, 'отправлено на доработку'),
(6, 'не определен'); ";

    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
}



function migrate_add_orderProduct_status_table()
{
    $sql = "ALTER TABLE  `OrderProduct` ADD  `status_id` TINYINT NOT NULL DEFAULT  '0'";
    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );

    $sql = "    CREATE TABLE IF NOT EXISTS `OrderProductStatus` (
                    `status_id` int(11) NOT NULL,   `value` varchar(255) NOT NULL ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

          INSERT INTO `OrderProductStatus` (`status_id`, `value`) VALUES (0, 'Не подтвержден'), (1, 'Принял'), (2, 'Отклонил');    ";

    mysql_query($sql) || die("Couldn't exec query: $sql. Error if any was: ".mysql_error() );
}


migrate_add_orderProduct_status_table();