# membertest.ocdla.org


# Installation instructions
1. In the "www" directory, clone the repository. (https://github.com/ocdladefense/members.git) 
2. Change the name of the directory to "membertest".
3. cd into the "membertest" directory and check out the branch you want to use.
4. Run "sudo apt-get install zip unzip".
5. Run "composer update".
6. set up a virtual host.  (ex. "examples/members-example.conf")
7. Set up the htaccess file. (ex. "examples/htaccess-example")
8. untar the "sites.tar.gz" tarbal.
9. Install the database. (use: data/ocdla_db_backup.sql)

## things to keep in mind
1. The "settings-default.php" file is in the tarball, so you may have to set some configurations in that file.


## Created tarball of "sites" directory using this command:
tar --exclude='sites/default/files/downloads' --exclude='sites/default/files/uploads' --exclude='sites/default/modules' --exclude='sites/all/modules' --exclude='sites/force.com/modules' --exclude='sites/clickpdx.force.com/modules' --exclude='sites/all/libraries' --exclude='sites/all/themes' -czvf sites.tar.gz sites


## Untar
tar -xvf sites.tar.gz

#### Restart Apache
sudo service apache2 restart


#### dump database
mysqldump -u [uname] -p db_name > db_backup.sql

#### upload database

