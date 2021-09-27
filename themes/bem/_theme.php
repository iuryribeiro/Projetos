<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="utf-8">
    <?= $head; ?>

    <link rel="base" href="<?= url(); ?>">
    <link href="<?= theme('/assets/style.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= theme('/assets/images/favicon.png'); ?>">

    <?= $v->section("styles"); ?>
</head>

<body>

<div class="ajax_load">
    <div class="example">
    <div class="sk-flow">
      <div class="sk-flow-dot"></div>
      <div class="sk-flow-dot"></div>
      <div class="sk-flow-dot"></div>
    </div>
  </div>
</div>


<div id="myPop" class="overlay">
    <div class="cadPessoa">
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <h1>Contact Registration</h1>
        <form action="<?= url("/cadastrar") ?>" method="post" enctype="multipart/form-data">
            <div class="ajax_response"> <?= flash(); ?> </div>
            <br>
            <p>Contact name</p>
            <input type="text" name="fullname" placeholder="digite o nome do contato">
            <p>Contact Email</p>
            <input type="email" name="email" placeholder="digite o e-mail do contato">
            <p>Phone</p>
            <input type="text" name="telefone" placeholder="digite o telefone do contato">
            <div class="doc" id="doc">
                <p>CPF</p>
                <input type="text" name="document" placeholder="digite o CPF do contato">
                <p>RG</p>
                <input type="text" name="rg" placeholder="digite o RG do contato">
            </div>
            <div class="end" id="end">
                <p>Address</p>
                <input type="text" name="street" placeholder="digite o endereço do contato">
                <p>Zip code</p>
                <input type="text" name="code" placeholder="digite o CEP do contato">
                <p>City</p>
                <input type="text" name="city" placeholder="digite a cidade do contato">
                <p>State</p>
                <input type="text" name="uf" placeholder="digite o estado do contato">
            </div>
            <div id="obs">
                <p>Comments</p>
                <textarea class="obs" name="obs" placeholder="digite aqui suas observações"></textarea>
            </div>
            <div class="flex doc">
                <a id="openDoc">+Documents</a>
                <a id="openEnd">+Adresses</a>
                <a id="openObs">+Comments</a>
            </div>
            <div class="flex send">
                <a href="">cancel</a>
                <button>Register</button>
                <a href="">save and <br> create another</a>
            </div>
        </form>
    </div>
</div>

<div id="myPop2" class="overlay">
    <div class="cadPessoa">
        <a href="javascript:void(0)" class="closebtn">&times;</a>
        <h1>Contact Registration</h1>
        <form action="<?= url("/cadastrar") ?>" method="post" enctype="multipart/form-data">
            <div class="ajax_response"> <?= flash(); ?> </div>
            <br>
            <p>Contact name</p>
            <input type="text" name="fullname" placeholder="digite o nome do contato">
            <p>Contact Email</p>
            <input type="email" name="email" placeholder="digite o e-mail do contato">
            <p>Phone</p>
            <input type="text" name="telefone" placeholder="digite o telefone do contato">
            <div class="doc" id="doc">
                <p>CPF</p>
                <input type="text" name="document" placeholder="digite o CPF do contato">
                <p>ID</p>
                <input type="text" name="rg" placeholder="digite o RG do contato">
            </div>
            <div class="end" id="end">
                <p>Address</p>
                <input type="text" name="street" placeholder="digite o endereço do contato">
                <p>ZIP Code</p>
                <input type="text" name="code" placeholder="digite o CEP do contato">
                <p>City</p>
                <input type="text" name="city" placeholder="digite a cidade do contato">
                <p>State</p>
                <input type="text" name="uf" placeholder="digite o estado do contato">
            </div>
            <div id="obs">
                <p>Comments</p>
                <textarea class="obs" name="obs" placeholder="digite aqui suas observações"></textarea>
            </div>
            <div class="flex doc">
                <a id="openDoc">+Documents</a>
                <a id="openEnd">+Adress</a>
                <a id="openObs">+Comments</a>
            </div>
            <div class="flex send">
                <a href="">cancel</a>
                <button>Register</button>
                <a href="">save and <br> create another</a>
            </div>
        </form>
    </div>
</div>

<header class="private">
<div class="greenBar" id="greenBar"></div>
    <div class="container">

        <div class="green t2 container">
            
            <div class="flex ipt">

                <img class="menu" src="<?= theme("/assets/images/menu.svg"); ?>">

                <div class="w50">
                   <a href="<?= url("/painel"); ?>"> <img class="logo" src="<?= theme("/assets/images/bembranco.svg"); ?>">
                    </a>
                </div>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img src="<?= theme("/assets/images/dash.svg"); ?>">
                <a href="<?= url("/painel"); ?>">Dashboard</a>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img src="<?= theme("/assets/images/house.svg"); ?>">
                <a href="<?= url("/listagem-notas"); ?>">Registration</a>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img src="<?= theme("/assets/images/line.svg"); ?>">
                <a href="">Reports</a>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img src="<?= theme("/assets/images/timer.svg"); ?>">
                <a href="">Delivery</a>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img class="st" src="<?= theme("/assets/images/seta.svg"); ?>">
                <a href="">Unavailable</a>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img class="stt1" src="<?= theme("/assets/images/point3.svg"); ?>">
                <a href="">Settings</a>
            </div>
            <div class="hr2"></div>
            <div class="flex ip">
                <img class="stt" src="<?= theme("/assets/images/balon.svg"); ?>">
                <a href="">Need help?</a>
            </div>
            <div class="hr2"></div>
        </div>
        <div class="painel flex">
            <div class="txt flex">
                <h1>Dashboard</h1>
                <p><img src="<?= theme("/assets/images/bandeira.svg"); ?>"></p>
                <p>Control panel</p>
            </div>
            <div class="img flex">
                <ul class="ball">+
                    <ul>
                        <li>
                            <a href="<?= url("/listagem-notas"); ?>"><img src="<?= theme("/assets/images/custom+.svg") ?>">Digital Note</a>
                        </li>

                        <li onclick="openPop()">
                            <a><img src="<?= theme("/assets/images/person2.png") ?>">Register Customer</a>
                        </li>

                        <li>

                            <a href=""><img src="<?= theme("/assets/images/car.svg") ?>">Order Tracking</a>
                        </li>
                    </ul>
                </ul>

                <div class="ball3"> <div class="ball3"><ul class="menu flex">
                <li class="ta flex"><img class="br" id="br" src="<?= theme("/assets/images/eua.png") ?>">
                <ul>
               <li><a href="indexpt.php" class="flex"><img class="brt" id="brt" src="<?= theme("/assets/images/br.png") ?>"></a></li>
                </ul>
            </li>
            </ul>
            </div>  
        </div>
                <div class="ball4"><img src="<?= theme("/assets/images/sino.svg"); ?>"></div>
                <div class="ball2"><img src="<?= theme("/assets/images/person.png"); ?>"></div>
                <div class="txt">
                    <h1>Bruno Scott</h1>
                    <p class="en">CEO - Manager</p>
                    <a  class="en" href="<?= url("/sair"); ?>">Go out</a>
                </div>
            </div>
        </div>
    </div>
</header>
<main>
    <?= $v->section("content"); ?>
</main>

    <script src="<?= theme("/assets/js/notify.min.js"); ?>"></script>
    <script src="<?= theme("/assets/js/Chart.min.js"); ?>"></script>
    <script src="<?= theme("/assets/js/utils.js"); ?>"></script>
<script src="<?= theme("/assets/scripts.js"); ?>"></script>
<script>
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };

        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        40,
                        40,
                        20,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#66be87',
                        '#EB5757',

                    ],
                    borderWidth :[
                     '1',
                    ],
                    weight:[
                        '1',
                    ],
                    
                    
                }],
               
            },
            options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };
        var config2 = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        50,
                        50,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#BDBDBD',

                    ],
                    
                }],
               
            },
           options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }

        };
        var config5 = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        50,
                        50,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#BDBDBD',

                    ],
                    
                }],
               
            },
            options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }

        };
        var config3= {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        60,
                        40,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#EB5757',

                    ],
                    
                }],
               
            },
            options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }

        };
        var config6= {
            
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        60,
                        40,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#EB5757',

                    ],
                    
                }],
               
            },
           options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }

        };

        var config4= {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        50,
                        50,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#66be87',

                    ],
                   weight:[
                    '10',
                   ],
                    
                }],
               
            },
            options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }

        };
        var config7= {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        50,
                        50,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        '#66be87',

                    ],
                    
                }],
               
            },
            options: {
                cutoutPercentage:80,
                responsive: true,
                 legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                    
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }

        };

        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            var ctx2= document.getElementById('chart-area2').getContext('2d');
            var ctx3= document.getElementById('chart-area3').getContext('2d');
            var ctx4= document.getElementById('chart-area4').getContext('2d');
            var ctx5= document.getElementById('chart-area5').getContext('2d');
            var ctx6= document.getElementById('chart-area6').getContext('2d');
            var ctx7= document.getElementById('chart-area7').getContext('2d');
            window.myDoughnut = new Chart(ctx, config);
            window.myDoughnut = new Chart(ctx2, config2);
            window.myDoughnut = new Chart(ctx3, config3);
             window.myDoughnut = new Chart(ctx4, config4);
             window.myDoughnut = new Chart(ctx5, config5);
             window.myDoughnut = new Chart(ctx6, config6);
             window.myDoughnut = new Chart(ctx7, config7);
        };
    </script>
<script>
    function openPop() {
        $("#myPop").css('width', '100%');
    }

    $(".closebtn").click(function () {
        $("#myPop").css("width", "0");
    })

    $('#openDoc').on('click', function () {
        $('#doc').slideToggle('slow');
    });

    $('#openEnd').on('click', function () {
        $('#end').slideToggle('slow');
    });

    $('#openObs').on('click', function () {
        $('#obs').slideToggle('slow');
    });

     $('#tte').on('click', function () {
        $('#divTran').slideToggle('slow');
    });
</script>
<?= $v->section("scripts"); ?>
</body>
</html>