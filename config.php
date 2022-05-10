<?php

return [
    'db' => [
        'database' => 'maktab_chatdb',
        'username' => 'root',
        'password' => ''
    ],
    'STORAGE' => [
        "PREFERED_OPTION" => "DB", // currect value = DB | JSON
        "JSON_FILE_PATH" => "../message/message.json",
        "USERS_FILE_PATH" => "../users/users.json"
    ]
];