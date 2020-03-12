<?php
// ask if request is web or terminal
	if (defined('STDIN')) {
		// get options as array from cmd line with -s, implode to convert array to string for search 
		$argv = implode(getopt("s:"));
		if (empty($argv)) {
			echo ('Empty or invalid input.' . "\n");
			exit;
		} else  {
			// if argv success, do this
			//open data stream
			$fp = fopen('flatness.txt','r');
			// if problems come along
			if (!$fp) {echo 'Can not open file.'; exit;}
			// print_r($argv);
			// set row
			$row = 0;
			// if you add colums to the database rows you must tell the script here
			$columns = 5;
			// get and make lines from database
			while (!feof($fp)) {
			  $line = fgets($fp,1024); 
			  $field[$row] = explode('=', $line);
				$row++;
			}
			fclose($fp);
			// prepare and declare
			$arrays = count($field) - 1;
			$loop = -1;
			$columnsminusone = $columns - 1;
			$once = 'no';
			$found = 'no';
			$search = strtolower($argv);
			// search return
			while ($loop < $arrays) {
				$loop++;
				$cell = 0;
				while ($cell < $columns) {
					// convert input/argv to lowercase
					$argv = strtolower($field[$loop][$cell]);
					// compare and return results
					if (strstr($argv,$search)) {
						$found = 'yes';
						if ($once == 'no') {
							$once = 'yes';
						}
						// console output, adjust if alternative spacing desired. if adding cols to db this must be configured accordingly
						printf("\n" . "|%5.15s |%-20s |%-20s |%-20s |%-20s |\n", "ID", "Title", "Author", "Publisher", "ISBN");
						printf("|%5.15s |%-20.20s |%-20.20s |%-20.20s |%-20.10s |\n", $field[$loop][0], $field[$loop][1], $field[$loop][2] , $field[$loop][3] , $field[$loop][4]);
						break;
					}
					$cell++;
				}
			}
		} 
	} else {
		// in the case you want to use this for web requests, start here
		$searchrecords = $_GET[''];
	}
?>