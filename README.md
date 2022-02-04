# Webpage

Setup:

Install xampp

Apache Config set $cfg['Servers'][$i]['auth_type'] = 'cookie';

Drop this sql in your phpmyadmin SET PASSWORD FOR 'root'@'localhost' = PASSWORD('sysadm');

Import sql file attatched to repo

Youtube video instruction for below https://www.youtube.com/watch?v=4_NP_WYFmIM  {

Go to c:\xampp\sendmail\sendmail.ini

Set smtp_server=smtp.gmail.com

Set smtp_port=465

Set smtp_ssl=ssl

Set auth_username=*YOUR EMAIL HERE*
Set auth_password=*YOUR PASSWORD HERE*

Go to this link https://myaccount.google.com/
Make sure there is no 2FA on your email and to allow less secure apps

Go to c:\xampp\php\php.ini

Find mail function

Comment out two lines by adding a ; in front of them 

;SMTP=localhost
;smtp_port=25

Uncomment out two lines and set them equal to

sendmail_from = *YOUR EMAIL HERE*
sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"

}

Open Apache config (httpd-xampp.conf){
"
#
# XAMPP settings
#

<IfModule env_module>
    SetEnv MIBDIRS "C:/xampp/php/extras/mibs"
    SetEnv MYSQL_HOME "\\xampp\\mysql\\bin"
    SetEnv OPENSSL_CONF "C:/xampp/apache/bin/openssl.cnf"
    SetEnv PHP_PEAR_SYSCONF_DIR "\\xampp\\php"
    SetEnv PHPRC "\\xampp\\php"
    SetEnv TMP "\\xampp\\tmp"
</IfModule>

#
# PHP-Module setup
#
LoadFile "C:/xampp/php/php7ts.dll"
LoadFile "C:/xampp/php/libpq.dll"
LoadFile "C:/xampp/php/libsqlite3.dll"
LoadModule php7_module "C:/xampp/php/php7apache2_4.dll"

<FilesMatch "\.php$">
    SetHandler application/x-httpd-php
</FilesMatch>
<FilesMatch "\.phps$">
    SetHandler application/x-httpd-php-source
</FilesMatch>

#
# PHP-CGI setup
#
#<FilesMatch "\.php$">
#    SetHandler application/x-httpd-php-cgi
#</FilesMatch>
#<IfModule actions_module>
#    Action application/x-httpd-php-cgi "/php-cgi/php-cgi.exe"
#</IfModule>


<IfModule php7_module>
    PHPINIDir "C:/xampp/php"
</IfModule>

<IfModule mime_module>
    AddType text/html .php .phps
</IfModule>

ScriptAlias /php-cgi/ "C:/xampp/php/"
<Directory "C:/xampp/php">
    AllowOverride None
    Options None
    Require all granted
    <Files "php-cgi.exe">
          Require all granted
    </Files>
</Directory>

<Directory "C:/xampp/cgi-bin">
    <FilesMatch "\.php$">
        SetHandler cgi-script
    </FilesMatch>
    <FilesMatch "\.phps$">
        SetHandler None
    </FilesMatch>
</Directory>

<Directory "C:/xampp/htdocs/xampp">
    <IfModule php7_module>
    	<Files "status.php">
    		php_admin_flag safe_mode off
    	</Files>
    </IfModule>
    AllowOverride AuthConfig
</Directory>

<IfModule alias_module>
    Alias /licenses "C:/xampp/licenses/"
    <Directory "C:/xampp/licenses">
        Options +Indexes
        <IfModule autoindex_color_module>
            DirectoryIndexTextColor  "#000000"
            DirectoryIndexBGColor "#f8e8a0"
            DirectoryIndexLinkColor "#bb3902"
            DirectoryIndexVLinkColor "#bb3902"
            DirectoryIndexALinkColor "#bb3902"
        </IfModule>
        Require all granted
        ErrorDocument 403 /error/XAMPP_FORBIDDEN.html.var
   </Directory>

    Alias /phpmyadmin "C:/xampp/phpMyAdmin/"
    <Directory "C:/xampp/phpMyAdmin">
        AllowOverride AuthConfig
        Require all granted
        ErrorDocument 403 /error/XAMPP_FORBIDDEN.html.var
    </Directory>

    Alias /webalizer "C:/xampp/webalizer/"
    <Directory "C:/xampp/webalizer">
        <IfModule php7_module>
    		<Files "webalizer.php">
    			php_admin_flag safe_mode off
    		</Files>
        </IfModule>
        AllowOverride AuthConfig
        Require all granted
        ErrorDocument 403 /error/XAMPP_FORBIDDEN.html.var
    </Directory>
</IfModule>
"
}
