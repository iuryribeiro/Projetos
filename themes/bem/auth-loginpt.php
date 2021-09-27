<?php $v->layout('_login'); ?>

<header class="login">
    <div class="container">
        <div class="in flex w100">
            <div class="w10"></div>
            <h1>BEM BRANCAS - ENCOMENDAS E MUDANÇAS</h1>
            <ul class="menu flex">
                <li class="ta flex"><img class="br" id="br" src="<?= theme("/assets/images/br.jpg") ?>">
                    <h2>PT<img class="arrow" src="<?= theme("/assets/images/arrow.svg") ?>"></h2>
                    <ul>
                        <li><a href="<?= url("/") ?>" class="flex">
                                <img class="br" id="br"
                                     src="<?= theme("/assets/images/eua.jpg") ?>">EN</a>
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <div>

            <div class="form">
                <div class="logo">
                    <a href="<?= url("/"); ?>"><img src="<?= theme("/assets/images/logo.svg") ?>"></a>
                </div>
                <h1>Área Privada</h1>
                <div class="request">
                    <form method="POST" action="<?= url("/entrar") ?>" enctype="multipart/form-data">
                        <div class="ajax_response"><?= flash(); ?></div>
                        <br>
                        <?= csrf_input(); ?>
                        <input type="email" name="email" required placeholder="E-mail" maxlength="30">
                        <label>E-mail</label>

                        <input type="password" name="password" required placeholder="Senha" maxlength="32">
                        <label class="ot">Senha</label>
                        <button>Entrar</button>
                    </form>
                    <p>Se você não conseguir acessar, contate o administrador</p>
                    <a href="">Ligar para o suporte.</a>
                </div>
            </div>
        </div>
    </div>
</header>
