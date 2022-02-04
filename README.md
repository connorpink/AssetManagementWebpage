# Webpage

Setup:

1. Install xampp

2. Apache Config phpMyAdmin set $cfg['Servers'][$i]['auth_type'] = 'cookie';

3. Open Apache config (httpd-xampp.conf) se all local to all granted

4. Drop this sql in your phpmyadmin, SET PASSWORD FOR 'root'@'localhost' = PASSWORD('sysadm');

5. Make a database called prhc

6. Import sql file attatched to repo

Youtube video instruction for below https://www.youtube.com/watch?v=4_NP_WYFmIM  {

7. Go to c:\xampp\sendmail\sendmail.ini

8. Set smtp_server=smtp.gmail.com

9. Set smtp_port=465

10. Set smtp_ssl=ssl

11. Set auth_username=*YOUR EMAIL HERE*
12. Set auth_password=*YOUR PASSWORD HERE*

13. Go to this link https://myaccount.google.com/
14. Make sure there is no 2FA on your email and to allow less secure apps

15. Go to c:\xampp\php\php.ini

16. Find mail function

17. Comment out two lines by adding a ; in front of them 

18. ;SMTP=localhost
19. ;smtp_port=25

20. Uncomment out two lines and set them equal to

21. sendmail_from = *YOUR EMAIL HERE*
22. sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"

}
