<?php
new Relatorios();
class Relatorios {

        private  $db;
        private  $data_atual;

    public function __construct(){
        $option = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET LC_TIME_NAMES = pt_BR"];
        $this->db = new PDO('mysql:host=localhost;dbname=bd_angosearch; charset=utf8', 'root','', $option);
        $this->data_atual= date('Y-m-d H:i:s');
        $uri = urldecode(filter_input(INPUT_SERVER,'REQUEST_URI'));
        $request = explode('/',$uri);
        $method = $request[3];
        $parametro= 4;

        if(method_exists(get_class(),$method)):
            $this->$method($parametro);

            else:
                return FALSE;
                endif;

}
    public  function trafego_por_hora($param =NULL){

        $periodo=date('Y-m-d H:i:s', strtotime($param));

        $sql = "SELECT HOUR(dt) as hora, COUNT(id_trafego) as views "
            ."FROM trafego "
            ."WHERE dt >='{$periodo}' "
            ."GROUP BY hora ";

        $query = $this->db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        foreach($result as $res):
            $dados[$res->hora] = $res ->views;
            endforeach;

        $horas = [];
        for($i = 0; $i < 24; $i++):
            array_push($horas,'0');
            endfor;

        $final = array_replace($horas,$dados);

        echo json_encode($final);


    }



        public  function  trafego_semanal(){

            $periodo=date('Y-m-d H:i:s', strtotime('-7 days'));

            $sql = "SELECT DAYNAME(dt) as dia, COUNT(id_trafego) as views "
                ."FROM trafego "
                ."WHERE dt >='{$periodo}' "
                ."GROUP BY DAYNAME(dt) ".
                "ORDER BY dt";
            $query = $this->db->query($sql);
            $result = $query->fetchAll(PDO::FETCH_OBJ);

            foreach($result as $res):
                $dados[$res->dia] = $res ->views;
            endforeach;

            echo json_encode($dados);
        }

    public  function  trafego_mensal(){

        $mes=date('m');
        $ano=date('Y');

        $sql = "SELECT DAY(dt) as dia, COUNT(id_trafego) as views "
            ."FROM trafego "
            ."WHERE MONTH(dt) >='{$mes}' "
            ."AND YEAR(dt) >='{$ano}' "
            ."GROUP BY DAY(dt) ";
        $query = $this->db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        foreach($result as $res):
            $dados[$res->dia] = $res ->views;
        endforeach;

        $dias_do_mes = $this->_dia_do_mes();

        $final = array_replace($dias_do_mes,$dados);

        echo json_encode($final);
    }

    public  function trafego_por_plataforma($param =NULL){

        $periodo=date('Y-m-d H:i:s', strtotime($param));

        $sql = "SELECT plataforma, COUNT(id_trafego) as views "
            ."FROM trafego "
            ."WHERE dt >='{$periodo}' "
            ."GROUP BY plataforma ".
            "ORDER BY views DESC LIMIT 6";

        $query = $this->db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        $colors = ["#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc","#d2d6de"];

        $i=0;
        foreach($result as $res):
            $dados[$i]['label'] = $res ->plataforma;
            $dados[$i]['value'] = $res ->views;
            $dados[$i]['color'] = $colors[$i];

        $i++;
        endforeach;


        echo json_encode($dados);

    }

    public  function trafego_por_navegador($param =NULL){

        $periodo=date('Y-m-d H:i:s', strtotime($param));

        $sql = "SELECT navegador, COUNT(id_trafego) as views "
            ."FROM trafego "
            ."WHERE dt >='{$periodo}' "
            ."GROUP BY navegador ".
            "ORDER BY views DESC LIMIT 6";

        $query = $this->db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        $colors = ["#f56954","#00a65a","#f39c12","#00c0ef","#3c8dbc","#d2d6de"];

        $i=0;
        foreach($result as $res):
            $dados[$i]['label'] = $res ->navegador;
            $dados[$i]['value'] = $res ->views;
            $dados[$i]['color'] = $colors[$i];

            $i++;
        endforeach;


        echo json_encode($dados);

    }

    public function trafego_por_pagina($param=NULL){

        $periodo=date('Y-m-d H:i:s', strtotime($param));

        $sql = "SELECT pagina, COUNT(id_trafego) as views "
            ."FROM trafego "
            ."WHERE dt >='{$periodo}' "
            ."GROUP BY pagina ".
            "ORDER BY views DESC";

        $query = $this->db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        foreach($result as $res):
            $dados[$res->pagina] = $res ->views;
        endforeach;

        echo json_encode($dados);
    }




    private  function  _dia_do_mes(){

        $hoje = date('d');

        if($hoje <= 10):
            $esse_mes = 10;
            elseif($hoje <= 15):
                $esse_mes = 15;
        elseif($hoje <= 20):
            $esse_mes = 20;
        elseif($hoje <= 25):
            $esse_mes = 25;
            else:
                $esse_mes = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        endif;

                $dias=[1  => '0'];
        for($i=1; $i < $esse_mes; $i++):
                array_push($dias, '0');
            endfor;

        return $dias;
    }





}