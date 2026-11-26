import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    // 1. フラッシュメッセージを1.5秒で消す処理
    const flashMessage = document.getElementById('flash-message');
    if (flashMessage) {
        setTimeout(function () {
            flashMessage.style.transition = 'opacity 0.5s ease';
            flashMessage.style.opacity = '0';

            setTimeout(function () {
                flashMessage.style.display = 'none';
            }, 500);
        }, 1500);
    }

    // 2. いいねボタンの非同期トグル処理
    const likeBtn = document.getElementById('like-btn');
    if (likeBtn) {
        likeBtn.addEventListener('click', async function () {
            const url = likeBtn.dataset.url;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            likeBtn.disabled = true;

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!response.ok) {
                    throw new Error('通信エラーが発生しました');
                }

                const data = await response.json();
                const likeIcon = document.getElementById('like-icon');
                const likeCount = document.getElementById('like-count');

                // いいね状態に応じてハートの色を変更
                if (likeIcon) {
                    likeIcon.style.color = data.liked ? 'red' : '#ccc';
                }

                // いいね数を更新
                if (likeCount) {
                    likeCount.textContent = data.likes_count;
                }
            } catch (error) {
                console.error(error);
                alert('いいねの処理に失敗しました。');
            } finally {
                likeBtn.disabled = false;
            }
        });
    }
});