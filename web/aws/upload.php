<?php

	require 'aws-autoloader.php';

	use Aws\Common\Aws;
	use Aws\S3\Exception\S3Exception;

	// Instantiate an S3 client
	$aws = Aws::factory('config.php');
	$s3 = $aws->get('s3');

	// Upload a publicly accessible file.
	// The file size, file type, and MD5 hash are automatically calculated by the SDK
	try {
	    $s3->putObject(array(
	        'Bucket' => 'cdn-wbb',
	        'Key'    => 'imgtest.jpg',
	        'Body'   => fopen('imgtest.jpg', 'r'),
	        'ACL'    => 'public-read',
	    ));
	} catch (S3Exception $e) {
	    echo "There was an error uploading the file.\n";
	}