<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác minh Email</title>
</head>
<body>
    <h2>Xin chào, {{ $user->name }}</h2>
    <p>Mã xác minh của bạn là: <strong>{{ $code }}</strong></p>
    <p>Vui lòng nhập mã này vào trang xác minh email của chúng tôi để hoàn tất quá trình.</p>
</body>
</html>
