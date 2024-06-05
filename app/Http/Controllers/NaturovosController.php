<?php

namespace App\Http\Controllers;

use App\Models\Naturovos\NRCGrafico;
use App\Models\Naturovos\NRCPerfMes;
use App\Models\Naturovos\NRCPerfTipo;
use App\Models\Naturovos\NRCTipo;
use App\Models\Naturovos\NRCTotal;
use App\Models\Naturovos\NRFatAssoc;
use App\Models\Naturovos\NRFatGrafico;
use App\Models\Naturovos\NRFatGrupo;
use App\Models\Naturovos\NRFatPerfAssoc;
use App\Models\Naturovos\NRFatPerfGrupo;
use App\Models\Naturovos\NRFatPerfMes;
use App\Models\Naturovos\NRFatPerfSetor;
use App\Models\Naturovos\NRFatSetor;
use App\Models\Naturovos\NRFatTotais;
use App\Models\Naturovos\NRResAssoc;
use App\Models\Naturovos\NRResGrafico;
use App\Models\Naturovos\NRResGrupo;
use App\Models\Naturovos\NRResTotais;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NaturovosController extends Controller
{

    public function index()
    {
        echo "Inserts";
        // return $this->relResumosNaturovos();
    }

    public function relResumosNaturovos()
    {
        $NRResAssoc = file_get_contents('/mnt/jsondata/Naturovos/Rel_resumo/relresumoassociacao.json');
        $NRResGrafico = file_get_contents('/mnt/jsondata/Naturovos/Rel_resumo/relresumografico.json');
        $NRResGrupo = file_get_contents('/mnt/jsondata/Naturovos/Rel_resumo/relresumogrupo.json');
        $NRResTotais = file_get_contents('/mnt/jsondata/Naturovos/Rel_resumo/relresumototais.json');

        $DNRResAssoc = json_decode($NRResAssoc);
        $DNRResGrafico = json_decode($NRResGrafico);
        $DNRResGrupo = json_decode($NRResGrupo);
        $DNRResTotais = json_decode($NRResTotais);

        // Inserção de dados Resumo Associação **********************************
        $dataAssoc = NRResAssoc::orderByDesc('id_associacao');
        foreach (array_slice($DNRResAssoc, 0, 1) as $rass) {
            $dataResAss = Carbon::createFromFormat("d/m/Y H:i:s", $rass->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRResAssoc as $resass) {
            $resassoc[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $resass->Atualizacao)->format("Y-m-d H:i:s"),
                'GrupoPai' => $resass->GrupoPai,
                'Associacao' => $resass->Associacao,
                'ValorMesAtual' => $resass->ValorMesAtual,
                'RepValorMesAnterior' => $resass->RepValorMesAnterior,
                'RepValorAnoAnterior' => $resass->RepValorAnoAnterior,
                'QtdMesAtual' => $resass->QtdMesAtual,
                'RepQtdMesAnterior' => $resass->RepQtdMesAnterior,
                'RepQtdAnoAnterior' => $resass->RepQtdAnoAnterior,
                'PrecMedioMesAtual' => $resass->PrecMedioMesAtual,
                'RepPrecMedioMesAnterior' => $resass->RepPrecMedioMesAnterior,
                'RepPrecMedioAnoAnterior' => $resass->RepPrecMedioAnoAnterior,
                'RepMargemAtual' => $resass->RepMargemAtual
            ];
        }

        if ($dataAssoc->count() == 0) {
            NRResAssoc::insert($resassoc);
        } else if ($dataResAss == Carbon::createFromFormat("Y-m-d H:i:s", $dataAssoc->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRResAssoc::whereDate('Atualizacao', $dataResAss)->delete();
            NRResAssoc::insert($resassoc);
        } else {
            NRResAssoc::insert($resassoc);
        }

        // Inserção de dados Resumo Gráfico **********************************
        $dataGraf = NRResGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DNRResGrafico, 0, 1) as $rgraf) {
            $dataResGraf = Carbon::createFromFormat("d/m/Y H:i:s", $rgraf->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRResGrafico as $resgraf) {
            $resgrafico[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $resgraf->Atualizacao)->format("Y-m-d H:i:s"),
                'Dia' => $resgraf->Dia,
                'MesAtual' => $resgraf->MesAtual,
                'MesAnterior' => $resgraf->MesAnterior,
                'AnoMesAtual' => $resgraf->AnoMesAtual
            ];
        }

        if ($dataGraf->count() == 0) {
            NRResGrafico::insert($resgrafico);
        } else if ($dataResGraf == Carbon::createFromFormat("Y-m-d H:i:s", $dataGraf->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRResGrafico::whereDate('Atualizacao', $dataResGraf)->delete();
            NRResGrafico::insert($resgrafico);
        } else {
            NRResGrafico::insert($resgrafico);
        }

        // Inserção de dados Resumo Grupo **********************************
        $dataGrupo = NRResGrupo::orderByDesc('id_grupo');
        foreach (array_slice($DNRResGrupo, 0, 1) as $rgrupo) {
            $dataResGrupo = Carbon::createFromFormat("d/m/Y H:i:s", $rgrupo->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRResGrupo as $resgrup) {
            $resgrupo[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $resgrup->Atualizacao)->format("Y-m-d H:i:s"),
                'Grupo' => $resgrup->Grupo,
                'ValorMesAtual' => $resgrup->ValorMesAtual,
                'RepValorMesAnterior' => $resgrup->RepValorMesAnterior,
                'RepValorAnoAnterior' => $resgrup->RepValorAnoAnterior,
                'QtdMesAtual' => $resgrup->QtdMesAtual,
                'RepQtdMesAnterior' => $resgrup->RepQtdMesAnterior,
                'RepQtdAnoAnterior' => $resgrup->RepQtdAnoAnterior,
                'PrecMedioMesAtual' => $resgrup->PrecMedioMesAtual,
                'RepPrecMedioMesAnterior' => $resgrup->RepPrecMedioMesAnterior,
                'RepPrecMedioAnoAnterior' => $resgrup->RepPrecMedioAnoAnterior,
                'RepMargemAtual' => $resgrup->RepMargemAtual
            ];
        }

        if ($dataGrupo->count() == 0) {
            NRResGrupo::insert($resgrupo);
        } else if ($dataResGrupo == Carbon::createFromFormat("Y-m-d H:i:s", $dataGrupo->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRResGrupo::whereDate('Atualizacao', $dataResGrupo)->delete();
            NRResGrupo::insert($resgrupo);
        } else {
            NRResGrupo::insert($resgrupo);
        }

        // Inserção de dados Resumo Totais **********************************
        $dataTotais = NRResTotais::orderByDesc('id_totais');
        foreach (array_slice($DNRResTotais, 0, 1) as $rtotais) {
            $dataResTotais = Carbon::createFromFormat("d/m/Y H:i:s", $rtotais->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRResTotais as $restot) {
            $restotais[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $restot->Atualizacao)->format("Y-m-d H:i:s"),
                'ValorMesAtual' => $restot->ValorMesAtual,
                'RotValorMesAtual' => $restot->RotValorMesAtual,
                'ValRepValorMesAnterior' => $restot->ValRepValorMesAnterior,
                'RotRepValorMesAnterior' => $restot->RotRepValorMesAnterior,
                'ValRepValorAnoAnterior' => $restot->ValRepValorAnoAnterior,
                'RotRepValorAnoAnterior' => $restot->RotRepValorAnoAnterior,
                'ValQtdMesAtual' => $restot->ValQtdMesAtual,
                'RotQtdMesAtual' => $restot->RotQtdMesAtual,
                'ValRepQtdMesAnterior' => $restot->ValRepQtdMesAnterior,
                'RotRepQtdMesAnterior' => $restot->RotRepQtdMesAnterior,
                'ValRepQtdAnoAnterior' => $restot->ValRepQtdAnoAnterior,
                'RotRepQtdAnoAnterior' => $restot->RotRepQtdAnoAnterior,
                'RotPrecMedioMesAtual' => $restot->RotPrecMedioMesAtual,
                'RotRepPrecMedioMesAnterior' => $restot->RotRepPrecMedioMesAnterior,
                'RotPrecMedioAnoAnterior' => $restot->RotPrecMedioAnoAnterior,
                'ValMargemAtual' => $restot->ValMargemAtual,
                'RotMargemAtual' => $restot->RotMargemAtual,
                'ProjecaoFaturamento' => $restot->ProjecaoFaturamento,
                'TituloProjecao' => $restot->TituloProjecao,
                'DifMesAntAtual' => $restot->DifMesAntAtual,
                'TituloDif' => $restot->TituloDif,
                'TituloGrafico' => $restot->TituloGrafico,
                'RotuloGrafMesAnoAtual' => $restot->RotuloGrafMesAnoAtual,
                'RotuloGrafMesAnterAnoAtual' => $restot->RotuloGrafMesAnterAnoAtual,
                'RotuloGrafAnoAnter' => $restot->RotuloGrafAnoAnter
            ];
        }

        if ($dataTotais->count() == 0) {
            NRResTotais::insert($restotais);
        } else if ($dataResTotais == Carbon::createFromFormat("Y-m-d H:i:s", $dataTotais->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRResTotais::whereDate('Atualizacao', $dataResTotais)->delete();
            NRResTotais::insert($restotais);
        } else {
            NRResTotais::insert($restotais);
        }

    }

    public function relComprasNaturovos()
    {
        // Relatórios servicos Json Naturovos Solar*******************************************************
        $NRCTipo = file_get_contents('/mnt/jsondata/Naturovos/Rel_compras/relcomprastipo.json');
        $NRCPerfTipo = file_get_contents('/mnt/jsondata/Naturovos/Rel_compras/relcomprasperftipo.json');
        $NRCGrafico = file_get_contents('/mnt/jsondata/Naturovos/Rel_compras/relcomprasgrafico.json');
        $NRCPerfMes = file_get_contents('/mnt/jsondata/Naturovos/Rel_compras/relcomprasferfmes.json');
        $NRCTotal = file_get_contents('/mnt/jsondata/Naturovos/Rel_compras/relcomprastotais.json');

        $DNRCTipo = json_decode($NRCTipo);
        $DNRCPerfTipo = json_decode($NRCPerfTipo);
        $DNRCGrafico = json_decode($NRCGrafico);
        $DNRCPerfMes = json_decode($NRCPerfMes);
        $DNRCTotal = json_decode($NRCTotal);

        // Inserção de dados compras Tipo***************************
        $dataTipo = NRCTipo::orderByDesc('id_tipo');
        foreach (array_slice($DNRCTipo, 0, 1) as $ctp) {
            $dataCompT = Carbon::createFromFormat("d/m/Y H:i:s", $ctp->Atualizacao)->format("Y-m-d");
        }

        foreach ($DNRCTipo as $ct) {
            $comtipo[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $ct->Atualizacao)->format("Y-m-d H:i:s"),
                'MateriaPrima' => $ct->MateriaPrima,
                'CompraDia' => $ct->CompraDia,
                'CompraSemana' => $ct->CompraSemana,
                'CompraMes' => $ct->CompraMes,
                'RepTotal' => $ct->RepTotal,
                'RepAno' => $ct->RepAno,
                'PrecoMedio' => $ct->PrecoMedio,
                'RepPrecoMedio' => $ct->RepPrecoMedio
            ];
        }

        if ($dataTipo->count() == 0) {
            NRCTipo::insert($comtipo);
        } else if ($dataCompT == Carbon::createFromFormat("Y-m-d H:i:s", $dataTipo->first()->Atualizacao)->format("Y-m-d")) {
            NRCTipo::whereDate('Atualizacao', $dataCompT)->delete();
            NRCTipo::insert($comtipo);
        } else {
            NRCTipo::insert($comtipo);
        }

        // Inserção de dados compras Performance Tipo***************************
        $dataPerfTipo = NRCPerfTipo::orderByDesc('id_tipo');
        foreach (array_slice($DNRCPerfTipo, 0, 1) as $ctpp) {
            $dataCompT = Carbon::createFromFormat("d/m/Y H:i:s", $ctpp->Atualizacao)->format("Y-m-d");
        }

        foreach ($DNRCPerfTipo as $cpt) {
            $compertipo[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $cpt->Atualizacao)->format("Y-m-d H:i:s"),
                'MateriaPrima' => $cpt->MateriaPrima,
                'Compra' => $cpt->Compra,
                'RepTotal' => $cpt->RepTotal,
                'PrecoMedio' => $cpt->PrecoMedio,
                'CompraEC' => $cpt->CompraEC,
                'RepTotalEC' => $cpt->RepTotalEC,
                'PrecoMedioEC' => $cpt->PrecoMedioEC
            ];
        }

        if ($dataPerfTipo->count() == 0) {
            NRCPerfTipo::insert($compertipo);
        } else if ($dataCompT == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfTipo->first()->Atualizacao)->format("Y-m-d")) {
            NRCPerfTipo::whereDate('Atualizacao', $dataCompT)->delete();
            NRCPerfTipo::insert($compertipo);
        } else {
            NRCPerfTipo::insert($compertipo);
        }

        // Inserção de dados compras Gráfico***************************
        $dataPerfGrafico = NRCGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DNRCGrafico, 0, 1) as $cgf) {
            $dataCompG = Carbon::createFromFormat("d/m/Y H:i:s", $cgf->Atualizacao)->format("Y-m-d");
        }

        foreach ($DNRCGrafico as $cpg) {
            $compgraf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $cpg->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $cpg->DiaSemana,
                'Compras' => $cpg->Compras
            ];
        }

        if ($dataPerfGrafico->count() == 0) {
            NRCGrafico::insert($compgraf);
        } else if ($dataCompG == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfGrafico->first()->Atualizacao)->format("Y-m-d")) {
            NRCGrafico::whereDate('Atualizacao', $dataCompG)->delete();
            NRCGrafico::insert($compgraf);
        } else {
            NRCGrafico::insert($compgraf);
        }

        // Inserção de dados compras Performance Mês***************************
        $dataPerfMes = NRCPerfMes::orderByDesc('id_mes');
        foreach (array_slice($DNRCPerfMes, 0, 1) as $cpm) {
            $dataPerfM = Carbon::createFromFormat("d/m/Y H:i:s", $cpm->Atualizacao)->format("Y-m-d");
        }

        foreach ($DNRCPerfMes as $cpg) {
            $comperfmes[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $cpg->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $cpg->AnoMesNum,
                'MesAno' => $cpg->MesAno,
                'Media' => $cpg->Media,
                'RepTotal' => $cpg->RepTotal
            ];
        }

        if ($dataPerfMes->count() == 0) {
            NRCPerfMes::insert($comperfmes);
        } else if ($dataPerfM == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfMes->first()->Atualizacao)->format("Y-m-d")) {
            NRCPerfMes::whereDate('Atualizacao', $dataPerfM)->delete();
            NRCPerfMes::insert($comperfmes);
        } else {
            NRCPerfMes::insert($comperfmes);
        }

        // Inserção de dados compras Total***************************
        $dataTotal = NRCTotal::orderByDesc('id_totais');
        foreach (array_slice($DNRCTotal, 0, 1) as $cpt) {
            $dttotal = Carbon::createFromFormat("d/m/Y H:i:s", $cpt->Atualizacao)->format("Y-m-d");
        }

        foreach ($DNRCTotal as $cpto) {
            $comptotal[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $cpto->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaAtual' => $cpto->DiaAtual,
                'ComCompraDia' => $cpto->ComCompraDia,
                'ComCompraSemana' => $cpto->ComCompraSemana,
                'ComCompraMes' => $cpto->ComCompraMes,
                'ComRepTotal' => $cpto->ComRepTotal,
                'MesMedia' => $cpto->MesMedia,
                'MesRepTotal' => $cpto->MesRepTotal,
                'PerCompra' => $cpto->PerCompra,
                'PerRepTotal' => $cpto->PerRepTotal,
                'PerCompraEC' => $cpto->PerCompraEC,
                'PerRepTotalEC' => $cpto->PerRepTotalEC
            ];
        }

        if ($dataTotal->count() == 0) {
            NRCTotal::insert($comptotal);
        } else if ($dttotal == Carbon::createFromFormat("Y-m-d H:i:s", $dataTotal->first()->Atualizacao)->format("Y-m-d")) {
            NRCTotal::whereDate('Atualizacao', $dttotal)->delete();
            NRCTotal::insert($comptotal);
        } else {
            NRCTotal::insert($comptotal);
        }
        
    }

    public function relFaturamentoNaturovos()
    {
        $NRFatSetor = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentosetor.json');
        $NRFatGrupo = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentogrupo.json');
        $NRFatAssoc = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentoassociacao.json');
        $NRFatGrafico = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentografico.json');
        $NRFatPerfMes = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentoperfmes.json');
        $NRFatPerfSetor = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentoperfsetor.json');
        $NRFatPerfGrupo = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentoperfgrupo.json');
        $NRFatPerfAssoc = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentoperfassociacao.json');
        $NRFatTotais = file_get_contents('/mnt/jsondata/Naturovos/Rel_faturamento/relfaturamentototais.json');

        $DNRFatSetor = json_decode($NRFatSetor);
        $DNRFatGrupo = json_decode($NRFatGrupo);
        $DNRFatAssoc = json_decode($NRFatAssoc);
        $DNRFatGrafico = json_decode($NRFatGrafico);
        $DNRFatPerfMes = json_decode($NRFatPerfMes);
        $DNRFatPerfSetor = json_decode($NRFatPerfSetor);
        $DNRFatPerfGrupo = json_decode($NRFatPerfGrupo);
        $DNRFatPerfAssoc = json_decode($NRFatPerfAssoc);
        $DNRFatTotais = json_decode($NRFatTotais);

        // dd($DNRFatPerfMes);

        // Inserção de dados faturamento Setor **********************************
        $dataSetor = NRFatSetor::orderByDesc('id_setor');
        foreach (array_slice($DNRFatSetor, 0, 1) as $fatset) {
            $dataFatus = Carbon::createFromFormat("d/m/Y H:i:s", $fatset->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatSetor as $fatus) {
            $fats[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatus->Atualizacao)->format("Y-m-d H:i:s"),
                'Setor' => $fatus->Setor,
                'VendaDia' => $fatus->VendaDia,
                'MargemDia' => $fatus->MargemDia,
                'VendaSemana' => $fatus->VendaSemana,
                'MargemSemana' => $fatus->MargemSemana,
                'VendaMes' => $fatus->VendaMes,
                'MargemMes' => $fatus->MargemMes,
                'RepTotal' => $fatus->RepTotal,
                'RepAno' => $fatus->RepAno,
                'PrecoMedio' => $fatus->PrecoMedio,
                'RepPrecoMedio' => $fatus->RepPrecoMedio,
                'PrecoMedioKg' => $fatus->PrecoMedioKg,
                'RepPrecoMedioKg' => $fatus->RepPrecoMedioKg
            ];
        }

        if ($dataSetor->count() == 0) {
            NRFatSetor::insert($fats);
        } else if ($dataFatus == Carbon::createFromFormat("Y-m-d H:i:s", $dataSetor->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatSetor::whereDate('Atualizacao', $dataFatus)->delete();
            NRFatSetor::insert($fats);
        } else {
            NRFatSetor::insert($fats);
        }

        // Inserção de dados faturamento Grupo **********************************
        $dataGrupo = NRFatGrupo::orderByDesc('id_grupo');
        foreach (array_slice($DNRFatGrupo, 0, 1) as $fatgru) {
            $dataFatug = Carbon::createFromFormat("d/m/Y H:i:s", $fatgru->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatGrupo as $fatug) {
            $fatg[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatug->Atualizacao)->format("Y-m-d H:i:s"),
                'Setor' => $fatug->Setor,
                'Grupo' => $fatug->Grupo,
                'VendaDia' => $fatug->VendaDia,
                'MargemDia' => $fatug->MargemDia,
                'VendaSemana' => $fatug->VendaSemana,
                'MargemSemana' => $fatug->MargemSemana,
                'VendaMes' => $fatug->VendaMes,
                'MargemMes' => $fatug->MargemMes,
                'RepTotal' => $fatug->RepTotal,
                'RepAno' => $fatug->RepAno,
                'PrecoMedio' => $fatug->PrecoMedio,
                'RepPrecoMedio' => $fatug->RepPrecoMedio,
                'PrecoMedioKg' => $fatug->PrecoMedioKg,
                'RepPrecoMedioKg' => $fatug->RepPrecoMedioKg
            ];
        }

        if ($dataGrupo->count() == 0) {
            NRFatGrupo::insert($fatg);
        } else if ($dataFatug == Carbon::createFromFormat("Y-m-d H:i:s", $dataGrupo->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatGrupo::whereDate('Atualizacao', $dataFatug)->delete();
            NRFatGrupo::insert($fatg);
        } else {
            NRFatGrupo::insert($fatg);
        }

        // Inserção de dados faturamento Associação **********************************
        $dataAssoc = NRFatAssoc::orderByDesc('id_associacao');
        foreach (array_slice($DNRFatAssoc, 0, 1) as $fatgru) {
            $dataFatua = Carbon::createFromFormat("d/m/Y H:i:s", $fatgru->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatAssoc as $fatua) {
            $fata[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatua->Atualizacao)->format("Y-m-d H:i:s"),
                'Grupo' => $fatua->Grupo,
                'Associacao' => $fatua->Associacao,
                'VendaDia' => $fatua->VendaDia,
                'MargemDia' => $fatua->MargemDia,
                'VendaSemana' => $fatua->VendaSemana,
                'MargemSemana' => $fatua->MargemSemana,
                'VendaMes' => $fatua->VendaMes,
                'MargemMes' => $fatua->MargemMes,
                'RepTotal' => $fatua->RepTotal,
                'RepAno' => $fatua->RepAno,
                'PrecoMedio' => $fatua->PrecoMedio,
                'RepPrecoMedio' => $fatua->RepPrecoMedio,
                'PrecoMedioKg' => $fatua->PrecoMedioKg,
                'RepPrecoMedioKg' => $fatua->RepPrecoMedioKg
            ];
        }

        if ($dataAssoc->count() == 0) {
            NRFatAssoc::insert($fata);
        } else if ($dataFatua == Carbon::createFromFormat("Y-m-d H:i:s", $dataAssoc->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatAssoc::whereDate('Atualizacao', $dataFatua)->delete();
            NRFatAssoc::insert($fata);
        } else {
            NRFatAssoc::insert($fata);
        }

        // Inserção de dados faturamento Gráfico **********************************
        $dataGrafico = NRFatGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DNRFatGrafico, 0, 1) as $fatgra) {
            $dataFatg = Carbon::createFromFormat("d/m/Y H:i:s", $fatgra->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatGrafico as $fatua) {
            $fatgraf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatua->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $fatua->DiaSemana,
                'Vendas' => $fatua->Vendas,
                'Margem' => $fatua->Margem
            ];
        }

        if ($dataGrafico->count() == 0) {
            NRFatGrafico::insert($fatgraf);
        } else if ($dataFatg == Carbon::createFromFormat("Y-m-d H:i:s", $dataGrafico->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatGrafico::whereDate('Atualizacao', $dataFatg)->delete();
            NRFatGrafico::insert($fatgraf);
        } else {
            NRFatGrafico::insert($fatgraf);
        }

        // Inserção de dados faturamento Performance Mês **********************************
        $dataPerfMes = NRFatPerfMes::orderByDesc('id_mes');
        foreach (array_slice($DNRFatPerfMes, 0, 1) as $fatpm) {
            $dataFatg = Carbon::createFromFormat("d/m/Y H:i:s", $fatpm->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatPerfMes as $fatperf) {
            $fatperfmes[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatperf->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $fatperf->AnoMesNum,
                'MesAno' => $fatperf->MesAno,
                'Faturamento' => $fatperf->Faturamento,
                'Margem' => $fatperf->Margem,
                'RepTotal' => $fatperf->RepTotal,
                'PrecoMedioKg' => $fatperf->PrecoMedioKg
            ];
        }

        if ($dataPerfMes->count() == 0) {
            NRFatPerfMes::insert($fatperfmes);
        } else if ($dataFatg == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfMes->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatPerfMes::whereDate('Atualizacao', $dataFatg)->delete();
            NRFatPerfMes::insert($fatperfmes);
        } else {
            NRFatPerfMes::insert($fatperfmes);
        }

        // Inserção de dados faturamento Performance Setor **********************************
        $dataPerfSetor = NRFatPerfSetor::orderByDesc('id_setor');
        foreach (array_slice($DNRFatPerfSetor, 0, 1) as $fatst) {
            $dataFatSet = Carbon::createFromFormat("d/m/Y H:i:s", $fatst->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatPerfSetor as $fatps) {
            $fatperfset[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatps->Atualizacao)->format("Y-m-d H:i:s"),
                'Setor' => $fatps->Setor,
                'Faturamento' => $fatps->Faturamento,
                'Margem' => $fatps->Margem,
                'RepTotal' => $fatps->RepTotal,
                'PrecoMedio' => $fatps->PrecoMedio,
                'PrecoMedioKg' => $fatps->PrecoMedioKg,
                'FaturamentoEC' => $fatps->FaturamentoEC,
                'RepEC' => $fatps->RepEC,
                'MargemEC' => $fatps->MargemEC
            ];
        }

        if ($dataPerfSetor->count() == 0) {
            NRFatPerfSetor::insert($fatperfset);
        } else if ($dataFatSet == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfSetor->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatPerfSetor::whereDate('Atualizacao', $dataFatSet)->delete();
            NRFatPerfSetor::insert($fatperfset);
        } else {
            NRFatPerfSetor::insert($fatperfset);
        }

        // Inserção de dados faturamento Performance Grupo **********************************
        $dataPerfGrupo = NRFatPerfGrupo::orderByDesc('id_grupo');
        foreach (array_slice($DNRFatPerfGrupo, 0, 1) as $fatgp) {
            $dataFatGru = Carbon::createFromFormat("d/m/Y H:i:s", $fatgp->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatPerfGrupo as $fatgr) {
            $fatpergrupo[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatgr->Atualizacao)->format("Y-m-d H:i:s"),
                'Setor' => $fatgr->Setor,
                'Grupo' => $fatgr->Grupo,
                'Faturamento' => $fatgr->Faturamento,
                'Margem' => $fatgr->Margem,
                'RepTotal' => $fatgr->RepTotal,
                'PrecoMedio' => $fatgr->PrecoMedio,
                'PrecoMedioKg' => $fatgr->PrecoMedioKg,
                'FaturamentoEC' => $fatgr->FaturamentoEC,
                'RepEC' => $fatgr->RepEC,
                'MargemEC' => $fatgr->MargemEC
            ];
        }

        if ($dataPerfGrupo->count() == 0) {
            NRFatPerfGrupo::insert($fatpergrupo);
        } else if ($dataFatGru == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfGrupo->first()->Atualizacao)->format("Y-m-d")) {
            NRFatPerfGrupo::whereDate('Atualizacao', $dataFatGru)->delete();
            NRFatPerfGrupo::insert($fatpergrupo);
        } else {
            NRFatPerfGrupo::insert($fatpergrupo);
        }

        // Inserção de dados faturamento Performance Associação **********************************
        $dataPerfAssoc = NRFatPerfAssoc::orderByDesc('id_associacao');
        foreach (array_slice($DNRFatPerfAssoc, 0, 1) as $fatas) {
            $dataFatAssoc = Carbon::createFromFormat("d/m/Y H:i:s", $fatas->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatPerfAssoc as $fatasso) {
            $fatperfassooc[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $fatasso->Atualizacao)->format("Y-m-d H:i:s"),
                'Grupo' => $fatasso->Grupo,
                'Associacao' => $fatasso->Associacao,
                'Faturamento' => $fatasso->Faturamento,
                'Margem' => $fatasso->Margem,
                'RepTotal' => $fatasso->RepTotal,
                'PrecoMedio' => $fatasso->PrecoMedio,
                'PrecoMedioKg' => $fatasso->PrecoMedioKg,
                'FaturamentoEC' => $fatasso->FaturamentoEC,
                'RepEC' => $fatasso->RepEC,
                'MargemEC' => $fatasso->MargemEC
            ];
        }

        if ($dataPerfAssoc->count() == 0) {
            NRFatPerfAssoc::insert($fatperfassooc);
        } else if ($dataFatAssoc == Carbon::createFromFormat("Y-m-d H:i:s", $dataPerfAssoc->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatPerfAssoc::whereDate('Atualizacao', $dataFatAssoc)->delete();
            NRFatPerfAssoc::insert($fatperfassooc);
        } else {
            NRFatPerfAssoc::insert($fatperfassooc);
        }

        // Inserção de dados faturamento Performance Totais **********************************
        $dataFatTotais = NRFatTotais::orderByDesc('id_totais');
        foreach (array_slice($DNRFatTotais, 0, 1) as $fatot) {
            $dataFatotais = Carbon::createFromFormat("d/m/Y H:i:s", $fatot->Atualizacao)->format("Y-m-d");
        }
        foreach ($DNRFatTotais as $ft) {
            $fatotais[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $ft->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaAtual' => $ft->DiaAtual,
                'DiaVendaDia' => $ft->DiaVendaDia,
                'DiaMargemDia' => $ft->DiaMargemDia,
                'DiaVendaSemana' => $ft->DiaVendaSemana,
                'DiaMargemSemana' => $ft->DiaMargemSemana,
                'DiaVendaMes' => $ft->DiaVendaMes,
                'DiaMargemMes' => $ft->DiaMargemMes,
                'DiaRepTotal' => $ft->DiaRepTotal,
                'PMesFaturamento' => $ft->PMesFaturamento,
                'PMesMargem' => $ft->PMesMargem,
                'PMesRepTotal' => $ft->PMesRepTotal,
                'PMesPrecoMedioKg' => $ft->PMesPrecoMedioKg,
                'PAssFaturamento' => $ft->PAssFaturamento,
                'PAssMargem' => $ft->PAssMargem,
                'PAssRepTotal' => $ft->PAssRepTotal,
                'PAssPrecoMedioKg' => $ft->PAssPrecoMedioKg,
                'PAssFaturamentoEC' => $ft->PAssFaturamentoEC,
                'PAssRepEC' => $ft->PAssRepEC,
                'PAssMargemEC' => $ft->PAssMargemEC,
                'MediaDia' => $ft->MediaDia
            ];
        }

        if ($dataFatTotais->count() == 0) {
            NRFatTotais::insert($fatotais);
        } else if ($dataFatotais == Carbon::createFromFormat("Y-m-d H:i:s", $dataFatTotais->first()->Atualizacao)->format("Y-m-d")) {
            //$this->messageError('filiais');
            NRFatTotais::whereDate('Atualizacao', $dataFatotais)->delete();
            NRFatTotais::insert($fatotais);
        } else {
            NRFatTotais::insert($fatotais);
        }
    }

    /**
     * Operação de insercaao de dados no DB
     */
    public function insertData()
    {
        $this->relComprasNaturovos();
        $this->relFaturamentoNaturovos();
        $this->relResumosNaturovos();
    }

    // APIs de retorno de dados Naturovos *****************************
    // relatórios de faturamento
    public function getNRFatAssoc($date) {
        $fassoc = NRFatAssoc::whereDate('Atualizacao', $date)->get();
        return json_encode($fassoc, JSON_NUMERIC_CHECK);
    }

    public function getNRFatGrafico($date) {
        $fgrafico = NRFatGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($fgrafico, JSON_NUMERIC_CHECK);
    }

    public function getNRFatGrupo($date) {
        $fgrupo = NRFatGrupo::whereDate('Atualizacao', $date)->get();
        return json_encode($fgrupo, JSON_NUMERIC_CHECK);
    }

    public function getNRFatPerfAssoc($date) {
        $fpassoc = NRFatPerfAssoc::whereDate('Atualizacao', $date)->get();
        return json_encode($fpassoc, JSON_NUMERIC_CHECK);
    }

    public function getNRFatPerfGrupo($date) {
        $fpgrupo = NRFatPerfGrupo::whereDate('Atualizacao', $date)->get();
        return json_encode($fpgrupo, JSON_NUMERIC_CHECK);
    }

    public function getNRFatPerfMes($date) {
        $fpmes = NRFatPerfMes::whereDate('Atualizacao', $date)->get();
        return json_encode($fpmes, JSON_NUMERIC_CHECK);
    }

    public function getNRFatPerfSetor($date) {
        $fpsetor = NRFatPerfSetor::whereDate('Atualizacao', $date)->get();
        return json_encode($fpsetor, JSON_NUMERIC_CHECK);
    }

    public function getNRFatSetor($date) {
        $fsetor = NRFatSetor::whereDate('Atualizacao', $date)->get();
        return json_encode($fsetor, JSON_NUMERIC_CHECK);
    }

    public function getNRFatTotais($date) {
        $ftot = NRFatTotais::whereDate('Atualizacao', $date)->get();
        return json_encode($ftot, JSON_NUMERIC_CHECK);
    }

    // Relatórios de compras
    public function getNRCTipo($date) {
        $ctipo = NRCTipo::whereDate('Atualizacao', $date)->get();
        return json_encode($ctipo, JSON_NUMERIC_CHECK);
    }

    public function getNRCPerfTipo($date) {
        $cptipo = NRCPerfTipo::whereDate('Atualizacao', $date)->get();
        return json_encode($cptipo, JSON_NUMERIC_CHECK);
    }

    public function getNRCGrafico($date) {
        $cgrafico = NRCGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($cgrafico, JSON_NUMERIC_CHECK);
    }

    public function getNRCPerfMes($date) {
        $cpmes = NRCPerfMes::whereDate('Atualizacao', $date)->get();
        return json_encode($cpmes, JSON_NUMERIC_CHECK);
    }

    public function getNRCTotal($date) {
        $ctotal = NRCTotal::whereDate('Atualizacao', $date)->get();
        return json_encode($ctotal, JSON_NUMERIC_CHECK);
    }

    // Relatórios Resumos
    public function getNRResAssoc($date) {
        $rassoc = NRResAssoc::whereDate('Atualizacao', $date)->get();
        return json_encode($rassoc, JSON_NUMERIC_CHECK);
    }
    
    public function getNRResGrupo($date) {
        $rgrupo = NRResGrupo::whereDate('Atualizacao', $date)->get();
        return json_encode($rgrupo, JSON_NUMERIC_CHECK);
    }
    
    public function getNRResGrafico($date) {
        $rgrafico = NRResGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($rgrafico, JSON_NUMERIC_CHECK);
    }
    
    public function getNRResTotais($date) {
        $rtotais = NRResTotais::whereDate('Atualizacao', $date)->get();
        return json_encode($rtotais, JSON_NUMERIC_CHECK);
    }

}
