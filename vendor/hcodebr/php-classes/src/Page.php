<?php

namespace Hcode;

use Rain\Tpl; // usado para carregar paginas 

class Page {

    private $tpl;
    private $options = [];
    private $defaults = ["data"=>[]];

    public function __construct($opts = array()) {

        $this->options = array_merge($this->defaults, $opts); //inicialmente pega o valor de $defaults, caso o usuario passe alguma coisa, grava na variavel $opts e sobreescreve $defaults

        $config = array(
					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"]."/views/",
                    "cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
                    "debug"         => false
				   );

        Tpl::configure($config);
        
        $this->tpl = new Tpl;

        foreach ($this->options as $key => $value) {
            $this->tpl->assign($key, $value);
        }

        $this->setData($this->options["data"]);

        $this->tpl->draw("header");

    }

    public function setData($data = array()) {

       foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        } 
    }

    public function setTpl($name, $data = array(), $returnHTML = false) {

        $this->setData($data);

        return $this->tpl->draw($name, $returnHTML);
    }

    public function __destruct() {

        $this->tpl->draw("footer");
    }

}

?>