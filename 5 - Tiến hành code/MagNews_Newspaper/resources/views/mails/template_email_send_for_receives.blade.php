<html>
<head>
    <title>Activation Email - Allaravel.com</title>
</head>
<body>
    @foreach($data_post as $item)
    <p>
        {{ $item->title_post}}
    </p>
    @endforeach
</body>
</html>