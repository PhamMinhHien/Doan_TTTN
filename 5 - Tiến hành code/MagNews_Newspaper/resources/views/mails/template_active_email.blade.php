<html>
<head>
    <title>Activation Email - MAGNEWS </title>
</head>
<body>
    <p>
        Chào mừng : {{ $email_receive->email }}  đã đăng ký nhận tin tức cập nhật trên trang web Magnews . Bạn hãy click vào đường link sau đây để hoàn tất việc xác nhận đăng ký để nhận tin : 
        {{ $email_receive->activation_link}}
    </p>
</body>
</html>