// quizUI.js
import quizLogic from './quizLogic.js';
import quizData from './quizData.js';

const quizUI = {
    showQuestion: function (currentQuestionIndex, allQuestions, isFirstQuestion, titleNames) {
        
        quizData.setTitleNames(titleNames);
        // 清空目前的問題容器
        const questionContainer = document.getElementById("question-container");
        questionContainer.innerHTML = "";
        //問題已經沒有了
        if(currentQuestionIndex >= allQuestions.length){
            console.log('noMoreQuestion');
            return;
        }
        //取得問題
        const currentQuestion = allQuestions[currentQuestionIndex];
        // 檢查 currentQuestion 是否存在
        if (!currentQuestion) {
            console.error('currentQuestion is undefined. currentQuestionIndex:', currentQuestionIndex, 'allQuestions:', allQuestions);
            return; // 如果 currentQuestion 不存在，直接返回，不執行後續程式碼
        }
        //修改標題
        document.getElementById('question-title').textContent = `問題（目前：第 ${currentQuestionIndex + 1} 題）`;
        // 建立一個表單
        const form = document.createElement('form');
        form.setAttribute('id', 'question-form');
        questionContainer.appendChild(form);
        // 加入隱藏輸入框
        const currentQuestionIndexInput = document.createElement('input');
        currentQuestionIndexInput.setAttribute('type', 'hidden');
        currentQuestionIndexInput.setAttribute('name', 'currentQuestionIndex');
        currentQuestionIndexInput.setAttribute('id', 'current-question-index');
        currentQuestionIndexInput.setAttribute('value', currentQuestionIndex);
        form.appendChild(currentQuestionIndexInput);

        const questionDiv = document.createElement('div');
        questionDiv.textContent = currentQuestion.question;
        form.appendChild(questionDiv);

        // 加入每個問題的選項
        currentQuestion.options.forEach(function(option) {
            //<div class="goal-item">
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('goal-item');
            //<input type="radio" id="option-{{ $question->id }}" name="options[]" value="{{ $option }}">
            const radio = document.createElement('input');
            radio.setAttribute('type', 'radio');
            radio.setAttribute('id',`option-${option.value}`);
            radio.setAttribute('name',`options[]`);
            radio.setAttribute('value', option.value); 

            // 檢查是否已選擇過此選項，並設定 checked 屬性
            const userAnswer = quizData.getUserAnswers()[currentQuestion.id];
            if (userAnswer && userAnswer.answer === option.value) {
                radio.checked = true;
                optionDiv.classList.add('selected'); // 添加反底色樣式
            }


            // 為每個 radio 按鈕添加事件監聽器
            radio.addEventListener('click', function () {
                quizLogic.collectAnswers();
                //移除所有選項的反底色
                const allOptionDivs = form.querySelectorAll('.goal-item');
                allOptionDivs.forEach(div => div.classList.remove('selected'));
                //為點選的選項加上反底色
                optionDiv.classList.add('selected');
            });

            const label = document.createElement('label');
            label.setAttribute('for',`option-${option.value}`);
            const span = document.createElement('span');
            span.textContent = option.label;
            label.appendChild(span);
            optionDiv.appendChild(radio);
            optionDiv.appendChild(label);
            form.appendChild(optionDiv);
        });

        // 判斷是否是第一道題目，並隱藏/顯示「上一頁」按鈕
        const prevButton = document.getElementById('prev-question');
        if (isFirstQuestion) {
            prevButton.style.display = 'none';
        } else {
            prevButton.style.display = 'block';
        }
    },

    createRadarChart: function (scores, titleNames) {
        // 取得 canvas 元素
        const canvas = document.createElement('canvas');
        canvas.id = 'radarChart';
        document.getElementById('question-container').innerHTML = ''; // 清空問題容器
        document.getElementById('question-container').appendChild(canvas); // 將 canvas 加入問題容器

        // 建立雷達圖
        const ctx = document.getElementById('radarChart').getContext('2d');
        const myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: titleNames,  
                datasets: [{
                    label: '您的健康評估',
                    data: Object.values(scores), // 使用後端回傳的 values 作為資料
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100, // 設定最大值
                        ticks: {
                            stepSize: 20 // 刻度間距
                        }
                    }
                }
            }
        });
    }
};

export default quizUI;
