// quizMain.js
import quizApi from './quizApi.js';
import quizUI from './quizUI.js';
import quizLogic from './quizLogic.js';
import quizData from './quizData.js';

function initQuiz() {
    //取得勾選的goals
    let selectedGoals = JSON.parse(document.getElementById("goals").value);
    quizData.init(selectedGoals);
    //建立ajax請求
    quizApi.fetchQuestions(quizData.getSelectedGoals(), quizData.getCurrentQuestionIndex())
    .then(data => {
        if(data.noMoreQuestion){
            console.log('noMoreQuestion');
            return;
        }
        //取得所有問題
        quizData.setAllQuestions(data.allQuestions);
        //顯示第一題
        // 將後端傳來的 titleNames 傳遞給 quizUI.showQuestion
        quizUI.showQuestion(quizData.getCurrentQuestionIndex(),quizData.getAllQuestions(), data.isFirstQuestion, data.titleNames);
        //下一題
        window.nextQuestion = function () {
            quizLogic.nextQuestion();
        };

        //上一題
        window.previousQuestion = function () {
            quizLogic.previousQuestion();
        };
    })
    .catch(error => {
        console.error('發生錯誤:', error);
    });
}

initQuiz();
