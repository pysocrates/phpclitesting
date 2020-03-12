<?php
// Quick and dirty console app with flat file system
// 
// CoryC
// 
// for cPanel 
	while( true ) {
		// Print menu to console
		printMenu();
		// get choice
		$choice = trim(fgets(STDIN));
		// Exit application
		if( $choice == 3 ) {
			break;
		}
		// user makes a choice
				switch( $choice ) {
					case 1:
					{
						// user wants to list catalog
						// get data 
						$fp = fopen('flatness.txt','r');
						//check if error
						if (!$fp) {echo 'Whoops! Can not open file.</table>'; exit;}
						// database lines for later
						$loop = 0;
						// read data until the end of stream
						// important - printf output must match 1:1 with flat file cols otherwise you wont like it 
						while (!feof($fp)) {
							$loop++;
							// get a line
							$line = fgets($fp, 1024); 
							// declare separators and explode into array
							$field[$loop] = explode ('=', $line);
							// console output, adjust if alternative spacing desired
							printf("|%5.15s |%-20s |%-20s |%-20s |%-20s |\n", "ID", "Title", "Author", "Publisher", "ISBN");
							printf("|%5.15s |%-20.20s |%-20.20s |%-20.20s |%-20.10s |\n", $field[$loop][0], $field[$loop][1], $field[$loop][2] , $field[$loop][3] , $field[$loop][4]);
							// file pointer increment by 1
							$fp++;
						}
						// party over
						fclose($fp);
						break;
					}
					case 2:
					{
						// user wants to search
						searchRecords();
						break;
					}
					default:
					{
						// user is clearly not following directions
						echo "\nPlease enter a selection.\n\n";
					}
				}
	}
	// terminal interface - fancy edition
	function printMenu() {
		echo "*** Tiny Books ***\n";
		echo "*** A simple PHP Console App Using a Flat File Db ****\n";
		echo "1 - List Files\n";
		echo "2 - Search Files\n";
		echo "3 - Quit\n";
		echo "*** Tiny Books ***\n";
		echo "Enter your choice from 1 to 3 ::";
	}
	// search 
	function searchRecords() {
		while (true) {
			//prompt user
			echo  "Search Records For: ";
			// declare input as argc to deal with console things
			$argv = trim(fgets(STDIN, 1024));
			// dies if no input, probably should not be this way	
			if ($argv == '') {exit('No search string found! Cannot continue!');}
			// $input = strip_tags($input); //remove HTML tags
			//open data stream
			$fp = fopen('flatness.txt','r');
			// if problems come along
			if (!$fp) {echo 'Can not open file.'; exit;}
			// set start
			// very important - if you add colums to the database you must tell the script here
			$row = 0;
			$columns = 5;
			// get lines
			while (!feof($fp)) {
			  $line = fgets($fp,1024); 
			  $field[$row] = explode('=', $line);
				$row++;
			}
			// close it
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
					// convert input/argv to lowercase, because reasons. Not the best way to do this in case return array and not string 
					$argv = strtolower($field[$loop][$cell]);
					// check if found or not
					if (strstr($argv,$search)) {
						$found = 'yes';
						if ($once == 'no') {
							$once = 'yes';
						}
						// console output, adjust if alternative spacing desired
						printf("|%5.15s |%-20s |%-20s |%-20s |%-20s |\n", "ID", "Title", "Author", "Publisher", "ISBN");
						printf("|%5.15s |%-20.20s |%-20.20s |%-20.20s |%-20.10s |\n", $field[$loop][0], $field[$loop][1], $field[$loop][2] , $field[$loop][3] , $field[$loop][4]);
						break;
					}
					$cell++;
				}
			}
			if ($found == 'no') {echo "not found. \n";}
		}
	}
?>