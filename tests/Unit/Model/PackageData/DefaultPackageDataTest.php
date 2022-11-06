<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\PackageData;

use DateTimeImmutable;
use Inspirum\Balikobot\Definitions\Attribute;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageData;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;
use function array_diff;
use function array_keys;
use function count;
use function implode;
use function sprintf;

final class DefaultPackageDataTest extends BaseTestCase
{
    public function testArrayAccess(): void
    {
        $data  = [
            'a'    => 1,
            'eid'  => '7890',
            'test' => false,
        ];
        $model = new DefaultPackageData($data);

        self::assertSame($data, $model->getData());
        self::assertSame([
            'a'    => 1,
            'eid'  => '7890',
            'test' => false,
        ], $model->__toArray());

        $model->offsetSet('b', 2);

        self::assertSame(2, $model->offsetGet('b'));
        self::assertTrue($model->offsetExists('b'));
        self::assertNotNull($model['b'] ?? null);

        $model->offsetUnset('b');
        self::assertFalse($model->offsetExists('b'));
        self::assertNull($model['b'] ?? null);
    }

    public function testPackageSetters(): void
    {
        $package = new DefaultPackageData();

        $package->setEID('eid');
        $package->setOrderNumber(1);
        $package->setRealOrderId('RealOrderID');
        $package->setServiceType('NP');
        $package->setServices(['1', '2', '3']);
        $package->setBranchId('ID678');
        $package->setPrice(2000);
        $package->setDelInsurance(true);
        $package->setDelEvening(false);
        $package->setDelExworks(true);
        $package->setCodPrice(1789);
        $package->setCodCurrency('CZK');
        $package->setVS('67890');
        $package->setRecName('Name');
        $package->setRecFirm('Firm');
        $package->setRecNamePatronymum('Patronymum');
        $package->setRecStreet('Street');
        $package->setRecStreetAppend('12a');
        $package->setRecCity('City');
        $package->setRecZip('18900');
        $package->setRecRegion('Region');
        $package->setRecCountry('Czech');
        $package->setRecLocaleId('15');
        $package->setRecEmail('email@email.com');
        $package->setRecPhone('777666555');
        $package->setWeight(4.3);
        $package->setSize('S');
        $package->setLoadingLengthPallets(99.1);
        $package->setRequireFullAge(true);
        $package->setFullAgeMinimum('15');
        $package->setPassword('123456');
        $package->setCreditCard(true);
        $package->setSmsNotification(false);
        $package->setWidth(1.3);
        $package->setLength(14.1);
        $package->setHeight(19);
        $package->setNote('NOTE');
        $package->setSwap(true);
        $package->setSwapOption('Option');
        $package->setVDLService(true);
        $package->setVolume(4);
        $package->setMuType('MU_1');
        $package->setPiecesCount(1);
        $package->setMuTypeOne('MU_1');
        $package->setPiecesCountOne(1);
        $package->setMuTypeTwo('MU_2');
        $package->setPiecesCountTwo(2);
        $package->setMuTypeThree('MU_3');
        $package->setPiecesCountThree(3);
        $package->setComfortService(true);
        $package->setComfortServicePlus(false);
        $package->setOverDimension(true);
        $package->setWrapBackCount(6);
        $package->setWrapBackNote('WNote');
        $package->setAppDisp(true);
        $package->setDeliveryDate(new DateTimeImmutable('2018-10-10 10:00:01'));
        $package->setDeliveryTimeFrom(new DateTimeImmutable('2018-10-10 10:00:01'));
        $package->setDeliveryTimeTo(new DateTimeImmutable('2018-10-10 12:00:01'));
        $package->setDateDelivery(new DateTimeImmutable('2018-10-11 11:00:01'));
        $package->setReturnTrack(true);
        $package->setBankAccountNumber('56789/0900');
        $package->setContent('content');
        $package->setTermsOfTrade('terms an terms');
        $package->setTermsOfTradeLocation('Prague');
        $package->setInvoicePDF('base64:pdf');
        $package->setFullAgeData('FullAgeData');
        $package->setSatDelivery(true);
        $package->setGetPiecesNumbers(false);
        $package->setReturnFullErrors(true);
        $package->setContentOne('Content1');
        $package->setContentTwo('Content2');
        $package->setContentThree('Content3');
        $package->setPhoneDeliveryNotification(true);
        $package->setPhoneOrderNotification(false);
        $package->setEmailNotification(true);
        $package->setPhoneNotification(false);
        $package->setB2CNotification(true);
        $package->setNoteDriver('NoteDriver');
        $package->setNoteCustomer('NoteCustomer');
        $package->setComfortExclusiveService(false);
        $package->setPersDeliveryFloor(true);
        $package->setPersDeliveryBuilding(false);
        $package->setPersDeliveryDepartment(false);
        $package->setPIN('1235');
        $package->setContentData(['a' => 1, 'test' => 4]);
        $package->setContentType('DOCUMENT');
        $package->setContentTypeDescription('contentTypeDesc');
        $package->setContentAdditionalFee(3.45);
        $package->setContentProductCode('999');
        $package->setContentPlaceOfCommital('Brno');
        $package->setInvoiceNumber('23456789');
        $package->setOpenBeforePayment(true);
        $package->setTestBeforePayment(false);
        $package->setAdrService(true);
        $package->setAdrContent(['b' => '6']);
        $package->setRecHouseNumber('18/B');
        $package->setRecBlock('15');
        $package->setRecEnterance('189-12');
        $package->setFloor('4');
        $package->setFlatNumber('1900');
        $package->setDeliveryCosts(15.1);
        $package->setDeliveryCostsEUR(5.31);
        $package->setRecId('567890');
        $package->setPickupDate(new DateTimeImmutable('2019-11-11 10:00:01'));
        $package->setPickupTimeFrom(new DateTimeImmutable('2019-11-11 10:00:01'));
        $package->setPickupTimeTo(new DateTimeImmutable('2019-11-11 18:10:59'));
        $package->setPickupTimeTo(new DateTimeImmutable('2019-11-11 18:10:59'));
        $package->setInsCurrency('EUR');
        $package->setDelAccountNumber('456789/0987');
        $package->setDelZip('17000');
        $package->setDelCountryCode('CZE');
        $package->setReference('REFEREBCE');
        $package->setSM1Service(true);
        $package->setSM1Text('TEST');
        $package->setSM2Service(false);
        $package->setReturnFinalCarrierId(true);
        $package->setBankCode('0800');
        $package->setDeclarationComments('Test');
        $package->setDeclarationChargesDiscount(0.15);
        $package->setDeclarationInsuranceCharges(10);
        $package->setDeclarationOtherCharges(99.9);
        $package->setDeclarationTransportCharges(5.3);
        $package->setIsAlcohol(true);
        $package->setContentIssueDate(new DateTimeImmutable('2019-11-11 18:10:59'));
        $package->setContentInvoiceNumber('1234567890');
        $package->setContentEAD('create');
        $package->setContentMRN('1234');
        $package->setEADPdf('base64:ead');
        $package->setDCLPdf('base64:dcl');
        $package->setSenName('SenName');
        $package->setSenFirm('SenFirm');
        $package->setSenStreet('SenStreet');
        $package->setSenStreetAppend('12c');
        $package->setSenCity('SenCity');
        $package->setSenZip('19900');
        $package->setSenCountry('Slovak');
        $package->setSenEmail('email2@email.com');
        $package->setSenPhone('777666333');
        $package->setNeutralize(true);
        $package->setNeutralizeName('NeutralizeName');
        $package->setNeutralizeFirm('NeutralizeFirm');
        $package->setNeutralizeStreet('NeutralizeStreet');
        $package->setNeutralizeCity('NeutralizeCity');
        $package->setNeutralizeZip('19900');
        $package->setNeutralizeCountry('HU');
        $package->setNeutralizeRegion('HU1');
        $package->setNeutralizeEmail('email3@email.com');
        $package->setNeutralizePhone('777666222');
        $package->setNeutralizeAccountNumber('456789/0985');
        $package->setBankName('CS');
        $package->setBankAccountHolder('BankHolderName');
        $package->setSWIFT('12345');
        $package->setIBAN('6789');
        $package->setBranchType('packstation');
        $package->setGenerateInvoice(true);
        $package->setPayer('2');
        $package->setTransformTempFrom(5);
        $package->setTransformTempTO(60);
        $package->setShipperVat('21');
        $package->setNoteInvoice('note1');
        $package->setInvoiceType('PRO_FORMA_INVOICE');

        $unsupportedAttributes = array_diff(Attribute::getAll(), array_keys($package->getData()));

        self::assertEquals(
            [
                Attribute::EID                           => 'eid',
                Attribute::ORDER_NUMBER                  => 1,
                Attribute::REAL_ORDER_ID                 => 'RealOrderID',
                Attribute::SERVICE_TYPE                  => 'NP',
                Attribute::SERVICES                      => '1+2+3',
                Attribute::BRANCH_ID                     => 'ID678',
                Attribute::PRICE                         => 2000.0,
                Attribute::DEL_INSURANCE                 => 1,
                Attribute::DEL_EVENING                   => 0,
                Attribute::DEL_EXWORKS                   => 1,
                Attribute::COD_PRICE                     => 1789.0,
                Attribute::COD_CURRENCY                  => 'CZK',
                Attribute::VS                            => '67890',
                Attribute::REC_NAME                      => 'Name',
                Attribute::REC_FIRM                      => 'Firm',
                Attribute::REC_NAME_PATRONYMUM           => 'Patronymum',
                Attribute::REC_STREET                    => 'Street',
                Attribute::REC_STREET_APPEND             => '12a',
                Attribute::REC_CITY                      => 'City',
                Attribute::REC_ZIP                       => '18900',
                Attribute::REC_REGION                    => 'Region',
                Attribute::REC_COUNTRY                   => 'Czech',
                Attribute::REC_LOCALE_ID                 => '15',
                Attribute::REC_EMAIL                     => 'email@email.com',
                Attribute::REC_PHONE                     => '777666555',
                Attribute::WEIGHT                        => 4.3,
                Attribute::SIZE                          => 'S',
                Attribute::LOADING_LENGTH_PALLETS        => 99.1,
                Attribute::REQUIRE_FULL_AGE              => 1,
                Attribute::FULL_AGE_MINIMUM              => '15',
                Attribute::PASSWORD                      => '123456',
                Attribute::CREDIT_CARD                   => 1,
                Attribute::SMS_NOTIFICATION              => 0,
                Attribute::WIDTH                         => 1.3,
                Attribute::LENGTH                        => 14.1,
                Attribute::HEIGHT                        => 19.0,
                Attribute::NOTE                          => 'NOTE',
                Attribute::SWAP                          => 1,
                Attribute::SWAP_OPTION                   => 'Option',
                Attribute::VDL_SERVICE                   => 1,
                Attribute::VOLUME                        => 4.0,
                Attribute::MU_TYPE                       => 'MU_1',
                Attribute::PIECES_COUNT                  => 1,
                Attribute::MU_TYPE_ONE                   => 'MU_1',
                Attribute::PIECES_COUNT_ONE              => 1,
                Attribute::MU_TYPE_TWO                   => 'MU_2',
                Attribute::PIECES_COUNT_TWO              => 2,
                Attribute::MU_TYPE_THREE                 => 'MU_3',
                Attribute::PIECES_COUNT_THREE            => 3,
                Attribute::COMFORT_SERVICE               => 1,
                Attribute::COMFORT_SERVICE_PLUS          => 0,
                Attribute::OVER_DIMENSION                => 1,
                Attribute::WRAP_BACK_COUNT               => 6,
                Attribute::WRAP_BACK_NOTE                => 'WNote',
                Attribute::APP_DISP                      => 1,
                Attribute::DELIVERY_DATE                 => '2018-10-10',
                Attribute::DATE_DELIVERY                 => '2018-10-11',
                Attribute::DELIVERY_TIME_FROM            => '10:00',
                Attribute::DELIVERY_TIME_TO              => '12:00',
                Attribute::RETURN_TRACK                  => 1,
                Attribute::BANK_ACCOUNT_NUMBER           => '56789/0900',
                Attribute::CONTENT                       => 'content',
                Attribute::TERMS_OF_TRADE                => 'terms an terms',
                Attribute::TERMS_OF_TRADE_LOCATION       => 'Prague',
                Attribute::INVOICE_PDF                   => 'base64:pdf',
                Attribute::FULL_AGE_DATA                 => 'FullAgeData',
                Attribute::SAT_DELIVERY                  => 1,
                Attribute::GET_PIECES_NUMBERS            => 0,
                Attribute::RETURN_FULL_ERRORS            => 1,
                Attribute::CONTENT_ONE                   => 'Content1',
                Attribute::CONTENT_TWO                   => 'Content2',
                Attribute::CONTENT_THREE                 => 'Content3',
                Attribute::PHONE_DELIVERY_NOTIFICATION   => 1,
                Attribute::PHONE_ORDER_NOTIFICATION      => 0,
                Attribute::EMAIL_NOTIFICATION            => 1,
                Attribute::PHONE_NOTIFICATION            => 0,
                Attribute::B2C_NOTIFICATION              => 1,
                Attribute::NOTE_DRIVER                   => 'NoteDriver',
                Attribute::NOTE_CUSTOMER                 => 'NoteCustomer',
                Attribute::COMFORT_EXCLUSIVE_SERVICE     => 0,
                Attribute::PERS_DELIVERY_FLOOR           => 1,
                Attribute::PERS_DELIVERY_BUILDING        => 0,
                Attribute::PERS_DELIVERY_DEPARTMENT      => 0,
                Attribute::PIN                           => '1235',
                Attribute::CONTENT_DATA                  => ['a' => 1, 'test' => 4],
                Attribute::CONTENT_TYPE                  => 'DOCUMENT',
                Attribute::CONTENT_TYPE_DESCRIPTION      => 'contentTypeDesc',
                Attribute::CONTENT_ADDITIONAL_FEE        => 3.45,
                Attribute::CONTENT_PRODUCE_CODE          => '999',
                Attribute::CONTENT_PLACE_OF_COMMITAL     => 'Brno',
                Attribute::INVOICE_NUMBER                => '23456789',
                Attribute::OPEN_BEFORE_PAYMENT           => 1,
                Attribute::TEST_BEFORE_PAYMENT           => 0,
                Attribute::ADR_SERVICE                   => 1,
                Attribute::ADR_CONTENT                   => ['b' => '6'],
                Attribute::REC_HOUSE_NUMBER              => '18/B',
                Attribute::REC_BLOCK                     => '15',
                Attribute::REC_ENTERANCE                 => '189-12',
                Attribute::REC_FLOOR                     => '4',
                Attribute::REC_FLAT_NUMBER               => '1900',
                Attribute::DELIVERY_COSTS                => 15.1,
                Attribute::DELIVERY_COSTS_EUR            => 5.31,
                Attribute::REC_ID                        => '567890',
                Attribute::PICKUP_DATE                   => '2019-11-11',
                Attribute::PICKUP_TIME_FROM              => '10:00',
                Attribute::PICKUP_TIME_TO                => '18:10',
                Attribute::INS_CURRENCY                  => 'EUR',
                Attribute::DEL_EXWORKS_ACCOUNT_NUMBER    => '456789/0987',
                Attribute::DEL_EXWORKS_ZIP               => '17000',
                Attribute::DEL_EXWORKS_COUNTRY_CODE      => 'CZE',
                Attribute::REFERENCE                     => 'REFEREBCE',
                Attribute::SM1_SERVICE                   => 1,
                Attribute::SM1_TEXT                      => 'TEST',
                Attribute::SM2_SERVICE                   => 0,
                Attribute::RETURN_FINAL_CARRIER_ID       => 1,
                Attribute::BANK_CODE                     => '0800',
                Attribute::DECLARATION_COMMENTS          => 'Test',
                Attribute::DECLARATION_CHARGES_DISCOUNT  => 0.15,
                Attribute::DECLARATION_INSURANCE_CHARGES => 10.0,
                Attribute::DECLARATION_OTHER_CHARGES     => 99.9,
                Attribute::DECLARATION_TRANSPORT_CHARGES => 5.3,
                Attribute::IS_ALCOHOL                    => 1,
                Attribute::CONTENT_ISSUE_DATE            => '2019-11-11',
                Attribute::CONTENT_INVOICE_NUMBER        => '1234567890',
                Attribute::CONTENT_EAD                   => 'create',
                Attribute::CONTENT_MRN                   => '1234',
                Attribute::EAD_PDF                       => 'base64:ead',
                Attribute::SEN_NAME                      => 'SenName',
                Attribute::SEN_FIRM                      => 'SenFirm',
                Attribute::SEN_STREET                    => 'SenStreet',
                Attribute::SEN_STREET_APPEND             => '12c',
                Attribute::SEN_CITY                      => 'SenCity',
                Attribute::SEN_ZIP                       => '19900',
                Attribute::SEN_COUNTRY                   => 'Slovak',
                Attribute::SEN_EMAIL                     => 'email2@email.com',
                Attribute::SEN_PHONE                     => '777666333',
                Attribute::NEUTRALIZE                    => 1,
                Attribute::NEUTRALIZE_NAME               => 'NeutralizeName',
                Attribute::NEUTRALIZE_FIRM               => 'NeutralizeFirm',
                Attribute::NEUTRALIZE_STREET             => 'NeutralizeStreet',
                Attribute::NEUTRALIZE_CITY               => 'NeutralizeCity',
                Attribute::NEUTRALIZE_ZIP                => '19900',
                Attribute::NEUTRALIZE_COUNTRY            => 'HU',
                Attribute::NEUTRALIZE_EMAIL              => 'email3@email.com',
                Attribute::NEUTRALIZE_PHONE              => '777666222',
                Attribute::NEUTRALIZE_REGION             => 'HU1',
                Attribute::NEUTRALIZE_ACCOUNT_NUMBER     => '456789/0985',
                Attribute::DCL_PDF                       => 'base64:dcl',
                Attribute::BANK_NAME                     => 'CS',
                Attribute::BANK_ACCOUNT_HOLDER           => 'BankHolderName',
                Attribute::SWIFT                         => '12345',
                Attribute::IBAN                          => '6789',
                Attribute::BRANCH_TYPE                   => 'packstation',
                Attribute::GENERATE_INVOICE              => 1,
                Attribute::PAYER                         => '2',
                Attribute::TRANSFORM_TEMP_FROM           => 5.0,
                Attribute::TRANSFORM_TEMP_TO             => 60.0,
                Attribute::SHIPPER_VAT                   => '21',
                Attribute::NOTE_INVOICE                  => 'note1',
                Attribute::INVOICE_TYPE                  => 'PRO_FORMA_INVOICE',
            ],
            $package->__toArray(),
        );
        self::assertCount(count(Attribute::getAll()) - 10, $package, sprintf('Missing: %s', implode(',', $unsupportedAttributes)));
    }
}
