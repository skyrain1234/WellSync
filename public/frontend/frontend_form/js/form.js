// 引入
import popupModule from './popup.js'; // 引入 popup.js

// 確保 DOM 已經載入完成
document.addEventListener('DOMContentLoaded', function() {
// 自動計算年齡
document.querySelectorAll("#year, #month, #day").forEach(input => {
    input.addEventListener("input", function() {
        let year = document.getElementById("year").value;
        let month = document.getElementById("month").value;
        let day = document.getElementById("day").value;
        
        if (year && month && day) {
            let birthDate = new Date(year, month - 1, day);
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            
            if (today < new Date(today.getFullYear(), birthDate.getMonth(), birthDate.getDate())) {
                age--;
            }

            if (age >= 0) {
                document.getElementById("calculatedAge").textContent = age + " 歲";
            } else {
                document.getElementById("calculatedAge").textContent = "請輸入正確的日期";
            }
        }
    });
});

// 表單驗證並到下一題
function validateForm(){
    const form = document.getElementById('assessmentForm');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach(field => {
        if (!field.value || field.value.trim() === '') {
            isValid = false;
        }

        //特別處理radio的驗證
        if (field.type === 'radio') {
            const radioGroup = document.querySelectorAll(`input[name="${field.name}"]`);
            let isRadioChecked = false;
            radioGroup.forEach(radio => {
                if (radio.checked) {
                    isRadioChecked = true;
                }
            });
            if (!isRadioChecked) {
                isValid = false;
            }
        }
    });

    if (isValid) {
        // 如果表單驗證通過，則跳轉到下一頁
        window.location.href = '/quiz'; // 跳轉到 quiz.index 路由
    } else {
        // 如果表單驗證未通過，則顯示彈跳視窗
        popupModule.popup.style.display = 'flex'; // 讓彈跳視窗顯示出來
    }
}
// 取得按鈕元素
const submitButton = document.getElementById('submit-btn');
// 監聽按鈕的點擊事件
submitButton.addEventListener('click', validateForm);

});