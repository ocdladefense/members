# membertest.ocdla.org


# Installation instructions
1. In the "www" directory, clone the repository. (https://github.com/ocdladefense/members.git) 
2. Change the name of the directory to "membertest"
2. cd into the "membertest" directory and check out the branch you want to use.
3. Install the "zip extension"
4. sudo apt-cache search zip
5. sudo apt-get install zip unzip
6. run "composer update"
7. set up a virtual host "use the 
8. Set up the htaccess file. (use the "htaccess-example" file)
9. untart the "sites" tarbal



## Created tarball of "sites" directory using this command:
tar --exclude='sites/default/files/downloads' --exclude='sites/default/files/uploads' --exclude='sites/default/modules' --exclude='sites/all/modules' --exclude='sites/force.com/modules' --exclude='sites/clickpdx.force.com/modules' --exclude='sites/all/libraries' --exclude='sites/all/themes' -czvf sites.tar.gz sites


## Untar
tar -xvf sites.tar.gz
