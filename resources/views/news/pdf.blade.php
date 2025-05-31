<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; line-height: 1.5; padding: 30px; }
        h1 { text-align: center; margin-bottom: 40px; }
        .content { white-space: pre-line; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="content">{!! nl2br(e($content)) !!}</div>
</body>
</html>
