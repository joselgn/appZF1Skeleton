<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {    
 
    /**
     * Initialize autoloader
     *
     * Use the setFallbackAutoloader() method to have the autoloader act
     * as a catch-all
     *
     * @return void
     */
    protected function _initPlaceholders() {
        $this->bootstrap("frontController");
        $this->bootstrap('View');
        $view = $this->getResource('View');
        //doctype
        $view->doctype('HTML4_STRICT');
        //meta tag
        $view->headMeta()->appendHttpEquiv('Content-Type', 'Text/html; charset=UTF-8');
        //favicon
        //$view->headLink()->headLink(array('rel' => 'shortcut icon', 'href' => $view->baseUrl('/public/img/animated_favicon_conseguro.gif'), 'type' => 'image/x-icon', 'PREPEND'));          
        //Vars Definitions        
    }

    /**
     * Função faz a conexão com o banco de dados e registra a variável $db para
     * que ela esteja disponível em toda a aplicação.
     */
    protected function _initSession() {
       /* $this->bootstrap('multidb');
        $multidb = $this->getPluginResource('multidb');
        Zend_Registry::set('db_permissoes', $multidb->getDb('permissoes'));
        Zend_Registry::set("db", $multidb->getDb('usuarios'));
        Zend_Db_Table_Abstract::setDefaultAdapter($multidb->getDb('permissoes'));
        $config = array(
            'name' => 'permissoes.tb_session',
            'primary' => 'id',
            'modifiedColumn' => 'modified',
            'dataColumn' => 'data',
            'lifetimeColumn' => 'lifetime',
            'db' => $multidb->getDb('permissoes')
        );        
        Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable($config));*/
       // Zend_Session::start();
    }

    protected function _initAutoload() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->setFallbackAutoloader(true);
        $loaderHelper = Zend_Loader_Autoloader::getInstance();
        $loaderHelper->registerNamespace('Helper_');       
    }

    protected function _initHelpers() {
       // Zend_Controller_Action_HelperBroker::addPath(APPLICATION_PATH . '/actionHelpers');
    }   

    /**
     * Initialize Translate
     *
     * Use the setDefaultTranslator() method to have the translator act
     * as a catch-all
     *
     * @return void
     */
    public function _initTranslate() {
//        $translator = new Zend_Translate(array('adapter' => 'array', 'content' => '../library/translate', 'locale' => 'pt_BR', 'scan' => Zend_Translate::LOCALE_DIRECTORY));
//        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
    
  
    
}//bootstrap class
