<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class MyModule extends Module
{
    public function __construct()
    {
        $this->name = 'mymodule';
        $this->tab = 'front_office_features';
        $this->version = '0.1.0';
        $this->author = 'Hubert Suchorowski';
        $this->need_instance = 1;
        parent::__construct();

        $this->displayName = $this->trans('My module', [], 'Modules.MyModule.Admin');
        $this->description = $this->trans('Description of my module.', [], 'Modules.MyModule.Admin');
        $this->confirmUninstall = $this->trans('Are you sure you want to uninstall?', [], 'Modules.MyModule.Admin');
    }   

    public function getContent()
    {
        $route = $this->get('router')->generate('demo_configuration_form_simple');
        Tools::redirectAdmin($route);
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
    }

        return (
            parent::install() 
            && Configuration::updateValue('MYMODULE_NAME', 'my module')
        ); 
    }

    public function uninstall()
    {
        return (
            parent::uninstall() 
            && Configuration::deleteByName('MYMODULE_NAME')
        );
    }

  

}



