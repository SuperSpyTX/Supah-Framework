<?php
include "bootstrap/boot.php";


return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);