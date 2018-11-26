<?php
/* Todos os controllers que necessitam de autenticação estendem desse controller. 
 * Esse controller estende Do PadraoController 
 * Caso estenda desse controller deverá ser informado as credenciais de autenticação
 */

class AuthController extends PadraoController{
    
    public function init() {
        //Authentication...
        $auth = Zend_Auth::getInstance();
        //redireciona para a tela de login caso nao esteja logado        
        if(!$auth->hasIdentity()){
            Zend_Session::expireSessionCookie();
            $this->redirect('http://' . $_SERVER['HTTP_HOST'] . '/permissoes/login', array('exit'));
        }//if    
    }//init   
}//Auth Class
