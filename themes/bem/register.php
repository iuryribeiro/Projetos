<?php $v->layout("_theme"); ?>

    <div class="menuA flex">
        <div class="img">
            <img src="<?= theme("assets/images/paper.svg"); ?>">
            <p>Nova Ordem</p>
        </div>
        <div class="img" onclick="openPop()">
            <img src="<?= theme("assets/images/people.svg"); ?>">
            <p>Novo Cliente</p>
        </div>
        <div class="img">
            <img src="<?= theme("assets/images/bag.svg"); ?>">
            <p>Nova Ordem</p>
        </div>
    </div>
    <div class="cadPrivate">
        <div class="flex begin w100">
            <h1>Cadastro Nota Digital</h1><br>
            <!--        <form class="flex">-->
            <!--            <input type="text" name="search" placeholder="Buscar Cliente"> <input type="submit" name="enviar" value="">-->
            <!--        </form>-->
        </div>
        <form action="<?= url("/nota"); ?>" method="post" enctype="multipart/form-data">
            <div class="ajax_response"><?= flash(); ?></div>
            <h2>Dados da Origem</h2>
            <input type="name" name="name_origem" placeholder="Nome/Name" required>
            <input type="tel" class="menor telefone" name="phone_origem" placeholder="Tel/Phone" required>
            <input type="text" class="menor" name="cep_origem" placeholder="CEP" required>
            <input type="text" name="address_origem" placeholder="Endereço/Address" required>
            <input type="text" name="state_origem" placeholder="Estado/State" required>
            <input type="text" name="city_origem" placeholder="Cidade/city" required>
            <input type="email" name="email_origem" placeholder="E-mail" required>
            <h2>Dados do Destino</h2>
            <input type="name" name="name_dest" placeholder="Nome/Name" required>
            <input type="tel" class="menor telefone" name="phone_dest" placeholder="Tel/Phone" required>
            <input type="text" class="menor" name="cep_dest" placeholder="CEP" required>
            <input type="text" name="address_dest" placeholder="Endereço/Address" required>
            <input type="text" name="state_dest" placeholder="Estado/State" required>
            <input type="text" name="city_dest" placeholder="Cidade/city" required>
            <input type="email" name="email_dest" placeholder="E-mail" required>
            <h1>Descrição</h1>
            <div class="addF">
                <div class="flex">
                    <input type="text" name="desc[]" class="maior" placeholder="Description Product" required>
                    <input type="text" class="menor j_mask" name="value[]" placeholder="Valor do Produto" required>
                    <div class="flex is">
                        <select id="selectId" name="sizeBox[]" class="select_wrap_select">
                            <option value="">Tamanho</option>
                            <option value="P">P</option>
                            <option value="M">M</option>
                            <option value="G">G</option>
                        </select>
                        <img id="addCampo" src="<?= theme("/assets/images/+.png") ?>">
                        <img class="cancel" src="<?= theme("/assets/images/cancel.png") ?>">
                    </div>
                </div>
            </div>
            <div class="flex payment">
                <h1 class="check">Pagamento</h1>
                <div class="custom-select w20" style="margin-left: -50px; margin-right:10px;">
                    <select id="selectTb" class="btn-payment " name="payMent">
                        <label></label>
                        <option> Formas de pagamento</option>
                        <option value="payBol">Boleto</option>
                        <option value="payCheck">Check</option>
                        <option value="payCred">Crédito</option>
                        <option value="payDeb">Débito</option>
                        <option value="payDin">Dinheiro</option>

                    </select>

                </div>
                <div class="w30 jtp">
                    <input id="check" class="pgm2" type="text" name="nCheck" placeholder="Nº Check">
                </div>
                <div class=" w35 flex payment2">
                    <h1 class="check">Seguro</h1>
                    <div class="custom-select" style="margin-left: -50px;">
                        <select id="selectSeg" class="btn-payment " name="payMeht">
                            <label></label>
                            <option value="segSim">Sim</option>
                            <option value="segNao">Não</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="pgm">
                <input class="pgm j_mask" type="text" name="vlrTransp" placeholder="Valor do transporte" required>
                <input class="pgm j_mask" type="text" name="txColeta" placeholder="Taxa da Coleta" required>
                <input class="pgm j_mask" type="text" name="material" placeholder="Material" required>
                <input class="pgm j_mask" type="text" name="excessodeP" placeholder="Excesso de Peso" required>
                <input id="inSeg" class="pgm j_mask" type="text" name="vlrSeguro" placeholder="Valor do Seguro"
                >
                <input id="inSeg2" class="pgm j_mask_porc" type="text" name="vlrDeclarado"
                       placeholder="5% sob o valor declarado"
                >
                <input class="pgm j_mask adp" type="text" name="subTotal" placeholder="SubTotal" required>
            </div>
            <h3>Total a pagar</h3>
            <h4 class="j_total">R$ 0,00</h4>
            <div class="flex finalForm">
                <div class="view">Visualizar Nota</div>
                <button>Gerar Nota</button>
                <input type="reset" class="clear" value="Limpar Dados">
            </div>
        </form>
    </div>

<?php $v->start("scripts"); ?>
    <script>
        $(document).ready(function () {
            $(".tt").click(function () {
                $(this).parent().toggleClass("active");
            })

            $(".tu li").click(function () {
                var currentele = $(this).html();
                $(".tt li").html(currentele);
                $(this).parents(".select_wrap").removeClass("active");
            })
        });
    </script>

    <script type="text/javascript">

        $(function () {
            $('input.checkgroup').click(function () {
                if ($(this).is(":checked")) {
                    $('input.checkgroup').attr('disabled', true);
                    $(this).removeAttr('disabled');
                } else {
                    $('input.checkgroup').removeAttr('disabled');
                }
            })
        })

    </script>

    <script>
        $("input.j_mask").blur(function () {
            calcularTotal();
        });

        $("#selectSeg").change(function () {
            calcularTotal();
        });

        function calcularTotal() {
            var vlrSeguro = $(".pgm input[name=vlrSeguro]").val().replace(/\./g, "").replace(",", ".");
            var vlrTranps = $(".pgm input[name=vlrTransp]").val().replace(/\./g, "").replace(",", ".");
            var txColeta = $(".pgm input[name=txColeta]").val().replace(/\./g, "").replace(",", ".");
            var material = $(".pgm input[name=material]").val().replace(/\./g, "").replace(",", ".");
            var excessodeP = $(".pgm input[name=excessodeP]").val().replace(/\./g, "").replace(",", ".");
            var vlrDeclarado = $(".pgm input[name=vlrDeclarado]").val().replace(/\./g, "").replace(",", ".");
            var option = $("#selectSeg").val();

            var vlrProduto = $("input[name='value[]']");

            var subTotal = $(".pgm input[name=subTotal]");
            var vlrTotal = $("h4.j_total");

            var formater = Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL"
            });

            var result = 0;
            if (vlrProduto.val() != "") {
                vlrProduto.each(function () {
                    result += parseFloat($(this).val().replace(/\./g, "").replace(",", "."));
                })
            }

            if (vlrTranps != "") {
                result += parseFloat(vlrTranps);
            }
            if (txColeta != "") {
                result += (parseFloat(txColeta));
            }

            if (material != "") {
                result += (parseFloat(material));
            }

            if (excessodeP != "") {
                result += (parseFloat(excessodeP));
            }

            subTotal.val(result.toFixed(2));

            if (option == "segSim") {
                var vlrDeclaradoPorcento = (parseFloat(vlrDeclarado) / 100);
                var resultTotal = result;

                if (vlrSeguro != "") {
                    resultTotal = (parseFloat(result) + parseFloat(vlrSeguro));
                }

                if (vlrDeclarado != "") {
                    resultTotal = ((vlrSeguro * vlrDeclaradoPorcento) + resultTotal);
                }

                vlrTotal.html(formater.format(resultTotal.toFixed(2)));
            } else {
                vlrTotal.html(formater.format(result.toFixed(2)));
            }
        }
    </script>

    <!-- Função Adicionar Campos -->
    <script language="javascript">

        var count = 1;
        $("#addCampo").click(function () {
            /* If the user clicks anywhere outside the select box,
            then close all select boxes: */
            count++;

            $(".addF").append('' +
                '<div class="flex" id="campo' + count + '">' +
                '<input type="text" name="desc[]" placeholder="Description Product" required>' +
                '<input class="menor j_mask" type="text" name="value[]" placeholder="Valor do Produto"required>' +
                '<div class="flex is">' +
                '<select name="sizeBox[]" class="select_wrap_select">' +
                '<option value="">Tamanho</option>' +
                '<option value="P">P</option>' +
                '<option value="M">M</option>' +
                '<option value="G">G</option>' +
                '</select>' +
                '<img id="addCampo2" src="<?= theme("/assets/images/+.png")?>">' +
                '<img class="cancel" id="' + count + '" src="<?= theme("/assets/images/cancel.png")?>">' +
                '</div>');

            $(".j_mask").mask("#.###.###,##", {reverse: true});

            $("input.j_mask").blur(function () {
                calcularTotal();
            });

            $(document).ready(function () {
                $(".do" + count + "").click(function () {
                    $(this).parent().toggleClass("active");
                })

                $(".select_ul li").click(function () {
                    var currentele = $(this).html();
                    $(".do" + count + " li").html(currentele);
                    $(this).parents(".select_wrap").removeClass("active");
                })
            });

        });


        $("form").on("click", ".cancel", function () {
            var button_id = $(this).attr("id");
            $('#campo' + button_id + '').remove();
        });

        $("form").on("click", "#addCampo2", function () {
            count++;
            $(".addF").append('' +
                '<div class="flex" id="campo' + count + '">' +
                '<input type="text" name="desc[]" placeholder="Description Product" required>' +
                '<input class="menor j_mask" type="text" name="value[]" placeholder="Valor do Produto"required>' +
                '<div class="flex is">' +
                '<select name="sizeBox[]" class="select_wrap_select">' +
                '<option value="">Tamanho</option>' +
                '<option value="P">P</option>' +
                '<option value="M">M</option>' +
                '<option value="G">G</option>' +
                '</select>' +
                '<img id="addCampo2" src="<?= theme("/assets/images/+.png")?>">' +
                '<img class="cancel" id="' + count + '" src="<?= theme("/assets/images/cancel.png")?>">' +
                '</div>');

            $(".j_mask").mask("#.###.###,##", {reverse: true});
            $("input.j_mask").blur(function () {
                calcularTotal();
            });

            $(document).ready(function () {
                $(".do" + count + "").click(function () {
                    $(this).parent().toggleClass("active");
                })

                $(".select_ul li").click(function () {
                    var currentele = $(this).html();
                    $(".do" + count + " li").html(currentele);
                    $(this).parents(".select_wrap").removeClass("active");
                })
            });

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {


            $("#selectTb").on('change', function () {
                var selectValor = $(this).val();

                if (selectValor == 'payCheck') {
                    $('#check').show();
                } else {
                    $('#check').hide();
                }

            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {

            $("#selectSeg").on('change', function () {
                var selectValor2 = $(this).val();
                if (selectValor2 == 'segSim') {
                    $('#inSeg').show(),
                        $('#inSeg2').show();
                } else {
                    $('#inSeg').hide(),
                        $('#inSeg2').hide();
                }

            });
        });
    </script>


    <script type="text/javascript">
        jQuery("input.telefone")
            .focusout(function (event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length >= 11) {
                    element.mask("(99) 99999-9999");
                } else if (phone.length = 10) {
                    element.mask("(99) 9999-9999");
                } else {
                    element.mask("(999) 999-9999");
                }
            });
    </script>
<?php $v->end("scripts"); ?>