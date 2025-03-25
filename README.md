## summernote文字欄位插件
https://github.com/summernote/summernote

## Datatable 安裝

請參考 [Yajra Datatables 官方文件](https://yajrabox.com/docs/laravel-datatables/master/quick-starter)
## yoeunes/toastr(暫時移除)
https://github.com/yoeunes/toastr

## 資料表下載

[點擊這裡下載資料表](https://drive.google.com/file/d/1ngB5VWBfAEpDPLnXOOBvRZTpqDwqC-R1/view?usp=sharing)

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
</br>
啟用vite(因為使用vite來讀取部分css js 所以需要啟動 Vite 開發伺服器)
</br>
->終端機 輸入 npm run dev
</br>
</br>
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


## API串接測試
http://127.0.0.1:8000/api/test
</br>請先確認php artisan serve是否啟動
</br>對外的api 需寫在route/api.php
</br>若成功串接可獲得會員資料

## 後台
http://127.0.0.1:8000/admin/login
</br>
測試帳號:admin@example.com
</br>
密碼:password
![image](https://github.com/user-attachments/assets/5071c0ca-49d0-412b-a99b-ce5310a66efc)
![image](https://github.com/user-attachments/assets/8239b8c5-81fc-46d2-b878-0ab9a417212d)
![image](https://github.com/user-attachments/assets/034e821d-9689-4149-bba7-6dfacf460e92)

