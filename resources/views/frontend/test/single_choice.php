<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>免費評估</title>
    <style>
        /* 設定網頁整體的樣式 */
        body {
            display: flex;
            justify-content: center; /* 使內容置中 */
            align-items: center;     /* 使內容垂直置中 */
            height: 100vh;           /* 使網頁填滿整個視窗 */
            background-color: #D6CEC5; /* 設定背景顏色 */
            font-family: 'Arial', sans-serif; /* 設定字型 */
            margin: 0; /* 取消預設的外邊距 */
        }

        /* 設定表單容器的樣式 */
        .form-container {
            background: #D6CDC2; /* 背景顏色 */
            padding: 40px;        /* 內邊距 */
            border-radius: 15px;  /* 邊角圓角 */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* 陰影效果 */
            width: 100%;
            max-width: 600px;     /* 最大寬度設定 */
            text-align: center;   /* 文字置中 */
        }

        /* 標題的樣式 */
        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            font-weight: 600; /* 設定粗體 */
        }

        /* 設定表單群組的樣式 */
        .form-group {
            margin-bottom: 20px; /* 底部間距 */
            text-align: left;    /* 文字靠左對齊 */
        }

        /* 標籤的樣式 */
        .form-group label {
            font-size: 16px;
            color: #444; /* 字體顏色 */
            margin-bottom: 8px; /* 底部間距 */
            display: block; /* 使每個標籤獨立顯示 */
        }

        /* 設定單選按鈕組的樣式 */
        .radio-group {
            display: flex;
            flex-direction: column; /* 使選項垂直排列 */
            gap: 10px;  /* 選項之間的間距 */
        }

        /* 設定單選按鈕標籤的樣式 */
        .radio-group label {
            display: flex;
            align-items: center; /* 使選項內容垂直置中 */
            background-color: #fafafa; /* 背景顏色 */
            border: 1px solid #ddd;    /* 邊框顏色 */
            padding: 12px;              /* 內邊距 */
            border-radius: 10px;        /* 圓角邊框 */
            cursor: pointer;           /* 游標變為手指狀 */
            transition: background-color 0.3s; /* 背景顏色變換動畫 */
        }

        /* 設定單選按鈕與文字的間距 */
        .radio-group input {
            margin-right: 10px; /* 右邊間距 */
        }

        /* 當滑鼠懸停或選中時，改變背景顏色 */
        .radio-group label:hover, .radio-group input:checked + label {
            background-color: #e0e0e0;
        }

        /* 送出按鈕的樣式 */
        .submit-btn {
            width: 100%;            /* 寬度設為100% */
            background-color: #2E5D45; /* 背景顏色 */
            color: white;           /* 文字顏色 */
            border: none;           /* 無邊框 */
            cursor: pointer;       /* 游標變為手指狀 */
            padding: 15px;          /* 內邊距 */
            font-size: 18px;        /* 字體大小 */
            border-radius: 10px;    /* 圓角邊框 */
            margin-top: 30px;       /* 上邊距 */
            transition: background-color 0.3s ease; /* 背景顏色變換動畫 */
        }

        /* 當送出按鈕滑鼠懸停時，改變背景顏色 */
        .submit-btn:hover {
            background-color: #156245;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- 顯示第一題問題 -->
        <h2>您一天當中使用3C產品(電腦、手機、平板)頻率有多高</h2>
        <form action="submit.php" method="post">
            <div class="form-group radio-group">
                <!-- 選擇少於3小時 -->
                <label><input type="radio" name="age_range" value="18-25">少於3小時</label>
                <!-- 選擇4-6小時 -->
                <label><input type="radio" name="age_range" value="26-35">4-6小時</label>
                <!-- 選擇高於7小時 -->
                <label><input type="radio" name="age_range" value="36-45"> 高於7小時</label>
            </div>
            <!-- 送出按鈕 -->
            <button type="submit" class="submit-btn">下一題</button>
        </form>
    </div>
</body>
</html>
