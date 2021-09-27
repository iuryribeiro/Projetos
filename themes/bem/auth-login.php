<?php $v->layout('_login'); ?>

<div class="ajax_load">
    <div class="example">
    <div class="sk-flow">
      <div class="sk-flow-dot"></div>
      <div class="sk-flow-dot"></div>
      <div class="sk-flow-dot"></div>
    </div>
  </div>
</div>

<header class="login">
    <div class="container">
        <div class="in flex w100">
            <div class="w10"></div>
            <h1>BEM BRANCAS - ENCOMENDAS E MUDANÇAS</h1>
            <ul class="menu flex">
                <li class="ta flex"><img class="br" id="br" src="<?= theme("/assets/images/eua.jpg") ?>">
                    <h2>EN<img class="arrow" src="<?= theme("/assets/images/arrow.svg") ?>"></h2>
                    <ul>
                        <li><a href="<?= url("/br") ?>" class="flex">
                                <img class="br" id="br"
                                     src="<?= theme("/assets/images/br.jpg") ?>">PT</a>
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
                <h1>Private Area</h1>
                <div class="request">
                    <form method="POST" action="<?= url("/entrar") ?>" enctype="multipart/form-data">
                        <div class="ajax_response"><?= flash(); ?></div>
                        <br>
                        <?= csrf_input(); ?>
                        <input type="email" name="email" required  maxlength="30">
                        <label>E-mail</label>

                        <input type="password" name="password" required  maxlength="32" class="incor">
                        <label class="ott">Password</label>
                        <button>Submit</button>
                    </form>
                    <p>If you are unable to access, contact the administrator</p>
                    <a href="">Call support.</a>
                </div>
            </div>
        </div>
    </div>
</header>
