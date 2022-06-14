<?php



 $capabilities = array(
    'local/helloworld:deleteanymessage' => array(
        'riskbitmask'  => RISK_DATALOSS,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes'   => array(
            'manager'          => CAP_ALLOW
        )
    ),
    'local/helloworld:postmessages' => array(
        'riskbitmask'  => RISK_SPAM,
        'captype'      => 'write',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes'   => array(
            'user'          => CAP_ALLOW
        )
    ),
    'local/helloworld:readmessages' => array(
        'riskbitmask'  => RISK_PERSONAL,
        'captype'      => 'read',
        'contextlevel' => CONTEXT_MODULE,
        'archetypes'   => array(
            'user'          => CAP_ALLOW
        )
    ),

    // Add more capabilities here ...
);