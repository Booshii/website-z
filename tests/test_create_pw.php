<?php
$plain = 'leon123';
$hash  = password_hash($plain, PASSWORD_DEFAULT); // inkl. Salt
echo $hash;