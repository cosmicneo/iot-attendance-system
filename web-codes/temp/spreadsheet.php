<?php

$command = escapeshellcmd('sudo python3 /var/www/html/temp/record_f.py '.$_GET['month'].' '.$_GET['year'].' '.$_GET['category'].' '.$_GET['class']);
$output1 = shell_exec($command);


// Remote download URL
$remoteURL = 'SchoolReport.xlsx';

// Force download
header("Content-type: application/x-file-to-save"); 
header("Content-Disposition: attachment; filename=".basename($remoteURL));
ob_end_clean();
readfile($remoteURL);

$command = escapeshellcmd('sudo rm /var/www/html/temp/SchoolReport.xlsx');
$output1 = shell_exec($command);

exit;

?>