# if [ -e /.installed_chrome ]; then
#   echo 'Chrome already installed.'

# else
#   echo ''
#   echo 'Chrome INSTALLING'
#   echo '----------'

#   # Add Google public key to apt
#   sudo wget -q -O - "https://dl-ssl.google.com/linux/linux_signing_key.pub" | sudo apt-key add -

#   # Add Google to the apt-get source list
#   sudo echo 'deb http://dl.google.com/linux/chrome/deb/ stable main' >> /etc/apt/sources.list

#   # Update app-get
#   sudo apt-get update

#   # Install Java, Chrome, Xvfb, and unzip
#   sudo apt-get -y google-chrome-stable 

#   # Download and copy the ChromeDriver to /usr/local/bin
#   cd /tmp
#   sudo wget "https://chromedriver.googlecode.com/files/chromedriver_linux64_2.2.zip"
#   sudo unzip chromedriver_linux64_2.2.zip
#   sudo mv chromedriver /usr/local/bin

#   # So that running `vagrant provision` doesn't redownload everything
#   touch /.installed_chrome
# fi
