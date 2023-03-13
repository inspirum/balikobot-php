# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [Unreleased](https://github.com/inspirum/balikobot-php/compare/v7.2.0...master)
- Added support for new options from documentation **v1.974** (2023-01-09)
  - Updated **PBH_UPS** service type value
  - Added **PBH_SPS** service type
### Fixed
- Fixed removing `KM` prefix for **branchId** for **PPL** carrier ([#18](https://github.com/inspirum/balikobot-php/issues/18))


## [v7.2.0 (2023-01-06)](https://github.com/inspirum/balikobot-php/compare/v7.1.0...v7.2.0)
### Added
- Added support for **PHP 8.2**
- Added support for new options from documentation **v1.972** (2022-12-07)
  - Added **FEDEX_INTERNATIONAL_FIRST** service type
  - Added **FEDEX_INTERNATIONAL_PRIORITY_EXPRESS** service type
  - Added **FEDEX_INTERNATIONAL_PRIORITY** service type
  - Added **FEDEX_REGIONAL_ECONOMY** service type
  - Added **FEDEX_INTERNATIONAL_PRIORITY_FREIGHT** service type
  - Added **FEDEX_INTERNATIONAL_ECONOMY_FREIGHT** service type
  - Added **FEDEX_REGIONAL_ECONOMY_FREIGHT** service type
  - Added **FEDEX_INTERNATIONAL_CONNECT_PLUS** service type
  - Added **FEDEX_PRIORITY_OVERNIGHT** service type


## [v7.1.0 (2022-08-19)](https://github.com/inspirum/balikobot-php/compare/v7.0.0...v7.1.0)
### Added
- Added support for new options from documentation **v1.966** (2022-08-23)
  - Added **region** to [**ZipCode**](./src/Model/ZipCode/DefaultZipCode.php) as #6 parameter
- Added support for new options from documentation **v1.967** (2022-09-22)
  - Added **invoice_type** attribute
- Added **ZASILKOVNA_FR_MONDIAL_RELAY_PP** service type
- Added **ZASILKOVNA_FR_COLIS_PRIVE_DIRECT_HD** service type
- Added **ZASILKOVNA_GR_SPEEDEX_HD** service type
- Added **ZASILKOVNA_GR_BOXNOW_BOX** service type
- Added **ZASILKOVNA_HU_FAMA_FUTAR_HD** service type
- Added **ZASILKOVNA_IT_HR_PARCEL_HD** service type
- Added **ZASILKOVNA_PL_POST_PP** service type
### Changed
- Changed order of [**ZipCode**](./src/Model/ZipCode/DefaultZipCode.php) parameters (moved **country** from #6 to #7, moved **morningDelivery** from #7 to #8)


## [v7.0.0 (2022-08-19)](https://github.com/inspirum/balikobot-php/compare/v6.4.0...v7.0.0)
### Added
- Major refactor for all package (final classes with interface, split logic to separate classes)
  - Added [**BranchService**](./src/Service/BranchService.php) service
  - Added [**InfoService**](./src/Service/InfoService.php) service
  - Added [**PackageService**](./src/Service/PackageService.php) service
  - Added [**SettingService**](./src/Service/SettingService.php) service
  - Added [**TrackService**](./src/Service/TrackService.php) service
  - Added [**SettingService**](./src/Service/SettingService.php) service
  - Added [**CarrierProvider**](./src/Provider/CarrierProvider.php) service
  - Added [**ServiceProvider**](./src/Provider/ServiceProvider.php) service
- Added support for new options from documentation **v1.957** (2022-04-14)
  - Added **CHECKB2A**, **CHECKB2C** request
- Added support for new options from documentation **v1.958** and **v1.959** (2022-04-20)
  - Added **INFO/CARRIERS** request
- Added support for new options from documentation **v1.962** (2022-07-17)
  - Added **bank_name** attribute
  - Added **bank_account_holder** attribute
  - Added **iban** attribute
  - Added **swift** attribute
- Added support for new options from documentation **v1.963** (2022-07-27)
  - Added **dcl_pdf** attribute
- Added support for new options from documentation **v1.964** (2022-08-02)
  - Added **SAMEDAY** carrier
- Added support for new options from documentation **v1.965** (2022-08-10)
  - Added **note_invoice** attribute
### Changed
- Support only **PHP 8.1+**
- Changed classnames and namespaces for most of the code base
  - Moved [**Shipper**](https://github.com/inspirum/balikobot-php/blob/6.x/src/src/Definitions/Shipper.php) to [**Carrier**](./src/Definitions/Carrier.php)
  - Moved [**ServiceType**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/ServiceType.php) to [**Service**](./src/Definitions/Service.php)
  - Moved [**Option**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Option.php) to [**Attribute**](./src/Definitions/Attribute.php)
  - Moved [**Request**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Request.php) to [**Method**](./src/Definitions/Method.php)
  - Moved [**Branch**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/Branch.php) to [**DefaultBranch**](./src/Model/Branch/DefaultBranch.php)
  - Moved [**PostCode**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/PostCode.php) to [**DefaultZipCode**](./src/Model/ZipCode/DefaultZipCode.php)
  - Moved [**PackageCollection**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Aggregates/PackageCollection.php) to [**DefaultPackageDataCollection**](./src/Model/PackageData/DefaultPackageDataCollection.php)
  - More classes in [**Model**](./src/Model) namespace
- Changed service type values
  - Changed **ZASILKOVNA_GR_ACS_HD** service type value
  - Changed **ZASILKOVNA_GR_ACS_PP** service type value
  - Changed **ZASILKOVNA_US_FEDEX_PRIORITY_HD** service type value
  - Changed **ZASILKOVNA_US_FEDEX_ECONOMY_HD** service type value
  - Changed **ZASILKOVNA_BG_ECONT_HD** service type value
  - Changed **ZASILKOVNA_BG_ECONT_BOX** service type value
  - Changed **ZASILKOVNA_BG_ECONT_PP** service type value
  - Changed **ZASILKOVNA_SI_POST_HD** service type value
  - Changed **ZASILKOVNA_SI_POST_PP** service type value
  - Changed **ZASILKOVNA_SI_POST_BOX** service type value
  - Changed **ZASILKOVNA_CZ_EXPRESS_PRAHA_HD** service type value
### Fixed
- Added missing options from documentation
  - Added **B2C** request
  - Added **ZASILKOVNA_TR_FEDEX_ECONOMY_HD** service type
  - Added **ZASILKOVNA_TR_FEDEX_PRIORITY_HD** service type
  - Added **ZASILKOVNA_IL_FEDEX_PRIORITY_HD** service type
  - Added **ZASILKOVNA_IL_FEDEX_ECONOMY_HD** service type
  - Added **ZASILKOVNA_IL_FEDEX_ECONOMY_HD** service type
  - Added **ZASILKOVNA_EE_LT_POST_HD** service type
  - Added **ZASILKOVNA_LV_LT_POST_HD** service type
  - Added **ZASILKOVNA_LT_POST_HD** service type
  - Added **ZASILKOVNA_LT_POST_BOX** service type
  - Added **DHL_MEDICAL_EXPRESS** service type
  - Added **GEIS_B2B** service type
  - Added **PBH_EXPRESS_ONE** service type
  - Added **MESSENGER_ECONOMY_BRNO** service type
  - Added **sen_name** attribute
  - Added **sen_firm** attribute
  - Added **sen_street** attribute
  - Added **sen_city** attribute
  - Added **sen_zip** attribute
  - Added **sen_country** attribute
  - Added **sen_street_append** attribute
  - Added **sen_email** attribute
  - Added **sen_phone** attribute
  - Added **neutralize** attribute
  - Added **neutralize_name** attribute
  - Added **neutralize_firm** attribute
  - Added **neutralize_street** attribute
  - Added **neutralize_city** attribute
  - Added **neutralize_zip** attribute
  - Added **neutralize_country** attribute
  - Added **neutralize_region** attribute
  - Added **neutralize_phone** attribute
  - Added **neutralize_email** attribute
  - Added **neutralize_account_number** attribute
  - Added **date_delivery** attribute
  - Added **delivery_time_from** attribute
  - Added **delivery_time_to** attribute
  - Added **size** attribute
  - Added **date_delivery** attribute
  - Added **branch_type** attribute
  - Added **content_type** attribute
  - Added **content_place_of_commital** attribute
  - Added **content_additional_fee** attribute
  - Added **content_type_description** attribute
  - Added **generate_invoice** attribute
  - Added **loading_length_pallets** attribute
  - Added **transform_temp_to** attribute
  - Added **transform_temp_from** attribute
  - Added **content_produce_code** attribute
  - Added **shipper_vat** attribute
  - Added **terms_of_trade_location** attribute
### Removed
- Removed [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) service
- Removed [**Balikobot**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Balikobot.php) service, replaced with [multiple services](./src/Service)
- Removed [**Requester**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Requester.php) service, replaced with [**Client**](./src/Client/Client.php) and [**Requester**](./src/Client/Requester.php)
- Removed [**Formatter**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Formatter.php) service


## [v6.4.0 (2022-03-26)](https://github.com/inspirum/balikobot-php/compare/v6.3.0...v6.4.0)
### Added
- Added support for new options from documentation **v1.944** (2021-12-07)
  - Added **LIFTAGO** carrier
- Added support for new options from documentation **v1.949** (2022-02-04)
  - Added **MAGYARPOSTA** carrier
- Added support for new options from documentation **v1.952** (2022-03-09)
  - Added **FULLADRUNITS** request
- Added support for new options from documentation **v1.955** (2022-03-24)
  - Added **CARRIERS/MY** request
- Added **DBSCHENKER_LPA** service type
### Changed
- Added support for `carrier_id` with a integer value type for ordered package


## [v6.3.0 (2021-11-16)](https://github.com/inspirum/balikobot-php/compare/v6.2.0...v6.3.0)
### Added
- Added support for new options from documentation **v1.940** (2021-11-05)
  - Added **WHOAMI** request
### Changed
- Added support for new options from documentation **v1.941** (2021-11-09)
  - Change response format for **B2A/SERVICES** request


## [v6.2.0 (2021-11-02)](https://github.com/inspirum/balikobot-php/compare/v6.1.0...v6.2.0)
### Added
- Added support for new options from documentation **v1.935** (2021-10-15)
  - Added **JAPO** carrier
- Added support for new options from documentation **v1.937** (2021-10-25)
  - Add **405** response status error code
### Changed
- Throw exception for **ORDERPICKUP** request response with additional message [#17](https://github.com/inspirum/balikobot-php/pull/17)


## [v6.1.0 (2021-09-16)](https://github.com/inspirum/balikobot-php/compare/v6.0.0...v6.1.0)
### Added
- Added support for new options from documentation **v1.934** (2021-08-07)
  - Added **del_exworks_country_code** attribute
- Added **ZASILKOVNA_DK_DAO_HD** service type
- Added **ZASILKOVNA_DK_DAO_PP** service type
- Added **ZASILKOVNA_ES_MRW_PP** service type
- Added **ZASILKOVNA_HR_OVERSEAS_PP** service type
- Added **ZASILKOVNA_IT_BARTOLINI_PP** service type
- Added **ZASILKOVNA_PT_MRW_PP** service type


## [v6.0.0 (2021-08-05)](https://github.com/inspirum/balikobot-php/compare/v5.6.0...v6.0.0)
### Added
- Added support for new options from documentation **v1.931** (2021-07-20)
    - Added option to get compressed response in GZIP (by parameter `?gzip=1`)
    - Added new optional parameter #6 **gzip** to method [**RequesterInterface**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Contracts/RequesterInterface.php)`call()` (and [**Requester**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Requester.php))
    - Added new optional parameter #5 **gzip** to method [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `getBranches()` 
- Enable strict types (`declare(strict_types=1)`)
- Added [**Status**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Status.php) helper methods for status determinations
### Changed
- Support only **PHP 8.0+**
- Changed option to Requester SSL verification to opt-out (enabled by default) [#14](https://github.com/inspirum/balikobot-php/pull/14)
- Changed order of [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `getBranches()` method (switch #3 **fullBranchesRequest** and #4 **country** parameters)
### Removed
- Removed deprecated **GEIS\_&ast;** service type constants


## [v5.6.0 (2021-08-04)](https://github.com/inspirum/balikobot-php/compare/v5.5.0...v5.6.0)
### Added
- Added support for new options from documentation **v1.933** (2021-07-29)
    - Added **AIRWAY** carrier
- Added opt-in option to Requester SSL verification [#14](https://github.com/inspirum/balikobot-php/pull/14)


## [v5.5.0 (2021-07-21)](https://github.com/inspirum/balikobot-php/compare/v5.4.1...v5.5.0)
### Added
- Added support for new options from documentation **v1.929** (2021-07-13)
    - Added **KURIER** carrier
- Added support for new options from documentation **v1.930** (2021-07-16)
    - Added **DBSCHENKER** carrier
### Fixed
- Fixed **TRACK** request response when API returns states as `string` instead of `array` ([#15](https://github.com/inspirum/balikobot-php/issues/15))


## [v5.4.1 (2021-07-11)](https://github.com/inspirum/balikobot-php/compare/v5.4.0...v5.4.1)
### Fixed
- Fixed **ADDSERVICEOPTIONS** request response without specific **service** ([#13](https://github.com/inspirum/balikobot-php/issues/13))


## [v5.4.0 (2021-07-08)](https://github.com/inspirum/balikobot-php/compare/v5.3.0...v5.4.0)
### Added
- Added support for new options from documentation **v1.925** (2021-06-30)
    - Added **DHLFREIGHTEC** carrier
- Added support for new options from documentation **v1.926** (2021-06-30)
    - Added **PPL_PRIVATE_SMART_CZ** service type
    - Added **PPL_PRIVATE_SMART_EU** service type
### Fixed
- Fixed branches filter by countries if service type is `null` (and carrier does not support filter by both)  ([#12](https://github.com/inspirum/balikobot-php/issues/12))
    - Added [**Shipper**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Shipper.php) `hasBranchCountryFilterSupport()` #2 **serviceCode** optional parameter


## [v5.3.0 (2021-06-21)](https://github.com/inspirum/balikobot-php/compare/v5.2.0...v5.3.0)
### Added
- Added support for new options from documentation **v1.924** (2021-06-18)
    - Added **DSV** carrier
- Added support for new options from documentation **v1.921** (2021-06-03)
    - Added **content_issue_date** attribute
    - Added **content_invoice_number** attribute
    - Added **content_ead** attribute
    - Added **content_mrn** attribute
    - Added **ead_pdf** attribute
- Added support for new options from documentation **v1.919** (2021-05-11)
    - Added **SPRING** carrier


## [v5.2.0 (2021-05-01)](https://github.com/inspirum/balikobot-php/compare/v5.1.0...v5.2.0)
### Added
- Added [**Status**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Status.php) constants
- Added support for new options from documentation **v1.918** (2021-04-29)
    - Added **RABEN** carrier
- Added support for new options from documentation **v1.915** (2021-04-19)
    - Added **DHLPARCEL** carrier
- Added support for new options from documentation **v1.914** (2021-04-19)
    - Added **DACHSER** carrier
- Added support for new options from documentation **v1.913** (2021-04-08)
    - Added **PPL_BUSINESS_EU** service type
- Added support for new options from documentation **v1.912** (2021-04-06)
    - Added **INTIME_BOX_CZ** service type
    - Added **INTIME_BOX_SK** service type
- Added support for new options from documentation **v1.911** (2021-03-29)
    - Added **ADDATTRIBUTES** request
- Added support for new options from documentation **v1.908** (2021-03-23)
    - Added **ADDSERVICEOPTIONS** request


## [v5.1.0 (2021-03-17)](https://github.com/inspirum/balikobot-php/compare/v5.0.0...v5.1.0)
### Added
- Added support for new options from documentation **v1.902** (2021-02-10)
    - Added **declaration_comments** attribute
    - Added **declaration_charges_discount** attribute
    - Added **declaration_insurance_charges** attribute
    - Added **declaration_other_charges** attribute
    - Added **declaration_transport_charges** attribute
    - Added **is_alcohol** attribute
- Added **ZASILKOVNA_FR_COLISSIMO_PP** service type
- Added support for new options from documentation **v1.905** (2021-03-09)
    - Added **TNT_DIRECT_INFEED** service type
- Added **ZASILKOVNA_FR_COLIS_PRIVE_HD** service type
- Added **FOFR_PALETTE** service type
### Deprecated
- Deprecated some **GEIS\_&ast;** service type constants


## [v5.0.0 (2021-02-01)](https://github.com/inspirum/balikobot-php/compare/v4.5.0...v5.0.0)
> This release (^5.0) uses new refactored **API v2**
### Added
- Added request/response format from [APIv2 documentation](https://balikobotv2.docs.apiary.io/#introduction/rozdil-api-v2-vs-api-v1)
- Added [**Branch**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/Branch.php) #4 **uid** parameter to constructor
### Changed
- Updated default API URL to `API::V2V1` (**apiv2.balikobot.cz**)
### Fixed
- Fixed [**Country**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/Country.php) #4 **phonePrefix** parameter to `array` type
- Fixed [**OrderedPackage**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/OrderedPackage.php) #1 **packageId** parameter to `string` type
- Fixed [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `getOrder()` method #2 **orderId** parameter from `int` to `string` type
### Removed
- Removed parameter #3 **version** from [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `addPackages()` method
- Removed parameter #2 **country** from [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `getServices()` method
- Removed parameter #3 **version** from [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `getServices()` method
- Removed parameter #5 **version** from [**Client**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Client.php) `getBranches()` method
- Removed [**Shipper**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Shipper.php) `resolveAddRequestVersion()` method
- Removed [**Shipper**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Shipper.php) `resolveServicesRequestVersion()` method
- Removed [**Shipper**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Definitions/Shipper.php) `resolveBranchesRequestVersion()` method
- Removed parameter #2 **country** from [**Balikobot**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Services/Balikobot.php) `getServices()` method
- Removed **ZASILKOVNA\_&ast;** service type constants


## [v4.5.0 (2021-02-01)](https://github.com/inspirum/balikobot-php/compare/v4.4.0...v4.5.0)
### Added
- Added error messages from package data validation to exception message as newlines (inspired by [#7](https://github.com/inspirum/balikobot-php/pull/7))


## [v4.4.0 (2021-01-22)](https://github.com/inspirum/balikobot-php/compare/v4.3.0...v4.4.0)
### Added
- Added support for new options from documentation **v1.901** (2021-01-18)
    - Added **GEIS_PARCEL_HD_STANDARD** service type
    - Added **GEIS_PARCEL_HD_PREMIUM** service type
- Added **max_weight** to branches


## [v4.3.0 (2020-12-30)](https://github.com/inspirum/balikobot-php/compare/v4.2.0...v4.3.0)
### Added
- Added support for new options from documentation **v1.896** (2020-11-18)
    - Added **PACKAGE** request filtered by **carrier_id**
- Added support for new options from documentation **v1.897** (2020-11-30)
    - Added **FOFR** carrier
- Added support for new options from documentation **v1.898** (2020-12-01)
    - Added **CHANGELOG** request


## [v4.2.0 (2020-11-10)](https://github.com/inspirum/balikobot-php/compare/v4.1.0...v4.2.0)
### Added
- Added support for new options from documentation **v1.897** (2020-11-30)
    - Added **FEDEX** carrier
- Added multiple **ZASILKOVNA\_&ast;** service types


## [v4.1.0 (2020-10-29)](https://github.com/inspirum/balikobot-php/compare/v4.0.0...v4.1.0)
### Added
- Added support for new options from documentation **v1.894** (2020-10-20)
    - Added **DHLDE** carrier
- Added support for new options from documentation **v1.895** (2020-10-29)
    - Added **PBH_123_KURIER** service type


## [v4.0.0 (2020-09-21)](https://github.com/inspirum/balikobot-php/compare/v3.3.0...v4.0.0)
### Added
- Added support for new options from documentation **v1.892** (2020-09-14)
    - Added **GETCOUNTRIESDATA** request
- Added support for new options from documentation **v1.893** (2020-09-17)
    - Added **TRACK** **v3** request
    - Added **TRACK_STATUS** **v2** request
- Added optional **fullData** parameter for **ADDRUNIT**, **MANIPULATIONUNITS**, **ACTIVATEDMANIPULATIONUNITS** methods
### Changed
- Updated [**PackageStatus**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/PackageStatus.php) to support data from **TRACK** **v3**
    - Method **getId** return `float` instead of `int` (attribute **status_id_v2**)
    - Method **getName** return new internal status name (attribute **name_balikobot**)
    - Added method **getGroupId** (attribute **status_id**)
    - Added method **getDescription** (attribute **name**)
    - Added method **getType** (attribute **type**)
- Renamed [**Package**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Values/Package.php) method **setHeigth** to **setHeight**
### Removed
- Removed **ZASILKOVNA\_&ast;** service type constants
- Removed **TOP_TRANS\_&ast;** service type constants
- Removed **ACTIVATEDSERVICES** request constant


## [v3.3.0 (2020-09-10)](https://github.com/inspirum/balikobot-php/compare/v3.2.2...v3.3.0)
### Added
- Added support for new options from documentation **v1.889** (2020-07-22)
    - Added **CP_OLZ** service type
- Added support for new options from documentation **v1.890** (2020-08-26)
    - Added **PBH_ACS** service type
    - Added **PBH_CORREOS** service type
- Added multiple **ZASILKOVNA\_&ast;** service types
### Changed
- Normalized service type constants, change to **ZASILKOVNA\_&ast;\_HD**, **ZASILKOVNA\_&ast;\_PP**, **ZASILKOVNA\_&ast;\_BOX**
### Deprecated
- Deprecated multiple **ZASILKOVNA\_&ast;** service type constants


## [v3.2.2 (2020-07-18)](https://github.com/inspirum/balikobot-php/compare/v3.2.1...v3.2.2)
### Changed
- Normalized service type constants, change **TOP_TRANS\_&ast;** to **TOPTRANS\_&ast;**
### Deprecated
- Deprecated **TOP_TRANS\_&ast;** service type constants


## [v3.2.1 (2020-07-15)](https://github.com/inspirum/balikobot-php/compare/v3.2.0...v3.2.1)
### Fixes
- Fixed branch street house/orientation number for **CP** carrier


## [v3.2.0 (2020-06-07)](https://github.com/inspirum/balikobot-php/compare/v3.1.0...v3.2.0)
### Added
- Added support for new options from documentation **v1.886** (2020-05-29)
    - Added **TRANSPORTCOSTS** request
- Added support for new options from documentation **v1.887** (2020-06-09)
    - Added **MESSENGER** (Messenger) carrier


## [v3.1.0 (2020-05-30)](https://github.com/inspirum/balikobot-php/compare/v3.0.0...v3.1.0)
### Added
- Added support for new options from documentation **v1.885** (2020-05-14)
    - Added **PBH_ECONT** service type
- Added support for new options from documentation **v1.884** (2020-05-07)
    - Added **ACTIVATEDMANIPULATIONUNITS** request
- Added **ZASILKOVNA_DE_HERMES_HOME** service type 
- Added **ZASILKOVNA_DE_HERMES_PICKUP** service type 
- Added **ZASILKOVNA_LT_HOME** service type 
### Changed
- Normalized request constants, change **ACTIVATEDSERVICES** to **ACTIVATED_SERVICES**
### Fixed
- Fixed bug that API returns only last package statuses for GLS carrier ([#3](https://github.com/inspirum/balikobot-php/issues/3))
### Deprecated
- Deprecated **ACTIVATEDSERVICES** request constant


## [v3.0.0 (2020-05-09)](https://github.com/inspirum/balikobot-php/compare/v2.0.1...v3.0.0)
### Added
- Added support for new options from documentation **v1.882** (2020-04-15)
    - Added **ADD** **v2** request for **TOPTRANS** carrier
- Added support for new options from documentation **v1.881** (2020-04-09)
    - Added **country** parameter to **SERVICES** **v2** request
    - Added **ADD** **v2** request for **ZASILKOVNA** carrier
    - Added **BRANCHES** **v2** request for **ZASILKOVNA** carrier
    - Added **SERVICES** **v2** request for **ZASILKOVNA** carrier
    - Added **ZASILKOVNA** services type
    - Added **full_age_minimum** attribute
### Changed
- Normalized carrier constants, change **TOP_TRANS** to **TOPTRANS**


## [v2.0.1 (2020-03-24)](https://github.com/inspirum/balikobot-php/compare/v2.0.0...v2.0.1)
### Fixed
- Set branch country to **CZ** if missing (for **CP** carrier with **NP** service)


## [v2.0.0 (2020-03-15)](https://github.com/inspirum/balikobot-php/compare/v1.4.0...v2.0.0)
### Added
- Added options to get **labelsUrL** from **ADD** request
- Added **labelsUrL** attribute to [**OrderedPackageCollection**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Aggregates/OrderedPackageCollection.php)
- [**PackageCollection**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Aggregates/PackageCollection.php) implements `\ArrayAccess` interface
### Changed
- Support multiple **EID** in [**PackageCollection**](https://github.com/inspirum/balikobot-php/blob/6.x/src/Model/Aggregates/PackageCollection.php)
### Removed
- Deprecated **date** and **note** parameters from **ORDER** request
- Removed **DHLSK** carrier support


## [v1.4.0 (2020-03-15)](https://github.com/inspirum/balikobot-php/compare/v1.3.2...v1.4.0)
### Added
- Added support for new options from documentation **v1.879** (2020-03-13)
    - Added **GWCZ** (Gebrüder Weiss Česká republika) carrier
- Added support for new options from documentation **v1.878** (2020-01-30)
    - Added **B2A/SERVICES** request
### Fixed
- Fixed bug with bad formatted latitude/longitude in branch import
### Deprecated
- Deprecated **date** and **note** parameters from **ORDER** request
- Deprecated **DHLSK** carrier support


## [v1.3.2 (2020-01-06)](https://github.com/inspirum/balikobot-php/compare/v1.3.1...v1.3.2)
### Fixed
- Fixed bug with empty string in latitude/longitude in branch import


## [v1.3.1 (2019-11-18)](https://github.com/inspirum/balikobot-php/compare/v1.3.0...v1.3.1)
### Added
- Added helper method for information if carrier support filtering branches by country code
### Fixed
- Fixed branch filtering by country code(s)
### Removed
- Removed **country** parameter from method that list branches


## [v1.3.0 (2019-11-17)](https://github.com/inspirum/balikobot-php/compare/v1.2.0...v1.3.0)
### Added
- Added methods for track multiple packages
- Added methods to get branches filtered by country codes
- Added support for new options from documentation **v1.873** (2019-11-15)
    - Added **country** parameter to **BRANCHES** request
    - Added **ADD** **v2** request for **DHL** carrier
    - Added **ADD** **v2** request for **TNT** carrier
    - Added **bank_code** attribute
- Added support for new options from documentation **v1.872** (2019-10-24)
    - Added **ADD** **v2** request for **UPS** carrier
- Added support for new options from documentation **v1.872** (2019-10-22)
    - Added **POD** request
    - Added **GLS_GUARANTEED24** service type
    - Added **GLS_GUARANTEED24_EXPRESS** service type
    - Added **GLS_GUARANTEED24_SHOP** service type
    - Added **GW_DOMESTIC** service type
    - Added **GW_EXPORT** service type
    - Added **reference** attribute
    - Added **sm1_service** attribute
    - Added **sm1_text** attribute
    - Added **sm1_text** attribute
    - Added **sm2_service** attribute


## [v1.2.0 (2019-09-07)](https://github.com/inspirum/balikobot-php/compare/v1.1.2...v1.2.0)
### Added
- Added support for new options from documentation **v1.870** (2019-09-05)
    - Added **GW** (Gebrüder Weiss) carrier
- Added support for new options from documentation **v1.869** (2019-08-19)
    - Added **del_exworks_account_number** attribute
    - Added **del_exworks_zip** attribute
- Added support for new options from documentation **v1.867** (2019-07-23)
    - Added **INTIME_PARCEL_EU** service type
    - Added **INTIME_PARCEL_EU_PLUS** service type
    - Added **ins_currency** attribute
- Added support for new options from documentation **v1.866** (2019-07-10)
    - Added **B2A** request
- Added support for new options from documentation **v1.865** (2019-07-01)
    - Added **rec_id** attribute
- Added support for new options from documentation **v1.864** (2019-06-26)
    - Added **type** parameter to **BRANCHLOCATOR** request


## [v1.1.2 (2019-06-24)](https://github.com/inspirum/balikobot-php/compare/v1.1.1...v1.1.2)
### Added
- Added support for new options from documentation **v1.861** (2019-05-28)
    - Added **ACTIVATEDSERVICES** request
- Added support for new options from documentation **v1.859** (2019-05-07)
    - Added **SPS_INTERNATIONAL** service type (Export (mezinárodní zásilky))
### Fixed
- Fixed bug that **TRACK** request does not require **status** attribute in response data


## [v1.1.1 (2019-05-01)](https://github.com/inspirum/balikobot-php/compare/v1.1.0...v1.1.1)
### Added
- Added support for new options from documentation **v1.857** (2019-04-26)
    - Added **delivery_costs** attribute
    - Added **delivery_costs_eur** attribute
- Added support for new options from documentation **v1.856** (2019-04-10)
    - Added **SPS** (Slovak Parcel Service) carrier
    - Added **ULOZENKA_EXPRESS_COURRIER** service type (Expres Kurýr SK for Ulozenka)
    - Added **ULOZENKA_EXPRESS_SK** service type (Expres na poštu SK for Ulozenka)
    - Added **ULOZENKA_BALIKOBOX_SK** service type (BalíkoBOX SK for Ulozenka)
    - Added **ULOZENKA_DEPO_SK** service type (Depo SK for Ulozenka)


## [v1.1.0 (2019-03-23)](https://github.com/inspirum/balikobot-php/compare/v1.0.4...v1.1.0)
### Added
- Added support for new options from documentation **v1.855** (2019-03-19)
    - Added **DHLSK** carrier
- Added support for new options from documentation **v1.854** (2019-03-13)
    - Added **COD4SERVICES** request
- Added support for new options from documentation **v1.853** (2019-02-28)
    - Added **BRANCHLOCATOR** request
- Added support for new options from documentation **v1.852** (2019-02-26)
    - Added **TNT** carrier
- Added support for new options from documentation **v1.851** (2019-02-19)
    - Added new definitons for regions
- Added support for new options from documentation **v1.847** (2019-01-22)
    - Added **PBH_NOBA_POSHTA** service type (Nova Poshta (UA) for PbH)
    - Added **rec_name_patronymum** attribute
    - Added **rec_locale_id** attribute


## [v1.0.4 (2019-01-09)](https://github.com/inspirum/balikobot-php/compare/v1.0.3...v1.0.4)
### Added
- Added support for new options from documentation **v1.846** (2019-01-08)
    - Added **rec_house_number** attribute
    - Added **rec_block** attribute
    - Added **rec_enterance** attribute
    - Added **rec_floor** attribute
    - Added **rec_flat_number** attribute  
### Changed
- Moved repository to [**@inspirum**](https://github.com/inspirum) account


## [v1.0.3 (2019-01-02)](https://github.com/inspirum/balikobot-php/compare/v1.0.2...v1.0.3)
### Fixed
- Fixed links url


## [v1.0.2 (2019-01-02)](https://github.com/inspirum/balikobot-php/compare/v1.0.1...v1.0.2)
### Changed
- Changed composer package name to `inspirum/balikobot`


## [v1.0.1 (2018-12-30)](https://github.com/inspirum/balikobot-php/compare/v1.0.0...v1.0.1)
### Fixed
- Fixed tests


## v1.0.0 (2018-12-27)
### Added
- Added support for all requests and options in documentation **v1.845** (2018-11-29)
