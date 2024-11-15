-- Step 01
-- **************************************************************
-- Doel : Maak een nieuwe database voor het opslaan van achtbanen
-- **************************************************************
-- Versie   Datum       Auteur              Omschrijving
-- ******   *****       ******              ************
-- 01       14-11-2024  Arjan de Ruijter    Achtbanen van Europa
-- **************************************************************

-- Verwijder database Achtbaan-2408a
DROP DATABASE IF EXISTS `Achtbaan-2408a`;

-- Maak een nieuwe database aan Achtbaan-2408a
CREATE DATABASE `Achtbaan-2408a`;

-- Gebruik de database Achtbaan-2408a
USE `Achtbaan-2408a`;

-- Step 02
-- **************************************************************
-- Doel : Maak een nieuwe tabel voor het opslaan van achtbanen
-- **************************************************************
-- Versie   Datum       Auteur              Omschrijving
-- ******   *****       ******              ************
-- 01       14-11-2024  Arjan de Ruijter    Tabel Achtbanen van
--                                          Europa
-- **************************************************************

CREATE TABLE AchtbanenVanEuropa
(
     Id              SMALLINT            UNSIGNED        NOT NULL    AUTO_INCREMENT
    ,Naam            VARCHAR(40)                         NOT NULL
    ,NaamPretpark    VARCHAR(40)                         NOT NULL
    ,Land            VARCHAR(60)                         NOT NULL
    ,Topsnelheid     TINYINT             UNSIGNED        NOT NULL
    ,Hoogte          TINYINT             UNSIGNED        NOT NULL
    ,IsActief        BIT                                 NOT NULL    DEFAULT 1
    ,Opmerking       VARCHAR(255)                            NULL    DEFAULT NULL
    ,DatumAangemaakt DATETIME(6)                         NOT NULL
    ,DatumGewijzigd  DATETIME(6)                         NOT NULL
    ,CONSTRAINT      PK_AchtbanenVanEuropa_Id            PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;

-- Step 03
-- **************************************************************
-- Doel : Vul de tabel AchtbanenVanEuropa met gegevens
-- **************************************************************
-- Versie   Datum       Auteur              Omschrijving
-- ******   *****       ******              ************
-- 01       14-11-2024  Arjan de Ruijter    Vulling Achtbanen van
--                                          Europa
-- **************************************************************

INSERT INTO AchtbanenVanEuropa
(
     Naam
    ,NaamPretpark
    ,Land
    ,Topsnelheid
    ,Hoogte
    ,IsActief
    ,Opmerking
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
  ('Red Force', 'Ferrari Land', 'Spanje', 180, 112, 1, NULL, SYSDATE(6), SYSDATE(6))
 ,('Hyperion', 'Energylandia', 'Polen', 142, 77, 1, NULL, SYSDATE(6), SYSDATE(6));