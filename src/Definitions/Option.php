<?php

namespace Inspirum\Balikobot\Definitions;

class Option
{
    /**
     * Eshop ID
     * string
     *
     * @var string
     */
    public const EID = 'eid';

    /**
     * Package number
     * int
     *
     * @var string
     */
    public const ORDER_NUMBER = 'order_number';

    /**
     * Order id
     * string
     * max length 10 characters
     *
     * @var string
     */
    public const REAL_ORDER_ID = 'real_order_id';

    /**
     * Service type
     * string
     *
     * @var string
     */
    public const SERVICE_TYPE = 'service_type';

    /***
     * Services
     * array
     *
     * @var string
     */
    public const SERVICES = 'services';

    /**
     * Branch id for pickup service
     * string
     *
     * @var string
     */
    public const BRANCH_ID = 'branch_id';

    /***
     * Package price
     * float
     *
     * @var string
     */
    public const PRICE = 'price';

    /**
     * Insurance
     * bool
     *
     * @var string
     */
    public const DEL_INSURANCE = 'del_insurance';

    /**
     * Insurance
     * bool
     *
     * @var string
     */
    public const DEL_EVENING = 'del_evening';

    /**
     * Pay by customer
     * bool
     *
     * @var string
     */
    public const DEL_EXWORKS = 'del_exworks';

    /***
     * Ppackage COD price
     * float
     *
     * @var string
     */
    public const COD_PRICE = 'cod_price';

    /**
     * Package cod currency
     * float
     *
     * @var string
     */
    public const COD_CURRENCY = 'cod_currency';

    /**
     * Variable symbol
     * float
     *
     * @var string
     */
    public const VS = 'vs';

    /**
     * Customer fullname
     *
     * @var string
     */
    public const REC_NAME = 'rec_name';

    /**
     * Customer company name.
     *
     * @var string
     */
    public const REC_FIRM = 'rec_firm';

    /**
     * Delivery address street
     *
     * @var string
     */
    public const REC_STREET = 'rec_street';

    /**
     * Delivery address city
     *
     * @var string
     */
    public const REC_CITY = 'rec_city';

    /**
     * Delivery address postcode
     *
     * @var string
     */
    public const REC_ZIP = 'rec_zip';

    /**
     * Delivery address region (HU)
     *
     * @var string
     */
    public const REC_REGION = 'rec_region';

    /**
     * Delivery address country code
     * ISO 3166-1 alpha-2 http://cs.wikipedia.org/wiki/ISO_3166-1
     *
     * @var string
     */
    public const REC_COUNTRY = 'rec_country';

    /**
     * Customer email
     *
     * @var string
     */
    public const REC_EMAIL = 'rec_email';

    /**
     * Customer phone
     *
     * @var string
     */
    public const REC_PHONE = 'rec_phone';

    /**
     * Weight in kg
     * float
     *
     * @var string
     */
    public const WEIGHT = 'weight';

    /**
     * Taking delivery requires full age
     * bool
     *
     * @var string
     */
    public const REQUIRE_FULL_AGE = 'require_full_age';

    /**
     * Taking delivery requires password
     *
     * @var string
     */
    public const PASSWORD = 'password';

    /**
     * Credit card
     * bool
     *
     * @var string
     */
    public const CREDIT_CARD = 'credit_card';

    /**
     * Notifies customer by SMS
     * boolean
     *
     * @var string
     */
    public const SMS_NOTIFICATION = 'sms_notification';

    /**
     * Width in cm
     * float
     *
     * @var string
     */
    public const WIDTH = 'width';

    /**
     * Length in cm
     * float
     *
     * @var string
     */
    public const LENGTH = 'length';

    /**
     * Height in cm
     * float
     *
     * @var string
     */
    public const HEIGHT = 'height';

    /**
     * Note
     * string
     *
     * @var string
     */
    public const NOTE = 'note';

    /**
     * Exchangeable package
     *
     * @var string
     */
    public const SWAP = 'swap';

    /**
     * Exchangeable package
     *
     * @var string
     */
    public const SWAP_OPTION = 'swap_option';

    /**
     * Delivery bills back
     * bool
     *
     * @var string
     */
    public const VDL_SERVICE = 'vdl_service';

    /**
     * Total volume of shipment in m3.
     *
     * @var string
     */
    public const VOLUME = 'volume';

    /**
     * Manipulation unit code
     *
     * @see Client::getManipulationUnits()
     *
     * @var string
     */
    public const MU_TYPE = 'mu_type';

    /**
     * Number of items if bigger than one
     * int
     *
     * @var string
     */
    public const PIECES_COUNT = 'pieces_count';

    /**
     * Manipulation unit code
     *
     * @see Client::getManipulationUnits()
     *
     * @var string
     */
    public const MU_TYPE_ONE = 'mu_type_one';

    /**
     * Number of items if bigger than one
     * int
     *
     * @var string
     */
    public const PIECES_COUNT_ONE = 'pieces_count_one';

    /**
     * Manipulation unit code
     *
     * @see Client::getManipulationUnits()
     *
     * @var string
     */
    public const MU_TYPE_TWO = 'mu_type_two';

    /**
     * Number of items if bigger than one
     * int
     *
     * @var string
     */
    public const PIECES_COUNT_TWO = 'pieces_count_two';

    /**
     * Manipulation unit code
     *
     * @see Client::getManipulationUnits()
     *
     * @var string
     */
    public const MU_TYPE_THREE = 'mu_type_three';

    /**
     * Number of items if bigger than one
     * int
     *
     * @var string
     */
    public const PIECES_COUNT_THREE = 'pieces_count_three';

    /**
     * Carry to the floor and others
     * bool
     *
     * @var string
     */
    public const COMFORT_SERVICE = 'comfort_service';

    /**
     * Carry to the floor and others
     * bool
     *
     * @var string
     */
    public const COMFORT_SERVICE_PLUS = 'comfort_plus_service';

    /**
     * Oversize shipment
     * bool
     *
     * @var string
     */
    public const OVER_DIMENSION = 'over_dimension';

    /**
     * Number of palettes send back (use when more than one)
     * int
     *
     * @var string
     */
    public const WRAP_BACK_COUNT = 'wrap_back_count';

    /**
     * Description of returnable packaging
     * string
     *
     * @var string
     */
    public const WRAP_BACK_NOTE = 'wrap_back_note';

    /**
     * Return old household appliance
     * bool
     *
     * @var string
     */
    public const APP_DISP = 'app_disp';

    /**
     * The scheduled delivery date of the shipment is reported as date
     * string (YYYY-mm-dd)
     *
     * @var string
     */
    public const DELIVERY_DATE = 'delivery_date';

    /**
     * Taking delivery requires password
     *
     * @var string
     */
    public const RETURN_TRACK = 'return_track';

    /**
     * Full bank account number
     * string
     *
     * @var string
     */
    public const BANK_ACCOUNT_NUMBER = 'bank_account_number';

    /**
     * Text content of the shipment
     * string
     *
     * @var string
     */
    public const CONTENT = 'content';

    /**
     * Terms and Conditions
     * string
     *
     * @var string
     */
    public const TERMS_OF_TRADE = 'terms_of_trade';

    /**
     * PDF in base64 string
     * string
     *
     * @var string
     */
    public const INVOICE_PDF = 'invoice_pdf';

    /**
     * Year of the addressee's birth
     * string (YYYY)
     *
     * @var string
     */
    public const FULL_AGE_DATA = 'full_age_data';

    /**
     * Supplementary Saturday delivery service for B2C shipments
     * bool
     *
     * @var string
     */
    public const SAT_DELIVERY = 'sat_delivery';

    /**
     * Returning the numbers of individual pieces of cargo handling units
     * bool
     *
     * @var string
     */
    public const GET_PIECES_NUMBERS = 'get_piece_numbers';

    /**
     * Return erros as messages.
     *
     * @var string
     */
    public const RETURN_FULL_ERRORS = 'return_full_errors';

    /**
     * The content of manipulation units (mu_type_one),
     * string
     *
     * @var string
     */
    public const CONTENT_ONE = 'content_one';

    /**
     * The content of manipulation units (mu_type_two),
     * string
     *
     * @var string
     */
    public const CONTENT_TWO = 'content_two';

    /**
     * The content of manipulation units (mu_type_three),
     * string
     *
     * @var string
     */
    public const CONTENT_THREE = 'content_three';

    /**
     * Phone delivery notification
     * bool
     *
     * @var string
     */
    public const PHONE_DELIVERY_NOTIFICATION = 'phone_delivery_notification';

    /**
     * Phone order notification
     * bool
     *
     * @var string
     */
    public const PHONE_ORDER_NOTIFICATION = 'phone_order_notification';

    /**
     * Email notification
     * bool
     *
     * @var string
     */
    public const EMAIL_NOTIFICATION = 'email_notification';

    /**
     * Notifies customer by phone
     * bool
     *
     * @var string
     */
    public const PHONE_NOTIFICATION = 'phone_notification';

    /**
     * B2C service
     * bool
     *
     * @var string
     */
    public const B2C_NOTIFICATION = 'b2c_notification';

    /**
     * Note
     *
     * @var string
     */
    public const NOTE_DRIVER = 'note_driver';

    /**
     * Note for customer
     *
     * @var string
     */
    public const NOTE_CUSTOMER = 'note_recipient';

    /**
     * Carry to the floor and others
     * string
     *
     * @var string
     */
    public const COMFORT_EXCLUSIVE_SERVICE = 'comfort_exclusive_service';

    /**
     * Delivery to the department - floor
     * bool
     *
     * @var string
     */
    public const PERS_DELIVERY_FLOOR = 'pers_delivery_floor';

    /**
     * Delivery to the department - building
     * string
     *
     * @var string
     */
    public const PERS_DELIVERY_BUILDING = 'pers_delivery_building';

    /**
     * Delivery to the department - department
     * string
     *
     * @var string
     */
    public const PERS_DELIVERY_DEPARTMENT = 'pers_delivery_department';

    /**
     * PIN
     * int
     *
     * @var string
     */
    public const PIN = 'pin';

    /**
     * Data for customs clearance
     * string
     *
     * @var string
     */
    public const CONTENT_DATA = 'content_data';

    /**
     * Invoice number.
     *
     * string
     *
     * @var string
     */
    public const INVOICE_NUMBER = 'invoice_number';

    /**
     * Customer can open the package and check the contents before taking over
     * bool
     *
     * @var string
     */
    public const OPEN_BEFORE_PAYMENT = 'open_before_payment';

    /**
     * Customeryou can try the goods before taking them
     * bool
     *
     * @var string
     */
    public const TEST_BEFORE_PAYMENT = 'test_before_payment';

    /**
     * ADR mode of transport
     * bool
     *
     * @var string
     */
    public const ADR_SERVICE = 'adr_service';

    /**
     * Individual ADR items in the shipment
     * string
     *
     * @var string
     */
    public const ADR_CONTENT = 'adr_content';

    /**
     * Číslo popisné, pokud pro danou adresu neexistuje doplňte "0"
     *
     * @var string
     */
    public const REC_HOUSE_NUMBER = 'rec_house_number';

    /**
     * Identifikátor bloku (přenáší se jen u přepravce BG Speedy).
     *
     * @var string
     */
    public const REC_BLOCK = 'rec_block';

    /**
     * Číslo vchodu (přenáší se jen u přepravce BG Speedy).
     *
     * @var string
     */
    public const REC_ENTERANCE = 'rec_enterance';

    /**
     *
     *  Číslo podlaží (přenáší se jen u přepravce BG Speedy).
     *
     * @var string
     */
    public const REC_FLOOR = 'rec_floor';

    /**
     * Číslo bytu / apartmánu (přenáší se jen u přepravce BG Speedy).
     *
     * @var string
     */
    public const REC_FLAT_NUMBER = 'rec_flat_number';

    /**
     * Patronymum - otčestvo (povinný pro přepravce Nova Poshta).
     *
     * @var string
     */
    public const REC_NAME_PATRONYMUM = 'rec_name_patronymum';

    /**
     * ID lokality.
     *
     * @var string
     */
    public const REC_LOCALE_ID = 'rec_locale_id';
}
