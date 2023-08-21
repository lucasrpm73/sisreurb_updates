<?php

require_once 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');
$dia_atual = date('d-m-Y H:i:s');

$mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch', 'setAutoBottomMargin' => 'stretch']);

$mpdf->SetHTMLHeader('
    <div style="float: left; width: 12%;">
        <img src="'.base_url().'assets/build/img/logos/logo_cidade.jpeg"/>
    </div>
    <div style="float: right; width: 88%; text-align: center; font-size: 12px; font-weight: bold;">
        <span>MUNICIPIO DE MONTEZUMA</span><br>
        <span>ESTADO DE MINAS GERAIS - CNPJ 25.223.983/0001-56</span><br>
        <span>Praça José Batista, 1000 - Centro - Montezuma - MG, CEP: 39.547-000</span><br><br>
        <span>REGULARIZAÇÃO FUNDIÁRIA URBANA - REURB -ETAPA 1</span><br>
    </div>
');


$mpdf->WriteHTML('
<table style="width:100%; border: 1px solid white; border-collapse: collapse;">
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr>
        <th style="border: 1px solid white; border-top: 1px solid black; font-size:small; padding: 10px 0;" colspan="12">
            <h4 style="font-weight: bold;">FICHA DE CADASTRO DE OCUPANTE</h4>
        </th>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse; background-color: #E5E4E2;">
       <td style="font-size:small" colspan="6">
            <h4>Dados Pessoais - Identidade do ocupante:</h4>
       </td>
    </tr>
    <tr style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;">
        <td style="border-left: 1px solid black; border-right: 1px solid black; font-size:small" colspan="6">
            <p><b>Gilberto Ferreira Dos Santos,</b> Brasileira, Casado, Autônomo, inscrito(a) no CPF sob o nº 245.983.708-90
            C.I/R.G n° MG-21.608.735, Orgão Exp. PC-MG, filho(a) de Ana Ferreira Dos Santos e Jesuino Ferreira Dos Santos, tendo como cônjuge <b>Leonice Ferreira Rodrigues Dos Santos,</b> Brasileira, Do Lar, inscrito(a) no CPF sob o n° 343.486.848-80 e C.V/RG nº MG-18.171.727, Órgão Exp. PC-MG, residente(s) e domiciliado(s)
            na Rua Miguel Cordeiro, n° 10, Bairro Centro, Montezuma-MGG</p>
        </td>
    <tr>
    <tr style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse; background-color: #E5E4E2;">
        <td style="font-size:small" colspan="6">
            <h4>Dados do Imóvel - Unidade Imobiliária</h4>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
       <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"         colspan="6">
            <p>Endereço: Rua Joao Junior De Sá n° 33 Bairro: Centro - Montezuma - MG</p>
       </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"         colspan="6">
            <p>Setor. 01 - Quadra: 04 - Lote: 06 - Sub-Lote:</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"        colspan="6">
            <p>Inscrição imobiliária: 110040006001</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"        colspan="6">
            <p>Uso do Imóvel: ( ) Residencial/Moradia ( ) Comercial ( ) Misto - (Residencial/Comercial) ( ) Institucional - (Igrejas, Creches, Associações, etc)</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"colspan="6">
            <p>Area do lote requerida: <span style="text-decoration: underline; display: inline;">185,31 m¹</span></p>
        </td>
    </tr>
    <tr style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse; background-color: #E5E4E2;">
        <td style="font-size:small" colspan="6">
            <h4>Origem Dominial da Unidade</h4>
        </td>
    </tr>‎‎‎‎‎‎‏‏‎ ‎
    <tr style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small" colspan="6">
            <p>Auto de Demarcação Urbanistica, com as seguintes Matrículas afetadas:405, 1451, Cartório de Registro de Imóveis da Comarca de Rio Pardo de Minas - MG</p>
        </td>
    </tr>
    <tr style="border-left: 1px solid black; border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse; background-color: #E5E4E2;">
        <td style="font-size:small" colspan="6">
            <h4>Declarações adicionais sobre a posse</h4>
        </td>
    </tr>‎‎‎‎‎‎‏‏‎  <tr style="border-right: 1px solid black; border-collapse: collapse;">
       <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"         colspan="6">
            <p>O ocupante acima adquiriu a unidade imobiliária por:</p>
       </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"    colspan="6">
            <p>( ) compra e venda particular/recibo</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"    colspan="6">
            <p>( ) doação particular/recibo</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;"    colspan="6">
            <p>( ) herança de inventário pendente de abertura</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>( ) herança de inventário concluído e não registrado</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>( ) escritura pública de cessão de direitos hereditários</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>( ) outros, especificar: ________________________________.</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>Tempo de ocupação do imóvel: ________.</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>⠀⠀⠀⠀⠀⠀Em caso de se tratar de Reurb-S sobre imóvel público ou privado com titulação final em legitimação fundiária ou legitimação de posse, declaro:</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>⠀⠀⠀⠀⠀⠀I - não sou beneficiário concessionário, foreiro ou proprietário de imóvel urbano ou rural;</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>⠀⠀⠀⠀⠀⠀II -Não fui beneficiário contemplado com por legitimação de posse ou fundiária de imóvel urbano

            com a mesma finalidade, ainda que situado em núcleo urbano distinto;</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse;" colspan="6">
            <p>⠀⠀⠀⠀⠀⠀III - quanto a imóvel urbano com finalidade não residencial, foi reconhecido pelo Poder Público o interesse público de minha ocupação;</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid black; border-collapse: collapse;">
        <td style="font-size:small; border-right: 1px solid black; border-left: 1px solid black; border-collapse: collapse; border-bottom: 1px solid black;" colspan="6">
            <p>⠀⠀⠀⠀⠀⠀Declaro-me ciente que a partir da disponibilidade de equipamentos e infraestrutura para prestação de serviço público, estou obrigado(a) a realizar a conexão da edificação que ocupo à rede de água, de coleta de esgoto ou de distribuição de energia elétrica e adotar as demais providências necessárias à utilização do serviço, exceto se houver disposição em contrário na legislação
            municipal, conforme art. 5°,§10 do Decreto Federal 9.310/18</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>Venho requerer a regularização da área de acordo com a Legislação Municipal e Federal vigente.</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>Montezuma-MG, em 30 de junho de 2020.</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>________________________________________________</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <h3>Olíria Araújo</h3>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <h3>Requirente/Ocupante</h3>
        </td>
    </tr>
</table>
');

ob_clean();
$mpdf->Output();
?>