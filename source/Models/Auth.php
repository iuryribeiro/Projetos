<?php


namespace Source\Models;


use Source\Core\Model;
use Source\Core\Session;
use Source\Core\View;
use Source\Support\Email;

/**
 * Class Auth
 * @package Source\Models
 */
class Auth extends Model
{
    /**
     * Auth constructor.
     */
    public function __construct()
    {
        parent::__construct("user", ["id"], ["email", "password"]);
    }

    /**
     * @return User|null
     */
    public static function user(): ?User
    {
        $session = new Session();
        if (!$session->has("authUser")) {
            return null;
        }

        return (new User())->findById($session->authUser);
    }

    /**
     * Logout
     */
    public static function logout(): void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    /**
     * @param User $user
     * @return bool
     */
    public function register(User $user): bool
    {
        if (!$user->save()) {
            $this->message = $user->message;
            return false;
        }
        return true;
    }

    public function login(string $email, string $password, bool $save = false): bool
    {
        //Verificando o e-mail do usuário
        if (!is_email($email)) {
            $this->message->warning("O e-mail informado não é válido");
            return false;
        }

        //Verificando o lembrar dados e criando o cookie do usuário
        if ($save) {
            setcookie("authEmail", $email, time() + 604800, "/");
        } else {
            setcookie("authEmail", null, time() - 3600, "/");
        }

        //Verificando a Senha do usuário
        if (!is_passwd($password)) {
            $this->message->warning("A senha informada não é válida");
            return false;
        }

        //Verificando o E-mail do Usuário
        $user = (new User)->findByEmail($email);
        if (!$user) {
            $this->message->error("O e-mail informado não esta cadastrado");
            return false;
        }

        //Senha informada não confere com a do banco de dados
        if (!passwd_verify($password, $user->password)) {
            $this->message->error("A senha informada não confere");
            return false;
        }

        //Verifica se precisa atualizar a hash da senha;
        if (passwd_rehash($user->password)) {
            $user->password = $password;
            $user->save();
        }

        //Login
        (new Session())->set("authUser", $user->id);
        return true;
    }
}