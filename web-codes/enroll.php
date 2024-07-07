<?php
if($_GET['name'] == ''){
header('Location: enroll');
exit;
}

$class=$_GET['class'];

$command = escapeshellcmd('sudo pkill -f search.py');
$output1 = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f delete.py');
$output2 = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f enroll.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f rf_run.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo pkill -f rf.py');
$output = shell_exec($command);
$command = escapeshellcmd('sudo python3 /home/cmriseshivpuri/Desktop/enroll.py '.$_GET['category'].' "'.$_GET['name'].'" '.$class." ".$_GET['zone']);
$output3 = shell_exec($command);

$a = exec('sudo python3 /home/cmriseshivpuri/Desktop/search.py > /dev/null 2>&1 & echo $!');
echo $a;
header('Location: enrollfront.php');
exit;


?>

