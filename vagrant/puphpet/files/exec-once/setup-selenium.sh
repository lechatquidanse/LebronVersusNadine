if [ -e /.installed_selenium ]; then
  echo 'SeleniumAlready installed.'

else
  echo ''
  echo 'Selenium INSTALLING'
  echo '----------'

  # Add Google public key to apt
  sudo wget -q -O - "https://dl-ssl.google.com/linux/linux_signing_key.pub" | sudo apt-key add -

  # Add Google to the apt-get source list
  sudo echo 'deb http://dl.google.com/linux/chrome/deb/ stable main' >> /etc/apt/sources.list

  # Update app-get
  sudo apt-get update

  # Install Java, Chrome, Xvfb, and unzip
  sudo apt-get -y install openjdk-7-jre google-chrome-stable xvfb unzip

  # Download and copy the ChromeDriver to /usr/local/bin
  cd /tmp
  sudo wget "https://chromedriver.googlecode.com/files/chromedriver_linux64_2.2.zip"
  sudo wget "https://selenium.googlecode.com/files/selenium-server-standalone-2.35.0.jar"
  sudo unzip chromedriver_linux64_2.2.zip
  sudo mv chromedriver /usr/local/bin
  sudo mv selenium-server-standalone-2.35.0.jar /usr/local/bin

  # So that running `vagrant provision` doesn't redownload everything
  touch /.installed_selenium
fi
