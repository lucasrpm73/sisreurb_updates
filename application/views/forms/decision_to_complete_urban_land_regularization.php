<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'false', 'setAutoBottomMargin' => 'false']);

$mpdf->SetHTMLHeader('

');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

$html = '
<style>
    .red{
        color: red;
    }
</style>
<div style="margin: 0 auto; width: 99%;">
	<div style="text-align: justify; font-size: 14px;">
		<div style="text-align: center;">
				<h4>Decisão de Conclusão da Regularização Fundiária Urbana</h4>
		</div>
        <p style="margin-bottom: 10px;">Procedimento nº '.$procedure_reurb->process_number.' – Regularização Fundiária Urbana de Interesse Social
        <br>ETAPA '.$procedure_reurb->stage.' – '.$procedure_reurb->core_name.' – '.$city_hall->city.' - '.$city_hall->uf.'</p>
        <p style="margin-bottom: 10px;">Matrículas/transcrição originária: ';
foreach ($enrollments_reached as $row) {
  $html .= ' '.$row->number.', ';
}
$html .= '</p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Trata-se de Procedimento Administrativo, instruído com Auto de Demarcação Urbanística, instaurado por requerimento do Prefeito Municipal, postulando a instauração formal da Regularização Fundiária Urbana por interesse Social, em  imóveis  de titularidade privada, que foram devidamente demarcados, originando-se um novo imóvel sob a matrícula 15454, Livro 2-RG, de 01 de Dezembro de 2020, com um perímetro de 32.606,55 m² (trinta e dois mil, seiscentos e seis metros e cinqüenta e cinco decímetros quadrados),  e com o requerimento vieram documentos.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Em virtude da quantidade elevada de imóveis a serem regularizados, optou-se por subdividir o procedimento, sendo tratado aqui neste primeiro momento a parte denominada ETAPA '.$procedure_reurb->stage.', que abrange parte do '.$procedure_reurb->core_name.',  sendo identificados dentro deste perímetro um total de XX lotes urbanos.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;O procedimento não possui defeitos e nulidades, razão pela qual se passa ao pronunciamento do processamento administrativo da REURB.</p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Durante a tramitação do procedimento, verificou-se que essa parte do núcleo informal urbano é dotado de toda infraestrutura básica e equipamentos público mínimos necessários, hão havendo necessidade de nenhuma intervenção a ser realizada.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Nesta oportunidade APROVO o projeto de regularização fundiária resultante do Procedimento Administrativo de Regularização Fundiária Urbana, especificamente no que tange a parte denominada ETAPA '.$procedure_reurb->stage.' – Parte do '.$procedure_reurb->core_name.',  que está devidamente assinado e atestado o seu provimento de infraestrutura básica e equipamentos públicos mínimos necessários essenciais.</p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Quanto aos ocupantes, estes estão devidamente identificados às folhas <span class="red">-----/--------</span>, (em anexo) devidamente vinculados à sua unidade imobiliária e <span class="red">ao seu respectivo direito real</span>, aos quais concedo habite-se simplificado e único ante a ausência de risco aos ocupantes e à flexibilização exigências relativas ao percentual e às dimensões de áreas destinadas ao uso público, ao tamanho dos lotes regularizados ou a outros parâmetros urbanísticos e edilícios, na forma do art. 3º, §1º do Decreto nº 9.310/18.
        </p>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Na REURB-S, a averbação das edificações poderá ser efetivada a partir de mera notícia, a requerimento do interessado, da qual conste a área construída e o número da unidade imobiliária, dispensada a apresentação de habite-se e das certidões negativas de tributos e de contribuições previdenciárias.
        </p>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Expeça-se a Certidão de Regularização Fundiária, o título de legitimação fundiária, apresentando-os, mediante requerimento, ao cartório de registro de imóveis.
        </p>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Publique-se, nos termos do art. 21, V do Decreto nº 9.310 e art. 28, V da Lei nº 13.465/18.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Diante do exposto, declaro concluído a ETAPA '.$procedure_reurb->stage.', do procedimento de regularização fundiária de Interesse Social,  nos termos do art. 40 da Lei Federal nº 13.465/17 e art. 37 do Decreto nº 9.310/18.</p>

		<p style="margin-bottom: 30px">&emsp;&emsp;&emsp;&emsp;'.$city_hall->city.'-'.$city_hall->uf.',  '.$data_atual.'</p>

		<p style="text-align: center; font-weight: bold;">'.$city_hall->name.'
        <br>
		Prefeito Municipal de '.$city_hall->city.'</p>
	</div>
</div>
';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output();
