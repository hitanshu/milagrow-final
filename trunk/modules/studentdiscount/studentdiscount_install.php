<?php
/*
 * 2007-2013 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author PrestaShop SA <contact@prestashop.com>
 *  @copyright  2007-2013 PrestaShop SA
 *  @version  Release: $Revision: 14390 $
 *  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

if (!defined('_PS_VERSION_'))
    exit;

class StudentDiscountInstall
{
    /**
     * Create careers tables
     */
    public function createTables()
    {
        /* Set database */
        if (!Db::getInstance()->Execute('
		CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'student_discount` (
			`id_student_discount` int(10) unsigned NOT NULL AUTO_INCREMENT,
			`name` varchar(255) NOT NULL,
			`interest` varchar(255) NOT NULL,
			`college` varchar(255) NOT NULL,
			`city` varchar(255) DEFAULT NULL,
			`mobile` varchar(255) NOT NULL,
			`email` varchar(255) NOT NULL,
			`college_id_proof_file` varchar(255) NOT NULL,
			`created_at` datetime NOT NULL,
		    PRIMARY KEY (`id_student_discount`)
		) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8 AUTO_INCREMENT=1')
        )
            return false;
    }


}