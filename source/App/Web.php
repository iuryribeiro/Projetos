<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\View;
use Source\Models\Auth;
use Source\Models\Clients;
use Source\Models\Order;
use Source\Models\OrderItem;
use Source\Models\User;
use Source\Support\Message;

/**
 * Class Web
 * @package Source\App
 */
class Web extends Controller
{
    /** @var User */
    private $user;

    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
        $this->user = Auth::user();
    }

    public function root(): void
    {
        if (!$this->user) {
            redirect("/entrar");
        } else {
            redirect("/painel");
        }
    }

    /**
     * Page Inicio
     */
    public function home(): void
    {
        if (!Auth::user()) {
            redirect("/entrar");
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/shared.png")
        );
        echo $this->view->render("home", [
            "head" => $head
        ]);
    }

    public function index(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/shared.png")
        );
        echo $this->view->render("auth-loginpt", [
            "head" => $head
        ]);
    }

    public function pdf(array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/shared.png")
        );

        $order = (new Order)->find("id = :id", "id={$data["code"]}")->fetch();
        $orderItem = (new OrderItem())->find("order_id = :o", "o={$order->id}")->fetch(true);
        $totalItem = (new OrderItem())->find("order_id = :o", "o={$order->id}", "SUM(value) as total")->fetch();

        echo $this->view->render("pdf", [
            "head" => $head,
            "order" => $order,
            "orderItem" => $orderItem,
            "totalItem" => $totalItem
        ]);
    }

    public function signer(array $data): void
    {
        $base64 = substr($_POST["pdf"], 28);

        $token = "1a9bc52a-6acb-4b22-81f9-20ec787f540703dcf13c-93d3-458c-af5c-251128aeaade"; //TOKEN
        $url = "https://api.zapsign.com.br/api/v1/docs/?api_token={$token}"; //URL DESTINO
        $ch = curl_init( $url );// INICIO DO PROCEDIMENTO

        //DADOS DO CLIENTE
        $payload = array(
            "name"=>"Contrato de Admissão Erick Cordeiro",
            "signers"=>array(
                array(
                    "name"=>"Erick Cordeiro"
                )
            ),
            "base64_pdf"=>$base64
        );

        $payload = json_encode($payload);

        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($ch);
        $result = json_decode($result);
        foreach($result->signers as $key => $value){
            $url = "https://app.zapsign.com.br/verificar/".$value->token;
        }

        $json["redirect"] = $url;
        echo json_encode($json);
        curl_close($ch);
        return;
    }


    public function insertClients(array $data): void
    {
        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $clients = (new Clients());
            $clients->user_id = $this->user->id;
            $clients->fullname = $data["fullname"];
            $clients->email = $data["email"];
            $clients->telefone = $data["telefone"];

            if (!empty($data["document"])) {
                $clients->document = $data["document"];
            }

            if (!empty($data["rg"])) {
                $clients->rg = $data["rg"];
            }

            if (!empty($data["street"])) {
                $clients->street = $data["street"];
            }

            if (!empty($data["code"])) {
                $clients->code = $data["code"];
            }

            if (!empty($data["city"])) {
                $clients->city = $data["city"];
            }

            if (!empty($data["uf"])) {
                $clients->uf = $data["uf"];
            }

            if (!empty($data["obs"])) {
                $clients->observation = $data["obs"];
            }

            if (!$clients->save()) {
                $json["message"] = $clients->message()->render();
                echo json_encode($json);
                return;
            }

            $json["message"] = $this->message->success("Cliente cadastrado com sucesso!")->render();
            echo json_encode($json);
            return;
        }
    }

    /**
     * Listagem Order
     */
    public function listOrder(): void
    {
        if (!Auth::user()) {
            redirect("/");
        }

        $order = (new Order())->find()->fetch(true);

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/shared.png")
        );

        echo $this->view->render("list-register", [
            "head" => $head,
            "order" => $order
        ]);
    }

    public function removeOrder(array $data): void
    {
        if (!Auth::user()) {
            redirect("/");
        }

        $order = (new Order())->find("id = :id",
            "id={$data["code"]}")->fetch();

        if ($order) {
            $orderItem = (new OrderItem())->find("order_id = :id", "id={$order->id}")->fetch(true);

            if ($orderItem) {
                foreach ($orderItem as $item) {
                    $item->destroy();
                }
            }

            $order = (new Order())->find("id = :id", "id={$data["code"]}")->fetch();
            $order->destroy();
        }

        $json["message"] = $this->message->success('Registro excluido com sucesso')->flash();
        $json["redirect"] = url("/listagem-notas");
        echo json_encode($json);
        return;
    }

    /**
     * Page Cadastro de Notas
     */
    public function order(?array $data): void
    {
        if (!empty($data)) {

            $order = new Order();
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            if ($data["payMent"] != "Formas de pagamento") {

                //Verificando se o numero do cheque não esta em branco
                if ($data["payMent"] == "payCheck" && $data["nCheck"] != "") {
                    $order->payment = $data["payMent"];
                    $order->number_check = $data["nCheck"];
                } else if ($data["payMent"] == "payCheck" && $data["nCheck"] == "") {
                    $json["message"] = $this->message->warning("Número do Check inválido, por favor verifique!")->render();
                    echo json_encode($json);
                    return;
                } else {
                    $order->payment = $data["payMent"];
                }

            } else {
                $json["message"] = $this->message->warning("Forma de Pagamento não foi selecionada, por favor verifique!")->render();
                echo json_encode($json);
                return;
            }

            //Dados do cliente
            $order->user_id = $this->user->id;
            $order->client_origem = $data["name_origem"];
            $order->street_origem = $data["address_origem"];
            $order->code_origem = $data["cep_origem"];
            $order->tel_origem = $data["phone_origem"];
            $order->uf_origem = $data["state_origem"];
            $order->city_origem = $data["city_origem"];
            $order->email_origem = $data["email_origem"];

            //Dados do Destinatário
            $order->client_dest = $data["name_dest"];
            $order->street_dest = $data["address_dest"];
            $order->code_dest = $data["cep_dest"];
            $order->city_dest = $data["city_dest"];
            $order->tel_dest = $data["phone_dest"];
            $order->uf_dest = $data["state_dest"];
            $order->email_dest = $data["email_dest"];

            //Informações Finais
            $order->value_transp = str_replace([".", ","], ["", "."], $data["vlrTransp"]);
            $order->collection = str_replace([".", ","], ["", "."], $data["txColeta"]);
            $order->material = str_replace([".", ","], ["", "."], $data["material"]);
            $order->excess_weight = str_replace([".", ","], ["", "."], $data["excessodeP"]);
            $order->subtotal = $data["subTotal"];

            if ($data["payMeht"] == "segSim") {

                //Verificando se o campo esta preenchido
                if ($data["vlrSeguro"] == "") {
                    $json["message"] = $this->message->warning("Valor do seguro não informado, por favor verifique!")->render();
                    echo json_encode($json);
                    return;
                }

                if($data["vlrDeclarado"] == ""){
                    $json["message"] = $this->message->warning("Valor da % declarada não informado, por favor verifique!")->render();
                    echo json_encode($json);
                    return;
                }

                $order->value_safe = str_replace([".", ","], ["", "."], $data["vlrSeguro"]);
                $order->percentage = str_replace("%", "", $data["vlrDeclarado"]);
                $safe = str_replace([".", ","], ["", "."], $data["vlrSeguro"]);
                $percentage = str_replace("%", "", $data["vlrDeclarado"]);

                $totalSub = ($data["subTotal"] + $safe) + ($safe * ($percentage / 100));
                $order->total = $totalSub;
            } else {
                $order->total = $data["subTotal"];
            }

            if (!$order->save()) {
                $json["message"] = $order->message()->render();
                echo json_encode($json);
                return;
            }

            $orderItem = new OrderItem();
            foreach ($data["desc"] as $key => $value) {
                $produto = $value;
                $tamanho = $data["sizeBox"][$key];
                $valor = str_replace([".", ","], ["", "."], $data["value"][$key]);

                $orderItem->order_id = $order->id;
                $orderItem->box_size = $tamanho;
                $orderItem->description = $produto;
                $orderItem->value = $valor;

                if (!$orderItem->save()) {
                    $json["message"] = $this->message->error("Ouve um problema ao registrar seus itens, chame o suporte!")->render();
                    echo json_encode($json);
                    return;
                }
            }

            $json["message"] = $this->message->success("Nota gerada com sucesso!")->flash();
            $json["redirect"] = url("listagem-notas");
            echo json_encode($json);
            return;

        }

        if (!Auth::user()) {
            redirect("/");
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            theme("/assets/images/shared.png")
        );
        echo $this->view->render("register", [
            "head" => $head
        ]);
    }

    /**
     * Auth Login
     */
    public function login(?array $data): void
    {

        if (!empty($data['csrf'])) {

            //Verificando se o csrf é valido ou não
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor user o formulário")->render();
                echo json_encode($json);
                return;
            }

            //Verificando o limite
            if (request_limit("weblogin", 10, 60 * 5)) {
                $json['message'] = $this->message->error("Você já efetuou 10 tentativas, esse é o limite. Por favor aguarde por 5 minutos para tentar novamente!")->render();
                echo json_encode($json);
                return;
            }

            if (empty($data['email']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu e-mail ou senha para entrar")->render();
                echo json_encode($json);
                return;
            }

            $save = (!empty($data['save']) ? true : false);
            $auth = new Auth();
            $login = $auth->login($data['email'], $data['password'], $save);

            if ($login) {
                $json['redirect'] = url('/');
            } else {
                $json['message'] = $auth->message()->render();
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Entrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/entrar"),
            theme("/assets/images/shared.png")
        );
        echo $this->view->render("auth-login", [
            "head" => $head,
            "cookie" => filter_input(INPUT_COOKIE, "authEmail"),
        ]);
    }

    /**
     * Auth Register
     * @param null|array $data
     */
    public function register(?array $data): void
    {

        // Verificando se existe o campo CSRF;
        if (!empty($data['csrf'])) {
            //Verificando se o csrf é valido ou não
            if (!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enviar, favor user o formulário")->render();
                echo json_encode($json);
                return;
            }

            //Verificando se não existe campos vazio.
            if (in_array("", $data)) {
                $json['message'] = $this->message->info("Informe seus dados para criar sua conta.")->render();
                echo json_encode($json);
                return;
            }

            //Verificando o campo Repetir senha
            if (empty($data["password_re"]) || $data["password"] != $data["password_re"]) {
                $json["message"] = $this->message->warning("Senhas digitadas inválidas, verifique!")->render();
                echo json_encode($json);
                return;
            }


            $auth = new Auth();
            $user = new User();

            //Informando dado a dado pois é muito valido informar todos os campos por segurança
            $user->bootstrap(
                $data["first_name"],
                $data["last_name"],
                $data["email"],
                $data["password"]
            );
            //Efetuando o registro
            if (!$auth->register($user)) {
                $json['message'] = $auth->message()->render();
            } else {
                $json['redirect'] = url("/entrar");
            }

            echo json_encode($json);
            return;
        }

        $head = $this->seo->render(
            "Cadastrar - " . CONF_SITE_NAME,
            CONF_SITE_DESC,
            url("/registrar"),
            theme("/assets/images/shared.png")
        );
        echo $this->view->render("auth-register", [
            "head" => $head
        ]);
    }

    /**
     * APP LOGOUT
     */
    public function logout()
    {
        (new Message())->info("Você saiu com sucesso " . Auth::user()->first_name . ". Volte logo :)")->flash();

        Auth::logout();
        redirect("/entrar");
    }

    /**
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();

        switch ($data['errcode']) {
            case "problemas":
                $error->code = $data['errcode'];
                $error->title = "Estamos enfrentando problemas!";
                $error->message = "Parece que nosso serviço não está disponível, Já estamos vendo isso mas caso precise, envie-nos um e-mail :)";
                $error->linkTitle = "Enviar E-mail!";
                $error->link = "mailto:" . CONF_MAIL_SUPPORT;
                break;

            case "manutencao":
                $error->code = "OPS";
                $error->title = "Desculpe. Estamos em manutenção";
                $error->message = "Voltamos logo! Por hora estamos trabalhando para melhorar nosso conteúdo para você controlar melhor as suas contas :P";
                $error->linkTitle = null;
                $error->link = null;
                break;

            default:
                $error->code = $data['errcode'];
                $error->title = "Ooops. Conteúdo indiponivel :/";
                $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não existe, está indisponivel no momento ou foi removido!";
                $error->linkTitle = "Continue navegando!";
                $error->link = url_back();
                break;
        }

        $head = $this->seo->render(
            "{$error->code} | {$error->title}",
            $error->message,
            url("/ops/{$error->code}"),
            theme("/assets/images/shared.png"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);

    }
}