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
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
    exit;

class SeniorDiscount extends Module
{

    function __construct()
    {
        $this->name = 'seniordiscount';
        $this->tab = 'front_office_features';
        $this->version = '0.9';
        $this->author = 'GAPS';
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Senior Citizen Discount Form');
        $this->description = $this->l('Senior Citizen Discount Form developed by GAPS');
    }

    function install()
    {
        if (!parent::install() || !$this->registerHook('header'))
            return false;
        include_once(_PS_MODULE_DIR_ . '/' . $this->name . '/seniordiscount_install.php');
        $seniorDiscountInstall = new SeniorDiscountInstall();
        $seniorDiscountInstall->createTables();
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall())
            return false;
        return true;
    }


    public function hookDisplayHeader($params)
    {
        $this->hookHeader($params);
    }

    public function hookHeader($params)
    {
//        $this->context->controller->addJS('/js/jquery/ui/jquery.ui.datepicker.min.js');
        $this->context->controller->addCSS(_THEME_CSS_DIR_ . 'contact-form.css');

    }
}