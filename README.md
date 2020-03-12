# phpclitesting
messing around with server side php, includes console app with interaction as well as CLI goodies

Installation :

Place all files in desired folder location. Execute with PHP enabled shell.

-----------------------------

How To :

#list.php

php list.php

*Return all records in database

----------------------------

#search.php : 

php search.php -s Paul

*This will search the database for the word Paul and return any results matching that input. Can be used remotely with cron/wget/curl 

php search.php

*This will return all records in the database

----------------------------

#console.php :

php console.php 

*This will prompt a simple console app to conduct searches and list all files. Output is a little wonky if your
terminal window is too narrow, max view width recommended

-----------------------------

#flatness.txt

flat file database containing the records used for this project. can be updated with text editor of choice.

app runs entirely locally. has room for extending to web type requests
