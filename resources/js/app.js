import './bootstrap';

// フラッシュメッセージを1.5秒で消す処理
document.addEventListener('DOMContentLoaded', function () {
    const flashMessage = document.getElementById('flash-message');
    if (!flashMessage) return;

    setTimeout(function () {
        flashMessage.style.transition = 'opacity 0.5s ease';
        flashMessage.style.opacity = '0';

        setTimeout(function () {
            flashMessage.style.display = 'none';
        }, 500);
    }, 1500);
});