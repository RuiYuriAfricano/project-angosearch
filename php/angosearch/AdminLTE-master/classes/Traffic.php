<?php
/**
 * Created by PhpStorm.
 * User: ELISANDRA SERRA
 * Date: 11/08/2019
 * Time: 23:03
 */



class Traffic {


    private  $db;
    private  $uri;
    private  $ip;
    private  $data;
    private  $user_agent;


    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=bd_angosearch; charset=utf8', 'root','');
        $this->uri = urldecode(filter_input(INPUT_SERVER,'REQUEST_URI',FILTER_DEFAULT));
        $this->ip = '129.122.148.198'; //'189.110.56.197';brazil-saopaulo filter_input(INPUT_SERVER,'REMOTE_ADDR',FILTER_VALIDATE_IP)
        $cookie = filter_input(INPUT_COOKIE,md5($this->uri),FILTER_DEFAULT);
        $this->user_agent = filter_input(INPUT_SERVER,'HTTP_USER_AGENT');
      if(!$cookie):
           $this->_set_cookie();
        $this->_set_data();
          endif;


    }
    private function _set_cookie(){
        setcookie(md5($this->uri),TRUE,  strtotime(date('Y-m-d 23:59:59')));
    }
    private  function  _set_data(){
        /*$geo = json_decode(file_get_contents("http://ip-api.com/{$this->ip}"));*/

      $this->data['data']=date('Y-m-d H:i:s');
            $this->data['pagina']=$this->uri;
        $this->data['ip']=$this->ip;
       /* $this->data['cidade']=(isset($geo->city))?$geo->city:'Desconhecida';
        $this->data['regiao']=(isset($geo->regionName))?$geo->regionName:'Desconhecida';
        $this->data['pais']=(isset($geo->country))?$geo->country:'Desconhecido';*/

        $this->data['cidade']='Talatona';
        $this->data['regiao']='Luanda';
        $this->data['pais']='Angola';
      $this->data['navegador']=$this->_get_browser();
      $this->data['plataforma']=$this->_get_plataform();
      $this->data['referencia']=$this->_get_referer();

        $this->_rec_data();



    }

    private function _get_browser(){
        require_once('config/browsers.php');
        foreach($browsers as $key => $value):

            if(preg_match('|'.$key.'.*?([0-9\.]+)|i',$this->user_agent)):
                 return $value;
                endif;

            endforeach;
    }
    private function _get_plataform(){
        require_once('config/plataforms.php');
        foreach($plataforms as $key => $value):

            if(preg_match('|'.preg_quote($key).'|i',
                $this->user_agent)):
                return $value;
            endif;

        endforeach;
    }

    private function _get_referer(){
        $referer = filter_input(INPUT_SERVER,'HTTP_REFERER',FILTER_VALIDATE_URL);
        $referer_host = parse_url($referer,PHP_URL_HOST);
        $host = filter_input(INPUT_SERVER,'SERVER_NAME');
        if(!$referer):
            $retorno = 'Acesso Direito';
            elseif($referer_host==$host):
                $retorno='Navegação Interna';
                else:
                    $retorno=$referer;
                    endif;
        return $retorno;
    }

    private function _rec_data(){
        $sql= "INSERT INTO trafego(dt, pagina, ip, cidade, regiao, pais, navegador, referencia, plataforma)
                VALUES(:data, :pagina, :ip, :cidade, :regiao, :pais, :navegador, :referencia, :plataforma)" ;
        $query = $this->db->prepare($sql);
        $query ->execute($this->data);
    }
} 