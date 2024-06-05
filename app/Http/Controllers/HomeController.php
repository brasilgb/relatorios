<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Assoc;
use App\Models\Export;
use App\Models\Filial;
use App\Models\FiliaisAtivas;
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
use App\Models\LGERAnaliseVendedores;
use App\Models\LGERConversaoFiliais;
use App\Models\LGERConversaoVendedores;
use App\Models\LGERGiroEstoque;
use App\Models\LGERInadimplencia;
use App\Models\LGERGiroSubGrupo;
use App\Models\LGERMargemVendedor;
use App\Models\LGERFilialFatuDia;
use App\Models\LGERFilialFatuTotal;
use App\Models\LGERFilialAssoc;
use App\Models\LGERFilialGrafico;
use App\Models\LGERFilialTotalAssoc;
use App\Models\LGERFilialMes;
use App\Models\Total;
use App\Models\TVEvolucao;
use App\Models\TVFaturamento;
use App\Models\User;
use App\Models\UserAccess;
use Carbon\Carbon;
use DateTime;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use PDF;
use PDO;
use App\Models\LGERFatuDia;
use App\Models\LGERFatuTotal;

class HomeController extends Controller
{
    public function index()
    {
        return View('home.index');
    }

    public function filiaisAtivas()
    {
        $ExtFiliais = file_get_contents('/mnt/jsondata/Lojas/filiaislojassolar.json');
        $DExtFiliais = json_decode($ExtFiliais);
        // Inserção de filiais ativas e com metas***************************
        $listFilial = FiliaisAtivas::get();
        foreach ($DExtFiliais as $ef) {

            $extfil[] = [
                'CodFilial' => $ef->CodFilial,
                'NomeFilial' => $ef->NomeFilial,
                'BairroFilial' => $ef->BairroFilial,
                'EnderecoFilial' => $ef->EnderecoFilial,
                'GerenteFilial' => $ef->GerenteFilial
            ];
        }

        if ($listFilial->count() > 0) {
            FiliaisAtivas::where('idFilial', '>', 0)->truncate();
            FiliaisAtivas::insert($extfil);
        } else {
            FiliaisAtivas::insert($extfil);
        }
    }

    public function resumo()
    {

        $total = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/total.json');
        $filial = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/filial.json');
        $grupo = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/grupo.json');
        $exportacao = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/exportacao.json');

        $jsontotal = json_decode($total, true);
        $jsonfilial = json_decode($filial, true);
        $jsongrupo = json_decode($grupo, true);
        $jsonexportacao = json_decode($exportacao, true);

        // return View('relatorios/resumo', compact(['jsontotal', 'jsonfilial', 'jsongrupo', 'jsonexportacao']));

        $data = [
            'jsontotal' => $jsontotal,
            'jsonfilial' => $jsonfilial,
            'jsongrupo' => $jsongrupo,
            'jsonexportacao' => $jsonexportacao
        ];
        $paper = array(0, 0, 426.00, 843.48);

        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true
        ])->loadView('relatorios/resumo', $data)->setPaper($paper, 'portrait');
        // return $pdf->stream('resumo.pdf');
        return $pdf->download('resumo.pdf');
    }

    /** Procedimento de inserção de dados dos relatórios de Compras Lojas Solar */
    public function relComprasLojas()
    {
        // Relatórios servicos Json Lojas Solar*******************************************************
        $LRCComparativo = file_get_contents('/mnt/jsondata/Lojas/Rel_compras/relcomparativo.json');
        $LRCGrafico = file_get_contents('/mnt/jsondata/Lojas/Rel_compras/relgrafico.json');
        $LRCPerfAssoc = file_get_contents('/mnt/jsondata/Lojas/Rel_compras/relperfassoc.json');
        $LRCPerfMes = file_get_contents('/mnt/jsondata/Lojas/Rel_compras/relperfmes.json');
        $LRCTotal = file_get_contents('/mnt/jsondata/Lojas/Rel_compras/reltotal.json');

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
                'ColorRep' => $com->ColorRep,
                'Rep' => $com->Rep == '-' ? 0 : $com->Rep,
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
                'Rep' => $ass->Rep == '-' ? 0 : $ass->Rep,
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
                'Rep' => $mes->Rep == '-' ? 0 : $mes->Rep,
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
                'DiaAtual' => $tot->DiaAtual,
                'DiaAnterior' => $tot->DiaAnterior,
                'CompraDia' => $tot->CompraDia,
                'CompraAnterior' => $tot->CompraAnterior,
                'CompraSemana' => $tot->CompraSemana,
                'CompraMes' => $tot->CompraMes,
                'Rep' => $tot->Rep == '-' ? 0 : $tot->Rep,
                'PrazoMedio' => $tot->PrazoMedio,
                'MediaCompraMes' => $tot->MediaCompraMes,
                'RepMes' => $tot->RepMes == '-' ? 0 : $tot->RepMes,
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
        $LRSresumo = file_get_contents('/mnt/jsondata/Lojas/Rel_servicos/relresumo.json');
        $LRSGrafico = file_get_contents('/mnt/jsondata/Lojas/Rel_servicos/relgrafico.json');
        $LRSPerf = file_get_contents('/mnt/jsondata/Lojas/Rel_servicos/relperformance.json');
        $LRSTotal = file_get_contents('/mnt/jsondata/Lojas/Rel_servicos/reltotal.json');

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
                'DataChave' => $tot->DataChave,
                'DiaChave' => $tot->DiaChave,
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
        $LRFaturamento = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento/relfaturamento.json');
        $LRFTotal = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento/relfaturamentototal.json');
        $LRFGrafico = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento/relgraficoevolucao.json');
        $LRFPerfAssoc = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento/relperfassoc.json');
        $LRFPerfMes = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento/relperfmes.json');
        $LRFTotalPerf = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento/reltotalperfassocmes.json');

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
                'DiaAtual' => $tfatu->DiaAtual,
                'DiaAnterior' => $tfatu->DiaAnterior,
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
                'ColorMedia' => $perfm->ColorMedia,
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
        $Lfilial = file_get_contents('/mnt/jsondata/Lojas/Faturamento/filial.json');
        $Lassociacao = file_get_contents('/mnt/jsondata/Lojas/Faturamento/associacao.json');
        $Ltotal = file_get_contents('/mnt/jsondata/Lojas/Faturamento/total.json');

        $Sfilial = file_get_contents('/mnt/jsondata/Supermercados/Faturamento/filial.json');
        $Ssegmento = file_get_contents('/mnt/jsondata/Supermercados/Faturamento/segmento.json');
        $Stotal = file_get_contents('/mnt/jsondata/Supermercados/Faturamento/total.json');

        $Nfilial     = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/filial.json');
        $Nexportacao = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/exportacao.json');
        $Ngrupo      = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/grupo.json');
        $Ntotal      = file_get_contents('/mnt/jsondata/Naturovos/Faturamento/total.json');

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
                'Departamento' => $fil->Departamento == '-' ? 0 : $fil->Departamento,
                'Filial' => $fil->Filial,
                'Faturamento' => $fil->Faturamento,
                'RepFaturamento' => $fil->RepFaturamento,
                'Projecao' => $fil->Projecao,
                'Margem' => $fil->Margem == '-' ? 0 : $fil->Margem,
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
        if ($exportacoes and $exportacoes[0]->Faturamento != "-") :
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
        endif;

        // Inerção de dados Totais
        $datacadTot = Total::orderByDesc('id_total');
        foreach (array_slice($totais, 0, 1) as $fdt) {
            $dataRes4 = Carbon::createFromFormat("d/m/Y H:i:s", $fdt->Atualizacao)->format("Y-m-d");
        }
        foreach ($totais as $to) {
            $tot[] = [
                'Atualizacao' =>  Carbon::createFromFormat("d/m/Y H:i:s", $to->Atualizacao)->format("Y-m-d H:i:s"),
                'Departamento' => $to->Departamento == '-' ? 0 : $to->Departamento,
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

        $pathKpi = "/mnt/jsondata/Lojas/Analise Vencidos/kpis/";
        $pathVencimento = "/mnt/jsondata/Lojas/Analise Vencidos/Vencimento/";
        $pathProjecao = "/mnt/jsondata/Lojas/Analise Vencidos/Projecao/";
        $diretorioKpi = dir($pathKpi);
        $diretorioVencimento = dir($pathVencimento);
        $diretorioProjecao = dir($pathProjecao);

        $LACKpisTotal = file_get_contents('/mnt/jsondata/Lojas/Analise Vencidos/kpistotal/analisekpistotal.json');
        $LProjecaoTotal = file_get_contents('/mnt/jsondata/Lojas/Analise Vencidos/Projecaototal/analiseprojecaototal.json');
        $LVencimenTototal = file_get_contents('/mnt/jsondata/Lojas/Analise Vencidos/Vencimentototal/analisevencidostotal.json');

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
        LAcredKpis::where('uid', '>', 0)->truncate();
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
        LAcredKpisTotal::where('uid', '>', 0)->truncate();
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
        LAcredVencido::where('uid', '>', 0)->truncate();
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
        LAcredVencidoTotal::where('uid', '>', 0)->truncate();
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
        LAcredProjecao::where('uid', '>', 0)->truncate();
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
        LAcredProjecaoTotal::where('uid', '>', 0)->truncate();
        LAcredProjecaoTotal::insert($proj);
    }
    // Relatórios gerencial por filial
	public function relGerencialFiliais()
    {
        $LGERFilialFatuDia = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento_gerencial/faturamento-filial-gerencial.json');
        $DLGERFilialFatuDia = json_decode($LGERFilialFatuDia);

        $LGERFilialFatuTotal = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento_gerencial/faturamento-filial-gerencial-total.json');
        $DLGERFilialFatuTotal = json_decode($LGERFilialFatuTotal);

        $LGERFilialAssoc = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento_gerencial/faturamento-filial-gerencial-assoc.json');
        $DLGERFilialAssoc = json_decode($LGERFilialAssoc);

        $LGERFilialGrafico = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento_gerencial/faturamento-filial-gerencial-grafico.json');
        $DLGERFilialGrafico = json_decode($LGERFilialGrafico);

        $LGERFilialTotalAssoc = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento_gerencial/faturamento-filial-gerencial-total-assoc.json');
        $DLGERFilialTotalAssoc = json_decode($LGERFilialTotalAssoc);

        $LGERFilialMes = file_get_contents('/mnt/jsondata/Lojas/Rel_faturamento_gerencial/faturamento-filial-gerencial-mes.json');
        $DLGERFilialMes = json_decode($LGERFilialMes);

        // Faturamento por filial
        foreach ($DLGERFilialFatuDia as $ftd) {
            $ftdia[] = [
                'FilialId' => $ftd->FilialId,
                'Filial' => $ftd->Filial,
                'Associacao' => $ftd->Associacao,
                'FatuDia' => $ftd->FatuDia,
                'MargemDia' => $ftd->MargemDia,
                'FatuAnterior' => $ftd->FatuAnterior,
                'MargemAnterior' => $ftd->MargemAnterior,
                'FatuSemana' => $ftd->FatuSemana,
                'MargemSemana' => $ftd->MargemSemana,
                'FatuMes' => $ftd->FatuMes,
                'MargemMes' => $ftd->MargemMes,
                'CompDia' => $ftd->CompDia,
                'CompMes' => $ftd->CompMes,
                'RepFatu' => $ftd->RepFatu,
                'JurosSPM' => $ftd->JurosSPM,
                'RepSemFatu' => $ftd->RepSemFatu
            ];
        }
        LGERFilialFatuDia::where('idfat', '>', 0)->truncate();
        LGERFilialFatuDia::insert($ftdia);

        // Faturamento total por filial
        foreach ($DLGERFilialFatuTotal as $ftt) {
            $fttotal[] = [
                'Atualizacao' => $ftt->Atualizacao,
                'FilialId' => $ftt->FilialId,
                'Filial' => $ftt->Filial,
                'FatuDia' => $ftt->FatuDia,
                'MargemDia' => $ftt->MargemDia,
				"DiaAtual" => $ftt->DiaAtual,
				"DiaAnterior" => $ftt->DiaAnterior,
                'FatuAnterior' => $ftt->FatuAnterior,
                'MargemAnterior' => $ftt->MargemAnterior,
                'FatuSemana' => $ftt->FatuSemana,
                'MargemSemana' => $ftt->MargemSemana,
                'FatuMes' => $ftt->FatuMes,
                'MargemMes' => $ftt->MargemMes,
                'RepFatu' => $ftt->RepFatu,
                'JurosSPM' => $ftt->JurosSPM,
                'RepSemFatu' => $ftt->RepSemFatu,
                'MetaMes' => $ftt->MetaMes,
                'VendaMes' => $ftt->VendaMes,
                'FaltaVenderMes' => $ftt->FaltaVenderMes,
                'MetaParcMes' => $ftt->MetaParcMes,
                'AtingidoMes' => $ftt->AtingidoMes,
                'PerfAtualMes' => $ftt->PerfAtualMes,
                'MetaDia' => $ftt->MetaDia,
                'VendaDia' => $ftt->VendaDia,
                'FaltaVenderDia' => $ftt->FaltaVenderDia,
                'PerfMetaDia' => $ftt->PerfMetaDia,
                'JurSParcDia' => $ftt->JurSParcDia,
                'PerfJurDia' => $ftt->PerfJurDia,
                'MediaDia' => $ftt->MediaDia,
            ];
        }
        LGERFilialFatuTotal::where('idtot', '>', 0)->truncate();
        LGERFilialFatuTotal::insert($fttotal);

        // Associação por filial
        foreach ($DLGERFilialAssoc as $fta) {
            $ftassoc[] = [
                "FilialId" => $fta->FilialId,
                "Filial" => $fta->Filial,
                "Assoc" => $fta->Assoc,
                "Faturamento" => $fta->Faturamento,
                "Margem" => $fta->Margem,
                "RepFat" => $fta->RepFat,
                "JurSFat" => $fta->JurSFat,
                "RepJuros" => $fta->RepJuros,
                "Estoque" => $fta->Estoque,
                "Giro" => $fta->Giro,
                "RepEstoque" => $fta->RepEstoque
            ];
        }
        LGERFilialAssoc::where('idassoc', '>', 0)->truncate();
        LGERFilialAssoc::insert($ftassoc);

        // Gráfico por filial
        foreach ($DLGERFilialGrafico as $ftg) {
            $ftgrafico[] = [
                "FilialId" => $ftg->FilialId,
                "Filial" => $ftg->Filial,
                "DiaSemana" => $ftg->DiaSemana,
                "Venda" => $ftg->Venda,
                "Margem" => $ftg->Margem,
                "Meta" => $ftg->Meta
            ];
        }
        LGERFilialGrafico::where('idgrafico', '>', 0)->truncate();
        LGERFilialGrafico::insert($ftgrafico);


        // Associacao por filial
        foreach ($DLGERFilialTotalAssoc as $ftat) {
            $ftatotal[] = [
                "Atualizacao" => $ftat->Atualizacao,
                "FilialId" => $ftat->FilialId,
                "Filial" => $ftat->Filial,
                "MetaMes" => $ftat->MetaMes,
                "MediaFatuMes" => $ftat->MediaFatuMes,
                "MargemMes" => $ftat->MargemMes,
                "RepFatuMes" => $ftat->RepFatuMes,
                "MetaAlcancadaMes" => $ftat->MetaAlcancadaMes,
                "MedJurSParcMes" => $ftat->MedJurSParcMes,
                "RepJurosMes" => $ftat->RepJurosMes,
                "FaturamentoAss" => $ftat->FaturamentoAss,
                "MargemAss" => $ftat->MargemAss,
                "RepFatAss" => $ftat->RepFatAss,
                "JurSFatAss" => $ftat->JurSFatAss,
                "RepJurosAss" => $ftat->RepJurosAss,
                "EstoqueAss" => $ftat->EstoqueAss,
                "GiroAss" => $ftat->GiroAss,
                "RepEstoqueAss" => $ftat->RepEstoqueAss,
            ];
        }
        LGERFilialTotalAssoc::where('idtotal', '>', 0)->truncate();
        LGERFilialTotalAssoc::insert($ftatotal);

        // Associacao por filial
        foreach ($DLGERFilialMes as $ftm) {
            $ftames[] = [
                "FilialId" => $ftm->FilialId,
                "Filial" => $ftm->Filial,
                "AnoMesNum" => $ftm->AnoMesNum,
                "MesAno" => $ftm->MesAno,
                "Meta" => $ftm->Meta,
                "MediaFatu" => $ftm->MediaFatu,
                "Margem" => $ftm->Margem,
                "RepFatu" => $ftm->RepFatu,
                "MetaAlcancada" => $ftm->MetaAlcancada,
                "MedJurSParc" => $ftm->MedJurSParc,
                "RepJuros" => $ftm->RepJuros
            ];
        }
        LGERFilialMes::where('idmes', '>', 0)->truncate();
        LGERFilialMes::insert($ftames);
    }

    public function relGerencial()
    {
        $LGERAnaliseFiliais = file_get_contents('/mnt/jsondata/analise_de_filiais.json');
        $DLGERAnaliseFiliais = json_decode($LGERAnaliseFiliais);

        $LGERInadimplencia = file_get_contents('/mnt/jsondata/analise-de-filiais-inadimplencia.json');
        $DLGERInadimplencia = json_decode($LGERInadimplencia);

        $LGERConversaoFiliais = file_get_contents('/mnt/jsondata/melhor-conversao-filiais.json');
        $DLGERConversaoFiliais = json_decode($LGERConversaoFiliais);

        $LGERGiroEstoque = file_get_contents('/mnt/jsondata/giro-estoque.json');
        $DLGERGiroEstoque = json_decode($LGERGiroEstoque);

        $LGERAnaliseVendedores = file_get_contents('/mnt/jsondata/vendas-vendedores.json');
        $DLGERAnaliseVendedores = json_decode($LGERAnaliseVendedores);

        $LGERConversaoVendedores = file_get_contents('/mnt/jsondata/melhor-conversao-vendedores-filiais.json');
        $DLGERConversaoVendedores = json_decode($LGERConversaoVendedores);

        $LGERGiroSubGrupo = file_get_contents('/mnt/jsondata/Lojas/Giro_estoque/giro-estoque-analise-gerencial-filial.json');
        $DLGERGiroSubGrupo = json_decode($LGERGiroSubGrupo);

        $LGERMargemVendedor = file_get_contents('/mnt/jsondata/margem-vendedor.json');
        $DLGERMargemVendedor = json_decode($LGERMargemVendedor);

        //################################################################################################################################

        // Giro Estoque
        foreach ($DLGERGiroEstoque as $ge) {
            $gest[] = [
                'Atualizacao' => $ge->Atualizacao,
                'GiroAno' => $ge->GiroAno,
                'CodFilial' => $ge->Cod_Filial,
                'Filial' => $ge->Filial,
                'GiroEstoqueLoja' => $ge->GiroEstoqueLoja,
                'GiroEstoqueRede' => $ge->GiroEstoqueRede
            ];
        }
        LGERGiroEstoque::where('uid', '>', 0)->truncate();
        LGERGiroEstoque::insert($gest);
        //################################################################################################################################

        // Melhor Conversão de filiais
        foreach ($DLGERConversaoFiliais as $cf) {
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
        LGERConversaoFiliais::where('uid', '>', 0)->truncate();
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
        LGERInadimplencia::where('uid', '>', 0)->truncate();
        LGERInadimplencia::insert($inad);
        //################################################################################################################################

        // Analise de Filiais
        foreach ($DLGERAnaliseFiliais as $af) {
            $afil[] = [
                'Atualizacao' => $af->Atualizacao,
                'CodFilial' => is_numeric($af->Cod_Filial) ? $af->Cod_Filial : '0',
                'Filial' => $af->Filial,
                'Valor_Faturado' => $af->Valor_Faturado,
                'Valor_Meta' => $af->Valor_Meta,
                'Meta_Vendas' => $af->Meta_Vendas,
                'Margem' => $af->Margem,
                'MargemPeriodo' => $af->MargemPeriodo,
                'JurosPeriodo' => $af->JurosPeriodo,
                'TiketMedio' => $af->TiketMedio,
                'QtdNF' => $af->QtdNF,
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
        LGERAnaliseFiliais::where('uid', '>', 0)->truncate();
        LGERAnaliseFiliais::insert($afil);
        //################################################################################################################################

        // Analise de Vendedores
        foreach ($DLGERAnaliseVendedores as $av) {
            $aven[] = [
                'Atualizacao' => $av->Atualizacao,
                'CodFilial' =>  is_numeric($av->Filial) ? $av->Filial : '0',
                'CodigoVendedor' => $av->CodigoVendedor,
                'NomeVendedor' => $av->NomeVendedor,
                'Margem' => $av->Margem,
                'MargemPeriodo' => $av->MargemPeriodo,
                'JurosPeriodo' => $av->JurosPeriodo,
                'TiketMedio' => $av->TiketMedio,
                'QtdNF' => $av->QtdNF,
                'ValorGE' => $av->ValorGE,
                'MetaGE' => $av->MetaGE,
                'PercentualGE' => $av->PercentualGE,
                'ValorPP' => $av->ValorPP,
                'MetaPP' => $av->MetaPP,
                'PercentualPP' => $av->PercentualPP,
                'ValorVenda' => $av->ValorVenda,
                'MetaVenda' => $av->MetaVenda,
                'PercentualVenda' => $av->PercentualVenda,
                'ValorJurosVendidos' => $av->ValorJurosVendidos,
                'PercentJurosVendidos' => $av->PercentJurosVendidos
            ];
        }
        LGERAnaliseVendedores::where('uid', '>', 0)->truncate();
        LGERAnaliseVendedores::insert($aven);
        //################################################################################################################################

        // Analise de Vendedores
        foreach ($DLGERConversaoVendedores as $cv) {
            $cven[] = [
                'Atualizacao' => $cv->Atualizacao,
                'CodFilial' =>  is_numeric($cv->CodFilial) ? $cv->CodFilial : '0',
                'DescricaoFilial' => $cv->DescricaoFilial,
                'CodigoVendedorVenda' => $cv->CodigoVendedorVenda,
                'RotuloMelhorVenda' => $cv->RotuloMelhorVenda,
                'ValorMelhorVenda' => $cv->ValorMelhorVenda,
                'CodigoVendedorJuro' => $cv->CodigoVendedorJuro,
                'RotuloMelhorJuro' => $cv->RotuloMelhorJuro,
                'ValorMelhorJuro' => $cv->ValorMelhorJuro
            ];
        }
        LGERConversaoVendedores::where('uid', '>', 0)->truncate();
        LGERConversaoVendedores::insert($cven);
        //################################################################################################################################

        // Giro Estoque Sub Grupo
        foreach ($DLGERGiroSubGrupo as $gesg) {
            $gesgst = [
                'Atualizacao' => $gesg->Atualizacao,
                'CodFilial' => $gesg->CodFilial,
                'Filial' => $gesg->Filial,
                'codigoSubgrupo' => $gesg->CodSubGrupo,
                'descricaoSubgrupo' => $gesg->SubGrupo,
                'valorEstoque' => $gesg->ValorEstoque,
                'valorAtual' => $gesg->ValorAtual,
                'giroFilial' => $gesg->GiroFilial,
                'giroRede' => $gesg->GiroRede,
            ];
            $insert_giro[] = $gesgst;
        }
        $insert_giro = collect($insert_giro);
        $chunks = $insert_giro->chunk(1000);
        LGERGiroSubGrupo::where('uid', '>', 0)->truncate();
        foreach ($chunks as $chunk) {
            LGERGiroSubGrupo::insert($chunk->toArray());
        }
        //################################################################################################################################

        // Analise de margem do vendedor
        foreach ($DLGERMargemVendedor as $mv) {
            $mvend[] = [
                'ano' => $mv->ano,
                'mes' => $mv->mes,
                'CodFilial' => $mv->CodFilial,
                'vendedor' => $mv->vendedor,
                'margem' => $mv->margem
            ];
        }
        if ($DLGERMargemVendedor) {
            LGERMargemVendedor::where('uid', '>', 0)->truncate();
            LGERMargemVendedor::insert($mvend);
        }
        //################################################################################################################################
    }

    // Grava dados de informações para a aplicação da TV do administrativo
    public function appTVLojas()
    {
        $LTVFaturamento = file_get_contents('/mnt/jsondata/PainelTV/faturamento-painel-tv.json');
        $LTVEvolucao = file_get_contents('/mnt/jsondata/PainelTV/grafico-painel-tv.json');
        $DLTVFaturamento = json_decode($LTVFaturamento);
        $DLTVEvolucao = json_decode($LTVEvolucao);

        // Inserção de dados totais compras***************************
        foreach ($DLTVFaturamento as $fat) {
            $faturamento[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fat->Atualizacao)->format("Y-m-d H:i:s"),
                'Dia' => $fat->Dia,
                'Mes' => $fat->Mes,
                'Ano' => $fat->Ano,
                'MetaDia' => $fat->MetaDia,
                'MetaAlcancadaDia' => $fat->MetaAlcancadaDia,
                'VendaDia' => $fat->VendaDia,
                'PerformanceDia' => $fat->PerformanceDia,
                'DiferencaDia' => $fat->DiferencaDia,
                'MetaMes' => $fat->MetaMes,
                'VendaAlcancadaMes' => $fat->VendaAlcancadaMes,
                'MetaAlcancadaMes' => $fat->MetaAlcancadaMes,
                'VendaMes' => $fat->VendaMes,
                'PerformanceMes' => $fat->PerformanceMes,
                'MetaAcumuladaMes' => $fat->MetaAcumuladaMes,
                'DiferencaMes' => $fat->DiferencaMes,
                'MetaAcumuladaAno' => $fat->MetaAcumuladaAno,
                'VendaAlcancadaAno' => $fat->VendaAlcancadaAno,
                'VendaAno' => $fat->VendaAno,
                'PerformanceAno' => $fat->PerformanceAno,
                'DiferencaAno' => $fat->DiferencaAno,
            ];
        }
        TVFaturamento::where('id', '>', 0)->truncate();
        TVFaturamento::insert($faturamento);

        // Inserção de dados gráfico serviços***************************

        foreach ($DLTVEvolucao as $ev) {
            $evolucao[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $ev->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $ev->DiaSemana,
                'Venda' => $ev->Venda,
                'Meta' => $ev->Meta
            ];
        }
        TVEvolucao::where('id', '>', 0)->truncate();
        TVEvolucao::insert($evolucao);
    }


    /**
     * Operação de insercaao de dados no DB
     */
    public function insertData()
    {
        //$this->relResumos();
        $this->relFaturamentoLojas();
        //$this->relServicosLojas();
        $this->relComprasLojas();
        $this->analiseCreditoLojas();
        $this->relGerencialFiliais();
        $this->relGerencial();
        $this->filiaisAtivas();
        $this->appTVLojas();
    }

    public function messageError()
    {
        echo "\033[31m";
        echo '╔══════════════════════════════════════════╗' . PHP_EOL;
        echo '║  Não há dados novos a serem cadastrados! ║' . PHP_EOL;
        echo '╚══════════════════════════════════════════╝' . PHP_EOL;
        echo "\033[39m";
    }
	
	// Rotas API Gerencial filial
    
    public function getLGERFilialFatuDia($filial)
    {
        $fatudia = LGERFilialFatuDia::where('FilialId', $filial)->get();
        return json_encode($fatudia, JSON_NUMERIC_CHECK);
    }
	
	public function getLGERFilialFatuTotal($filial)
    {
        $fatutotal = LGERFilialFatuTotal::where('FilialId', $filial)->get();
        return json_encode($fatutotal, JSON_NUMERIC_CHECK);
    }

	public function getLGERFilialGrafico($filial)
	{
		$fatugrafico = LGERFilialGrafico::where('FilialId', $filial)->get();
		return json_encode($fatugrafico, JSON_NUMERIC_CHECK);
	}

	public function getLGERFilialAssoc($filial)
	{
		$fatuassoc = LGERFilialAssoc::where('FilialId', $filial)->get();
		return json_encode($fatuassoc, JSON_NUMERIC_CHECK);
	}

	public function getLGERFilialTotalAssoc($filial)
	{
		$fatuassoc = LGERFilialTotalAssoc::where('FilialId', $filial)->get();
		return json_encode($fatuassoc, JSON_NUMERIC_CHECK);
	}

	public function getLGERFilialMes($filial)
	{
		$fatumes = LGERFilialMes::where('FilialId', $filial)->get();
		return json_encode($fatumes, JSON_NUMERIC_CHECK);
	}

    // Rotas API App TV
    public function getTVFaturamento()
    {
        $faturamento = TVFaturamento::get();
        return json_encode($faturamento, JSON_NUMERIC_CHECK);
    }

    public function getTVEvolucao()
    {
        $evolucao = TVEvolucao::get();
        return json_encode($evolucao, JSON_NUMERIC_CHECK);
    }

    // Rotas API Resumos ***********************
    public function getFiliaisAtivas()
    {
        $filiais = FiliaisAtivas::get();
        return json_encode($filiais, JSON_NUMERIC_CHECK);
    }

    public function getAllFiliais($date)
    {
        $filiais = Filial::whereDate('Atualizacao', $date)->get();
        return json_encode($filiais, JSON_NUMERIC_CHECK);
    }

    public function getAllAssociacao($date)
    {
        $associacao = Assoc::whereDate('Atualizacao', $date)->get();
        return json_encode($associacao, JSON_NUMERIC_CHECK);
    }

    public function getAllExportacao($date)
    {
        $exportacao = Export::whereDate('Atualizacao', $date)->get();
        return json_encode($exportacao, JSON_NUMERIC_CHECK);
    }

    public function getAllTotais($date)
    {
        $totais = Total::whereDate('Atualizacao', $date)->get();
        return json_encode($totais, JSON_NUMERIC_CHECK);
    }

    // Rotas API Vendas Lojas ************************
    public function getAllRelFatuLojas($date)
    {
        $fatu = RelFatuLojas::whereDate('Atualizacao', $date)->get();
        return json_encode($fatu, JSON_NUMERIC_CHECK);
    }

    public function getAllRelGrafVenLojas($date)
    {
        $graf = RelGrafVenLojas::whereDate('Atualizacao', $date)->get();
        return json_encode($graf, JSON_NUMERIC_CHECK);
    }

    public function getAllRelPerfAssocVenLojas($date)
    {
        $perfassoc = RelPerfAssocVenLojas::whereDate('Atualizacao', $date)->get();
        return json_encode($perfassoc, JSON_NUMERIC_CHECK);
    }

    public function getAllRelPerfMesVenLojas($date)
    {
        $perfmes = RelPerfMesVenLojas::whereDate('Atualizacao', $date)->get();
        return json_encode($perfmes, JSON_NUMERIC_CHECK);
    }

    public function getAllRelTotFatLojas($date)
    {
        $totfatu = RelTotFatLojas::whereDate('Atualizacao', $date)->get();
        return json_encode($totfatu, JSON_NUMERIC_CHECK);
    }

    public function getAllRelTotPerfVenLojas($date)
    {
        $totperf = RelTotPerfVenLojas::whereDate('Atualizacao', $date)->get();
        return json_encode($totperf, JSON_NUMERIC_CHECK);
    }

    // Rotas API Servicos Solar ******************
    public function getLSerGrafico($date)
    {
        $sgrafico = LSerGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($sgrafico, JSON_NUMERIC_CHECK);
    }
    public function getLSerPerform($date)
    {
        $sperf = LSerPerform::whereDate('Atualizacao', $date)->get();
        return json_encode($sperf, JSON_NUMERIC_CHECK);
    }
    public function getLSerResumoDia($date)
    {
        $sresu = LSerResumoDia::whereDate('Atualizacao', $date)->get();
        return json_encode($sresu, JSON_NUMERIC_CHECK);
    }
    public function getLSerTotais($date)
    {
        $stotais = LSerTotais::whereDate('Atualizacao', $date)->get();
        return json_encode($stotais, JSON_NUMERIC_CHECK);
    }

    // Rotas API Compras Solar *******************
    public function getLComComparadia($date)
    {
        $ccomp = LComComparadia::whereDate('Atualizacao', $date)->get();
        return json_encode($ccomp, JSON_NUMERIC_CHECK);
    }
    public function getLComGrafico($date)
    {
        $cgrafico = LComGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($cgrafico, JSON_NUMERIC_CHECK);
    }
    public function getLComPerfAssoc($date)
    {
        $cassoc = LComPerfAssoc::whereDate('Atualizacao', $date)->get();
        return json_encode($cassoc, JSON_NUMERIC_CHECK);
    }
    public function getLComPerfMes($date)
    {
        $cmes = LComPerfMes::whereDate('Atualizacao', $date)->get();
        return json_encode($cmes, JSON_NUMERIC_CHECK);
    }
    public function getLComTotais($date)
    {
        $ctotais = LComTotais::whereDate('Atualizacao', $date)->get();
        return json_encode($ctotais, JSON_NUMERIC_CHECK);
    }

    // Rotas API Análise de Crediario por Filial
    public function getLAcrKpis($filial)
    {
        if ($filial > 0) :
            $lkpis = LAcredKpis::where('CodFilial', $filial)->get();
        else :
            $lkpis = LAcredKpis::get();
        endif;

        return json_encode($lkpis, JSON_NUMERIC_CHECK);
    }

    public function getLAcrGrafVencidos($filial)
    {
        $lvencidos = LAcredVencido::where('CodFilial', $filial)->get();
        return json_encode($lvencidos, JSON_NUMERIC_CHECK);
    }

    public function getLAcrGrafProjecao($filial)
    {
        $lprojecao = LAcredProjecao::where('CodFilial', $filial)->get();
        return json_encode($lprojecao, JSON_NUMERIC_CHECK);
    }

    // Rotas API Análise de Crediario Totais
    public function getLAcrKpisTotal()
    {
        $lkpist = LAcredKpisTotal::orderByDesc('uid')->get();
        return json_encode($lkpist, JSON_NUMERIC_CHECK);
    }

    public function getLAcrGrafVencidosTotal()
    {
        $lvencidost = LAcredVencidoTotal::orderByDesc('uid')->get();
        return json_encode($lvencidost, JSON_NUMERIC_CHECK);
    }

    public function getLAcrGrafProjecaoTotal()
    {
        $lprojecaot = LAcredProjecaoTotal::orderByDesc('uid')->get();
        return json_encode($lprojecaot, JSON_NUMERIC_CHECK);
    }

    // Rotas Gerencial
    public function getLGERAnaliseFiliais($filial)
    {
        $lkpisa = LGERAnaliseFiliais::where('CodFilial', $filial)->get();
        return json_encode($lkpisa, JSON_NUMERIC_CHECK);
    }

    public function getLGERConversaoFiliais()
    {
        $lvencidosc = LGERConversaoFiliais::orderByDesc('uid')->get();
        return json_encode($lvencidosc, JSON_NUMERIC_CHECK);
    }

    public function getLGERGiroEstoque($filial)
    {
        $lgiro = LGERGiroEstoque::where('CodFilial', $filial)->get();
        return json_encode($lgiro, JSON_NUMERIC_CHECK);
    }

    public function getLGERInadimplencia($filial)
    {
        $lprojecaoi = LGERInadimplencia::where('CodFilial', $filial)->get();
        return json_encode($lprojecaoi, JSON_NUMERIC_CHECK);
    }

    public function getLGERAnaliseVendedores($filial)
    {
        $lkpisa = LGERAnaliseVendedores::where('CodFilial', $filial)->get();
        return json_encode($lkpisa, JSON_NUMERIC_CHECK);
    }

    public function getLGERConversaoVendedores($filial)
    {
        $lvencidosc = LGERConversaoVendedores::where('CodFilial', $filial)->get();
        return json_encode($lvencidosc, JSON_NUMERIC_CHECK);
    }

    public function getLGERGiroSubGrupo($filial)
    {
        $lgirosubgrupo = LGERGiroSubGrupo::where('CodFilial', $filial)->get();
        return json_encode($lgirosubgrupo, JSON_NUMERIC_CHECK);
    }

    public function getLGERMargemVendedor($filial)
    {
        $lmargemv = LGERMargemVendedor::where('CodFilial', $filial)->get();
        return json_encode($lmargemv, JSON_NUMERIC_CHECK);
    }
    // Rotas API Usuários ************************
    public function listUsers()
    {
        $usuarios = User::get();
        return response()->json($usuarios);
    }

    public function listUsersAccess(Request $request)
    {
        $idfilial = $request->IdFilial;
        $access = UserAccess::where("IdFilial", $idfilial)->with('usuario')->get();
        return response()->json($access);
    }

    public function login(LoginRequest $request, User $usuario)
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

            $token = $usuario->createToken('auth_token');
            $response = [
                "sigIn" => [
                    "success" => true,
                    "message" => "Login efetuado com sucesso!",
                    "user" => [
                        "idusuario" => $code->IdUsuario,
                        "name" => $code->Name,
                        "filial" => $code->Filial,
                        "type" => $code->Type,
                        "code" => $code->Code,
                        "rule" => $code->Rule,
                        "token" => $token->plainTextToken
                    ]
                ]
            ];
            $data = [
                "IdFilial" => $code->Filial,
                "IdUsuario" => $code->IdUsuario,
                "Ip" => $request->ip()
            ];
            UserAccess::insert($data);
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
