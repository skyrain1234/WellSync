
// quizUI.js
import quizLogic from './quizLogic.js';
import quizData from './quizData.js';

const quizUI = {
    showQuestion: function (currentQuestionIndex, allQuestions, isFirstQuestion, titleNames) {
        quizData.setTitleNames(titleNames);
        const questionContainer = document.getElementById("question-container");
        questionContainer.innerHTML = "";

        if (currentQuestionIndex >= allQuestions.length) {
            console.log('noMoreQuestion');
            return;
        }

        const currentQuestion = allQuestions[currentQuestionIndex];
        if (!currentQuestion) {
            console.error('currentQuestion is undefined. currentQuestionIndex:', currentQuestionIndex, 'allQuestions:', allQuestions);
            return;
        }

        document.getElementById('question-title').textContent = `問題（目前：第 ${currentQuestionIndex + 1} 題）`;

        const form = document.createElement('form');
        form.setAttribute('id', 'question-form');
        questionContainer.appendChild(form);

        const currentQuestionIndexInput = document.createElement('input');
        currentQuestionIndexInput.setAttribute('type', 'hidden');
        currentQuestionIndexInput.setAttribute('name', 'currentQuestionIndex');
        currentQuestionIndexInput.setAttribute('id', 'current-question-index');
        currentQuestionIndexInput.setAttribute('value', currentQuestionIndex);
        form.appendChild(currentQuestionIndexInput);

        const questionDiv = document.createElement('div');
        questionDiv.textContent = currentQuestion.question;
        form.appendChild(questionDiv);

        currentQuestion.options.forEach(function (option) {
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('goal-item');

            const radio = document.createElement('input');
            radio.setAttribute('type', 'radio');
            radio.setAttribute('id', `option-${option.value}`);
            radio.setAttribute('name', `options[]`);
            radio.setAttribute('value', option.value);

            const userAnswer = quizData.getUserAnswers()[currentQuestion.id];
            if (userAnswer && userAnswer.answer === option.value) {
                radio.checked = true;
                optionDiv.classList.add('selected');
            }

            radio.addEventListener('click', function () {
                quizLogic.collectAnswers();
                const allOptionDivs = form.querySelectorAll('.goal-item');
                allOptionDivs.forEach(div => div.classList.remove('selected'));
                optionDiv.classList.add('selected');
            });

            const label = document.createElement('label');
            label.setAttribute('for', `option-${option.value}`);
            const span = document.createElement('span');
            span.textContent = option.label;
            label.appendChild(span);
            optionDiv.appendChild(radio);
            optionDiv.appendChild(label);
            form.appendChild(optionDiv);
        });

        const prevButton = document.getElementById('prev-question');
        prevButton.style.display = isFirstQuestion ? 'none' : 'block';
    },

    createRadarChart: function (scores, titleNames) {
        // 取得 canvas 元素
        const canvas = document.createElement('canvas');
        canvas.id = 'radarChart';
        // 限制 Canvas 大小（例如：寬 400px，高 400px）
        canvas.width = 400;
        canvas.height = 400;
        document.getElementById('question-container').innerHTML = ''; // 清空問題容器
        document.getElementById('question-container').appendChild(canvas); // 將 canvas 加入問題容器

        // 建立雷達圖
        const ctx = document.getElementById('radarChart').getContext('2d');
        let hue = 0; // 控制顏色變化的角度
        const myRadarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: titleNames,  
                datasets: [{
                    label: '您的健康評估',
                    data: Object.values(scores), // 使用後端回傳的 values 作為資料
                    backgroundColor: `hsla(${hue}, 100%, 50%, 0.3)`, // 初始填充色
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: '#2E5D45',
                            font: {
                                size: 24,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 100, // 設定最大值
                        ticks: {
                            stepSize: 20,
                            color: () => {
                                
                                return 'rgb(104, 104, 104)';
                            },
                            font: {
                                size: 16, // 字體大小
                                weight: 'bold' // 加粗
                            },
                            backdropColor: 'rgba(207, 206, 206, 0)', // 背景半透明
                            borderWidth: 1, // 邊框
                            borderColor: 'rgba(0, 0, 0, 0.2)' // 淺色邊框
                        },
                        grid: {
                            color: 'rgba(0, 128, 0, 0.3)'
                        },
                        angleLines: {
                            color: 'rgba(0, 128, 0, 0.5)'
                        },
                        pointLabels: {
                            color: '#2E5D45',
                            font: {
                                size: 20,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });
        setInterval(() => {
            hue = (hue + 2) % 360; // 色相循環變化
            myRadarChart.data.datasets[0].backgroundColor = `hsla(${hue}, 100%, 50%, 0.3)`;
            myRadarChart.update(); // 更新圖表
        }, 100);
        setTimeout(() => {
            if (!document.getElementById('product-recommendations')) {
                const recommendationsDiv = document.createElement('div');
                recommendationsDiv.id = 'product-recommendations';

                const sortedTitles = Object.entries(scores)
                    .sort((a, b) => a[1] - b[1])
                    .slice(0, 2)
                    .map(([key], index) => titleNames[parseInt(key.replace('角', '')) - 1]);

                fetch('/recommend-products', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ 
                        categories: sortedTitles, 
                        averageScores: Object.values(scores) 
                    })
                })
                    .then(response => response.json())

                    .catch(error => {
                        console.error('載入推薦商品錯誤:', error);
                        recommendationsDiv.innerHTML = '<p>載入推薦商品時發生錯誤。</p>';
                    });
            } // if 結尾
        }, 300);
    }
};

export default quizUI;
