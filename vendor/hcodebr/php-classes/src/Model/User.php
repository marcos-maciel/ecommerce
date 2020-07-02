<?php 

namespace Hcode\Model;

use Hcode\DB\Sql;

class User {

    public static function login($login, $password) {

        $sql = new Sql();

        $result = $sql->select("select * from tb_users where deslogin = :LOGIN", array( //usar o :LOGIN dentro do select ou inves de usar $login direto, é mais seguro
            ":LOGIN" => $login
        ));

        if (count($result) === 0) {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }

        $data = $result[0];

        if(password_verify($password, $data["despassword"]) === true) {
            $user = new User();
        } else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }

    }
}

?>