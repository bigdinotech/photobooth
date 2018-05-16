# PHOTOBOOTH

#### This was designed for a Raspbery Pi 2/3 but other simlar boards should also work with minor changes

### 1) Update your Pi
`sudo apt-get update`

`sudo apt-get upgrade`



### 2) Install the required packages
`sudo apt-get install imagemagick php5 php5-cli git`



### 3) Download photobooth files
`git clone https://github.com/bigdinotech/photobooth.git`

### 4) change permissions of scripts and make them executable
`cd photobooth`

`cd www`

`cd scripts`

`sudo chmod +x *`



### 5) Install gphoto2
`cd`

`sudo wget raw.github.com/gonzalo/gphoto2-updater/master/gphoto2-updater.sh`

`sudo chmod +x gphoto2-updater.sh`

`sudo ./gphoto2-updater.sh`



### 6) install required php libraries
`sudo apt-get install php-pear`

`pear install Mail-1.3.0`

`pear install Mail_Mime`

`pear install Net_SMTP`



### 7) Printer setup (Optional)
#### Follow the instructions found here: http://www.instructables.com/id/Raspberry-Pi-photo-booth-controller/step3/Connect-the-Printer/



### 8) Setup dropbox uploader (http://raspi.tv/2013/how-to-use-dropbox-with-raspberry-pi)
#### If you don't have one already create a dropbox account https://www.dropbox.com/
`cd`

`git clone https://github.com/andreafabrizi/Dropbox-Uploader.git`


#### On your browser https://www.dropbox.com/developers/apps
Create app -> Dropbox API -> App folder

give your app a name

Generate access token and copy it to your clipboard


#### Now back to the terminal
`cd Dropbox-Uploader`

`./dropbox_uploader.sh`

paste the generate access token

#### copy dropbox_uploader.sh into the scripts directory
`cp dropbox_uploader.sh ~/photobooth/www/scripts/dropbox_uploader.sh`

### 9) Setup email using ssmtp and mpack
#### Follow instructions found here: http://ozzmaker.com/send-email-from-the-raspberry-pi-or-linux-command-line-with-attachments/
