@extends('frontend.layouts.form_master')
@section('title')
WellSync免費評估
@endsection

@section('content')
    <!-- 表單容器 -->
    <div class="form-container" id="form-container">
        <!-- 返回按鈕 -->
        <button class="back-btn" onclick="goBack()">上一頁</button>
        <h2 id="question-title">選擇您想保健的目標方向</h2>
        <hr class="separator" />
        <form action="{{ route('questions.view') }}" method="GET" id="form">
            @csrf
            <!-- 目標列表 -->
            <div id="goal-container" class="row">
                @foreach ($formGoals as $formGoal)
                    <div class="goal-item col-xl-3 col-md-4 col-sm-6 col-12">
                        <!-- id="goal-{{ $formGoal->id }}"為每個複選框設定唯一的 ID，方便與 label 關聯。 -->
                        <input type="checkbox" id="goal-{{ $formGoal->id }}" name="goals[]" value="{{ $formGoal->id }}">
                        <label for="goal-{{ $formGoal->id }}">
                            <span>{{ $formGoal->goal_name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

            <!-- 下一題按鈕 -->
            <button type="submit" class="submit-btn">下一題</button>
        </form>
    </div>
    <script>
        
        // 返回上一頁按鈕
        function goBack(){
            history.back(); 
        }
    </script>
@endsection
