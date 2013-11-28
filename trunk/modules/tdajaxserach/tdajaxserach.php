<?phpif (!defined('_PS_VERSION_'))	exit;class tdajaxserach extends Module{	public function __construct()	{		$this->name = 'tdajaxserach';		$this->tab = 'search_filter';		$this->version = 1.0;		$this->author = 'ThemesDeveloper';		$this->need_instance = 0;		parent::__construct();		$this->displayName = $this->l('ThemesDeveloper Ajax Product Search');		$this->description = $this->l('Adds a block with a search field.');	}	public function install()	{		if (!parent::install() || !$this->registerHook('top') || !$this->registerHook('header'))			return false;		return true;	}	public function hookHeader($params)	{		if (Configuration::get('PS_SEARCH_AJAX'))			$this->context->controller->addJqueryPlugin('autocomplete');                		$this->context->controller->addCSS(($this->_path).'tdajaxsearch.css', 'all');	}	public function hookTop($params)	{                $this->smarty->assign(array(			'modules_dir' =>__PS_BASE_URI__.'modules/tdajaxserach/',                         'ajaxsearch' =>Configuration::get('PS_SEARCH_AJAX'),			'instantsearch' =>Configuration::get('PS_INSTANT_SEARCH'),			'self' =>dirname(__FILE__),                        'ENT_QUOTES' =>ENT_QUOTES,			'search_ssl' =>Tools::usingSecureMode()					));		return $this->display(__FILE__, 'tdajaxsearch_top.tpl');	}}