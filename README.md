## 資料表下載

[點擊這裡下載資料表](https://drive.google.com/file/d/1LfvcsFutw7XaaEMK16vUreSlecN2e9Bn/view?usp=sharing)

## 如何使用
終端機 輸入
composer install
</br>
終端機 輸入
npm install
</br>
複製1份.env.example 將其檔名改為 .env ，並自己更改資料庫設定
</br>


## 開啟本地端server
開啟伺服器
</br>
->終端機 輸入 php artisan serve
</br>
開啟成功會監聽port:8000
</br>
http://127.0.0.1:8000
</br>
</br>
開啟排程(監測未付款訂單)
</br>
->終端機 輸入 php artisan schedule:work
</br>
</br>
開啟佇列(避免超賣等問題)
</br>
->終端機 輸入 php artisan queue:work


## 後台
http://127.0.0.1:8000/admin/login
</br>
測試帳號 : admin@example.com
</br>
密碼     : password
![image](https://github.com/user-attachments/assets/5071c0ca-49d0-412b-a99b-ce5310a66efc)
![image](https://github.com/user-attachments/assets/8239b8c5-81fc-46d2-b878-0ab9a417212d)
![image](https://github.com/user-attachments/assets/034e821d-9689-4149-bba7-6dfacf460e92)

