
// navbar交互
function navbar() {
    const debounce = (func, wait) => {
        let timeout;
        return function (...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    };

    // 滾動事件
    $(window).on(
        "scroll",
        debounce(function () {
            let scrollTop = $(this).scrollTop();
            let windowHeight = $(window).height();
            
            // 切換導航欄樣式
            if (scrollTop > 0) {
                $(".navbar").addClass("scrolled");
                $(".bg-btn-navbar").addClass("scrolled");
            } else {
                $(".navbar").removeClass("scrolled");
                $(".bg-btn-navbar").removeClass("scrolled");
                $(".navbar-collapse").removeClass("show");
            }
        }, 50)
    );

    // 導航欄展開/收起切換
    $(".navbar-toggler").on("click", function () {
        if ($(window).scrollTop() === 0) {
            if ($(this).attr("aria-expanded") === "true") {
                $(".navbar").addClass("scrolled");
                $(".bg-btn-navbar").addClass("scrolled");
            } else {
                $(".navbar").removeClass("scrolled");
                $(".bg-btn-navbar").removeClass("scrolled");
            }
        }
    });
}


