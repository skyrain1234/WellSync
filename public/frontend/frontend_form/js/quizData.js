// quizData.js
const quizData = {
    allQuestions: [],
    userAnswers: {},
    selectedGoals: [],
    titleNames: [],
    currentQuestionIndex: 0,
    init: function(selectedGoals){
        this.selectedGoals = selectedGoals;
    },
    setAllQuestions: function(allQuestions){
        this.allQuestions = allQuestions;
    },
    getAllQuestions: function(){
        return this.allQuestions;
    },
    getCurrentQuestionIndex: function(){
        return this.currentQuestionIndex;
    },
    setCurrentQuestionIndex: function(index){
        this.currentQuestionIndex = index;
    },
    getUserAnswers: function(){
        return this.userAnswers;
    },
    addUserAnswer: function(questionId, answerData){
        this.userAnswers[questionId] = answerData; // 直接覆蓋，而不是新增
    },
    getSelectedGoals: function(){
        return this.selectedGoals;
    },
    setTitleNames: function(titleNames){
        this.titleNames = titleNames;
    },
    getTitleNames: function(){
        return this.titleNames;
    }
};

export default quizData;
