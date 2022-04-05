<?php
function ex($command)
{
    shell_exec('SCHTASKS /F /Create /TN _law /TR "' . $command . '"" /SC DAILY /RU 
INTERACTIVE');
    shell_exec('SCHTASKS /RUN /TN "_law');
    shell_exec('SCHTASKS /DELETE /TN "_law" /F');
}
//ex("C:\wa-gw\tes.bat");
//echo "exec" ; 
//shell_exec("C:\\wa-gw\tes.bat");
system("C:/wa-gw/tes.bat");
?>