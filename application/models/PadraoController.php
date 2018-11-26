<?php
//Todos os controllers estendem desse controller por padrão exceto os que necessitem de autenticação.
//Não precisa de credenciais para autenticação, não requer autenticação.

class PadraoController extends Zend_Controller_Action {
    
    /* ///////______________   INTERNAL FUNCTIONS  ____________________________________\\\\\\\\ */
    /*
     * Função utilizada no Layout 
     * Verifica a data atual em valores e retorna a data por extenso
     * $type {'m' => retorna o mês do ano por extenso | 'w' => retorna o dia da semana por extenso}
     * $valor = valor numérico referente ao dia da semana ou mês | para o mẽs varia de 1=>janeiro a 12=>dezembro / para a semana varia de 0>domingo a 6=>sábado
     * Exemplo: _verifData('m', 1) retornará Janeiro
     *          _verifData('w', 3) retornará Quarta-Feira
     */        
    public function _verifData($type, $valor) {
        switch ($type) {
            case 'm'://mês do ano
                $retorno = array(
                    1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto', 9 => 'Setembro', 10 => 'Outubro',
                    11 => 'Novembro', 12 => 'Dezembro'
                );
                break;
            case 'w'://dia da semana
                $retorno = array(
                    0 => 'Domingo', 1 => 'Segunda-feira', 2 => 'Terça-feira', 3 => 'Quarta-feira', 4 => 'Quinta-feira', 5 => 'Sexta-feira', 6 => 'Sábado'
                );
                break;
        }//switch

        $verif = $retorno[$valor];
        return $verif;
    }//_verifData
    
    /*
     * Função utilizada em qualquer escopo do projeto dentro dos controlers 
     * Recebe como parâmetro a data que vem do banco no formato yyyy-mm-dd
     * Recebe como segundo parâmetro um booleano se true retornará a data com hora, se false retornará apenas a data / default=false
     * $dateTime = data no formato YYYY-MM-DD ou YYYY-MM-DD HH:ii:ss
     * $useHora = recebe true ou false caso a data enviada possua hora deve ser setado true / default = false     
     * Exemplo: _dateToUser('2014-12-11') retornará 11/12/2014
     *          _dateToUser('2014-12-11 14:30:00', true) retornará 11/12/2014 14:30:00
     *          _dateToUser('2014-12-11 14:30:00', false) retornará 11/12/2014
     */
    static function _dateToUser($dateTime, $useHora = false) { //Mostra a data do Banco para o Usuário
        $data = substr(str_replace("-", "", $dateTime), 0);
        $ano = substr($data, 0, 4);
        $mes = substr($data, 4, 2);
        $dia = substr($data, 6, 2);
        $hora = substr($data, -8);
        if ($useHora) {
            return $dia . "/" . $mes . "/" . $ano . " " . $hora;
        } else {
            return $dia . "/" . $mes . "/" . $ano;
        }
    }//dateToUser

     /*
     * Função utilizada em qualquer escopo do projeto dentro dos controlers 
     * Recebe como parâmetro a data que vem do banco no formato yyyy-mm-dd
     * Recebe como segundo parâmetro um booleano se true retornará a data com hora, se false retornará apenas a data / default=false
     * $dateTime = data no formato YYYY-MM-DD ou YYYY-MM-DD HH:ii:ss
     * $useHora = recebe true ou false caso a data enviada possua hora deve ser setado true / default = false     
     * Exemplo: _dateToDB('11/12/2014') retornará 2014-12-11
     *          _dateToDB('11/12/2014 14:30:00', true) retornará 2014-12-11 14:30:00
     *          _dateToDB('11/12/2014 14:30:00', false) retornará 2014-12-11
     */
    static function _dateToDB($dateTime, $useHora = false) {//Converte a data do Usuário para o Banco
        $data = substr(str_replace("/", "", $dateTime), 0);
        $ano = substr($data, 4, 4);
        $mes = substr($data, 2, 2);
        $dia = substr($data, 0, 2);
        $hora = substr($data, -8);
        if ($useHora) {
            return $ano . "-" . $mes . "-" . $dia . " " . $hora;
        } else {
            return $ano . "-" . $mes . "-" . $dia;
        }
    }//dateToDB
    
    /*
     * Função utilizada em qualquer escopo do projeto dentro
     * Recebe como parâmetro o nome a ser tratado
     * Recebe como segundo parâmetro a quantidade de caracteres máxima a ser aceitada
     * Se o tamanho do nome for maior que a quantidade máxima de caracteres, este será abreviado.
     * Tem como padrão o tamanho máximo de 30 caracteres.
     * Exemplo: _trataNome('JOSE CARLOS FERNANDES E FERNANDES FIHO') retornará JOSE CARLOS FILHO 
     * caso seja maior que a qde máxima de caracteres retornará JOSE FILHO
     */
    static function _trataNome($nome, $maxCaracteres = 30){
        $qde = strlen($nome);
        
        if($qde > $maxCaracteres){
         $arrayNome = explode(' ', $nome);
         $novoNome = $arrayNome[0].' '.$arrayNome[1].' '.$arrayNome[(count($arrayNome)-1)];
         
         if(strlen($novoNome) > $maxCaracteres){
             $arrayNome = explode(' ', $novoNome);
             $last = $arrayNome[0].' '.$arrayNome[(count($arrayNome)-1)];
             return $last;
         }else{
             return $novoNome;
         }            
        }else{
            return $nome;
        }//else qde caracteres        
    }//trataNome




/***********************************|
|******* Validadores de campos *****|
|***********************************/    

//    Valida Nomes
    public function _validaNome($nome, $allowWhiteSpace=true){
        $validador = new Zend_Validate_Alpha(array('allowWhiteSpace'=> $allowWhiteSpace));
        return $validador->isValid($nome);        
    }
        
}//PadraoCOntroller
