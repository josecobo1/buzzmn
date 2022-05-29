<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    <link rel="stylesheet" href="//unpkg.com/bootstrap@3.3.7/dist/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select@1.12.4/dist/css/bootstrap-select.min.css"
        type="text/css" />
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css"
        type="text/css" />

    <script src="//unpkg.com/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="//unpkg.com/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="//unpkg.com/bootstrap-select@1.12.4/dist/js/bootstrap-select.min.js"></script>
    <script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>


</head>

<body class="container">
    <main class="p-5">
        <div class="row">
            {{-- Form --}}
            <form onSubmit="checkWeather(event)" class="col p-3 d-flex flex-wrap justify-content-around">
                <div class="col-12 d-flex flex-wrap">
                    <div class="mb-3 p-1 flex-grow-1">
                        <label for="cp" class="form-label">Código postal</label>
                        <input type="number" class="form-control" name="cp">
                    </div>

                    <div class="mb-3 p-1 flex-grow-1">
                        <label for="state" class="form-label">País</label>
                        <select class="selectpicker countrypicker form-control" data-flag="true" data-default="ES"
                            name="state"></select>
                    </div>
                </div>
                <div class="col-12 p-3 d-flex justify-content-center">
                    <button type="submit" class="btn btn-orange btn-lg">Consultar</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col">
                {{-- Loading spinner --}}
                <div id="loader-spinner" class="d-none">
                    @include('home.loading')
                </div>

                {{-- Error --}}
                <div id="error" class="d-none">
                    @include('home.error')
                </div>

                {{-- Content --}}
                <div id='forecast' class="d-none fade-in-animation">
                    <div class="forecast-today">
                        <div class="row text-center">
                            <div class="col">
                                <p class="h3 text-capitalize" id='city'></p>
                            </div>
                        </div>
                        <div class="row justify-content-center text-center">
                            <div class="col">
                                <p class="xl-text" id='temp'>&#8451;</p>
                                <p class="h3 text-capitalize" id='weather'></p>
                                <img src="" alt="weather-icon" id='icon'>
                            </div>
                        </div>
                        <div class="max-min row justify-content-center text-center">
                            <div class="col">
                                <p class="h6" id='max-temp'></p>
                            </div>
                            <div class="col">
                                <p class="h6" id='min-temp'></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        $('.countrypicker').countrypicker();
    </script>
    <script src="js/weather.js">
    </script>
</body>

</html>