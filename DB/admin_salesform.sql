-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2016 at 07:44 PM
-- Server version: 5.5.48
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_salesform`
--

-- --------------------------------------------------------

--
-- Table structure for table `Pricing`
--

CREATE TABLE IF NOT EXISTS `Pricing` (
  `id` int(11) NOT NULL DEFAULT '1',
  `servicesHourlyRate` double NOT NULL DEFAULT '125'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Pricing`
--

INSERT INTO `Pricing` (`id`, `servicesHourlyRate`) VALUES
  (1, 524.5);

-- --------------------------------------------------------

--
-- Table structure for table `Quotes`
--

CREATE TABLE IF NOT EXISTS `Quotes` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `clientName` varchar(255) DEFAULT NULL,
  `startDate` varchar(255) DEFAULT NULL,
  `completionDate` varchar(255) DEFAULT NULL,
  `servicesHourlyRate` double DEFAULT NULL,
  `environmentTotalPlatformInstallHours` double DEFAULT NULL,
  `environmentOrganizationConfigurationHours` double DEFAULT NULL,
  `environmentConnectedSystemDefinitionsHours` double DEFAULT NULL,
  `environmentDocumentConfigurationsHours` double DEFAULT NULL,
  `environmentProjectManagementHours` double DEFAULT NULL,
  `totalEnvironmentHours` double DEFAULT NULL,
  `passwordWorkshopAndDesignDocHours` double DEFAULT NULL,
  `passwordConfigurationHours` double DEFAULT NULL,
  `passwordPostImplementationServicesHours` double DEFAULT NULL,
  `passwordProductionMigrationHours` double DEFAULT NULL,
  `passwordUiTrainingHours` double DEFAULT NULL,
  `passwordSolutionDocumentationHours` double DEFAULT NULL,
  `passwordProjectManagementHours` double DEFAULT NULL,
  `totalPasswordHours` double DEFAULT NULL,
  `provisioningWorkshopAndDesignDocHours` double DEFAULT NULL,
  `provisioningConfiguration` double DEFAULT NULL,
  `provisioningPostImplementationServicesHours` double DEFAULT NULL,
  `provisioningProductionMigrationHours` double DEFAULT NULL,
  `provisioningUiTrainingHours` double DEFAULT NULL,
  `provisioningSolutionDocumentationHours` double DEFAULT NULL,
  `provisioningProjectManagementHours` double DEFAULT NULL,
  `totalProvisioningHours` double DEFAULT NULL,
  `HPAMWorkshopAndDesignDocHours` double DEFAULT NULL,
  `HPAMOrgConfigurationHours` double DEFAULT NULL,
  `HPAMPostImplementationServicesHours` double DEFAULT NULL,
  `HPAMProductionMigrationHours` double DEFAULT NULL,
  `HPAMUiTrainingHours` double DEFAULT NULL,
  `HPAMSolutionDocumentationHours` double DEFAULT NULL,
  `HPAMProjectManagementHours` double DEFAULT NULL,
  `totalHPAMHours` double DEFAULT NULL,
  `federationWorkshopAndDesignDocHours` double DEFAULT NULL,
  `federationInstallationHours` double DEFAULT NULL,
  `federationTotalConfigurationHours` double DEFAULT NULL,
  `federationPostImplementationServicesHours` double DEFAULT NULL,
  `federationProductionMigration` double DEFAULT NULL,
  `federationConfigurationOverviewHours` double DEFAULT NULL,
  `federationSolutionDocumentationHours` double DEFAULT NULL,
  `federationProjectManagementHours` double DEFAULT NULL,
  `totalFederationHours` double DEFAULT NULL,
  `administrationBasicTrainingHours` double DEFAULT NULL,
  `administrationAdvancedTrainingTrainingHours` double DEFAULT NULL,
  `administrationKioskTrainingHours` double DEFAULT NULL,
  `administrationPinTrainingTrainingHours` double DEFAULT NULL,
  `administrationHelpDeskTrainingTrainingHours` double DEFAULT NULL,
  `administrationSelectServiceTrainingTrainingHours` double DEFAULT NULL,
  `administrationHPAMUiTrainingHours` double DEFAULT NULL,
  `administrationFederationConfigTrainingHours` double DEFAULT NULL,
  `administrationProjectManagementHours` double DEFAULT NULL,
  `totalAdministrationHours` double DEFAULT NULL,
  `totalAllHours` double DEFAULT NULL,
  `phaseAssessmentDesignHours` double DEFAULT NULL,
  `phaseInstallationHours` double DEFAULT NULL,
  `phaseImplementationHours` double DEFAULT NULL,
  `phaseProjectManagementHours` double DEFAULT NULL,
  `phaseTrainingHours` double DEFAULT NULL,
  `modulesPasswordManagement` varchar(3) DEFAULT NULL,
  `modulesProvisioning` varchar(3) DEFAULT NULL,
  `modulesHPAM` varchar(3) DEFAULT NULL,
  `modulesFederation` varchar(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Quotes`
--

INSERT INTO `Quotes` (`id`, `username`, `clientName`, `startDate`, `completionDate`, `servicesHourlyRate`, `environmentTotalPlatformInstallHours`, `environmentOrganizationConfigurationHours`, `environmentConnectedSystemDefinitionsHours`, `environmentDocumentConfigurationsHours`, `environmentProjectManagementHours`, `totalEnvironmentHours`, `passwordWorkshopAndDesignDocHours`, `passwordConfigurationHours`, `passwordPostImplementationServicesHours`, `passwordProductionMigrationHours`, `passwordUiTrainingHours`, `passwordSolutionDocumentationHours`, `passwordProjectManagementHours`, `totalPasswordHours`, `provisioningWorkshopAndDesignDocHours`, `provisioningConfiguration`, `provisioningPostImplementationServicesHours`, `provisioningProductionMigrationHours`, `provisioningUiTrainingHours`, `provisioningSolutionDocumentationHours`, `provisioningProjectManagementHours`, `totalProvisioningHours`, `HPAMWorkshopAndDesignDocHours`, `HPAMOrgConfigurationHours`, `HPAMPostImplementationServicesHours`, `HPAMProductionMigrationHours`, `HPAMUiTrainingHours`, `HPAMSolutionDocumentationHours`, `HPAMProjectManagementHours`, `totalHPAMHours`, `federationWorkshopAndDesignDocHours`, `federationInstallationHours`, `federationTotalConfigurationHours`, `federationPostImplementationServicesHours`, `federationProductionMigration`, `federationConfigurationOverviewHours`, `federationSolutionDocumentationHours`, `federationProjectManagementHours`, `totalFederationHours`, `administrationBasicTrainingHours`, `administrationAdvancedTrainingTrainingHours`, `administrationKioskTrainingHours`, `administrationPinTrainingTrainingHours`, `administrationHelpDeskTrainingTrainingHours`, `administrationSelectServiceTrainingTrainingHours`, `administrationHPAMUiTrainingHours`, `administrationFederationConfigTrainingHours`, `administrationProjectManagementHours`, `totalAdministrationHours`, `totalAllHours`, `phaseAssessmentDesignHours`, `phaseInstallationHours`, `phaseImplementationHours`, `phaseProjectManagementHours`, `phaseTrainingHours`, `modulesPasswordManagement`, `modulesProvisioning`, `modulesHPAM`, `modulesFederation`) VALUES
  (1, 'test', 'testing', '', '03/25/2016', 125, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (2, 'test', 'test', '', '03/26/2016', 125, 73.575, 1.1, 0.825, 1.05, 7.655, 84.205, 4.2, 2.2, 2.2, 1.2, 0, 1.2, 1.1, 12.1, 4.95, 35.383333333333, 4.95, 4.95, 2.2, 4.95, 5.7383333333333, 63.121666666667, 1.65, 0.275, 1.1, 1.1, 1.1, 0.55, 0.605, 6.655, 31.9, 13.2, 40.8, 2.2, 27.5, 2.2, 3.3, 12.11, 133.21, 40, 40, 4, 0, 4, 8, 4, 4, 10.4, 114.4, 413.69166666667, 42.7, 76.55, 140.45833333333, 37.608333333333, 104, 'YES', 'YES', 'YES', 'YES'),
  (3, 'test', '', '', '03/27/2016', 456, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (4, 'test', '', '', '03/28/2016', 456, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (5, 'test', 'testing_from_site', '', '03/28/2016', 456, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0, 0, 0, 0, 0.4, 4.4, 10.45, 0, 1.1, 4.4, 0.95, 4, 'NO', 'NO', 'NO', 'NO'),
  (6, 'test', 'test_refactor', '', '03/28/2016', 515.25, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (7, 'test', 'test for brandon', '', '03/28/2016', 515.25, 0, 1.1, 0.825, 0, 0.1925, 2.1175, 4.2, 2.2, 2.2, 1.2, 0, 1.2, 1.1, 12.1, 4.95, 35.383333333333, 4.95, 4.95, 2.2, 4.95, 5.7383333333333, 63.121666666667, 0.55, 0.275, 1.1, 1.1, 0, 0.55, 0.385, 4.235, 29.7, 8.8, 40.8, 1.1, 26.4, 2.2, 2.2, 11.12, 122.32, 0, 0, 4, 0, 4, 8, 0, 0, 1.6, 17.6, 221.49416666667, 39.4, 1.925, 136.05833333333, 20.135833333333, 16, 'YES', 'YES', 'YES', 'YES'),
  (8, 'test', 'testing_quotes', '', '03/28/2016', 524.5, 72.2, 1.1, 0.825, 1.05, 7.5175, 82.6925, 4.2, 2.2, 2.2, 1.2, 0, 1.2, 1.1, 12.1, 25.3, 99.183333333333, 25.3, 25.3, 2.2, 25.3, 20.258333333333, 222.84166666667, 1.65, 0.275, 1.1, 1.1, 1.1, 0.55, 0.605, 6.655, 31.9, 13.2, 40.8, 2.2, 27.5, 2.2, 3.3, 12.11, 133.21, 40, 40, 4, 4, 4, 8, 4, 0, 10.4, 114.4, 571.89916666667, 63.05, 75.175, 265.30833333333, 51.990833333333, 104, 'YES', 'YES', 'YES', 'YES'),
  (9, 'test', '', '', '03/30/2016', 524.5, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (10, 'test', 'demo client', '04/01/2016', '03/31/2016', 524.5, 72.2, 1.1, 0.825, 1.05, 7.5175, 82.6925, 4.2, 2.2, 2.2, 1.2, 0, 1.2, 1.1, 12.1, 4.95, 35.383333333333, 4.95, 4.95, 2.2, 4.95, 5.7383333333333, 63.121666666667, 1.65, 0.275, 1.1, 1.1, 1.1, 0.55, 0.605, 6.655, 42.9, 13.2, 62.8, 2.2, 33, 2.2, 3.3, 15.96, 175.56, 40, 40, 4, 4, 4, 8, 4, 4, 10.8, 118.8, 458.92916666667, 53.7, 75.175, 167.95833333333, 41.720833333333, 108, 'YES', 'YES', 'YES', 'YES'),
  (11, 'test323', 'test for test323', '', '04/06/2016', 524.5, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (12, 'test', 'Beauty Products MegaCo', '', '04/06/2016', 524.5, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (13, 'test', '', '', '04/07/2016', 524.5, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (14, 'test', '', '', '04/08/2016', 524.5, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `admin` varchar(5) NOT NULL DEFAULT 'false',
  `enabled` varchar(5) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `admin`, `enabled`) VALUES
  ('test', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', 'true', 'true'),
  ('test1', 'test1', 'false', 'true'),
  ('test10', '763d665f054d187c0ecdeaae277cdcfefd986378befb18b5f232997a3c4c802ed317ee64e7bb91ff5be50f09e4cbd11176488a4982de05bf075b02c84385a525', 'false', 'true'),
  ('test2', 'test2', 'false', 'true'),
  ('test3', 'cb872de2b8d2509c54344435ce9cb43b4faa27f97d486ff4de35af03e4919fb4ec53267caf8def06ef177d69fe0abab3c12fbdc2f267d895fd07c36a62bff4bf', 'false', 'true'),
  ('test32', 'bbddbc4b70f59e9b04713a5f356c68bb48d4677ba6f9e3497735a49d7f7121770b654999fa30f37a87d2677c4d4b90aea78ad9e4df6553e5d8e99968e69f45d6', 'false', 'true'),
  ('test323', '42b9583283ff3f5dee167c5f8787a85489e09632627ddb27a64bae96fb6b95679946b04eea7943faa618b1baea254dbbd22d085a4084f18ee018a2bb64b2fbcd', 'false', 'true'),
  ('test4', 'test4', 'false', 'true'),
  ('test5', '64c26ffe3b35c65dfb93a8fd9a91828c57ed76d3809d06b03e17128125b48e5d01b37bb605a0a0305eff8341fbd56096664597f5cd091bf036e4ca31b304a9cc', 'true', 'true'),
  ('test555', '441d8cf74d07b51fa51637af4e01c02dc4c639e3e75a99f31632d7cd7aab6290496e49f9bb99a9dc010245e839fb1c9c0d02ac904e4378f6edb261a74a9ded81', 'true', 'true'),
  ('test6', 'test6', 'false', 'true'),
  ('test7', 'test7', 'false', 'true'),
  ('test8', 'test8', 'false', 'true'),
  ('test9', '0b3d1be846a4812b7043157e6e95d720341bff4dc1e437dd26ba96cec8735c9c74ebcf770cb0fe45dd3e4d04cd59b026240d540db03abf10b1f6e2f4dafcadce', 'false', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Pricing`
--
ALTER TABLE `Pricing`
ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Quotes`
--
ALTER TABLE `Quotes`
ADD PRIMARY KEY (`id`),
ADD KEY `clientName` (`id`,`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Quotes`
--
ALTER TABLE `Quotes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
