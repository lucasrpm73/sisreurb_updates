<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'false', 'setAutoBottomMargin' => 'false']);

$mpdf->SetHTMLHeader('

');

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');


$mpdf->WriteHTML('
<style>
    .red{
        color: red;
    }
</style>
<div style="margin: 0 auto; width: 99%;">
	<div style="text-align: justify; font-size: 14px;">
		<div style="text-align: center;">
		</div>
        <p style="margin-bottom: 10px;">Procedimento nº '.$procedure_reurb->process_number.' – Regularização Fundiária Urbana de Interesse Social
        <br>ETAPA '.$procedure_reurb->stage.' – '.$procedure_reurb->core_name.' – '.$city_hall->city.' - '.$city_hall->uf.'</p>

        <p style="margin-bottom: 10px;">Ao<br>
        '.$notary_office->name_registry.'
        Oficial '.$notary_office->registration_officer.'</p>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;O Prefeito Municipal de '.$city_hall->city.', '.$city_hall->name.', '.$city_hall->nacionality.', maior, médico, '.$city_hall->civil_status.', inscrito no CPF/MF sob o nº '.$city_hall->cpf.', portador da C.I/RG nº '.$city_hall->rg.', '.$city_hall->dispatcher.', residente e domiciliado à '.$city_hall->type_street_mayor.' '.$city_hall->street_mayor.', nº '.$city_hall->number_mayor.', Bairro '.$city_hall->neighborhood_mayor.', '.$city_hall->city_mayor.'-'.$city_hall->uf_mayor.',  no uso das atribuições que lhe confere a Lei Municipal nº 067 de 31 de dezembro de 2019, vem requerer o registro da Certidão de Regularização Fundiária e dos títulos finais outorgados, na forma do artigo 14, §1º, art. 17 e art. 42 da Lei Federal 13.465/17 e art. 40 do Decreto nº 9.310/18).
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;O presente requerimento segue acompanhado do projeto de regularização fundiária aprovado, dispensado o termo de compromisso, uma vez que o núcleo já possui implantado todo o conjunto de infraestrutura básica e equipamentos públicos mínimos essenciais, definidos no § 1º do art. 31 do Decreto Federal 9.310/18, a listagem dos ocupantes do núcleo ora regularizado e a indicação numérica das unidades regularizadas, ficando a outorga da Titulação para momento posterior, conforme art. 10 §5º do Decreto 9.310/18.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;O Município optou pela averbação da Demarcação Urbanística que resultou na abertura da matrícula matriz nº 15454, Livro 2-RG, de 01 de Dezembro de 2020, desta Serventia.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Nesta oportunidade requer-se:</p>

        <ul>
            <li>1. A emissão de nota devolutiva ou a prática de atos tendentes ao registro no prazo de 15 (quinze) dias, concluindo-se o procedimento registral em sessenta dias, prorrogável por até igual período, mediante justificativa fundamentada do oficial do cartório de registro de imóveis. (art. 44, §5º do Lei 13.465/17);</li>
            <li>2. O registro da Certidão de Regularização Fundiária, abrindo-se matrícula autônoma para cada unidade imobiliária decorrente do registro do parcelamento e para as áreas públicas (II, §1º do art. 44, Lei 13.465/17);</li>
            <li>3. A especialização das áreas registradas em comum, independentemente de lavratura de escritura pública, na forma do art. 45 da Lei 13.465/17 (se for o caso);</li>
            <li>4. A isenção do pagamento de emolumentos, nos termos do art. 13, §1º da Lei 13.465/17.</li>
        </ul>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Anexos:</p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;(&emsp;&emsp;) planta, memorial e Anotação de Responsabilidade Técnica do parcelamento de solo com os respectivos lotes/áreas públicas.;</p>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;(&emsp;&emsp;) C.R.F – Certidão de Regularização Fundiária</p>

        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Publique-se, nos termos do art. 21, V do Decreto nº 9.310 e art. 28, V da Lei nº 13.465/18.
        </p>
        <p style="margin-bottom: 10px;">&emsp;&emsp;&emsp;&emsp;Diante do exposto, declaro concluído a ETAPA '.$procedure_reurb->stage.', do procedimento de regularização fundiária de Interesse Social,  nos termos do art. 40 da Lei Federal nº 13.465/17 e art. 37 do Decreto nº 9.310/18.</p>

		<p style="margin-bottom: 70px">&emsp;&emsp;&emsp;&emsp;'.$city_hall->city.'-'.$city_hall->uf.', '.$data_atual.'</p>

		<p style="text-align: center; font-weight: bold;">'.$city_hall->name.'
        <br>
		Prefeito Municipal de '.$city_hall->city.'</p>
	</div>
</div>
');

ob_clean();
$mpdf->Output();
