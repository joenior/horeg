<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Music</title>
    <link href="https://cdn.jsdelivr.net/gh/rajnandan1/brutopia@latest/dist/assets/compiled/css/app.css" rel="stylesheet" crossorigin="anonymous">
    <style>
        body {
            background-color: #E2E2E2;
        }
        </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 col-md-9 col-sm-12">
                <div class="card">
                    <div class="card-header h1">
                        Sound Horeg Generator <span class="badge bg-primary">BETA</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">rasakan pengalaman sound horeg dengan lagu favoritmu!</h5>
                        <p class="card-text">    
                            <form id="uploadForm" action="{{ route('music.process') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="musicFile">pilih lagu favoritmu (hanya mp3)</label></br>
                                    <input type="file" class="form-control-file" id="musicFile" name="musicFile" required>
                                </div>
                                <button type="submit" class="btn btn-primary" id="uploadButton">plis horegkan dulu le 😹</button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                  <p>
                    frequently asked questions:
                  </p>
                  <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          project ini dibikin pake apa aja le?
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                          <strong>tentu saja pakai php dan laravel.</strong>
                          sederhana saja, pakai laravel untuk backend dan bootstrap versi mod biar mirip saweria untuk frontend (brutopia css). lagunya diproses pakai ffmpeg, ditambahin efek bass boost biar makin horeg 😎
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          kalau lagunya diupload, berarti atmin bisa liat lagu yang diupload ya?
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" style="">
                        <div class="accordion-body">
                          <strong>nggaklah jir. 😹</strong>
                          udah pake metode respons deleteFileAfterSend, kok. jadi lagu yang diupload bakal kehapus setelah dihoregkan. tujuannya supaya lagu yang diupload ga ngejelimet disk space 😹
                          <center><iframe
  src="https://carbon.now.sh/embed?bg=rgba%28255%2C255%2C255%2C1%29&t=panda-syntax&wt=none&l=auto&width=490&ds=false&dsyoff=20px&dsblur=68px&wc=true&wa=false&pv=56px&ph=56px&ln=false&fl=1&fm=Monoid&fs=12px&lh=164%25&si=false&es=2x&wm=false&code=%252F%252F%2520ini%2520bukti%2520controllernya%2520%25F0%259F%2598%25B9%25F0%259F%2591%2587%2520%2520%2520%2520%2520%2520%2520%2520%250A%2509%2509Storage%253A%253Adisk%28%27local%27%29-%253Edelete%28%2524filePath%29%253B%250A%2520%2520%2520%2520%2520%2520%2520%2520return%2520response%28%29-%253Edownload%28storage_path%28%2522app%252F%2524outputPath%2522%29%29-%253EdeleteFileAfterSend%28true%29%253B"
  style="width: 490px; height: 304px; border:0; transform: scale(1); overflow:hidden;"
  sandbox="allow-scripts allow-same-origin">
</iframe></center>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          kok isi webnya cuman ini aja?
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <strong>ya iyalah le, kan masih beta. 🥲</strong>
                          ntar kalau ada saran ide, tolong dikasih tau ya.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
        </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast1" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">cek notip</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                kok kamu upload file selain mp3? tolong upload ymma (yang mp3 mp3 aja)
            </div>
        </div>
        <div id="liveToast2" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">cek notip</strong>
                <small>5 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                format file tidak didukung jir, tolong itunya dianuin dulu
            </div>
        </div>
        <div id="liveToast3" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">cek notip</strong>
                <small>just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                pliss wok, aku mau format file mp3 gratis
            </div>
        </div>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            var fileInput = document.getElementById('musicFile');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.mp3)$/i;
            var toasts = [
                document.getElementById('liveToast1'),
                document.getElementById('liveToast2'),
                document.getElementById('liveToast3')
            ];

            if (!allowedExtensions.exec(filePath)) {
                event.preventDefault();
                var randomToast = toasts[Math.floor(Math.random() * toasts.length)];
                var toast = new bootstrap.Toast(randomToast);
                toast.show();
                fileInput.value = '';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>