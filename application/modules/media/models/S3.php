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

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

class Media_Model_S3
{

    protected $_allowedMimeTypes;
    protected $_utility;
    protected $_s3Client;
    protected $_defaultBucket;
    protected $_defaultPrivateBucket;

    public function __construct()
    {
        $this->_utility = new Core_Service_Utility();

        $this->_allowedMimeTypes = Zend_Registry::get('Zend_Config')->media->allowed;
        $this->_defaultBucket = Zend_Registry::get('Zend_Config')->media->default->bucket;
        $this->_defaultPrivateBucket = Zend_Registry::get('Zend_Config')->media->default->private_bucket;

        $s3ClientConfigs = Zend_Registry::get('Zend_Config')->aws->s3client->toArray();
        $this->_s3Client = new S3Client( $s3ClientConfigs );
        $this->_s3Client->registerStreamWrapper();  // Allows common PHP functions to work with S3 buckets.
    }

    public function moveFileToStorage ( array $params )
    {
        /**
         *  $file = [
         *      'name' => filename.jpg
         *      'type' => image/jpeg
         *      'tmp_name' => /var/www/tiger-www/upload/phpoa4mVc
         *      'error' => 0
         *      'size' => 37368
         *  ]
         */
        $file = $_FILES['file'];    // There is only ever going to be one file.

        /** The only params we are concerned with here are: "private", "prefixPath" and "rename". */

        $bucket = ( ! empty( $params['private'] ) && boolval( $params['private'] ) === true )
            ? $this->_defaultPrivateBucket
            : $this->_defaultBucket;

        $mediaFolder = 's3://' . $bucket . '/';

        $prefixPath = '';
        if ( ! empty( $params['prefixPath'] ) ) {
            if ( strtolower( $params['prefixPath'] ) === 'type') {
                $prefixPath = $this->_utility->getMediaFolderByAllowedMimeType($this->_allowedMimeTypes, $file['type']) . '/';
            }
            else {
                $prefixPath = $params['prefixPath'] . '/';
            }
        }

        $filename = preg_replace('/\s/u', '_', pathinfo( $file['name'], PATHINFO_FILENAME ) );
        $extension = pathinfo( $file['name'], PATHINFO_EXTENSION );

        if ( ! empty( $params['rename'] ) ) {
            if ( strtolower( $params['prefixPath'] ) === 'uuid') {
                $filename = Tiger_Utility_Uuid::v1();
            }
            else {
                $filename = $params['rename'];
            }
        }

        $destination = $mediaFolder . $prefixPath . $filename . '.' . $extension;

        /**
         * We don't want to overwrite an existing file of the same name, so just as a precaution,
         * we check to see of a file exists and then update the name with a duplicate number if
         * necessary.
         */

        if ( file_exists( $destination ) ) {
            // Start at duplicate 1 and keep iterating until we find open duplicate number.
            $duplicateCounter = 1;
            // Build a possible file name and see if it is available ...
            while( file_exists( $iterativeFileName = $mediaFolder . $prefixPath . $filename . '_' . $duplicateCounter . '.' . $extension ) ) {
                $duplicateCounter++;
            }
            $filename = $filename . '_' . $duplicateCounter;
            $destination = $iterativeFileName;
        }

        /** Now we can move the file to its new home ... */
        $permissions = [ 's3' => [ 'ACL' => 'public-read' ] ];
        if ( move_uploaded_file( $file['tmp_name'], $destination ) ) {

            $this->_s3Client->putObjectAcl([
                'Bucket' => $bucket,
                'Key' => $prefixPath . $filename . '.' . $extension,
                'ACL' => 'public-read'
            ]);

            /** If we're saving an image, get some image details ... */
            $file['height'] = 0;
            $file['width']  = 0;
            if ( explode('/', $file['type'])[0] === 'image' ) {
                list( $width, $height ) = getimagesize( $destination );
                $file['height'] = intval( $height );
                $file['width']  = intval( $width  );
            }

            $publicUrl = ( ! empty( $params['private'] ) && boolval( $params['private'] ) === true )
                ? null
                : 'https://' . $bucket . '.s3.amazonaws.com/' . $prefixPath . $filename . '.' . $extension;

            return [
                'type_storage' => 'S3',
                'bucket' => $bucket,
                'media_folder' => $mediaFolder,
                'prefix_path' => $prefixPath,
                'filename' => $filename,
                'original_filename' => $file['name'],
                'full_file_path' => $destination,
                'extension' => $extension,
                'mime_type' => $file['type'],
                'size' => $file['size'],
                'height' => $file['height'],
                'width' => $file['width'],
                'public_url' => $publicUrl,
            ];

        }
        else {
            return 'MESSAGE.MEDIA_PROBLEM_SAVING';
        }

    }

}