@extends('frontend.layouts.form_master')
@section('title')
    問題頁面
@endsection

@section('content')
    <!-- 表單容器 -->
    <div class="form-container" id="form-container">
        <!-- 返回按鈕 -->
        <button id ="prev-question" class="back-btn" onclick="previousQuestion()">上一頁</button>
        <h2 id="question-title">問題（目前：第 1 題）</h2>
        <hr class="separator" />
        <form action="#" method="post" id="question-form">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div id="question-container" class="text-center" data-selected-goals="{{ json_encode($selectedGoals) }}">
                <!-- 問題與選項會動態填入這裡 -->
                
            </div>

            <!-- 隱藏的選擇結果輸入框 -->
            <input type="hidden" name="selected_options" id="selected-options">
            <!-- 選擇目標的隱藏輸入框 -->
            <input type="hidden" name="goals" id="goals" value="{{ json_encode($selectedGoals) }}">

            <!-- 下一題按鈕 -->
            <button type="button" class="submit-btn" onclick="nextQuestion()">下一題</button>
        </form>
    </div>

    <!-- 彈跳視窗 -->
    <div class="popup-container" id="popup">
        <div class="popup-box">
            <p>請選擇一個選項！</p>
            <button class="popup-confirm" id="popupConfirm">確定</button>
        </div>
    </div>
    <script type="module" src="{{asset('frontend/frontend_form/js/quizMain.js')}}"></script>
    <script type="module" src="{{asset('frontend/frontend_form/js/popup.js')}}"></script>
    
@endsection
