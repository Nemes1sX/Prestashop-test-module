<?php
# /modules/bandomojiuzdutotis/controllers/admin/AdminUzduotisAdmin.php

/**
 * Bandomoji uzduotis - A Prestashop Module
 * 
 * Test
 * 
 * @author Kazimieras Stonkus <kazstonk@gmail.com>
 * @version 0.0.1
 */

if (!defined('_PS_VERSION_')) exit;
//require_once (_PS_MODULE_DIR_ . 'bandomojiuzduotis/views/templates/admin/mymodule.tpl');

// You can now access this controller from /your_admin_directory/index.php?controller=AdminUzduotisAdmin
class AdminUzduotisAdminController extends ModuleAdminController
{
	public function __construct()
	{
		parent::__construct();
	    $this->bootstrap = true;
	}



	public function initContent()
	{
	    parent::initContent();

	    $content = $this->context->smarty->fetch(_PS_MODULE_DIR_.'bandomojiuzdutotis/views/templates/admin/test.tpl');
		// You can create your custom HTML with smarty or whatever then concatenate your list to it and serve it however you want !
		$this->context->smarty->assign(array(
		   'content' => $this->content. $content,
        ));
	}

	public function postProcess()
    {
        if (Tools::isSubmit('saveData')) {
            $fields = $_POST;
            $first_name = Tools::getValue('first_name');
            $last_name = Tools::getValue('last_name');
            $email = Tools::getValue('email');

            Db::getInstance()->insert('uzduotis_model', array(
                'first_name' => pSQL($first_name),
                'last_name' => pSQL($last_name),
                'email' => pSQL($email),
            ));
        }
    }
}

