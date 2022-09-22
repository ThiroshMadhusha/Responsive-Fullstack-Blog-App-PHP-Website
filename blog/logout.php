<?php

require 'config/constants.php';

// destroy all session

session_destroy();
header('location: ' . ROOT_URL);
die();