<?php
session_start();
include ('filters/auth_filter.php');
require('config/database.php');
require('includes/functions.php');

require ('views/trackMyRequest.view.php');