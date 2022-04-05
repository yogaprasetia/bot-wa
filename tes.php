<?

//echo exec('runas /user:win-cgrmj0dm0on\administrator "notepad.exe"' );
//exec('echo "SJ@123#$s" | runas /user:win-cgrmj0dm0on\administrator "notepad.exe"');
	
		//$WshShell = new COM("WScript.Shell");
		//$oExec = $WshShell->Run("C:/wa-gw/app/wg.exe " , 0, false);
		
		$commandString = 'start /wait /b c:\\wa-gw\\app\\wg.exe '   ;
 		pclose(popen($commandString, 'r'));
?>