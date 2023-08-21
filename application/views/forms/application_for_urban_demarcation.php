<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'false', 'setAutoBottomMargin' => 'false']);

$mpdf->SetHTMLHeader('


    
');

$mpdf->WriteHTML('

<style>
    table, td, th {
        border: 1px solid black;
        border-collapse: collapse;
    }
    td {
        vertical-align: baseline;
    }

</style>

<div style="width: 90%; text-align: justify; margin: 0 auto;">
    <h3>REQUERIMENTO PARA AVERBAÇÃO DO AUTO DE DEMARCAÇÃO URBANÍSTICA</h3>

    <p>O PREFEITO MUNICIPAL DE MONTEZUMA, (NOME E QUALIFICAÇÃO) no uso das atribuições que lhe confere as Leis Federal 13.465/17 e Municipal nº 067 de 31 de dezembro de 2019, vem requerer a abertura de matrícula para a demarcação urbanística descrita nos documentos anexos,  para fins de demarcar o imóvel de domínios privados, definindo seus limites, área, localização e confrontantes, com a finalidade de identificar seus ocupantes e qualificar a natureza e o tempo das respectivas posses, bem como a averbação da demarcação nas matrículas atingidas e elencadas abaixo.</p>
    <p>&emsp;&emsp;Ciente de que a demarcação urbanística não implica a alteração de domínio dos bens imóveis sobre os quais incidirem.</p>

    <p>&emsp;&emsp;Foram devidamente notificados os proprietários de direitos reais matriculados atingidos pelo perímetro da gleba regularizada, os confrontantes e o Estado, da seguinte forma:</p>

    <table style="width:100%">
        <tr>
            <th>Nome</th>
            <th>Qualidade</th>
            <th>Anuência expressa</th>
            <th>Notificado e não manifestou em 30 dias</th>
            <th>Impugnação com resolução amigável</th>
        </tr>
        <tr>
            <th>Espólio de Herminio de Sá</th>
            <td>Proprietário da
            matrícula 1451 do C.R.I de Rio Pardo de Minas-MG, atingida pela demarcação
            </td>
            <td>&emsp;</td>
            <th>Sim</th>
            <td>&emsp;</td>
        </tr>
        <tr>
            <th>Espólio de Jerônimo Ferreira dos Santos</th>
            <td>Proprietário da
            matrícula 1451 do C.R.I de Rio Pardo de Minas-MG, atingida pela demarcação
            </td>
            <td>&emsp;</td>
            <th>Sim</th>
            <td>&emsp;</td>
        </tr>
        <tr>
            <th>Espólio de Moises David de Souza</th>
            <td>Proprietário da
            matrícula 2539 do C.R.I de Rio Pardo de Minas-MG, atingida pela demarcação
            </td>
            <td>&emsp;</td>
            <th>Sim</th>
            <td>&emsp;</td>
        </tr>
        <tr>
            <th>Espólio de Moises David de Souza</th>
            <td>Proprietário da
            matrícula 2565 do C.R.I de Rio Pardo de Minas-MG, atingida pela demarcação
            </td>
            <td>&emsp;</td>
            <th>Sim</th>
            <td>&emsp;</td>
        </tr>
        <tr>
            <th>Itamar Carvalho dos Santos</th>
            <td>Confrontante
            posseiro</td>
            <td>&emsp;</td>
            <th>Sim</th>
            <td>&emsp;</td>
        </tr>
    </table>
    <p>Notificados por edital e que não apresentaram impugnação: NÃO SE APLICA</p>
    
    <table style="width:100%">
        <tr>
            <th>Nome</th>
            <th>Qualidade</th>
            <th>Não Identificado</th>
            <th>Não Encontrado</th>
            <th>Recusou a receber a notificação via postal</th>
        </tr>
        <tr>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
        </tr>
        <tr>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
        </tr>
        <tr>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
        </tr>
    </table>

    <p>Para tanto, esclarece que foi cumprido o rito legal previsto para a Demarcação Urbanística,  ficando constatada a VIABILIDADE DA REGULARIZAÇÃO FUNDIÁRIA.</p>
    <p>Esclarece, ainda, que:</p>
    <p>1. A área objeto da demarcação urbanística é:</p>
    
    <table style="width:100%">
        <tr>
            <td>(&emsp;) área de domínio privado com proprietário não identificado. (inciso I, §2§, art. 19 Lei 13.465/17) </td>
            <td>Nesse caso anexar ao requerimento:
                Certidão negativa do cartório de imóveis da comarca e
                da circunscrição anterior, acompanhado do formulário de
                busca apresentado no dia de solicitação da referida
                certidão. (modelo de formulário disponível no cartório de imóveis)
            </td>
        </tr>
        <tr>
            <td>( X ) área de domínio privado objeto do devido
            registro no Ofício de Registro de Imóveis
            competente, ainda que de proprietários distintos;
            </td>
            <td>Nesse caso, apresentar certidão de inteiro teor das matrículas localizadas.</td>
        </tr>
        <tr>
            <td>(&emsp;) domínio público devidamente matriculado</td>
            <td>Nesse caso, apresentar certidão de inteiro teor da matrícula localizada.</td>
        </tr>
        <tr>
            <td>(&emsp;) domínio público e de domínio privado</td>
            <td>Apresentar certidão de inteiro teor das áreas e identificá-las no mapa e memorial apresentados.</td>
        </tr>
    </table>

    <p>2. O requerimento segue instruído com os seguintes documentos e com os seguintes requerimentos assinalados abaixo (art. 19, Lei 13.465/17):</p>
    <p> (X) planta da área a ser regularizada, nos quais constem suas medidas perimetrais, área total, confrontantes, coordenadas georreferenciadas dos vértices definidores de seus limites, números das matrículas ou transcrições atingidas, indicação dos proprietários identificados e ocorrência de situações de domínio privado com proprietários não identificados em razão de descrições imprecisas dos registros anteriores;</p>
    <p>(X) e memorial descritivo da área a ser regularizada, nos quais constem suas medidas perimetrais, área total, confrontantes, coordenadas georreferenciadas dos vértices definidores de seus limites, números das matrículas ou transcrições atingidas, indicação dos proprietários identificados e ocorrência de situações de domínio privado com proprietários não identificados em razão de descrições imprecisas dos registros anteriores;</p>
    <p>(X) planta de sobreposição do imóvel demarcado com a situação da área constante do registro de
    Imóveis;</p>
    <p>(X) cópia da notificação e do Aviso de Recebimento direcionada  ao Estado de Minas Gerais. Em caso de não haver resposta dos entes, apresentar certidão do município relatando essa ocorrência. (art. 1002, §1º, e art. 1005, CN); OU certidão municipal que ateste o cumprimento da notificação aos titulares de direitos reais matriculados, dos confrontantes e dos demais entes da federação, mencionando se houve ou não resposta no prazo OU informando
    esses dados no requerimento, conforme modelo acima;</p>
    <p>(&emsp;) Cópia da publicação do edital de notificação de eventuais titulares de domínio ou confrontantes não identificados, ou não encontrados ou que recusarem o recebimento da notificação por via postal (um na impressa oficial e outro no jornal de circulação local); OU certidão municipal que ateste o cumprimento da publicação do edital para eventuais titulares de domínio ou confrontantes não identificados, ou não encontrados ou que recusarem o recebimento da notificação por via postal; OU informando esses dados no requerimento, conforme modelo acima;</p>
    <p>(&emsp;) Informa que não realizou as notificações requisitadas em lei, oportunidade em que requer a notificação dos titulares de domínio, dos confrontantes da área demarcada, da União e do Estado, bem como a publicação de edital para eventuais titulares de domínio ou confrontantes não identificados, ou não encontrados ou que recusarem o recebimento da notificação por via postal, nos termos do §5º do art. 20 da Lei 13.465/17; <strong>NÃO SE APLICA</strong></p>
    <table style="width:100%">
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Motivo</th>
            <th>Endereço</th>
            <th>Tipo de notificação</th>
        </tr>
        <tr>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
            <td>&emsp;</td>
        </tr>
    </table>
    <p> (&emsp;) Deixo de apresentar cópias adicionais do Auto de Demarcação Urbanística; da planta, do memorial para viabilidade das notificações pelo Cartório de Imóveis ante a faculdade descrita no art. 46, §2º da Lei 13.465/17, mas os envio pelo CD em arquivo eletrônico.</p>
    <p>(&emsp;) Auto de Demarcação Urbanística referente ao Processo nº 001/2019;</p>
    <p style="padding-bottom: 520px;">(&emsp;) certidão negativa de registro anterior da área na Comarca da circunscrição anterior no caso de a demarcação urbanística seja de área não matriculada ou transcrita no CRI competente para averbar o auto de demarcação urbanística (art. 1003, §1º, CN/MG e art. 22, §4º do Decreto nº 9.310/18).</p>
    <p style="text-align: center;">Montezuma, 04 de novembro de 2020. </p>
    <p style="text-align: center; padding: 0; margin: 0;">FABIANO COSTA SOARES</p>
    <p style="text-align: center; padding: 0; margin: 0;">Prefeito Municipal</p>
</div>
');

ob_clean();
$mpdf->Output();

?>
