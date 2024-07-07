<?php
if($_GET['id'] == ''){
header('Location: delete');
exit;
}
$command = escapeshellcmd('sudo pkill -f rf.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f search.py');
$output1 = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f delete.py');
$output2 = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f enroll.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f rf_run.py');
$output = shell_exec($command);

$command = escapeshellcmd('sudo python3 /home/cmriseshivpuri/Desktop/delete.py '.$_GET['id'].' '.$_GET['category']);
$output3 = shell_exec($command);

$a = exec('sudo python3 /home/cmriseshivpuri/Desktop/search.py > /dev/null 2>&1 & echo $!');
echo $a;
header('Location: delete.html');
exit;

?>



