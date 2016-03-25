-- phpMyAdmin SQL Dump
-- version 4.3.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2016 at 09:05 PM
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
('test', 'test', 'true');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `admin_salesform`.`Quotes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `clientName` VARCHAR(255) NULL,
  `completionDate` DATE NULL,
  `servicesHourlyRate` DOUBLE NULL,
  `environmentTotalPlatformInstallHours` DOUBLE NULL,
  `environmentOrganizationConfigurationHours` DOUBLE NULL,
  `environmentConnectedSystemDefinitionsHours` DOUBLE NULL,
  `environmentDocumentConfigurationsHours` DOUBLE NULL,
  `environmentProjectManagementHours` DOUBLE NULL,
  `totalEnvironmentHours` DOUBLE NULL,
  `passwordWorkshopAndDesignDocHours` DOUBLE NULL,
  `passwordConfigurationHours` DOUBLE NULL,
  `passwordPostImplementationServicesHours` DOUBLE NULL,
  `passwordProductionMigrationHours` DOUBLE NULL,
  `passwordUiTrainingHours` DOUBLE NULL,
  `passwordSolutionDocumentationHours` DOUBLE NULL,
  `passwordProjectManagementHours` DOUBLE NULL,
  `totalPasswordHours` DOUBLE NULL,
  `provisioningWorkshopAndDesignDocHours` DOUBLE NULL,
  `provisioningConfiguration` DOUBLE NULL,
  `provisioningPostImplementationServicesHours` DOUBLE NULL,
  `provisioningProductionMigrationHours` DOUBLE NULL,
  `provisioningUiTrainingHours` DOUBLE NULL,
  `provisioningSolutionDocumentationHours` DOUBLE NULL,
  `provisioningProjectManagementHours` DOUBLE NULL,
  `totalProvisioningHours` DOUBLE NULL,
  `HPAMWorkshopAndDesignDocHours` DOUBLE NULL,
  `HPAMOrgConfigurationHours` DOUBLE NULL,
  `HPAMPostImplementationServicesHours` DOUBLE NULL,
  `HPAMProductionMigrationHours` DOUBLE NULL,
  `HPAMUiTrainingHours` DOUBLE NULL,
  `HPAMSolutionDocumentationHours` DOUBLE NULL,
  `HPAMProjectManagementHours` DOUBLE NULL,
  `totalHPAMHours` DOUBLE NULL,
  `federationWorkshopAndDesignDocHours` DOUBLE NULL,
  `federationInstallationHours` DOUBLE NULL,
  `federationTotalConfigurationHours` DOUBLE NULL,
  `federationPostImplementationServicesHours` DOUBLE NULL,
  `federationProductionMigration` DOUBLE NULL,
  `federationConfigurationOverviewHours` DOUBLE NULL,
  `federationSolutionDocumentationHours` DOUBLE NULL,
  `federationProjectManagementHours` DOUBLE NULL,
  `totalFederationHours` DOUBLE NULL,
  `administrationBasicTrainingHours` DOUBLE NULL,
  `administrationAdvancedTrainingTrainingHours` DOUBLE NULL,
  `administrationKioskTrainingHours` DOUBLE NULL,
  `administrationPinTrainingTrainingHours` DOUBLE NULL,
  `administrationHelpDeskTrainingTrainingHours` DOUBLE NULL,
  `administrationSelectServiceTrainingTrainingHours` DOUBLE NULL,
  `administrationHPAMUiTrainingHours` DOUBLE NULL,
  `administrationFederationConfigTrainingHours` DOUBLE NULL,
  `administrationProjectManagementHours` DOUBLE NULL,
  `totalAdministrationHours` DOUBLE NULL,
  `totalAllHours` DOUBLE NULL,
  `phaseAssessmentDesignHours` DOUBLE NULL,
  `phaseInstallationHours` DOUBLE NULL,
  `phaseImplementationHours` DOUBLE NULL,
  `phaseProjectManagementHours` DOUBLE NULL,
  `phaseTrainingHours` DOUBLE NULL,
  `modulesPasswordManagement` DOUBLE NULL,
  `modulesProvisioning` DOUBLE NULL,
  `modulesHPAM` DOUBLE NULL,
  `modulesFederation` DOUBLE NULL,
  PRIMARY KEY (`id`));
