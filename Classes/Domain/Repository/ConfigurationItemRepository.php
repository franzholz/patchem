<?php
namespace Bugfix\Patchem\Domain\Repository;


/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * A repository for extension configuration items
 */
class ConfigurationItemRepository extends \TYPO3\CMS\Extensionmanager\Domain\Repository\ConfigurationItemRepository
{

    /**
     * Builds a configuration array from each line (option) of the config file
     *
     * @param string $configurationOption config file line representing one setting
     * @param string $extensionKey Extension key
     * @return array
     */
    protected function buildConfigurationArray($configurationOption, $extensionKey)
    {
        $hierarchicConfiguration = [];
        if (GeneralUtility::isFirstPartOfStr($configurationOption['type'], 'user')) {
            $configurationOption = $this->extractInformationForConfigFieldsOfTypeUser($configurationOption);
        } elseif (GeneralUtility::isFirstPartOfStr($configurationOption['type'], 'options')) {
            $configurationOption = $this->extractInformationForConfigFieldsOfTypeOptions($configurationOption);
        }

        if ($this->translate($configurationOption['label'], $extensionKey)) {
            $configurationOption['label'] = $this->translate($configurationOption['label'], $extensionKey);
        }
    // new begin
            // Call processing function for the labels
        if (is_array($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['patchem']['configurationItemLabel'])) {
            $_params =
                array(
                    'configurationOption' => $configurationOption,
                    'extensionKey' => $extensionKey
                );

            foreach($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['patchem']['configurationItemLabel'] as $classRef) {
                $hookObject= GeneralUtility::makeInstance($classRef);
                if (
                    is_object($hookObject) &&
                    method_exists($hookObject, 'buildConfigurationArray')
                ) {
                    $hookObject->buildConfigurationArray($_params, $this);
                }
            }
            $configurationOption = $_params['configurationOption'];
        }
    // new end

        $configurationOption['labels'] = GeneralUtility::trimExplode(':', $configurationOption['label'], false, 2);
        $configurationOption['subcat_name'] = $configurationOption['subcat_name'] ?: '__default';
        $hierarchicConfiguration[$configurationOption['cat']][$configurationOption['subcat_name']][$configurationOption['name']] = $configurationOption;
        return $hierarchicConfiguration;
    }
}
