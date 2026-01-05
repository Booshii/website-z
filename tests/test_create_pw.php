<?php
$plain = '&67FGDFypyOVm#MBGcgo4sS';
$hash  = password_hash($plain, PASSWORD_DEFAULT); // inkl. Salt
echo $hash;