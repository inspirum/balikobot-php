<?php

namespace Inspirum\Balikobot\Definitions;

final class ServiceType
{
    /**
     * Balík do ruky
     *
     * @var string
     */
    public const CP_DR = 'DR';

    /**
     * Doporučená zásilka Ekonomická
     *
     * @var string
     */
    public const CP_RR = 'RR';

    /**
     * Balík Na poštu
     *
     * @var string
     */
    public const CP_NP = 'NP';

    /**
     * Balík do ruky pro vybrané podavatele
     *
     * @var string
     */
    public const CP_DV = 'DV';

    /**
     * Cenné psaní
     *
     * @var string
     */
    public const CP_VL = 'VL';

    /**
     * Doporučená zásilka Ekonomická - standard
     *
     * @var string
     */
    public const CP_SR = 'SR';

    /**
     * Doporučená zásilka Prioritní
     *
     * @var string
     */
    public const CP_RRP = 'RRP';

    /**
     * Doporučená zásilka Prioritní - standard
     *
     * @var string
     */
    public const CP_SRP = 'SRP';

    /**
     * Doporučený balíček
     *
     * @var string
     */
    public const CP_BA = 'BA';

    /**
     * Cenný balík
     *
     * @var string
     */
    public const CP_BB = 'BB';

    /**
     * Balík nadrozměr
     *
     * @var string
     */
    public const CP_BN = 'BN';

    /**
     * Balík do balíkovny
     *
     * @var string
     */
    public const CP_NB = 'NB';

    /**
     * DE balík Do ruky s garantovaným časem dodání
     *
     * @var string
     */
    public const CP_DT = 'DT';

    /**
     * Balík Do ruky s garantovaným časem dodání v neděli nebo svátek
     *
     * @var string
     */
    public const CP_DS = 'DS';

    /**
     * EMS expresní přeprava po ČR
     *
     * @var string
     */
    public const CP_EE = 'EE';

    /**
     * Balík Expres
     *
     * @var string
     */
    public const CP_BE = 'BE';

    /**
     * RR Doporučená zásilka do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_RZP = 'RZP';

    /**
     * VL Cenné psaní do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_VZP = 'VZP';

    /**
     * EMS Expresní přeprava do zahraničí
     *
     * @var string
     */
    public const CP_EM = 'EM';

    /**
     * CS Standardní balík do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_CSP = 'CSP';

    /**
     * CS Standardní balík do zahraničí Ekonomický
     *
     * @var string
     */
    public const CP_CSE = 'CSE';

    /**
     * CV Cenný balík do zahraničí Prioritní
     *
     * @var string
     */
    public const CP_CVP = 'CVP';

    /**
     * CV Cenný balík do zahraničí Ekonomický
     *
     * @var string
     */
    public const CP_CVE = 'CVE';

    /**
     * Obchodní balík do zahraničí
     *
     * @var string
     */
    public const CP_CE = 'CE';

    /**
     * PPL Parcel Business CZ
     *
     * @var string
     */
    public const PPL_PARCEL_BUSSINESS_CZ = '1';

    /**
     * PPL Parcel Connect (exportní balík)
     *
     * @var string
     */
    public const PPL_CONNECT = '2';

    /**
     * PPL Parcel CZ Dopolední balík
     *
     * @var string
     */
    public const PPL_AFTERNOON = '3';

    /**
     * PPL Parcel CZ Private (soukromý balík)
     *
     * @var string
     */
    public const PPL_PRIVATE = '4';

    /**
     * PPL Parcel CZ Business (firemní balík)
     *
     * @var string
     */
    public const PPL_BUSINESS = '8';

    /**
     * PPL Parcel CZ Private - Večerní doručení
     *
     * @var string
     */
    public const PPL_PRIVATE_EVENING = '9';

    /**
     * PPl Parcel Import
     *
     * @var string
     */
    public const PPL_PARCEL_IMPORT = '11';

    /**
     * PPL Firemní paleta
     *
     * @var string
     */
    public const PPL_BUSINESS_PALETTE = '15';

    /**
     *
     * PPL Soukromá paleta
     *
     * @var string
     */
    public const PPL_PRIVATE_PALETTE = '19';

    /**
     * DPD Classic
     *
     * @var string
     */
    public const DPD_CLASSIC = '1';

    /**
     * DPD Private
     *
     * @var string
     */
    public const DPD_PRIVATE = '2';

    /**
     * DPD Pickup
     *
     * @var string
     */
    public const DPD_PICKUP = '3';

    /**
     * DPD Expresní doručení do 10:00
     *
     * @var string
     */
    public const DPD_EXPRESS_10 = '4';

    /**
     * DPD Expresní doručení do 12:00
     *
     * @var string
     */
    public const DPD_EXPRESS_12 = '5';

    /**
     * DPD Expresní doručení do 18:00
     *
     * @var string
     */
    public const DPD_EXPRESS_18 = '6';

    /**
     * DPD Private večerní doručení
     *
     * @var string
     */
    public const DPD_PRIVATE_EVENING = '7';

    /**
     * DPD Private sobotní doručení
     *
     * @var string
     */
    public const DPD_PRIVATE_SATURDAY = '8';

    /**
     * Soukromá zásilka (B2C)
     * // TODO: rename to B2C
     *
     * @var string
     */
    public const GEIS_PARCEL_PRIVATE = '1';

    /**
     * Firemní zásilka
     * // TODO: rename to B2B
     *
     * @var string
     */
    public const GEIS_PARCEL_BUSINESS = '2';

    /**
     * Mezinárodní zásilka (B2B)
     *
     * @var string
     */
    public const GEIS_PARCEL_BUSINESS_INTERNATIONAL = '3';

    /**
     * Vnitrostátní paletová zásilka B2B
     *
     * @var string
     */
    public const GEIS_CARGO_BUSINESS_NATIONAL = '4';

    /**
     * Mezinárodní paletová zásilka B2B
     *
     * @var string
     */
    public const GEIS_CARGO_BUSINESS_INTERNATIONAL = '5';

    /**
     * Geis Point
     *
     * @var string
     */
    public const GEIS_PARCEL_GEIS_POINT = '6';

    /**
     * Garantované doručení (GAR)
     *
     * @var string
     */
    public const GEIS_PARCEL_GARANTED = '7';

    /**
     * Doručení do 12. hodin (D12)
     *
     * @var string
     */
    public const GEIS_PARCEL_12 = '8';

    /**
     * Mezinárodní zásilka (B2C)
     *
     * @var string
     */
    public const GEIS_PARCEL_PRIVATE_INTERNATIONAL = '9';

    /**
     * Vnitrostátní paletová zásilka B2C
     *
     * @var string
     */
    public const GEIS_CARGO_PRIVATE_NATIONAL = '10';

    /**
     * Mezinárodní paletová zásilka B2C
     *
     * @var string
     */
    public const GEIS_CARGO_PRIVATE_INTERNATIONAL = '11';

    /**
     * Business Parcel (doručení do ruky)
     *
     * @var string
     */
    public const GLS_BUSINESS = '1';

    /**
     * ShopDelivery Service (doručení na výdejní místo)
     *
     * @var string
     */
    public const GLS_SHOP = '2';

    /**
     * Express Parcel (expresní zásilka)
     *
     * @var string
     */
    public const GLS_EXPRESS = '3';

    /**
     * Guaranteed 24 Service Business Parcel
     *
     * @var string
     */
    public const GLS_GUARANTEED24 = '4';

    /**
     * "Guaranteed 24 Service Express Parcel
     *
     * @var string
     */
    public const GLS_GUARANTEED24_EXPRESS = '5';

    /**
     * Guaranteed 24 Service ShopDelivery
     *
     * @var string
     */
    public const GLS_GUARANTEED24_SHOP = '6';

    /**
     * Small Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_SMALL_CZ = '1';

    /**
     * Medium Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_MEDIUM_CZ = '2';

    /**
     * Large Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_LARGE_CZ = '3';

    /**
     * Poštomat CZ
     *
     * @var string
     */
    public const INTIME_POSTOMAT_CZ = '4';

    /**
     * Poštomat SK
     *
     * @var string
     */
    public const INTIME_POSTOMAT_SK = '5';

    /**
     * Large Colli 48-SK
     *
     * @var string
     */
    public const INTIME_LARGE_SK = '6';

    /**
     * Extra Large Colli 24-CZ
     *
     * @var string
     */
    public const INTIME_EXTRA_CZ = '7';

    /**
     * Parcel EU
     *
     * @var string
     */
    public const INTIME_PARCEL_EU = '8';

    /**
     * Parcel EU+
     *
     * @var string
     */
    public const INTIME_PARCEL_EU_PLUS = '9';

    /**
     * 24 hodin (Standard)
     *
     * @var string
     */
    public const TOP_TRANS_STANDARD = '1';

    /**
     * Toptime
     *
     * @var string
     */
    public const TOP_TRANS_TOPTIME = '2';

    /**
     * Privat
     *
     * @var string
     */
    public const TOP_TRANS_PRIVATE = '3';

    /**
     * Weekend
     *
     * @var string
     */
    public const TOP_TRANS_WEEKEND = '4';

    /**
     * Osobní odběr
     *
     * @var string
     */
    public const TOP_TRANS_PERSONAL = '5';

    /**
     * Po avizaci
     *
     * @var string
     */
    public const TOP_TRANS_NOTICE = '6';

    /**
     * Balík na adresu – zmluvní zákazníci
     *
     * @var string
     */
    public const SP_BZA = 'BZA';

    /**
     * Balík na poštu – zmluvní zákazníci
     *
     * @var string
     */
    public const SP_BZP = 'BZP';

    /**
     * Balík do BalíkoBOXu
     *
     * @var string
     */
    public const SP_BZB = 'BZB';

    /**
     * Expres kuriér na adresu
     *
     * @var string
     */
    public const SP_EXA = 'EXA';

    /**
     * Expres kuriér na poštu
     *
     * @var string
     */
    public const SP_EXP = 'EXP';

    /**
     * Expres kuriér do BalíkoBOXu
     *
     * @var string
     */
    public const SP_EXB = 'EXB';

    /**
     * Balík na adresu
     *
     * @var string
     */
    public const SP_BNA = 'BNA';

    /**
     * Balík na poštu
     *
     * @var string
     */
    public const SP_BNP = 'BNP';

    /**
     * Balík do BalíkoBOXu
     *
     * @var string
     */
    public const SP_BNB = 'BNB';

    /**
     * Doporučený list
     *
     * @var string
     */
    public const SP_RRA = 'RRA';

    /**
     * Expres (vnitrostátní zásilky)
     *
     * @var string
     */
    public const SPS_EXPRESS = '1';

    /**
     * Expres do 12:00 (vnitrostátní zásilky)
     *
     * @var string
     */
    public const SPS_EXPRESS_12 = '2';

    /**
     * Expres do 09:00 (vnitrostátní zásilky)
     *
     * @var string
     */
    public const SPS_EXPRESS_9 = '3';

    /**
     * Export (mezinárodní zásilky)
     *
     * @var string
     */
    public const SPS_INTERNATIONAL = '4';

    /**
     * Uloženka
     *
     * @var string
     */
    public const ULOZENKA_ULOZENKA = '1';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const ULOZENKA_SP = '2';

    /**
     * DPD Classic na Slovensko
     *
     * @var string
     */
    public const ULOZENKA_DPD_CLASSIC_SK = '3';

    /**
     * DPD Private pro ČR a SK
     *
     * @var string
     */
    public const ULOZENKA_DPD_PRIVATE = '4';

    /**
     * DPD ParcelShop
     *
     * @var string
     */
    public const ULOZENKA_DPD_PARCEL = '5';

    /**
     * Balík do ruky – Česká pošta,
     *
     * @var string
     */
    public const ULOZENKA_CP_DR = '6';

    /**
     * Balík na poštu – Česká pošta
     *
     * @var string
     */
    public const ULOZENKA_CP_NP = '7';

    /**
     * Partner
     *
     * @var string
     */
    public const ULOZENKA_PARTNER = '11';

    /**
     * Doručení na adresu D+1
     *
     * @var string
     */
    public const ULOZENKA_D1 = '17';

    /**
     * Expres Kurýr SK
     *
     * @var string
     */
    public const ULOZENKA_EXPRESS_COURRIER = '19';

    /**
     * Expres na poštu SK
     *
     * @var string
     */
    public const ULOZENKA_EXPRESS_SK = '20';

    /**
     * BalíkoBOX SK
     *
     * @var string
     */
    public const ULOZENKA_BALIKOBOX_SK = '21';

    /**
     * Depo SK
     *
     * @var string
     */
    public const ULOZENKA_DEPO_SK = '22';

    /**
     * Zasilkovna
     *
     * @deprecated
     *
     * @var string|null
     */
    public const ZASILKOVNA = null;

    /**
     * Výdejní místa Česká republika
     *
     * @var string
     */
    public const ZASILKOVNA_VMCZ = 'VMCZ';

    /**
     * Výdejní místa Slovenská republika
     *
     * @var string
     */
    public const ZASILKOVNA_VMSK = 'VMSK';

    /**
     * Výdejní místa Maďarsko
     *
     * @var string
     */
    public const ZASILKOVNA_VMHU = 'VMHU';

    /**
     * Výdejní místa Polsko
     *
     * @var string
     */
    public const ZASILKOVNA_VMPL = 'VMPL';

    /**
     * Výdejní místa Rumunsko
     *
     * @var string
     */
    public const ZASILKOVNA_VMRO = 'VMRO';

    /**
     * Rakouská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_AT_POST = '80';

    /**
     * BE Post
     *
     * @var string
     */
    public const ZASILKOVNA_BE_POST = '4832';

    /**
     * Bulharsko Speedy Office
     *
     * @var string
     */
    public const ZASILKOVNA_BG_SPEEDY_OFFICE = '4017';

    /**
     * Bulharsko Speedy Home
     *
     * @var string
     */
    public const ZASILKOVNA_BG_SPEEDY_HOME = '4015';

    /**
     * Česká pošta
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_POST = '13';

    /**
     *
     * CZ - Nejvýhodnější doručení na adresu
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_COURIER = '106';

    /**
     * Expresní doručení Ostrava
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_EXPRESS_OSTRAVA = '134';

    /**
     * Expresní doručení Brno
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_EXPRESS_BRNO = '136';

    /**
     * Česká republika InTime
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_INTIME = '153';

    /**
     * Expresní doručení Praha
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_EXPRESS_PRAHA = '257';

    /**
     * Česká republika DPD
     *
     * @var string
     */
    public const ZASILKOVNA_CZ_DPD = '633';

    /**
     * Německá pošta
     *
     * @var string
     */
    public const ZASILKOVNA_DE_POST = '111';

    /**
     * Německo Hermes
     *
     * @var string
     */
    public const ZASILKOVNA_DE_HERMES = '3946';

    /**
     * DE Hermes Home
     *
     * @var string
     */
    public const ZASILKOVNA_DE_HERMES_HOME = '6373';

    /**
     * DE Hermes Pickup
     *
     * @var string
     */
    public const ZASILKOVNA_DE_HERMES_PICKUP = '6828';

    /**
     * DK Post Nord Home
     *
     * @var string
     */
    public const ZASILKOVNA_DK_HOME = '4993';

    /**
     * DK Post Nord pp
     *
     * @var string
     */
    public const ZASILKOVNA_DK_PICKUP = '4994';

    /**
     * EE Omniva Home
     *
     * @var string
     */
    public const ZASILKOVNA_EE_HOME = '5060';

    /**
     * EE Omniva pickup
     *
     * @var string
     */
    public const ZASILKOVNA_EE_PICKUP = '5061';

    /**
     * EE Omniva Box
     *
     * @var string
     */
    public const ZASILKOVNA_EE_BOX = '5062';

    /**
     * ES MRW Home
     *
     * @var string
     */
    public const ZASILKOVNA_ES_HOME = '4653';

    /**
     * Španělsko Correos
     *
     * @var string
     */
    public const ZASILKOVNA_ES_CORREOS = '4638';

    /**
     * FI Post Nord Home
     *
     * @var string
     */
    public const ZASILKOVNA_FI_HOME = '4830';

    /**
     * FI Post Nord Pickup Point
     *
     * @var string
     */
    public const ZASILKOVNA_FI_PICKUP = '4828';

    /**
     * Francie Colissimo Home
     *
     * @var string
     */
    public const ZASILKOVNA_FR_HOME = '4309';

    /**
     * Spojené království Royal Mail 48
     *
     * @var string
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL_48 = '4857';

    /**
     * Spojené království Hermes
     *
     * @var string
     */
    public const ZASILKOVNA_GB_HERMES = '3885';

    /**
     * Spojené království Royal Mail
     *
     * @var string
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL = '1120';

    /**
     * Spojené království Royal Mail 24
     *
     * @var string
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL_24 = '4856';

    /**
     * Recko Speedy Home
     *
     * @var string
     */
    public const ZASILKOVNA_GR_HOME = '4738';

    /**
     * Chorvatská Pošta - Výdejní místo
     *
     * @var string
     */
    public const ZASILKOVNA_HR_POST = '4635';

    /**
     * Chorvatská Pošta - doručení na adresu
     *
     * @var string
     */
    public const ZASILKOVNA_HR_ADDRESS = '4634';

    /**
     * Chorvatsko DPD Home
     *
     * @var string
     */
    public const ZASILKOVNA_HR_HDPD = '4646';

    /**
     * HU - best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_HU_COURIER = '4159';

    /**
     * Maďarsko Express One (Transoflex)
     *
     * @var string
     */
    public const ZASILKOVNA_HU_EXPRESS = '151';

    /**
     * Maďarsko DPD
     *
     * @var string
     */
    public const ZASILKOVNA_HU_DPD = '805';

    /**
     * Maďarská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_HU_POST = '763';

    /**
     * Švýcarsko-Lichtenštejnská Pošta - prioritní
     *
     * @var string
     */
    public const ZASILKOVNA_CH_POST_PRIORITY = '3870';

    /**
     * Švýcarsko-Lichtejnštejnská Pošta
     *
     * @var string
     */
    public const ZASILKOVNA_CH_POST = '3294';

    /**
     * Irsko Hermes
     *
     * @var string
     */
    public const ZASILKOVNA_IE_HERMES = '4524';

    /**
     * Itálie GLS
     *
     * @var string
     */
    public const ZASILKOVNA_IT_GLS = '2726';

    /**
     * LT Omniva Home
     *
     * @var string
     */
    public const ZASILKOVNA_LT_HOME = '5065';

    /**
     * LT Omniva Box
     *
     * @var string
     */
    public const ZASILKOVNA_LT_BOX = '5066';

    /**
     * LU DPD
     *
     * @var string
     */
    public const ZASILKOVNA_LU_DPD = '4834';

    /**
     * LV Omniva Box
     *
     * @var string
     */
    public const ZASILKOVNA_LV_BOX = '5064';

    /**
     * LV Omniva Home
     *
     * @var string
     */
    public const ZASILKOVNA_LV_HOME = '5063';

    /**
     * NL Post
     *
     * @var string
     */
    public const ZASILKOVNA_NL_POST = '4329';

    /**
     * Polsko Paczkomaty
     *
     * @var string
     */
    public const ZASILKOVNA_PL_PACZKOMATY = '3060';

    /**
     * Polsko DPD
     *
     * @var string
     */
    public const ZASILKOVNA_PL_DPD = '1406';

    /**
     * PL - best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_PL_COURIER = '4162';

    /**
     * Polská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_PL_POST = '272';

    /**
     * Polská pošta 24h
     *
     * @var string
     */
    public const ZASILKOVNA_PL_POST_24 = '1438';

    /**
     * Polsko InPost
     *
     * @var string
     */
    public const ZASILKOVNA_PL_INPOST = '3603';

    /**
     * PT MRW Home
     *
     * @var string
     */
    public const ZASILKOVNA_PT_HOME = '4655';

    /**
     * Rumunsko FAN
     *
     * @var string
     */
    public const ZASILKOVNA_RO_FAN = '762';

    /**
     * RO - best delivery solution
     *
     * @deprecated Will be removed in v4.0
     *
     * @var string
     */
    public const ZASILKOVNA_RO_COUTIER = '4161';

    /**
     * RO - best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_RO_COURIER = '4161';

    /**
     * Rumunsko DPD
     *
     * @var string
     */
    public const ZASILKOVNA_RO_DPD = '836';

    /**
     * Rumunsko Cargus
     *
     * @var string
     */
    public const ZASILKOVNA_RO_CARGUS = '590';

    /**
     * RU Post EMS
     *
     * @var string
     */
    public const ZASILKOVNA_RU_EMS = '5101';

    /**
     * RU Post Registered Packet
     *
     * @var string
     */
    public const ZASILKOVNA_RU_POST_PACKET = '5102';

    /**
     * Ruská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_RU_POST = '4559';

    /**
     * SE Post Nord Home
     *
     * @var string
     */
    public const ZASILKOVNA_SE_HOME = '4827';

    /**
     * SE Post Nord pp
     *
     * @var string
     */
    public const ZASILKOVNA_SE_PICKUP = '4826';

    /**
     * SI DPD Pickup
     *
     * @var string
     */
    public const ZASILKOVNA_SI_DPD_PICKUP = '4950';

    /**
     * SI DPD Home
     *
     * @var string
     */
    public const ZASILKOVNA_SI_DPD_HOME = '4949';

    /**
     * Slovensko GLS
     *
     * @var string
     */
    public const ZASILKOVNA_SK_GLS = '149';

    /**
     * Expresné doručenie Bratislava
     *
     * @var string
     */
    public const ZASILKOVNA_SK_EXPRESS_BRATISLAVA = '132';

    /**
     * SK - Best delivery solution
     *
     * @var string
     */
    public const ZASILKOVNA_SK_COURIER = '131';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const ZASILKOVNA_SK_POST = '16';

    /**
     * Ukrajina Nova Poshta
     *
     * @var string
     */
    public const ZASILKOVNA_UK_POST = '3616';

    /**
     * Ukrajina Rosan
     *
     * @var string
     */
    public const ZASILKOVNA_UK_ROSAN = '1160';

    /**
     * DHL
     *
     * @var string
     */
    public const PBH_DHL = '1';

    /**
     * GLS
     *
     * @var string
     */
    public const PBH_GLS = '2';

    /**
     * UPS
     *
     * @var string
     */
    public const PBH_UPS = '3';

    /**
     * Slovenská pošta
     *
     * @var string
     */
    public const PBH_SP = '4';

    /**
     * Transoflex
     *
     * @var string
     */
    public const PBH_TRANSOFLEX = '5';

    /**
     * Maďarská pošta
     *
     * @var string
     */
    public const PBH_MP = '6';

    /**
     * Cargus
     *
     * @var string
     */
    public const PBH_CARGUS = '7';

    /**
     * Rakouská pošta
     *
     * @var string
     */
    public const PBH_RP = '8';

    /**
     * Česká pošta – Balík do ruky
     *
     * @var string
     */
    public const PBH_CP_DR = '9';

    /**
     * Česká pošta – Balík na poštu
     *
     * @var string
     */
    public const PBH_CP_NP = '10';

    /**
     * PPL
     *
     * @var string
     */
    public const PBH_PPL = '11';

    /**
     * DPD
     *
     * @var string
     */
    public const PBH_DPD = '12';

    /**
     * Polská pošta
     *
     * @var string
     */
    public const PBH_PP = '13';

    /**
     * polský Inpost Kurier
     *
     * @var string
     */
    public const PBH_INPOST_KURIER = '14';

    /**
     * FAN Courier
     *
     * @var string
     */
    public const PBH_FAN_KURIER = '15';

    /**
     * Hermes
     *
     * @var string
     */
    public const PBH_HERMES = '16';

    /**
     * Speedy
     *
     * @var string
     */
    public const PBH_SPEEDY = '17';

    /**
     * Colissimo
     *
     * @var string
     */
    public const PBH_COLISSIMO = '18';

    /**
     * Meest
     *
     * @var string
     */
    public const PBH_MEEST = '19';

    /**
     * Nova Poshta
     *
     * @var string
     */
    public const PBH_NOBA_POSHTA = '20';

    /**
     * Econt
     *
     * @var string
     */
    public const PBH_ECONT = '21';

    /**
     * Worlwide zásilky
     *
     * @var string
     */
    public const DHL_WORLDWIDE = '1';

    /**
     * Express Worldwide dokumenty
     *
     * @var string
     */
    public const DHL_EXPRESS_DOCUMENTS = '2';

    /**
     * Express Worldwide 9:00
     *
     * @var string
     */
    public const DHL_EXPRESS_WORLDWIDE_9 = '3';

    /**
     * Express Worldwide 12:00
     *
     * @var string
     */
    public const DHL_EXPRESS_WORLDWIDE_12 = '4';

    /**
     * Economy Select
     *
     * @var string
     */
    public const DHL_ECONOMY = '5';

    /**
     * Domestic Express 12:00
     *
     * @var string
     */
    public const DHL_DOMESTIC_12 = '6';

    /**
     * Domestic Express
     *
     * @var string
     */
    public const DHL_DOMESTIC_EXPRESS = '7';

    /**
     * Express
     *
     * @var string
     */
    public const UPS_EXPRESS = '1';

    /**
     * Express Saver
     *
     * @var string
     */
    public const UPS_EXPRESS_SAVER = '2';

    /**
     * Standard
     *
     * @var string
     */
    public const UPS_STANDARD = '3';

    /**
     * Expedited
     *
     * @var string
     */
    public const UPS_EXPEDITED = '4';

    /**
     * Express
     *
     * @var string
     */
    public const TNT_EXPRESS = '1';

    /**
     * Express 9:00
     *
     * @var string
     */
    public const TNT_EXPRESS_9 = '2';

    /**
     * Express 12:00
     *
     * @var string
     */
    public const TNT_EXPRESS_12 = '3';

    /**
     * Economy Express
     *
     * @var string
     */
    public const TNT_ECONOMY_EXPRESS = '4';

    /**
     * Night Express 8:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_8 = '5';

    /**
     * Economy Express 12:00
     *
     * @var string
     */
    public const TNT_ECONOMY_EXPRESS_12 = '6';

    /**
     * Express 10:00
     *
     * @var string
     */
    public const TNT_EXPRESS_10 = '7';

    /**
     * Express (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS = '8';

    /**
     * Express 9:00 (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS_9 = '9';

    /**
     * Express 10:00 (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS_10 = '10';

    /**
     * Express 12:00 (Documents)
     *
     * @var string
     */
    public const TNT_EXPRESS_DOCUMENTS_12 = '11';

    /**
     * Night Express 12:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_12 = '12';

    /**
     * Night Express 06:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_6 = '13';

    /**
     * Night Express 07:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_7 = '14';

    /**
     * Night Express 14:00
     *
     * @var string
     */
    public const TNT_NIGHT_EXPRESS_14 = '15';

    /**
     * Special economy express
     *
     * @var string
     */
    public const TNT_SPECIAL_ECONOMY_EXPRESS = '16';

    /**
     * Priority Goods 9:00
     *
     * @var string
     */
    public const GW_PRIORITY_9 = 'P9';

    /**
     * Priority Goods 12:00
     *
     * @var string
     */
    public const GW_PRIORITY_12 = 'P12';

    /**
     * Priority Goods 16:00
     *
     * @var string
     */
    public const GW_PRIORITY_16 = 'P16';

    /**
     * Direct Goods
     *
     * @var string
     */
    public const GW_DIRECT_GOODS = 'WDG';

    /**
     * Pick Up
     *
     * @var string
     */
    public const GW_PICKUP = 'BES';

    /**
     * Pickup by Consignee
     *
     * @var string
     */
    public const GW_PICKUP_BY_CONSIGNEE = 'SA';

    /**
     * Domestic PRON
     *
     * @var string
     */
    public const GW_DOMESTIC = 'W24';

    /**
     * HDS - Home Delivery Services
     *
     * @var string
     */
    public const GW_HOME_DELIVERY = 'HDS';

    /**
     * Export PROI
     *
     * @var string
     */
    public const GW_EXPORT = 'EUR';

    /**
     * Domestic PRON
     *
     * @var string
     */
    public const GW_W24 = 'W24';

    /**
     * Domestic 8:00 - 12:00
     *
     * @var string
     */
    public const GW_D8 = 'D8';

    /**
     * Domestic 12:00 - 14:00
     *
     * @var string
     */
    public const GW_D12 = 'D12';

    /**
     * Domestic 14:00 - 18:00
     *
     * @var string
     */
    public const GW_D14 = 'D14';

    /**
     * Export PROI
     *
     * @var string
     */
    public const GW_EUR = 'EUR';

    /**
     * Standard
     *
     * @var string
     */
    public const MESSENGER_STANDARD = '100';

    /**
     * Extreme
     *
     * @var string
     */
    public const MESSENGER_EXTREME = '102';

    /**
     * Express
     *
     * @var string
     */
    public const MESSENGER_EXPRESS = '103';

    /**
     * Same day
     *
     * @var string
     */
    public const MESSENGER_SAME_DAY = '104';

    /**
     * Overnight Economy
     *
     * @var string
     */
    public const MESSENGER_OVERNIGHT_ECONOMY = '106';

    /**
     * Overnight Express
     *
     * @var string
     */
    public const MESSENGER_OVERNIGHT_EXPRESS = '107';

    /**
     * Direct
     *
     * @var string
     */
    public const MESSENGER_DIRECT = '108';

    /**
     * @return array<string>
     */
    public static function cp(): array
    {
        return [
            self::CP_DR,
            self::CP_RR,
            self::CP_SR,
            self::CP_RRP,
            self::CP_SRP,
            self::CP_NP,
            self::CP_VL,
            self::CP_DV,
            self::CP_BA,
            self::CP_BB,
            self::CP_BN,
            self::CP_NB,
            self::CP_DT,
            self::CP_DS,
            self::CP_EE,
            self::CP_BE,
            self::CP_RZP,
            self::CP_VZP,
            self::CP_EM,
            self::CP_CSP,
            self::CP_CSE,
            self::CP_CVP,
            self::CP_CVE,
            self::CP_CE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function dpd(): array
    {
        return [
            self::DPD_CLASSIC,
            self::DPD_PRIVATE,
            self::DPD_PICKUP,
            self::DPD_EXPRESS_10,
            self::DPD_EXPRESS_12,
            self::DPD_EXPRESS_18,
            self::DPD_PRIVATE_EVENING,
            self::DPD_PRIVATE_SATURDAY,
        ];
    }

    /**
     * @return array<string>
     */
    public static function dhl(): array
    {
        return [
            self::DHL_WORLDWIDE,
            self::DHL_EXPRESS_DOCUMENTS,
            self::DHL_EXPRESS_WORLDWIDE_9,
            self::DHL_EXPRESS_WORLDWIDE_12,
            self::DHL_ECONOMY,
            self::DHL_DOMESTIC_12,
            self::DHL_DOMESTIC_EXPRESS,
        ];
    }

    /**
     * @return array<string>
     */
    public static function geis(): array
    {
        return [
            self::GEIS_PARCEL_PRIVATE,
            self::GEIS_PARCEL_BUSINESS,
            self::GEIS_PARCEL_BUSINESS_INTERNATIONAL,
            self::GEIS_CARGO_BUSINESS_NATIONAL,
            self::GEIS_CARGO_BUSINESS_INTERNATIONAL,
            self::GEIS_PARCEL_GEIS_POINT,
            self::GEIS_PARCEL_GARANTED,
            self::GEIS_PARCEL_12,
            self::GEIS_PARCEL_PRIVATE_INTERNATIONAL,
            self::GEIS_CARGO_PRIVATE_NATIONAL,
            self::GEIS_CARGO_PRIVATE_INTERNATIONAL,
        ];
    }

    /**
     * @return array<string>
     */
    public static function gls(): array
    {
        return [
            self::GLS_BUSINESS,
            self::GLS_SHOP,
            self::GLS_EXPRESS,
            self::GLS_GUARANTEED24,
            self::GLS_GUARANTEED24_EXPRESS,
            self::GLS_GUARANTEED24_SHOP,
        ];
    }

    /**
     * @return array<string>
     */
    public static function intime(): array
    {
        return [
            self::INTIME_SMALL_CZ,
            self::INTIME_MEDIUM_CZ,
            self::INTIME_LARGE_CZ,
            self::INTIME_POSTOMAT_CZ,
            // self::INTIME_POSTOMAT_SK,
            self::INTIME_LARGE_SK,
            self::INTIME_EXTRA_CZ,
            self::INTIME_PARCEL_EU,
            self::INTIME_PARCEL_EU_PLUS,
        ];
    }

    /**
     * @return array<string>
     */
    public static function pbh(): array
    {
        return [
            self::PBH_DHL,
            // self::PBH_GLS,
            self::PBH_UPS,
            self::PBH_SP,
            self::PBH_TRANSOFLEX,
            self::PBH_MP,
            self::PBH_CARGUS,
            self::PBH_RP,
            self::PBH_CP_DR,
            self::PBH_CP_NP,
            self::PBH_PPL,
            self::PBH_DPD,
            self::PBH_PP,
            self::PBH_INPOST_KURIER,
            self::PBH_FAN_KURIER,
            self::PBH_HERMES,
            self::PBH_SPEEDY,
            self::PBH_COLISSIMO,
            self::PBH_MEEST,
            self::PBH_NOBA_POSHTA,
            self::PBH_ECONT,
        ];
    }

    /**
     * @return array<string>
     */
    public static function ppl(): array
    {
        return [
            self::PPL_CONNECT,
            self::PPL_AFTERNOON,
            self::PPL_PRIVATE,
            self::PPL_BUSINESS,
            self::PPL_PRIVATE_EVENING,
            self::PPL_BUSINESS_PALETTE,
            self::PPL_PRIVATE_PALETTE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function sp(): array
    {
        return [
            self::SP_BZA,
            self::SP_BZP,
            self::SP_BZB,
            self::SP_EXA,
            self::SP_EXP,
            self::SP_EXB,
            self::SP_BNA,
            self::SP_BNP,
            self::SP_BNB,
            self::SP_RRA,
        ];
    }

    /**
     * @return array<string>
     */
    public static function sps(): array
    {
        return [
            self::SPS_EXPRESS,
            self::SPS_EXPRESS_12,
            self::SPS_EXPRESS_9,
            self::SPS_INTERNATIONAL,
        ];
    }

    /**
     * @return array<string>
     */
    public static function topTrans(): array
    {
        return [
            self::TOP_TRANS_STANDARD,
            self::TOP_TRANS_TOPTIME,
            self::TOP_TRANS_PRIVATE,
            self::TOP_TRANS_WEEKEND,
            self::TOP_TRANS_PERSONAL,
            self::TOP_TRANS_NOTICE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function ulozenka(): array
    {
        return [
            self::ULOZENKA_ULOZENKA,
            self::ULOZENKA_SP,
            self::ULOZENKA_DPD_CLASSIC_SK,
            self::ULOZENKA_DPD_PRIVATE,
            self::ULOZENKA_DPD_PARCEL,
            self::ULOZENKA_CP_DR,
            self::ULOZENKA_CP_NP,
            self::ULOZENKA_PARTNER,
            self::ULOZENKA_D1,
            self::ULOZENKA_EXPRESS_COURRIER,
            self::ULOZENKA_EXPRESS_SK,
            self::ULOZENKA_BALIKOBOX_SK,
            self::ULOZENKA_DEPO_SK,
        ];
    }

    /**
     * @return array<string>
     */
    public static function ups(): array
    {
        return [
            self::UPS_EXPRESS,
            self::UPS_EXPRESS_SAVER,
            self::UPS_STANDARD,
            self::UPS_EXPEDITED,
        ];
    }

    /**
     * @return array<mixed>
     */
    public static function zasilkovna(): array
    {
        return [
            self::ZASILKOVNA_VMCZ,
            self::ZASILKOVNA_VMSK,
            self::ZASILKOVNA_VMHU,
            self::ZASILKOVNA_VMPL,
            self::ZASILKOVNA_VMRO,
            self::ZASILKOVNA_AT_POST,
            self::ZASILKOVNA_BE_POST,
            self::ZASILKOVNA_BG_SPEEDY_OFFICE,
            self::ZASILKOVNA_BG_SPEEDY_HOME,
            self::ZASILKOVNA_CZ_POST,
            self::ZASILKOVNA_CZ_COURIER,
            self::ZASILKOVNA_CZ_EXPRESS_OSTRAVA,
            self::ZASILKOVNA_CZ_EXPRESS_BRNO,
            // self::ZASILKOVNA_CZ_INTIME,
            self::ZASILKOVNA_CZ_EXPRESS_PRAHA,
            // self::ZASILKOVNA_CZ_DPD,
            self::ZASILKOVNA_DE_POST,
            self::ZASILKOVNA_DE_HERMES_PICKUP,
            // self::ZASILKOVNA_DE_HERMES,
            self::ZASILKOVNA_DE_HERMES_HOME,
            self::ZASILKOVNA_DK_HOME,
            self::ZASILKOVNA_DK_PICKUP,
            self::ZASILKOVNA_EE_HOME,
            self::ZASILKOVNA_EE_PICKUP,
            self::ZASILKOVNA_EE_BOX,
            self::ZASILKOVNA_ES_HOME,
            self::ZASILKOVNA_ES_CORREOS,
            self::ZASILKOVNA_FI_HOME,
            self::ZASILKOVNA_FI_PICKUP,
            self::ZASILKOVNA_FR_HOME,
            self::ZASILKOVNA_GB_ROYAL_MAIL_48,
            self::ZASILKOVNA_GB_HERMES,
            // self::ZASILKOVNA_GB_ROYAL_MAIL,
            self::ZASILKOVNA_GB_ROYAL_MAIL_24,
            self::ZASILKOVNA_GR_HOME,
            self::ZASILKOVNA_HR_POST,
            self::ZASILKOVNA_HR_ADDRESS,
            self::ZASILKOVNA_HR_HDPD,
            self::ZASILKOVNA_HU_COURIER,
            self::ZASILKOVNA_HU_EXPRESS,
            self::ZASILKOVNA_HU_DPD,
            self::ZASILKOVNA_HU_POST,
            self::ZASILKOVNA_CH_POST_PRIORITY,
            self::ZASILKOVNA_CH_POST,
            self::ZASILKOVNA_IE_HERMES,
            self::ZASILKOVNA_IT_GLS,
            self::ZASILKOVNA_LT_HOME,
            self::ZASILKOVNA_LT_BOX,
            self::ZASILKOVNA_LU_DPD,
            self::ZASILKOVNA_LV_BOX,
            self::ZASILKOVNA_LV_HOME,
            self::ZASILKOVNA_NL_POST,
            self::ZASILKOVNA_PL_PACZKOMATY,
            self::ZASILKOVNA_PL_DPD,
            self::ZASILKOVNA_PL_COURIER,
            self::ZASILKOVNA_PL_POST,
            self::ZASILKOVNA_PL_POST_24,
            self::ZASILKOVNA_PL_INPOST,
            self::ZASILKOVNA_PT_HOME,
            self::ZASILKOVNA_RO_FAN,
            self::ZASILKOVNA_RO_COURIER,
            self::ZASILKOVNA_RO_DPD,
            self::ZASILKOVNA_RO_CARGUS,
            self::ZASILKOVNA_RU_EMS,
            self::ZASILKOVNA_RU_POST_PACKET,
            self::ZASILKOVNA_RU_POST,
            self::ZASILKOVNA_SE_HOME,
            self::ZASILKOVNA_SE_PICKUP,
            self::ZASILKOVNA_SI_DPD_PICKUP,
            self::ZASILKOVNA_SI_DPD_HOME,
            // self::ZASILKOVNA_SK_GLS,
            self::ZASILKOVNA_SK_EXPRESS_BRATISLAVA,
            self::ZASILKOVNA_SK_COURIER,
            self::ZASILKOVNA_SK_POST,
            self::ZASILKOVNA_UK_POST,
            self::ZASILKOVNA_UK_ROSAN,
        ];
    }

    /**
     * @return array<string>
     */
    public static function tnt(): array
    {
        return [
            self::TNT_EXPRESS,
            self::TNT_EXPRESS_9,
            self::TNT_EXPRESS_12,
            self::TNT_ECONOMY_EXPRESS,
            self::TNT_NIGHT_EXPRESS_8,
            self::TNT_ECONOMY_EXPRESS_12,
            self::TNT_EXPRESS_10,
            self::TNT_EXPRESS_DOCUMENTS,
            self::TNT_EXPRESS_DOCUMENTS_9,
            self::TNT_EXPRESS_DOCUMENTS_10,
            self::TNT_EXPRESS_DOCUMENTS_12,
            self::TNT_NIGHT_EXPRESS_12,
            self::TNT_NIGHT_EXPRESS_6,
            self::TNT_NIGHT_EXPRESS_7,
            self::TNT_NIGHT_EXPRESS_14,
            self::TNT_SPECIAL_ECONOMY_EXPRESS,
        ];
    }

    /**
     * @return array<string>
     */
    public static function gw(): array
    {
        return [
            self::GW_DOMESTIC,
            self::GW_HOME_DELIVERY,
            self::GW_PRIORITY_9,
            self::GW_PRIORITY_12,
            self::GW_PRIORITY_16,
            self::GW_DIRECT_GOODS,
            self::GW_EXPORT,
            self::GW_PICKUP,
            self::GW_PICKUP_BY_CONSIGNEE,
        ];
    }

    /**
     * @return array<string>
     */
    public static function gwcz(): array
    {
        return [
            self::GW_W24,
            self::GW_D8,
            self::GW_D12,
            self::GW_D14,
            self::GW_EUR,
        ];
    }

    /**
     * @return array<string>
     */
    public static function messenger(): array
    {
        return [
            self::MESSENGER_STANDARD,
            self::MESSENGER_EXTREME,
            self::MESSENGER_EXPRESS,
            self::MESSENGER_SAME_DAY,
            self::MESSENGER_OVERNIGHT_ECONOMY,
            self::MESSENGER_OVERNIGHT_EXPRESS,
            self::MESSENGER_DIRECT,
        ];
    }

    /**
     * All supported shipper services
     *
     * @return array<string,array<string>>
     */
    public static function all(): array
    {
        return [
            Shipper::CP         => self::cp(),
            Shipper::DPD        => self::dpd(),
            Shipper::DHL        => self::dhl(),
            Shipper::GEIS       => self::geis(),
            Shipper::GLS        => self::gls(),
            Shipper::INTIME     => self::intime(),
            Shipper::PBH        => self::pbh(),
            Shipper::PPL        => self::ppl(),
            Shipper::SP         => self::sp(),
            Shipper::SPS        => self::sps(),
            Shipper::TOPTRANS   => self::topTrans(),
            Shipper::ULOZENKA   => self::ulozenka(),
            Shipper::UPS        => self::ups(),
            Shipper::ZASILKOVNA => self::zasilkovna(),
            Shipper::TNT        => self::tnt(),
            Shipper::GW         => self::gw(),
            Shipper::GWCZ       => self::gwcz(),
            Shipper::MESSENGER  => self::messenger(),
        ];
    }
}
