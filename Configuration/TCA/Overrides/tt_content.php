<?php declare(strict_types=1);

/*
 * This file is part of the package ucph_content_audio.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * Sept. 2023, University of Copenhagen.
 */

defined('TYPO3') or die();

call_user_func(function ($extKey ='ucph_content_audio', $contentType ='ucph_content_audio') {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:' . $extKey . '/Resources/Private/Language/locallang_be.xlf:ucph_content_audio_title',
            $contentType,
            // icon identifier
            'ucph_content_audio_icon',
        ],
        'textmedia',
        'after'
    );

    // Assign Icon
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$contentType] = 'ucph_content_audio_icon';

    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentType] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$contentType] = [];
    }

    // Configure the default backend fields for the content element
    $GLOBALS['TCA']['tt_content']['types'][$contentType] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types'][$contentType],
        [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                    assets,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                    rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
            'columnsOverrides' => [
                'assets' => [
                    'config' => [
                        'minitems' => 1,
                        'appearance' => [
                            'elementBrowserType' => 'file',
                            'elementBrowserAllowed' => 'mp3'
                        ],
                        'filter' => [
                            0 => [
                                'parameters' => [
                                    'allowedFileExtensions' => 'mp3',
                                ],
                            ],
                        ],
                        'overrideChildTca' => [
                            'columns' => [
                                'uid_local' => [
                                    'config' => [
                                        'appearance' => [
                                            'elementBrowserAllowed' => 'mp3',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]
    );
});
