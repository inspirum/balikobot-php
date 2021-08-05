<?php

declare(strict_types=1);

namespace Inspirum\Balikobot\Tests\Unit;

use DateTime;
use Inspirum\Balikobot\Definitions\Option;
use Inspirum\Balikobot\Model\Values\Package;
use Inspirum\Balikobot\Tests\AbstractTestCase;

class PackageTest extends AbstractTestCase
{
    public function testConstructor(): void
    {
        $package = new Package(
            [
                'a'    => 1,
                'eid'  => '7890',
                'test' => false,
            ]
        );

        $this->assertEquals(
            [
                'a'    => 1,
                'eid'  => '7890',
                'test' => false,
            ],
            $package->toArray()
        );
    }

    public function testSupportArrayAccess(): void
    {
        $package = new Package();

        $package->offsetSet('a', 2);
        $package->offsetSet('b', false);

        $this->assertEquals(2, $package->offsetGet('a'));
        $this->assertEquals(false, $package->offsetGet('b'));
        $this->assertTrue($package->offsetExists('b'));

        $package->offsetUnset('b');

        $this->assertFalse($package->offsetExists('b'));
    }

    public function testPackageSetters(): void
    {
        $package = new Package();

        $package->setEID('eid');
        $package->setOrderNumber(1);
        $package->setRealOrderId('RealOrderID');
        $package->setServiceType('NP');
        $package->setServices([1, 2, 3]);
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
        $package->setDeliveryDate(new DateTime('2018-10-10 10:00:01'));
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
        $package->setPickupDate(new DateTime('2019-11-11 10:00:01'));
        $package->setPickupTimeFrom(new DateTime('2019-11-11 10:00:01'));
        $package->setPickupTimeTo(new DateTime('2019-11-11 18:10:59'));
        $package->setPickupTimeTo(new DateTime('2019-11-11 18:10:59'));
        $package->setInsCurrency('EUR');
        $package->setDelAccountNumber('456789/0987');
        $package->setDelZip('17000');
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
        $package->setContentIssueDate(new DateTime('2019-11-11 18:10:59'));
        $package->setContentInvoiceNumber('1234567890');
        $package->setContentEAD('create');
        $package->setContentMRN('1234');
        $package->setEADPdf('base64:ead');

        $this->assertEquals(
            [
                Option::EID                           => 'eid',
                Option::ORDER_NUMBER                  => 1,
                Option::REAL_ORDER_ID                 => 'RealOrderID',
                Option::SERVICE_TYPE                  => 'NP',
                Option::SERVICES                      => '1+2+3',
                Option::BRANCH_ID                     => 'ID678',
                Option::PRICE                         => 2000.0,
                Option::DEL_INSURANCE                 => 1,
                Option::DEL_EVENING                   => 0,
                Option::DEL_EXWORKS                   => 1,
                Option::COD_PRICE                     => 1789.0,
                Option::COD_CURRENCY                  => 'CZK',
                Option::VS                            => '67890',
                Option::REC_NAME                      => 'Name',
                Option::REC_FIRM                      => 'Firm',
                Option::REC_NAME_PATRONYMUM           => 'Patronymum',
                Option::REC_STREET                    => 'Street',
                Option::REC_CITY                      => 'City',
                Option::REC_ZIP                       => '18900',
                Option::REC_REGION                    => 'Region',
                Option::REC_COUNTRY                   => 'Czech',
                Option::REC_LOCALE_ID                 => '15',
                Option::REC_EMAIL                     => 'email@email.com',
                Option::REC_PHONE                     => '777666555',
                Option::WEIGHT                        => 4.3,
                Option::REQUIRE_FULL_AGE              => 1,
                Option::FULL_AGE_MINIMUM              => '15',
                Option::PASSWORD                      => '123456',
                Option::CREDIT_CARD                   => 1,
                Option::SMS_NOTIFICATION              => 0,
                Option::WIDTH                         => 1.3,
                Option::LENGTH                        => 14.1,
                Option::HEIGHT                        => 19.0,
                Option::NOTE                          => 'NOTE',
                Option::SWAP                          => 1,
                Option::SWAP_OPTION                   => 'Option',
                Option::VDL_SERVICE                   => 1,
                Option::VOLUME                        => 4.0,
                Option::MU_TYPE                       => 'MU_1',
                Option::PIECES_COUNT                  => 1,
                Option::MU_TYPE_ONE                   => 'MU_1',
                Option::PIECES_COUNT_ONE              => 1,
                Option::MU_TYPE_TWO                   => 'MU_2',
                Option::PIECES_COUNT_TWO              => 2,
                Option::MU_TYPE_THREE                 => 'MU_3',
                Option::PIECES_COUNT_THREE            => 3,
                Option::COMFORT_SERVICE               => 1,
                Option::COMFORT_SERVICE_PLUS          => 0,
                Option::OVER_DIMENSION                => 1,
                Option::WRAP_BACK_COUNT               => 6,
                Option::WRAP_BACK_NOTE                => 'WNote',
                Option::APP_DISP                      => 1,
                Option::DELIVERY_DATE                 => '2018-10-10',
                Option::RETURN_TRACK                  => 1,
                Option::BANK_ACCOUNT_NUMBER           => '56789/0900',
                Option::CONTENT                       => 'content',
                Option::TERMS_OF_TRADE                => 'terms an terms',
                Option::INVOICE_PDF                   => 'base64:pdf',
                Option::FULL_AGE_DATA                 => 'FullAgeData',
                Option::SAT_DELIVERY                  => 1,
                Option::GET_PIECES_NUMBERS            => 0,
                Option::RETURN_FULL_ERRORS            => 1,
                Option::CONTENT_ONE                   => 'Content1',
                Option::CONTENT_TWO                   => 'Content2',
                Option::CONTENT_THREE                 => 'Content3',
                Option::PHONE_DELIVERY_NOTIFICATION   => 1,
                Option::PHONE_ORDER_NOTIFICATION      => 0,
                Option::EMAIL_NOTIFICATION            => 1,
                Option::PHONE_NOTIFICATION            => 0,
                Option::B2C_NOTIFICATION              => 1,
                Option::NOTE_DRIVER                   => 'NoteDriver',
                Option::NOTE_CUSTOMER                 => 'NoteCustomer',
                Option::COMFORT_EXCLUSIVE_SERVICE     => 0,
                Option::PERS_DELIVERY_FLOOR           => 1,
                Option::PERS_DELIVERY_BUILDING        => 0,
                Option::PERS_DELIVERY_DEPARTMENT      => 0,
                Option::PIN                           => '1235',
                Option::CONTENT_DATA                  => ['a' => 1, 'test' => 4],
                Option::INVOICE_NUMBER                => '23456789',
                Option::OPEN_BEFORE_PAYMENT           => 1,
                Option::TEST_BEFORE_PAYMENT           => 0,
                Option::ADR_SERVICE                   => 1,
                Option::ADR_CONTENT                   => ['b' => '6'],
                Option::REC_HOUSE_NUMBER              => '18/B',
                Option::REC_BLOCK                     => '15',
                Option::REC_ENTERANCE                 => '189-12',
                Option::REC_FLOOR                     => '4',
                Option::REC_FLAT_NUMBER               => '1900',
                Option::DELIVERY_COSTS                => 15.1,
                Option::DELIVERY_COSTS_EUR            => 5.31,
                Option::REC_ID                        => '567890',
                Option::PICKUP_DATE                   => '2019-11-11',
                Option::PICKUP_TIME_FROM              => '10:00',
                Option::PICKUP_TIME_TO                => '18:10',
                Option::INS_CURRENCY                  => 'EUR',
                Option::DEL_EXWORKS_ACCOUNT_NUMBER    => '456789/0987',
                Option::DEL_EXWORKS_ZIP               => '17000',
                Option::REFERENCE                     => 'REFEREBCE',
                Option::SM1_SERVICE                   => true,
                Option::SM1_TEXT                      => 'TEST',
                Option::SM2_SERVICE                   => false,
                Option::RETURN_FINAL_CARRIER_ID       => 1,
                Option::BANK_CODE                     => '0800',
                Option::DECLARATION_COMMENTS          => 'Test',
                Option::DECLARATION_CHARGES_DISCOUNT  => 0.15,
                Option::DECLARATION_INSURANCE_CHARGES => 10,
                Option::DECLARATION_OTHER_CHARGES     => 99.9,
                Option::DECLARATION_TRANSPORT_CHARGES => 5.3,
                Option::IS_ALCOHOL                    => true,
                Option::CONTENT_ISSUE_DATE            => '2019-11-11',
                Option::CONTENT_INVOICE_NUMBER        => '1234567890',
                Option::CONTENT_EAD                   => 'create',
                Option::CONTENT_MRN                   => '1234',
                Option::EAD_PDF                       => 'base64:ead',
            ],
            $package->toArray()
        );
    }
}
