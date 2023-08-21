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
    <tr>
        <td style="border: 1px solid black; text-align: center; font-size:small; padding: 10px 0;" colspan="12">
            <h4 style="font-weight: bold;">CADASTRAMENTO SOCIOECONÔMICO</h4>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #f0eec7" colspan="4">
            <p>Núcleo Informal Urbano:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="8">
            <p>Bairro Centro - Parte - Etapa I do projeto de Regularização Fundiária Urbana</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #f0eec7" colspan="4">
            <p>Município:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="8">
            <p>Montezuma - MG</p>
        </td>
    </tr>

    
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>1. DADOS DO REQUERENTE/BENEFICIÁRIO(A)</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>CPF:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>245.983.708.90</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Nome:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Gilberto Ferreira dos Santos</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>RG:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>MG-21.608.735</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Órgão exp.:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>PC-MG</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Data de Nascimento:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="2">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2; text-align: center" colspan="12">
            <p>Filiação</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Mãe:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Ana Ferreira dos Santos</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Pai:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Jesuino Ferreira dos Santos</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Estado civil:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>Casado</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Regime de Casamento::</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>Comunhão Parcial de Bens</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Nacionalidade:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>Brasileira</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Profissão/Ocupação:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>Autônomo</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Local de Trabalho:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Escolaridade:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Carteira assinada:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Renda Mensal:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Telefone de Contato:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Email:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p></p>
        </td>
    </tr>


    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>1.1 DADOS DO CÔNJUGE/COMPANHEIRO(A)</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>CPF:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>343.486.848-80</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Nome:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Leonice Ferreira Rodrigues dos Santos</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>RG:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>MG-18.171.727</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Órgão exp.:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>PC-MG</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Data de Nascimento:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="2">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2; text-align: center;" colspan="12">
            <p>Filiação</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Mãe:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Delvete Ferreira Rodrigues</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Pai:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Jesuino Ferreira dos Santos</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Estado civil:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>Casada</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Nacionalidade:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>Brasileira</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Profissão/Ocupação:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="2">
            <p>Do Lar</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Local de Trabalho:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Escolaridade:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Carteira assinada:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Renda Mensal:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Telefone de Contato:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Email:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p></p>
        </td>
    </tr>

    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>1.2 Endereço Residencial</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Logradouro</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Rua Miguel Cordeiro</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>N°:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>10</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Comp.:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Bairro</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>Centro</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Cidade:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>Montezuma</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>CEP:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>39.547.000</p>
        </td>
    </tr>

    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>2 DADOS DO IMÓVEL - REURB</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Mesmo endereço residencial?</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="9">
            <p>(⠀) Sim, Preencher campos sem (*)   (⠀) Não, preencher todos os campos</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Logradouro</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>*N°:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>*Comp:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p></p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>*Bairro</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>*Cidade</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>*CEP:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>39.547.000</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Setor</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>1</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Quadra</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>03</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Lote</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p></p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Sub-Lote</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="1">
            <p>03</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="1">
            <p>Insc. Municipal</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>1.1.003.0007.001</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Edificado</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Prédio com direito de Laje?</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
    </tr>

    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>2.1 Infraestrutura Básica</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Energia elétrica:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p>(⠀) Rede pública (⠀) Solar (⠀) Emprestada</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Água Potável:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p> (⠀) Rede pública (⠀) Poço⠀(⠀) Caminhão Pipa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Esgotamento Sanitário:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="4">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="5">
            <p> (⠀) Rede pública (⠀) Fossa (⠀) Céu aberto</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Coleta de lixo:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="9">
            <p>(⠀) Sim (⠀) Não</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Edificio tipo:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="9">
            <p>(⠀) Alvenaria⠀⠀⠀⠀⠀(⠀) Adobe⠀⠀⠀⠀⠀(⠀) Madeira⠀⠀⠀⠀⠀(⠀) Outro</p>
        </td>
    </tr>

    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>2.3 Documentação do Imóvel e informações complementares</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="2">
            <p>Tipo:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="10">
            <p>(⠀) Recibo Compra/Venda⠀⠀(⠀) Promessa Compra/Venda⠀⠀(⠀) Escritura Pública⠀(⠀) Outros</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Em Condomínio?</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>(⠀) Sim⠀(⠀) Nâo</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Possui outro imóvel registrado?</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>(⠀) Sim⠀(⠀) Nâo</p>
        </td>
    </tr>
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="font-size:small; border-collapse: collapse; text-align: center;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
</table>

<div>
    <div style="width: 50%; float: left; text-align: center;">
        _____________________________________________
        <b>Gilberto Ferreira dos Santos</b>
        <span style="font-style: small;">Entrevistado/Beneficiário</span>
    </div>
    <div  style="width: 50%; float: right; text-align: center;">
        _____________________________________________
        <span style="font-style: small;">Entrevistador</span>
    </div>
</div>');

$mpdf->AddPage();

$mpdf->WriteHTML('
<table style="width:100%; border: 1px solid white; border-collapse: collapse;">
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="4">
            <p>2.4. Condôminos</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>Nome</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>CPF</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>RG</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>Percentual %²</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
</table>

<div style="float: left; font-size: x-small; padding-bottom: 8px;">
    <span>² Porcentagem do condômino no imóvel objeto da REURB</span>
</div>

<table style="width:100%; border: 1px solid white; border-collapse: collapse;">
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="12">
            <p>3. INFORMAÇÕES RELATIVAS Á FAMILIA</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Cidade de orígem</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>a</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Estado:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>a</p>
        </td>
        </tr>
        <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Tempo de Residênca no Múnicipio:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>a</p>
        </td>
        <td style="border: 1px solid black; font-size:small; font-weight: bold; background-color: #E5E4E2" colspan="3">
            <p>Tempo de Residência na atual moradia:</p>
        </td>
        <td style="border: 1px solid black; font-size:small" colspan="3">
            <p>a</p>
        </td>
    </tr>
</table>

<table style="width:100%; border: 1px solid white; border-collapse: collapse;">
    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; font-weight: bold; text-align: center; background-color: #f0eec7; padding: 4px 0;" colspan="5">
            <p>4. INFORMAÇÕES SOBRE OS DEMAIS MORADORES DA UNIDADE</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>Nome</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>CPF</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>Profissão/Ocupação</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>Parentesco</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: center">
        <p>Renda Mensal</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaaaaaaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;">
        <p>aaa</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: right;" colspan="4">
        <p>RENDA TOTAL DOS DEMAIS MEMBROS DA FAMILIA R$:</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;" colspan="1">
        <p> 10 reais</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: right;" colspan="4">
        <p>RENDA FAMILIAR TOTAL R$:</p>
        </td>
        <td style="border: 1px solid black; font-size:small; text-align: left;" colspan="1">
        <p> 15 reais</p>
        </td>
    </tr>

    <tr style="border-right: 1px solid white; border-collapse: collapse;">
        <td style="padding: 4px 0;" colspan="6">
            <p>⠀</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; border-bottom: 1px solid black; font-size:small; text-align: left;" rowspan="4">
        <p>Observações</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left; border-top: 1px solid black;" colspan="5">
        <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;" colspan="5">
        <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; font-size:small; text-align: left;" colspan="5">
        <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="border: 1px solid black; border-right: 1px solid black; font-size:small; text-align: left;" colspan="5">
        <p>&emsp;</p>
        </td>
    </tr>

    <tr style="border: 1px solid black; border-bottom: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid black; border-bottom: 1px solid white; font-size:small; text-align: left;" colspan="5">
        <p>&emsp;</p>
        <span style="font-size: x-small;">Todas as informações prestadas neste cadastramento, nas páginas 01 e 02, são verdadeiras e de minha inteira responsabilidade</span>
        <p>&emsp;</p>
        <p style="font-weight: bold;">Montezuma, _____ de _______________ de 2020.</p>
        </td>
    </tr>
    <tr style="border-collapse: collapse;">
        <td style="width: 50%; border-left: 1px solid black; border-bottom: 1px solid black;"></td>
        <td style="border-bottom: 1px solid black; border-right: 1px solid black; border; font-size:small; width: 50%; text-align: center;" colspan="5">
            <p>&emsp;</p>
            <p>______________________________________________________</p>
            <p>Nome:</p>
            <p>CPF:</p>
            <p>Entrevistado/Beneficiário:</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-bottom: 1px solid white; border-collapse: collapse;">
        <td style="font-size: small;" colspan="5">
            <p>Conclusões do Relatório Socioeconômico / Parecer: </p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-top: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid black; border-top: 1px solid white; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse;">
        <td style="border: 1px solid black; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse;">
        <td style="border: 1px solid black; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse;">
        <td style="border: 1px solid black; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse;">
        <td style="border: 1px solid black; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-collapse: collapse;">
        <td style="border: 1px solid black; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-bottom: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid black; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border-bottom: 1px solid white; border-top: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid black; border-bottom: 1px solid white; border-top: 1px solid white; font-size: small; text-align: center;" colspan="5">
            <p>Montezuma, ______ de _____________________ de 2020.</p>
        </td>
    </tr>
    <tr style="border-top: 1px solid white; border-bottom: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid black; border-top: 1px solid white; border-bottom: 1px solid white; font-size: small;" colspan="5">
            <p>&emsp;</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-bottom: 1px solid white; border-top: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid white; font-size: small; text-align: center;" colspan="5">
            <p>_______________________________</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-bottom: 1px solid white; border-top: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid white; font-size: small; text-align: center;" colspan="5">
            <p>xxxxxxxx</p>
        </td>
    </tr>
    <tr style="border: 1px solid black; border-bottom: 1px solid black; border-top: 1px solid white; border-collapse: collapse;">
        <td style="border: 1px solid white; font-size: small; text-align: center;" colspan="5">
            <p>Entrevistador</p>
        </td>
    </tr>
</table>
');


ob_clean();
$mpdf->Output();

?>