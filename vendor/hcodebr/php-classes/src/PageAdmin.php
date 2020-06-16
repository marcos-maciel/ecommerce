<?php

namespace Hcode;

class PageAdmin extends Page {

    public function __construct($opts = array(), $tpl_dir = "/views/admin/") {
        parent::__construct($opts, $tpl_dir); //parent esta chamando o construct da classe Pai(que é a Page)
    }
}

?>