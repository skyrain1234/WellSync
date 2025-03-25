@extends('frontend.layouts.form_master')
@section('title')
WellSync免費評估
@endsection

@section('content')

    <div class="form-container">
        <h2>免費評估</h2>
        <form id="assessmentForm">
            
            <div class="form-group">
                <h5>有無吃過保健食品？</h5>
                <div class="radio-group">
                    
                    <label>
                        <input type="radio" name="supplement_taken" value="yes" required> 有
                    </label>
                    <label>
                        <input type="radio" name="supplement_taken" value="no" required> 無
                    </label>
                </div>
            </div>

            <div class="form-group">
                <h5>目前服用幾種保健食品？</h5>
                <select name="supplement_count" required>
                    <option value="0">0</option>
                    <option value="1-2">1-2</option>
                    <option value="3-5">3-5</option>
                    <option value="5+">5+</option>
                </select>
            </div>

            <div class="form-group">
                <h5>服用保健食品的頻率？</h5>
                <select name="supplement_frequency" required>
                    <option value="never">沒有在吃</option>
                    <option value="sometimes">想到才吃</option>
                    <option value="often">會吃但偶爾會忘</option>
                    <option value="daily">幾乎每天服用</option>
                </select>
            </div>

            <div class="form-group">
                <h5>生理性別</h5>
                <select name="gender" required>
                    <option value="male">男</option>
                    <option value="female">女</option>
                </select>
            </div>

            <div class="form-group">
                <h5>生理年齡</h5>
                <div class="age-container">
                    <input type="number" id="year" class="small-input" name="year" min="1900" max="2025" placeholder="年" required>
                    <input type="number" id="month" class="small-input" name="month" min="1" max="12" placeholder="月" required>
                    <input type="number" id="day" class="small-input" name="day" min="1" max="31" placeholder="日" required>
                </div>
            </div>
            <p>年齡： <span id="calculatedAge">尚未計算</span></p>

            <div class="form-group">
                <h5>職業</h5>
                <input type="text" name="occupation" required>
            </div>
 
            <button type="button" class="submit-btn" id="submit-btn">
                <span class="submit-text">下一題</span>
            </button>
  
        </form>

        <!-- 彈跳視窗 -->
        <div class="popup-container" id="popup">
            <div class="popup-box">
                <p>請填寫所有必填欄位！</p>
                <button class="popup-confirm" id="popupConfirm">確定</button>
            </div>
        </div>
    </div>
    
    <script type="module" src="{{asset('frontend/frontend_form/js/form.js')}}"></script>
    <script type="module" src="{{asset('frontend/frontend_form/js/popup.js')}}"></script>
@endsection