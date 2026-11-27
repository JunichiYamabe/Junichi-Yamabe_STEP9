<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>お問い合わせ通知</title>
</head>
<body>
    <h2>お問い合わせ内容</h2>
    <p><strong>名前：</strong> {{ $contact['name'] ?? '' }}</p>
    <p><strong>メールアドレス：</strong> {{ $contact['email'] ?? '' }}</p>
    <p><strong>メッセージ：</strong></p>
    <p>{!! nl2br(e($contact['message'] ?? '')) !!}</p>
    <p>システム管理者より</p>
</body>
</html>