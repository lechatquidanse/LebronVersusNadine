# if [ -e /.installed_firefox ]; then
#   echo 'Firefox installed.'

# else
#   echo ''
#   echo 'Firefox INSTALLING'
#   echo '----------'

#   cd /tmp

#   # Download Firefox 27.0
#   wget https://ftp.mozilla.org/pub/mozilla.org/firefox/releases/27.0/linux-x86_64/en-GB/firefox-27.0.tar.bz2
  
#   # Extract
#   sudo tar xjf firefox-27.0.tar.bz2 -C /opt

	# todo make this without manually
#   nano ~/.bash_profile
  
#   # then add this line and save the file
#   PATH=$PATH:$HOME/bin:/opt/firefox/

#   # So that running `vagrant provision` doesn't redownload everything
#   touch /.installed_firefox
# fi
