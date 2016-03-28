-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2016 at 07:32 PM
-- Server version: 5.5.41
-- PHP Version: 5.4.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
  (1, 456);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Quotes`
--

INSERT INTO `Quotes` (`id`, `username`, `clientName`, `startDate`, `completionDate`, `servicesHourlyRate`, `environmentTotalPlatformInstallHours`, `environmentOrganizationConfigurationHours`, `environmentConnectedSystemDefinitionsHours`, `environmentDocumentConfigurationsHours`, `environmentProjectManagementHours`, `totalEnvironmentHours`, `passwordWorkshopAndDesignDocHours`, `passwordConfigurationHours`, `passwordPostImplementationServicesHours`, `passwordProductionMigrationHours`, `passwordUiTrainingHours`, `passwordSolutionDocumentationHours`, `passwordProjectManagementHours`, `totalPasswordHours`, `provisioningWorkshopAndDesignDocHours`, `provisioningConfiguration`, `provisioningPostImplementationServicesHours`, `provisioningProductionMigrationHours`, `provisioningUiTrainingHours`, `provisioningSolutionDocumentationHours`, `provisioningProjectManagementHours`, `totalProvisioningHours`, `HPAMWorkshopAndDesignDocHours`, `HPAMOrgConfigurationHours`, `HPAMPostImplementationServicesHours`, `HPAMProductionMigrationHours`, `HPAMUiTrainingHours`, `HPAMSolutionDocumentationHours`, `HPAMProjectManagementHours`, `totalHPAMHours`, `federationWorkshopAndDesignDocHours`, `federationInstallationHours`, `federationTotalConfigurationHours`, `federationPostImplementationServicesHours`, `federationProductionMigration`, `federationConfigurationOverviewHours`, `federationSolutionDocumentationHours`, `federationProjectManagementHours`, `totalFederationHours`, `administrationBasicTrainingHours`, `administrationAdvancedTrainingTrainingHours`, `administrationKioskTrainingHours`, `administrationPinTrainingTrainingHours`, `administrationHelpDeskTrainingTrainingHours`, `administrationSelectServiceTrainingTrainingHours`, `administrationHPAMUiTrainingHours`, `administrationFederationConfigTrainingHours`, `administrationProjectManagementHours`, `totalAdministrationHours`, `totalAllHours`, `phaseAssessmentDesignHours`, `phaseInstallationHours`, `phaseImplementationHours`, `phaseProjectManagementHours`, `phaseTrainingHours`, `modulesPasswordManagement`, `modulesProvisioning`, `modulesHPAM`, `modulesFederation`) VALUES
  (1, 'test', 'testing', '', '03/25/2016', 125, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO'),
  (2, 'test', 'test', '', '03/26/2016', 125, 73.575, 1.1, 0.825, 1.05, 7.655, 84.205, 4.2, 2.2, 2.2, 1.2, 0, 1.2, 1.1, 12.1, 4.95, 35.383333333333, 4.95, 4.95, 2.2, 4.95, 5.7383333333333, 63.121666666667, 1.65, 0.275, 1.1, 1.1, 1.1, 0.55, 0.605, 6.655, 31.9, 13.2, 40.8, 2.2, 27.5, 2.2, 3.3, 12.11, 133.21, 40, 40, 4, 0, 4, 8, 4, 4, 10.4, 114.4, 413.69166666667, 42.7, 76.55, 140.45833333333, 37.608333333333, 104, 'YES', 'YES', 'YES', 'YES'),
  (3, 'test', '', '', '03/27/2016', 456, 0, 1.1, 0, 0, 0.11, 1.21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4.4, 0, 0, 0, 0, 0.44, 4.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6.05, 0, 1.1, 4.4, 0.55, 0, 'NO', 'NO', 'NO', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `admin` varchar(5) NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pass`, `admin`) VALUES
  ('test', 'test', 'true'),
  ('test1', 'test1', 'false'),
  ('test10', 'test10', 'false'),
  ('test2', 'test2', 'false'),
  ('test3', 'test3', 'false'),
  ('test4', 'test4', 'false'),
  ('test5', 'test5', 'false'),
  ('test6', 'test6', 'false'),
  ('test7', 'test7', 'false'),
  ('test8', 'test8', 'false'),
  ('test9', 'test9', 'false');

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
ADD PRIMARY KEY (`id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
