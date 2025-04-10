// quizLogic.js
import quizData from './quizData.js';
import quizUI from './quizUI.js';
import quizApi from './quizApi.js';
import popupModule from './popup.js'; 

const quizLogic = {
    init: function (selectedGoals) {
        quizApi.fetchQuestions(selectedGoals) // 移除 currentQuestionIndex 參數
            .then(data => {
                if (data.error) {
                    console.error('發生錯誤:', data.error);
                    alert(data.error); // 顯示錯誤訊息
                    return;
                }
                if (data.noMoreQuestion) {
                    console.log('noMoreQuestion');
                    return;
                }
                if (!data.allQuestions || !Array.isArray(data.allQuestions)) {
                    console.error('allQuestions 資料不正確:', data.allQuestions);
                    alert('題目資料錯誤，請稍後再試！');
                    return;
                }
                quizData.setAllQuestions(data.allQuestions);
                quizUI.showQuestion(quizData.getCurrentQuestionIndex(), quizData.getAllQuestions());
            })
            .catch(error => {
                console.error('發生錯誤:', error);
                alert('發生未知錯誤，請稍後再試！'); // 顯示錯誤訊息
            });
    },
    checkAnswer: function () {
        const form = document.getElementById('question-form');
        const selectedOption = form.querySelector('input[name="options[]"]:checked');
        if (!selectedOption) {
            // 如果沒有選擇任何選項，顯示彈跳視窗
            // const popup = document.getElementById('popup'); // 移除這行
            popupModule.popup.style.display = 'flex'; // 讓彈跳視窗顯示出來
            return false;
        }
        return true;
    },

    collectAnswers: function () {
        const form = document.getElementById('question-form');
        const selectedOption = form.querySelector('input[name="options[]"]:checked');
        const currentQuestionIndex = quizData.getCurrentQuestionIndex();
        const allQuestions = quizData.getAllQuestions(); // 取得所有問題
        const currentQuestion = quizData.getAllQuestions()[currentQuestionIndex];

        // 檢查 currentQuestion 是否存在
        if (!currentQuestion) {
            console.error('currentQuestion is undefined. currentQuestionIndex:', currentQuestionIndex, 'allQuestions:', allQuestions);
            return; // 如果 currentQuestion 不存在，直接返回，不執行後續程式碼
        }

        if (selectedOption) {
            const questionId = currentQuestion.id;
            const answer = selectedOption.value;
            // 找到被選中的選項
            const selectedOptionData = currentQuestion.options.find(option => option.value === answer);
            // 取得題目的分類權重
            const titleWeights = currentQuestion.weights;
            // 取得選項的數值
            const optionValues = selectedOptionData.values;
            // 在 console 中顯示權重
            // console.log(`問題 ${questionId} 的答案 ${answer} 的權重是 ${titleWeights.weight_1},${titleWeights.weight_2},${titleWeights.weight_3},${titleWeights.weight_4},${titleWeights.weight_5}`);
            // 在 console 中顯示數值
            // console.log(`問題 ${questionId} 的答案 ${answer} 的數值是 ${optionValues[0]},${optionValues[1]},${optionValues[2]},${optionValues[3]},${optionValues[4]}`);
            //儲存答案
            quizData.addUserAnswer(questionId, {
                answer: answer,
                values: optionValues,
                weights: titleWeights
            });
        }
    },
    nextQuestion: function () {
        //先檢查是否有選擇答案
        if (!this.checkAnswer()) {
            return;
        }
        //收集答案
        this.collectAnswers();
        //將目前第幾題+1
        let currentQuestionIndex = quizData.getCurrentQuestionIndex();
        currentQuestionIndex++;
        // 將目前的題數更新到html上
        quizData.setCurrentQuestionIndex(currentQuestionIndex);
        // 檢查是否是最後一題
        if (currentQuestionIndex >= quizData.getAllQuestions().length) {
            //如果是最後一題，就送出答案並計算總分並顯示雷達圖
            quizApi.submitAnswers(quizData.getUserAnswers(), true) // 傳遞 true 表示是最後一次提交
                .then(data => {
                    console.log('答案已送出:', data);
                    // 這裡可以根據後端回傳的資料進行後續處理，例如顯示結果
                    quizUI.createRadarChart(data.averageScores, data.titleNames);
                    // 清除 userAnswers
                    quizData.userAnswers = {};
                    // 清除 currentQuestionIndex
                    quizData.currentQuestionIndex = 0;
                })
                .catch(error => {
                    console.error('發生錯誤:', error);
                });
                $("#next-question").addClass("d-none");
                $("#last-question").removeClass("d-none");
                Swal.fire({
                    title: "已將推薦商品加入購物車",
                    icon: "success",
                    footer: '<a href="/cart"><button class="btn btn-success">前往購物車</button></a>'
                  });
        } else {
            // 否則，顯示下一題
            quizUI.showQuestion(currentQuestionIndex, quizData.getAllQuestions());
            //判斷是否為第一題
            const isFirstQuestion = currentQuestionIndex === 0;
            quizUI.showQuestion(currentQuestionIndex, quizData.getAllQuestions(), isFirstQuestion, quizData.getTitleNames());
        }
    },
    previousQuestion: function () {
        //將目前第幾題-1
        let currentQuestionIndex = quizData.getCurrentQuestionIndex();
        currentQuestionIndex--;
        // 將目前的題數更新到html上
        quizData.setCurrentQuestionIndex(currentQuestionIndex);
        //顯示題目
        quizUI.showQuestion(currentQuestionIndex, quizData.getAllQuestions());
        //判斷是否為第一題
        const isFirstQuestion = currentQuestionIndex === 0;
        quizUI.showQuestion(currentQuestionIndex, quizData.getAllQuestions(), isFirstQuestion);
    },

    checkAnswer: function () {
        const form = document.getElementById('question-form');
        const selectedOption = form.querySelector('input[name="options[]"]:checked');
        if (!selectedOption) {
            // 如果沒有選擇任何選項，顯示彈跳視窗
            // const popup = document.getElementById('popup'); // 移除這行
            popupModule.popup.style.display = 'flex'; // 讓彈跳視窗顯示出來
            return false;
        }
        return true;
    },
};

export default quizLogic;
