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
            <h1>BEM - ENCOMENDAS E MUDANÇAS</h1>
            <ul class="menu flex">
                <li class="ta flex"><img class="br" src="<?= theme("/assets/images/eua.jpg"); ?>">
                    <h2>EN<img class="arrow" src="<?= theme("/assets/images/arrow.svg"); ?>"></h2>
<!--                    <ul>-->
<!--                        <li><a href="indexen.html" class="flex">-->
<!--                                <img class="br" src="--><?//= theme("/assets/images/br.jpg"); ?><!--">BR</a>-->
<!--                        </li>-->
<!--                    </ul>-->
                </li>
            </ul>

        </div>
        <div>
            <div class="form2">
                <div class="logo">
                    <img src="<?= theme("/assets/images/logo.svg"); ?>">
                </div>
                <h1>Register Area</h1>
                <div class="request">
                    <form method="POST" action="<?= url("/registrar"); ?>" enctype="multipart/form-data">
                        <div class="ajax_response"><?= flash(); ?></div>
                        <br>
                        <?= csrf_input(); ?>
                        <input type="text" name="first_name" placeholder="Nome" required maxlength="30">
                        <label>First Name</label>
                        <input type="text" name="last_name" placeholder="Sobrenome" required maxlength="30">
                        <label>Last Name</label>
                        <input type="email"  name="email" placeholder="E-mail" required maxlength="40">
                        <label class="df">E-mail</label>
                        <input type="password" name="password" placeholder="Password" required maxlength="18">
                        <label class="ot">Password</label>
                        <input type="password" name="password_re" placeholder="Password" required maxlength="18">
                        <label class="t1">Confirm Password</label>
                        <button>Register</button>
                    </form>
                    <p>If you are unable to access, contact the administrator</p>
                    <a href="">Call support.</a>
                </div>
            </div>
        </div>
    </div>
</header>