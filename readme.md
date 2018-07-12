# Cài đặt soure code Zendvn.com
* Yêu cầu: PHP 7.x trở lên 
* Cài tải source code về giải nén để trong folder xampp 
* Tạo virtual host trỏ tới folder public của source:
    Ví dụ 
    ```
    <VirtualHost *:80>
        ServerAdmin video2.local@dummy-host2.example.com
        DocumentRoot "C:/xampp7/htdocs/zendvn_project/public/"
        ServerName staging-zendvn.local
        ErrorLog "logs/staging-zendvn.local-error.log"
        CustomLog "logs/staging-zendvn.local-access.log" common
    </VirtualHost>
    ``` 
* Add host với ServerName đã tạo.
* Trong folder database có db: zendvn_project.sql
  -  Tạo và import database với db name: zendvn_project
* Copy file .env.example thành file .env 
* Chạy url với servername/administrator/login
    - user: admin@gmail.com 
    - pass: admin
  
      
