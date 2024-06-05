<?php

namespace App\Http\Controllers;

use App\Models\Supermercados\SRComComparativo;
use App\Models\Supermercados\SRComGrafico;
use App\Models\Supermercados\SRComPerfAssoc;
use App\Models\Supermercados\SRComPerfMes;
use App\Models\Supermercados\SRComTotais;
use App\Models\Supermercados\SRFatComparativo;
use App\Models\Supermercados\SRFatGrafico;
use App\Models\Supermercados\SRFatPerfAssoc;
use App\Models\Supermercados\SRFatPerfMes;
use App\Models\Supermercados\SRFatTotais;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SupermercadosController extends Controller
{
    public function index()
    {
        echo 'Supermercados';
        $this->relComprasSupermercados();
        // $this->relFaturamentoSupermercados();
    }

    public function relComprasSupermercados()
    {

        $SRComComparativo = file_get_contents('/mnt/jsondata/Supermercados/Rel_Compras/relcomprascomparativo.json');
        $SRComGrafico = file_get_contents('/mnt/jsondata/Supermercados/Rel_Compras/relcomprasgrafico.json');
        $SRComPerfAssoc = file_get_contents('/mnt/jsondata/Supermercados/Rel_Compras/relcomprasperfassoc.json');
        $SRComPerfMes = file_get_contents('/mnt/jsondata/Supermercados/Rel_Compras/relcomprasperfmes.json');
        $SRComTotais = file_get_contents('/mnt/jsondata/Supermercados/Rel_Compras/relcomprastotais.json');

        $DSRComComparativo = json_decode($SRComComparativo);
        $DSRComGrafico = json_decode($SRComGrafico);
        $DSRComPerfAssoc = json_decode($SRComPerfAssoc);
        $DSRComPerfMes = json_decode($SRComPerfMes);
        $DSRComTotais = json_decode($SRComTotais);

        // Inserção de dados compras Performance Totais **********************************
        $datatotais = SRComTotais::orderByDesc('id_totais');
        foreach (array_slice($DSRComTotais, 0, 1) as $comtot) {
            $datatot = Carbon::createFromFormat("d/m/Y H:i:s", $comtot->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRComTotais as $vc) {
            $comtotal[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $vc->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaAtual' => $vc->DiaAtual,
                'DiaAnterior' => $vc->DiaAnterior,
                'CompraDia' => $vc->CompraDia,
                'CompraAnterior' => $vc->CompraAnterior,
                'CompraSemana' => $vc->CompraSemana,
                'CompraMes' => $vc->CompraMes,
                'RepMes' => $vc->RepMes == '-' ? 0 : $vc->RepMes,
                'PrazoMedio' => $vc->PrazoMedio,
                'MediaCompraPerfMes' => $vc->MediaCompraPerfMes,
                'RepPerfMes' => $vc->RepPerfMes == '-' ? 0 : $vc->RepPerfMes,
                'PrazoMedioPerfMes' => $vc->PrazoMedioPerfMes,
                'ComprasPerfAssoc' => $vc->ComprasPerfAssoc,
                'RepPerfAssoc' => $vc->RepPerfAssoc == '-' ? 0 : $vc->RepPerfAssoc,
                'PrazoMedioPerfAssoc' => $vc->PrazoMedioPerfAssoc
            ];
        }

        if ($datatotais->count() == 0) {
            SRComTotais::insert($comtotal);
        } else if ($datatot == Carbon::createFromFormat("Y-m-d H:i:s", $datatotais->first()->Atualizacao)->format("Y-m-d")) {
            SRComTotais::whereDate('Atualizacao', $datatot)->delete();
            SRComTotais::insert($comtotal);
        } else {
            SRComTotais::insert($comtotal);
        }


        // Inserção de dados compras Performance Mês **********************************
        $datapermes = SRComPerfMes::first();
		if (count($DSRComPerfMes) > 0) {
        foreach (array_slice($DSRComPerfMes, 0, 1) as $compme) {
            $dataperme = Carbon::createFromFormat("d/m/Y H:i:s", $compme->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRComPerfMes as $permes) {
            $compmes[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $permes->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $permes->AnoMesNum,
                'MesAno' => $permes->MesAno,
                'MediaCompra' => $permes->MediaCompra,
                'Rep' => $permes->Rep,
                'PrazoMedio' => $permes->PrazoMedio
            ];
        }

        if ($datapermes->count() == 0) {
            SRComPerfMes::insert($compmes);
        } else if ($dataperme == Carbon::createFromFormat("Y-m-d H:i:s", $datapermes->first()->Atualizacao)->format("Y-m-d")) {
            SRComPerfMes::whereDate('Atualizacao', $dataperme)->delete();
            SRComPerfMes::insert($compmes);
        } else {
            SRComPerfMes::insert($compmes);
        }
		}
        // Inserção de dados compras Performance Associação **********************************
        $dataperfassoc = SRComPerfAssoc::orderByDesc('id_perfassoc');
        foreach (array_slice($DSRComPerfAssoc, 0, 1) as $compas) {
            $dataperass = Carbon::createFromFormat("d/m/Y H:i:s", $compas->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRComPerfAssoc as $perassoc) {
            $compassoc[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $perassoc->Atualizacao)->format("Y-m-d H:i:s"),
                'Associacao' => $perassoc->Associacao,
                'Compras' => $perassoc->Compras,
                'Rep' => $perassoc->Rep == '-' ? 0 : $perassoc->Rep,
                'PrazoMedio' => $perassoc->PrazoMedio
            ];
        }

        if ($dataperfassoc->count() == 0) {
            SRComPerfAssoc::insert($compassoc);
        } else if ($dataperass == Carbon::createFromFormat("Y-m-d H:i:s", $dataperfassoc->first()->Atualizacao)->format("Y-m-d")) {
            SRComPerfAssoc::whereDate('Atualizacao', $dataperass)->delete();
            SRComPerfAssoc::insert($compassoc);
        } else {
            SRComPerfAssoc::insert($compassoc);
        }

        // Inserção de dados faturamento Gráfico **********************************
        $dataGraf = SRComGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DSRComGrafico, 0, 1) as $cmg) {
            $datagrf = Carbon::createFromFormat("d/m/Y H:i:s", $cmg->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRComGrafico as $graf) {
            $fatgraf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $graf->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $graf->DiaSemana,
                'Compras' => $graf->Compras,
            ];
        }

        if ($dataGraf->count() == 0) {
            SRComGrafico::insert($fatgraf);
        } else if ($datagrf == Carbon::createFromFormat("Y-m-d H:i:s", $dataGraf->first()->Atualizacao)->format("Y-m-d")) {
            SRComGrafico::whereDate('Atualizacao', $datagrf)->delete();
            SRComGrafico::insert($fatgraf);
        } else {
            SRComGrafico::insert($fatgraf);
        }

        // Inserção de dados compras Comparativo **********************************
        $dataComp = SRComComparativo::orderByDesc('id_comparativo');
        foreach (array_slice($DSRComComparativo, 0, 1) as $fatset) {
            $dataComps = Carbon::createFromFormat("d/m/Y H:i:s", $fatset->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRComComparativo as $comp) {
            $ccomp[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $comp->Atualizacao)->format("Y-m-d H:i:s"),
                'Associacao' => $comp->Associacao,
                'CompraDia' => $comp->CompraDia,
                'CompraAnterior' => $comp->CompraAnterior,
                'CompraSemana' => $comp->CompraSemana,
                'CompraMes' => $comp->CompraMes,
                'RepMes' => $comp->RepMes,
                'RepAno' => $comp->RepAno,
                'PrazoMedio' => $comp->PrazoMedio,
                'PrazoMedioColor' => $comp->PrazoMedioColor,
                'RepMesAnoColor' => $comp->RepMesAnoColor,
            ];
        }

        if ($dataComp->count() == 0) {
            SRComComparativo::insert($ccomp);
        } else if ($dataComps == Carbon::createFromFormat("Y-m-d H:i:s", $dataComp->first()->Atualizacao)->format("Y-m-d")) {
            SRComComparativo::whereDate('Atualizacao', $dataComps)->delete();
            SRComComparativo::insert($ccomp);
        } else {
            SRComComparativo::insert($ccomp);
        }
    }

    public function relFaturamentoSupermercados()
    {

        $SRFatComparativo = file_get_contents('/mnt/jsondata/Supermercados/Rel_faturamento/relfaturamentocomparativo.json');
        $SRFatGrafico = file_get_contents('/mnt/jsondata/Supermercados/Rel_faturamento/relfaturamentografico.json');
        $SRFatPerfAssoc = file_get_contents('/mnt/jsondata/Supermercados/Rel_faturamento/relfaturamentoperfassoc.json');
        $SRFatPerfMes = file_get_contents('/mnt/jsondata/Supermercados/Rel_faturamento/relfaturamentoperfmes.json');
        $SRFatTotais = file_get_contents('/mnt/jsondata/Supermercados/Rel_faturamento/relfaturamentototais.json');

        $DSRFatComparativo = json_decode($SRFatComparativo);
        $DSRFatGrafico = json_decode($SRFatGrafico);
        $DSRFatPerfAssoc = json_decode($SRFatPerfAssoc);
        $DSRFatPerfMes = json_decode($SRFatPerfMes);
        $DSRFatTotais = json_decode($SRFatTotais);

        // Inserção de dados faturamento Performance Totais **********************************
        $datatotais = SRFatTotais::orderByDesc('id_totais');
        foreach (array_slice($DSRFatTotais, 0, 1) as $fattot) {
            $datatot = Carbon::createFromFormat("d/m/Y H:i:s", $fattot->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRFatTotais as $vt) {
            $fattotal[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $vt->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaAtual' => $vt->DiaAtual,
                'DiaAnterior' => $vt->DiaAnterior,
                'VendaDia' => $vt->VendaDia,
                'MargemDia' => $vt->MargemDia,
                'VendaAnterior' => $vt->VendaAnterior,
                'MargemAnterior' => $vt->MargemAnterior,
                'VendaSemana' => $vt->VendaSemana,
                'MargemSemana' => $vt->MargemSemana,
                'VendaMes' => $vt->VendaMes,
                'MargemMes' => $vt->MargemMes,
                'RepFatMesAno' => $vt->RepFatMesAno,
                'RepVendaMes' => $vt->RepVendaMes,
                'RepFatAnoMes' => $vt->RepFatAnoMes,
                'ValorMeta' => $vt->ValorMeta,
                'RepSobreMeta' => $vt->RepSobreMeta,
                'PerfMesMeta' => $vt->PerfMesMeta,
                'PerfMesVenda' => $vt->PerfMesVenda,
                'PerfMesFaltVender' => $vt->PerfMesFaltVender,
                'PerfMesMetaParcial' => $vt->PerfMesMetaParcial,
                'PerfMesAtingido' => $vt->PerfMesAtingido,
                'PerfMesPerf' => $vt->PerfMesPerf,
                'PerfDiaMeta' => $vt->PerfDiaMeta,
                'PerfDiaVenda' => $vt->PerfDiaVenda,
                'PerfDiaFaltaVender' => $vt->PerfDiaFaltaVender,
                'PerfDiaPerf' => $vt->PerfDiaPerf,
                'MediaDia' => $vt->MediaDia,
                'MediaFatuPerfMes' => $vt->MediaFatuPerfMes,
                'MargemFatuPerfMes' => $vt->MargemFatuPerfMes,
                'RepFatuPerfMes' => $vt->RepFatuPerfMes,
                'MetaFatuPerfMes' => $vt->MetaFatuPerfMes,
                'FatuPerfAssoc' => $vt->FatuPerfAssoc,
                'MargemPerfAssoc' => $vt->MargemPerfAssoc,
                'RepFatPerfAssoc' => $vt->RepFatPerfAssoc,
                'EstoquePerfAssoc' => $vt->EstoquePerfAssoc,
                'GiroPerfAssoc' => $vt->GiroPerfAssoc,
                'RepEstoquePerfAssoc' => $vt->RepEstoquePerfAssoc
            ];
        }

        if ($datatotais->count() == 0) {
            SRFatTotais::insert($fattotal);
        } else if ($datatot == Carbon::createFromFormat("Y-m-d H:i:s", $datatotais->first()->Atualizacao)->format("Y-m-d")) {
            SRFatTotais::whereDate('Atualizacao', $datatot)->delete();
            SRFatTotais::insert($fattotal);
        } else {
            SRFatTotais::insert($fattotal);
        }


        // Inserção de dados faturamento Performance Mês **********************************
        $datapermes = SRFatPerfMes::orderByDesc('id_perfmes');
        foreach (array_slice($DSRFatPerfMes, 0, 1) as $fatpme) {
            $dataperme = Carbon::createFromFormat("d/m/Y H:i:s", $fatpme->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRFatPerfMes as $permes) {
            $fatpmes[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $permes->Atualizacao)->format("Y-m-d H:i:s"),
                'AnoMesNum' => $permes->AnoMesNum,
                'MesAno' => $permes->MesAno,
                'MediaFat' => $permes->MediaFat,
                'Margem' => $permes->Margem,
                'Rep' => $permes->Rep,
                'Meta' => $permes->Meta
            ];
        }

        if ($datapermes->count() == 0) {
            SRFatPerfMes::insert($fatpmes);
        } else if ($dataperme == Carbon::createFromFormat("Y-m-d H:i:s", $datapermes->first()->Atualizacao)->format("Y-m-d")) {
            SRFatPerfMes::whereDate('Atualizacao', $dataperme)->delete();
            SRFatPerfMes::insert($fatpmes);
        } else {
            SRFatPerfMes::insert($fatpmes);
        }

        // Inserção de dados faturamento Performance Associação **********************************
        $dataperfassoc = SRFatPerfAssoc::orderByDesc('id_perfassoc');
        foreach (array_slice($DSRFatPerfAssoc, 0, 1) as $fatpas) {
            $dataperass = Carbon::createFromFormat("d/m/Y H:i:s", $fatpas->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRFatPerfAssoc as $perassoc) {
            $fatpassoc[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $perassoc->Atualizacao)->format("Y-m-d H:i:s"),
                'Associacao' => $perassoc->Associacao,
                'Faturamento' => $perassoc->Faturamento,
                'Margem' => $perassoc->Margem,
                'RepFat' => $perassoc->RepFat,
                'Estoque' => $perassoc->Estoque,
                'Giro' => $perassoc->Giro,
                'RepEstoque' => $perassoc->RepEstoque
            ];
        }

        if ($dataperfassoc->count() == 0) {
            SRFatPerfAssoc::insert($fatpassoc);
        } else if ($dataperass == Carbon::createFromFormat("Y-m-d H:i:s", $dataperfassoc->first()->Atualizacao)->format("Y-m-d")) {
            SRFatPerfAssoc::whereDate('Atualizacao', $dataperass)->delete();
            SRFatPerfAssoc::insert($fatpassoc);
        } else {
            SRFatPerfAssoc::insert($fatpassoc);
        }

        // Inserção de dados faturamento Gráfico **********************************
        $dataGraf = SRFatGrafico::orderByDesc('id_grafico');
        foreach (array_slice($DSRFatGrafico, 0, 1) as $ftg) {
            $datagrf = Carbon::createFromFormat("d/m/Y H:i:s", $ftg->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRFatGrafico as $graf) {
            $fatgraf[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $graf->Atualizacao)->format("Y-m-d H:i:s"),
                'DiaSemana' => $graf->DiaSemana,
                'Vendas' => $graf->Vendas,
                'Margem' => $graf->Margem,
				'Meta' => $graf->Meta
            ];
        }

        if ($dataGraf->count() == 0) {
            SRFatGrafico::insert($fatgraf);
        } else if ($datagrf == Carbon::createFromFormat("Y-m-d H:i:s", $dataGraf->first()->Atualizacao)->format("Y-m-d")) {
            SRFatGrafico::whereDate('Atualizacao', $datagrf)->delete();
            SRFatGrafico::insert($fatgraf);
        } else {
            SRFatGrafico::insert($fatgraf);
        }

        // Inserção de dados faturamento ComparativoComparativo **********************************
        $dataComp = SRFatComparativo::orderByDesc('id_comparativo');
        foreach (array_slice($DSRFatComparativo, 0, 1) as $fatset) {
            $dataFatus = Carbon::createFromFormat("d/m/Y H:i:s", $fatset->Atualizacao)->format("Y-m-d");
        }
        foreach ($DSRFatComparativo as $comp) {
            $fatcomp[] = [
                'Atualizacao' => Carbon::createFromFormat("d/m/Y H:i:s", $comp->Atualizacao)->format("Y-m-d H:i:s"),
                'Associacao' => $comp->Associacao,
                'VendaDia' => $comp->VendaDia,
                'MargemDia' => $comp->MargemDia,
                'VendaAnterior' => $comp->VendaAnterior,
                'MargemAnterior' => $comp->MargemAnterior,
                'VendaSemana' => $comp->VendaSemana,
                'MargemSemana' => $comp->MargemSemana,
                'VendaMes' => $comp->VendaMes,
                'MargemMes' => $comp->MargemMes,
                'RepMargemMesAno' => $comp->RepMargemMesAno,
                'RepFatMes' => $comp->RepFatMes,
                'RepFatMesAno' => $comp->RepFatMesAno,
                'Meta' => $comp->Meta,
                'RepMesMeta' => $comp->RepMesMeta
            ];
        }

        if ($dataComp->count() == 0) {
            SRFatComparativo::insert($fatcomp);
        } else if ($dataFatus == Carbon::createFromFormat("Y-m-d H:i:s", $dataComp->first()->Atualizacao)->format("Y-m-d")) {
            SRFatComparativo::whereDate('Atualizacao', $dataFatus)->delete();
            SRFatComparativo::insert($fatcomp);
        } else {
            SRFatComparativo::insert($fatcomp);
        }
    }


    /**
     * Operação de insercaao de dados no DB
     */
    public function insertData()
    {
        $this->relComprasSupermercados();
        $this->relFaturamentoSupermercados();
    }

    // APIs de retorno de dados Supermercados *****************************
    // Relatórios de faturamento
    public function getSRFatComparativo($date)
    {
        $fatcomp = SRFatComparativo::whereDate('Atualizacao', $date)->get();
        return json_encode($fatcomp, JSON_NUMERIC_CHECK);
    }

    public function getSRFatGrafico($date)
    {
        $fatgrafico = SRFatGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($fatgrafico, JSON_NUMERIC_CHECK);
    }

    public function getSRFatPerfAssoc($date)
    {
        $fatassoc = SRFatPerfAssoc::whereDate('Atualizacao', $date)->get();
        return json_encode($fatassoc, JSON_NUMERIC_CHECK);
    }

    public function getSRFatPerfMes($date)
    {
        $fatpm = SRFatPerfMes::whereDate('Atualizacao', $date)->get();
        return json_encode($fatpm, JSON_NUMERIC_CHECK);
    }

    public function getSRFatTotais($date)
    {
        $fattot = SRFatTotais::whereDate('Atualizacao', $date)->get();
        return json_encode($fattot, JSON_NUMERIC_CHECK);
    }

    //Relatórios de compras
    public function getSRComComparativo($date)
    {
        $comcomp = SRComComparativo::whereDate('Atualizacao', $date)->get();
        return json_encode($comcomp, JSON_NUMERIC_CHECK);
    }

    public function getSRComGrafico($date)
    {
        $comgrf = SRComGrafico::whereDate('Atualizacao', $date)->get();
        return json_encode($comgrf, JSON_NUMERIC_CHECK);
    }

    public function getSRComPerfAssoc($date)
    {
        $comgrf = SRComPerfAssoc::whereDate('Atualizacao', $date)->get();
        return json_encode($comgrf, JSON_NUMERIC_CHECK);
    }

    public function getSRComPerfMes($date)
    {
        $compmes = SRComPerfMes::whereDate('Atualizacao', $date)->get();
        return json_encode($compmes, JSON_NUMERIC_CHECK);
    }

    public function getSRSRComTotais($date)
    {
        $comtot = SRComTotais::whereDate('Atualizacao', $date)->get();
        return json_encode($comtot, JSON_NUMERIC_CHECK);
    }
}
