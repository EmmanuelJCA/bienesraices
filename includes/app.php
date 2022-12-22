<?php

require __DIR__ . '/../includes/functions.php';
require __DIR__ . '../config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectar a la base de datos
$db = connectDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);



