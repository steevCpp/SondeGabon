#!/bin/bash

# Définir les variables
PROJECT_DIR="/var/www/html/CreightonCovidSurvey/CreightonSurveyWebsite"
WEB_USER="www-data"  # Pour Debian/Ubuntu, utiliser "apache" pour CentOS/RHEL

# Changer le propriétaire et le groupe
sudo chown -R $WEB_USER:$WEB_USER $PROJECT_DIR

# Définir les permissions
sudo chmod -R 755 $PROJECT_DIR

# Redémarrer le serveur web
sudo systemctl restart apache2  # Pour Debian/Ubuntu

