<?php

use Dompdf\Dompdf;

$dompdf = new Dompdf ();

$safe = floatval($order->value_safe);
$percentage = floatval($order->percentage);

$calc = ($safe * ($percentage / 100));
$calc = number_format($calc, 2, ",", ".");
$total = number_format($totalItem->total, 2, ",", ".");

$subtotal = $safe + floatval($order->subtotal);
$subtotal = number_format($subtotal, 2, ",", ".");

//FORMA DE PAGAMENTO
if ($order->payment == "payCred") {
    $pgto = "Crédito";
} else if ($order->payment == "payDeb") {
    $pgto = "Débito";
} else if ($order->payment == "payCheck") {
    $pgto = "Cheque";
} else if ($order->payment == "payDin") {
    $pgto = "Dinheiro";
} else {
    $pgto = "Boleto";
}
$porcentagem = $order->percentage;

//PDF
$html = "
<html>
<head>
	<link href='https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap' rel='stylesheet'>
	<link rel='stylesheet' type='text/css' href='" . __DIR__ . "/assets/css/style.css'>
	<style>
	input{
	    font-size: 12px;
	}
	
	@page{
	    margin: -20px;
	}
	
</style>
</head>
<body>
<div class='pdf w100'>
<table width='100%'>
        <tbody>
            <tr>
            	<td style='text-align: center;' width='34%'>
                    <img src='" . __DIR__ . "/assets/images/logo.png' style='width:120px;'>
                </td>
                <td width='33%'>
                    <h1 style='font-size:12px; font-weight: bold;       margin-top:26px; line-height: 1.31;text-align: center;color: gray;'>1419 Banks Road - Margate- Florida - 33063</h1>
					<h1 style='font-size: 12px; font-weight: bold; line-height: 1.31;text-align: center;color: gray;' >954-270-2191</h1>
					<p style='font-size: 12px;
				  font-weight: 500;
				  margin-top: 8px;
				  text-align: center;
				  color: #707070;'>Para rastreamento: www.brancacape.com</p>
				<p style='text-align:center;
				font-size:12x;
				margin-top:8px;
				color:#707070;'><img style='margin-right:6px;' src='" . __DIR__ . "/assets/images/instablack.png'><img style='margin-right:6px;' src='" . __DIR__ . "/assets/images/faceblack.png'>brancasencomendasfl</p></td>
                
                <td style='text-align: center;' width='33%'>
                    <p style='font-size: 12px;
				  font-weight: 900;
				  margin-top:20px;
				  color: #707070;'>Ordem do pedido</p>
					<div class='btn' style='margin: auto;
				margin-top: 20px;
				 width: 120px;
				  height: 24px;
				  border-radius: 16px;
				  background-color: #009b3a;
				  padding:8px;
				 '><p style='font-size: 15px;
				  font-weight: 500;
				  color: white;'>000" . $order->id . "</p></div>
						<h2 style='font-size: 15px;
				  font-weight: 700;
				  line-height: 1.3;
				  margin-top: 14px;
				  color: #707070;'>Data da Ordem</h2>
						<h3 style='font-size: 15px;
				  font-weight: 500;
				  font-stretch: normal;
				  font-style: italic;
				  color: #707070;'>" . date_fmt($order->created_at, 'd/m/Y') . "</h3>
                </td>
            </tr>
        </tbody>
    </table>
    <div class='hr'></div>
    	<form>
    	<table width='90%'  style='border:1px solid rgba(112,112,112,0.28); height:200px;  margin:auto; margin-top:22.7px;'>
        <tbody >
            <tr>
                <td width='10%'>
                <div class='ret1' style='width: 43px;
					  height: 200px;
					  
					  background-color: #00cc4c;
					  position:absolute'>
				<p style='
					  letter-spacing:10px;
					  color: #ffffff;
					  text-align: center;
					  transform: rotate(-90deg);
					  margin-top:80px;
					  '>ORIGEM</p>


				</div>
                </td>
                <td width='90%'>

                 <table width='100%'>
        <tbody>
            <tr>
                <td width='50%'>
                <table width='100%'>
        <tbody>
            <tr>
                <td width='40%' style='padding-top:30px;'>
                
                <p style='font-size: 12px;
                margin-top:-50px;
                margin-left:-70px;

  				line-height: 2.5;
 			    text-align: left;
  				color: #707070;'>Nome/Name</p>
                <p style='font-size:12px; margin-left:-70px; color:#707070;'>Endereço/Adress</p>
                <p style='font-size: 12px;
                
                margin-left:-70px;

  				line-height: 2.5;
 			    text-align: left;
  				color: #707070;'>Cidade/City</p>
                <p style='font-size: 12px;
                
                margin-left:-70px;

  				line-height: 2.5;
 			    text-align: left;
  				color: #707070;'>E-mail</p>
                </td>
                <td  width='50%' style='padding-top:50px;'>
                 <input style='border:none;

						width: 100%;
						height: 20px;
						margin-top: -40px;
                        margin-bottom:-20px;
						outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						margin-left: -80px;
						background:none;'type='text' name='nome' value='" . $order->client_origem . "'>
                 <input style='border:none;
						width: 100%;
						height: 20px;
						margin-top:-5px;
                        margin-bottom:-15px;
						outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						margin-left: -80px;
                        padding-left:-145px;
						background:none;' type='text' name='endereco' value='" . $order->street_origem . "'>
                 <input style='border:none;
						width: 100%;
						height: 20px;
						margin-top:30px;
                        margin-bottom:-28px;
                        padding-left:-145px;
						outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						margin-left: -80px;

						background:none;' type='text' name='Cidade' value='" . $order->city_origem . "'>
                 <input style=' border:none;
						width: 100%;
						height: 20px;
						margin-top: 60px;
                        
                        text-align:left;
                        padding-left:-145px;
						outline: none;
						border-top:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						margin-left: -80px;
                        background:none;'type='text' name='email' value='" . $order->email_origem . "'>
						
                </td>
            </tr>
        </tbody>
    </table>
                 </td>
               
                <td width='60%'>
                   <table width='100%'>
        <tbody>
            <tr>
                <td width='20%' style='padding-top:50px;'>
                <div style='margin-top:-80px; padding-left:20px;'>
                <p style='font-size:12px; color:#707070; margin-bottom:20px;'>Estado/State</p>
                <p style='font-size:12px; margin-bottom:20px; color:#707070;'>CEP</p>
                <p style='font-size:12px; color:#707070;'>Tel/Phone</p>
                </div>
                </td>
                
                <td width='40%' style='padding-top:50px; padding-right:20px;'>
                   <input style='border:none;

						width: 100%;
						height: 20px;
						margin-top: -85px;
                        margin-bottom:30px;
						outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						
						background:none;'type='text' name='estado' value='" . $order->uf_origem . "'>
						<input style='border:none;
                        padding-left:-190px;
						width: 100%;
						height: 20px;
						margin-top: -50px;
                        margin-bottom:30px;
						outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
				
						background:none;'type='text' name='cep' value='" . $order->code_origem . "'> 
				
						<input style='border:none;

						width: 100%;
						height: 20px;
						margin-top:-15px;
						padding-left:-190px;
						outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						background:none;' type='text' name='tel' value='" . $order->tel_origem . "'>
						 
                </td>
            </tr>
        </tbody>
    </table>
                </td>
            </tr>
        </tbody>
    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table width='90%'  style='border:1px solid rgba(112,112,112,0.28); height:200px;  margin:auto; '>
        <tbody >
            <tr>
                <td width='10%'>
                <div class='ret1' style='width: 43px;
					  height: 200px;
					  
					  background-color: #009b3a;
					  position:absolute'>
				<p style='
					  letter-spacing:10px;
					  color: #ffffff;
					  text-align: center;
					  transform: rotate(-90deg);
					  margin-top:80px;
					  '>DESTINO</p>


				</div>
                </td>
                <td width='90%'>

                 <table width='100%'>
        <tbody>
            <tr>
                <td width='40%'>
                <table width='100%'>
        <tbody>
            <tr>
                <td width='40%' style='padding-top:30px;'>
                
                <p style='font-size: 12px;
                margin-top:-50px;
                margin-left:-90px;

  				line-height: 2.5;
 			    text-align: left;
  				color: #707070;'>Nome/Name</p>
                <p style='font-size:12px; margin-left:-90px; color:#707070;'>Endereço/Adress</p>
                <p style='font-size: 12px;
                
                margin-left:-90px;

  				line-height: 2.5;
 			    text-align: left;
  				color: #707070;'>Cidade/City</p>
                <p style='font-size: 12px;
                
                margin-left:-90px;

  				line-height: 2.5;
 			    text-align: left;
  				color: #707070;'>E-mail</p>
                </td>
                <td  width='50%' style='padding-top:50px;'>
                 <input style='border:none;

						width: 100%;
                        height: 20px;
                        margin-top: -40px;
                        margin-bottom:-20px;
                        outline: none;
                        border-bottom:solid 1px rgba(112, 112, 112,0.28);
                        color: rgb(112,112,112);
                        margin-left: -80px;
						background:none;'type='text' name='nome' value='" . $order->client_dest . "'>
                 <input style='border:none;
						width: 100%;
                        height: 20px;
                        margin-top:-5px;
                        margin-bottom:-15px;
                        outline: none;
                        border-bottom:solid 1px rgba(112, 112, 112,0.28);
                        color: rgb(112,112,112);
                        margin-left: -80px;
                        padding-left:-138px;
						background:none;' type='text' name='endereco' value='" . $order->street_dest . "'>
                 <input style='border:none;
						width: 100%;
                        height: 20px;
                        margin-top:30px;
                        margin-bottom:-28px;
                        padding-left:-138px;
                        outline: none;
                        border-bottom:solid 1px rgba(112, 112, 112,0.28);
                        color: rgb(112,112,112);
                        margin-left: -80px;
						background:none;' type='text' name='Cidade' value='" . $order->city_dest . "'>
                 <input style='border:none;
						width: 100%;
                        height: 20px;
                        margin-top: 60px;
                        
                        text-align:left;
                        padding-left:-138px;
                        outline: none;
                        border-top:solid 1px rgba(112, 112, 112,0.28);
                        color: rgb(112,112,112);
                        margin-left: -80px;
                        background:none;'type='text' name='email' value='" . $order->email_dest . "'> 
						
                </td>
            </tr>
        </tbody>
    </table>
                 </td>
               
                <td width='50%'>
                   <table width='100%'>
        <tbody>
            <tr>
                <td width='20%' style='padding-top:50px;'>
                <div style='margin-top:-80px; padding-left:20px;'>
                <p style='font-size:12px; color:#707070; margin-bottom:20px;'>Estado/State</p>
                <p style='font-size:12px; margin-bottom:20px; color:#707070;'>CEP</p>
                <p style='font-size:12px; color:#707070;'>Tel/Phone</p>
                </div>
                </td>
                
                <td width='40%' style='padding-top:50px;'>
                   <input style='border:none;

						width: 100%;
                        height: 20px;
                        margin-top: -85px;
                    
                        margin-bottom:30px;
                        outline: none;
                        border-bottom:solid 1px rgba(112, 112, 112,0.28);
                        color: rgb(112,112,112);						
						background:none;'type='text' name='estado' value='" . $order->uf_dest . "'>
						<input style='border:none;
                        padding-left:-205px;
                        width: 100%;
                        height: 20px;
                        margin-top: -50px;
                        margin-bottom:30px;
                        outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						
						background:none;'type='text' name='CEP' value='" . $order->code_dest . "'> 
						<input style='border:none;

						width: 100%;
                        height: 20px;
                        margin-top:-15px;
                        padding-left:-205px;
                        outline: none;
						border-bottom:solid 1px rgba(112, 112, 112,0.28);
						color: rgb(112,112,112);
						background:none;' type='text' name='tel' value='" . $order->tel_dest . "'>
						
                </td>
            </tr>
        </tbody>
    </table>
                </td>
            </tr>
        </tbody>
    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table width='90%' style=' background-color:#009b3a; height:21.3px; margin:auto; margin-top:11.7px;'>
        <tbody>
            <tr>
                <td width='33%'>
                <p style='font-size:12px; color:white; margin-left:12.7px;'>Tam.</p>
                     </td>
                <td  width='34%'>                  
                <p style='font-size:12px; color:white;'>Descrição (Description)</p>
                </td>
                <td width='33%'>
                  <p style='font-size:12px; color:white;'>Valor de Envio / Shipping amount</p>
                </td>
            </tr>
        </tbody>
    </table>";

$totalProduto = 0;
foreach ($orderItem as $item) {
    $html .= "
    <table width='90%' style=' background-color:rgba(112,112,112,0.015); height: 27px; margin:auto; margin-top:5px;'>
        <tbody>
            <tr>
                <td width='33%'>
                <p style='font-size:11px; color:#707070; margin-left:12.7px;'>{$item->box_size}</p>
                     </td>
                <td  width='34%'>                  
                <p style='font-size:11px;  color:#707070;'>{$item->description}</p>
                </td>
                <td width='33%'>
                  <p style='font-size:11px; text-align:right;
                  padding-right:15px; color:#707070;'>" . number_format($item->value, 2, ",", ".") . "</p>
                </td>
            </tr>
        </tbody>
    </table>";
    $totalProduto += $item->value;
}

$html .= "
        <table width='90%' style=' background-color:#009b3a; height:21.3px; margin:auto; margin-top:11.7px;'>
        <tbody>
            <tr>
                <td width='20%'>
                    <table width='100%'>
        			<tbody>
            		<tr>
                	<td width='22%'>
                	<p style='font-size:12px; color:white; margin-left:12.7px;'>Pagamento</p>
                    </td>
                	<td  width='40%'>                  
                	<input style='height: 20px; background-color:white; border:none; width:56px; text-align:center;'type='text' name='pagCheck' value='$pgto'>
                	</td>
            		</tr>
        		</tbody>
    			</table>

                     </td>
                <td  width='20%'>                  
                <table width='100%'>
        			<tbody>
            		<tr>
                        <td width='40%'>
                            <p style='font-size:12px; color:white;'>Check#</p>
                        </td>
                        <td  width='60%'>                  
                            <input style='height: 20px; background-color:white; border:none; width:56px; text-align:center; ' type='text' name='cash' value='" . $order->number_check . "'>
                        </td>
            		</tr>
        		</tbody>
    			</table>
                </td>

                 <td  width='20%'>                  
                <table width='100%'>
                    <tbody>
                    <tr>
                        <td width='40%'>
                            <p style='font-size:12px; color:white;'>Cash #</p>
                        </td>
                        <td  width='60%'>                  
                            <input style='height: 20px; background-color:white; border:none; width:56px; text-align:center; ' type='text' name='cash'>
                        </td>
                    </tr>
                </tbody>
                </table>
                </td>
                <td width='20%'>
                  <table width='100%'>
                    <tbody>
                    <tr>
                    <td width='20%'>
                    <p style='font-size:12px; color:white;'>Secury</p>
                    </td>
                    <td  width='40%'>                  
                    <input style='height: 20px; background-color:white; border:none; width:78px; text-align:center; margin-left:0px;' type='text' name='total' value='" . number_format($order->value_safe, 2, ',', '.') . "'>
                    </td>
                    </tr>
                </tbody>
                </table>
                </td>
                <td width='20%'>
                  <table width='100%'>
        			<tbody>
            		<tr>
                	<td width='20%'>
                	<p style='font-size:12px; color:white;'>Total</p>
                    </td>
                	<td  width='40%'>                  
                	<input style='height: 20px; background-color:white; border:none; width:78px; text-align:center; margin-left:0px;' type='text' name='total' value='" . number_format($totalProduto, 2, ',', '.') . "'>
                	</td>
            		</tr>
        		</tbody>
    			</table>
                </td>

            </tr>
        </tbody>
    </table>
     <table width='90%' style='margin:auto; padding-top:18px;'>
        			<tbody>
            		<tr>
                	<td width='50%' style='background-color:rgba(112,112,112,0.5); padding:11.7px 6.4px 11.7px 18.1px;'>
                	<p style='font-size:8px; color:white;'>Declaro optar pela não aquisição de seguro sobre valor declarado dos itens relacionados nesta Ordem de Frete. Ao optar pela não aquisição deste serviço estou ciente de limite de reembolso máximo de $100,00 (cem dólares) por volume em caso de extravio e/ou violação. Ao optar pela não aquisição de seguro isenta a BEM de qualquer responsabilidade/penalidade adicional. I hereby further declare that I have refused and declined to purchase the insurance coverage offered by BEM over the declared value of items listed on this Order of Freight, being aware that I am subject to the maximum reimbursement of $100.00 (one hundred dollars) per volume in case of loss or other responsability or additional penalties.</p>
                		<div style='border: 0.1px solid white; width:80%; margin:auto; margin-top:25px;'></div>
                		<p style='font-size:8px; color:white; text-align:center;'>Assinatura do Remetente / Customer Signature </p>
                    </td>
                	<td  width='50%'style='background-color:rgba(112,112,112, 0.07);'>                  
                	<table width='100%' style='padding-top:10px;'>
        			<tbody>
            		<tr>
                	<td width='40%' >
                	<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:-20px;'>Valor do transporte:</p>
                	<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:5px '>Taxa de Coleta:</p>
                	<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:5px;'>Material:</p>
                	<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:5px;'>Excesso de Peso:</p>
                	<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:5px;''>Sub Total:</p>
                	<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:5px;''>$porcentagem% sobre valor declarado:</p>
                		<p style='font-size:10px; color:#707070; margin-left:10px; margin-top:5px;''>Total a Pagar:</p>        

                    </td>
                	<td  width='60%' style='padding-top:8px;'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-top:-80px;
                        margin-left:80px; text-align:center; ' type='text' name='vlrTransp' value='" . number_format($order->value_transp, 2, ",", ".") . "'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-left:-109px; margin-top:-60px;text-align:center;' type='text' name='txColeta' value='" . number_format($order->collection, 2, ",", ".") . "'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-top:-40px; margin-left:-109px; text-align:center;' type='text' name='material' value='" . number_format($order->material, 2, ",", ".") . "'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-left:-109px; margin-top:-20px; text-align:center;' type='text' name='exPeso' value='" . number_format($order->excess_weight, 2, ",", ".") . "'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-left:-109px; margin-top:0px; text-align:center;' type='text' name='subTotal' value='$subtotal'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-left:-109px; margin-top:20px; text-align:center;' type='text' name='declarado' value='$calc'>
                	<input style='height: 18px; background-color:white; border:none; width:50%; margin-left:-109px; margin-top:40px; text-align:center; ' type='text' name='total' value='" . number_format($order->total, 2, ",", ".") . "'>
                	</td>
            		</tr>
        		</tbody>
    			</table>
                	</td>
            		</tr>
        		</tbody>
    			</table>
    </form>
</body>
</html>
";

$dompdf->loadHtml($html);
$dompdf->setPaper("A4");
$dompdf->render();
$dompdf->stream("file.pdf", ["Attachment" => false]);
?>
