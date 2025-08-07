

<?php

return [

    'default' => 'gmail',

    'accounts' => [
        'gmail' => [
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
           'username'      => 'rjksharma23@gmail.com',
            'password'      => 'bona hpqn jdwa vuok',
            'protocol'      => 'imap',
        ],
    ],

    'options' => [
        'delimiter'        => '/',
        'fetch'            => \Webklex\PHPIMAP\IMAP::FT_PEEK,
        'fetch_body'       => true,
        'fetch_attachment' => true,
        'dispositions'     => null,
        'message_key'      => 'list',
        'fetch_order'      => 'desc',
        'open'             => [],
        'decoder' => [
            'message'     => 'utf-8',
            'attachment'  => 'utf-8',
        ],
        'timeout' => [
            'socket'    => 30,
            'connect'   => 30,
            'read'      => 30,
            'write'     => 30,
        ],
        'attachments_dir' => storage_path('attachments'),
    ],

    'events' => [
        /*
        'message' => [
            'new' => [
                \App\Listeners\NewMessageListener::class,
            ],
        ],
        */
    ],
];
