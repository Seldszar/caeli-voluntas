<?php

App::uses('Environment', 'Environments.Lib');

include 'Environments' . DS . 'production.php';
include 'Environments' . DS . 'development.php';

Environment::start();
