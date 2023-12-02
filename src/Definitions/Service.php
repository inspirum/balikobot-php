<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class Service extends BaseEnum
{
    /**
     * Balík do ruky
     */
    public const CP_DR = 'DR';

    /**
     * Doporučená zásilka Ekonomická
     */
    public const CP_RR = 'RR';

    /**
     * Balík Na poštu
     */
    public const CP_NP = 'NP';

    /**
     * Balík do ruky pro vybrané podavatele
     */
    public const CP_DV = 'DV';

    /**
     * Cenné psaní
     */
    public const CP_VL = 'VL';

    /**
     * Doporučená zásilka Ekonomická - standard
     */
    public const CP_SR = 'SR';

    /**
     * Doporučená zásilka Prioritní
     */
    public const CP_RRP = 'RRP';

    /**
     * Doporučená zásilka Prioritní - standard
     */
    public const CP_SRP = 'SRP';

    /**
     * Doporučený balíček
     */
    public const CP_BA = 'BA';

    /**
     * Cenný balík
     */
    public const CP_BB = 'BB';

    /**
     * Balík nadrozměr
     */
    public const CP_BN = 'BN';

    /**
     * Balík do balíkovny
     */
    public const CP_NB = 'NB';

    /**
     * DE balík Do ruky s garantovaným časem dodání
     */
    public const CP_DT = 'DT';

    /**
     * Balík Do ruky s garantovaným časem dodání v neděli nebo svátek
     */
    public const CP_DS = 'DS';

    /**
     * EMS expresní přeprava po ČR
     */
    public const CP_EE = 'EE';

    /**
     * Balík Expres
     */
    public const CP_BE = 'BE';

    /**
     * RR Doporučená zásilka do zahraničí Prioritní
     */
    public const CP_RZP = 'RZP';

    /**
     * VL Cenné psaní do zahraničí Prioritní
     */
    public const CP_VZP = 'VZP';

    /**
     * EMS Expresní přeprava do zahraničí
     */
    public const CP_EM = 'EM';

    /**
     * CS Standardní balík do zahraničí Prioritní
     */
    public const CP_CSP = 'CSP';

    /**
     * CS Standardní balík do zahraničí Ekonomický
     */
    public const CP_CSE = 'CSE';

    /**
     * CV Cenný balík do zahraničí Prioritní
     */
    public const CP_CVP = 'CVP';

    /**
     * CV Cenný balík do zahraničí Ekonomický
     */
    public const CP_CVE = 'CVE';

    /**
     * Obchodní balík do zahraničí
     */
    public const CP_CE = 'CE';

    /**
     * Obyčejná listovní zásilka mezinárodní
     */
    public const CP_OLZ = 'OLZ';

    /**
     * PPL Parcel Business CZ
     */
    public const PPL_PARCEL_BUSSINESS_CZ = '1';

    /**
     * PPL Parcel Connect (exportní balík)
     */
    public const PPL_CONNECT = '2';

    /**
     * PPL Parcel CZ Dopolední balík
     */
    public const PPL_AFTERNOON = '3';

    /**
     * PPL Parcel CZ Private (soukromý balík)
     */
    public const PPL_PRIVATE = '4';

    /**
     * PPL Parcel CZ Business (firemní balík)
     */
    public const PPL_BUSINESS = '8';

    /**
     * PPL Parcel CZ Private - Večerní doručení
     */
    public const PPL_PRIVATE_EVENING = '9';

    /**
     * PPL Parcel Business Europe
     */
    public const PPL_BUSINESS_EU = '10';

    /**
     * PPl Parcel Import
     */
    public const PPL_PARCEL_IMPORT = '11';

    /**
     * PPL Firemní paleta
     */
    public const PPL_BUSINESS_PALETTE = '15';

    /**
     * PPL Soukromá paleta
     */
    public const PPL_PRIVATE_PALETTE = '19';

    /**
     * PPL Smart CZ
     */
    public const PPL_PRIVATE_SMART_CZ = '46';

    /**
     * PPL Smart Europe
     */
    public const PPL_PRIVATE_SMART_EU = '48';

    /**
     * PPL Parcel Return Connect
     */
    public const PPL_RETURN_CONNECT = '50';

    /**
     * DPD Classic
     */
    public const DPD_CLASSIC = '1';

    /**
     * DPD Private
     */
    public const DPD_PRIVATE = '2';

    /**
     * DPD Pickup
     */
    public const DPD_PICKUP = '3';

    /**
     * DPD Expresní doručení do 10:00
     */
    public const DPD_EXPRESS_10 = '4';

    /**
     * DPD Expresní doručení do 12:00
     */
    public const DPD_EXPRESS_12 = '5';

    /**
     * DPD Expresní doručení do 18:00
     */
    public const DPD_EXPRESS_18 = '6';

    /**
     * DPD Private večerní doručení
     */
    public const DPD_PRIVATE_EVENING = '7';

    /**
     * DPD Private sobotní doručení
     */
    public const DPD_PRIVATE_SATURDAY = '8';

    /**
     * Vnitrostátní paletová zásilka B2B
     */
    public const GEIS_CARGO_BUSINESS_NATIONAL = '4';

    /**
     * Mezinárodní paletová zásilka B2B
     */
    public const GEIS_CARGO_BUSINESS_INTERNATIONAL = '5';

    /**
     * Vnitrostátní paletová zásilka B2C
     */
    public const GEIS_CARGO_PRIVATE_NATIONAL = '10';

    /**
     * Mezinárodní paletová zásilka B2C
     */
    public const GEIS_CARGO_PRIVATE_INTERNATIONAL = '11';

    /**
     * Home Delivery Standard
     */
    public const GEIS_PARCEL_HD_STANDARD = '12';

    /**
     * Home Delivery Premium
     */
    public const GEIS_PARCEL_HD_PREMIUM = '13';

    /**
     * VIP výnos (B2B)
     */
    public const GEIS_B2B = '14';

    /**
     * Business Parcel (doručení do ruky)
     */
    public const GLS_BUSINESS = '1';

    /**
     * ShopDelivery Service (doručení na výdejní místo)
     */
    public const GLS_SHOP = '2';

    /**
     * Express Parcel (expresní zásilka)
     */
    public const GLS_EXPRESS = '3';

    /**
     * Guaranteed 24 Service Business Parcel
     */
    public const GLS_GUARANTEED24 = '4';

    /**
     * "Guaranteed 24 Service Express Parcel
     */
    public const GLS_GUARANTEED24_EXPRESS = '5';

    /**
     * Guaranteed 24 Service ShopDelivery
     */
    public const GLS_GUARANTEED24_SHOP = '6';

    /**
     * Small Colli 24-CZ
     */
    public const INTIME_SMALL_CZ = '1';

    /**
     * Medium Colli 24-CZ
     */
    public const INTIME_MEDIUM_CZ = '2';

    /**
     * Large Colli 24-CZ
     */
    public const INTIME_LARGE_CZ = '3';

    /**
     * Poštomat CZ
     */
    public const INTIME_POSTOMAT_CZ = '4';

    /**
     * Poštomat SK
     */
    public const INTIME_POSTOMAT_SK = '5';

    /**
     * Large Colli 48-SK
     */
    public const INTIME_LARGE_SK = '6';

    /**
     * Extra Large Colli 24-CZ
     */
    public const INTIME_EXTRA_CZ = '7';

    /**
     * Parcel EU
     */
    public const INTIME_PARCEL_EU = '8';

    /**
     * Parcel EU+
     */
    public const INTIME_PARCEL_EU_PLUS = '9';

    /**
     * BOXCZ - Výdejní box CZ
     */
    public const INTIME_BOX_CZ = '10';

    /**
     * BOXSK - Výdejní box SK
     */
    public const INTIME_BOX_SK = '11';

    /**
     * 24 hodin (Standard)
     */
    public const TOPTRANS_STANDARD = '1';

    /**
     * Toptime
     */
    public const TOPTRANS_TOPTIME = '2';

    /**
     * Privat
     */
    public const TOPTRANS_PRIVATE = '3';

    /**
     * Weekend
     */
    public const TOPTRANS_WEEKEND = '4';

    /**
     * Osobní odběr
     */
    public const TOPTRANS_PERSONAL = '5';

    /**
     * Po avizaci
     */
    public const TOPTRANS_NOTICE = '6';

    /**
     * Balík na adresu – zmluvní zákazníci
     */
    public const SP_BZA = 'BZA';

    /**
     * Balík na poštu – zmluvní zákazníci
     */
    public const SP_BZP = 'BZP';

    /**
     * Balík do BalíkoBOXu
     */
    public const SP_BZB = 'BZB';

    /**
     * Expres kuriér na adresu
     */
    public const SP_EXA = 'EXA';

    /**
     * Expres kuriér na poštu
     */
    public const SP_EXP = 'EXP';

    /**
     * Expres kuriér do BalíkoBOXu
     */
    public const SP_EXB = 'EXB';

    /**
     * Balík na adresu
     */
    public const SP_BNA = 'BNA';

    /**
     * Balík na poštu
     */
    public const SP_BNP = 'BNP';

    /**
     * Balík do BalíkoBOXu
     */
    public const SP_BNB = 'BNB';

    /**
     * Doporučený list
     */
    public const SP_RRA = 'RRA';

    /**
     * Expres (vnitrostátní zásilky)
     */
    public const SPS_EXPRESS = '1';

    /**
     * Expres do 12:00 (vnitrostátní zásilky)
     */
    public const SPS_EXPRESS_12 = '2';

    /**
     * Expres do 09:00 (vnitrostátní zásilky)
     */
    public const SPS_EXPRESS_9 = '3';

    /**
     * Export (mezinárodní zásilky)
     */
    public const SPS_INTERNATIONAL = '4';

    /**
     * Uloženka
     */
    public const ULOZENKA_ULOZENKA = '1';

    /**
     * Slovenská pošta
     */
    public const ULOZENKA_SP = '2';

    /**
     * DPD Classic na Slovensko
     */
    public const ULOZENKA_DPD_CLASSIC_SK = '3';

    /**
     * DPD Private pro ČR a SK
     */
    public const ULOZENKA_DPD_PRIVATE = '4';

    /**
     * DPD ParcelShop
     */
    public const ULOZENKA_DPD_PARCEL = '5';

    /**
     * Balík do ruky – Česká pošta,
     */
    public const ULOZENKA_CP_DR = '6';

    /**
     * Balík na poštu – Česká pošta
     */
    public const ULOZENKA_CP_NP = '7';

    /**
     * Partner
     */
    public const ULOZENKA_PARTNER = '11';

    /**
     * Doručení na adresu D+1
     */
    public const ULOZENKA_D1 = '17';

    /**
     * Expres Kurýr SK
     */
    public const ULOZENKA_EXPRESS_COURRIER = '19';

    /**
     * Expres na poštu SK
     */
    public const ULOZENKA_EXPRESS_SK = '20';

    /**
     * BalíkoBOX SK
     */
    public const ULOZENKA_BALIKOBOX_SK = '21';

    /**
     * Depo SK
     */
    public const ULOZENKA_DEPO_SK = '22';

    /**
     * Mall Delivery
     */
    public const ULOZENKA_MALL_DELIVERY = '100';

    /**
     * Výdejní místa Česká republika
     */
    public const ZASILKOVNA_VMCZ = 'VMCZ';

    /**
     * Výdejní místa Slovenská republika
     */
    public const ZASILKOVNA_VMSK = 'VMSK';

    /**
     * Výdejní místa Maďarsko
     */
    public const ZASILKOVNA_VMHU = 'VMHU';

    /**
     * Výdejní místa Polsko
     */
    public const ZASILKOVNA_VMPL = 'VMPL';

    /**
     * Výdejní místa Rumunsko
     */
    public const ZASILKOVNA_VMRO = 'VMRO';

    /**
     * AT Rakouská pošta HD
     */
    public const ZASILKOVNA_AT_POST_HD = '80';

    /**
     * AT DPD HD
     */
    public const ZASILKOVNA_AT_DPD_HD = '6830';

    /**
     * BE Belgická pošta PP
     */
    public const ZASILKOVNA_BE_POST_PP = '7910';

    /**
     * BE Belgická pošta HD
     */
    public const ZASILKOVNA_BE_POST_HD = '7909';

    /**
     * BE Nizozemská pošta HD
     */
    public const ZASILKOVNA_BE_NL_POST_HD = '4832';

    /**
     * BG Econt HD
     */
    public const ZASILKOVNA_BG_ECONT_HD = '19469';

    /**
     * BG Econt PP
     */
    public const ZASILKOVNA_BG_ECONT_PP = '19471';

    /**
     * BG Speedy PP
     */
    public const ZASILKOVNA_BG_SPEEDY_PP = '4017';

    /**
     * BG Speedy HD
     */
    public const ZASILKOVNA_BG_SPEEDY_HD = '4015';

    /**
     * BG Econt Box
     */
    public const ZASILKOVNA_BG_ECONT_BOX = '19470';

    /**
     * CZ Česká pošta HD
     */
    public const ZASILKOVNA_CZ_POST_HD = '13';

    /**
     * CZ - Nejvýhodnější doručení na adresu
     */
    public const ZASILKOVNA_CZ_COURIER_HD = '106';

    /**
     * Expresní doručení Praha
     */
    public const ZASILKOVNA_CZ_EXPRESS_PRAHA_HD = '18928';

    /**
     * Expresní doručení Brno
     */
    public const ZASILKOVNA_CZ_EXPRESS_BRNO_HD = '136';

    /**
     * Expresní doručení Ostrava
     */
    public const ZASILKOVNA_CZ_EXPRESS_OSTRAVA_HD = '134';

    /**
     * CZ Doručování do kufru
     */
    public const ZASILKOVNA_CZ_CAR_TRUNK = '25061';

    /**
     * "CZ Zásilkovna večerní doručení Brno HD
     */
    public const ZASILKOVNA_CZ_EVENING_BRNO_HD = '26637';

    /**
     * DE Německá pošta DHL HD
     */
    public const ZASILKOVNA_DE_POST_HD = '111';

    /**
     * Německo Hermes PP
     */
    public const ZASILKOVNA_DE_HERMES_PP = '6828';

    /**
     * DE Hermes Home
     */
    public const ZASILKOVNA_DE_HERMES_HD = '6373';

    /**
     * DE Home Delivery HD
     */
    public const ZASILKOVNA_DE_HOME_DELIVERY_HD = '13613';

    /**
     * DK Post Nord Home
     */
    public const ZASILKOVNA_DK_POST_NORD_HD = '4993';

    /**
     * DK Post Nord PP
     */
    public const ZASILKOVNA_DK_POST_NORD_PP = '4994';

    /**
     * DK DAO HD
     */
    public const ZASILKOVNA_DK_DAO_HD = '9725';

    /**
     * DK DAO PP
     */
    public const ZASILKOVNA_DK_DAO_PP = '9726';

    /**
     * EE Omniva Home
     */
    public const ZASILKOVNA_EE_OMNIVA_HD = '5060';

    /**
     * EE Omniva pickup
     */
    public const ZASILKOVNA_EE_OMNIVA_PP = '5061';

    /**
     * EE Omniva Box
     */
    public const ZASILKOVNA_EE_OMNIVA_BOX = '5062';

    /**
     * ES Correos HD
     */
    public const ZASILKOVNA_ES_CORREOS_HD = '4638';

    /**
     * ES MRW Home
     */
    public const ZASILKOVNA_ES_MRW_HD = '4653';

    /**
     * ES Envialia HD
     */
    public const ZASILKOVNA_ES_ENVIALIA_HD = '13851';

    /**
     * ES MRW Pickup Point
     */
    public const ZASILKOVNA_ES_MRW_PP = '4654';

    /**
     * FI Post Nord Home
     */
    public const ZASILKOVNA_FI_POST_NORD_HP = '4830';

    /**
     * FI Post Nord Pickup Point
     */
    public const ZASILKOVNA_FI_POST_NORD_PP = '4828';

    /**
     * FR Colis Privé HD
     */
    public const ZASILKOVNA_FR_COLIS_PRIVE_HD = '4033';

    /**
     * FR Mondial PP
     */
    public const ZASILKOVNA_FR_MONDIAL_PP = '4876';

    /**
     * Francie Colissimo PP
     */
    public const ZASILKOVNA_FR_COLISSIMO_PP = '4307';

    /**
     * Francie Colissimo Home
     */
    public const ZASILKOVNA_FR_COLISSIMO_HD = '4309';

    /**
     * FR Mondial Relay PP
     */
    public const ZASILKOVNA_FR_MONDIAL_RELAY_PP = '12889';

    /**
     * Fr Colis Privé Direct HD
     */
    public const ZASILKOVNA_FR_COLIS_PRIVE_DIRECT_HD = '16080';

    /**
     * Spojené království Hermes
     */
    public const ZASILKOVNA_GB_HERMES_HD = '3885';

    /**
     * Spojené království Royal Mail 24
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL_24_HD = '4856';

    /**
     * Spojené království Royal Mail 48
     */
    public const ZASILKOVNA_GB_ROYAL_MAIL_48_HD = '4857';

    /**
     * GR Taxydromiki
     */
    public const ZASILKOVNA_GR_TAXYDROMIKI = '8847';

    /**
     * GR ACS HD
     */
    public const ZASILKOVNA_GR_ACS_HD = '17465';

    /**
     * GR ACS PP
     */
    public const ZASILKOVNA_GR_ACS_PP = '17467';

    /**
     * Recko Speedy Home
     */
    public const ZASILKOVNA_GR_SPEEDY_HD = '4738';

    /**
     * GR Speedex HD
     */
    public const ZASILKOVNA_GR_SPEEDEX_HD = '12235';

    /**
     * GR BoxNow Box
     */
    public const ZASILKOVNA_GR_BOXNOW_BOX = '20409';

    /**
     * HR Overseas Express HD
     */
    public const ZASILKOVNA_HR_OVERSEAS_HD = '10618';

    /**
     * HR Overseas PP
     */
    public const ZASILKOVNA_HR_OVERSEAS_PP = '10619';

    /**
     * Chorvatsko DPD Home
     */
    public const ZASILKOVNA_HR_DPD_HD = '4646';

    /**
     * Chorvatská Pošta - Výdejní místo
     */
    public const ZASILKOVNA_HR_POST_PP = '4635';

    /**
     * Chorvatská Pošta - doručení na adresu
     */
    public const ZASILKOVNA_HR_POST_HD = '4634';

    /**
     * Maďarsko Express One (Transoflex)
     */
    public const ZASILKOVNA_HU_EXPRESS_ONE_HD = '151';

    /**
     * Maďarsko DPD
     */
    public const ZASILKOVNA_HU_DPD_HD = '805';

    /**
     * HU - best delivery solution
     */
    public const ZASILKOVNA_HU_COURIER_HD = '4159';

    /**
     * Maďarská pošta
     */
    public const ZASILKOVNA_HU_POST_HD = '763';

    /**
     * HU Fáma Futár HD
     */
    public const ZASILKOVNA_HU_FAMA_FUTAR_HD = '10061';

    /**
     * Švýcarsko-Lichtenštejnská Pošta - prioritní
     */
    public const ZASILKOVNA_CH_POST_PRIORITY_HD = '3870';

    /**
     * Švýcarsko-Lichtejnštejnská Pošta
     */
    public const ZASILKOVNA_CH_POST_HD = '3294';

    /**
     * Irsko Hermes
     */
    public const ZASILKOVNA_IE_HERMES_HD = '4524';

    /**
     * IE Anpost HD
     */
    public const ZASILKOVNA_IE_ANPOST_HD = '9990';

    /**
     * IE FedEx HD Connect Plus
     */
    public const ZASILKOVNA_IE_FEDEX_HD_CONNECT_PLUS = '24810';

    /**
     * IE FedEx HD Priority
     */
    public const ZASILKOVNA_IE_FEDEX_HD_PRIORITY = '24811';

    /**
     * IT Bartolini Home
     */
    public const ZASILKOVNA_IT_BARTOLINI_HD = '9103';

    /**
     * IT Bartolini PP
     */
    public const ZASILKOVNA_IT_BARTOLINI_PP = '9104';

    /**
     * Itálie GLS
     */
    public const ZASILKOVNA_IT_GLS_HD = '2726';

    /**
     * IT HR Parcel HD
     */
    public const ZASILKOVNA_IT_HR_PARCEL_HD = '12154';

    /**
     * LT Omniva Box
     */
    public const ZASILKOVNA_LT_OMNIVA_BOX = '5066';

    /**
     * LT Omniva Home
     */
    public const ZASILKOVNA_LT_OMNIVA_HD = '5065';

    /**
     * LU Lucemburská pošta HD
     */
    public const ZASILKOVNA_LU_POST_HD = '8125';

    /**
     * LU DPD
     */
    public const ZASILKOVNA_LU_DPD_HD = '4834';

    /**
     * LV Omniva Box
     */
    public const ZASILKOVNA_LV_OMNIVA_BOX = '5064';

    /**
     * LV Omniva Home
     */
    public const ZASILKOVNA_LV_OMNIVA_HD = '5063';

    /**
     * NL DHL HD
     */
    public const ZASILKOVNA_NL_DHL_HD = '8000';

    /**
     * NL Post
     */
    public const ZASILKOVNA_NL_POST_HD = '4329';

    /**
     * NL DHL PP
     */
    public const ZASILKOVNA_NL_DHL_PP = '8001';

    /**
     * Polská pošta 24h
     */
    public const ZASILKOVNA_PL_POST_24_HD = '1438';

    /**
     * Polská pošta
     */
    public const ZASILKOVNA_PL_POST_48_HD = '272';

    /**
     * Polsko DPD
     */
    public const ZASILKOVNA_PL_DPD_HD = '1406';

    /**
     * PL - best delivery solution
     */
    public const ZASILKOVNA_PL_COURIER_HD = '4162';

    /**
     * PL Polská pošta PP
     */
    public const ZASILKOVNA_PL_POST_PP = '14052';

    /**
     * Polsko Paczkomaty
     */
    public const ZASILKOVNA_PL_INPOST_PACZKOMATY_BOX = '3060';

    /**
     * Polsko InPost
     */
    public const ZASILKOVNA_PL_INPOST_HD = '3603';

    /**
     * PT MRW Home
     */
    public const ZASILKOVNA_PT_MRW_HD = '4655';

    /**
     * PT MRW PP
     */
    public const ZASILKOVNA_PT_MRW_PP = '4656';

    /**
     * RO - best delivery solution
     */
    public const ZASILKOVNA_RO_COURIER_HD = '4161';

    /**
     * Rumunsko Cargus
     */
    public const ZASILKOVNA_RO_URGENT_CARGUS_HD = '590';

    /**
     * Rumunsko Sameday box
     */
    public const ZASILKOVNA_RO_SAMEDAY_BOX = '7455';

    /**
     * Rumunsko DPD
     */
    public const ZASILKOVNA_RO_DPD_HD = '836';

    /**
     * Rumunsko Sameday HD
     */
    public const ZASILKOVNA_RO_SAMEDAY_HD = '7397';

    /**
     * Rumunsko FAN
     */
    public const ZASILKOVNA_RO_FAN_COURIER_HD = '762';

    /**
     * Ruská pošta
     */
    public const ZASILKOVNA_RU_POST_PP = '4559';

    /**
     * RU Post Registered Packet
     */
    public const ZASILKOVNA_RU_POST_RECOMMENDED_PP = '5102';

    /**
     * RU Post EMS
     */
    public const ZASILKOVNA_RU_EMS_HD = '5101';

    /**
     * SE Post Nord pp
     */
    public const ZASILKOVNA_SE_POST_NORD_PP = '4826';

    /**
     * SE Post Nord Home
     */
    public const ZASILKOVNA_SE_POST_NORD_HD = '4827';

    /**
     * SI DPD Home
     */
    public const ZASILKOVNA_SI_DPD_HD = '4949';

    /**
     * SI DPD Pickup
     */
    public const ZASILKOVNA_SI_DPD_PP = '4950';

    /**
     * SI Post HD
     */
    public const ZASILKOVNA_SI_POST_HD = '19515';

    /**
     * SI Post PP
     */
    public const ZASILKOVNA_SI_POST_PP = '19516';

    /**
     * SI Post Box
     */
    public const ZASILKOVNA_SI_POST_BOX = '19517';

    /**
     * Expresné doručenie Bratislava
     */
    public const ZASILKOVNA_SK_EXPRESS_BRATISLAVA_HD = '132';

    /**
     * SK - Best delivery solution
     */
    public const ZASILKOVNA_SK_COURIER_HD = '131';

    /**
     * Slovenská pošta
     */
    public const ZASILKOVNA_SK_POST_HD = '16';

    /**
     * Ukrajina Nova Poshta
     */
    public const ZASILKOVNA_UA_NOVA_POSHTA_PP = '3616';

    /**
     * Ukrajina Rosan
     */
    public const ZASILKOVNA_UA_ROSAN_HD = '1160';

    /**
     * US FedEx HD Economy
     */
    public const ZASILKOVNA_US_FEDEX_ECONOMY_HD = '19326';

    /**
     * US FedEx HD Priority
     */
    public const ZASILKOVNA_US_FEDEX_PRIORITY_HD = '19325';

    /**
     * TR FedEx HD Economy
     */
    public const ZASILKOVNA_TR_FEDEX_ECONOMY_HD = '19327';

    /**
     * TR FedEx HD Priority
     */
    public const ZASILKOVNA_TR_FEDEX_PRIORITY_HD = '19328';

    /**
     * IL FedEx HD Priority
     */
    public const ZASILKOVNA_IL_FEDEX_PRIORITY_HD = '19329';

    /**
     * IL FedEx HD Economy
     */
    public const ZASILKOVNA_IL_FEDEX_ECONOMY_HD = '19330';

    /**
     * EE Lithuanian Post HD
     */
    public const ZASILKOVNA_EE_LT_POST_HD = '18805';

    /**
     * LV Lithuanian Post HD
     */
    public const ZASILKOVNA_LV_LT_POST_HD = '18807';

    /**
     * LT Lithuanian Post HD
     */
    public const ZASILKOVNA_LT_POST_HD = '18808';

    /**
     * LT Lithuanian Post Box
     */
    public const ZASILKOVNA_LT_POST_BOX = '18809';

    /**
     * DHL
     */
    public const PBH_DHL = '1';

    /**
     * GLS
     */
    public const PBH_GLS = '2';

    /**
     * SPS
     */
    public const PBH_SPS = '3';

    /**
     * Slovenská pošta
     */
    public const PBH_SP = '4';

    /**
     * Transoflex
     */
    public const PBH_TRANSOFLEX = '5';

    /**
     * Maďarská pošta
     */
    public const PBH_MP = '6';

    /**
     * Cargus
     */
    public const PBH_CARGUS = '7';

    /**
     * Rakouská pošta
     */
    public const PBH_RP = '8';

    /**
     * Česká pošta – Balík do ruky
     */
    public const PBH_CP_DR = '9';

    /**
     * Česká pošta – Balík na poštu
     */
    public const PBH_CP_NP = '10';

    /**
     * PPL
     */
    public const PBH_PPL = '11';

    /**
     * DPD
     */
    public const PBH_DPD = '12';

    /**
     * Polská pošta
     */
    public const PBH_PP = '13';

    /**
     * polský Inpost Kurier
     */
    public const PBH_INPOST_KURIER = '14';

    /**
     * FAN Courier
     */
    public const PBH_FAN_KURIER = '15';

    /**
     * Hermes
     */
    public const PBH_HERMES = '16';

    /**
     * Speedy
     */
    public const PBH_SPEEDY = '17';

    /**
     * Colissimo
     */
    public const PBH_COLISSIMO = '18';

    /**
     * Meest
     */
    public const PBH_MEEST = '19';

    /**
     * Nova Poshta
     */
    public const PBH_NOBA_POSHTA = '20';

    /**
     * Econt
     */
    public const PBH_ECONT = '21';

    /**
     * ACS
     */
    public const PBH_ACS = '22';

    /**
     * Correos
     */
    public const PBH_CORREOS = '23';

    /**
     * 123 Kuriér
     */
    public const PBH_123_KURIER = '24';

    /**
     * RoyalMail 24h
     */
    public const PBH_ROYAL_MAIL_24 = '25';

    /**
     * RoyalMail 48h
     */
    public const PBH_ROYAL_MAIL_48 = '26';

    /**
     * Express one
     */
    public const PBH_EXPRESS_ONE = '27';

    /**
     * Express UPS
     */
    public const PBH_UPS = '28';

    /**
     * Worlwide zásilky
     */
    public const DHL_WORLDWIDE = '1';

    /**
     * Express Worldwide dokumenty
     */
    public const DHL_EXPRESS_DOCUMENTS = '2';

    /**
     * Express Worldwide 9:00
     */
    public const DHL_EXPRESS_WORLDWIDE_9 = '3';

    /**
     * Express Worldwide 12:00
     */
    public const DHL_EXPRESS_WORLDWIDE_12 = '4';

    /**
     * Economy Select
     */
    public const DHL_ECONOMY = '5';

    /**
     * Domestic Express 12:00
     */
    public const DHL_DOMESTIC_12 = '6';

    /**
     * Domestic Express
     */
    public const DHL_DOMESTIC_EXPRESS = '7';

    /**
     * Medical Express
     */
    public const DHL_MEDICAL_EXPRESS = '8';

    /**
     * Express
     */
    public const UPS_EXPRESS = '1';

    /**
     * Express Saver
     */
    public const UPS_EXPRESS_SAVER = '2';

    /**
     * Standard
     */
    public const UPS_STANDARD = '3';

    /**
     * Expedited
     */
    public const UPS_EXPEDITED = '4';

    /**
     * Express
     */
    public const TNT_EXPRESS = '1';

    /**
     * Express 9:00
     */
    public const TNT_EXPRESS_9 = '2';

    /**
     * Express 12:00
     */
    public const TNT_EXPRESS_12 = '3';

    /**
     * Economy Express
     */
    public const TNT_ECONOMY_EXPRESS = '4';

    /**
     * Night Express 8:00
     */
    public const TNT_NIGHT_EXPRESS_8 = '5';

    /**
     * Economy Express 12:00
     */
    public const TNT_ECONOMY_EXPRESS_12 = '6';

    /**
     * Express 10:00
     */
    public const TNT_EXPRESS_10 = '7';

    /**
     * Express (Documents)
     */
    public const TNT_EXPRESS_DOCUMENTS = '8';

    /**
     * Express 9:00 (Documents)
     */
    public const TNT_EXPRESS_DOCUMENTS_9 = '9';

    /**
     * Express 10:00 (Documents)
     */
    public const TNT_EXPRESS_DOCUMENTS_10 = '10';

    /**
     * Express 12:00 (Documents)
     */
    public const TNT_EXPRESS_DOCUMENTS_12 = '11';

    /**
     * Night Express 12:00
     */
    public const TNT_NIGHT_EXPRESS_12 = '12';

    /**
     * Night Express 06:00
     */
    public const TNT_NIGHT_EXPRESS_6 = '13';

    /**
     * Night Express 07:00
     */
    public const TNT_NIGHT_EXPRESS_7 = '14';

    /**
     * Night Express 14:00
     */
    public const TNT_NIGHT_EXPRESS_14 = '15';

    /**
     * Special economy express
     */
    public const TNT_SPECIAL_ECONOMY_EXPRESS = '16';

    /**
     * Direct Infeed
     */
    public const TNT_DIRECT_INFEED = '17';

    /**
     * Priority Goods 9:00
     */
    public const GW_PRIORITY_9 = 'P9';

    /**
     * Priority Goods 12:00
     */
    public const GW_PRIORITY_12 = 'P12';

    /**
     * Priority Goods 16:00
     */
    public const GW_PRIORITY_16 = 'P16';

    /**
     * Direct Goods
     */
    public const GW_DIRECT_GOODS = 'WDG';

    /**
     * Pick Up
     */
    public const GW_PICKUP = 'BES';

    /**
     * Pickup by Consignee
     */
    public const GW_PICKUP_BY_CONSIGNEE = 'SA';

    /**
     * Domestic PRON
     */
    public const GW_DOMESTIC = 'W24';

    /**
     * HDS - Home Delivery Services
     */
    public const GW_HOME_DELIVERY = 'HDS';

    /**
     * Export PROI
     */
    public const GW_EXPORT = 'EUR';

    /**
     * Domestic PRON
     */
    public const GW_W24 = 'W24';

    /**
     * Domestic 8:00 - 12:00
     */
    public const GW_D8 = 'D8';

    /**
     * Domestic 12:00 - 14:00
     */
    public const GW_D12 = 'D12';

    /**
     * Domestic 14:00 - 18:00
     */
    public const GW_D14 = 'D14';

    /**
     * Export PROI
     */
    public const GW_EUR = 'EUR';

    /**
     * Standard
     */
    public const MESSENGER_STANDARD = '100';

    /**
     * Extreme
     */
    public const MESSENGER_EXTREME = '102';

    /**
     * Express
     */
    public const MESSENGER_EXPRESS = '103';

    /**
     * Same day
     */
    public const MESSENGER_SAME_DAY = '104';

    /**
     * Overnight Economy
     */
    public const MESSENGER_OVERNIGHT_ECONOMY = '106';

    /**
     * Overnight Express
     */
    public const MESSENGER_OVERNIGHT_EXPRESS = '107';

    /**
     * Direct
     */
    public const MESSENGER_DIRECT = '108';

    /**
     * Economy (Brno)
     */
    public const MESSENGER_ECONOMY_BRNO = '114';

    /**
     * Praha – 9-13h
     */
    public const MESSENGER_PRAGUE_09_13 = '205';

    /**
     * Praha – 13-17h
     */
    public const MESSENGER_PRAGUE_13_17 = '206';

    /**
     * Praha – 17-21h
     */
    public const MESSENGER_PRAGUE_17_21 = '207';

    /**
     * DHL Paket
     */
    public const DHLDE_PAKET = '1';

    /**
     * DHL Paket Taggleich
     */
    public const DHLDE_PAKET_TAGGLEICH = '2';

    /**
     * DHL Paket International
     */
    public const DHLDE_PAKET_INTERNATIONAL = '3';

    /**
     * DHL Europaket
     */
    public const DHLDE_EUROPAKET = '4';

    /**
     * DHL Paket Connect
     */
    public const DHLDE_PAKET_CONNECT = '5';

    /**
     * FedEx International Priority
     */
    public const FEDEX_INTERNATIONAL = '1';

    /**
     * FedEx International Economy
     */
    public const FEDEX_ECONOMY = '2';

    /**
     * FedEx International First
     */
    public const FEDEX_INTERNATIONAL_FIRST = '3';

    /**
     * FedEx International Priority Express
     */
    public const FEDEX_INTERNATIONAL_PRIORITY_EXPRESS = '4';

    /**
     * FedEx International Priority
     */
    public const FEDEX_INTERNATIONAL_PRIORITY = '5';

    /**
     * FedEx FedEx Regional Economy
     */
    public const FEDEX_REGIONAL_ECONOMY = '6';

    /**
     * FedEx International Priority Freight
     */
    public const FEDEX_INTERNATIONAL_PRIORITY_FREIGHT = '7';

    /**
     * FedEx International Economy Freight
     */
    public const FEDEX_INTERNATIONAL_ECONOMY_FREIGHT = '8';

    /**
     * FedEx Fedex Regional Economy Freight
     */
    public const FEDEX_REGIONAL_ECONOMY_FREIGHT = '9';

    /**
     * FedEx International Connect Plus
     */
    public const FEDEX_INTERNATIONAL_CONNECT_PLUS = '10';

    /**
     * FedEx Priority Overnight
     */
    public const FEDEX_PRIORITY_OVERNIGHT = '11';

    /**
     * Fofr
     */
    public const FOFR_FOFR = 'F';

    /**
     * Fofr Economy
     */
    public const FOFR_ECONOMY = 'C';

    /**
     * Fofr Balíková přeprava
     */
    public const FOFR_PARCEL = 'B';

    /**
     * Fofr Paletová přeprava
     */
    public const FOFR_PALETTE = 'P';

    /**
     * Fofr Nadrozměrná zásilka
     */
    public const FOFR_OVERSIZED = 'N';

    /**
     * Fofr Slovensko
     */
    public const FOFR_SK = 'S';

    /**
     * Fofr Zahraničí
     */
    public const FOFR_ABROAD = 'Z';

    /**
     * Dachser Targospeed
     */
    public const DACHSER_SPEED = 'Z';

    /**
     * Dachser Targospeed 10
     */
    public const DACHSER_SPEED_10 = 'S';

    /**
     * Dachser Targospeed 12
     */
    public const DACHSER_SPEED_12 = 'E';

    /**
     * Dachser Targospeed plux
     */
    public const DACHSER_SPEED_PLUS = 'X';

    /**
     * Dachser Targofix
     */
    public const DACHSER_FIX = 'V';

    /**
     * Dachser Targofix 10
     */
    public const DACHSER_FIX_10 = 'R';

    /**
     * Dachser Targofix 12
     */
    public const DACHSER_FIX_12 = 'W';

    /**
     * Dachser Targoflex
     */
    public const DACHSER_FLEX = 'Y';

    /**
     * Dachser Targo on-site
     */
    public const DACHSER_ONSITE = 'A';

    /**
     * Dachser classicline
     */
    public const DACHSER_CLASSIC = 'N';

    /**
     * DHL Parcel Connect
     */
    public const DHLPARCEL_CONNECT = '1';

    /**
     * Raben Cargo Classic
     */
    public const RABEN_CLASSIC = 'PROD01';

    /**
     * Raben Cargo Classic - Time slot
     */
    public const RABEN_CLASSIC_TIME = 'PROD01-RTS';

    /**
     * Raben Cargo Premium
     */
    public const RABEN_PREMIUM = 'PROD02';

    /**
     * Raben Cargo Premium - Time slot
     */
    public const RABEN_PREMIUM_TIME = 'PROD02-RTS';

    /**
     * Raben Cargo Premium - Delivery till 12:00 p
     */
    public const RABEN_PREMIUM_12 = 'PROD02-ND12';

    /**
     * Raben Cargo Premium - Fixed date
     */
    public const RABEN_PREMIUM_FIX = 'PROD02-FIX';

    /**
     * Spring Tracked
     */
    public const SPRING_TRACKED = 'TRCK';

    /**
     * Spring Signatured
     */
    public const SPRING_SIGNATURED = 'SIGN';

    /**
     * Spring Untracked
     */
    public const SPRING_UNTRACKED = 'UNTR';

    /**
     * DSV Road
     */
    public const DSV_ROAD = 'road';

    /**
     * DSV B2C
     */
    public const DSV_B2C = 'b2c';

    /**
     * DHLFREIGHTEC EuroConnect Domestic B2B
     */
    public const DHLFREIGHTEC_ECD_B2B = 'ECD_B2B';

    /**
     * DHLFREIGHTEC EuroConnect Domestic B2C
     */
    public const DHLFREIGHTEC_ECD_B2C = 'ECD_B2C';

    /**
     * DHLFREIGHTEC EuroConnect International
     */
    public const DHLFREIGHTEC_ECI = 'ECI';

    /**
     * DHLFREIGHTEC EuroRapid International
     */
    public const DHLFREIGHTEC_ERI = 'ERI';

    /**
     * KURIER Garantované doručení
     */
    public const KURIER_GARANTED = 'gdd';

    /**
     * KURIER Garantované doručení na výdejní místo
     */
    public const KURIER_GARANTED_BRANCH = 'gdd_branch';

    /**
     * KURIER Doručení do 12h
     */
    public const KURIER_12 = 'd12';

    /**
     * KURIER Standard
     */
    public const KURIER_STANDARD = 'std';

    /**
     * KURIER Standard na výdejní místo
     */
    public const KURIER_STANDARD_BRANCH = 'std_branch';

    /**
     * DB Schenker System FIX
     */
    public const DBSCHENKER_SYSTEM_FIX = '35';

    /**
     * DB Schenker System FIX TBA
     */
    public const DBSCHENKER_SYSTEM_FIX_TBA = '39';

    /**
     * DB Schenker System
     */
    public const DBSCHENKER_SYSTEM = '43';

    /**
     * DB Schenker System Premium
     */
    public const DBSCHENKER_SYSTEM_PREMIUM = '44';

    /**
     * DB Schenker System Premium 10
     */
    public const DBSCHENKER_SYSTEM_PREMIUM_10 = '55';

    /**
     * DB Schenker System Premium 13
     */
    public const DBSCHENKER_SYSTEM_PREMIUM_13 = '56';

    /**
     * DB Schenker System FIX 10
     */
    public const DBSCHENKER_SYSTEM_FIX_10 = '57';

    /**
     * DB Schenker System FIX 13
     */
    public const DBSCHENKER_SYSTEM_FIX_13 = '58';

    /**
     * DB Schenker Full Load
     */
    public const DBSCHENKER_FULL_LOAD = '71';

    /**
     * DB Schenker Part Load
     */
    public const DBSCHENKER_PART_LOAD = '72';

    /**
     * DB Schenker Parcel
     */
    public const DBSCHENKER_LPA = 'LPA';

    /**
     * Airway Express
     */
    public const AIRWAY_EXPRESS = '1';

    /**
     * Airway Normal
     */
    public const AIRWAY_NORMAL = '2';

    /**
     * Airway Economy
     */
    public const AIRWAY_ECONOMY = '3';

    /**
     * Airway Same Day
     */
    public const AIRWAY_SAME_DAY = '4';

    /**
     * Airway Prague 9-13
     */
    public const AIRWAY_PRAGUE_13 = '5';

    /**
     * Airway Prague 13-17
     */
    public const AIRWAY_PRAGUE_17 = '6';

    /**
     * Airway Prague 17-21
     */
    public const AIRWAY_PRAGUE_21 = '7';

    /**
     * Airway Další den
     */
    public const AIRWAY_NEXT_DAY = '8';

    /**
     * Airway Další pracovní den
     */
    public const AIRWAY_NEXT_WEEKDAY = '9';

    /**
     * JAPO Standard
     */
    public const JAPO_STANDARD = 'STANDARD';

    /**
     * Liftago Express
     */
    public const LIFTAGO_EXPRESS = 'express';

    /**
     * Liftago Standard
     */
    public const LIFTAGO_STANDARD = 'standard';

    /**
     * Liftago Standard 6-8h
     */
    public const LIFTAGO_STANDARD_8 = 'standard-6-8';

    /**
     * Liftago Standard 8-10h
     */
    public const LIFTAGO_STANDARD_10 = 'standard-8-10';

    /**
     * Liftago Standard 10-12h
     */
    public const LIFTAGO_STANDARD_12 = 'standard-10-12';

    /**
     * Liftago Standard 12-14h
     */
    public const LIFTAGO_STANDARD_14 = 'standard-12-14';

    /**
     * Liftago Standard 14-16h
     */
    public const LIFTAGO_STANDARD_16 = 'standard-14-16';

    /**
     * Liftago Standard 16-18h
     */
    public const LIFTAGO_STANDARD_18 = 'standard-16-18';

    /**
     * Liftago Standard 18-20h
     */
    public const LIFTAGO_STANDARD_20 = 'standard-18-20';

    /**
     * Liftago Standard 20-22h
     */
    public const LIFTAGO_STANDARD_22 = 'standard-20-22';

    /**
     * MPL Business parcel (Domestic)
     */
    public const MAGYARPOSTA_MPL_BUSINESS = 'A_175_UZL';

    /**
     * MPL Postal Parcel (Domestic)
     */
    public const MAGYARPOSTA_MPL_POST = 'A_177_MPC';

    /**
     * International priority postal parcel
     */
    public const MAGYARPOSTA_INTERNATIONAL_PRIORITY = 'A_122_ECS';

    /**
     * International postal parcel
     */
    public const MAGYARPOSTA_INTERNATIONAL = 'A_121_CSG';

    /**
     * Europe+ parcel
     */
    public const MAGYARPOSTA_EUROPE_PLUS = 'A_123_EUP';

    /**
     * MPL Europe Standard
     */
    public const MAGYARPOSTA_EUROPE_STANDARD = 'A_125_HAR';

    /**
     * 3H
     */
    public const SAMEDAY_3H = '2';

    /**
     * 3H
     */
    public const SAMEDAY_6H = '3';

    /**
     * 6H
     */
    public const SAMEDAY_EXCLUSIVE = '4';

    /**
     * 24H
     */
    public const SAMEDAY_24H = '7';

    /**
     * Return Standard
     */
    public const SAMEDAY_STANDARD_RETURN = '10';

    /**
     * Locker Next Day
     */
    public const SAMEDAY_LOCKER_NEXT_DAY = '15';

    /**
     * Locker Return
     */
    public const SAMEDAY_LOCKER_RETURN = '24';

    /**
     * SDS Standard
     */
    public const SDS_STANDART = 'Standard';

    /**
     * @return array<string>|null
     */
    public static function getForCarrier(string $carrier): ?array
    {
        return self::getForCarriers()[$carrier] ?? null;
    }

    /**
     * @return array<string,array<string>>
     */
    private static function getForCarriers(): array
    {
        return [
            Carrier::CP           => self::cp(),
            Carrier::DPD          => self::dpd(),
            Carrier::DHL          => self::dhl(),
            Carrier::GEIS         => self::geis(),
            Carrier::GLS          => self::gls(),
            Carrier::INTIME       => self::intime(),
            Carrier::PBH          => self::pbh(),
            Carrier::PPL          => self::ppl(),
            Carrier::SP           => self::sp(),
            Carrier::SPS          => self::sps(),
            Carrier::TOPTRANS     => self::topTrans(),
            Carrier::ULOZENKA     => self::ulozenka(),
            Carrier::UPS          => self::ups(),
            Carrier::ZASILKOVNA   => self::zasilkovna(),
            Carrier::TNT          => self::tnt(),
            Carrier::GW           => self::gw(),
            Carrier::GWCZ         => self::gwcz(),
            Carrier::MESSENGER    => self::messenger(),
            Carrier::DHLDE        => self::dhlde(),
            Carrier::FEDEX        => self::fedex(),
            Carrier::FOFR         => self::fofr(),
            Carrier::DACHSER      => self::dachser(),
            Carrier::DHLPARCEL    => self::dhlparcel(),
            Carrier::RABEN        => self::raben(),
            Carrier::SPRING       => self::spring(),
            Carrier::DSV          => self::dsv(),
            Carrier::DHLFREIGHTEC => self::dhlfreightec(),
            Carrier::KURIER       => self::kurier(),
            Carrier::DBSCHENKER   => self::dbschenker(),
            Carrier::AIRWAY       => self::airway(),
            Carrier::JAPO         => self::japo(),
            Carrier::LIFTAGO      => self::liftago(),
            Carrier::MAGYARPOSTA  => self::magyarposta(),
            Carrier::SAMEDAY      => self::sameday(),
            Carrier::SDS          => self::sds(),
        ];
    }

    /** @return array<string> */
    private static function cp(): array
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
            // self::CP_DS,
            self::CP_EE,
            // self::CP_BE,
            self::CP_RZP,
            self::CP_VZP,
            self::CP_EM,
            self::CP_CSP,
            self::CP_CSE,
            self::CP_CVP,
            self::CP_CVE,
            self::CP_CE,
            self::CP_OLZ,
        ];
    }

    /** @return array<string> */
    private static function dpd(): array
    {
        return [
            self::DPD_CLASSIC,
            self::DPD_PRIVATE,
            self::DPD_PICKUP,
            self::DPD_EXPRESS_10,
            self::DPD_EXPRESS_12,
            self::DPD_EXPRESS_18,
            // self::DPD_PRIVATE_EVENING,
            self::DPD_PRIVATE_SATURDAY,
        ];
    }

    /** @return array<string> */
    private static function dhl(): array
    {
        return [
            self::DHL_WORLDWIDE,
            self::DHL_EXPRESS_DOCUMENTS,
            self::DHL_EXPRESS_WORLDWIDE_9,
            self::DHL_EXPRESS_WORLDWIDE_12,
            self::DHL_ECONOMY,
            self::DHL_DOMESTIC_12,
            self::DHL_DOMESTIC_EXPRESS,
            self::DHL_MEDICAL_EXPRESS,
        ];
    }

    /** @return array<string> */
    private static function geis(): array
    {
        return [
            self::GEIS_CARGO_BUSINESS_NATIONAL,
            self::GEIS_CARGO_BUSINESS_INTERNATIONAL,
            // self::GEIS_CARGO_PRIVATE_NATIONAL,
            // self::GEIS_CARGO_PRIVATE_INTERNATIONAL,
            self::GEIS_PARCEL_HD_STANDARD,
            self::GEIS_PARCEL_HD_PREMIUM,
            self::GEIS_B2B,
        ];
    }

    /** @return array<string> */
    private static function gls(): array
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

    /** @return array<string> */
    private static function intime(): array
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
            self::INTIME_BOX_CZ,
            self::INTIME_BOX_SK,
        ];
    }

    /** @return array<string> */
    private static function pbh(): array
    {
        return [
            self::PBH_DHL,
            self::PBH_GLS,
            self::PBH_SPS,
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
            // self::PBH_HERMES,
            self::PBH_SPEEDY,
            self::PBH_COLISSIMO,
            self::PBH_MEEST,
            self::PBH_NOBA_POSHTA,
            self::PBH_ECONT,
            self::PBH_ACS,
            self::PBH_CORREOS,
            self::PBH_123_KURIER,
            self::PBH_ROYAL_MAIL_24,
            self::PBH_ROYAL_MAIL_48,
            self::PBH_EXPRESS_ONE,
            self::PBH_UPS,
        ];
    }

    /** @return array<string> */
    private static function ppl(): array
    {
        return [
            self::PPL_CONNECT,
            self::PPL_AFTERNOON,
            self::PPL_PRIVATE,
            self::PPL_BUSINESS,
            self::PPL_PRIVATE_EVENING,
            self::PPL_BUSINESS_EU,
            self::PPL_BUSINESS_PALETTE,
            self::PPL_PRIVATE_PALETTE,
            self::PPL_PRIVATE_SMART_CZ,
            self::PPL_PRIVATE_SMART_EU,
            self::PPL_RETURN_CONNECT,
        ];
    }

    /** @return array<string> */
    private static function sp(): array
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

    /** @return array<string> */
    private static function sps(): array
    {
        return [
            self::SPS_EXPRESS,
            self::SPS_EXPRESS_12,
            self::SPS_EXPRESS_9,
            self::SPS_INTERNATIONAL,
        ];
    }

    /** @return array<string> */
    private static function topTrans(): array
    {
        return [
            self::TOPTRANS_STANDARD,
            self::TOPTRANS_TOPTIME,
            self::TOPTRANS_PRIVATE,
            self::TOPTRANS_WEEKEND,
            self::TOPTRANS_PERSONAL,
            self::TOPTRANS_NOTICE,
        ];
    }

    /** @return array<string> */
    private static function ulozenka(): array
    {
        return [
            // self::ULOZENKA_ULOZENKA,
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
            self::ULOZENKA_MALL_DELIVERY,
        ];
    }

    /** @return array<string> */
    private static function ups(): array
    {
        return [
            self::UPS_EXPRESS,
            self::UPS_EXPRESS_SAVER,
            self::UPS_STANDARD,
            self::UPS_EXPEDITED,
        ];
    }

    /** @return array<string> */
    private static function zasilkovna(): array
    {
        return [
            self::ZASILKOVNA_VMCZ,
            self::ZASILKOVNA_VMSK,
            self::ZASILKOVNA_VMHU,
            self::ZASILKOVNA_VMPL,
            self::ZASILKOVNA_VMRO,
            self::ZASILKOVNA_AT_DPD_HD,
            self::ZASILKOVNA_AT_POST_HD,
            self::ZASILKOVNA_BE_POST_PP,
            self::ZASILKOVNA_BE_POST_HD,
            self::ZASILKOVNA_BE_NL_POST_HD,
            self::ZASILKOVNA_BG_ECONT_HD,
            self::ZASILKOVNA_BG_ECONT_PP,
            self::ZASILKOVNA_BG_SPEEDY_PP,
            self::ZASILKOVNA_BG_SPEEDY_HD,
            self::ZASILKOVNA_BG_ECONT_BOX,
            // self::ZASILKOVNA_CZ_POST_HD,
            self::ZASILKOVNA_CZ_EXPRESS_PRAHA_HD,
            // self::ZASILKOVNA_CZ_EXPRESS_BRNO_HD,
            self::ZASILKOVNA_CZ_EXPRESS_OSTRAVA_HD,
            self::ZASILKOVNA_CZ_COURIER_HD,
            self::ZASILKOVNA_CZ_CAR_TRUNK,
            self::ZASILKOVNA_CZ_EVENING_BRNO_HD,
            // self::ZASILKOVNA_DE_POST_HD,
            self::ZASILKOVNA_DE_HERMES_PP,
            self::ZASILKOVNA_DE_HERMES_HD,
            self::ZASILKOVNA_DE_HOME_DELIVERY_HD,
            self::ZASILKOVNA_DK_POST_NORD_HD,
            self::ZASILKOVNA_DK_POST_NORD_PP,
            // self::ZASILKOVNA_DK_DAO_HD,
            // self::ZASILKOVNA_DK_DAO_PP,
            self::ZASILKOVNA_EE_OMNIVA_HD,
            self::ZASILKOVNA_EE_OMNIVA_PP,
            self::ZASILKOVNA_EE_OMNIVA_BOX,
            self::ZASILKOVNA_ES_CORREOS_HD,
            self::ZASILKOVNA_EE_LT_POST_HD,
            self::ZASILKOVNA_ES_MRW_HD,
            self::ZASILKOVNA_ES_MRW_PP,
            // self::ZASILKOVNA_ES_ENVIALIA_HD,
            self::ZASILKOVNA_FI_POST_NORD_HP,
            self::ZASILKOVNA_FI_POST_NORD_PP,
            // self::ZASILKOVNA_FR_COLIS_PRIVE_HD,
            // self::ZASILKOVNA_FR_MONDIAL_PP,
            self::ZASILKOVNA_FR_COLISSIMO_PP,
            self::ZASILKOVNA_FR_COLISSIMO_HD,
            self::ZASILKOVNA_FR_MONDIAL_RELAY_PP,
            self::ZASILKOVNA_FR_COLIS_PRIVE_DIRECT_HD,
            // self::ZASILKOVNA_GB_HERMES_HD,
            self::ZASILKOVNA_GB_ROYAL_MAIL_24_HD,
            self::ZASILKOVNA_GB_ROYAL_MAIL_48_HD,
            self::ZASILKOVNA_GR_TAXYDROMIKI,
            self::ZASILKOVNA_GR_ACS_HD,
            self::ZASILKOVNA_GR_ACS_PP,
            // self::ZASILKOVNA_GR_SPEEDY_HD,
            self::ZASILKOVNA_GR_SPEEDEX_HD,
            self::ZASILKOVNA_GR_BOXNOW_BOX,
            self::ZASILKOVNA_HR_OVERSEAS_HD,
            self::ZASILKOVNA_HR_OVERSEAS_PP,
            self::ZASILKOVNA_HR_DPD_HD,
            self::ZASILKOVNA_HR_POST_PP,
            self::ZASILKOVNA_HR_POST_HD,
            // self::ZASILKOVNA_HU_EXPRESS_ONE_HD,
            self::ZASILKOVNA_HU_DPD_HD,
            self::ZASILKOVNA_HU_COURIER_HD,
            self::ZASILKOVNA_HU_POST_HD,
            // self::ZASILKOVNA_HU_FAMA_FUTAR_HD,
            self::ZASILKOVNA_CH_POST_PRIORITY_HD,
            self::ZASILKOVNA_CH_POST_HD,
            // self::ZASILKOVNA_IE_HERMES_HD,
            self::ZASILKOVNA_IE_ANPOST_HD,
            self::ZASILKOVNA_IE_FEDEX_HD_CONNECT_PLUS,
            self::ZASILKOVNA_IE_FEDEX_HD_PRIORITY,
            self::ZASILKOVNA_IL_FEDEX_PRIORITY_HD,
            self::ZASILKOVNA_IL_FEDEX_ECONOMY_HD,
            self::ZASILKOVNA_IT_BARTOLINI_HD,
            self::ZASILKOVNA_IT_BARTOLINI_PP,
            // self::ZASILKOVNA_IT_GLS_HD,
            self::ZASILKOVNA_IT_HR_PARCEL_HD,
            self::ZASILKOVNA_LT_OMNIVA_BOX,
            self::ZASILKOVNA_LT_OMNIVA_HD,
            self::ZASILKOVNA_LU_POST_HD,
            self::ZASILKOVNA_LU_DPD_HD,
            self::ZASILKOVNA_LV_OMNIVA_BOX,
            self::ZASILKOVNA_LV_OMNIVA_HD,
            self::ZASILKOVNA_LV_LT_POST_HD,
            self::ZASILKOVNA_LT_POST_HD,
            self::ZASILKOVNA_LT_POST_BOX,
            self::ZASILKOVNA_NL_DHL_HD,
            self::ZASILKOVNA_NL_POST_HD,
            self::ZASILKOVNA_NL_DHL_PP,
            // self::ZASILKOVNA_PL_POST_24_HD,
            // self::ZASILKOVNA_PL_POST_48_HD,
            // self::ZASILKOVNA_PL_DPD_HD,
            self::ZASILKOVNA_PL_COURIER_HD,
            self::ZASILKOVNA_PL_INPOST_PACZKOMATY_BOX,
            self::ZASILKOVNA_PL_POST_PP,
            // self::ZASILKOVNA_PL_INPOST_HD,
            self::ZASILKOVNA_PT_MRW_HD,
            self::ZASILKOVNA_PT_MRW_PP,
            self::ZASILKOVNA_RO_COURIER_HD,
            self::ZASILKOVNA_RO_URGENT_CARGUS_HD,
            self::ZASILKOVNA_RO_SAMEDAY_BOX,
            // self::ZASILKOVNA_RO_DPD_HD,
            self::ZASILKOVNA_RO_SAMEDAY_HD,
            self::ZASILKOVNA_RO_FAN_COURIER_HD,
            // self::ZASILKOVNA_RU_POST_PP,
            // self::ZASILKOVNA_RU_POST_RECOMMENDED_PP,
            // self::ZASILKOVNA_RU_EMS_HD,
            self::ZASILKOVNA_SE_POST_NORD_PP,
            self::ZASILKOVNA_SE_POST_NORD_HD,
            self::ZASILKOVNA_SI_DPD_HD,
            self::ZASILKOVNA_SI_DPD_PP,
            self::ZASILKOVNA_SI_POST_HD,
            self::ZASILKOVNA_SI_POST_PP,
            self::ZASILKOVNA_SI_POST_BOX,
            self::ZASILKOVNA_SK_EXPRESS_BRATISLAVA_HD,
            self::ZASILKOVNA_SK_COURIER_HD,
            // self::ZASILKOVNA_SK_POST_HD,
            self::ZASILKOVNA_UA_NOVA_POSHTA_PP,
            self::ZASILKOVNA_UA_ROSAN_HD,
            self::ZASILKOVNA_US_FEDEX_ECONOMY_HD,
            self::ZASILKOVNA_US_FEDEX_PRIORITY_HD,
            self::ZASILKOVNA_TR_FEDEX_ECONOMY_HD,
            self::ZASILKOVNA_TR_FEDEX_PRIORITY_HD,
        ];
    }

    /** @return array<string> */
    private static function tnt(): array
    {
        return [
            self::TNT_EXPRESS,
            self::TNT_EXPRESS_9,
            self::TNT_EXPRESS_12,
            self::TNT_ECONOMY_EXPRESS,
            // self::TNT_NIGHT_EXPRESS_8,
            self::TNT_ECONOMY_EXPRESS_12,
            self::TNT_EXPRESS_10,
            self::TNT_EXPRESS_DOCUMENTS,
            self::TNT_EXPRESS_DOCUMENTS_9,
            self::TNT_EXPRESS_DOCUMENTS_10,
            self::TNT_EXPRESS_DOCUMENTS_12,
            // self::TNT_NIGHT_EXPRESS_12,
            // self::TNT_NIGHT_EXPRESS_6,
            // self::TNT_NIGHT_EXPRESS_7,
            // self::TNT_NIGHT_EXPRESS_14,
            self::TNT_SPECIAL_ECONOMY_EXPRESS,
            self::TNT_DIRECT_INFEED,
        ];
    }

    /** @return array<string> */
    private static function gw(): array
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

    /** @return array<string> */
    private static function gwcz(): array
    {
        return [
            self::GW_W24,
            self::GW_D8,
            self::GW_D12,
            self::GW_D14,
            self::GW_EUR,
        ];
    }

    /** @return array<string> */
    private static function messenger(): array
    {
        return [
            self::MESSENGER_STANDARD,
            self::MESSENGER_EXTREME,
            self::MESSENGER_EXPRESS,
            self::MESSENGER_SAME_DAY,
            self::MESSENGER_OVERNIGHT_ECONOMY,
            self::MESSENGER_OVERNIGHT_EXPRESS,
            self::MESSENGER_DIRECT,
            self::MESSENGER_ECONOMY_BRNO,
            self::MESSENGER_PRAGUE_09_13,
            self::MESSENGER_PRAGUE_13_17,
            self::MESSENGER_PRAGUE_17_21,
        ];
    }

    /** @return array<string> */
    private static function dhlde(): array
    {
        return [
            self::DHLDE_PAKET,
            self::DHLDE_PAKET_TAGGLEICH,
            self::DHLDE_PAKET_INTERNATIONAL,
            self::DHLDE_EUROPAKET,
            self::DHLDE_PAKET_CONNECT,
        ];
    }

    /** @return array<string> */
    private static function fedex(): array
    {
        return [
            self::FEDEX_INTERNATIONAL,
            self::FEDEX_ECONOMY,
            self::FEDEX_INTERNATIONAL_FIRST,
            self::FEDEX_INTERNATIONAL_PRIORITY_EXPRESS,
            self::FEDEX_INTERNATIONAL_PRIORITY,
            self::FEDEX_REGIONAL_ECONOMY,
            self::FEDEX_INTERNATIONAL_PRIORITY_FREIGHT,
            self::FEDEX_INTERNATIONAL_ECONOMY_FREIGHT,
            self::FEDEX_REGIONAL_ECONOMY_FREIGHT,
            self::FEDEX_INTERNATIONAL_CONNECT_PLUS,
            self::FEDEX_PRIORITY_OVERNIGHT,
        ];
    }

    /** @return array<string> */
    private static function fofr(): array
    {
        return [
            self::FOFR_FOFR,
            self::FOFR_ECONOMY,
            self::FOFR_PARCEL,
            self::FOFR_PALETTE,
            self::FOFR_OVERSIZED,
            self::FOFR_SK,
            self::FOFR_ABROAD,
        ];
    }

    /** @return array<string> */
    private static function dachser(): array
    {
        return [
            self::DACHSER_SPEED,
            self::DACHSER_SPEED_10,
            self::DACHSER_SPEED_12,
            self::DACHSER_SPEED_PLUS,
            self::DACHSER_FIX,
            self::DACHSER_FIX_10,
            self::DACHSER_FIX_12,
            self::DACHSER_FLEX,
            self::DACHSER_ONSITE,
            self::DACHSER_CLASSIC,
        ];
    }

    /** @return array<string> */
    private static function dhlparcel(): array
    {
        return [
            self::DHLPARCEL_CONNECT,
        ];
    }

    /** @return array<string> */
    private static function raben(): array
    {
        return [
            self::RABEN_CLASSIC,
            self::RABEN_CLASSIC_TIME,
            self::RABEN_PREMIUM,
            self::RABEN_PREMIUM_TIME,
            self::RABEN_PREMIUM_12,
            self::RABEN_PREMIUM_FIX,
        ];
    }

    /** @return array<string> */
    private static function spring(): array
    {
        return [
            self::SPRING_TRACKED,
            self::SPRING_SIGNATURED,
            self::SPRING_UNTRACKED,
        ];
    }

    /** @return array<string> */
    private static function dsv(): array
    {
        return [
            self::DSV_ROAD,
            self::DSV_B2C,
        ];
    }

    /** @return array<string> */
    private static function dhlfreightec(): array
    {
        return [
            self::DHLFREIGHTEC_ECD_B2B,
            self::DHLFREIGHTEC_ECD_B2C,
            self::DHLFREIGHTEC_ECI,
            self::DHLFREIGHTEC_ERI,
        ];
    }

    /** @return array<string> */
    private static function kurier(): array
    {
        return [
            self::KURIER_GARANTED,
            self::KURIER_GARANTED_BRANCH,
            // self::KURIER_12,
            self::KURIER_STANDARD,
            self::KURIER_STANDARD_BRANCH,
        ];
    }

    /** @return array<string> */
    private static function dbschenker(): array
    {
        return [
            self::DBSCHENKER_SYSTEM_FIX,
            self::DBSCHENKER_SYSTEM_FIX_TBA,
            self::DBSCHENKER_SYSTEM,
            self::DBSCHENKER_SYSTEM_PREMIUM,
            self::DBSCHENKER_SYSTEM_PREMIUM_10,
            self::DBSCHENKER_SYSTEM_PREMIUM_13,
            self::DBSCHENKER_SYSTEM_FIX_10,
            self::DBSCHENKER_SYSTEM_FIX_13,
            self::DBSCHENKER_FULL_LOAD,
            self::DBSCHENKER_PART_LOAD,
            self::DBSCHENKER_LPA,
        ];
    }

    /** @return array<string> */
    private static function airway(): array
    {
        return [
            self::AIRWAY_EXPRESS,
            self::AIRWAY_NORMAL,
            self::AIRWAY_ECONOMY,
            self::AIRWAY_SAME_DAY,
            self::AIRWAY_PRAGUE_13,
            self::AIRWAY_PRAGUE_17,
            self::AIRWAY_PRAGUE_21,
            self::AIRWAY_NEXT_DAY,
            self::AIRWAY_NEXT_WEEKDAY,
        ];
    }

    /** @return array<string> */
    private static function japo(): array
    {
        return [
            self::JAPO_STANDARD,
        ];
    }

    /** @return array<string> */
    private static function liftago(): array
    {
        return [
            self::LIFTAGO_EXPRESS,
            self::LIFTAGO_STANDARD,
            self::LIFTAGO_STANDARD_8,
            self::LIFTAGO_STANDARD_10,
            self::LIFTAGO_STANDARD_12,
            self::LIFTAGO_STANDARD_14,
            self::LIFTAGO_STANDARD_16,
            self::LIFTAGO_STANDARD_18,
            self::LIFTAGO_STANDARD_20,
            self::LIFTAGO_STANDARD_22,
        ];
    }

    /** @return array<string> */
    private static function magyarposta(): array
    {
        return [
            self::MAGYARPOSTA_MPL_BUSINESS,
            self::MAGYARPOSTA_MPL_POST,
            self::MAGYARPOSTA_INTERNATIONAL_PRIORITY,
            self::MAGYARPOSTA_INTERNATIONAL,
            self::MAGYARPOSTA_EUROPE_PLUS,
            self::MAGYARPOSTA_EUROPE_STANDARD,
        ];
    }

    /** @return array<string> */
    private static function sameday(): array
    {
        return [
            self::SAMEDAY_3H,
            self::SAMEDAY_6H,
            self::SAMEDAY_EXCLUSIVE,
            self::SAMEDAY_24H,
            self::SAMEDAY_STANDARD_RETURN,
            self::SAMEDAY_LOCKER_NEXT_DAY,
            self::SAMEDAY_LOCKER_RETURN,
        ];
    }

    /** @return array<string> */
    private static function sds(): array
    {
        return [
            self::SDS_STANDART,
        ];
    }
}
