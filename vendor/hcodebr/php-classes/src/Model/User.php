<?php 

namespace Hcode\Model;

use Hcode\Model;
use Hcode\DB\Sql;

class User extends Model {

    const SESSION = "User";
    
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

            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getData();

            return $user;

        } else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
    }

    public static function verifyLogin($inadmin = true) {

        if ( 
                !isset($_SESSION[User::SESSION]) 
                || 
                !$_SESSION[User::SESSION] 
                || 
                !(int)$_SESSION[User::SESSION]["iduser"] > 0 
                || 
                (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
            ) 
            {
                header("Location: /admin/login");
                exit;
            }
    }

    public static function logout() {

        $_SESSION[User::SESSION] = NULL;

    }

    public static function listAllUsers() {
        
    }
}

?>