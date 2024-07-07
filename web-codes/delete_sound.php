<?php
$command = escapeshellcmd('sudo python delete.py');
$output = shell_exec($command);

header('Location: confirmDeleteFile ');
exit;
?>
