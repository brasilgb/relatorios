-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2022 at 04:24 PM
-- Server version: 8.0.28
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apprelatorios`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacr_grafprojecao`
--

CREATE TABLE `lacr_grafprojecao` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodFilial` int DEFAULT NULL,
  `Filial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MesAno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProjVencidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacr_grafprojecaototal`
--

CREATE TABLE `lacr_grafprojecaototal` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MesAno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProjVencidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacr_grafvencidos`
--

CREATE TABLE `lacr_grafvencidos` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodFilial` int DEFAULT NULL,
  `Filial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MesAno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorCredito` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacr_grafvencidostotal`
--

CREATE TABLE `lacr_grafvencidostotal` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MesAno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorCredito` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacr_kpis`
--

CREATE TABLE `lacr_kpis` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodFilial` int DEFAULT NULL,
  `Filial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorCrediario` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorVencer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorVencido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepProjVencido` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lacr_kpistotal`
--

CREATE TABLE `lacr_kpistotal` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorCrediario` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorVencer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorVencido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepVencido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RepProjVencido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lcom_comparadia`
--

CREATE TABLE `lcom_comparadia` (
  `id_comp` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Assoc` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompraDia` decimal(10,2) DEFAULT NULL,
  `CompraAnterior` decimal(10,2) DEFAULT NULL,
  `CompraSemana` decimal(10,2) DEFAULT NULL,
  `CompraMes` decimal(10,2) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `PrazoMedio` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lcom_grafico`
--

CREATE TABLE `lcom_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `DiaSemana` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Compras` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lcom_perfassoc`
--

CREATE TABLE `lcom_perfassoc` (
  `id_assoc` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Assoc` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Compras` decimal(10,2) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `PrazoMedio` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lcom_perfmes`
--

CREATE TABLE `lcom_perfmes` (
  `id_mes` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `AnoMesNum` int DEFAULT NULL,
  `MesAno` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaCompra` decimal(10,2) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `PrazoMedio` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lcom_totais`
--

CREATE TABLE `lcom_totais` (
  `id_total` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `CompraDia` decimal(10,2) DEFAULT NULL,
  `CompraAnterior` decimal(10,2) DEFAULT NULL,
  `CompraSemana` decimal(10,2) DEFAULT NULL,
  `CompraMes` decimal(10,2) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `PrazoMedio` int DEFAULT NULL,
  `MediaCompraMes` decimal(10,2) DEFAULT NULL,
  `RepMes` decimal(10,4) DEFAULT NULL,
  `PrazoMedioMes` int DEFAULT NULL,
  `ComprasAssoc` decimal(10,2) DEFAULT NULL,
  `RepAssoc` decimal(10,4) DEFAULT NULL,
  `PrazoMedioAssoc` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lfat_comparadia`
--

CREATE TABLE `lfat_comparadia` (
  `id_faturamento` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Associacao` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FatuDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `FatuAnterior` decimal(10,2) DEFAULT NULL,
  `MargemAnterior` decimal(10,4) DEFAULT NULL,
  `FatuSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `FatuMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `CompDia` decimal(10,4) DEFAULT NULL,
  `CompMes` decimal(10,4) DEFAULT NULL,
  `RepFatu` decimal(10,4) DEFAULT NULL,
  `JurosSPM` decimal(10,2) DEFAULT NULL,
  `RepSemFatu` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lfat_grafico`
--

CREATE TABLE `lfat_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `DiaSemana` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vendas` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `Meta` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lfat_perfassoc`
--

CREATE TABLE `lfat_perfassoc` (
  `id_assoc` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Assoc` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepFat` decimal(10,4) DEFAULT NULL,
  `JurSFat` decimal(10,2) DEFAULT NULL,
  `RepJuros` decimal(10,4) DEFAULT NULL,
  `Estoque` decimal(10,2) DEFAULT NULL,
  `Giro` decimal(10,2) DEFAULT NULL,
  `RepEstoque` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lfat_perfmes`
--

CREATE TABLE `lfat_perfmes` (
  `id_mes` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `AnoMesNum` int DEFAULT NULL,
  `MesAno` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Meta` decimal(10,2) DEFAULT NULL,
  `MediaFatu` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepFatu` decimal(10,4) DEFAULT NULL,
  `MetaAlcancada` decimal(10,4) DEFAULT NULL,
  `MedJurSParc` decimal(10,2) DEFAULT NULL,
  `RepJuros` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lfat_totcompara`
--

CREATE TABLE `lfat_totcompara` (
  `id_faturamento` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `FatuDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `FatuAnterior` decimal(10,2) DEFAULT NULL,
  `MargemAnterior` decimal(10,4) DEFAULT NULL,
  `FatuSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `FatuMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepFatu` decimal(10,4) DEFAULT NULL,
  `JurosSPM` decimal(10,2) DEFAULT NULL,
  `RepSemFatu` decimal(10,4) DEFAULT NULL,
  `MetaMes` decimal(10,2) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `FaltaVenderMes` decimal(10,2) DEFAULT NULL,
  `MetaParcMes` decimal(10,4) DEFAULT NULL,
  `AtingidoMes` decimal(10,4) DEFAULT NULL,
  `PerfAtualMes` decimal(10,4) DEFAULT NULL,
  `MetaDia` decimal(10,2) DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `FaltaVenderDia` decimal(10,2) DEFAULT NULL,
  `PerfMetaDia` decimal(10,4) DEFAULT NULL,
  `JurSParcDia` decimal(10,2) DEFAULT NULL,
  `PerfJurDia` decimal(10,4) DEFAULT NULL,
  `MediaDia` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lfat_totperform`
--

CREATE TABLE `lfat_totperform` (
  `id_total` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `MetaMes` decimal(14,2) DEFAULT NULL,
  `MediaFatuMes` decimal(14,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepFatuMes` int DEFAULT NULL,
  `MetaAlcancadaMes` decimal(10,4) DEFAULT NULL,
  `MedJurSParcMes` decimal(14,2) DEFAULT NULL,
  `RepJurosMes` decimal(10,4) DEFAULT NULL,
  `FaturamentoAss` decimal(14,2) DEFAULT NULL,
  `MargemAss` decimal(10,4) DEFAULT NULL,
  `RepFatAss` int DEFAULT NULL,
  `JurSFatAss` decimal(14,2) DEFAULT NULL,
  `RepJurosAss` decimal(10,4) DEFAULT NULL,
  `EstoqueAss` decimal(14,2) DEFAULT NULL,
  `GiroAss` decimal(14,2) DEFAULT NULL,
  `RepEstoqueAss` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lger_analisefiliais`
--

CREATE TABLE `lger_analisefiliais` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodFilial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Filial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Valor_Faturado` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Valor_Meta` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Meta_Vendas` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Margem` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ElegiveisGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendasGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Meta_GE_Atingida` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GE_Convertida` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ElegiveisPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendasPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Meta_PP_Atingida` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PP_Convertida` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorAP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaAP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendasAP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Meta_AP_Atingida` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorEP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaEP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Meta_EP_Atingida` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TaxaJurosFilial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorTaxaJuros` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorProjecaoVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PercentProjecaoVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorFaturamentoDia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMetaDia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorAlcancadoDia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lger_analisevendedores`
--

CREATE TABLE `lger_analisevendedores` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Filial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodigoVendedor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NomeVendedor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PercentualGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PercentualPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PercentualVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorJurosVendidos` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PercentJurosVendidos` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lger_conversaofiliais`
--

CREATE TABLE `lger_conversaofiliais` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloFaturado` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MelhorFaturado` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMeta` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaAlcancada` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaMelhorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaMelhorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorAP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorAP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaMelhorAP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorEP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorEP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaMelhorEP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaMelhorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloTaxaJuros` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorTaxaJuros` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaTaxaJuros` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloProjecao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorProjecao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaProjecao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMetaDia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MetaAlcancadaDia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaMetaDia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lger_conversaovendedores`
--

CREATE TABLE `lger_conversaovendedores` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodigoFilial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DescricaoFilial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodigoVendedorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorGE` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodigoVendedorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorPP` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodigoVendedorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorVenda` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodigoVendedorJuro` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloMelhorJuro` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMelhorJuro` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lger_giroestoque`
--

CREATE TABLE `lger_giroestoque` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GiroAno` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodFilial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Filial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GiroEstoqueLoja` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GiroEstoqueRede` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lger_inadimplencia`
--

CREATE TABLE `lger_inadimplencia` (
  `uid` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CodFilial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PercentInadimplencia` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lser_grafico`
--

CREATE TABLE `lser_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `DiaSemana` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vendas` decimal(10,2) DEFAULT NULL,
  `Meta` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lser_perform`
--

CREATE TABLE `lser_perform` (
  `id_perform` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `PerfMesAno` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PerfValorGE` decimal(10,2) DEFAULT NULL,
  `PerfRepGE` decimal(10,4) DEFAULT NULL,
  `PerfMetaGE` decimal(10,4) DEFAULT NULL,
  `PerfValorPP` decimal(10,2) DEFAULT NULL,
  `PerfRepPP` decimal(10,4) DEFAULT NULL,
  `PerfMetaPP` decimal(10,4) DEFAULT NULL,
  `PerfValorAP` decimal(10,2) DEFAULT NULL,
  `PerfRepAP` decimal(10,4) DEFAULT NULL,
  `PerfMetaAP` decimal(10,4) DEFAULT NULL,
  `PerfValorEP` decimal(10,2) DEFAULT NULL,
  `PerfRepEP` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lser_resumodia`
--

CREATE TABLE `lser_resumodia` (
  `id_resumdia` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Supervisor` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GEDia` decimal(10,2) DEFAULT NULL,
  `PPDia` decimal(10,2) DEFAULT NULL,
  `GESemana` decimal(10,2) DEFAULT NULL,
  `PPSemana` decimal(10,2) DEFAULT NULL,
  `GEMes` decimal(10,2) DEFAULT NULL,
  `GEMesRep` decimal(10,4) DEFAULT NULL,
  `PPMes` decimal(10,2) DEFAULT NULL,
  `PPMesRep` decimal(10,4) DEFAULT NULL,
  `APMes` decimal(10,2) DEFAULT NULL,
  `APMesRep` decimal(10,4) DEFAULT NULL,
  `TotServicos` decimal(10,2) DEFAULT NULL,
  `TotRep` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lser_totais`
--

CREATE TABLE `lser_totais` (
  `id_total` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `GEDia` decimal(10,2) DEFAULT NULL,
  `PPDia` decimal(10,2) DEFAULT NULL,
  `GESemana` decimal(10,2) DEFAULT NULL,
  `PPSemana` decimal(10,2) DEFAULT NULL,
  `GEMes` decimal(10,2) DEFAULT NULL,
  `GEMesRep` decimal(10,4) DEFAULT NULL,
  `PPMes` decimal(10,2) DEFAULT NULL,
  `PPMesRep` decimal(10,4) DEFAULT NULL,
  `APMes` decimal(10,2) DEFAULT NULL,
  `APMesRep` decimal(10,4) DEFAULT NULL,
  `TotServicos` decimal(10,2) DEFAULT NULL,
  `TotRep` decimal(10,4) DEFAULT NULL,
  `MetaMes` decimal(10,2) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `FaltaVenderMes` decimal(10,2) DEFAULT NULL,
  `AtingidoMes` decimal(10,4) DEFAULT NULL,
  `RepFatMes` decimal(10,4) DEFAULT NULL,
  `MetaGEMes` decimal(10,2) DEFAULT NULL,
  `VendaGEMes` decimal(10,2) DEFAULT NULL,
  `FaltaVenderGEMes` decimal(10,2) DEFAULT NULL,
  `AtingidoGEMes` decimal(10,4) DEFAULT NULL,
  `QtdVendaGEMes` int DEFAULT NULL,
  `ElegiveisGEMes` int DEFAULT NULL,
  `ConversaoGEMes` decimal(10,4) DEFAULT NULL,
  `MetaPPMes` decimal(10,2) DEFAULT NULL,
  `VendaPPMes` decimal(10,2) DEFAULT NULL,
  `FaltaVenderPPMes` decimal(10,2) DEFAULT NULL,
  `AtingidoPPMes` decimal(10,4) DEFAULT NULL,
  `QtdVendaPPMes` int DEFAULT NULL,
  `ElegiveisPPMes` int DEFAULT NULL,
  `ConversaoPPMes` decimal(10,4) DEFAULT NULL,
  `MetaAPMes` decimal(10,2) DEFAULT NULL,
  `VendaAPMes` decimal(10,2) DEFAULT NULL,
  `FaltaVenderAPMes` decimal(10,2) DEFAULT NULL,
  `AtingidoAPMes` decimal(10,4) DEFAULT NULL,
  `MetaEPMes` decimal(10,2) DEFAULT NULL,
  `VendaEPMes` decimal(10,2) DEFAULT NULL,
  `FaltaVenderEPMes` decimal(10,2) DEFAULT NULL,
  `AtingidoEPMes` decimal(10,4) DEFAULT NULL,
  `MetaDia` decimal(10,2) DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `PerfDia` decimal(10,4) DEFAULT NULL,
  `QtdVendaGEDia` int DEFAULT NULL,
  `ElegiveisGEDia` int DEFAULT NULL,
  `ConversaoGEDia` decimal(10,4) DEFAULT NULL,
  `QtdVendaPPDia` int DEFAULT NULL,
  `ElegiveisPPDia` int DEFAULT NULL,
  `ConversaoPPDia` decimal(10,4) DEFAULT NULL,
  `MediaDia` decimal(10,2) DEFAULT NULL,
  `PerfValorGE` decimal(10,2) DEFAULT NULL,
  `PerfRepGE` decimal(10,4) DEFAULT NULL,
  `PerfMetaGE` decimal(10,4) DEFAULT NULL,
  `PerfValorPP` decimal(10,2) DEFAULT NULL,
  `PerfRepPP` decimal(10,4) DEFAULT NULL,
  `PerfMetaPP` decimal(10,4) DEFAULT NULL,
  `PerfValorAP` decimal(10,2) DEFAULT NULL,
  `PerfRepAP` decimal(10,4) DEFAULT NULL,
  `PerfMetaAP` decimal(10,4) DEFAULT NULL,
  `PerfValorEP` decimal(10,2) DEFAULT NULL,
  `PerfRepEP` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ncom_perfgrafico`
--

CREATE TABLE `ncom_perfgrafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaSemana` int DEFAULT NULL,
  `Compras` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ncom_perfmes`
--

CREATE TABLE `ncom_perfmes` (
  `id_mes` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` int DEFAULT NULL,
  `MesAno` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Media` decimal(10,2) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ncom_perftipo`
--

CREATE TABLE `ncom_perftipo` (
  `id_tipo` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MateriaPrima` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Compra` decimal(10,2) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `CompraEC` decimal(10,2) DEFAULT NULL,
  `RepTotalEC` decimal(10,4) DEFAULT NULL,
  `PrecoMedioEC` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ncom_tipo`
--

CREATE TABLE `ncom_tipo` (
  `id_tipo` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MateriaPrima` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompraDia` decimal(10,2) DEFAULT NULL,
  `CompraSemana` decimal(10,2) DEFAULT NULL,
  `CompraMes` decimal(10,2) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `RepAno` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedio` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ncom_totais`
--

CREATE TABLE `ncom_totais` (
  `id_totais` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ComCompraDia` decimal(10,2) DEFAULT NULL,
  `ComCompraSemana` decimal(10,2) DEFAULT NULL,
  `ComCompraMes` decimal(10,2) DEFAULT NULL,
  `ComRepTotal` int DEFAULT NULL,
  `MesMedia` decimal(10,2) DEFAULT NULL,
  `MesRepTotal` int DEFAULT NULL,
  `PerCompra` decimal(10,2) DEFAULT NULL,
  `PerRepTotal` int DEFAULT NULL,
  `PerCompraEC` decimal(10,2) DEFAULT NULL,
  `PerRepTotalEC` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_associacao`
--

CREATE TABLE `nfat_associacao` (
  `id_associacao` int NOT NULL,
  `Atualizacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Associacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `VendaSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `RepAno` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedio` decimal(10,2) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedioKg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_grafico`
--

CREATE TABLE `nfat_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaSemana` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vendas` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_grupo`
--

CREATE TABLE `nfat_grupo` (
  `id_grupo` int NOT NULL,
  `Atualizacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Grupo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `VendaSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `RepAno` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedio` decimal(10,2) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedioKg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_perfassociacao`
--

CREATE TABLE `nfat_perfassociacao` (
  `id_associacao` int NOT NULL,
  `Atualizacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Associacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `FaturamentoEC` decimal(10,2) DEFAULT NULL,
  `RepEC` decimal(10,4) DEFAULT NULL,
  `MargemEC` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_perfgrupo`
--

CREATE TABLE `nfat_perfgrupo` (
  `id_grupo` int NOT NULL,
  `Atualizacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Grupo` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `FaturamentoEC` decimal(10,2) DEFAULT NULL,
  `RepEC` decimal(10,4) DEFAULT NULL,
  `MargemEC` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_perfmes`
--

CREATE TABLE `nfat_perfmes` (
  `id_mes` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` int DEFAULT NULL,
  `MesAno` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_perfsetor`
--

CREATE TABLE `nfat_perfsetor` (
  `id_setor` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Setor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `FaturamentoEC` decimal(10,2) DEFAULT NULL,
  `RepEC` decimal(10,4) DEFAULT NULL,
  `MargemEC` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_setor`
--

CREATE TABLE `nfat_setor` (
  `id_setor` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Setor` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `VendaSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepTotal` decimal(10,4) DEFAULT NULL,
  `RepAno` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedio` decimal(10,2) DEFAULT NULL,
  `PrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `RepPrecoMedioKg` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nfat_totais`
--

CREATE TABLE `nfat_totais` (
  `id_totais` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaVendaDia` decimal(10,2) DEFAULT NULL,
  `DiaMargemDia` decimal(10,4) DEFAULT NULL,
  `DiaVendaSemana` decimal(10,2) DEFAULT NULL,
  `DiaMargemSemana` decimal(10,4) DEFAULT NULL,
  `DiaVendaMes` decimal(10,2) DEFAULT NULL,
  `DiaMargemMes` decimal(10,4) DEFAULT NULL,
  `DiaRepTotal` int DEFAULT NULL,
  `PMesFaturamento` decimal(10,2) DEFAULT NULL,
  `PMesMargem` decimal(10,4) DEFAULT NULL,
  `PMesRepTotal` int DEFAULT NULL,
  `PMesPrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `PAssFaturamento` decimal(10,2) DEFAULT NULL,
  `PAssMargem` decimal(10,4) DEFAULT NULL,
  `PAssRepTotal` int DEFAULT NULL,
  `PAssPrecoMedioKg` decimal(10,2) DEFAULT NULL,
  `PAssFaturamentoEC` decimal(10,2) DEFAULT NULL,
  `PAssRepEC` int DEFAULT NULL,
  `PAssMargemEC` decimal(10,2) DEFAULT NULL,
  `MediaDia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nres_associacao`
--

CREATE TABLE `nres_associacao` (
  `id_associacao` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Associacao` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMesAtual` decimal(10,2) DEFAULT NULL,
  `RepValorMesAnterior` decimal(10,4) DEFAULT NULL,
  `RepValorAnoAnterior` decimal(10,4) DEFAULT NULL,
  `QtdMesAtual` decimal(10,2) DEFAULT NULL,
  `RepQtdMesAnterior` decimal(10,4) DEFAULT NULL,
  `RepQtdAnoAnterior` decimal(10,4) DEFAULT NULL,
  `PrecMedioMesAtual` decimal(10,2) DEFAULT NULL,
  `RepPrecMedioMesAnterior` decimal(10,2) DEFAULT NULL,
  `RepPrecMedioAnoAnterior` decimal(10,2) DEFAULT NULL,
  `RepMargemAtual` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nres_grafico`
--

CREATE TABLE `nres_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Dia` int DEFAULT NULL,
  `MesAtual` decimal(10,2) DEFAULT NULL,
  `MesAnterior` decimal(10,2) DEFAULT NULL,
  `AnoMesAtual` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nres_grupo`
--

CREATE TABLE `nres_grupo` (
  `id_grupo` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Grupo` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMesAtual` decimal(10,2) DEFAULT NULL,
  `RepValorMesAnterior` decimal(10,4) DEFAULT NULL,
  `RepValorAnoAnterior` decimal(10,4) DEFAULT NULL,
  `QtdMesAtual` decimal(10,2) DEFAULT NULL,
  `RepQtdMesAnterior` decimal(10,4) DEFAULT NULL,
  `RepQtdAnoAnterior` decimal(10,4) DEFAULT NULL,
  `PrecMedioMesAtual` decimal(10,2) DEFAULT NULL,
  `RepPrecMedioMesAnterior` decimal(10,2) DEFAULT NULL,
  `RepPrecMedioAnoAnterior` decimal(10,2) DEFAULT NULL,
  `RepMargemAtual` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nres_totais`
--

CREATE TABLE `nres_totais` (
  `id_totais` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValorMesAtual` decimal(10,2) DEFAULT NULL,
  `RotValorMesAtual` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValRepValorMesAnterior` decimal(10,4) DEFAULT NULL,
  `RotRepValorMesAnterior` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValRepValorAnoAnterior` decimal(10,4) DEFAULT NULL,
  `RotRepValorAnoAnterior` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValQtdMesAtual` decimal(10,2) DEFAULT NULL,
  `RotQtdMesAtual` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValRepQtdMesAnterior` decimal(10,4) DEFAULT NULL,
  `RotRepQtdMesAnterior` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValRepQtdAnoAnterior` decimal(10,4) DEFAULT NULL,
  `RotRepQtdAnoAnterior` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotPrecMedioMesAtual` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotRepPrecMedioMesAnterior` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotPrecMedioAnoAnterior` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ValMargemAtual` decimal(10,4) DEFAULT NULL,
  `RotMargemAtual` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ProjecaoFaturamento` decimal(10,2) DEFAULT NULL,
  `TituloProjecao` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DifMesAntAtual` decimal(10,4) DEFAULT NULL,
  `TituloDif` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TituloGrafico` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloGrafMesAnoAtual` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloGrafMesAnterAnoAtual` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RotuloGrafAnoAnter` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_associacoes`
--

CREATE TABLE `res_associacoes` (
  `id_assoc` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Departamento` int DEFAULT NULL,
  `Associacao` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `RepFaturamento` decimal(10,4) DEFAULT NULL,
  `Projecao` decimal(10,4) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `TicketMedio` decimal(10,2) DEFAULT NULL,
  `MetaAlcancada` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_exportacoes`
--

CREATE TABLE `res_exportacoes` (
  `id_exp` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Departamento` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pais` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `RepFaturamento` decimal(10,4) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_filiais`
--

CREATE TABLE `res_filiais` (
  `id_filial` int NOT NULL,
  `Atualizacao` datetime DEFAULT NULL,
  `Departamento` int DEFAULT NULL,
  `Filial` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `RepFaturamento` decimal(10,4) DEFAULT NULL,
  `Projecao` decimal(10,4) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `PrecoMedio` decimal(10,4) DEFAULT NULL COMMENT 'Tiket Médio, Preço Médio ou Meta alcancada',
  `TicketMedio` decimal(10,4) DEFAULT NULL,
  `MetaAlcancada` decimal(10,4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `res_totais`
--

CREATE TABLE `res_totais` (
  `id_total` int NOT NULL COMMENT 'Chave auto increment de tabela',
  `Atualizacao` datetime DEFAULT NULL,
  `Departamento` int DEFAULT NULL,
  `Meta` decimal(10,2) DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL COMMENT 'Faturamentos',
  `Projecao` decimal(10,4) DEFAULT NULL COMMENT 'Projeção do faturamento',
  `Margem` decimal(10,4) DEFAULT NULL COMMENT 'Margem do Mês',
  `PrecoMedio` decimal(10,2) DEFAULT NULL,
  `TicketMedio` decimal(10,2) DEFAULT NULL COMMENT 'Ticket médio se for supermerados',
  `MetaAlcancada` decimal(10,4) DEFAULT NULL,
  `FaturamentoSemBrasil` decimal(10,2) DEFAULT NULL,
  `MargemSemBrasil` decimal(10,4) DEFAULT NULL,
  `PrecoMedioSemBrasil` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scom_grafico`
--

CREATE TABLE `scom_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaSemana` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Compras` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scom_perfassoc`
--

CREATE TABLE `scom_perfassoc` (
  `id_perfassoc` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Associacao` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Compras` decimal(10,2) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `PrazoMedio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scom_perfmes`
--

CREATE TABLE `scom_perfmes` (
  `id_perfmes` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` int DEFAULT NULL,
  `MesAno` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaCompra` decimal(10,2) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `PrazoMedio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scom_totais`
--

CREATE TABLE `scom_totais` (
  `id_totais` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CompraDia` decimal(10,2) DEFAULT NULL,
  `CompraAnterior` decimal(10,2) DEFAULT NULL,
  `CompraSemana` decimal(10,2) DEFAULT NULL,
  `CompraMes` decimal(10,2) DEFAULT NULL,
  `RepMes` int DEFAULT NULL,
  `PrazoMedio` decimal(10,2) DEFAULT NULL,
  `MediaCompraPerfMes` decimal(10,2) DEFAULT NULL,
  `RepPerfMes` decimal(10,4) DEFAULT NULL,
  `PrazoMedioPerfMes` decimal(10,2) DEFAULT NULL,
  `ComprasPerfAssoc` decimal(10,2) DEFAULT NULL,
  `RepPerfAssoc` decimal(10,4) DEFAULT NULL,
  `PrazoMedioPerfAssoc` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sfat_comparativo`
--

CREATE TABLE `sfat_comparativo` (
  `id_comparativo` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Associacao` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `VendaAnterior` decimal(10,2) DEFAULT NULL,
  `MargemAnterior` decimal(10,4) DEFAULT NULL,
  `VendaSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepMargemMesAno` decimal(10,4) DEFAULT NULL,
  `RepFatMes` decimal(10,4) DEFAULT NULL,
  `RepFatMesAno` decimal(10,4) DEFAULT NULL,
  `Meta` decimal(10,2) DEFAULT NULL,
  `RepMesMeta` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sfat_grafico`
--

CREATE TABLE `sfat_grafico` (
  `id_grafico` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DiaSemana` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Vendas` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sfat_perfassoc`
--

CREATE TABLE `sfat_perfassoc` (
  `iid_perfassoc` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Faturamento` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `RepFat` decimal(10,4) DEFAULT NULL,
  `Estoque` decimal(10,2) DEFAULT NULL,
  `Giro` decimal(10,2) DEFAULT NULL,
  `RepEstoque` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sfat_perfmes`
--

CREATE TABLE `sfat_perfmes` (
  `id_perfmes` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AnoMesNum` int DEFAULT NULL,
  `MesAno` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `MediaFat` decimal(10,2) DEFAULT NULL,
  `Margem` decimal(10,4) DEFAULT NULL,
  `Rep` decimal(10,4) DEFAULT NULL,
  `Meta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sfat_totais`
--

CREATE TABLE `sfat_totais` (
  `id_totais` int NOT NULL,
  `Atualizacao` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VendaDia` decimal(10,2) DEFAULT NULL,
  `MargemDia` decimal(10,4) DEFAULT NULL,
  `VendaAnterior` decimal(10,2) DEFAULT NULL,
  `MargemAnterior` decimal(10,4) DEFAULT NULL,
  `VendaSemana` decimal(10,2) DEFAULT NULL,
  `MargemSemana` decimal(10,4) DEFAULT NULL,
  `VendaMes` decimal(10,2) DEFAULT NULL,
  `MargemMes` decimal(10,4) DEFAULT NULL,
  `RepFatMesAno` decimal(10,4) DEFAULT NULL,
  `RepVendaMes` int DEFAULT NULL,
  `RepFatAnoMes` decimal(10,4) DEFAULT NULL,
  `ValorMeta` decimal(10,2) DEFAULT NULL,
  `RepSobreMeta` decimal(10,4) DEFAULT NULL,
  `PerfMesMeta` decimal(10,2) DEFAULT NULL,
  `PerfMesVenda` decimal(10,2) DEFAULT NULL,
  `PerfMesFaltVender` decimal(10,2) DEFAULT NULL,
  `PerfMesMetaParcial` decimal(10,4) DEFAULT NULL,
  `PerfMesAtingido` decimal(10,4) DEFAULT NULL,
  `PerfMesPerf` decimal(10,4) DEFAULT NULL,
  `PerfDiaMeta` decimal(10,2) DEFAULT NULL,
  `PerfDiaVenda` decimal(10,2) DEFAULT NULL,
  `PerfDiaFaltaVender` decimal(10,2) DEFAULT NULL,
  `PerfDiaPerf` decimal(10,4) DEFAULT NULL,
  `MediaDia` decimal(10,2) DEFAULT NULL,
  `MediaFatuPerfMes` decimal(10,2) DEFAULT NULL,
  `MargemFatuPerfMes` decimal(10,4) DEFAULT NULL,
  `RepFatuPerfMes` decimal(10,4) DEFAULT NULL,
  `MetaFatuPerfMes` decimal(10,4) DEFAULT NULL,
  `FatuPerfAssoc` decimal(10,2) DEFAULT NULL,
  `MargemPerfAssoc` decimal(10,4) DEFAULT NULL,
  `RepFatPerfAssoc` decimal(10,4) DEFAULT NULL,
  `EstoquePerfAssoc` decimal(10,2) DEFAULT NULL,
  `GiroPerfAssoc` decimal(10,2) DEFAULT NULL,
  `RepEstoquePerfAssoc` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int NOT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Code` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Filial` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Password` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Active` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `Name`, `Code`, `Filial`, `Password`, `remember_token`, `Active`, `Type`, `created_at`, `updated_at`) VALUES
(3, 'Ezequiel', '904', '84', '1234', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(4, 'Douglas Hahn', '1081', '82', '221193', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(5, 'JOAO21', '99', '21', '641900', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(6, 'RICARDO ANDRE STEFFENS', '2051', '7', '0481', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(7, 'ADRIANO FORTUNATO', '354', '38', '354', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(8, 'ERNANI STEVENS', '695', '18', '1524', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(9, 'Ana Cristina Elsenbach da Silva', '1645', '54', '1234', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(10, 'Fabiano silva da Rosa', '952', '44', '59512', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(11, 'Diego Cesar Berlitz', '2003', '56', '170355', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(12, 'Ana Pacheco', '1917', '29', '230808', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(13, 'Henrique Lima Da Silva', '1760', '68', '68', NULL, 'A', 'T', '2022-03-31 14:45:22', '2022-03-31 14:45:22'),
(14, 'GEISON JOSUÉ REICHERT', '562', '12', '1653', NULL, 'A', 'T', '2022-03-31 16:22:12', '2022-03-31 16:22:12'),
(15, 'LISETE MAYER', '2087', '69', '1205', NULL, 'A', 'T', '2022-03-31 16:48:14', '2022-03-31 16:48:14'),
(16, 'joaquim alles', '136', '4', '187', NULL, 'A', 'T', '2022-03-31 16:55:18', '2022-03-31 16:55:18'),
(17, 'JONAS', '773', '35', '2038', NULL, 'A', 'T', '2022-03-31 17:51:59', '2022-03-31 17:51:59'),
(18, 'Volmir Basso', '395', '30', '20820', NULL, 'A', 'T', '2022-03-31 18:04:11', '2022-03-31 18:04:11'),
(20, 'Anderson Brasil', '1605', '8', '1605', NULL, 'A', 'S', '2022-03-31 18:41:10', '2022-03-31 18:41:10'),
(21, 'sonia denise de souza porto', '1991', '66', '66', NULL, 'A', 'T', '2022-03-31 18:54:25', '2022-03-31 18:54:25'),
(23, 'Valcir Vasques', '2472', '8', '2472', NULL, 'A', 'S', '2022-03-31 20:41:59', '2022-03-31 20:41:59'),
(24, 'FERNANDO MENDEZ', '2082', '67', '5633', NULL, 'A', 'T', '2022-04-01 12:08:52', '2022-04-01 12:08:52'),
(25, 'Fábio Schneider', '62', '3', '1660', NULL, 'A', 'T', '2022-04-01 12:11:16', '2022-04-01 12:11:16'),
(26, 'Marcos Daniel Sturmer', '583', '16', '1580', NULL, 'A', 'T', '2022-04-01 12:19:28', '2022-04-01 12:19:28'),
(27, 'LUANA KORD', '1721', '9', '19513', NULL, 'A', 'T', '2022-04-01 13:15:23', '2022-04-01 13:15:23'),
(28, 'cassiano roza kreuz', '2035', '61', '1515', NULL, 'A', 'T', '2022-04-01 16:19:38', '2022-04-01 16:19:38'),
(29, 'Elizete Chies', '61', '6', '6951', NULL, 'A', 'T', '2022-04-01 18:08:30', '2022-04-01 18:08:30'),
(30, 'DAIANA BATISTA', '734', '49', '1984', NULL, 'A', 'T', '2022-04-01 18:55:08', '2022-04-01 18:55:08'),
(31, 'Lucas', '2050', '8', '12345', NULL, 'A', 'S', '2022-04-01 19:50:01', '2022-04-01 19:50:01'),
(32, 'Adelmo', '85', '22', '1507', NULL, 'A', 'T', '2022-04-04 17:08:23', '2022-04-04 17:08:23'),
(33, 'Maria Inês Grassmann', '75', '20', '2022', NULL, 'A', 'T', '2022-04-09 17:48:50', '2022-04-09 17:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_acessos`
--

CREATE TABLE `usuarios_acessos` (
  `uid` int NOT NULL,
  `IdUsuario` int DEFAULT NULL,
  `Ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios_acessos`
--

INSERT INTO `usuarios_acessos` (`uid`, `IdUsuario`, `Ip`, `created_at`, `updated_at`) VALUES
(2, 3, '192.168.84.4', '2022-04-28 16:24:53', '2022-04-28 16:24:53'),
(3, 3, '192.168.84.4', '2022-04-28 16:43:08', '2022-04-28 16:43:08'),
(4, 3, '192.168.84.4', '2022-04-28 16:57:34', '2022-04-28 16:57:34'),
(5, 3, '192.168.84.4', '2022-04-28 17:46:45', '2022-04-28 17:46:45'),
(7, 6, '192.168.7.6', '2022-04-28 18:08:51', '2022-04-28 18:08:51'),
(8, 23, '172.16.1.33', '2022-04-28 18:28:15', '2022-04-28 18:28:15'),
(10, 26, '192.168.16.4', '2022-04-28 18:38:49', '2022-04-28 18:38:49'),
(13, 3, '192.168.84.4', '2022-04-28 19:28:45', '2022-04-28 19:28:45'),
(16, 3, '192.168.84.4', '2022-04-28 20:12:48', '2022-04-28 20:12:48'),
(17, 32, '192.168.22.5', '2022-04-28 20:31:12', '2022-04-28 20:31:12'),
(20, 6, '192.168.7.6', '2022-04-29 13:30:20', '2022-04-29 13:30:20'),
(22, 6, '192.168.7.6', '2022-04-29 13:40:54', '2022-04-29 13:40:54'),
(23, 6, '192.168.7.6', '2022-04-29 13:41:22', '2022-04-29 13:41:22'),
(24, 20, '172.16.2.156', '2022-04-29 13:54:40', '2022-04-29 13:54:40'),
(28, 3, '192.168.84.4', '2022-04-29 14:11:20', '2022-04-29 14:11:20'),
(29, 27, '192.168.9.4', '2022-04-29 14:24:01', '2022-04-29 14:24:01'),
(30, 20, '172.16.2.156', '2022-04-29 18:18:37', '2022-04-29 18:18:37'),
(31, 6, '192.168.7.6', '2022-04-29 18:32:04', '2022-04-29 18:32:04'),
(32, 3, '192.168.84.4', '2022-04-29 18:34:17', '2022-04-29 18:34:17'),
(33, 20, '172.16.2.156', '2022-04-29 19:05:53', '2022-04-29 19:05:53'),
(34, 3, '192.168.84.4', '2022-04-29 19:13:42', '2022-04-29 19:13:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lacr_grafprojecao`
--
ALTER TABLE `lacr_grafprojecao`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lacr_grafprojecaototal`
--
ALTER TABLE `lacr_grafprojecaototal`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lacr_grafvencidos`
--
ALTER TABLE `lacr_grafvencidos`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lacr_grafvencidostotal`
--
ALTER TABLE `lacr_grafvencidostotal`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lacr_kpis`
--
ALTER TABLE `lacr_kpis`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lacr_kpistotal`
--
ALTER TABLE `lacr_kpistotal`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lcom_comparadia`
--
ALTER TABLE `lcom_comparadia`
  ADD PRIMARY KEY (`id_comp`);

--
-- Indexes for table `lcom_grafico`
--
ALTER TABLE `lcom_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `lcom_perfassoc`
--
ALTER TABLE `lcom_perfassoc`
  ADD PRIMARY KEY (`id_assoc`);

--
-- Indexes for table `lcom_perfmes`
--
ALTER TABLE `lcom_perfmes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `lcom_totais`
--
ALTER TABLE `lcom_totais`
  ADD PRIMARY KEY (`id_total`);

--
-- Indexes for table `lfat_comparadia`
--
ALTER TABLE `lfat_comparadia`
  ADD PRIMARY KEY (`id_faturamento`);

--
-- Indexes for table `lfat_grafico`
--
ALTER TABLE `lfat_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `lfat_perfassoc`
--
ALTER TABLE `lfat_perfassoc`
  ADD PRIMARY KEY (`id_assoc`);

--
-- Indexes for table `lfat_perfmes`
--
ALTER TABLE `lfat_perfmes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `lfat_totcompara`
--
ALTER TABLE `lfat_totcompara`
  ADD PRIMARY KEY (`id_faturamento`);

--
-- Indexes for table `lfat_totperform`
--
ALTER TABLE `lfat_totperform`
  ADD PRIMARY KEY (`id_total`);

--
-- Indexes for table `lger_analisefiliais`
--
ALTER TABLE `lger_analisefiliais`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lger_analisevendedores`
--
ALTER TABLE `lger_analisevendedores`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lger_conversaofiliais`
--
ALTER TABLE `lger_conversaofiliais`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lger_conversaovendedores`
--
ALTER TABLE `lger_conversaovendedores`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lger_giroestoque`
--
ALTER TABLE `lger_giroestoque`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lger_inadimplencia`
--
ALTER TABLE `lger_inadimplencia`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `lser_grafico`
--
ALTER TABLE `lser_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `lser_perform`
--
ALTER TABLE `lser_perform`
  ADD PRIMARY KEY (`id_perform`);

--
-- Indexes for table `lser_resumodia`
--
ALTER TABLE `lser_resumodia`
  ADD PRIMARY KEY (`id_resumdia`);

--
-- Indexes for table `lser_totais`
--
ALTER TABLE `lser_totais`
  ADD PRIMARY KEY (`id_total`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ncom_perfgrafico`
--
ALTER TABLE `ncom_perfgrafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `ncom_perfmes`
--
ALTER TABLE `ncom_perfmes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `ncom_perftipo`
--
ALTER TABLE `ncom_perftipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `ncom_tipo`
--
ALTER TABLE `ncom_tipo`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `ncom_totais`
--
ALTER TABLE `ncom_totais`
  ADD PRIMARY KEY (`id_totais`);

--
-- Indexes for table `nfat_associacao`
--
ALTER TABLE `nfat_associacao`
  ADD PRIMARY KEY (`id_associacao`);

--
-- Indexes for table `nfat_grafico`
--
ALTER TABLE `nfat_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `nfat_grupo`
--
ALTER TABLE `nfat_grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `nfat_perfassociacao`
--
ALTER TABLE `nfat_perfassociacao`
  ADD PRIMARY KEY (`id_associacao`);

--
-- Indexes for table `nfat_perfgrupo`
--
ALTER TABLE `nfat_perfgrupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `nfat_perfmes`
--
ALTER TABLE `nfat_perfmes`
  ADD PRIMARY KEY (`id_mes`);

--
-- Indexes for table `nfat_perfsetor`
--
ALTER TABLE `nfat_perfsetor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Indexes for table `nfat_setor`
--
ALTER TABLE `nfat_setor`
  ADD PRIMARY KEY (`id_setor`);

--
-- Indexes for table `nfat_totais`
--
ALTER TABLE `nfat_totais`
  ADD PRIMARY KEY (`id_totais`);

--
-- Indexes for table `nres_associacao`
--
ALTER TABLE `nres_associacao`
  ADD PRIMARY KEY (`id_associacao`);

--
-- Indexes for table `nres_grafico`
--
ALTER TABLE `nres_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `nres_grupo`
--
ALTER TABLE `nres_grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indexes for table `nres_totais`
--
ALTER TABLE `nres_totais`
  ADD PRIMARY KEY (`id_totais`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `res_associacoes`
--
ALTER TABLE `res_associacoes`
  ADD PRIMARY KEY (`id_assoc`);

--
-- Indexes for table `res_exportacoes`
--
ALTER TABLE `res_exportacoes`
  ADD PRIMARY KEY (`id_exp`);

--
-- Indexes for table `res_filiais`
--
ALTER TABLE `res_filiais`
  ADD PRIMARY KEY (`id_filial`);

--
-- Indexes for table `res_totais`
--
ALTER TABLE `res_totais`
  ADD PRIMARY KEY (`id_total`);

--
-- Indexes for table `scom_grafico`
--
ALTER TABLE `scom_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `scom_perfassoc`
--
ALTER TABLE `scom_perfassoc`
  ADD PRIMARY KEY (`id_perfassoc`);

--
-- Indexes for table `scom_perfmes`
--
ALTER TABLE `scom_perfmes`
  ADD PRIMARY KEY (`id_perfmes`);

--
-- Indexes for table `scom_totais`
--
ALTER TABLE `scom_totais`
  ADD PRIMARY KEY (`id_totais`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sfat_comparativo`
--
ALTER TABLE `sfat_comparativo`
  ADD PRIMARY KEY (`id_comparativo`);

--
-- Indexes for table `sfat_grafico`
--
ALTER TABLE `sfat_grafico`
  ADD PRIMARY KEY (`id_grafico`);

--
-- Indexes for table `sfat_perfassoc`
--
ALTER TABLE `sfat_perfassoc`
  ADD PRIMARY KEY (`iid_perfassoc`);

--
-- Indexes for table `sfat_perfmes`
--
ALTER TABLE `sfat_perfmes`
  ADD PRIMARY KEY (`id_perfmes`);

--
-- Indexes for table `sfat_totais`
--
ALTER TABLE `sfat_totais`
  ADD PRIMARY KEY (`id_totais`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- Indexes for table `usuarios_acessos`
--
ALTER TABLE `usuarios_acessos`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `fk_user_access_idx` (`IdUsuario`) INVISIBLE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacr_grafprojecao`
--
ALTER TABLE `lacr_grafprojecao`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacr_grafprojecaototal`
--
ALTER TABLE `lacr_grafprojecaototal`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacr_grafvencidos`
--
ALTER TABLE `lacr_grafvencidos`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacr_grafvencidostotal`
--
ALTER TABLE `lacr_grafvencidostotal`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacr_kpis`
--
ALTER TABLE `lacr_kpis`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lacr_kpistotal`
--
ALTER TABLE `lacr_kpistotal`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lcom_comparadia`
--
ALTER TABLE `lcom_comparadia`
  MODIFY `id_comp` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lcom_grafico`
--
ALTER TABLE `lcom_grafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lcom_perfassoc`
--
ALTER TABLE `lcom_perfassoc`
  MODIFY `id_assoc` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lcom_perfmes`
--
ALTER TABLE `lcom_perfmes`
  MODIFY `id_mes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lcom_totais`
--
ALTER TABLE `lcom_totais`
  MODIFY `id_total` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lfat_comparadia`
--
ALTER TABLE `lfat_comparadia`
  MODIFY `id_faturamento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lfat_grafico`
--
ALTER TABLE `lfat_grafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lfat_perfassoc`
--
ALTER TABLE `lfat_perfassoc`
  MODIFY `id_assoc` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lfat_perfmes`
--
ALTER TABLE `lfat_perfmes`
  MODIFY `id_mes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lfat_totcompara`
--
ALTER TABLE `lfat_totcompara`
  MODIFY `id_faturamento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lfat_totperform`
--
ALTER TABLE `lfat_totperform`
  MODIFY `id_total` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lger_analisefiliais`
--
ALTER TABLE `lger_analisefiliais`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lger_analisevendedores`
--
ALTER TABLE `lger_analisevendedores`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lger_conversaofiliais`
--
ALTER TABLE `lger_conversaofiliais`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lger_conversaovendedores`
--
ALTER TABLE `lger_conversaovendedores`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lger_giroestoque`
--
ALTER TABLE `lger_giroestoque`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lger_inadimplencia`
--
ALTER TABLE `lger_inadimplencia`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lser_grafico`
--
ALTER TABLE `lser_grafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lser_perform`
--
ALTER TABLE `lser_perform`
  MODIFY `id_perform` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lser_resumodia`
--
ALTER TABLE `lser_resumodia`
  MODIFY `id_resumdia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lser_totais`
--
ALTER TABLE `lser_totais`
  MODIFY `id_total` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncom_perfgrafico`
--
ALTER TABLE `ncom_perfgrafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncom_perfmes`
--
ALTER TABLE `ncom_perfmes`
  MODIFY `id_mes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncom_perftipo`
--
ALTER TABLE `ncom_perftipo`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncom_tipo`
--
ALTER TABLE `ncom_tipo`
  MODIFY `id_tipo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ncom_totais`
--
ALTER TABLE `ncom_totais`
  MODIFY `id_totais` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_associacao`
--
ALTER TABLE `nfat_associacao`
  MODIFY `id_associacao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_grupo`
--
ALTER TABLE `nfat_grupo`
  MODIFY `id_grupo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_perfassociacao`
--
ALTER TABLE `nfat_perfassociacao`
  MODIFY `id_associacao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_perfgrupo`
--
ALTER TABLE `nfat_perfgrupo`
  MODIFY `id_grupo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_perfmes`
--
ALTER TABLE `nfat_perfmes`
  MODIFY `id_mes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_perfsetor`
--
ALTER TABLE `nfat_perfsetor`
  MODIFY `id_setor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_setor`
--
ALTER TABLE `nfat_setor`
  MODIFY `id_setor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nfat_totais`
--
ALTER TABLE `nfat_totais`
  MODIFY `id_totais` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nres_associacao`
--
ALTER TABLE `nres_associacao`
  MODIFY `id_associacao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nres_grafico`
--
ALTER TABLE `nres_grafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nres_grupo`
--
ALTER TABLE `nres_grupo`
  MODIFY `id_grupo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nres_totais`
--
ALTER TABLE `nres_totais`
  MODIFY `id_totais` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `res_associacoes`
--
ALTER TABLE `res_associacoes`
  MODIFY `id_assoc` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `res_exportacoes`
--
ALTER TABLE `res_exportacoes`
  MODIFY `id_exp` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `res_filiais`
--
ALTER TABLE `res_filiais`
  MODIFY `id_filial` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `res_totais`
--
ALTER TABLE `res_totais`
  MODIFY `id_total` int NOT NULL AUTO_INCREMENT COMMENT 'Chave auto increment de tabela';

--
-- AUTO_INCREMENT for table `scom_grafico`
--
ALTER TABLE `scom_grafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scom_perfassoc`
--
ALTER TABLE `scom_perfassoc`
  MODIFY `id_perfassoc` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scom_perfmes`
--
ALTER TABLE `scom_perfmes`
  MODIFY `id_perfmes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scom_totais`
--
ALTER TABLE `scom_totais`
  MODIFY `id_totais` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sfat_comparativo`
--
ALTER TABLE `sfat_comparativo`
  MODIFY `id_comparativo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sfat_grafico`
--
ALTER TABLE `sfat_grafico`
  MODIFY `id_grafico` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sfat_perfmes`
--
ALTER TABLE `sfat_perfmes`
  MODIFY `id_perfmes` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sfat_totais`
--
ALTER TABLE `sfat_totais`
  MODIFY `id_totais` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `usuarios_acessos`
--
ALTER TABLE `usuarios_acessos`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuarios_acessos`
--
ALTER TABLE `usuarios_acessos`
  ADD CONSTRAINT `fk_user_access` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`IdUsuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
