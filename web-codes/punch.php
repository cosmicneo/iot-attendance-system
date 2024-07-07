<?php

$command = escapeshellcmd('sudo pkill -f delete.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f enroll.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f search.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f rf.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f rf_run.py');
$output = shell_exec($command);
$a = exec('sudo python3 /home/cmriseshivpuri/Desktop/search.py > /dev/null 2>&1 & echo $!');
echo $a;
header('Location: index.html');
exit;

?>


