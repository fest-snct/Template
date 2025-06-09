# サーバー設定

以下のコマンドでhost設定をします。
```bash
echo '127.0.0.1         fest.localhost' | sudo tee -a /etc/hosts
```

次は`vhost`の設定をします。

```bash
sudo tee /etc/apache2/sites-available/fest.localhost.conf > /dev/null <<EOF
<VirtualHost *:80>
    ServerName fest.localhost
    DocumentRoot /var/www/html/2025
    DirectoryIndex home.php
    <Directory /var/www/html/HP2025 >
        Options Indexes FollowSymLinks
        AllowOverride ALL
        Require all granted
    </Directory>

    ErrorLog \${APACHE_LOG_DIR}/fest_error.log
    CustomLog \${APACHE_LOG_DIR}/fest_access.log combined
</VirtualHost>
EOF
```
```bash
sudo a2ensite fest.localhost.conf
```
```bash
sudo systemctl reload apache2
```

ブラウザで、http://fest.localhost を開いてください。
多分開けるはずです。