<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Assoc;
use App\Models\Export;
use App\Models\Filial;
use App\Models\LAcredKpis;
use App\Models\LAcredKpisTotal;
use App\Models\LAcredProjecao;
use App\Models\LAcredProjecaoTotal;
use App\Models\LAcredVencido;
use App\Models\LAcredVencidoTotal;
use App\Models\LComComparadia;
use App\Models\LComGrafico;
use App\Models\LComPerfAssoc;
use App\Models\LComPerfMes;
use App\Models\LComTotais;
use App\Models\LSerGrafico;
use App\Models\LSerPerform;
use App\Models\LSerResumoDia;
use App\Models\LSerTotais;
use App\Models\RelFatuLojas;
use App\Models\RelGrafVenLojas;
use App\Models\RelPerfAssocVenLojas;
use App\Models\RelPerfMesVenLojas;
use App\Models\RelTotFatLojas;
use App\Models\RelTotPerfVenLojas;
use App\Models\LGERAnaliseFiliais;
use App\Models\LGERConversaoFiliais;
use App\Models\LGERGiroEstoque;
use App\Models\LGERInadimplencia;
use App\Models\Total;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PDF;

class HomeController extends Controller
{
    public function index()
    {
        $this->insertData();
        return View('home.index');
    }

    public function resumo()
    {

        $total = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\total.json');
        $filial = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\filial.json');
        $grupo = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\grupo.json');
        $exportacao = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\exportacao.json');

        $jsontotal = json_decode($total, true);
        $jsonfilial = json_decode($filial, true);
        $jsongrupo = json_decode($grupo, true);
        $jsonexportacao = json_decode($exportacao, true);

        //return View('relatorios/resumo', compact(['jsontotal', 'jsonfilial', 'jsongrupo', 'jsonexportacao']));

        $data = [
            'jsontotal' => $jsontotal,
            'jsonfilial' => $jsonfilial,
            'jsongrupo' => $jsongrupo,
            'jsonexportacao' => $jsonexportacao
        ];
        $paper = array(0, 0, 426.00, 843.48);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('relatorios/resumo', $data)->setPaper($paper, 'portrait');
        // return $pdf->stream('resumo.pdf');
        return $pdf->download('resumo.pdf');
    }

    /** Procedimento de inserção de dados dos relatórios de Compras Lojas Solar */
    public function relComprasLojas()
    {
        // Relatórios servicos Json Lojas Solar*******************************************************
        $LRCComparativo = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_compras\\relcomparativo.json');
        $LRCGrafico = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_compras\\relgrafico.json');
        $LRCPerfAssoc = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_compras\\relperfassoc.json');
        $LRCPerfMes = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_compras\\relperfmes.json');
        $LRCTotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_compras\\reltotal.json');

        $DLRCComparativo = json_decode($LRCComparativo);
        $DLRCGrafico = json_decode($LRCGrafico);
        $DLRCPerfAssoc = json_decode($LRCPerfAssoc);
        $DLRCPerfMes = json_decode($LRCPerfMes);
        $DLRCTotal = json_decode($LRCTotal);

        // Inserção de dados comparativo compras***************************
        $dataComp = LComComparadia::orderByDesc('id_comp');
        foreach (array_slice($DLRCComparativo, 0, 1) as $fdt) {
            $dataComp1 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRCComparativo as $com) {
            $comp[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $com->Atualizacao)->format("Y-m-d H:i:s"),
                'Assoc' => $com->Assoc,
                'CompraDia' => $com->CompraDia,
                'CompraAnterior' => $com->CompraAnterior,
                'CompraSemana' => $com->CompraSemana,
                'CompraMes' => $com->CompraMes,
                'Rep' => $com->Rep,
                'PrazoMedio' => $com->PrazoMedio
            ];
        }

        if ($dataComp->count() == 0) {
            LComComparadia::insert($comp);
        } else if ($dataComp1 == Carbon::createFromFormat("Y-m-d H:i:s", $dataComp->first()->Atualizacao)->format("Y-m-d")) {
            LComComparadia::whereDate('Atualizacao', $dataComp1)->delete();
            LComComparadia::insert($comp);
        } else {
            LComComparadia::insert($comp);
        }

        // Inserção de dados grafico compras***************************
        $dataGraf = LComGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DLRCGrafico, 0, 1) as $fdt) {
            $dataComp2 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRCGrafico as $gra) {
            $graf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $gra->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $gra->DiaSemana,
                'Compras' => $gra->Compras
            ];
        }

        if ($dataGraf->count() == 0) {
            LComGrafico::insert($graf);
        } else if ($dataComp2 == Carbon::createFromFormat("Y-m-d H:i:s", $dataGraf->first()->Atualizacao)->format("Y-m-d")) {
            LComGrafico::whereDate('Atualizacao', $dataComp2)->delete();
            LComGrafico::insert($graf);
        } else {
            LComGrafico::insert($graf);
        }

        // Inserção de dados perform associacao compras***************************
        $dataAss = LComPerfAssoc::orderByDesc('id_assoc');
        foreach (array_slice($DLRCPerfAssoc, 0, 1) as $fdt) {
            $dataComp3 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRCPerfAssoc as $ass) {
            $assoc[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $ass->Atualizacao)->format("Y-m-d H:i:s"),
                'Assoc' => $ass->Assoc,
                'Compras' => $ass->Compras,
                'Rep' => $ass->Rep,
                'PrazoMedio' => $ass->PrazoMedio
            ];
        }

        if ($dataAss->count() == 0) {
            LComPerfAssoc::insert($assoc);
        } else if ($dataComp3 == Carbon::createFromFormat("Y-m-d H:i:s", $dataAss->first()->Atualizacao)->format("Y-m-d")) {
            LComPerfAssoc::whereDate('Atualizacao', $dataComp3)->delete();
            LComPerfAssoc::insert($assoc);
        } else {
            LComPerfAssoc::insert($assoc);
        }

        // Inserção de dados perform mes compras***************************
        $dataMes = LComPerfMes::orderByDesc('id_mes');
        foreach (array_slice($DLRCPerfMes, 0, 1) as $fdt) {
            $dataComp4 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRCPerfMes as $mes) {
            $meses[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $mes->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $mes->AnoMesNum,
                'MesAno' => $mes->MesAno,
                'MediaCompra' => $mes->MediaCompra,
                'Rep' => $mes->Rep,
                'PrazoMedio' => $mes->PrazoMedio
            ];
        }

        if ($dataMes->count() == 0) {
            LComPerfMes::insert($meses);
        } else if ($dataComp4 == Carbon::createFromFormat("Y-m-d H:i:s", $dataMes->first()->Atualizacao)->format("Y-m-d")) {
            LComPerfMes::whereDate('Atualizacao', $dataComp4)->delete();
            LComPerfMes::insert($meses);
        } else {
            LComPerfMes::insert($meses);
        }

        // Inserção de dados totais compras***************************
        $dataTot = LComTotais::orderByDesc('id_total');
        foreach (array_slice($DLRCTotal, 0, 1) as $fdt) {
            $dataComp5 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRCTotal as $tot) {
            $tota[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $tot->Atualizacao)->format("Y-m-d H:i:s"),
                'CompraDia' => $tot->CompraDia,
                'CompraAnterior' => $tot->CompraAnterior,
                'CompraSemana' => $tot->CompraSemana,
                'CompraMes' => $tot->CompraMes,
                'Rep' => $tot->Rep,
                'PrazoMedio' => $tot->PrazoMedio,
                'MediaCompraMes' => $tot->MediaCompraMes,
                'RepMes' => $tot->RepMes,
                'PrazoMedioMes' => $tot->PrazoMedioMes,
                'ComprasAssoc' => $tot->ComprasAssoc,
                'RepAssoc' => $tot->RepAssoc,
                'PrazoMedioAssoc' => $tot->PrazoMedioAssoc
            ];
        }

        if ($dataTot->count() == 0) {
            LComTotais::insert($tota);
        } else if ($dataComp5 == Carbon::createFromFormat("Y-m-d H:i:s", $dataTot->first()->Atualizacao)->format("Y-m-d")) {
            LComTotais::whereDate('Atualizacao', $dataComp5)->delete();
            LComTotais::insert($tota);
        } else {
            LComTotais::insert($tota);
        }
    }

    /** Procedimento de inserção de dados dos relatórios de Servicos Lojas Solar */
    public function relServicosLojas()
    {
        // Relatórios servicos Json Lojas Solar*******************************************************
        $LRSresumo = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_servicos\\relresumo.json');
        $LRSGrafico = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_servicos\\relgrafico.json');
        $LRSPerf = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_servicos\\relperformance.json');
        $LRSTotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_servicos\\reltotal.json');

        $DLRSresumo = json_decode($LRSresumo);
        $DLRSGrafico = json_decode($LRSGrafico);
        $DLRSPerf = json_decode($LRSPerf);
        $DLRSTotal = json_decode($LRSTotal);

        // Inserção de dados resumo serviços***************************
        $dataResum = LSerResumoDia::orderByDesc('id_resumdia');
        foreach (array_slice($DLRSresumo, 0, 1) as $fdt) {
            $dataSer1 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($DLRSresumo as $res) {
            $resum[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $res->Atualizacao)->format("Y-m-d H:i:s"),
                'Supervisor' => $res->Supervisor,
                'GEDia' => $res->GEDia,
                'PPDia' => $res->PPDia,
                'GESemana' => $res->GESemana,
                'PPSemana' => $res->PPSemana,
                'GEMes' => $res->GEMes,
                'GEMesRep' => $res->GEMesRep,
                'PPMes' => $res->PPMes,
                'PPMesRep' => $res->PPMesRep,
                'APMes' => $res->APMes,
                'APMesRep' => $res->APMesRep,
                'TotServicos' => $res->TotServicos,
                'TotRep' => $res->TotRep
            ];
        }

        if ($dataResum->count() == 0) {
            LSerResumoDia::insert($resum);
        } else if ($dataSer1 == Carbon::createFromFormat("Y-m-d H:i:s", $dataResum->first()->Atualizacao)->format("Y-m-d")) {
            LSerResumoDia::whereDate('Atualizacao', $dataSer1)->delete();
            LSerResumoDia::insert($resum);
        } else {
            LSerResumoDia::insert($resum);
        }

        // Inserção de dados gráfico serviços***************************
        $dataGraf = LSerGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DLRSGrafico, 0, 1) as $fdt) {
            $dataSer2 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRSGrafico as $gra) {
            $graf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $gra->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $gra->DiaSemana,
                'Vendas' => $gra->Vendas,
                'Meta' => $gra->Meta
            ];
        }

        if ($dataGraf->count() == 0) {
            LSerGrafico::insert($graf);
        } else if ($dataSer2 == Carbon::createFromFormat("Y-m-d H:i:s", $dataGraf->first()->Atualizacao)->format("Y-m-d")) {
            LSerGrafico::whereDate('Atualizacao', $dataSer2)->delete();
            LSerGrafico::insert($graf);
        } else {
            LSerGrafico::insert($graf);
        }

        // Inserção de dados performance serviços***************************
        $dataPerf = LSerPerform::orderByDesc('id_perform');
        foreach (array_slice($DLRSPerf, 0, 1) as $fdt) {
            $dataSer3 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRSPerf as $per) {
            $perf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $per->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $per->AnoMesNum,
                'PerfMesAno' => $per->PerfMesAno,
                'PerfValorGE' => $per->PerfValorGE,
                'PerfRepGE' => $per->PerfRepGE,
                'PerfMetaGE' => $per->PerfMetaGE,
                'PerfValorPP' => $per->PerfValorPP,
                'PerfRepPP' => $per->PerfRepPP,
                'PerfMetaPP' => $per->PerfMetaPP,
                'PerfValorAP' => $per->PerfValorAP,
                'PerfRepAP' => $per->PerfRepAP,
                'PerfMetaAP' => $per->PerfMetaAP,
                'PerfValorEP' => $per->PerfValorEP,
                'PerfRepEP' => $per->PerfRepEP
            ];
        }

        if ($dataPerf->count() == 0) {
            LSerPerform::insert($perf);
        } else if ($dataSer3 == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerf->first()->Atualizacao)->format("Y-m-d")) {
            LSerPerform::whereDate('Atualizacao', $dataSer3)->delete();
            LSerPerform::insert($perf);
        } else {
            LSerPerform::insert($perf);
        }

        // Inserção de dados totais serviços***************************
        $dataTot = LSerTotais::orderByDesc('id_total');
        foreach (array_slice($DLRSTotal, 0, 1) as $fdt) {
            $dataSer4 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRSTotal as $tot) {
            $tota[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $tot->Atualizacao)->format("Y-m-d H:i:s"),
                'GEDia' => $tot->GEDia,
                'PPDia' => $tot->PPDia,
                'GESemana' => $tot->GESemana,
                'PPSemana' => $tot->PPSemana,
                'GEMes' => $tot->GEMes,
                'GEMesRep' => $tot->GEMesRep,
                'PPMes' => $tot->PPMes,
                'PPMesRep' => $tot->PPMesRep,
                'APMes' => $tot->APMes,
                'APMesRep' => $tot->APMesRep,
                'TotServicos' => $tot->TotServicos,
                'TotRep' => $tot->TotRep,
                'MetaMes' => $tot->MetaMes,
                'VendaMes' => $tot->VendaMes,
                'FaltaVenderMes' => $tot->FaltaVenderMes,
                'AtingidoMes' => $tot->AtingidoMes,
                'RepFatMes' => $tot->RepFatMes,
                'MetaGEMes' => $tot->MetaGEMes,
                'VendaGEMes' => $tot->VendaGEMes,
                'FaltaVenderGEMes' => $tot->FaltaVenderGEMes,
                'AtingidoGEMes' => $tot->AtingidoGEMes,
                'QtdVendaGEMes' => $tot->QtdVendaGEMes,
                'ElegiveisGEMes' => $tot->ElegiveisGEMes,
                'ConversaoGEMes' => $tot->ConversaoGEMes,
                'MetaPPMes' => $tot->MetaPPMes,
                'VendaPPMes' => $tot->VendaPPMes,
                'FaltaVenderPPMes' => $tot->FaltaVenderPPMes,
                'AtingidoPPMes' => $tot->AtingidoPPMes,
                'QtdVendaPPMes' => $tot->QtdVendaPPMes,
                'ElegiveisPPMes' => $tot->ElegiveisPPMes,
                'ConversaoPPMes' => $tot->ConversaoPPMes,
                'MetaAPMes' => $tot->MetaAPMes,
                'VendaAPMes' => $tot->VendaAPMes,
                'FaltaVenderAPMes' => $tot->FaltaVenderAPMes,
                'AtingidoAPMes' => $tot->AtingidoAPMes,
                'MetaEPMes' => $tot->MetaEPMes,
                'VendaEPMes' => $tot->VendaEPMes,
                'FaltaVenderEPMes' => $tot->FaltaVenderEPMes,
                'AtingidoEPMes' => $tot->AtingidoEPMes,
                'MetaDia' => $tot->MetaDia,
                'VendaDia' => $tot->VendaDia,
                'PerfDia' => $tot->PerfDia,
                'QtdVendaGEDia' => $tot->QtdVendaGEDia,
                'ElegiveisGEDia' => $tot->ElegiveisGEDia,
                'ConversaoGEDia' => $tot->ConversaoGEDia,
                'QtdVendaPPDia' => $tot->QtdVendaPPDia,
                'ElegiveisPPDia' => $tot->ElegiveisPPDia,
                'ConversaoPPDia' => $tot->ConversaoPPDia,
                'MediaDia' => $tot->MediaDia,
                'PerfValorGE' => $tot->PerfValorGE,
                'PerfRepGE' => $tot->PerfRepGE,
                'PerfMetaGE' => $tot->PerfMetaGE,
                'PerfValorPP' => $tot->PerfValorPP,
                'PerfRepPP' => $tot->PerfRepPP,
                'PerfMetaPP' => $tot->PerfMetaPP,
                'PerfValorAP' => $tot->PerfValorAP,
                'PerfRepAP' => $tot->PerfRepAP,
                'PerfMetaAP' => $tot->PerfMetaAP,
                'PerfValorEP' => $tot->PerfValorEP,
                'PerfRepEP' => $tot->PerfRepEP
            ];
        }

        if ($dataTot->count() == 0) {
            LSerTotais::insert($tota);
        } else if ($dataSer4 == Carbon::createFromFormat("Y-m-d H:i:s", $dataTot->first()->Atualizacao)->format("Y-m-d")) {
            LSerTotais::whereDate('Atualizacao', $dataSer4)->delete();
            LSerTotais::insert($tota);
        } else {
            LSerTotais::insert($tota);
        }
    }

    /** Procedimento de inserção de dados dos relatórios de faturamento Lojas Solar */
    public function relFaturamentoLojas()
    {
        // Relatórios Faturamento Json Lojas Solar*******************************************************
        $LRFaturamento = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_faturamento\\relfaturamento.json');
        $LRFTotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_faturamento\\relfaturamentototal.json');
        $LRFGrafico = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_faturamento\\relgraficoevolucao.json');
        $LRFPerfAssoc = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_faturamento\\relperfassoc.json');
        $LRFPerfMes = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_faturamento\\relperfmes.json');
        $LRFTotalPerf = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Rel_faturamento\\reltotalperfassocmes.json');

        $DLRFaturamento = json_decode($LRFaturamento);
        $DLRFTotal = json_decode($LRFTotal);
        $DLRFGrafico = json_decode($LRFGrafico);
        $DLRFPerfAssoc = json_decode($LRFPerfAssoc);
        $DLRFPerfMes = json_decode($LRFPerfMes);
        $DLRFTotalPerf = json_decode($LRFTotalPerf);

        // Inserção de dados faturamento **********************************
        $dataFaturamento = RelFatuLojas::orderByDesc('id_faturamento');

        foreach (array_slice($DLRFaturamento, 0, 1) as $fdt) {
            $dataFatu1 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($DLRFaturamento as $fatu) {
            $fat[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatu->Atualizacao)->format("Y-m-d H:i:s"),
                'Associacao' => $fatu->Associacao,
                'FatuDia' => $fatu->FatuDia,
                'MargemDia' => $fatu->MargemDia,
                'FatuAnterior' => $fatu->FatuAnterior,
                'MargemAnterior' => $fatu->MargemAnterior,
                'FatuSemana' => $fatu->FatuSemana,
                'MargemSemana' => $fatu->MargemSemana,
                'FatuMes' => $fatu->FatuMes,
                'MargemMes' => $fatu->MargemMes,
                'CompDia' => $fatu->CompDia,
                'CompMes' => $fatu->CompMes,
                'RepFatu' => $fatu->RepFatu,
                'JurosSPM' => $fatu->JurosSPM,
                'RepSemFatu' => $fatu->RepSemFatu,
            ];
        }

        if ($dataFaturamento->count() == 0) {
            RelFatuLojas::insert($fat);
        } else if ($dataFatu1 == Carbon::createFromFormat("Y-m-d H:i:s", $dataFaturamento->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            RelFatuLojas::whereDate('Atualizacao', $dataFatu1)->delete();
            RelFatuLojas::insert($fat);
        } else {
            RelFatuLojas::insert($fat);
        }

        // Inserção de dados faturamento total ****************************
        $dataFatTotal = RelTotFatLojas::orderByDesc('id_faturamento');
        foreach (array_slice($DLRFTotal, 0, 1) as $fdt) {
            $dataFatu2 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($DLRFTotal as $tfatu) {

            $totfat[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $tfatu->Atualizacao)->format("Y-m-d H:i:s"),
                'FatuDia' => $tfatu->FatuDia,
                'MargemDia' => $tfatu->MargemDia,
                'FatuAnterior' => $tfatu->FatuAnterior,
                'MargemAnterior' => $tfatu->MargemAnterior,
                'FatuSemana' => $tfatu->FatuSemana,
                'MargemSemana' => $tfatu->MargemSemana,
                'FatuMes' => $tfatu->FatuMes,
                'MargemMes' => $tfatu->MargemMes,
                'RepFatu' => $tfatu->RepFatu,
                'JurosSPM' => $tfatu->JurosSPM,
                'RepSemFatu' => $tfatu->RepSemFatu,
                'MetaMes' => $tfatu->MetaMes,
                'VendaMes' => $tfatu->VendaMes,
                'FaltaVenderMes' => $tfatu->FaltaVenderMes,
                'MetaParcMes' => $tfatu->MetaParcMes,
                'AtingidoMes' => $tfatu->AtingidoMes,
                'PerfAtualMes' => $tfatu->PerfAtualMes,
                'MetaDia' => $tfatu->MetaDia,
                'VendaDia' => $tfatu->VendaDia,
                'FaltaVenderDia' => $tfatu->FaltaVenderDia,
                'PerfMetaDia' => $tfatu->PerfMetaDia,
                'JurSParcDia' => $tfatu->JurSParcDia,
                'PerfJurDia' => $tfatu->PerfJurDia,
                'MediaDia' => $tfatu->MediaDia
            ];
        }

        if ($dataFatTotal->count() == 0) {
            RelTotFatLojas::insert($totfat);
        } else if ($dataFatu2 == Carbon::createFromFormat("Y-m-d H:i:s", $dataFatTotal->first()->Atualizacao)->format("Y-m-d")) {
            RelTotFatLojas::whereDate('Atualizacao', $dataFatu2)->delete();
            RelTotFatLojas::insert($totfat);
        } else {
            RelTotFatLojas::insert($totfat);
        }

        // Inserção de dados gráfico faturamento***************************
        $dataGraf = RelGrafVenLojas::orderByDesc('id_grafico');
        foreach (array_slice($DLRFGrafico, 0, 1) as $fdt) {
            $dataFatu3 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($DLRFGrafico as $gr) {

            $graf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $gr->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $gr->DiaSemana,
                'Vendas' => $gr->Vendas,
                'Margem' => $gr->Margem,
                'Meta' => $gr->Meta
            ];
        }

        if ($dataGraf->count() == 0) {
            RelGrafVenLojas::insert($graf);
        } else if ($dataFatu3 == Carbon::createFromFormat("Y-m-d H:i:s", $dataGraf->first()->Atualizacao)->format("Y-m-d")) {
            RelGrafVenLojas::whereDate('Atualizacao', $dataFatu3)->delete();
            RelGrafVenLojas::insert($graf);
        } else {
            RelGrafVenLojas::insert($graf);
        }

        // Inserção de dados performance por associacao faturamento***************************
        $dataPerfAssoc = RelPerfAssocVenLojas::orderByDesc('id_assoc');
        foreach (array_slice($DLRFPerfAssoc, 0, 1) as $fdt) {
            $dataFatu4 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DLRFPerfAssoc as $perfa) {
            $perfassoc[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $perfa->Atualizacao)->format("Y-m-d H:i:s"),
                'Assoc' => $perfa->Assoc,
                'Faturamento' => $perfa->Faturamento,
                'Margem' => $perfa->Margem,
                'RepFat' => $perfa->RepFat,
                'JurSFat' => $perfa->JurSFat,
                'RepJuros' => $perfa->RepJuros,
                'Estoque' => $perfa->Estoque,
                'Giro' => $perfa->Giro,
                'RepEstoque' => $perfa->RepEstoque
            ];
        }

        if ($dataPerfAssoc->count() == 0) {
            RelPerfAssocVenLojas::insert($perfassoc);
        } else if ($dataFatu4 == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfAssoc->first()->Atualizacao)->format("Y-m-d")) {
            RelPerfAssocVenLojas::whereDate('Atualizacao', $dataFatu4)->delete();
            RelPerfAssocVenLojas::insert($perfassoc);
        } else {
            RelPerfAssocVenLojas::insert($perfassoc);
        }

        // Inserção de dados performance por mês faturamento***************************
        $dataPerfMes = RelPerfMesVenLojas::orderByDesc('id_mes');
        foreach (array_slice($DLRFPerfMes, 0, 1) as $fdt) {
            $dataFatu5 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($DLRFPerfMes as $perfm) {
            $perfmes[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $perfm->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $perfm->AnoMesNum,
                'MesAno' => $perfm->MesAno,
                'Meta' => $perfm->Meta,
                'MediaFatu' => $perfm->MediaFatu,
                'Margem' => $perfm->Margem,
                'RepFatu' => $perfm->RepFatu,
                'MetaAlcancada' => $perfm->MetaAlcancada,
                'MedJurSParc' => $perfm->MedJurSParc,
                'RepJuros' => $perfm->RepJuros
            ];
        }

        if ($dataPerfMes->count() == 0) {
            RelPerfMesVenLojas::insert($perfmes);
        } else if ($dataFatu5 == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfMes->first()->Atualizacao)->format("Y-m-d")) {
            RelPerfMesVenLojas::whereDate('Atualizacao', $dataFatu5)->delete();
            RelPerfMesVenLojas::insert($perfmes);
        } else {
            RelPerfMesVenLojas::insert($perfmes);
        }

        // Inserção de dados performance total por assoc e mês faturamento***************************
        $dataPerf = RelTotPerfVenLojas::orderByDesc('id_total');
        foreach (array_slice($DLRFTotalPerf, 0, 1) as $fdt) {
            $dataFatu6 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($DLRFTotalPerf as $per) {
            $perf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $per->Atualizacao)->format("Y-m-d H:i:s"),
                'MetaMes' => $per->MetaMes,
                'MediaFatuMes' => $per->MediaFatuMes,
                'MargemMes' => $per->MargemMes,
                'RepFatuMes' => $per->RepFatuMes,
                'MetaAlcancadaMes' => $per->MetaAlcancadaMes,
                'MedJurSParcMes' => $per->MedJurSParcMes,
                'RepJurosMes' => $per->RepJurosMes,
                'FaturamentoAss' => $per->FaturamentoAss,
                'MargemAss' => $per->MargemAss,
                'RepFatAss' => $per->RepFatAss,
                'JurSFatAss' => $per->JurSFatAss,
                'RepJurosAss' => $per->RepJurosAss,
                'EstoqueAss' => $per->EstoqueAss,
                'GiroAss' => $per->GiroAss,
                'RepEstoqueAss' => $per->RepEstoqueAss
            ];
        }

        if ($dataPerf->count() == 0) {
            RelTotPerfVenLojas::insert($perf);
        } else if ($dataFatu6 == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerf->first()->Atualizacao)->format("Y-m-d")) {
            RelTotPerfVenLojas::whereDate('Atualizacao', $dataFatu6)->delete();
            RelTotPerfVenLojas::insert($perf);
        } else {
            RelTotPerfVenLojas::insert($perf);
        }
    }

    /**
     * Procedimento de inserção de dados do resumo de faturamento 
     */
    public function relResumos()
    {

        // Relatórios resumo Json Lojas Solar, Naturovos e Supermercados***********************************
        $Lfilial = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Faturamento\\filial.json');
        $Lassociacao = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Faturamento\\associacao.json');
        $Ltotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Faturamento\\total.json');

        $Sfilial = file_get_contents('\\\\Srv-proexpress\\json_data\\Supermercados\\Faturamento\\filial.json');
        $Ssegmento = file_get_contents('\\\\Srv-proexpress\\json_data\\Supermercados\\Faturamento\\segmento.json');
        $Stotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Supermercados\\Faturamento\\total.json');

        $Nfilial     = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\filial.json');
        $Nexportacao = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\exportacao.json');
        $Ngrupo      = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\grupo.json');
        $Ntotal      = file_get_contents('\\\\Srv-proexpress\\json_data\\Naturovos\\Faturamento\\total.json');

        $filiais = array_merge(
            json_decode($Lfilial),
            json_decode($Sfilial),
            json_decode($Nfilial)
        );

        $associacoes = array_merge(
            json_decode($Lassociacao),
            json_decode($Ssegmento),
            json_decode($Ngrupo),
        );

        $exportacoes = json_decode($Nexportacao);

        $totais = array_merge(
            json_decode($Ltotal),
            json_decode($Stotal),
            json_decode($Ntotal),
        );

        // Inserção de dados filiais
        $datacadFilial = Filial::orderByDesc('id_filial');
        foreach (array_slice($filiais, 0, 1) as $fdt) {
            $dataRes1 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($filiais as $fil) {
            $fili[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fil->Atualizacao)->format("Y-m-d H:i:s"),
                'Departamento' => $fil->Departamento,
                'Filial' => $fil->Filial,
                'Faturamento' => $fil->Faturamento,
                'RepFaturamento' => $fil->RepFaturamento,
                'Projecao' => $fil->Projecao,
                'Margem' => $fil->Margem,
                'TicketMedio' => $fil->TicketMedio ? $fil->TicketMedio : 0,
                'PrecoMedio' => $fil->PrecoMedio ? $fil->PrecoMedio : 0,
                'MetaAlcancada' => $fil->MetaAlcancada ? $fil->MetaAlcancada : 0
            ];
        }

        if ($datacadFilial->count() == 0) {
            Filial::insert($fili);
        } else if ($dataRes1 == Carbon::createFromFormat("Y-m-d H:i:s", $datacadFilial->first()->Atualizacao)->format("Y-m-d")) {
            Filial::whereDate('Atualizacao', $dataRes1)->delete();
            Filial::insert($fili);
        } else {
            Filial::insert($fili);
        }

        // Inerção de dados associacao
        $datacadAssoc = Assoc::orderByDesc('id_assoc');
        foreach (array_slice($associacoes, 0, 1) as $fdt) {
            $dataRes2 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($associacoes as $ass) {
            $assoc[] = [
                'Atualizacao' =>  Carbon::createFromFormat("d/m/Y H:i:s", $ass->Atualizacao)->format("Y-m-d H:i:s"),
                'Departamento' => $ass->Departamento,
                'Associacao' => $ass->Associacao,
                'Faturamento' => $ass->Faturamento,
                'RepFaturamento' => $ass->RepFaturamento,
                'Projecao' => $ass->Projecao ? $ass->Projecao : 0,
                'Margem' => $ass->Margem,
                'PrecoMedio' => $ass->PrecoMedio ? $ass->PrecoMedio : 0,
                'TicketMedio' => $ass->TicketMedio ? $ass->TicketMedio : 0,
                'MetaAlcancada' => $ass->MetaAlcancada ? $ass->MetaAlcancada : 0
            ];
        }
        if ($datacadAssoc->count() == 0) {
            Assoc::insert($assoc);
        } else if ($dataRes2 == Carbon::createFromFormat("Y-m-d H:i:s", $datacadAssoc->first()->Atualizacao)->format("Y-m-d")) {

            Assoc::whereDate('Atualizacao', $dataRes2)->delete();
            Assoc::insert($assoc);
        } else {
            Assoc::insert($assoc);
        }

        // Inerção de dados Exportacao
        $datacadExp = Export::orderByDesc('id_exp');
        foreach (array_slice($exportacoes, 0, 1) as $fdt) {
            $dataRes3 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($exportacoes as $exp) {
            $export[] = [
                'Atualizacao' =>  Carbon::createFromFormat("d/m/Y H:i:s", $exp->Atualizacao)->format("Y-m-d H:i:s"),
                'Departamento' => $exp->Departamento,
                'Pais' => $exp->Pais,
                'Faturamento' => $exp->Faturamento,
                'RepFaturamento' => $exp->RepFaturamento,
                'Margem' => $exp->Margem,
                'PrecoMedio' => $exp->PrecoMedio
            ];
        }
        if ($datacadExp->count() == 0) {
            Export::insert($export);
        } else if ($dataRes3 == Carbon::createFromFormat("Y-m-d H:i:s", $datacadExp->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('exportacao');
            Export::whereDate('Atualizacao', $dataRes3)->delete();
            Export::insert($export);
        } else {
            Export::insert($export);
        }


        // Inerção de dados Totais
        $datacadTot = Total::orderByDesc('id_total');
        foreach (array_slice($totais, 0, 1) as $fdt) {
            $dataRes4 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($totais as $to) {
            $tot[] = [
                'Atualizacao' =>  Carbon::createFromFormat("d/m/Y H:i:s", $to->Atualizacao)->format("Y-m-d H:i:s"),
                'Departamento' => $to->Departamento,
                'Meta' => $to->Meta,
                'Faturamento' => $to->Faturamento,
                'Projecao' => $to->Projecao,
                'Margem' => $to->Margem,
                'PrecoMedio' => $to->PrecoMedio ? $to->PrecoMedio : 0,
                'TicketMedio' => $to->TicketMedio ? $to->TicketMedio : 0,
                'MetaAlcancada' => $to->MetaAlcancada ? $to->MetaAlcancada : 0,
                'FaturamentoSemBrasil' => $to->FaturamentoSemBrasil ? $to->FaturamentoSemBrasil : 0,
                'MargemSemBrasil' => $to->MargemSemBrasil ? $to->MargemSemBrasil : 0,
                'PrecoMedioSemBrasil' => $to->PrecoMedioSemBrasil ? $to->PrecoMedioSemBrasil : 0
            ];
        }

        if ($datacadTot->count() == 0) {
            Total::insert($tot);
            return;
        } else if ($dataRes4 == Carbon::createFromFormat("Y-m-d H:i:s", $datacadTot->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('exportacao');
            Total::whereDate('Atualizacao', $dataRes4)->delete();
            Total::insert($tot);
            return;
        } else {
            Total::insert($tot);
            return;
        }
    }

    public function analiseCreditoLojas()
    {
        $pathKpi = "\\\\Srv-proexpress\\json_data\\Lojas\\Analise Vencidos\\kpis\\";
        $pathVencimento = "\\\\Srv-proexpress\\json_data\\Lojas\\Analise Vencidos\\Vencimento\\";
        $pathProjecao = "\\\\Srv-proexpress\\json_data\\Lojas\\Analise Vencidos\\Projecao\\";
        $diretorioKpi = dir($pathKpi);
        $diretorioVencimento = dir($pathVencimento);
        $diretorioProjecao = dir($pathProjecao);

        $LACKpisTotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Analise Vencidos\\kpistotal\\analisekpistotal.json');
        $LProjecaoTotal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Analise Vencidos\\Projecaototal\\analiseprojecaototal.json');
        $LVencimenTototal = file_get_contents('\\\\Srv-proexpress\\json_data\\Lojas\\Analise Vencidos\\Vencimentototal\\analisevencidostotal.json');

        $DLACKpisTotal = json_decode($LACKpisTotal);
        $DLProjecaoTotal = json_decode($LProjecaoTotal);
        $DLVencimenTototal = json_decode($LVencimenTototal);

        // Kpis por filial
        while ($arquivokpi = $diretorioKpi->read()) {
            if ($arquivokpi != '.' && $arquivokpi != '..') {
                $file = json_decode(file_get_contents($pathKpi . $arquivokpi));
                foreach ($file as $fil) {
                    $kpi[] = [
                        'Atualizacao' => $fil->Atualizacao,
                        'CodFilial' => $fil->CodFilial,
                        'Filial' => $fil->Filial,
                        'ValorCrediario' => $fil->ValorCrediario,
                        'ValorVencer' => $fil->ValorVencer,
                        'RepVencer' => $fil->RepVencer,
                        'ValorVencido' => $fil->ValorVencido,
                        'RepVencido' => $fil->RepVencido,
                        'RepProjVencido' => $fil->RepProjVencido
                    ];
                }
            }
        }
        $diretorioKpi->close();
        LAcredKpis::where('uid', '>', 0)->delete();
        LAcredKpis::insert($kpi);

        // Kpis total
        foreach ($DLACKpisTotal as $kp) {
            $kpit[] = [
                'Atualizacao' => $kp->Atualizacao,
                'ValorCrediario' => $kp->ValorCrediario,
                'ValorVencer' => $kp->ValorVencer,
                'RepVencer' => $kp->RepVencer,
                'ValorVencido' => $kp->ValorVencido,
                'RepVencido' => $kp->RepVencido,
                'RepProjVencido' => $kp->RepProjVencido
            ];
        }
        LAcredKpisTotal::where('uid', '>', 0)->delete();
        LAcredKpisTotal::insert($kpit);

        //################################################################################################################################
        // Vencimento por Filial
        while ($arquivovencimento = $diretorioVencimento->read()) {
            if ($arquivovencimento != '.' && $arquivovencimento != '..') {
                $filev = json_decode(file_get_contents($pathVencimento . $arquivovencimento));
                foreach ($filev as $filv) {
                    $vencimento[] = [
                        'Atualizacao' => $filv->Atualizacao,
                        'CodFilial' => $filv->CodFilial,
                        'Filial' => $filv->Filial,
                        'AnoMesNum' => $filv->AnoMesNum,
                        'MesAno' => $filv->MesAno,
                        'ValorCredito' => $filv->ValorCredito,
                        'RepVencer' => $filv->RepVencer,
                        'RepVencidos' => $filv->RepVencidos
                    ];
                }
            }
        }
        $diretorioVencimento->close();
        LAcredVencido::where('uid', '>', 0)->delete();
        LAcredVencido::insert($vencimento);

        // Vencimento Total
        foreach ($DLVencimenTototal as $vc) {
            $vcit[] = [
                'Atualizacao' => $kp->Atualizacao,
                'AnoMesNum' => $vc->AnoMesNum,
                'MesAno' => $vc->MesAno,
                'ValorCredito' => $vc->ValorCredito,
                'RepVencer' => $vc->RepVencer,
                'RepVencidos' => $vc->RepVencidos
            ];
        }
        LAcredVencidoTotal::where('uid', '>', 0)->delete();
        LAcredVencidoTotal::insert($vcit);
        //################################################################################################################################
        // Projeção vencimento filial
        while ($arquivoprojecao = $diretorioProjecao->read()) {
            if ($arquivoprojecao != '.' && $arquivoprojecao != '..') {
                $filep = json_decode(file_get_contents($pathProjecao . $arquivoprojecao));
                foreach ($filep as $filp) {
                    $projecao[] = [
                        'Atualizacao' => $filp->Atualizacao,
                        'CodFilial' => $filp->CodFilial,
                        'Filial' => $filp->Filial,
                        'AnoMesNum' => $filp->AnoMesNum,
                        'MesAno' => $filp->MesAno,
                        'RepVencidos' => $filp->RepVencidos,
                        'ProjVencidos' => $filp->ProjVencidos
                    ];
                }
            }
        }
        $diretorioProjecao->close();
        LAcredProjecao::where('uid', '>', 0)->delete();
        LAcredProjecao::insert($projecao);

        // Projeção vencimento total
        foreach ($DLProjecaoTotal as $pj) {
            $proj[] = [
                'Atualizacao' => $pj->Atualizacao,
                'AnoMesNum' => $pj->AnoMesNum,
                'MesAno' => $pj->MesAno,
                'RepVencidos' => $pj->RepVencidos,
                'ProjVencidos' => $pj->ProjVencidos
            ];
        }
        LAcredProjecaoTotal::where('uid', '>', 0)->delete();
        LAcredProjecaoTotal::insert($proj);
    }
    public function relRegional()
    {
        $LGERAnaliseFiliais = file_get_contents('D:\\Dados Debian\Documentos\\json graficos tablet\\analise_de_filiais.json');
        $DLGERAnaliseFiliais = json_decode($LGERAnaliseFiliais);

        $LGERInadimplencia = file_get_contents('D:\\Dados Debian\Documentos\\json graficos tablet\\analise-de-filiais-inadimplencia.json');
        $DLGERInadimplencia = json_decode($LGERInadimplencia);

        $LGERConversaoFiliais = file_get_contents('D:\\Dados Debian\Documentos\\json graficos tablet\\melhor-conversao-filiais.json');
        $DLGERConversaoFiliais = json_decode($LGERConversaoFiliais);

        $LGERGiroEstoque = file_get_contents('D:\\Dados Debian\Documentos\\json graficos tablet\\giro-estoque.json');
        $DLGERGiroEstoque = json_decode($LGERGiroEstoque);


        //dd($DLGERGiroEstoque);

        // Giro Estoque
        foreach($DLGERGiroEstoque as $ge) {
            $gest[] = [
                'Atualizacao' => $ge->Atualizacao,
                'GiroAno' => $ge->GiroAno,
                'CodFilial' => $ge->Cod_Filial,
                'Filial' => $ge->Filial,
                'GiroEstoqueLoja' => $ge->GiroEstoqueLoja,
                'GiroEstoqueRede' => $ge->GiroEstoqueRede
            ];
        }
        LGERGiroEstoque::where('uid', '>', 0)->delete();
        LGERGiroEstoque::insert($gest);
        //################################################################################################################################

        // Melhor Conversão de filiais
        foreach($DLGERConversaoFiliais as $cf) {
            $mcfil[] = [
                'Atualizacao' => $cf->Atualizacao,
                'RotuloFaturado' => $cf->RotuloFaturado,
                'MelhorFaturado' => $cf->MelhorFaturado,
                'ValorMeta' => $cf->ValorMeta,
                'MetaAlcancada' => $cf->MetaAlcancada,
                'RotuloMelhorPP' => $cf->RotuloMelhorPP,
                'ValorMelhorPP' => $cf->ValorMelhorPP,
                'MediaMelhorPP' => $cf->MediaMelhorPP,
                'RotuloMelhorGE' => $cf->RotuloMelhorGE,
                'ValorMelhorGE' => $cf->ValorMelhorGE,
                'MediaMelhorGE' => $cf->MediaMelhorGE,
                'RotuloMelhorAP' => $cf->RotuloMelhorAP,
                'ValorMelhorAP' => $cf->ValorMelhorAP,
                'MediaMelhorAP' => $cf->MediaMelhorAP,
                'RotuloMelhorEP' => $cf->RotuloMelhorEP,
                'ValorMelhorEP' => $cf->ValorMelhorEP,
                'MediaMelhorEP' => $cf->MediaMelhorEP,
                'RotuloMelhorVenda' => $cf->RotuloMelhorVenda,
                'ValorMelhorVenda' => $cf->ValorMelhorVenda,
                'MediaMelhorVenda' => $cf->MediaMelhorVenda,
                'RotuloTaxaJuros' => $cf->RotuloTaxaJuros,
                'ValorTaxaJuros' => $cf->ValorTaxaJuros,
                'MediaTaxaJuros' => $cf->MediaTaxaJuros,
                'RotuloProjecao' => $cf->RotuloProjecao,
                'ValorProjecao' => $cf->ValorProjecao,
                'MediaProjecao' => $cf->MediaProjecao,
                'RotuloMetaDia' => $cf->RotuloMetaDia,
                'MetaAlcancadaDia' => $cf->MetaAlcancadaDia,
                'MediaMetaDia' => $cf->MediaMetaDia
            ];
        }
        LGERConversaoFiliais::where('uid', '>', 0)->delete();
        LGERConversaoFiliais::insert($mcfil);
        //################################################################################################################################

        // Analise de inadimplencia
        foreach ($DLGERInadimplencia as $in) {
            $inad[] = [
                'Atualizacao' => $in->Atualizacao,
                'CodFilial' => $in->Cod_Filial,
                'PercentInadimplencia' => $in->PercentInadimplencia
            ];
        }
        LGERInadimplencia::where('uid', '>', 0)->delete();
        LGERInadimplencia::insert($inad);
        //################################################################################################################################

        // Analise de Filiais
        foreach ($DLGERAnaliseFiliais as $af) {
            $afil[] = [
                'Atualizacao' => $af->Atualizacao,
                'CodFilial' => $af->Cod_Filial,
                'Filial' => $af->Filial,
                'Valor_Faturado' => $af->Valor_Faturado,
                'Valor_Meta' => $af->Valor_Meta,
                'Meta_Vendas' => $af->Meta_Vendas,
                'Margem' => $af->Margem,
                'ValorGE' => $af->ValorGE,
                'MetaGE' => $af->MetaGE,
                'ElegiveisGE' => $af->ElegiveisGE,
                'VendasGE' => $af->VendasGE,
                'Meta_GE_Atingida' => $af->Meta_GE_Atingida,
                'GE_Convertida' => $af->GE_Convertida,
                'ValorPP' => $af->ValorPP,
                'MetaPP' => $af->MetaPP,
                'ElegiveisPP' => $af->ElegiveisPP,
                'VendasPP' => $af->VendasPP,
                'Meta_PP_Atingida' => $af->Meta_PP_Atingida,
                'PP_Convertida' => $af->PP_Convertida,
                'ValorAP' => $af->ValorAP,
                'MetaAP' => $af->MetaAP,
                'VendasAP' => $af->VendasAP,
                'Meta_AP_Atingida' => $af->Meta_AP_Atingida,
                'ValorEP' => $af->ValorEP,
                'MetaEP' => $af->MetaEP,
                'Meta_EP_Atingida' => $af->Meta_EP_Atingida,
                'TaxaJurosFilial' => $af->TaxaJurosFilial,
                'ValorTaxaJuros' => $af->ValorTaxaJuros,
                'ValorProjecaoVenda' => $af->ValorProjecaoVenda,
                'PercentProjecaoVenda' => $af->PercentProjecaoVenda,
                'ValorFaturamentoDia' => $af->ValorFaturamentoDia,
                'ValorMetaDia' => $af->ValorMetaDia,
                'ValorAlcancadoDia' => $af->ValorAlcancadoDia
            ];
        }
        LGERAnaliseFiliais::where('uid', '>', 0)->delete();
        LGERAnaliseFiliais::insert($afil);
        //################################################################################################################################
    }

    /**
     * Operação de insercaao de dados no DB
     */
    public function insertData()
    {
        // $this->relResumos();
        // $this->relFaturamentoLojas();
        // $this->relServicosLojas();
        // $this->relComprasLojas();
        // $this->analiseCreditoLojas();
        $this->relRegional();
    }

    public function messageError()
    {
        echo "\033[31m";
        echo '╔══════════════════════════════════════════╗' . PHP_EOL;
        echo '║  Não há dados novos a serem cadastrados! ║' . PHP_EOL;
        echo '╚══════════════════════════════════════════╝' . PHP_EOL;
        echo "\033[39m";
    }

    // Rotas API Resumos ***********************
    public function getAllFiliais()
    {
        $filiais = Filial::orderByDesc('id_filial')->get();
        return json_encode($filiais);
    }
    public function getAllAssociacao()
    {
        $associacao = Assoc::orderByDesc('id_assoc')->get();
        return json_encode($associacao);
    }
    public function getAllExportacao()
    {
        $exportacao = Export::orderByDesc('id_exp')->get();
        return json_encode($exportacao);
    }
    public function getAllTotais()
    {
        $totais = Total::orderByDesc('id_total')->get();
        return json_encode($totais);
    }

    // Rotas API Vendas Lojas ************************
    public function getAllRelFatuLojas()
    {
        $fatu = RelFatuLojas::orderByDesc('id_faturamento')->get();
        return json_encode($fatu);
    }
    public function getAllRelGrafVenLojas()
    {
        $graf = RelGrafVenLojas::orderByDesc('id_grafico')->get();
        return json_encode($graf);
    }
    public function getAllRelPerfAssocVenLojas()
    {
        $perfassoc = RelPerfAssocVenLojas::orderByDesc('id_assoc')->get();
        return json_encode($perfassoc);
    }
    public function getAllRelPerfMesVenLojas()
    {
        $perfmes = RelPerfMesVenLojas::orderByDesc('id_mes')->get();
        return json_encode($perfmes);
    }
    public function getAllRelTotFatLojas()
    {
        $totfatu = RelTotFatLojas::orderByDesc('id_faturamento')->get();
        return json_encode($totfatu);
    }
    public function getAllRelTotPerfVenLojas()
    {
        $totperf = RelTotPerfVenLojas::orderByDesc('id_total')->get();
        return json_encode($totperf);
    }

    // Rotas API Servicos Solar ******************
    public function getLSerGrafico()
    {
        $sgrafico = LSerGrafico::orderByDesc('id_grafico')->get();
        return json_encode($sgrafico);
    }
    public function getLSerPerform()
    {
        $sperf = LSerPerform::orderByDesc('id_perform')->get();
        return json_encode($sperf);
    }
    public function getLSerResumoDia()
    {
        $sresu = LSerResumoDia::orderByDesc('id_resumdia')->get();
        return json_encode($sresu);
    }
    public function getLSerTotais()
    {
        $stotais = LSerTotais::orderByDesc('id_total')->get();
        return json_encode($stotais);
    }

    // Rotas API Compras Solar *******************
    public function getLComComparadia()
    {
        $ccomp = LComComparadia::orderByDesc('id_comp')->get();
        return json_encode($ccomp);
    }
    public function getLComGrafico()
    {
        $cgrafico = LComGrafico::orderByDesc('id_grafico')->get();
        return json_encode($cgrafico);
    }
    public function getLComPerfAssoc()
    {
        $cassoc = LComPerfAssoc::orderByDesc('id_assoc')->get();
        return json_encode($cassoc);
    }
    public function getLComPerfMes()
    {
        $cmes = LComPerfMes::orderByDesc('id_mes')->get();
        return json_encode($cmes);
    }
    public function getLComTotais()
    {
        $ctotais = LComTotais::orderByDesc('id_total')->get();
        return json_encode($ctotais);
    }

    // Rotas API Análise de Crediario por Filial
    public function getLAcrKpis()
    {
        $lkpis = LAcredKpis::orderByDesc('uid')->get();
        return json_encode($lkpis);
    }

    public function getLAcrGrafVencidos()
    {
        $lvencidos = LAcredVencido::orderByDesc('uid')->get();
        return json_encode($lvencidos);
    }

    public function getLAcrGrafProjecao()
    {
        $lprojecao = LAcredProjecao::orderByDesc('uid')->get();
        return json_encode($lprojecao);
    }

    // Rotas API Análise de Crediario Totais
    public function getLAcrKpisTotal()
    {
        $lkpist = LAcredKpisTotal::orderByDesc('uid')->get();
        return json_encode($lkpist);
    }

    public function getLAcrGrafVencidosTotal()
    {
        $lvencidost = LAcredVencidoTotal::orderByDesc('uid')->get();
        return json_encode($lvencidost);
    }

    public function getLAcrGrafProjecaoTotal()
    {
        $lprojecaot = LAcredProjecaoTotal::orderByDesc('uid')->get();
        return json_encode($lprojecaot);
    }

    // Rotas Gerencial
    public function getLGERAnaliseFiliais()
    {
        $lkpisa = LGERAnaliseFiliais::orderByDesc('uid')->get();
        return json_encode($lkpisa);
    }

    public function getLGERConversaoFiliais()
    {
        $lvencidosc = LGERConversaoFiliais::orderByDesc('uid')->get();
        return json_encode($lvencidosc);
    }

    public function getLGERGiroEstoque()
    {
        $lprojecaoe = LGERGiroEstoque::orderByDesc('uid')->get();
        return json_encode($lprojecaoe);
    }

    public function getLGERInadimplencia()
    {
        $lprojecaoi = LGERInadimplencia::orderByDesc('uid')->get();
        return json_encode($lprojecaoi);
    }

    // Rotas API Usuários ************************
    public function login(LoginRequest $request)
    {
        $rcode = $request->code;
        $rpassword = $request->password;
        $code = User::where('Code', $rcode)->first();
        $password = User::where('Password', $rpassword)->first();

        if (!$code && $password) {
            $message = "Código de usuário inexistente!";
        } elseif ($code && !$password) {
            $message = "Senha incorreta para este usuário!";
        } else {
            $message = "Usuário não existe registre-se ou contate o suporte de sistemas.";
        }

        if ($code && $password) {
            $response = [
                "sigIn" => [
                    "success" => true,
                    "message" => "Login efetuado com sucesso!",
                    "user" => [
                        "name" => $code->Name,
                        "filial" => $code->Filial,
                        "type" => $code->Type,
                        "code" => $code->Code
                    ]
                ]
            ];
        } else {
            $response = [
                "sigIn" => [
                    "success" => false,
                    "message" => $message,
                    "user" => [
                        "code" => $rcode,
                        "password" => $rpassword
                    ]
                ]
            ];
        }

        return response()->json($response);
    }

    public function register(Request $request)
    {

        $rcode = $request->code;
        $rfilial = $request->filial;

        $code = User::where('Code', $request->code)->exists();
        $filial = User::where('Filial', $rfilial)->where('Type', 'T')->exists();


        if ($code or $filial) {
            $response = [
                "Register" => [
                    "success" => false,
                    "message" => $code ? "Usuário já cadastrado, problemas de acesso? Contate o suporte de sistemas!" : "Filial em uso por outro usuário. Contate o suporte de sistemas!",
                    "user" => [
                        "code" => $rcode
                    ]
                ]
            ];
        } else {
            $data = [
                "Name" => $request->name,
                "Code" => $request->code,
                "Filial" => $request->filial,
                "Password" => $request->password,
                "Active" => "A",
                "Type" => "T"
            ];
            $register = User::insert($data);
            if ($register) {
                $response = [
                    "Register" => [
                        "success" => true,
                        "message" => "Usuário cadastrado com sucesso!",
                        "user" => [
                            "code" => $request->code
                        ]
                    ]
                ];
            } else {
                $response = [
                    "Register" => [
                        "success" => false,
                        "message" => "Não foi possível cadastrar este usuário!",
                        "user" => [
                            "code" => $request->code
                        ]
                    ]
                ];
            }
        }

        return response()->json($response);
    }
}
