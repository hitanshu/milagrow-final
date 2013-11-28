<?php

if (!defined('_PS_VERSION_'))
    exit;

class FeedBack extends Module
{

    private $html = '';

    public function __construct()
    {
        $this->name = 'feedback';
        $this->tab = 'front_office_features';
        $this->version = 1.0;
        $this->author = 'GAPS';
        $this->module_key = 'a2b7cee1897e09a7783e7d1fa5738873';
        $this->need_instance = 0;
        parent::__construct();
        $this->displayName = $this->l('Feedback Form');
        $this->description = $this->l('Enable you to get feedbacks from your clients');
    }

    public function install()
    {
        if (parent::install() == false OR !$this->registerHook('displayFooter') OR !$this->registerHook('header')
        )
            return false;

        return true;
    }

    public function uninstall()
    {
        if (parent::uninstall() == false)
            return false;
        return true;
    }


    public function hookHeader($params)
    {
        $this->context->controller->addCSS($this->_path . 'views/css/style.css', 'all');
        $this->context->controller->addJS($this->_path . 'views/js/tab-slideout.js');
        $this->context->controller->addJS($this->_path . 'views/js/feedback.js');


    }

    public function hookdisplayFooter($params)
    {

        return $this->display(__FILE__, 'feedbackfooter.tpl');
    }

}
