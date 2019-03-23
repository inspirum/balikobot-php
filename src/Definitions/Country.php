<?php

namespace Inspirum\Balikobot\Definitions;

use InvalidArgumentException;

class Country
{
    /**
     * Afghanistan
     *
     * @var string
     */
    public const AFGHANISTAN = 'AF';

    /**
     * Aland Islands
     *
     * @var string
     */
    public const ALAND_ISLANDS = 'AX';

    /**
     * Albania
     *
     * @var string
     */
    public const ALBANIA = 'AL';

    /**
     * Algeria
     *
     * @var string
     */
    public const ALGERIA = 'DZ';

    /**
     * American Samoa
     *
     * @var string
     */
    public const AMERICAN_SAMOA = 'AS';

    /**
     * Andorra
     *
     * @var string
     */
    public const ANDORRA = 'AD';

    /**
     * Angola
     *
     * @var string
     */
    public const ANGOLA = 'AO';

    /**
     * Anguilla
     *
     * @var string
     */
    public const ANGUILLA = 'AI';

    /**
     * Antarctica
     *
     * @var string
     */
    public const ANTARCTICA = 'AQ';

    /**
     * Antigua and Barbuda
     *
     * @var string
     */
    public const ANTIGUA_AND_BARBUDA = 'AG';

    /**
     * Argentina
     *
     * @var string
     */
    public const ARGENTINA = 'AR';

    /**
     * Armenia
     *
     * @var string
     */
    public const ARMENIA = 'AM';

    /**
     * Aruba
     *
     * @var string
     */
    public const ARUBA = 'AW';

    /**
     * Australia
     *
     * @var string
     */
    public const AUSTRALIA = 'AU';

    /**
     * Austria
     *
     * @var string
     */
    public const AUSTRIA = 'AT';

    /**
     * Azerbaijan
     *
     * @var string
     */
    public const AZERBAIJAN = 'AZ';

    /**
     * Bahamas
     *
     * @var string
     */
    public const BAHAMAS = 'BS';

    /**
     * Bahrain
     *
     * @var string
     */
    public const BAHRAIN = 'BH';

    /**
     * Bangladesh
     *
     * @var string
     */
    public const BANGLADESH = 'BD';

    /**
     * Barbados
     *
     * @var string
     */
    public const BARBADOS = 'BB';

    /**
     * Belarus
     *
     * @var string
     */
    public const BELARUS = 'BY';

    /**
     * Belgium
     *
     * @var string
     */
    public const BELGIUM = 'BE';

    /**
     * Belize
     *
     * @var string
     */
    public const BELIZE = 'BZ';

    /**
     * Benin
     *
     * @var string
     */
    public const BENIN = 'BJ';

    /**
     * Bermuda
     *
     * @var string
     */
    public const BERMUDA = 'BM';

    /**
     * Bhutan
     *
     * @var string
     */
    public const BHUTAN = 'BT';

    /**
     * Bolivia (Plurinational State of)
     *
     * @var string
     */
    public const BOLIVIA = 'BO';

    /**
     * Bonaire; Sint Eustatius and Saba
     *
     * @var string
     */
    public const BONAIRE = 'BQ';

    /**
     * Bosnia and Herzegovina
     *
     * @var string
     */
    public const BOSNIA_AND_HERZEGOVINA = 'BA';

    /**
     * Botswana
     *
     * @var string
     */
    public const BOTSWANA = 'BW';

    /**
     * Bouvet Island
     *
     * @var string
     */
    public const BOUVET_ISLAND = 'BV';

    /**
     * Brazil
     *
     * @var string
     */
    public const BRAZIL = 'BR';

    /**
     * British Indian Ocean Territory
     *
     * @var string
     */
    public const BRITISH_INDIAN_OCEAN_TERRITORY = 'IO';

    /**
     * Brunei Darussalam
     *
     * @var string
     */
    public const BRUNEI_DARUSSALAM = 'BN';

    /**
     * Bulgaria
     *
     * @var string
     */
    public const BULGARIA = 'BG';

    /**
     * Burkina Faso
     *
     * @var string
     */
    public const BURKINA_FASO = 'BF'; /* <*/
    /**
     * Burundi
     *
     * @var string
     */
    public const BURUNDI = 'BI';

    /**
     * Cabo Verde
     *
     * @var string
     */
    public const CABO_VERDE = 'CV';

    /**
     * Cambodia
     *
     * @var string
     */
    public const CAMBODIA = 'KH';

    /**
     * Cameroon
     *
     * @var string
     */
    public const CAMEROON = 'CM';

    /**
     * Canada
     *
     * @var string
     */
    public const CANADA = 'CA';

    /**
     * Cayman Islands
     *
     * @var string
     */
    public const CAYMAN_ISLANDS = 'KY';

    /**
     * Central African Republic
     *
     * @var string
     */
    public const CENTRAL_AFRICAN_REPUBLIC = 'CF';

    /**
     * Chad
     *
     * @var string
     */
    public const CHAD = 'TD';

    /**
     * Chile
     *
     * @var string
     */
    public const CHILE = 'CL';

    /**
     * China
     *
     * @var string
     */
    public const CHINA = 'CN';

    /**
     * Christmas Island
     *
     * @var string
     */
    public const CHRISTMAS_ISLAND = 'CX';

    /**
     * Cocos (Keeling) Islands
     *
     * @var string
     */
    public const COCOS_ISLANDS = 'CC';

    /**
     * Colombia
     *
     * @var string
     */
    public const COLOMBIA = 'CO';

    /**
     * Comoros
     *
     * @var string
     */
    public const COMOROS = 'KM';

    /**
     * Congo
     *
     * @var string
     */
    public const CONGO = 'CG';

    /**
     * Congo (Democratic Republic of the)
     *
     * @var string
     */
    public const CONGO_DEMOCRATIC_REPUBLIC = 'CD';

    /**
     * Cook Islands
     *
     * @var string
     */
    public const COOK_ISLANDS = 'CK'; /* <*/
    /**
     * Costa Rica
     *
     * @var string
     */
    public const COSTA_RICA = 'CR';

    /**
     * Côte d'Ivoire
     *
     * @var string
     */
    public const COTE_DIVOIRE = 'CI';

    /**
     * Croatia
     *
     * @var string
     */
    public const CROATIA = 'HR';

    /**
     * Cuba
     *
     * @var string
     */
    public const CUBA = 'CU';

    /**
     * Curaçao
     *
     * @var string
     */
    public const CURACAO = 'CW';

    /**
     * Cyprus
     *
     * @var string
     */
    public const CYPRUS = 'CY';

    /**
     * Czech Republic
     *
     * @var string
     */
    public const CZECH_REPUBLIC = 'CZ';

    /**
     * Denmark
     *
     * @var string
     */
    public const DENMARK = 'DK';

    /**
     * Djibouti
     *
     * @var string
     */
    public const DJIBOUTI = 'DJ';

    /**
     * Dominica
     *
     * @var string
     */
    public const DOMINICA = 'DM';

    /**
     * Dominican Republic
     *
     * @var string
     */
    public const DOMINICAN_REPUBLIC = 'DO';

    /**
     * Ecuador
     *
     * @var string
     */
    public const ECUADOR = 'EC';

    /**
     * Egypt
     *
     * @var string
     */
    public const EGYPT = 'EG';

    /**
     * El Salvador
     *
     * @var string
     */
    public const EL_SALVADOR = 'SV';

    /**
     * Equatorial Guinea
     *
     * @var string
     */
    public const EQUATORIAL_GUINEA = 'GQ';

    /**
     * Eritrea
     *
     * @var string
     */
    public const ERITREA = 'ER';

    /**
     * Estonia
     *
     * @var string
     */
    public const ESTONIA = 'EE';

    /**
     * Ethiopia
     *
     * @var string
     */
    public const ETHIOPIA = 'ET';

    /**
     * Falkland Islands (Malvinas)
     *
     * @var string
     */
    public const FALKLAND_ISLANDS = 'FK';

    /**
     * Faroe Islands
     *
     * @var string
     */
    public const FAROE_ISLANDS = 'FO';

    /**
     * Fiji
     *
     * @var string
     */
    public const FIJI = 'FJ';

    /**
     * Finland
     *
     * @var string
     */
    public const FINLAND = 'FI';

    /**
     * France
     *
     * @var string
     */
    public const FRANCE = 'FR';

    /**
     * French Guiana
     *
     * @var string
     */
    public const FRENCH_GUIANA = 'GF';

    /**
     * French Polynesia
     *
     * @var string
     */
    public const FRENCH_POLYNESIA = 'PF';

    /**
     * French Southern Territories
     *
     * @var string
     */
    public const FRENCH_SOUTHERN_TERRITORIES = 'TF';

    /**
     * Gabon
     *
     * @var string
     */
    public const GABON = 'GA';

    /**
     * Gambia
     *
     * @var string
     */
    public const GAMBIA = 'GM';

    /**
     * Georgia
     *
     * @var string
     */
    public const GEORGIA = 'GE';

    /**
     * Germany
     *
     * @var string
     */
    public const GERMANY = 'DE';

    /**
     * Ghana
     *
     * @var string
     */
    public const GHANA = 'GH';

    /**
     * Gibraltar
     *
     * @var string
     */
    public const GIBRALTAR = 'GI';

    /**
     * Greece
     *
     * @var string
     */
    public const GREECE = 'GR';

    /**
     * Greenland
     *
     * @var string
     */
    public const GREENLAND = 'GL';

    /**
     * Grenada
     *
     * @var string
     */
    public const GRENADA = 'GD';

    /**
     * Guadeloupe
     *
     * @var string
     */
    public const GUADELOUPE = 'GP';

    /**
     * Guam
     *
     * @var string
     */
    public const GUAM = 'GU';

    /**
     * Guatemala
     *
     * @var string
     */
    public const GUATEMALA = 'GT';

    /**
     * Guernsey
     *
     * @var string
     */
    public const GUERNSEY = 'GG';

    /**
     * Guinea
     *
     * @var string
     */
    public const GUINEA = 'GN';

    /**
     * Guinea-Bissau
     *
     * @var string
     */
    public const GUINEA_BISSAU = 'GW';

    /**
     * Guyana
     *
     * @var string
     */
    public const GUYANA = 'GY';

    /**
     * Haiti
     *
     * @var string
     */
    public const HAITI = 'HT';

    /**
     * Heard Island and McDonald Islands
     *
     * @var string
     */
    public const HEARD_ISLAND_AND_MCDONALD_ISLANDS = 'HM';

    /**
     * Holy See
     *
     * @var string
     */
    public const HOLY_SEE = 'VA';

    /**
     * Honduras
     *
     * @var string
     */
    public const HONDURAS = 'HN';

    /**
     * Hong Kong
     *
     * @var string
     */
    public const HONG_KONG = 'HK';

    /**
     * Hungary
     *
     * @var string
     */
    public const HUNGARY = 'HU';

    /**
     * Iceland
     *
     * @var string
     */
    public const ICELAND = 'IS';

    /**
     * India
     *
     * @var string
     */
    public const INDIA = 'IN';

    /**
     * Indonesia
     *
     * @var string
     */
    public const INDONESIA = 'ID';

    /**
     * Iran (Islamic Republic of)
     *
     * @var string
     */
    public const IRAN = 'IR';

    /**
     * Iraq
     *
     * @var string
     */
    public const IRAQ = 'IQ';

    /**
     * Ireland
     *
     * @var string
     */
    public const IRELAND = 'IE';

    /**
     * Isle of Man
     *
     * @var string
     */
    public const ISLE_OF_MAN = 'IM';

    /**
     * Israel
     *
     * @var string
     */
    public const ISRAEL = 'IL';

    /**
     * Italy
     *
     * @var string
     */
    public const ITALY = 'IT';

    /**
     * Jamaica
     *
     * @var string
     */
    public const JAMAICA = 'JM';

    /**
     * Japan
     *
     * @var string
     */
    public const JAPAN = 'JP';

    /**
     * Jersey
     *
     * @var string
     */
    public const JERSEY = 'JE';

    /**
     * Jordan
     *
     * @var string
     */
    public const JORDAN = 'JO';

    /**
     * Kazakhstan
     *
     * @var string
     */
    public const KAZAKHSTAN = 'KZ';

    /**
     * Kenya
     *
     * @var string
     */
    public const KENYA = 'KE';

    /**
     * Kiribati
     *
     * @var string
     */
    public const KIRIBATI = 'KI';

    /**
     * Korea (Democratic People's Republic of)
     *
     * @var string
     */
    public const KOREA = 'KP';

    /**
     * Korea (Republic of)
     *
     * @var string
     */
    public const KOREA_REPUBLIC = 'KR';

    /**
     * Kuwait
     *
     * @var string
     */
    public const KUWAIT = 'KW';

    /**
     * Kyrgyzstan
     *
     * @var string
     */
    public const KYRGYZSTAN = 'KG';

    /**
     * Lao People's Democratic Republic
     *
     * @var string
     */
    public const LAO = 'LA';

    /**
     * Latvia
     *
     * @var string
     */
    public const LATVIA = 'LV';

    /**
     * Lebanon
     *
     * @var string
     */
    public const LEBANON = 'LB';

    /**
     * Lesotho
     *
     * @var string
     */
    public const LESOTHO = 'LS';

    /**
     * Liberia
     *
     * @var string
     */
    public const LIBERIA = 'LR';

    /**
     * Libya
     *
     * @var string
     */
    public const LIBYA = 'LY';

    /**
     * Liechtenstein
     *
     * @var string
     */
    public const LIECHTENSTEIN = 'LI';

    /**
     * Lithuania
     *
     * @var string
     */
    public const LITHUANIA = 'LT';

    /**
     * Luxembourg
     *
     * @var string
     */
    public const LUXEMBOURG = 'LU';

    /**
     * Macao
     *
     * @var string
     */
    public const MACAO = 'MO';

    /**
     * Macedonia (the former Yugoslav Republic of)
     *
     * @var string
     */
    public const MACEDONIA = 'MK';

    /**
     * Madagascar
     *
     * @var string
     */
    public const MADAGASCAR = 'MG';

    /**
     * Malawi
     *
     * @var string
     */
    public const MALAWI = 'MW';

    /**
     * Malaysia
     *
     * @var string
     */
    public const MALAYSIA = 'MY';

    /**
     * Maldives
     *
     * @var string
     */
    public const MALDIVES = 'MV';

    /**
     * Mali
     *
     * @var string
     */
    public const MALI = 'ML';

    /**
     * Malta
     *
     * @var string
     */
    public const MALTA = 'MT';

    /**
     * Marshall Islands
     *
     * @var string
     */
    public const MARSHALL_ISLANDS = 'MH';

    /**
     * Martinique
     *
     * @var string
     */
    public const MARTINIQUE = 'MQ';

    /**
     * Mauritania
     *
     * @var string
     */
    public const MAURITANIA = 'MR';

    /**
     * Mauritius
     *
     * @var string
     */
    public const MAURITIUS = 'MU';

    /**
     * Mayotte
     *
     * @var string
     */
    public const MAYOTTE = 'YT';

    /**
     * Mexico
     *
     * @var string
     */
    public const MEXICO = 'MX';

    /**
     * Micronesia (Federated States of)
     *
     * @var string
     */
    public const MICRONESIA = 'FM';

    /**
     * Moldova (Republic of)
     *
     * @var string
     */
    public const MOLDOVA = 'MD';

    /**
     * Monaco
     *
     * @var string
     */
    public const MONACO = 'MC';

    /**
     * Mongolia
     *
     * @var string
     */
    public const MONGOLIA = 'MN';

    /**
     * Montenegro
     *
     * @var string
     */
    public const MONTENEGRO = 'ME';

    /**
     * Montserrat
     *
     * @var string
     */
    public const MONTSERRAT = 'MS';

    /**
     * Morocco
     *
     * @var string
     */
    public const MOROCCO = 'MA';

    /**
     * Mozambique
     *
     * @var string
     */
    public const MOZAMBIQUE = 'MZ';

    /**
     * Myanmar
     *
     * @var string
     */
    public const MYANMAR = 'MM';

    /**
     * Namibia
     *
     * @var string
     */
    public const NAMIBIA = 'NA';

    /**
     * Nauru
     *
     * @var string
     */
    public const NAURU = 'NR';

    /**
     * Nepal
     *
     * @var string
     */
    public const NEPAL = 'NP';

    /**
     * Netherlands
     *
     * @var string
     */
    public const NETHERLANDS = 'NL';

    /**
     * New Caledonia
     *
     * @var string
     */
    public const NEW_CALEDONIA = 'NC';

    /**
     * New Zealand
     *
     * @var string
     */
    public const NEW_ZEALAND = 'NZ';

    /**
     * Nicaragua
     *
     * @var string
     */
    public const NICARAGUA = 'NI';

    /**
     * Niger
     *
     * @var string
     */
    public const NIGER = 'NE';

    /**
     * Nigeria
     *
     * @var string
     */
    public const NIGERIA = 'NG';

    /**
     * Niue
     *
     * @var string
     */
    public const NIUE = 'NU';

    /**
     * Norfolk Island
     *
     * @var string
     */
    public const NORFOLK_ISLAND = 'NF';

    /**
     * Northern Mariana Islands
     *
     * @var string
     */
    public const NORTHERN_MARIANA_ISLANDS = 'MP'; /* <*/
    /**
     * Norway
     *
     * @var string
     */
    public const NORWAY = 'NO';

    /**
     * Oman
     *
     * @var string
     */
    public const OMAN = 'OM';

    /**
     * Pakistan
     *
     * @var string
     */
    public const PAKISTAN = 'PK';

    /**
     * Palau
     *
     * @var string
     */
    public const PALAU = 'PW';

    /**
     * Palestine; State of
     *
     * @var string
     */
    public const PALESTINE = 'PS';

    /**
     * Panama
     *
     * @var string
     */
    public const PANAMA = 'PA';

    /**
     * Papua New Guinea
     *
     * @var string
     */
    public const PAPUA_NEW_GUINEA = 'PG';

    /**
     * Paraguay
     *
     * @var string
     */
    public const PARAGUAY = 'PY';

    /**
     * Peru
     *
     * @var string
     */
    public const PERU = 'PE';

    /**
     * Philippines
     *
     * @var string
     */
    public const PHILIPPINES = 'PH';

    /**
     * Pitcairn
     *
     * @var string
     */
    public const PITCAIRN = 'PN';

    /**
     * Poland
     *
     * @var string
     */
    public const POLAND = 'PL';

    /**
     * Portugal
     *
     * @var string
     */
    public const PORTUGAL = 'PT';

    /**
     * Puerto Rico
     *
     * @var string
     */
    public const PUERTO_RICO = 'PR';

    /**
     * Qatar
     *
     * @var string
     */
    public const QATAR = 'QA';

    /**
     * Réunion
     *
     * @var string
     */
    public const REUNION = 'RE';

    /**
     * Romania
     *
     * @var string
     */
    public const ROMANIA = 'RO';

    /**
     * Russian Federation
     *
     * @var string
     */
    public const RUSSIAN_FEDERATION = 'RU'; /* <*/
    /**
     * Rwanda
     *
     * @var string
     */
    public const RWANDA = 'RW';

    /**
     * Saint Barthélemy
     *
     * @var string
     */
    public const SAINT_BARTHELEMY = 'BL';

    /**
     * Saint Helena; Ascension and Tristan da Cunha
     *
     * @var string
     */
    public const SAINT_HELENA = 'SH';

    /**
     * Saint Kitts and Nevis
     *
     * @var string
     */
    public const SAINT_KITTS_AND_NEVIS = 'KN';

    /**
     * Saint Lucia
     *
     * @var string
     */
    public const SAINT_LUCIA = 'LC';

    /**
     * Saint Martin (French part)
     *
     * @var string
     */
    public const SAINT_MARTIN = 'MF';

    /**
     * Saint Pierre and Miquelon
     *
     * @var string
     */
    public const SAINT_PIERRE_AND_MIQUELON = 'PM';

    /**
     * Saint Vincent and the Grenadines
     *
     * @var string
     */
    public const SAINT_VINCENT_AND_THE_GRENADINES = 'VC';

    /**
     * Samoa
     *
     * @var string
     */
    public const SAMOA = 'WS';

    /**
     * San Marino
     *
     * @var string
     */
    public const SAN_MARINO = 'SM';

    /**
     * Sao Tome and Principe
     *
     * @var string
     */
    public const SAO_TOME_AND_PRINCIPE = 'ST';

    /**
     * Saudi Arabia
     *
     * @var string
     */
    public const SAUDI_ARABIA = 'SA';

    /**
     * Senegal
     *
     * @var string
     */
    public const SENEGAL = 'SN';

    /**
     * Serbia
     *
     * @var string
     */
    public const SERBIA = 'RS';

    /**
     * Seychelles
     *
     * @var string
     */
    public const SEYCHELLES = 'SC';

    /**
     * Sierra Leone
     *
     * @var string
     */
    public const SIERRA_LEONE = 'SL';

    /**
     * Singapore
     *
     * @var string
     */
    public const SINGAPORE = 'SG';

    /**
     * Sint Maarten (Dutch part)
     *
     * @var string
     */
    public const SINT_MAARTEN = 'SX';

    /**
     * Slovakia
     *
     * @var string
     */
    public const SLOVAKIA = 'SK';

    /**
     * Slovenia
     *
     * @var string
     */
    public const SLOVENIA = 'SI';

    /**
     * Solomon Islands
     *
     * @var string
     */
    public const SOLOMON_ISLANDS = 'SB';

    /**
     * Somalia
     *
     * @var string
     */
    public const SOMALIA = 'SO';

    /**
     * South Africa
     *
     * @var string
     */
    public const SOUTH_AFRICA = 'ZA';

    /**
     * South Georgia and the South Sandwich Islands
     *
     * @var string
     */
    public const SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS = 'GS';

    /**
     * South Sudan
     *
     * @var string
     */
    public const SOUTH_SUDAN = 'SS';

    /**
     * Spain
     *
     * @var string
     */
    public const SPAIN = 'ES';

    /**
     * Sri Lanka
     *
     * @var string
     */
    public const SRI_LANKA = 'LK';

    /**
     * Sudan
     *
     * @var string
     */
    public const SUDAN = 'SD';

    /**
     * Suriname
     *
     * @var string
     */
    public const SURINAME = 'SR';

    /**
     * Svalbard and Jan Mayen
     *
     * @var string
     */
    public const SVALBARD_AND_JAN_MAYEN = 'SJ';

    /**
     * Swaziland
     *
     * @var string
     */
    public const SWAZILAND = 'SZ';

    /**
     * Sweden
     *
     * @var string
     */
    public const SWEDEN = 'SE';

    /**
     * Switzerland
     *
     * @var string
     */
    public const SWITZERLAND = 'CH';

    /**
     * Syrian Arab Republic
     *
     * @var string
     */
    public const SYRIAN_ARAB_REPUBLIC = 'SY';

    /**
     * Taiwan; Province of China[a]
     *
     * @var string
     */
    public const TAIWAN = 'TW';

    /**
     * Tajikistan
     *
     * @var string
     */
    public const TAJIKISTAN = 'TJ';

    /**
     * Tanzania; United Republic of
     *
     * @var string
     */
    public const TANZANIA = 'TZ';

    /**
     * Thailand
     *
     * @var string
     */
    public const THAILAND = 'TH';

    /**
     * Timor-Leste
     *
     * @var string
     */
    public const TIMOR_LESTE = 'TL';

    /**
     * Togo
     *
     * @var string
     */
    public const TOGO = 'TG';

    /**
     * Tokelau
     *
     * @var string
     */
    public const TOKELAU = 'TK';

    /**
     * Tonga
     *
     * @var string
     */
    public const TONGA = 'TO';

    /**
     * Trinidad and Tobago
     *
     * @var string
     */
    public const TRINIDAD_AND_TOBAGO = 'TT'; /* <*/
    /**
     * Tunisia
     *
     * @var string
     */
    public const TUNISIA = 'TN';

    /**
     * Turkey
     *
     * @var string
     */
    public const TURKEY = 'TR';

    /**
     *
     * Turkmenistan
     *
     * @var string
     */
    public const TURKMENISTAN = 'TM';

    /**
     * Turks and Caicos Islands
     *
     * @var string
     */
    public const TURKS_AND_CAICOS_ISLANDS = 'TC';

    /**
     * Tuvalu
     *
     * @var string
     */
    public const TUVALU = 'TV';

    /**
     * Uganda
     *
     * @var string
     */
    public const UGANDA = 'UG';

    /**
     * Ukraine
     *
     * @var string
     */
    public const UKRAINE = 'UA';

    /**
     * United Arab Emirates
     *
     * @var string
     */
    public const UNITED_ARAB_EMIRATES = 'AE';

    /**
     * United Kingdom of Great Britain and Northern Ireland
     *
     * @var string
     */
    public const UNITED_KINGDOM_OF_GREAT_BRITAIN_AND_NORTHERN_IRELAND = 'GB';

    /**
     * United States of America
     *
     * @var string
     */
    public const UNITED_STATES_OF_AMERICA = 'US';

    /**
     * United States Minor Outlying Islands
     *
     * @var string
     */
    public const UNITED_STATES_MINOR_OUTLYING_ISLANDS = 'UM';

    /**
     * Uruguay
     *
     * @var string
     */
    public const URUGUAY = 'UY';

    /**
     * Uzbekistan
     *
     * @var string
     */
    public const UZBEKISTAN = 'UZ';

    /**
     * Vanuatu
     *
     * @var string
     */
    public const VANUATU = 'VU';

    /**
     * Venezuela (Bolivarian Republic of)
     *
     * @var string
     */
    public const VENEZUELA = 'VE';

    /**
     * Vietnam
     *
     * @var string
     */
    public const VIETNAM = 'VN';

    /**
     * Virgin Islands (British)
     *
     * @var string
     */
    public const VIRGIN_ISLANDS_BRITISH = 'VG';

    /**
     * Virgin Islands (U.S.)
     *
     * @var string
     */
    public const VIRGIN_ISLANDS_US = 'VI';

    /**
     * Wallis and Futuna
     *
     * @var string
     */
    public const WALLIS_AND_FUTUNA = 'WF';

    /**
     * Western Sahara
     *
     * @var string
     */
    public const WESTERN_SAHARA = 'EH';

    /**
     * Yemen
     *
     * @var string
     */
    public const YEMEN = 'YE';

    /**
     * Zambia
     *
     * @var string
     */
    public const ZAMBIA = 'ZM';

    /**
     * Zimbabwe
     *
     * @var string
     */
    public const ZIMBABWE = 'ZW';

    /**
     * Countries
     *
     * @return array
     */
    public static function all(): array
    {
        return [
            self::AFGHANISTAN,
            self::ALAND_ISLANDS,
            self::ALBANIA,
            self::ALGERIA,
            self::AMERICAN_SAMOA,
            self::ANDORRA,
            self::ANGOLA,
            self::ANGUILLA,
            self::ANTARCTICA,
            self::ANTIGUA_AND_BARBUDA,
            self::ARGENTINA,
            self::ARMENIA,
            self::ARUBA,
            self::AUSTRALIA,
            self::AUSTRIA,
            self::AZERBAIJAN,
            self::BAHAMAS,
            self::BAHRAIN,
            self::BANGLADESH,
            self::BARBADOS,
            self::BELARUS,
            self::BELGIUM,
            self::BELIZE,
            self::BENIN,
            self::BERMUDA,
            self::BHUTAN,
            self::BOLIVIA,
            self::BONAIRE,
            self::BOSNIA_AND_HERZEGOVINA,
            self::BOTSWANA,
            self::BOUVET_ISLAND,
            self::BRAZIL,
            self::BRITISH_INDIAN_OCEAN_TERRITORY,
            self::BRUNEI_DARUSSALAM,
            self::BULGARIA,
            self::BURKINA_FASO,
            self::BURUNDI,
            self::CABO_VERDE,
            self::CAMBODIA,
            self::CAMEROON,
            self::CANADA,
            self::CAYMAN_ISLANDS,
            self::CENTRAL_AFRICAN_REPUBLIC,
            self::CHAD,
            self::CHILE,
            self::CHINA,
            self::CHRISTMAS_ISLAND,
            self::COCOS_ISLANDS,
            self::COLOMBIA,
            self::COMOROS,
            self::CONGO,
            self::CONGO_DEMOCRATIC_REPUBLIC,
            self::COOK_ISLANDS,
            self::COSTA_RICA,
            self::COTE_DIVOIRE,
            self::CROATIA,
            self::CUBA,
            self::CURACAO,
            self::CYPRUS,
            self::CZECH_REPUBLIC,
            self::DENMARK,
            self::DJIBOUTI,
            self::DOMINICA,
            self::DOMINICAN_REPUBLIC,
            self::ECUADOR,
            self::EGYPT,
            self::EL_SALVADOR,
            self::EQUATORIAL_GUINEA,
            self::ERITREA,
            self::ESTONIA,
            self::ETHIOPIA,
            self::FALKLAND_ISLANDS,
            self::FAROE_ISLANDS,
            self::FIJI,
            self::FINLAND,
            self::FRANCE,
            self::FRENCH_GUIANA,
            self::FRENCH_POLYNESIA,
            self::FRENCH_SOUTHERN_TERRITORIES,
            self::GABON,
            self::GAMBIA,
            self::GEORGIA,
            self::GERMANY,
            self::GHANA,
            self::GIBRALTAR,
            self::GREECE,
            self::GREENLAND,
            self::GRENADA,
            self::GUADELOUPE,
            self::GUAM,
            self::GUATEMALA,
            self::GUERNSEY,
            self::GUINEA,
            self::GUINEA_BISSAU,
            self::GUYANA,
            self::HAITI,
            self::HEARD_ISLAND_AND_MCDONALD_ISLANDS,
            self::HOLY_SEE,
            self::HONDURAS,
            self::HONG_KONG,
            self::HUNGARY,
            self::ICELAND,
            self::INDIA,
            self::INDONESIA,
            self::IRAN,
            self::IRAQ,
            self::IRELAND,
            self::ISLE_OF_MAN,
            self::ISRAEL,
            self::ITALY,
            self::JAMAICA,
            self::JAPAN,
            self::JERSEY,
            self::JORDAN,
            self::KAZAKHSTAN,
            self::KENYA,
            self::KIRIBATI,
            self::KOREA,
            self::KOREA_REPUBLIC,
            self::KUWAIT,
            self::KYRGYZSTAN,
            self::LAO,
            self::LATVIA,
            self::LEBANON,
            self::LESOTHO,
            self::LIBERIA,
            self::LIBYA,
            self::LIECHTENSTEIN,
            self::LITHUANIA,
            self::LUXEMBOURG,
            self::MACAO,
            self::MACEDONIA,
            self::MADAGASCAR,
            self::MALAWI,
            self::MALAYSIA,
            self::MALDIVES,
            self::MALI,
            self::MALTA,
            self::MARSHALL_ISLANDS,
            self::MARTINIQUE,
            self::MAURITANIA,
            self::MAURITIUS,
            self::MAYOTTE,
            self::MEXICO,
            self::MICRONESIA,
            self::MOLDOVA,
            self::MONACO,
            self::MONGOLIA,
            self::MONTENEGRO,
            self::MONTSERRAT,
            self::MOROCCO,
            self::MOZAMBIQUE,
            self::MYANMAR,
            self::NAMIBIA,
            self::NAURU,
            self::NEPAL,
            self::NETHERLANDS,
            self::NEW_CALEDONIA,
            self::NEW_ZEALAND,
            self::NICARAGUA,
            self::NIGER,
            self::NIGERIA,
            self::NIUE,
            self::NORFOLK_ISLAND,
            self::NORTHERN_MARIANA_ISLANDS,
            self::NORWAY,
            self::OMAN,
            self::PAKISTAN,
            self::PALAU,
            self::PALESTINE,
            self::PANAMA,
            self::PAPUA_NEW_GUINEA,
            self::PARAGUAY,
            self::PERU,
            self::PHILIPPINES,
            self::PITCAIRN,
            self::POLAND,
            self::PORTUGAL,
            self::PUERTO_RICO,
            self::QATAR,
            self::REUNION,
            self::ROMANIA,
            self::RUSSIAN_FEDERATION,
            self::RWANDA,
            self::SAINT_BARTHELEMY,
            self::SAINT_HELENA,
            self::SAINT_KITTS_AND_NEVIS,
            self::SAINT_LUCIA,
            self::SAINT_MARTIN,
            self::SAINT_PIERRE_AND_MIQUELON,
            self::SAINT_VINCENT_AND_THE_GRENADINES,
            self::SAMOA,
            self::SAN_MARINO,
            self::SAO_TOME_AND_PRINCIPE,
            self::SAUDI_ARABIA,
            self::SENEGAL,
            self::SERBIA,
            self::SEYCHELLES,
            self::SIERRA_LEONE,
            self::SINGAPORE,
            self::SINT_MAARTEN,
            self::SLOVAKIA,
            self::SLOVENIA,
            self::SOLOMON_ISLANDS,
            self::SOMALIA,
            self::SOUTH_AFRICA,
            self::SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS,
            self::SOUTH_SUDAN,
            self::SPAIN,
            self::SRI_LANKA,
            self::SUDAN,
            self::SURINAME,
            self::SVALBARD_AND_JAN_MAYEN,
            self::SWAZILAND,
            self::SWEDEN,
            self::SWITZERLAND,
            self::SYRIAN_ARAB_REPUBLIC,
            self::TAIWAN,
            self::TAJIKISTAN,
            self::TANZANIA,
            self::THAILAND,
            self::TIMOR_LESTE,
            self::TOGO,
            self::TOKELAU,
            self::TONGA,
            self::TRINIDAD_AND_TOBAGO,
            self::TUNISIA,
            self::TURKEY,
            self::TURKMENISTAN,
            self::TURKS_AND_CAICOS_ISLANDS,
            self::TUVALU,
            self::UGANDA,
            self::UKRAINE,
            self::UNITED_ARAB_EMIRATES,
            self::UNITED_KINGDOM_OF_GREAT_BRITAIN_AND_NORTHERN_IRELAND,
            self::UNITED_STATES_OF_AMERICA,
            self::UNITED_STATES_MINOR_OUTLYING_ISLANDS,
            self::URUGUAY,
            self::UZBEKISTAN,
            self::VANUATU,
            self::VENEZUELA,
            self::VIETNAM,
            self::VIRGIN_ISLANDS_BRITISH,
            self::VIRGIN_ISLANDS_US,
            self::WALLIS_AND_FUTUNA,
            self::WESTERN_SAHARA,
            self::YEMEN,
            self::ZAMBIA,
            self::ZIMBABWE,
        ];
    }

    /**
     * Validate country code.
     *
     * @param string $code
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public static function validateCode(string $code): void
    {
        if (in_array($code, self::all()) === false) {
            throw new InvalidArgumentException('Unknown country "' . $code . '".');
        }
    }
}
