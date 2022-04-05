<?
//$a = shell_exec("C://wg/app/w-agent.exe") ; //  > /dev/null &");
pclose(popen('start /B cmd /C "C://wa-gw/app/w-agent.exe >NUL 2>NUL"', 'r'));
header("Location:./index.php");
?>
 