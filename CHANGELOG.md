# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).


## [1.3.2] - 2020-01-06
### Fixed
- Fix bug with empty string in latitude/longitude in branch import


## [1.3.1] - 2019-11-18
### Added
- Add helper method for information if shipper support filtering branches by country code
### Fixed
- Fix branch filtering by country code(s)
### Removed
- Remove **country** parameter from method that list branches


## [1.3.0] - 2019-11-17
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


## [1.2.0] - 2019-09-07
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


## [1.1.2] - 2019-06-24
### Added
- Add support for new options from documentation **v1.861** (2019-05-28)
    - Add **ACTIVATEDSERVICES** request
- Add support for new options from documentation **v1.859** (2019-05-07)
    - Add **SPS_INTERNATIONAL** service type (Export (mezinárodní zásilky))
### Fixed
- Fix bug: "track" request does not require "status" in response data


## [1.1.1] - 2019-05-01
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


## [1.1.0] - 2019-03-23
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


## [1.0.4] - 2019-01-09
### Added
- Add support for new options from documentation **v1.846** (2019-01-08)
    - Add **rec_house_number** attribute
    - Add **rec_block** attribute
    - Add **rec_enterance** attribute
    - Add **rec_floor** attribute
    - Add **rec_flat_number** attribute  
### Changed
- Move repo to [**@inspirum**](https://github.com/inspirum) account


## [1.0.3] - 2019-01-02
### Fixed
- Fix links url


## [1.0.2] - 2019-01-02
### Changed
- Change composer package name to `inspirum/balikobot`


## [1.0.1] - 2018-12-30
### Fixed
- Fixed tests


## [1.0.0] - 2018-12-27
### Added
- Full support for all requests and options in documentation **v1.845** (2018-11-29)
