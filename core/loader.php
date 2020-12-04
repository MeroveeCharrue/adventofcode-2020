<?php

require_once 'DayInALife.php';
require_once 'Santa.php';

foreach (glob('puzzle/*.php') as $itsANewDay) {
    require_once $itsANewDay;
}
