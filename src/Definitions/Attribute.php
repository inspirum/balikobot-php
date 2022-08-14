<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Definitions;

final class Attribute extends BaseEnum
{
    /**
     * Eshop ID
     * string
     */
    public const EID = 'eid';

    /**
     * Package number
     * int
     */
    public const ORDER_NUMBER = 'order_number';

    /**
     * Order id
     * string
     * max length 10 characters
     */
    public const REAL_ORDER_ID = 'real_order_id';

    /**
     * Service type
     * string
     */
    public const SERVICE_TYPE = 'service_type';

    /***
     * Services
     * array
     */
    public const SERVICES = 'services';

    /**
     * Branch id for pickup service
     * string
     */
    public const BRANCH_ID = 'branch_id';

    /***
     * Package price
     * float
     */
    public const PRICE = 'price';

    /**
     * Insurance
     * bool
     */
    public const DEL_INSURANCE = 'del_insurance';

    /**
     * Insurance
     * bool
     */
    public const DEL_EVENING = 'del_evening';

    /**
     * Pay by customer
     * bool
     */
    public const DEL_EXWORKS = 'del_exworks';

    /**
     * Pay by customer
     * bool
     */
    public const DEL_EXWORKS_ACCOUNT_NUMBER = 'del_exworks_account_number';

    /**
     * Pay by customer
     * bool
     */
    public const DEL_EXWORKS_ZIP = 'del_exworks_zip';

    /**
     * Country code required for del_exworks = 4
     * string
     */
    public const DEL_EXWORKS_COUNTRY_CODE = 'del_exworks_country_code';

    /***
     * Package COD price
     * float
     */
    public const COD_PRICE = 'cod_price';

    /**
     * Package cod currency
     * float
     */
    public const COD_CURRENCY = 'cod_currency';

    /**
     * Variable symbol
     * float
     */
    public const VS = 'vs';

    /**
     * Customer fullname
     */
    public const REC_NAME = 'rec_name';

    /**
     * Customer company name
     */
    public const REC_FIRM = 'rec_firm';

    /**
     * Delivery address street
     */
    public const REC_STREET = 'rec_street';

    /**
     * Delivery address street addendum
     */
    public const REC_STREET_APPEND = 'rec_street_append';

    /**
     * Delivery address city
     */
    public const REC_CITY = 'rec_city';

    /**
     * Delivery address zipcode
     */
    public const REC_ZIP = 'rec_zip';

    /**
     * Delivery address region (HU,RO)
     */
    public const REC_REGION = 'rec_region';

    /**
     * Delivery address country code
     * ISO 3166-1 alpha-2 http://cs.wikipedia.org/wiki/ISO_3166-1
     */
    public const REC_COUNTRY = 'rec_country';

    /**
     * Customer email
     */
    public const REC_EMAIL = 'rec_email';

    /**
     * Customer phone
     */
    public const REC_PHONE = 'rec_phone';

    /**
     * Customer ID
     */
    public const REC_ID = 'rec_id';

    /**
     * Weight in kg
     * float
     */
    public const WEIGHT = 'weight';

    /**
     * Currency
     */
    public const INS_CURRENCY = 'ins_currency';

    /**
     * Taking delivery requires full age
     * bool
     */
    public const REQUIRE_FULL_AGE = 'require_full_age';

    /**
     * Variation of age verification - send value "15" for 15+, send value "18" for 18+
     * string
     */
    public const FULL_AGE_MINIMUM = 'full_age_minimum';

    /**
     * Taking delivery requires password
     */
    public const PASSWORD = 'password';

    /**
     * Credit card
     * bool
     */
    public const CREDIT_CARD = 'credit_card';

    /**
     * Notifies customer by SMS
     * boolean
     */
    public const SMS_NOTIFICATION = 'sms_notification';

    /**
     * Width in cm
     * float
     */
    public const WIDTH = 'width';

    /**
     * Length in cm
     * float
     */
    public const LENGTH = 'length';

    /**
     * Height in cm
     * float
     */
    public const HEIGHT = 'height';

    /**
     * Note
     * string
     */
    public const NOTE = 'note';

    /**
     * Exchangeable package
     */
    public const SWAP = 'swap';

    /**
     * Exchangeable package
     */
    public const SWAP_OPTION = 'swap_option';

    /**
     * Delivery bills back
     * bool
     */
    public const VDL_SERVICE = 'vdl_service';

    /**
     * Total volume of shipment in m3
     */
    public const VOLUME = 'volume';

    /**
     * Manipulation unit code
     *
     * @see \Inspirum\Balikobot\Service\SettingService::getManipulationUnits()
     */
    public const MU_TYPE = 'mu_type';

    /**
     * Number of items if bigger than one
     * int
     */
    public const PIECES_COUNT = 'pieces_count';

    /**
     * Manipulation unit code
     *
     * @see \Inspirum\Balikobot\Service\SettingService::getManipulationUnits()
     */
    public const MU_TYPE_ONE = 'mu_type_one';

    /**
     * Number of items if bigger than one
     * int
     */
    public const PIECES_COUNT_ONE = 'pieces_count_one';

    /**
     * Manipulation unit code
     *
     * @see \Inspirum\Balikobot\Service\SettingService::getManipulationUnits()
     */
    public const MU_TYPE_TWO = 'mu_type_two';

    /**
     * Number of items if bigger than one
     * int
     */
    public const PIECES_COUNT_TWO = 'pieces_count_two';

    /**
     * Manipulation unit code
     *
     * @see \Inspirum\Balikobot\Service\SettingService::getManipulationUnits()
     */
    public const MU_TYPE_THREE = 'mu_type_three';

    /**
     * Number of items if bigger than one
     * int
     */
    public const PIECES_COUNT_THREE = 'pieces_count_three';

    /**
     * Carry to the floor and others
     * bool
     */
    public const COMFORT_SERVICE = 'comfort_service';

    /**
     * Carry to the floor and others
     * bool
     */
    public const COMFORT_SERVICE_PLUS = 'comfort_plus_service';

    /**
     * Oversize shipment
     * bool
     */
    public const OVER_DIMENSION = 'over_dimension';

    /**
     * Number of palettes send back (use when more than one)
     * int
     */
    public const WRAP_BACK_COUNT = 'wrap_back_count';

    /**
     * Description of returnable packaging
     * string
     */
    public const WRAP_BACK_NOTE = 'wrap_back_note';

    /**
     * Return old household appliance
     * bool
     */
    public const APP_DISP = 'app_disp';

    /**
     * The scheduled delivery date of the shipment is reported as date
     * string (YYYY-mm-dd)
     */
    public const DELIVERY_DATE = 'delivery_date';

    /**
     * Taking delivery requires password
     */
    public const RETURN_TRACK = 'return_track';

    /**
     * Full bank account number
     * string
     */
    public const BANK_ACCOUNT_NUMBER = 'bank_account_number';

    /**
     * Text content of the shipment
     * string
     */
    public const CONTENT = 'content';

    /**
     * Terms and Conditions
     * string
     */
    public const TERMS_OF_TRADE = 'terms_of_trade';

    /**
     * PDF in base64 string
     * string
     */
    public const INVOICE_PDF = 'invoice_pdf';

    /**
     * Year of the addressee's birth
     * string (YYYY)
     */
    public const FULL_AGE_DATA = 'full_age_data';

    /**
     * Supplementary Saturday delivery service for B2C shipments
     * bool
     */
    public const SAT_DELIVERY = 'sat_delivery';

    /**
     * Returning the numbers of individual pieces of cargo handling units
     * bool
     */
    public const GET_PIECES_NUMBERS = 'get_piece_numbers';

    /**
     * Return erros as messages
     */
    public const RETURN_FULL_ERRORS = 'return_full_errors';

    /**
     * The content of manipulation units (mu_type_one),
     * string
     */
    public const CONTENT_ONE = 'content_one';

    /**
     * The content of manipulation units (mu_type_two),
     * string
     */
    public const CONTENT_TWO = 'content_two';

    /**
     * The content of manipulation units (mu_type_three),
     * string
     */
    public const CONTENT_THREE = 'content_three';

    /**
     * Phone delivery notification
     * bool
     */
    public const PHONE_DELIVERY_NOTIFICATION = 'phone_delivery_notification';

    /**
     * Phone order notification
     * bool
     */
    public const PHONE_ORDER_NOTIFICATION = 'phone_order_notification';

    /**
     * Email notification
     * bool
     */
    public const EMAIL_NOTIFICATION = 'email_notification';

    /**
     * Notifies customer by phone
     * bool
     */
    public const PHONE_NOTIFICATION = 'phone_notification';

    /**
     * B2C service
     * bool
     */
    public const B2C_NOTIFICATION = 'b2c_notification';

    /**
     * Note
     */
    public const NOTE_DRIVER = 'note_driver';

    /**
     * Note for customer
     */
    public const NOTE_CUSTOMER = 'note_recipient';

    /**
     * Carry to the floor and others
     * string
     */
    public const COMFORT_EXCLUSIVE_SERVICE = 'comfort_exclusive_service';

    /**
     * Delivery to the department - floor
     * bool
     */
    public const PERS_DELIVERY_FLOOR = 'pers_delivery_floor';

    /**
     * Delivery to the department - building
     * string
     */
    public const PERS_DELIVERY_BUILDING = 'pers_delivery_building';

    /**
     * Delivery to the department - department
     * string
     */
    public const PERS_DELIVERY_DEPARTMENT = 'pers_delivery_department';

    /**
     * PIN
     * int
     */
    public const PIN = 'pin';

    /**
     * Data for customs clearance
     * string
     */
    public const CONTENT_DATA = 'content_data';

    /**
     * Invoice number
     * string
     */
    public const INVOICE_NUMBER = 'invoice_number';

    /**
     * Customer can open the package and check the contents before taking over
     * bool
     */
    public const OPEN_BEFORE_PAYMENT = 'open_before_payment';

    /**
     * Customer can try the goods before taking them
     * bool
     */
    public const TEST_BEFORE_PAYMENT = 'test_before_payment';

    /**
     * ADR mode of transport
     * bool
     */
    public const ADR_SERVICE = 'adr_service';

    /**
     * Individual ADR items in the shipment
     * string
     */
    public const ADR_CONTENT = 'adr_content';

    /**
     * Číslo popisné, pokud pro danou adresu neexistuje doplňte "0"
     */
    public const REC_HOUSE_NUMBER = 'rec_house_number';

    /**
     * Identifikátor bloku (přenáší se jen u přepravce BG Speedy)
     */
    public const REC_BLOCK = 'rec_block';

    /**
     * Číslo vchodu (přenáší se jen u přepravce BG Speedy)
     */
    public const REC_ENTERANCE = 'rec_enterance';

    /**
     * Číslo podlaží (přenáší se jen u přepravce BG Speedy)
     */
    public const REC_FLOOR = 'rec_floor';

    /**
     * Číslo bytu / apartmánu (přenáší se jen u přepravce BG Speedy)
     */
    public const REC_FLAT_NUMBER = 'rec_flat_number';

    /**
     * Patronymum - otčestvo (povinný pro přepravce Nova Poshta)
     */
    public const REC_NAME_PATRONYMUM = 'rec_name_patronymum';

    /**
     * ID lokality
     */
    public const REC_LOCALE_ID = 'rec_locale_id';

    /**
     * Ceny přepravy v měně cílové země
     */
    public const DELIVERY_COSTS = 'delivery_costs';

    /**
     * Ceny přepravy v EUR
     */
    public const DELIVERY_COSTS_EUR = 'delivery_costs_eur';

    /**
     * Datum (formát YYYY-MM-DD) plánované reallizace přepravy
     */
    public const PICKUP_DATE = 'pickup_date';

    /**
     * Preferovaný čas přepravy OD. Formát HH:mm
     */
    public const PICKUP_TIME_FROM = 'pickup_time_from';

    /**
     * Preferovaný čas přepravy DO. Formát HH:mm
     */
    public const PICKUP_TIME_TO = 'pickup_time_to';

    /**
     * Zákaznická reference, maximální délka 40 alfanumerických znaků.
     */
    public const REFERENCE = 'reference';

    /**
     * SMS Service (SM1) – SMS avizace s možností zaslání vlastního textu
     */
    public const SM1_SERVICE = 'sm1_service';

    /**
     * Text SMS pro avizaci skrze sm1_service. Max délka 160 znaků.
     */
    public const SM1_TEXT = 'sm1_text';

    /**
     * PreAdvice Service (SM2). SMS avizace před doručením zásilky.
     */
    public const SM2_SERVICE = 'sm2_service';

    /**
     * Navrácení trackovacího linku na web cílového přepravce.
     */
    public const RETURN_FINAL_CARRIER_ID = 'return_final_carrier_id';

    /**
     * Bank code
     * string
     */
    public const BANK_CODE = 'bank_code';

    /**
     * Komentáře k deklaraci (maximalni počet znaků - 150)
     * string
     */
    public const DECLARATION_COMMENTS = 'declaration_comments';

    /**
     * Sleva declaration_transport_charges - cena přepravy (maximalni počet znaků - 15)
     * float
     */
    public const DECLARATION_CHARGES_DISCOUNT = 'declaration_charges_discount';

    /**
     * Cena vlastniho pripojisteni (maximalni počet znaků - 15)
     * float
     */
    public const DECLARATION_INSURANCE_CHARGES = 'declaration_insurance_charges';

    /**
     * Ostatní náklady (maximalni počet znaků - 15)
     * float
     */
    public const DECLARATION_OTHER_CHARGES = 'declaration_other_charges';

    /**
     * Náklady za přepravu (maximalni počet znaků - 15)
     * float
     */
    public const DECLARATION_TRANSPORT_CHARGES = 'declaration_transport_charges';

    /**
     * Přeprava alkoholu - dle smlouvy s UPS
     * bool
     */
    public const IS_ALCOHOL = 'is_alcohol';

    /**
     * Datum vystavení faktury (formát YYYY-MM-DD)
     * string
     */
    public const CONTENT_ISSUE_DATE = 'content_issue_date';

    /**
     * Číslo faktury, které se váže k produktu.
     * string
     */
    public const CONTENT_INVOICE_NUMBER = 'content_invoice_number';

    /**
     * Způsob proclení, může obsahovat hodnoty 'own' = vlastní celní prohlášení, 'create' nebo 'carrier'.
     * string
     */
    public const CONTENT_EAD = 'content_ead';

    /**
     * Vaše MRN, pouze pro ead = own.
     * string
     */
    public const CONTENT_MRN = 'content_mrn';

    /**
     * Dokument EAD, řetězec musí být base64 PDF pro správné předání, pouze pro ead = own
     * string
     */
    public const EAD_PDF = 'ead_pdf';

    /**
     * Customer fullname
     */
    public const SEN_NAME = 'sen_name';

    /**
     * Customer company name
     */
    public const SEN_FIRM = 'sen_firm';

    /**
     * Customer address street
     */
    public const SEN_STREET = 'sen_street';

    /**
     * Customer address city
     */
    public const SEN_CITY = 'sen_city';

    /**
     * Customer address zipcode
     */
    public const SEN_ZIP = 'sen_zip';

    /**
     * Customer address country code
     * ISO 3166-1 alpha-2 http://cs.wikipedia.org/wiki/ISO_3166-1
     */
    public const SEN_COUNTRY = 'sen_country';

    /**
     * Customer address street addendum
     */
    public const SEN_STREET_APPEND = 'sen_street_append';

    /**
     * Customer email
     */
    public const SEN_EMAIL = 'sen_email';

    /**
     * Customer phone
     */
    public const SEN_PHONE = 'sen_phone';

    /**
     * Flag for shipment neutralization (invoicing of duties and taxes to a 3rd entity).
     */
    public const NEUTRALIZE = 'neutralize';

    /**
     * Jméno kontaktní osoby pro neutralizaci.
     */
    public const NEUTRALIZE_NAME = 'neutralize_name';

    /**
     * Název firmy pro neutralizaci.
     */
    public const NEUTRALIZE_FIRM = 'neutralize_firm';

    /**
     * Adresa (ulice + čp) subjektu pro neutralizaci
     */
    public const NEUTRALIZE_STREET = 'neutralize_street';

    /**
     * Adresa (město) subjektu pro neutralizaci
     */
    public const NEUTRALIZE_CITY = 'neutralize_city';

    /**
     * Adresa (PSČ) subjektu pro neutralizac
     */
    public const NEUTRALIZE_ZIP = 'neutralize_zip';

    /**
     * Adresa (kód země příjemce dle ISO 3166-1 alpha-2) subjektu pro neutralizaci
     */
    public const NEUTRALIZE_COUNTRY = 'neutralize_country';

    /**
     * Adresa (zkratka stát/okresu) subjektu pro neutralizaci
     */
    public const NEUTRALIZE_REGION = 'neutralize_region';

    /**
     * Kontaktní telefon subjektu pro neutralizaci
     */
    public const NEUTRALIZE_PHONE = 'neutralize_phone';

    /**
     * Kontaktní email subjektu pro neutralizaci
     */
    public const NEUTRALIZE_EMAIL = 'neutralize_email';

    /**
     * UPS ID účtu pro neutralizaci
     */
    public const NEUTRALIZE_ACCOUNT_NUMBER = 'neutralize_account_number';

    /**
     * Název banky
     */
    public const BANK_NAME = 'bank_name';

    /**
     * Jméno držitele účtu
     */
    public const BANK_ACCOUNT_HOLDER = 'bank_account_holder';

    /**
     * Číslo účtu ve formátu IBAN
     */
    public const IBAN = 'iban';

    /**
     * Číslo účtu ve formátu IBAN
     */
    public const SWIFT = 'swift';

    /**
     * Export accompanying document
     */
    public const DCL_PDF = 'dcl_pdf';

    /**
     * Datum plánované realizace doručení zásilky
     */
    public const DATE_DELIVERY = 'date_delivery';

    /**
     * Čas (formát HH:ii) určující kdy nejdříve je možné zásilku doručit adresátovi
     */
    public const DELIVERY_TIME_FROM = 'delivery_time_from';

    /**
     * Čas (formát HH:ii) určující kdy nejpozději je možné zásilku doručit adresátovi
     */
    public const DELIVERY_TIME_TO = 'delivery_time_to';

    /**
     * Velikost zásilky
     */
    public const SIZE = 'size';

    /**
     * Typ výdejního místa
     */
    public const BRANCH_TYPE = 'branch_type';

    /**
     * Typ exportu
     */
    public const CONTENT_TYPE = 'content_type';

    /**
     * Místo podání zásilek (město)
     */
    public const CONTENT_PLACE_OF_COMMITAL = 'content_place_of_commital';

    /**
     * Dodatečné poplatky pro celní prohlášku
     */
    public const CONTENT_ADDITIONAL_FEE = 'content_additional_fee';

    /**
     * Popis typu zboží v případě, že content_type = “OTHER“
     */
    public const CONTENT_TYPE_DESCRIPTION = 'content_type_description';

    /**
     * Plátce zásilky
     */
    public const PAYER = 'payer';

    /**
     * Pro vrácení url adresy s fakturou
     */
    public const GENERATE_INVOICE = 'generate_invoice';

    /**
     * Nakládací délka v paletových kusech
     */
    public const LOADING_LENGTH_PALLETS = 'loading_length_pallets';

    /**
     * Požadována nevyšší přepravní teplota
     */
    public const TRANSFORM_TEMP_TO = 'transform_temp_to';

    /**
     * Požadována nejnižší přepravní teplota
     */
    public const TRANSFORM_TEMP_FROM = 'transform_temp_from';

    /**
     * Povinný parametr pro mezinárodní zásilky
     */
    public const CONTENT_PRODUCE_CODE = 'content_produce_code';

    /**
     * dentifikační číslo plátce přepravy
     */
    public const SHIPPER_VAT = 'shipper_vat';

    /**
     * Místo pro obchodní podmínky
     */
    public const TERMS_OF_TRADE_LOCATION = 'terms_of_trade_location';

    /**
     * Poznámka na fakturu
     */
    public const NOTE_INVOICE = 'note_invoice';

    /**
     * @deprecated
     */
    public const REC_CONTACT = 'rec_contact';

    /**
     * @deprecated
     */

    public const REC_BRANCH_ID = 'rec_branch_id';

    /**
     * @deprecated
     */
    public const SERVICE_TYPE_NUMBER = 'service_type_number';

    /**
     * @deprecated
     */
    public const IS_DUTIABLE = 'is_dutiable';

    /**
     * @deprecated
     */
    public const INS_PRICE = 'ins_price';

    /**
     * @deprecated
     */
    public const LABEL_IMAGE = 'label_image';

    /**
     * @deprecated
     */
    public const SHIPPING_DIRECTION = 'shipping_direction';

    /**
     * @deprecated
     */
    public const IS_LOCKERS = 'is_lockers';

    /**
     * @deprecated
     */
    public const LOCKERS_URL = 'lockers_url';

    /**
     * @deprecated
     */
    public const BOX_ID = 'box_id';
}
