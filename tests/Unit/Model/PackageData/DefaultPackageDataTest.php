<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit\Model\PackageData;

use DateTimeImmutable;
use Inspirum\Balikobot\Definitions\AttributeType;
use Inspirum\Balikobot\Model\PackageData\DefaultPackageData;
use Inspirum\Balikobot\Tests\Unit\BaseTestCase;

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
        $package->setRecCity('City');
        $package->setRecZip('18900');
        $package->setRecRegion('Region');
        $package->setRecCountry('Czech');
        $package->setRecLocaleId('15');
        $package->setRecEmail('email@email.com');
        $package->setRecPhone('777666555');
        $package->setWeight(4.3);
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
        $package->setReturnTrack(true);
        $package->setBankAccountNumber('56789/0900');
        $package->setContent('content');
        $package->setTermsOfTrade('terms an terms');
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

        self::assertEquals(
            [
                AttributeType::EID                           => 'eid',
                AttributeType::ORDER_NUMBER                  => 1,
                AttributeType::REAL_ORDER_ID                 => 'RealOrderID',
                AttributeType::SERVICE_TYPE                  => 'NP',
                AttributeType::SERVICES                      => '1+2+3',
                AttributeType::BRANCH_ID                     => 'ID678',
                AttributeType::PRICE                         => 2000.0,
                AttributeType::DEL_INSURANCE                 => 1,
                AttributeType::DEL_EVENING                   => 0,
                AttributeType::DEL_EXWORKS                   => 1,
                AttributeType::COD_PRICE                     => 1789.0,
                AttributeType::COD_CURRENCY                  => 'CZK',
                AttributeType::VS                            => '67890',
                AttributeType::REC_NAME                      => 'Name',
                AttributeType::REC_FIRM                      => 'Firm',
                AttributeType::REC_NAME_PATRONYMUM           => 'Patronymum',
                AttributeType::REC_STREET                    => 'Street',
                AttributeType::REC_CITY                      => 'City',
                AttributeType::REC_ZIP                       => '18900',
                AttributeType::REC_REGION                    => 'Region',
                AttributeType::REC_COUNTRY                   => 'Czech',
                AttributeType::REC_LOCALE_ID                 => '15',
                AttributeType::REC_EMAIL                     => 'email@email.com',
                AttributeType::REC_PHONE                     => '777666555',
                AttributeType::WEIGHT                        => 4.3,
                AttributeType::REQUIRE_FULL_AGE              => 1,
                AttributeType::FULL_AGE_MINIMUM              => '15',
                AttributeType::PASSWORD                      => '123456',
                AttributeType::CREDIT_CARD                   => 1,
                AttributeType::SMS_NOTIFICATION              => 0,
                AttributeType::WIDTH                         => 1.3,
                AttributeType::LENGTH                        => 14.1,
                AttributeType::HEIGHT                        => 19.0,
                AttributeType::NOTE                          => 'NOTE',
                AttributeType::SWAP                          => 1,
                AttributeType::SWAP_OPTION                   => 'Option',
                AttributeType::VDL_SERVICE                   => 1,
                AttributeType::VOLUME                        => 4.0,
                AttributeType::MU_TYPE                       => 'MU_1',
                AttributeType::PIECES_COUNT                  => 1,
                AttributeType::MU_TYPE_ONE                   => 'MU_1',
                AttributeType::PIECES_COUNT_ONE              => 1,
                AttributeType::MU_TYPE_TWO                   => 'MU_2',
                AttributeType::PIECES_COUNT_TWO              => 2,
                AttributeType::MU_TYPE_THREE                 => 'MU_3',
                AttributeType::PIECES_COUNT_THREE            => 3,
                AttributeType::COMFORT_SERVICE               => 1,
                AttributeType::COMFORT_SERVICE_PLUS          => 0,
                AttributeType::OVER_DIMENSION                => 1,
                AttributeType::WRAP_BACK_COUNT               => 6,
                AttributeType::WRAP_BACK_NOTE                => 'WNote',
                AttributeType::APP_DISP                      => 1,
                AttributeType::DELIVERY_DATE                 => '2018-10-10',
                AttributeType::RETURN_TRACK                  => 1,
                AttributeType::BANK_ACCOUNT_NUMBER           => '56789/0900',
                AttributeType::CONTENT                       => 'content',
                AttributeType::TERMS_OF_TRADE                => 'terms an terms',
                AttributeType::INVOICE_PDF                   => 'base64:pdf',
                AttributeType::FULL_AGE_DATA                 => 'FullAgeData',
                AttributeType::SAT_DELIVERY                  => 1,
                AttributeType::GET_PIECES_NUMBERS            => 0,
                AttributeType::RETURN_FULL_ERRORS            => 1,
                AttributeType::CONTENT_ONE                   => 'Content1',
                AttributeType::CONTENT_TWO                   => 'Content2',
                AttributeType::CONTENT_THREE                 => 'Content3',
                AttributeType::PHONE_DELIVERY_NOTIFICATION   => 1,
                AttributeType::PHONE_ORDER_NOTIFICATION      => 0,
                AttributeType::EMAIL_NOTIFICATION            => 1,
                AttributeType::PHONE_NOTIFICATION            => 0,
                AttributeType::B2C_NOTIFICATION              => 1,
                AttributeType::NOTE_DRIVER                   => 'NoteDriver',
                AttributeType::NOTE_CUSTOMER                 => 'NoteCustomer',
                AttributeType::COMFORT_EXCLUSIVE_SERVICE     => 0,
                AttributeType::PERS_DELIVERY_FLOOR           => 1,
                AttributeType::PERS_DELIVERY_BUILDING        => 0,
                AttributeType::PERS_DELIVERY_DEPARTMENT      => 0,
                AttributeType::PIN                           => '1235',
                AttributeType::CONTENT_DATA                  => ['a' => 1, 'test' => 4],
                AttributeType::INVOICE_NUMBER                => '23456789',
                AttributeType::OPEN_BEFORE_PAYMENT           => 1,
                AttributeType::TEST_BEFORE_PAYMENT           => 0,
                AttributeType::ADR_SERVICE                   => 1,
                AttributeType::ADR_CONTENT                   => ['b' => '6'],
                AttributeType::REC_HOUSE_NUMBER              => '18/B',
                AttributeType::REC_BLOCK                     => '15',
                AttributeType::REC_ENTERANCE                 => '189-12',
                AttributeType::REC_FLOOR                     => '4',
                AttributeType::REC_FLAT_NUMBER               => '1900',
                AttributeType::DELIVERY_COSTS                => 15.1,
                AttributeType::DELIVERY_COSTS_EUR            => 5.31,
                AttributeType::REC_ID                        => '567890',
                AttributeType::PICKUP_DATE                   => '2019-11-11',
                AttributeType::PICKUP_TIME_FROM              => '10:00',
                AttributeType::PICKUP_TIME_TO                => '18:10',
                AttributeType::INS_CURRENCY                  => 'EUR',
                AttributeType::DEL_EXWORKS_ACCOUNT_NUMBER    => '456789/0987',
                AttributeType::DEL_EXWORKS_ZIP               => '17000',
                AttributeType::DEL_EXWORKS_COUNTRY_CODE      => 'CZE',
                AttributeType::REFERENCE                     => 'REFEREBCE',
                AttributeType::SM1_SERVICE                   => true,
                AttributeType::SM1_TEXT                      => 'TEST',
                AttributeType::SM2_SERVICE                   => false,
                AttributeType::RETURN_FINAL_CARRIER_ID       => 1,
                AttributeType::BANK_CODE                     => '0800',
                AttributeType::DECLARATION_COMMENTS          => 'Test',
                AttributeType::DECLARATION_CHARGES_DISCOUNT  => 0.15,
                AttributeType::DECLARATION_INSURANCE_CHARGES => 10,
                AttributeType::DECLARATION_OTHER_CHARGES     => 99.9,
                AttributeType::DECLARATION_TRANSPORT_CHARGES => 5.3,
                AttributeType::IS_ALCOHOL                    => true,
                AttributeType::CONTENT_ISSUE_DATE            => '2019-11-11',
                AttributeType::CONTENT_INVOICE_NUMBER        => '1234567890',
                AttributeType::CONTENT_EAD                   => 'create',
                AttributeType::CONTENT_MRN                   => '1234',
                AttributeType::EAD_PDF                       => 'base64:ead',
            ],
            $package->__toArray()
        );
    }
}
