# Webpage

Setup:

1. Install xampp 7.4.27

2. Install Github Desktop

3. Clone repository Webpage to C:\xampp\htdocs

4. Open xampp

5. Apache Config phpMyAdmin set $cfg['Servers'][$i]['auth_type'] = 'cookie';

6. Open Apache config (httpd-xampp.conf) set all local to all granted

7. Drop this sql in your phpmyadmin, SET PASSWORD FOR 'root'@'localhost' = PASSWORD('your_password_here');

8. Make a database called storage

9. Import sql file attatched to repo

Youtube video instruction for below https://www.youtube.com/watch?v=4_NP_WYFmIM  {

10. Go to c:\xampp\sendmail\sendmail.ini

11. Set smtp_server=smtp.gmail.com or relay.prhc.on.ca

12. Set smtp_port=465 or 25

13. Set smtp_ssl=ssl or none

14. Set auth_username=*YOUR EMAIL HERE*
15. Set auth_password=*YOUR PASSWORD HERE*

16. Go to this link https://myaccount.google.com/
17. Make sure there is no 2FA on your email and to allow less secure apps

18. Go to c:\xampp\php\php.ini

19. Find mail function

20. Comment out two lines by adding a ; in front of them 

21. ;SMTP=localhost
22. ;smtp_port=25

23. Uncomment out two lines and set them equal to

24. sendmail_from = *YOUR EMAIL HERE* 
25. sendmail_path = "C:\xampp\sendmail\sendmail.exe -t"

}
