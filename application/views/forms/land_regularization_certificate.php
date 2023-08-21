<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');
$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'false', 'setAutoBottomMargin' => 'false']);

$mpdf->SetHTMLHeader('

');
$data = date_create($procedure_reurb->decision_date);
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$mpdf->WriteHTML('
<style>
    .red{
        color: red;
    }
</style>
<div style="margin: 0 auto; padding-top: 15px; width: 98.5%;">
	<div style="text-align: justify;">
		<div style="text-align: center;">
				<h4>CERTIDÃO DE REGULARIZAÇÃO FUNDIÁRIA – C.R.F</h4>
		</div>
		<p style="font-size: 14px; margin-bottom: 24px;">Eu, '.$city_hall->name.', Prefeito Municipal de '.$city_hall->city.', Estado de '.$city_hall->uf.', em pleno exercício do mandato e na forma da lei e nos termos dos artigos 30 e 41 da Lei Federal nº 13.465/17 e art. 38 do seu Decreto regulamentar nº 9.310/18, e da Lei Municipal nº 067 de 31 de dezembro de 2019, CERTIFICO, para os devidos fins de registro imobiliário, que tramitou perante a Secretaria Municipal de Administração deste Município, o Procedimento Administrativo nº '.$procedure_reurb->process_number.', em sua ETAPA '.$procedure_reurb->stage.', que abrange Parte do núcleo urbano informal '.$procedure_reurb->core_name.', oriundo de requerimento apresentado  pelo Prefeito Municipal e que foi finalizado por decisão publicada em <span class="red">('.date_format($data, 'd/m/Y').')</span>, informando os seguintes requisitos existentes no referido procedimento:</p>

        <p style="font-size: 14px; margin-bottom: 24px;">1. '.$procedure_reurb->core_name.': ETAPA '.$procedure_reurb->stage.' – Regularização Fundiária Urbana – Parte do '.$procedure_reurb->core_name.'  – '.$city_hall->city.' - '.$city_hall->uf.';
        </p>

        <p style="font-size: 14px; margin-bottom: 24px;">2. Localização: '.$procedure_reurb->core_name.';</p>
        <p style="font-size: 14px; margin-bottom: 24px;">3. Modalidade da regularização: '.$_POST['modalidade'].';</p>
        <p style="font-size: 14px; margin-bottom: 24px;">4. Á área objeto da Regularização Fundiária, já possui implantado todo o conjunto de infraestrutura básica e equipamentos públicos essenciais definidos no § 1º do art. 31 do Decreto Federal 9.310/18, e que não existem compensações urbanísticas ou ambientais ou outras obras e serviços a serem executados, justificando a ausência de Projeto de Regularização Fundiária e do Termo de Compromisso;</p>
        <p style="font-size: 14px; margin-bottom: 24px;">5. A indicação numérica de cada unidade regularizada (em anexo);
        </p>
        <p style="font-size: 14px; margin-bottom: 24px;">6. Listagem com nomes dos ocupantes que adquiriram as respectivas unidades (em anexo); <span class="red">(ver modelo)</span>
        </p>
        <p style="font-size: 14px; margin-bottom: 24px;">7. O registro da CRF produzirá efeito de instituição e especificação de condomínio, quando for o caso, regido pelas disposições legais específicas, hipótese em que fica facultada aos condôminos a aprovação de convenção condominial, nos termos do art. 48 da Lei nº 13.465/18 e art. 46 do Decreto nº 9.310/18;</p>
        <p style="font-size: 14px; margin-bottom: 24px;">8. Por fim, os padrões dos memoriais descritivos, das plantas e das demais representações gráficas, inclusive as escalas adotadas e outros detalhes técnicos, seguiram as diretrizes estabelecidas pela autoridade municipal, as quais serão consideradas atendidas com a emissão da CRF, conforme art. 47 da Lei 13.465/17 e art. 45 do seu decreto regulamentador;</p>
        <p style="font-size: 14px; margin-bottom: 24px;">09. A presente certidão é dotada de <span class="red">XX</span> laudas e segue numerada, rubricada e grampeada <span class="red">ao projeto de regularização fundiária aprovado, ao respectivo termo de compromisso relativo a sua execução, (e no caso do registro da titulação – Legitimação Fundiária ou Legitimação de Posse - em conjunto com a CRF), a listagem dos ocupantes do núcleo urbano informal regularizado devidamente qualificados, indicando-se os direitos reais conferidos</span>, caracterizando uma única unidade documental.
        </p>





		<p style="font-size: 14px; margin-bottom: 30px; margin-left: 15px;">'.$city_hall->city.' - '.$city_hall->uf.', '.$data_atual.'</p>

		<p style="text-align: center; font-weight: bold;">'.$city_hall->name.'
        <br>
		Prefeito Municipal de '.$city_hall->city.'</p>
	</div>
</div>
');

ob_clean();
$mpdf->Output();
