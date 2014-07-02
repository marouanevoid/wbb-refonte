<?php

return array(
    // Bootstrap the configuration file with AWS specific features
    'includes' => array('_aws'),
    'services' => array(
        // All AWS clients extend from 'default_settings'. Here we are
        // overriding 'default_settings' with our default credentials and
        // providing a default region setting.
        'default_settings' => array(
            'params' => array(
                'key'    => 'AKIAJ6WSWPZUXSICYDPQ',
                'secret' => '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',
                'region' => 'eu-west-1'
            )
        )
    )
);