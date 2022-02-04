# Webpage

Setup:

Install xampp

Apache Config set $cfg['Servers'][$i]['auth_type'] = 'cookie';

Drop this sql in your phpmyadmin SET PASSWORD FOR 'root'@'localhost' = PASSWORD('sysadm');

Make a database called prhc

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

