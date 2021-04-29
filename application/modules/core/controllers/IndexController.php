<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

/**
 * Class IndexController
 */
class IndexController extends Tiger_Controller_Action
{
    public function init()
    {
        /** Set theme and theme template options. */
        $this->view->theme  = 'oneui';
        $this->view->layout = 'layout';

        /** Set the OneUI base theme options. */
        $contentService = new Core_Service_Content();
        $contentService->setPageContent( $this->view );

        $this->view->template->inc_side_overlay = '';
        $this->view->template->inc_sidebar      = '';
        $this->view->template->inc_header       = '';
        $this->view->template->inc_footer       = '';

    }

    public function indexAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/core.index.js' ) );
    }

    public function testAction ( )
    {

//  https://github.com/umpirsky/country-list
//
//        $countries_fr =  [
//     'AF' => 'Afghanistan',
//     'ZA' => 'Afrique du Sud',
//     'AL' => 'Albanie',
//     'DZ' => 'Algérie',
//     'DE' => 'Allemagne',
//     'AD' => 'Andorre',
//     'AO' => 'Angola',
//     'AI' => 'Anguilla',
//     'AQ' => 'Antarctique',
//     'AG' => 'Antigua-et-Barbuda',
//     'SA' => 'Arabie saoudite',
//     'AR' => 'Argentine',
//     'AM' => 'Arménie',
//     'AW' => 'Aruba',
//     'AU' => 'Australie',
//     'AT' => 'Autriche',
//     'AZ' => 'Azerbaïdjan',
//     'BS' => 'Bahamas',
//     'BH' => 'Bahreïn',
//     'BD' => 'Bangladesh',
//     'BB' => 'Barbade',
//     'BE' => 'Belgique',
//     'BZ' => 'Belize',
//     'BJ' => 'Bénin',
//     'BM' => 'Bermudes',
//     'BT' => 'Bhoutan',
//     'BY' => 'Biélorussie',
//     'BO' => 'Bolivie',
//     'BA' => 'Bosnie-Herzégovine',
//     'BW' => 'Botswana',
//     'BR' => 'Brésil',
//     'BN' => 'Brunéi Darussalam',
//     'BG' => 'Bulgarie',
//     'BF' => 'Burkina Faso',
//     'BI' => 'Burundi',
//     'KH' => 'Cambodge',
//     'CM' => 'Cameroun',
//     'CA' => 'Canada',
//     'CV' => 'Cap-Vert',
//     'CL' => 'Chili',
//     'CN' => 'Chine',
//     'CY' => 'Chypre',
//     'CO' => 'Colombie',
//     'KM' => 'Comores',
//     'CG' => 'Congo-Brazzaville',
//     'CD' => 'Congo-Kinshasa',
//     'KP' => 'Corée du Nord',
//     'KR' => 'Corée du Sud',
//     'CR' => 'Costa Rica',
//     'CI' => 'Côte d’Ivoire',
//     'HR' => 'Croatie',
//     'CU' => 'Cuba',
//     'CW' => 'Curaçao',
//     'DK' => 'Danemark',
//     'DJ' => 'Djibouti',
//     'DM' => 'Dominique',
//     'EG' => 'Égypte',
//     'AE' => 'Émirats arabes unis',
//     'EC' => 'Équateur',
//     'ER' => 'Érythrée',
//     'ES' => 'Espagne',
//     'EE' => 'Estonie',
//     'SZ' => 'Eswatini',
//     'VA' => 'État de la Cité du Vatican',
//     'FM' => 'États fédérés de Micronésie',
//     'US' => 'États-Unis',
//     'ET' => 'Éthiopie',
//     'FJ' => 'Fidji',
//     'FI' => 'Finlande',
//     'FR' => 'France',
//     'GA' => 'Gabon',
//     'GM' => 'Gambie',
//     'GE' => 'Géorgie',
//     'GS' => 'Géorgie du Sud et îles Sandwich du Sud',
//     'GH' => 'Ghana',
//     'GI' => 'Gibraltar',
//     'GR' => 'Grèce',
//     'GD' => 'Grenade',
//     'GL' => 'Groenland',
//     'GP' => 'Guadeloupe',
//     'GU' => 'Guam',
//     'GT' => 'Guatemala',
//     'GG' => 'Guernesey',
//     'GN' => 'Guinée',
//     'GQ' => 'Guinée équatoriale',
//     'GW' => 'Guinée-Bissau',
//     'GY' => 'Guyana',
//     'GF' => 'Guyane française',
//     'HT' => 'Haïti',
//     'HN' => 'Honduras',
//     'HU' => 'Hongrie',
//     'BV' => 'Île Bouvet',
//     'CX' => 'Île Christmas',
//     'IM' => 'Île de Man',
//     'NF' => 'Île Norfolk',
//     'AX' => 'Îles Åland',
//     'KY' => 'Îles Caïmans',
//     'CC' => 'Îles Cocos',
//     'CK' => 'Îles Cook',
//     'FO' => 'Îles Féroé',
//     'HM' => 'Îles Heard et McDonald',
//     'FK' => 'Îles Malouines',
//     'MP' => 'Îles Mariannes du Nord',
//     'MH' => 'Îles Marshall',
//     'UM' => 'Îles mineures éloignées des États-Unis',
//     'PN' => 'Îles Pitcairn',
//     'SB' => 'Îles Salomon',
//     'TC' => 'Îles Turques-et-Caïques',
//     'VG' => 'Îles Vierges britanniques',
//     'VI' => 'Îles Vierges des États-Unis',
//     'IN' => 'Inde',
//     'ID' => 'Indonésie',
//     'IQ' => 'Irak',
//     'IR' => 'Iran',
//     'IE' => 'Irlande',
//     'IS' => 'Islande',
//     'IL' => 'Israël',
//     'IT' => 'Italie',
//     'JM' => 'Jamaïque',
//     'JP' => 'Japon',
//     'JE' => 'Jersey',
//     'JO' => 'Jordanie',
//     'KZ' => 'Kazakhstan',
//     'KE' => 'Kenya',
//     'KG' => 'Kirghizistan',
//     'KI' => 'Kiribati',
//     'KW' => 'Koweït',
//     'RE' => 'La Réunion',
//     'LA' => 'Laos',
//     'LS' => 'Lesotho',
//     'LV' => 'Lettonie',
//     'LB' => 'Liban',
//     'LR' => 'Libéria',
//     'LY' => 'Libye',
//     'LI' => 'Liechtenstein',
//     'LT' => 'Lituanie',
//     'LU' => 'Luxembourg',
//     'MK' => 'Macédoine du Nord',
//     'MG' => 'Madagascar',
//     'MY' => 'Malaisie',
//     'MW' => 'Malawi',
//     'MV' => 'Maldives',
//     'ML' => 'Mali',
//     'MT' => 'Malte',
//     'MA' => 'Maroc',
//     'MQ' => 'Martinique',
//     'MU' => 'Maurice',
//     'MR' => 'Mauritanie',
//     'YT' => 'Mayotte',
//     'MX' => 'Mexique',
//     'MD' => 'Moldavie',
//     'MC' => 'Monaco',
//     'MN' => 'Mongolie',
//     'ME' => 'Monténégro',
//     'MS' => 'Montserrat',
//     'MZ' => 'Mozambique',
//     'MM' => 'Myanmar (Birmanie)',
//     'NA' => 'Namibie',
//     'NR' => 'Nauru',
//     'NP' => 'Népal',
//     'NI' => 'Nicaragua',
//     'NE' => 'Niger',
//     'NG' => 'Nigéria',
//     'NU' => 'Niue',
//     'NO' => 'Norvège',
//     'NC' => 'Nouvelle-Calédonie',
//     'NZ' => 'Nouvelle-Zélande',
//     'OM' => 'Oman',
//     'UG' => 'Ouganda',
//     'UZ' => 'Ouzbékistan',
//     'PK' => 'Pakistan',
//     'PW' => 'Palaos',
//     'PA' => 'Panama',
//     'PG' => 'Papouasie-Nouvelle-Guinée',
//     'PY' => 'Paraguay',
//     'NL' => 'Pays-Bas',
//     'BQ' => 'Pays-Bas caribéens',
//     'PE' => 'Pérou',
//     'PH' => 'Philippines',
//     'PL' => 'Pologne',
//     'PF' => 'Polynésie française',
//     'PR' => 'Porto Rico',
//     'PT' => 'Portugal',
//     'QA' => 'Qatar',
//     'HK' => 'R.A.S. chinoise de Hong Kong',
//     'MO' => 'R.A.S. chinoise de Macao',
//     'CF' => 'République centrafricaine',
//     'DO' => 'République dominicaine',
//     'RO' => 'Roumanie',
//     'GB' => 'Royaume-Uni',
//     'RU' => 'Russie',
//     'RW' => 'Rwanda',
//     'EH' => 'Sahara occidental',
//     'BL' => 'Saint-Barthélemy',
//     'KN' => 'Saint-Christophe-et-Niévès',
//     'SM' => 'Saint-Marin',
//     'MF' => 'Saint-Martin',
//     'SX' => 'Saint-Martin (partie néerlandaise)',
//     'PM' => 'Saint-Pierre-et-Miquelon',
//     'VC' => 'Saint-Vincent-et-les-Grenadines',
//     'SH' => 'Sainte-Hélène',
//     'LC' => 'Sainte-Lucie',
//     'SV' => 'Salvador',
//     'WS' => 'Samoa',
//     'AS' => 'Samoa américaines',
//     'ST' => 'Sao Tomé-et-Principe',
//     'SN' => 'Sénégal',
//     'RS' => 'Serbie',
//     'SC' => 'Seychelles',
//     'SL' => 'Sierra Leone',
//     'SG' => 'Singapour',
//     'SK' => 'Slovaquie',
//     'SI' => 'Slovénie',
//     'SO' => 'Somalie',
//     'SD' => 'Soudan',
//     'SS' => 'Soudan du Sud',
//     'LK' => 'Sri Lanka',
//     'SE' => 'Suède',
//     'CH' => 'Suisse',
//     'SR' => 'Suriname',
//     'SJ' => 'Svalbard et Jan Mayen',
//     'SY' => 'Syrie',
//     'TJ' => 'Tadjikistan',
//     'TW' => 'Taïwan',
//     'TZ' => 'Tanzanie',
//     'TD' => 'Tchad',
//     'CZ' => 'Tchéquie',
//     'TF' => 'Terres australes françaises',
//     'IO' => 'Territoire britannique de l’océan Indien',
//     'PS' => 'Territoires palestiniens',
//     'TH' => 'Thaïlande',
//     'TL' => 'Timor oriental',
//     'TG' => 'Togo',
//     'TK' => 'Tokelau',
//     'TO' => 'Tonga',
//     'TT' => 'Trinité-et-Tobago',
//     'TN' => 'Tunisie',
//     'TM' => 'Turkménistan',
//     'TR' => 'Turquie',
//     'TV' => 'Tuvalu',
//     'UA' => 'Ukraine',
//     'UY' => 'Uruguay',
//     'VU' => 'Vanuatu',
//     'VE' => 'Venezuela',
//     'VN' => 'Vietnam',
//     'WF' => 'Wallis-et-Futuna',
//     'YE' => 'Yémen',
//     'ZM' => 'Zambie',
//     'ZW' => 'Zimbabwe',
//        ];
//
//        $countryModel = new Core_Model_Country;
//        foreach ( $countries_fr as $code => $name ) {
//            $countryRow = $countryModel->getCountryByAlpha2( $code );
//            if ( ! empty( $countryRow ) ) {
//                $countryRow->name_fr = $name;
//                $countryRow->save();
//            }
//        }
//
//        die('DONE!');


        /** Use the test action to play with test code. */
        // $composerService = new Core_Service_Composer([]);
        // pr( $composerService->status('webtigers/core', true) );
        // $composerService->status( 'webtigers/core', true );
        // pr( $composerService->getComposerJSON() );
        // $composerService->setComposerJSON();
        // $composerService->sync([]);


        try {

            // https://docs.aws.amazon.com/aws-sdk-php/v3/api/class-Aws.LocationService.LocationServiceClient.html
            // https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-location-2020-11-19.html#searchplaceindexfortext

            $clientConfigs = Zend_Registry::get('Zend_Config')->aws->client->toArray();
            $client = new \Aws\LocationService\LocationServiceClient( $clientConfigs );

            $result = $client->searchPlaceIndexForText([
                // 'BiasPosition'      => [47.57381439, -120.35188293],          // <float>, ...
                // 'FilterBBox'        => [],          // <float>, ...
                'FilterCountries'   => ['USA'],     // '<string>', ...
                'IndexName'         => 'sample.here.place',          // REQUIRED, <string>
                'MaxResults'        => 10,          // <integer>
                'Text'              => '1162 st francis place',     // REQUIRED, <string>
            ]);

            pr( $result );

        }
        catch ( Error | Exception $e ) {

            pr( $e->getMessage() );

        }


    }

}

