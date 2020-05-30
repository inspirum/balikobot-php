# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [Unreleased](https://github.com/inspirum/balikobot-php/compare/v3.1.0...master)


## [v3.1.0 (2020-05-30)](https://github.com/inspirum/balikobot-php/compare/v3.0.0...v3.1.0)
### Added
- Add support for new options from documentation **v1.885** (2020-05-14)
    - Add **PBH_ECONT** service type
- Add support for new options from documentation **v1.884** (2020-05-07)
    - Add **ACTIVATEDMANIPULATIONUNITS** request
- Add **ZASILKOVNA_DE_HERMES_HOME** service type 
- Add **ZASILKOVNA_DE_HERMES_PICKUP** service type 
- Add **ZASILKOVNA_LT_HOME** service type 
### Changed
- Normalize request constants, change **ACTIVATEDSERVICES** to **ACTIVATED_SERVICES**
### Deprecated
- Deprecated **ACTIVATEDSERVICES** request constant


## [v3.0.0 (2020-05-09)](https://github.com/inspirum/balikobot-php/compare/v2.0.1...v3.0.0)
### Added
- Add support for new options from documentation **v1.882** (2020-04-15)
    - Add **ADD** **v2** request for **TOPTRANS** shipper
- Add support for new options from documentation **v1.881** (2020-04-09)
    - Add **country** parameter to **SERVICES** **v2** request
    - Add **ADD** **v2** request for **ZASILKOVNA** shipper
    - Add **BRANCHES** **v2** request for **ZASILKOVNA** shipper
    - Add **SERVICES** **v2** request for **ZASILKOVNA** shipper
    - Add **ZASILKOVNA** services type
    - Add **full_age_minimum** attribute
### Changed
- Normalize shipper constants, change **TOP_TRANS** to **TOPTRANS**


## [v2.0.1 (2020-03-24)](https://github.com/inspirum/balikobot-php/compare/v2.0.0...v2.0.1)
### Fixed
- Set branch country to **CZ** if missing (for **CP** shipper with **NP** service)


## [v2.0.0 (2020-03-15)](https://github.com/inspirum/balikobot-php/compare/v1.4.0...v2.0.0)
### Added
- Add options to get **labelsUrL** from **ADD** request
- Add **labelsUrL** attribute to [**OrderedPackageCollection**](./src/Model/Aggregates/OrderedPackageCollection.php)
-  [**PackageCollection**](./src/Model/Aggregates/PackageCollection.php) implements **\ArrayAccess** interface
### Changed
- Support multiple **EID** in [**PackageCollection**](./src/Model/Aggregates/PackageCollection.php)
### Removed
- Deprecated **date** and **note** parameters from **ORDER** request
- Remove **DHLSK** shipper support


## [v1.4.0 (2020-03-15)](https://github.com/inspirum/balikobot-php/compare/v1.3.2...v1.4.0)
### Added
- Add support for new options from documentation **v1.879** (2020-03-13)
    - Add **GWCZ** (Gebrüder Weiss Česká republika) shipper
- Add support for new options from documentation **v1.878** (2020-01-30)
    - Add **B2A/SERVICES** request
### Fixed
- Fix bug with bad formatted latitude/longitude in branch import
### Deprecated
- Deprecated **date** and **note** parameters from **ORDER** request
- Deprecated **DHLSK** shipper support


## [v1.3.2 (2020-01-06)](https://github.com/inspirum/balikobot-php/compare/v1.3.1...v1.3.2)
### Fixed
- Fix bug with empty string in latitude/longitude in branch import


## [v1.3.1 (2019-11-18)](https://github.com/inspirum/balikobot-php/compare/v1.3.0...v1.3.1)
### Added
- Add helper method for information if shipper support filtering branches by country code
### Fixed
- Fix branch filtering by country code(s)
### Removed
- Remove **country** parameter from method that list branches


## [v1.3.0 (2019-11-17)](https://github.com/inspirum/balikobot-php/compare/v1.2.0...v1.3.0)
### Added
- Add methods for track multiple packages
- Add methods to get branches filtered by country codes
- Add support for new options from documentation **v1.873** (2019-11-15)
    - Add **country** parameter to **BRANCHES** request
    - Add **ADD** **v2** request for **DHL** shipper
    - Add **ADD** **v2** request for **TNT** shipper
    - Add **bank_code** attribute
- Add support for new options from documentation **v1.872** (2019-10-24)
    - Add **ADD** **v2** request for **UPS** shipper
- Add support for new options from documentation **v1.872** (2019-10-22)
    - Add **POD** request
    - Add **GLS_GUARANTEED24** service type
    - Add **GLS_GUARANTEED24_EXPRESS** service type
    - Add **GLS_GUARANTEED24_SHOP** service type
    - Add **GW_DOMESTIC** service type
    - Add **GW_EXPORT** service type
    - Add **reference** attribute
    - Add **sm1_service** attribute
    - Add **sm1_text** attribute
    - Add **sm1_text** attribute
    - Add **sm2_service** attribute


## [v1.2.0 (2019-09-07)](https://github.com/inspirum/balikobot-php/compare/v1.1.2...v1.2.0)
### Added
- Add support for new options from documentation **v1.870** (2019-09-05)
    - Add **GW** (Gebrüder Weiss) shipper
- Add support for new options from documentation **v1.869** (2019-08-19)
    - Add **del_exworks_account_number** attribute
    - Add **del_exworks_zip** attribute
- Add support for new options from documentation **v1.867** (2019-07-23)
    - Add **INTIME_PARCEL_EU** service type
    - Add **INTIME_PARCEL_EU_PLUS** service type
    - Add **ins_currency** attribute
- Add support for new options from documentation **v1.866** (2019-07-10)
    - Add **B2A** request
- Add support for new options from documentation **v1.865** (2019-07-01)
    - Add **rec_id** attribute
- Add support for new options from documentation **v1.864** (2019-06-26)
    - Add **type** parameter to **BRANCHLOCATOR** request


## [v1.1.2 (2019-06-24)](https://github.com/inspirum/balikobot-php/compare/v1.1.1...v1.1.2)
### Added
- Add support for new options from documentation **v1.861** (2019-05-28)
    - Add **ACTIVATEDSERVICES** request
- Add support for new options from documentation **v1.859** (2019-05-07)
    - Add **SPS_INTERNATIONAL** service type (Export (mezinárodní zásilky))
### Fixed
- Fix bug: "track" request does not require "status" in response data


## [v1.1.1 (2019-05-01)](https://github.com/inspirum/balikobot-php/compare/v1.1.0...v1.1.1)
### Added
- Add support for new options from documentation **v1.857** (2019-04-26)
    - Add **delivery_costs** attribute
    - Add **delivery_costs_eur** attribute
- Add support for new options from documentation **v1.856** (2019-04-10)
    - Add **SPS** (Slovak Parcel Service) shipper
    - Add **ULOZENKA_EXPRESS_COURRIER** service type (Expres Kurýr SK for Ulozenka)
    - Add **ULOZENKA_EXPRESS_SK** service type (Expres na poštu SK for Ulozenka)
    - Add **ULOZENKA_BALIKOBOX_SK** service type (BalíkoBOX SK for Ulozenka)
    - Add **ULOZENKA_DEPO_SK** service type (Depo SK for Ulozenka)


## [v1.1.0 (2019-03-23)](https://github.com/inspirum/balikobot-php/compare/v1.0.4...v1.1.0)
### Added
- Add support for new options from documentation **v1.855** (2019-03-19)
    - Add **DHLSK** shipper
- Add support for new options from documentation **v1.854** (2019-03-13)
    - Add **COD4SERVICES** request
- Add support for new options from documentation **v1.853** (2019-02-28)
    - Add **BRANCHLOCATOR** request
- Add support for new options from documentation **v1.852** (2019-02-26)
    - Add **TNT** shipper
- Add support for new options from documentation **v1.851** (2019-02-19)
    - Add new definitons for regions
- Add support for new options from documentation **v1.847** (2019-01-22)
    - Add **PBH_NOBA_POSHTA** service type (Nova Poshta (UA) for PbH)
    - Add **rec_name_patronymum** attribute
    - Add **rec_locale_id** attribute


## [v1.0.4 (2019-01-09)](https://github.com/inspirum/balikobot-php/compare/v1.0.3...v1.0.4)
### Added
- Add support for new options from documentation **v1.846** (2019-01-08)
    - Add **rec_house_number** attribute
    - Add **rec_block** attribute
    - Add **rec_enterance** attribute
    - Add **rec_floor** attribute
    - Add **rec_flat_number** attribute  
### Changed
- Move repo to [**@inspirum**](https://github.com/inspirum) account


## [v1.0.3 (2019-01-02)](https://github.com/inspirum/balikobot-php/compare/v1.0.2...v1.0.3)
### Fixed
- Fix links url


## [v1.0.2 (2019-01-02)](https://github.com/inspirum/balikobot-php/compare/v1.0.1...v1.0.2)
### Changed
- Change composer package name to `inspirum/balikobot`


## [v1.0.1 (2018-12-30)](https://github.com/inspirum/balikobot-php/compare/v1.0.0...v1.0.1)
### Fixed
- Fixed tests


## v1.0.0 (2018-12-27)
### Added
- Full support for all requests and options in documentation **v1.845** (2018-11-29)
