<?php 
	sleep(1);
	echo ('Listing all files.' . "\n");
	sleep(1);
	// get data 
	$fp = fopen('flatness.txt','r');
	//check if error
	if (!$fp) {
		echo 'Error. Can not read file.'; 
		exit;
	}
	// set loop for later
	$loop = 0;
	// read data until the end of stream
	while (!feof($fp)) {
		$loop++;
		// get a line
		$line = fgets($fp, 1024); 
		// declare separators and explode into array
		$field[$loop] = explode ('=', $line);
		// console output, adjust if alternative spacing desired
		// must match 1:1 with flat file cols otherwise you wont like it 
		printf("|%5.15s |%-20s |%-20s |%-20s |%-20s |\n", "ID", "Title", "Author", "Publisher", "ISBN");
		printf("|%5.15s |%-20.20s |%-20.20s |%-20.20s |%-20.10s |\n", $field[$loop][0], $field[$loop][1], $field[$loop][2] , $field[$loop][3] , $field[$loop][4]);
		// file pointer increment 
		$fp++;
	}
	// party over
	fclose($fp);
?>