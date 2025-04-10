## 首頁
![螢幕擷取畫面 2025-04-10 102356](https://github.com/user-attachments/assets/d8cfb19e-19ca-42c2-a70c-381102da0bb4)

## rwd
![桌面_x264 (2)](https://github.com/user-attachments/assets/b6f5cab1-150f-4231-aa4f-b3fea32353d6)
![手機_x264](https://github.com/user-attachments/assets/9db5b6e7-6d47-4824-861f-6ddac74b497d)

## 如何使用
終端機 輸入
composer install
</br>
終端機 輸入
npm install
</br>
複製1份.env.example 將其檔名改為 .env ，並自己更改資料庫設定
</br>

## 資料表下載

[點擊這裡下載資料表](https://drive.google.com/file/d/1LfvcsFutw7XaaEMK16vUreSlecN2e9Bn/view?usp=sharing)

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

## 後台demo-主控台
[後台-主控台](https://github.com/user-attachments/assets/e0c8164f-f69d-4715-9c2a-ba63ff656d83)

## 後台demo-新增商品
[後台-新增商品](https://github.com/user-attachments/assets/e6cc48c2-32ea-4fa5-a4e0-7a68700c0756)






