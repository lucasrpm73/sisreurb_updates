<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'false', 'setAutoBottomMargin' => 'false']);

$mpdf->SetHTMLHeader('
    
');

$mpdf->WriteHTML('
<div style="margin: 0 auto; padding-y: 15px; padding-top: 15px; width: 90%;">
	<div style="text-align: justify;">
		<div style="text-align: center;">
				<h4>AUTO DE DEMARCAÇÃO URBANÍSTICA</h4>
		</div>
		<p style="font-size: 17px; margin-bottom: 24px;">Procedimento nº (numero do processo) –  (Tipo de REURB)  - (ETAPA) 
		Matrículas  originárias: (Numero das matrículas atingidas)
		<br>
		( X ) Imóvel Privado  ( X  ) imóvel público
		</p>

		<p style="font-size: 17px; margin-bottom: 220px;">O PREFEITO MUNICIPAL DE (MUNICÍPIO),  no uso das atribuições que lhe confere a Lei n° .......... de ............ de ..... (Lei Orgânica do Município) e considerando o que consta do expediente administrativo nº (numero do processo administrativo) – (Tipo de regularização fundiária) -  (ETAPA I),  (Secretária ouo setor que coordena a Regularização Fundiária), FAZ SABER que o terreno urbano localizado no (nome do núcleo a ser regularizado), neste Município, com área total de (área do imóvel demarcado) m², com as seguintes características, dimensões e confrontações: (Inserir memorial descritivo georreferenciado) Com registro no Cartório de (cartório e comarca), sob as matrículas:  (matrículas e proprietários atingidos pelo auto de demarcação urbanística). FORAM DEMARCADAS pela equipe técnica da Secretaria de Administração deste Município, conforme planta e memorial descritivo que contém: a) as medidas perimetrais; b) a área total; c) os confrontantes; d) as coordenadas georreferenciadas dos vértices definidores de seus limites; e) os números das matrículas ou das transcrições atingidas; f) a indicação dos proprietários identificados; e g) a ocorrência de situações de domínio privado com proprietários não identificados em razão de descrições imprecisas dos registros anteriores, nos termos do §1º do art. 12 do Decreto nº 9.310/18);  planta de sobreposição do imóvel demarcado com a situação da área constante do registro dos imóveis, e certidões do Registro Imobiliário, que seguem anexos e integram o presente Auto de Demarcação para fins de REGULARIZAÇÃO FUNDIÁRIADE INTERESSE SOCIAL, nos termos da Lei Federal nº 13.465/17, do Decreto nº 9.310/18; da Lei Federal nº10.257/01, e da Lei Municipal n° (se houver).
		</p>


		<p style="font-size: 17px; text-align: center; margin-bottom: 50px;">(município),  em .....de..............de .......</p>

		<p style="text-align: center;">Nome do Prefeito(a)<br>
		Prefeito(a) Municipal</p>
	</div>
</div>
');

ob_clean();
$mpdf->Output();