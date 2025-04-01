// quizApi.js
import quizUI from './quizUI.js';

const quizApi = {
    fetchQuestions: function (selectedGoals, currentQuestionIndex) {
        const url = '/showQuestions';
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                goals: selectedGoals,
                currentQuestionIndex: currentQuestionIndex
            })
        })
        .then(response => response.json());
    },

    submitAnswers: function (userAnswers) {
        const url = '/submitAnswers';
        const formattedAnswers = {};
        for (const questionId in userAnswers) {
            formattedAnswers[questionId] = {
                answer: userAnswers[questionId].answer,
                values: userAnswers[questionId].values, // 傳送 values[0]~values[4]
                weights: userAnswers[questionId].weights // 傳送 weights[0]~weights[4]
            };
        }
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                answers: formattedAnswers // 使用格式化後的答案
            })
        })
        .then(response => response.json())
        .then(data => {
            // 將 averageScores 和 titleNames 儲存到 localStorage
            localStorage.setItem('averageScores', JSON.stringify(data.averageScores));
            localStorage.setItem('titleNames', JSON.stringify(data.titleNames));
            // 將 averageScores 和 titleNames 返回
            return { averageScores: data.averageScores, titleNames: data.titleNames };
        });
    }
};

export default quizApi;
