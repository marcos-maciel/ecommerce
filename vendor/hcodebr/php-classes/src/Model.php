<?php 

namespace Hcode;

class Model {

    private $value = [];

    public function __call($name, $arguments)
    {
        
        $method = substr($name, 0, 3);
        $nomeCampo = substr($name, 3, strlen($name));
        
        switch ($method) {
            case "get":
                return $this->value[$nomeCampo];
            break;
            case "set":
                $this->value[$nomeCampo] = $arguments[0];
            break;
        }

    }

    public function setData($datas = array()) {
        foreach ($datas as $indice => $data) {
            $this->{"set".$indice}($data);
        }
    }

    public function getData() {
        return $this->value;
        
    }

}

?> 