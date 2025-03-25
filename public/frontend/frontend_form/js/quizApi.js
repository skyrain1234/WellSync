// quizApi.js
import quizUI from './quizUI.js';

const quizApi = {
    fetchQuestions: function (selectedGoals, currentQuestionIndex) {
        const url = '/front/showQuestions';
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
        const url = '/front/submitAnswers';
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
            quizUI.createRadarChart(data.averageScores, data.titleNames); // 修改：傳遞 titleNames
            return data; // 確保返回數據
        });
    }
};

export default quizApi;
