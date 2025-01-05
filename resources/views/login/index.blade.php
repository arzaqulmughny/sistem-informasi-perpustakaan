<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ $pageTitle }}</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="bg-white shadow-lg d-flex rounded-lg overflow-hidden"
            style="max-width: 1000px; height: 350px; width: 100%;">
            <div style="width: 50%; height: 100%">
                <img src="{{ '/img/' . getSetting('app_cover') }}" alt=""
                    style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
            </div>

            <div class="d-flex flex-column justify-content-center align-items-center px-5"
                style="width: 50%; height: 100%; gap: 20px;">
                <div style="width: 40px; aspect-ratio: 1;">
                    <img src="{{ '/img/' . getSetting('app_icon') }}" alt=""
                        style="width: 100%; height: 100%; object-fit: cover; object-position: center">
                </div>
                <h1 class="text-center h5">{{ getSetting('app_name') }}</h1>

                <button id="show-login-button" type="button" class="btn btn-primary btn-sm"
                    onclick="showLogin()">Masuk</button>


                <form action="{{ route('authenticate') }}" method="POST" class="d-flex flex-column" id="login-form"
                    style="display: none !important; width: 100%;">
                    @csrf
                    <div class="form-group">
                        <input type="text" name='email'
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">

                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" name='password'
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            id="exampleInputPassword" placeholder="Kata Sandi">

                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        /**
         * Show login
         **/
        const showLogin = () => {
            $("#show-login-button").fadeOut();

            $('#login-form').delay(500).fadeIn(300).css('display', 'flex !important');
        }
    </script>
</body>

</html>
