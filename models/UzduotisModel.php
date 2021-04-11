<?php
# /modules/bandomojiuzdutotis/models/UzduotisModel.php

/**
 * Bandomoji uzduotis - A Prestashop Module
 * 
 * Test
 * 
 * @author Kazimieras Stonkus <kazstonk@gmail.com>
 * @version 0.0.1
 */

if (!defined('_PS_VERSION_')) exit;

class UzduotisModelModel extends ObjectModel
{
	/** Your fields names, adapt to your needs */

	/** Your table definition, adapt to your needs */
	public static $definition = [
		'table' => 'uzduotis_model',
		'primary' => 'id_customer',
	];

	/** Create your table into database, adapt to your needs */
	public static function installSql()
	{
		$tableName = _DB_PREFIX_ . self::$definition['table'];
		$primaryField = self::$definition['primary'];

		$sql = "
			CREATE TABLE IF NOT EXISTS `{$tableName}` (
				`{$primaryField}` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`first_name` VARCHAR(256) NOT NULL, 
				`last_name` VARCHAR(256) NOT NULL,
				`email` VARCHAR(256) NOT NULL,
				PRIMARY KEY (`{$primaryField}`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;
		";

        return Db::getInstance()->execute($sql);
	}


	public static function uninstallSql()
    {
        $tableName = _DB_PREFIX_ . self::$definition['table'];

        $sql = "DROP TABLE IF EXISTS `{$tableName}` ";

        return Db::getInstance()->execute($sql);
    }
}

