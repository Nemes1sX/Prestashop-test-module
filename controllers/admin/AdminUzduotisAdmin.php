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
    public $name = _DB_PREFIX_.'uzduotis_model';
    public $displayName = 'Uzduotis';

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

  /*  public function displayList()
    {
        $sql = "SELECT * FROM"._DB_PREFIX_."uzduotis_model";
        if ($result = Db::getInstance()->executeS($sql)) {
            $fields_list = array(
                'id_customer' => array(
                    'title' => 'ID',
                    'width' => 'auto',
                    'type' => 'text'
                ),
                'first_name' => array(
                    'title' => $this->l('First name'),
                    'width' => 'auto',
                    'type' => 'text'
                ),
                'last_name' => array(
                    'title' => $this->l('Last name'),
                    'width' => 'auto',
                    'type' => 'text'
                ),
                'email' => array(
                    'title' => $this->l('Email'),
                    'width' => 'auto',
                    'type' => 'text'
                ),
            );

            $helper = new HelperList();

            $helper->shopLinkType = '';
            $helper->simple_header = true;
            $helper->identifier = 'id_customer';
            $helper->actions = array('edit', 'delete');
            $helper->show_toolbar = false;
            $helper->title = $this->displayName;
            $helper->table = $this->name;
            $helper->token = Tools::getAdminTokenLite('AdminModules');
            $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->displayName;

            return $helper->generateList($result, $fields_list);
        }

        return false;
    }*/

	public function postProcess()
    {
        if (Tools::isSubmit('saveData')) { // If form is submited, the data will be inserted
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

