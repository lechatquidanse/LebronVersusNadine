if [ -e /.installed_selenium ]; then
  echo 'SeleniumAlready installed.'

else
  echo ''
  echo 'Selenium INSTALLING'
  echo '----------'

  # Update app-get
  # sudo apt-get update

  # Install Java, Xvfb, and unzip
  sudo apt-get -y install openjdk-7-jre xvfb unzip --force=yes

  # Download and copy the ChromeDriver to /usr/local/bin
  cd ~
  sudo wget "http://selenium-release.storage.googleapis.com/2.45/selenium-server-standalone-2.45.0.jar"
  #sudo mv selenium-server-standalone-2.45.0.jar /usr/local/bin

  # So that running `vagrant provision` doesn't redownload everything
  touch /.installed_selenium
fi
