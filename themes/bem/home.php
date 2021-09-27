<?php $v->layout("_theme"); ?>

<div class="part2 flex">
    <div class="w40">
        <div class="ret1 flex" onclick="acesso()">
            <p>Orders in progress</p>
            <h1>...</h1>
        </div>
        <div class="ret flex">
            <p>Registered Customers</p>
            <h1>...</h1>
        </div>
        <div class="ret flex">
            <p>Order tracking</p>
            <h1>...</h1>
        </div>
        <div class="ret2 flex">
            <div class="flex tte" id="tte">
                <p>In process</p>
                <h1 >...</h1>
            </div>
            <div class="flex res w100" id="divTran">
                <div class="w50 txt">
                    <p class="c1">In Transit 10</p>
                    <p class="c2">With Occurrence 4</p>
                    <p class="c3">Successfully delivered 10</p>
                </div>
                <div class="w50 img">
                <div id="canvas-holder"  class="hlw">
                <span>10</span>
                <canvas id="chart-area" class="wdi"></canvas>

                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w50 rightL">
        <div class="w100">
            <h1>Quick access</h1>
            <div class="w100 flex nit">
                <div class="gray">
                    <a href="<?= url("/listagem-notas"); ?>">
                    <img src="<?= theme("/assets/images/paper.svg"); ?>">
                    <p>New order</p>
                    </a>
                </div>
                <div class="gray2" onclick="openPop()">
                    
                    <img class="t1" src="<?= theme("/assets/images/people.svg"); ?>">
                    <p>New customer</p>
                
                </div>
                <div class="gray2">
                    <img src="<?= theme("/assets/images/bag.svg"); ?>">
                    <p class="t2">Tracking</p>
                </div>
            </div>
        </div>
        <div class="flex ttw">
            <div class="opc">
                <h1>In transit</h1>
                <div id="canvas-holder" class="slw" style="width:220px; margin-left: -35px; ">
                <span>10</span>
                <canvas id="chart-area2"></canvas>
                </div>
            </div>
            <div class="opc2">
                <h1>Occurrence</h1>
                <div id="canvas-holder" class="slw2" style="width:220px; margin-left: -35px; ">
                <span>04</span>
                <canvas id="chart-area3"></canvas>
            </div>
            </div>
            <div class="opc2">
                <h1>Handed out</h1>
                 <div id="canvas-holder" class="slw3" style="width:220px; margin-left: -35px; ">
                <span>10</span>
                <canvas id="chart-area4"></canvas>
            </div>
            </div>
        </div>
        <div class="flex white">
            <div class="w">
            </div>
            <div class="w1">
            </div>
        </div>
    </div>
</div>
<div class="flex ttw2">
            <div class="opc">
                <h1>In transit</h1>
                <div id="canvas-holder" class="dlw" >
                <span>10</span>
                <canvas id="chart-area5"></canvas>
                </div>
            </div>
            <div class="opc2">
                <h1>Occurrence</h1>
                <div id="canvas-holder" class="dlw2" >
                <span>04</span>
                <canvas id="chart-area6"></canvas>
            </div>
            </div>
            <div class="opc2">
                <h1>Handed out</h1>
                 <div id="canvas-holder" class="dlw3">
                <span >10</span>
                <canvas id="chart-area7"></canvas>
            </div>
            </div>
        </div>
<div class="rela">
    <div class="type flex">
        <h1 class="w20">Company</h1>
        <h1 class="w20">Date</h1>
        <h1 class="w20">Status</h1>
        <h1 class="w20">Manager</h1>
        <h1 class="w20">Actions</h1>
    </div>
    <hr>
    <div class="type flex">
        <p class="w20">IQ Contabil Dígital</p>
        <p class="w20">25/03/2020</p>
        <p class="entregue w20">Delivered</p>
        <p class="w20">Bruno Silva</p>
        <p class="w20 point">...</p>
    </div>
    <hr class="h2">
    <div class="type flex">
        <p class="w20">A Bordo Design</p>
        <p class="w20">25/03/2020</p>
        <p class="entregue w20">Progress</p>
        <p class="w20">Bruno Silva</p>
        <p class="w20 point">...</p>

    </div>
    <hr class="h2">
    <div class="type flex">
        <p class="w20">Márcia Móveis</p>
        <p class="w20">25/03/2020</p>
        <p class="entregue w20">Occurrence</p>
        <p class="w20">Bruno Silva</p>
        <p class="w20 point">...</p>

    </div>
</div>
