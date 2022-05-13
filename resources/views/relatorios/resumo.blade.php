<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/home/anderson/www/relatorios/public/css/relatorios.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>

<body>
    <div style="padding: 0.5cm">

    {{-- Cabeçalho --}}
    @foreach ($jsontotal as $total)
    
    @if ($total['Departamento'] == '05')
        
    <table class="header">
        <tbody>
            <tr>
                <td class="image"><img src="/home/anderson/www/relatorios/public/images/logonaturovos.png" /></td>
            </tr>
            <tr>
                <td class="title">Relatório de Faturamento</td>
            </tr>
            <tr>
                <td class="subtitle">Atualização:
                    {{ $total['Atualizacao'] }}
                </td>
            </tr>
        </tbody>
    </table>

    <table class="total">
        <thead>
            <tr>
                <th style="width: 28%;">Meta</th>
                <th style="width: 28%;">Faturamento</th>
                <th style="width: 15%;">Projeção</th>
                <th style="width: 14%;">Margem Bruta</th>
                <th style="width: 15%;">Preço Medio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @php
                $precomediototal = $total['PrecoMedio'];
                $margembrutatotal = $total['Margem'];
                $projecaototal = $total['Projecao'];
                $margemtotalsembrasil = $total['MargemSemBrasil'];
                $precomediototalsembrasil = $total['PrecoMedioSemBrasil'];
                @endphp

                <td>
                    R$ {{ number_format($total['Meta'], 2, ",", ".") }}
                </td>
                <td>
                    R$ {{ number_format($total['Faturamento'], 2, ",", ".") }}
                </td>
                <td>
                    {{ number_format($total['Projecao'] * 100, 2, ",", ".") }}%
                </td>
                <td>
                    {{ number_format($total['Margem'] * 100, 2, ",", ".") }}%
                </td>
                <td>
                    R$ {{ number_format($total['PrecoMedio'], 2, ",", ".") }}
                </td>

            </tr>
        </tbody>
    </table>
    @endif
    @endforeach

    {{--
    <!-- Tabela do relatório de Filiais --> --}}
    <table class="total">
        <thead>
            <tr>
                <th style="width: 22%; text-align: left;">Filial</th>
                <th style="width: 22%; text-align: right;">Faturamento</th>
                <th style="width: 13%; text-align: right;">Proje.</th>
                <th style="width: 14%; text-align: right;">%Fat</th>
                <th style="width: 13%; text-align: right;">Margem Bruta</th>
                <th style="width: 15%; text-align: right;">Preço Medio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="background-color: #ddd;">Total</td>
                <td style="text-align: right;">
                    {{ 'R$ ' . number_format(array_sum(array_column($jsonfilial, 'Faturamento')), 2, ",", ".") }}
                </td>
                <td style="text-align: right;">
                    {{number_format($projecaototal * 100, 2, ",", ".") . '%'}}
                </td>
                <td style="text-align: right;">
                    {{number_format(array_sum(array_column($jsonfilial, 'RepFaturamento')) * 100, 2, ",", ".") . '%'}}
                </td>
                <td style="text-align: right;">
                    {{number_format($margembrutatotal * 100, 2, ",", ".") . '%'}}
                </td>
                <td style="text-align: right;">
                    {{'R$ ' . number_format($precomediototal, 2, ",", ".") }}
                </td>
            </tr>

            @php
            function cmp($a, $b)
            {
            return $a['Faturamento'] < $b['Faturamento']; } usort($jsonfilial, 'cmp' ); @endphp 
            @foreach ($jsonfilial as $key => $value)

                <tr key={{$key}}>
                    <td style="text-align: left;">
                        {{$value['Filial'] }}
                    </td>
                    <td style="text-align: right;">
                        {{'R$ ' . number_format($value['Faturamento'], 2, ",", ".") }}
                    </td>
                    <td style="text-align: right;">
                        {{number_format((float)$value['Projecao'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{number_format($value['RepFaturamento'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{number_format($value['Margem'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{'R$ ' . number_format($value['PrecoMedio'], 2, ",", ".") }}
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>

    {{--
    <!-- Tabelade relatórios Grupo --> --}}
    <table class="total">
        <thead>
            <tr>
                <th style="width: 22%; text-align: left;">Grupo</th>
                <th style="width: 22%; text-align: right;">Faturamento</th>
                <th style="width: 14%; text-align: right;">%Fat</th>
                <th style="width: 14%; text-align: right;">Margem Bruta</th>
                <th style="width: 14%; text-align: right;">Preço Medio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="background-color: #ddd;">Total</td>
                <td style="text-align: right;">
                    {{'R$ ' . number_format(array_sum(array_column($jsonfilial, 'Faturamento')), 2, ",", ".") }}
                </td>
                <td style="text-align: right;">
                    {{number_format(array_sum(array_column($jsonfilial, 'RepFaturamento')) * 100, 2, ",", ".") . '%'}}
                </td>
                <td style="text-align: right;">
                    {{number_format($margembrutatotal * 100, 2, ",", ".") . '%'}}
                </td>
                <td style="text-align: right;">
                    {{'R$ ' . number_format($precomediototal, 2, ",", ".") }}
                </td>
            </tr>
            @php
            function cmp2($a2, $b2)
            {
            return $a2['Faturamento'] < $b2['Faturamento']; } usort($jsongrupo, 'cmp2' ); @endphp @foreach ($jsongrupo
                as $key=> $value)

                <tr key={{$key}}>

                    <td style="text-align: left;">
                        {{$value['Associacao'] }}
                    </td>
                    <td style="text-align: right;">
                        {{'R$ ' . number_format($value['Faturamento'], 2, ",", ".") }}
                    </td>
                    <td style="text-align: right;">
                        {{number_format($value['RepFaturamento'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{number_format($value['Margem'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{'R$ ' . number_format($value['PrecoMedio'], 2, ",", ".") }}
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>

    <!-- Tabelade relatórios Exportacao País -->
    <table class="total">
        <thead>
            <tr>
                <th style="width: 22%; text-align: left;">País</th>
                <th style="width: 22%; text-align: right;">Faturamento</th>
                <th style="width: 14%; text-align: right;">%Fat</th>
                <th style="width: 14%; text-align: right;">Margem Bruta</th>
                <th style="width: 14%; text-align: right;">Preço Medio</th>
            </tr>
        </thead>
        <tbody>
            @if ($jsonexportacao)
            <tr>
                <td style="background-color: #ddd;">Total</td>
                <td style="text-align: right;">
                    {{'R$ ' . number_format(array_sum(array_column($jsonexportacao, 'Faturamento')), 2, ",", ".") }}
                </td>
                <td style="text-align: right;">
                    {{number_format(array_sum(array_column($jsonexportacao, 'RepFaturamento')) * 100, 2, ",", ".") .
                    '%'}}
                </td>
                <td style="text-align: right;">
                    {{number_format($margemtotalsembrasil * 100, 2, ",", ".") . '%'}}
                </td>
                <td style="text-align: right;">
                    {{'R$ ' . number_format($precomediototalsembrasil, 2, ",", ".") }}
                </td>
            </tr>
            @php
            function cmp3($a3, $b3)
            {
            return $a3['Faturamento'] < $b3['Faturamento']; } usort($jsonexportacao, 'cmp3' ); @endphp
                @foreach($jsonexportacao as $key=> $value)

                <tr key={{$key}}>
                    <td style="text-align: left;">
                        {{ $value['Pais'] }}
                    </td>
                    <td style="text-align: right;">
                        {{'R$ ' . number_format($value['Faturamento'], 2, ",", ".") }}
                    </td>
                    <td style="text-align: right;">
                        {{number_format($value['RepFaturamento'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{number_format($value['Margem'] * 100, 2, ",", ".") . '%'}}
                    </td>
                    <td style="text-align: right;">
                        {{'R$ ' . number_format($value['PrecoMedio'], 2, ",", ".") }}
                    </td>
                </tr>
                @endforeach
                @else

                <tr>
                    <td colspan="5" style="text-align: left;">Não há dados de exportação a serem mostrados!</td>
                </tr>
                @endif
        </tbody>
    </table>
    </div>
</body>

</html>