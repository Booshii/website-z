<?php
$plain = 'hierpassword';
$hash  = password_hash($plain, PASSWORD_DEFAULT); // inkl. Salt
echo $hash;