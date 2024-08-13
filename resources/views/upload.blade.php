<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Music</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Pusher.logToConsole = true;

            var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
                cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
                forceTLS: true
            });

            var channel = pusher.subscribe('music-processing');
            channel.bind('App\\Events\\MusicProcessingProgress', function(data) {
                var progressText = 'Progress: ' + data.progress + '%';
                document.getElementById('progress').innerText = progressText;
                toastr.info(progressText);
            });
        });
    </script>
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
        <div id="progress" class="mt-3"></div>
    </div>
</body>
</html>