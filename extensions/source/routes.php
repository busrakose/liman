<?php

return [
    "index" => "HomeController@index",

    // Tasks
    "runTask" => "TaskController@runTask",
    "checkTask" => "TaskController@checkTask",

    // Hostname Settings
    "get_hostname" => "HostnameController@get",
    "set_hostname" => "HostnameController@set",

    // Systeminfo
    "get_system_info" => "SystemInfoController@get",
    "install_lshw" => "SystemInfoController@install",

    // Runscript
    "run_script" => "RunScriptController@run",

    // TaskView
    "example_task" => "TaskViewController@run",
    // User
    "add_user" => "UserController@add",
    "get_users" => "UserController@get",

    // File
    "add_file" => "FileController@add",
    "get_files" => "FileController@get",
    //Trailer
    "get_file" => "TrailerController@get",
    "set_file" => "TrailerController@set",
    "add_trailer" => "TrailerController@add"
];
