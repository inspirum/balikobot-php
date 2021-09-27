# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [Unreleased](https://github.com/inspirum/balikobot-php/compare/v5.6.0...master)


## [v5.7.0 (2021-09-27)](https://github.com/inspirum/balikobot-php/compare/v5.6.0...v5.7.0)
### Added
- Added **ZASILKOVNA_DE_HOME_DELIVERY_HD** service type
- Added **ZASILKOVNA_DK_DAO_HD** service type
- Added **ZASILKOVNA_DK_DAO_PP** service type
- Added **ZASILKOVNA_ES_MRW_PP** service type
- Added **ZASILKOVNA_HR_OVERSEAS_PP** service type
- Added **ZASILKOVNA_IT_BARTOLINI_PP** service type
- Added **ZASILKOVNA_PT_MRW_PP** service type


## [v5.6.0 (2021-08-04)](https://github.com/inspirum/balikobot-php/compare/v5.5.0...v5.6.0)
### Added
- Added support for new options from documentation **v1.933** (2021-07-29)
  - Add **AIRWAY** shipper
- Added opt-in option to Requester SSL verification [#14](https://github.com/inspirum/balikobot-php/pull/14)


## [v5.5.0 (2021-07-21)](https://github.com/inspirum/balikobot-php/compare/v5.4.1...v5.5.0)
### Added
- Added support for new options from documentation **v1.929** (2021-07-13)
  - Add **KURIER** shipper
- Added support for new options from documentation **v1.930** (2021-07-16)
  - Add **DBSCHENKER** shipper
### Fixed
- Fixed **TRACK** request response when API returns states as `string` instead of `array` ([#15](https://github.com/inspirum/balikobot-php/issues/15))


## [v5.4.1 (2021-07-11)](https://github.com/inspirum/balikobot-php/compare/v5.4.0...v5.4.1)
### Fixed
- Fixed **ADDSERVICEOPTIONS** request response without specific **service** ([#13](https://github.com/inspirum/balikobot-php/issues/13))


## [v5.4.0 (2021-07-08)](https://github.com/inspirum/balikobot-php/compare/v5.3.0...v5.4.0)
### Added
- Added support for new options from documentation **v1.925** (2021-06-30)
  - Add **DHLFREIGHTEC** shipper
- Added support for new options from documentation **v1.926** (2021-06-30)
  - Added **PPL_PRIVATE_SMART_CZ** service type
  - Added **PPL_PRIVATE_SMART_EU** service type
### Fixed
- Fixed branches filter by countries if service type is `null` (and shipper does not support filter by both)  ([#12](https://github.com/inspirum/balikobot-php/issues/12))
  - Add [**Shipper**](./src/Definitions/Shipper.php) `hasBranchCountryFilterSupport()` #2 **serviceCode** optional parameter


## [v5.3.0 (2021-06-21)](https://github.com/inspirum/balikobot-php/compare/v5.2.0...v5.3.0)
### Added
- Added support for new options from documentation **v1.924** (2021-06-18)
  - Add **DSV** shipper
- Added support for new options from documentation **v1.921** (2021-06-03)
  - Added **content_issue_date** attribute
  - Added **content_invoice_number** attribute
  - Added **content_ead** attribute
  - Added **content_mrn** attribute
  - Added **ead_pdf** attribute
- Added support for new options from documentation **v1.919** (2021-05-11)
  - Add **SPRING** shipper


## [v5.2.0 (2021-05-01)](https://github.com/inspirum/balikobot-php/compare/v5.1.0...v5.2.0)
### Added
- Added [**Status**](./src/Definitions/Status.php) constants
- Added support for new options from documentation **v1.918** (2021-04-29)
  - Add **RABEN** shipper
- Added support for new options from documentation **v1.915** (2021-04-19)
  - Add **DHLPARCEL** shipper
- Added support for new options from documentation **v1.914** (2021-04-19)
  - Add **DACHSER** shipper
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
- Deprecated some **GEIS_\_&ast;** service type constants


## [v5.0.0 (2021-02-01)](https://github.com/inspirum/balikobot-php/compare/v4.5.0...v5.0.0)
> This release (^5.0) uses new refactored **API v2**
### Added
- Added request/response format from [APIv2 documentation](https://balikobotv2.docs.apiary.io/#introduction/rozdil-api-v2-vs-api-v1)
- Added [**Branch**](./src/Model/Values/Branch.php) #4 **uid** parameter to constructor
### Changed
- Update default API URL to `API::V2V1` (**apiv2.balikobot.cz**)
### Fixed
- Fixed [**Country**](./src/Model/Values/Country.php) #4 **phonePrefix** parameter to `array` type
- Fixed [**OrderedPackage**](./src/Model/Values/OrderedPackage.php) #1 **packageId** parameter to `string` type
- Fixed [**Client**](./src/Services/Client.php) `getOrder()` method #2 **orderId** parameter from `int` to `string` type
### Removed
- Removed parameter #3 **version** from [**Client**](./src/Services/Client.php) `addPackages()` method
- Removed parameter #2 **country** from [**Client**](./src/Services/Client.php) `getServices()` method
- Removed parameter #3 **version** from [**Client**](./src/Services/Client.php) `getServices()` method
- Removed parameter #5 **version** from [**Client**](./src/Services/Client.php) `getBranches()` method
- Removed [**Shipper**](./src/Model/Values/Shipper.php) `resolveAddRequestVersion()` method
- Removed [**Shipper**](./src/Model/Values/Shipper.php) `resolveServicesRequestVersion()` method
- Removed [**Shipper**](./src/Model/Values/Shipper.php) `resolveBranchesRequestVersion()` method
- Removed parameter #2 **country** from [**Balikobot**](./src/Services/Balikobot.php) `getServices()` method
- Removed **ZASILKOVNA\_&ast;** service type constants


## [v4.5.0 (2021-02-01)](https://github.com/inspirum/balikobot-php/compare/v4.4.0...v4.5.0)
### Added
- Added error messages from package data validation to exception message as newlines (inspired by [#7](https://github.com/inspirum/balikobot-php/pull/7))


## [v4.4.0 (2021-01-22)](https://github.com/inspirum/balikobot-php/compare/v4.3.0...v4.4.0)
### Added
- Added support for new options from documentation **v1.901** (2021-01-18)
  - Add **GEIS_PARCEL_HD_STANDARD** service type
  - Add **GEIS_PARCEL_HD_PREMIUM** service type
- Added **max_weight** to branches


## [v4.3.0 (2020-12-30)](https://github.com/inspirum/balikobot-php/compare/v4.2.0...v4.3.0)
### Added
- Added support for new options from documentation **v1.896** (2020-11-18)
  - Add **PACKAGE** request filtered by **carrier_id**
- Added support for new options from documentation **v1.897** (2020-11-30)
  - Add **FOFR** shipper
- Added support for new options from documentation **v1.898** (2020-12-01)
  - Added **CHANGELOG** request


## [v4.2.0 (2020-11-10)](https://github.com/inspirum/balikobot-php/compare/v4.1.0...v4.2.0)
### Added
- Added support for new options from documentation **v1.897** (2020-11-30)
    - Add **FEDEX** shipper
- Added multiple **ZASILKOVNA\_&ast;** service types


## [v4.1.0 (2020-10-29)](https://github.com/inspirum/balikobot-php/compare/v4.0.0...v4.1.0)
### Added
- Added support for new options from documentation **v1.894** (2020-10-20)
    - Add **DHLDE** shipper
- Added support for new options from documentation **v1.895** (2020-10-29)
    - Add **PBH_123_KURIER** service type


## [v4.0.0 (2020-09-21)](https://github.com/inspirum/balikobot-php/compare/v3.3.0...v4.0.0)
### Added
- Added support for new options from documentation **v1.892** (2020-09-14)
    - Added **GETCOUNTRIESDATA** request
- Added support for new options from documentation **v1.893** (2020-09-17)
    - Add **TRACK** **v3** request
    - Add **TRACK_STATUS** **v2** request
- Added optional **fullData** parameter for **ADDRUNIT**, **MANIPULATIONUNITS**, **ACTIVATEDMANIPULATIONUNITS** methods
### Changed
- Update [**PackageStatus**](./src/Model/Values/PackageStatus.php) to support data from **TRACK** **v3**
    - Method **getId** return `float` instead of `int` (attribute **status_id_v2**)
    - Method **getName** return new internal status name (attribute **name_balikobot**)
    - Add method **getGroupId** (attribute **status_id**)
    - Add method **getDescription** (attribute **name**)
    - Add method **getType** (attribute **type**)
- Rename [**Package**](./src/Model/Values/Package.php) method **setHeigth** to **setHeight**
### Removed
- Removed **ZASILKOVNA\_&ast;** service type constants
- Removed **TOP_TRANS\_&ast;** service type constants
- Removed **ACTIVATEDSERVICES** request constant


## [v3.3.0 (2020-09-10)](https://github.com/inspirum/balikobot-php/compare/v3.2.2...v3.3.0)
### Added
- Added support for new options from documentation **v1.889** (2020-07-22)
    - Add **CP_OLZ** service type
- Added support for new options from documentation **v1.890** (2020-08-26)
    - Add **PBH_ACS** service type
    - Add **PBH_CORREOS** service type
- Added multiple **ZASILKOVNA\_&ast;** service types
### Changed
- Normalize service type constants, change to **ZASILKOVNA\_&ast;\_HD**, **ZASILKOVNA\_&ast;\_PP**, **ZASILKOVNA\_&ast;\_BOX**
### Deprecated
- Deprecated multiple **ZASILKOVNA\_&ast;** service type constants


## [v3.2.2 (2020-07-18)](https://github.com/inspirum/balikobot-php/compare/v3.2.1...v3.2.2)
### Changed
- Normalize service type constants, change **TOP_TRANS\_&ast;** to **TOPTRANS\_&ast;**
### Deprecated
- Deprecated **TOP_TRANS\_&ast;** service type constants


## [v3.2.1 (2020-07-15)](https://github.com/inspirum/balikobot-php/compare/v3.2.0...v3.2.1)
### Fixes
- Fixed branch street house/orientation number for **CP** shipper


## [v3.2.0 (2020-06-07)](https://github.com/inspirum/balikobot-php/compare/v3.1.0...v3.2.0)
### Added
- Added support for new options from documentation **v1.886** (2020-05-29)
    - Added **TRANSPORTCOSTS** request
- Added support for new options from documentation **v1.887** (2020-06-09)
    - Add **MESSENGER** (Messenger) shipper


## [v3.1.0 (2020-05-30)](https://github.com/inspirum/balikobot-php/compare/v3.0.0...v3.1.0)
### Added
- Added support for new options from documentation **v1.885** (2020-05-14)
    - Add **PBH_ECONT** service type
- Added support for new options from documentation **v1.884** (2020-05-07)
    - Added **ACTIVATEDMANIPULATIONUNITS** request
- Added **ZASILKOVNA_DE_HERMES_HOME** service type 
- Added **ZASILKOVNA_DE_HERMES_PICKUP** service type 
- Added **ZASILKOVNA_LT_HOME** service type 
### Changed
- Normalize request constants, change **ACTIVATEDSERVICES** to **ACTIVATED_SERVICES**
### Fixed
- Fixed bug that API returns only last package statuses for GLS shipper ([#3](https://github.com/inspirum/balikobot-php/issues/3))
### Deprecated
- Deprecated **ACTIVATEDSERVICES** request constant


## [v3.0.0 (2020-05-09)](https://github.com/inspirum/balikobot-php/compare/v2.0.1...v3.0.0)
### Added
- Added support for new options from documentation **v1.882** (2020-04-15)
    - Add **ADD** **v2** request for **TOPTRANS** shipper
- Added support for new options from documentation **v1.881** (2020-04-09)
    - Added **country** parameter to **SERVICES** **v2** request
    - Added **ADD** **v2** request for **ZASILKOVNA** shipper
    - Added **BRANCHES** **v2** request for **ZASILKOVNA** shipper
    - Added **SERVICES** **v2** request for **ZASILKOVNA** shipper
    - Added **ZASILKOVNA** services type
    - Added **full_age_minimum** attribute
### Changed
- Normalized shipper constants, change **TOP_TRANS** to **TOPTRANS**


## [v2.0.1 (2020-03-24)](https://github.com/inspirum/balikobot-php/compare/v2.0.0...v2.0.1)
### Fixed
- Set branch country to **CZ** if missing (for **CP** shipper with **NP** service)


## [v2.0.0 (2020-03-15)](https://github.com/inspirum/balikobot-php/compare/v1.4.0...v2.0.0)
### Added
- Added options to get **labelsUrL** from **ADD** request
- Added **labelsUrL** attribute to [**OrderedPackageCollection**](./src/Model/Aggregates/OrderedPackageCollection.php)
- [**PackageCollection**](./src/Model/Aggregates/PackageCollection.php) implements **\ArrayAccess** interface
### Changed
- Support multiple **EID** in [**PackageCollection**](./src/Model/Aggregates/PackageCollection.php)
### Removed
- Deprecated **date** and **note** parameters from **ORDER** request
- Removed **DHLSK** shipper support


## [v1.4.0 (2020-03-15)](https://github.com/inspirum/balikobot-php/compare/v1.3.2...v1.4.0)
### Added
- Added support for new options from documentation **v1.879** (2020-03-13)
    - Add **GWCZ** (Gebrüder Weiss Česká republika) shipper
- Added support for new options from documentation **v1.878** (2020-01-30)
    - Added **B2A/SERVICES** request
### Fixed
- Fixed bug with bad formatted latitude/longitude in branch import
### Deprecated
- Deprecated **date** and **note** parameters from **ORDER** request
- Deprecated **DHLSK** shipper support


## [v1.3.2 (2020-01-06)](https://github.com/inspirum/balikobot-php/compare/v1.3.1...v1.3.2)
### Fixed
- Fixed bug with empty string in latitude/longitude in branch import


## [v1.3.1 (2019-11-18)](https://github.com/inspirum/balikobot-php/compare/v1.3.0...v1.3.1)
### Added
- Added helper method for information if shipper support filtering branches by country code
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
    - Added **ADD** **v2** request for **DHL** shipper
    - Added **ADD** **v2** request for **TNT** shipper
    - Added **bank_code** attribute
- Added support for new options from documentation **v1.872** (2019-10-24)
    - Add **ADD** **v2** request for **UPS** shipper
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
    - Added **GW** (Gebrüder Weiss) shipper
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
- Add support for new options from documentation **v1.861** (2019-05-28)
    - Add **ACTIVATEDSERVICES** request
- Add support for new options from documentation **v1.859** (2019-05-07)
    - Add **SPS_INTERNATIONAL** service type (Export (mezinárodní zásilky))
### Fixed
- Fixed bug that **TRACK** request does not require **status** attribute in response data


## [v1.1.1 (2019-05-01)](https://github.com/inspirum/balikobot-php/compare/v1.1.0...v1.1.1)
### Added
- Added support for new options from documentation **v1.857** (2019-04-26)
    - Add **delivery_costs** attribute
    - Add **delivery_costs_eur** attribute
- Added support for new options from documentation **v1.856** (2019-04-10)
    - Added **SPS** (Slovak Parcel Service) shipper
    - Added **ULOZENKA_EXPRESS_COURRIER** service type (Expres Kurýr SK for Ulozenka)
    - Added **ULOZENKA_EXPRESS_SK** service type (Expres na poštu SK for Ulozenka)
    - Added **ULOZENKA_BALIKOBOX_SK** service type (BalíkoBOX SK for Ulozenka)
    - Added **ULOZENKA_DEPO_SK** service type (Depo SK for Ulozenka)


## [v1.1.0 (2019-03-23)](https://github.com/inspirum/balikobot-php/compare/v1.0.4...v1.1.0)
### Added
- Added support for new options from documentation **v1.855** (2019-03-19)
    - Added **DHLSK** shipper
- Added support for new options from documentation **v1.854** (2019-03-13)
    - Added **COD4SERVICES** request
- Added support for new options from documentation **v1.853** (2019-02-28)
    - Added **BRANCHLOCATOR** request
- Added support for new options from documentation **v1.852** (2019-02-26)
    - Added **TNT** shipper
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
