<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Blogs</title>
    <meta http-equiv="refresh" content="0;url={{ route('blogs') }}">
    <script>
        window.location.replace(@json(route('blogs')));
    </script>
</head>
<body>
    <p>Redirecting to the latest Blogs & News page...</p>
    <p><a href="{{ route('blogs') }}">Continue to Blogs & News</a></p>
</body>
</html>
