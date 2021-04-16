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

