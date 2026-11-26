<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <p>ウェブサイトのお問い合わせフォームからメッセージが送信されました。</p>
    
    <p><strong>お名前:</strong> {{ $contact['name'] }}</p>
    <p><strong>メールアドレス:</strong> {{ $contact['email'] }}</p>
    <p><strong>お問い合わせ内容:</strong></p>
    <p>{{ $contact['message'] }}</p>
</body>
</html>