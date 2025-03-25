<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>免費評估</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #D6CEC5;
            text-align: center;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #D6CDC2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        .progress-bar {
            width: 100%;
            height: 20px;
            background: linear-gradient(to right, #4CAF50 0%, #FFEB3B 50%, #FF9800 75%, #F44336 100%);
            border-radius: 10px;
            position: relative;
            margin: 20px 0;
        }
        .progress-indicator {
            position: absolute;
            top: -5px;
            width: 10px;
            height: 30px;
            background: black;
            border-radius: 5px;
        }
        .bmi-result {
            font-size: 18px;
            margin-top: 10px;
            font-weight: bold;
        }
        .form-group {
            margin-top: 20px;
        }
        input {
            padding: 10px;
            font-size: 16px;
            margin: 5px;
        }
        .calculate-btn {
            background: #2E5D45;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>您的健康綜合得分是：<span id="score">--</span>/100</h2>
        <div class="progress-bar">
            <div id="progress-indicator" class="progress-indicator" style="left: 0%;"></div>
        </div>
        <p>BMI 指數: <span id="bmi-value">--</span></p>
        <p id="health-advice">請輸入身高和體重來計算您的 BMI</p>
        
        <div class="form-group">
            <label>身高 (cm):</label>
            <input type="number" id="height" min="100" max="250" required>
            <label>體重 (kg):</label>
            <input type="number" id="weight" min="20" max="300" required>
            <button class="calculate-btn" onclick="calculateBMI()">計算 BMI</button>
        </div>
    </div>
    
    <script>
        function calculateBMI() {
            let height = document.getElementById("height").value / 100;
            let weight = document.getElementById("weight").value;
            
            if (height > 0 && weight > 0) {
                let bmi = (weight / (height * height)).toFixed(1);
                document.getElementById("bmi-value").textContent = bmi;
                let score = Math.max(0, Math.min(100, 100 - Math.abs(22 - bmi) * 5));
                document.getElementById("score").textContent = score;
                
                let indicator = document.getElementById("progress-indicator");
                let percentage = Math.min(100, Math.max(0, ((bmi - 15) / 20) * 100));
                indicator.style.left = percentage + "%";
                
                let advice = "";
                if (bmi < 18.5) {
                    advice = "您的 BMI 偏低，請注意均衡飲食並適量運動。";
                } else if (bmi >= 18.5 && bmi < 24) {
                    advice = "您的 BMI 在正常範圍內，請繼續保持良好習慣！";
                } else if (bmi >= 24 && bmi < 27) {
                    advice = "您的 BMI 偏高，建議注意飲食控制並增加運動。";
                } else {
                    advice = "您的 BMI 過高，請諮詢專業人士來規劃健康管理計畫。";
                }
                document.getElementById("health-advice").textContent = advice;
            } else {
                alert("請輸入有效的身高和體重！");
            }
        }
    </script>
</body>
</html>