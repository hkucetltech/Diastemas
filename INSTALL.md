Diastemas was tested to work in the LAMP environment below:
<ul>
	<li>Linux:                CentOS 6.7</li>
	<li>Apache:               Apache 2.4.23</li>
	<li>MySQL:                Mysql 5.7.16</li>
	<li>PHP:                  PHP 5.6.28</li>
</ul>
It should work in most LAMP environments.


<h2>Quick Installation </h2>

1.  Download Diastemas source zip file.

2.  Upload the Diastemas files to the desired location in your web server. 

3.  Create a database for Diastemas Mysql database in your web server and a MySQL (or MariaDB) user who has all privileges for accessing and modifying it.
 
4.  Edit the config.php file to change the name, user and password of the database in accordance with the information in step 3.

5.  Import the database template file into the new database by running
    mysql -u user DATABASE < diastemas.schema.sql

6.  Visit Diastemas with a browser. 

	The default web administrator account for the system is 
		username: DPadmin
		password: DPpassword
		
	You are advised to change the password at first log in.
    

