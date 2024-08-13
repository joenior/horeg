<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Music</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Upload Music File</h2>
        <form action="{{ route('music.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="musicFile">Choose MP3 file:</label>
                <input type="file" class="form-control-file" id="musicFile" name="musicFile" required>
            </div>
            <button type="submit" class="btn btn-primary">Upload and Process</button>
        </form>
    </div>
</body>
</html>
