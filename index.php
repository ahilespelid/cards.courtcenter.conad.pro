<?php
require_once (__DIR__.'/functions.php');
pa(['test']);
require_once (__DIR__.'/crest.php');

$result = CRest::call('profile');

pa($result);
