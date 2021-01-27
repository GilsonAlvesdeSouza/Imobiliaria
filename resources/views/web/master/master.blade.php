<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imobiliária</title>

    <link rel="stylesheet" href="{{ url(asset('web/assets/css/bootstrap.css')) }}">
    <link rel="stylesheet" href="{{ url(asset('web/assets/libs/libs.css')) }}">
    <link rel="stylesheet" href="{{ url(asset('web/assets/css/app.css')) }}">

    <link rel="icon" type="image/png" href="assets/images/favicon.png"/>
</head>
<body>

<header class="main_header">

    <div class="header_bar bg-front">
        <div class="container">
            <div class="row py-1 d-flex justify-content-md-around">

                <div class="d-none d-lg-flex col-lg-4 justify-content-center align-items-center p-2 text-white">
                    <i class="icon-location-arrow"></i>
                    <p class="my-auto ml-3">Avenida Pequeno Príncipe, 0 - Campeche<br/>Florianópolis/SC</p>
                </div>

                <div class="d-none d-md-flex col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-white">
                    <i class="icon-clock-o"></i>
                    <p class="my-auto ml-3">Seg/Sex: 09:00h - 18:00h<br/>Sáb/Dom: Plantão</p>
                </div>

                <div class="d-flex col-12 col-md-6 col-lg-4 justify-content-center align-items-center p-2 text-white mx-auto">
                    <i class="icon-envelope"></i>
                    <p class="my-auto ml-3">contato@minhaimob.com.br<br/>+55 (48) 3322-1234</p>
                </div>

            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light my-3">
        <div class="container">

            <div class="navbar-brand">
                <a href="index.php">
                    <h1 class="text-hide">Imobiliária</h1>
                    <img src="assets/images/logo.png" width="280" alt="Imobiliária" class="d-inline-block">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Menu Principal">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ route('web.home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="javascript:void(0)" class="nav-link text-front">Destaque</a></li>
                    <li class="nav-item"><a href="{{ route('web.rent') }}" class="nav-link">Alugar</a></li>
                    <li class="nav-item"><a href="{{ route('web.buy') }}" class="nav-link">Comprar</a></li>
                    <li class="nav-item"><a href="{{ route('web.contact') }}" class="nav-link">Contato</a></li>
                </ul>
            </div>

        </div>
    </nav>
</header>

@yield('content')

<article class="main_optin bg-dark text-white py-5">
    <div class="container">
        <div class="row mx-auto" style="max-width: 600px;">
            <h1>Quer ficar por dentro da novidades?</h1>

            <p>Deixe o seu nome e seu melhor e-mail nos campos abaixo e nós vamos lhe informar sobre os melhores
                negócios e todos os lançamentos do sul da ilha</p>

            <form action="">
                <input type="email" class="form-control" placeholder="Digite seu nome" size="50">
                <input type="email" class="form-control" placeholder="Digite seu melhor e-mail" size="50">
                <button type="submit" class="btn btn-front">Me avise!</button>
            </form>
        </div>
    </div>
</article>

<section class="main_footer bg-light"
         style="background: url(assets/images/footer.png) repeat-x bottom center; background-size: 10%;">
    <div class="container pt-5" style="padding-bottom: 120px;">

        <div class="row d-flex justify-content-around text-muted">

            <div class="col-12 col-md-3 col-lg-3">
                <h1 class="pb-2">Navegue <span class="text-front">Aqui!</span></h1>
                <ul>
                    <li><a href="{{ route('web.home') }}">Home</a></li>
                    <li><a href="javascript:void(0)" class="text-front">Destaque</a></li>
                    <li><a href="{{ route('web.rent') }}">Alugar</a></li>
                    <li><a href="{{ route('web.buy') }}">Comprar</a></li>
                    <li><a href="{{ route('web.contact') }}">Contato</a></li>
                </ul>
            </div>

            <div class="col-12 col-md-9 col-lg-6">
                <h1 class="pb-2">Nos <span class="text-front">Conheça!</span></h1>
                <p>Nossa maior satisfação é lhe ajudar a encontrar seu imóvel dos sonhos nos bairros do Sul da Ilha da
                    Magia, em Florianópolis.</p>

                <h1 class="pb-2">Quer <span class="text-front">Investir?</span></h1>
                <p>Entre em contato com a nossa equipe e vamos lhe informar sempre sobre os melhores negócios.</p>
            </div>

            <div class="col-12 col-md-12 col-lg-3 text-center">
                <button class="btn btn-front icon-facebook icon-notext"></button>
                <button class="btn btn-front icon-twitter icon-notext"></button>
                <button class="btn btn-front icon-instagram icon-notext"></button>
            </div>
        </div>
    </div>
</section>

<div class="main_copyright py-3 bg-front text-white text-center">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="mb-0">Imobiliária | CRECI 1234 | Avenida Pequeno Príncipe, 0 - Campeche Floripa/SC</p>
                <p class="mb-0">Todos os Direitos Reservados - UpInside Treinamentos ®</p>
            </div>
        </div>
    </div>
</div>

<script src="{{ url(asset('web/assets/js/jquery.js')) }}"></script>
<script src="{{ url(asset('web/assets/js/bootstrap.bundle.js')) }}"></script>
<script src="{{ url(asset('web/assets/libs/lightbox/ekko-lightbox.min.js')) }}"></script>
<script src="{{ url(asset('web/assets/js/libs.js')) }}"></script>
<script src="{{ url(asset('web/assets/js/scripts.js')) }}"></script>

<script>

    function markMap() {

        var locationJson = $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address=Rodovia+Doutor+Antonio+Luiz+Moura+Gonzaga,+3339+Florianopolis+Campeche&key=', function(response){
            console.log(response.results[0].geometry.location.lat);
            console.log(response.results[0].geometry.location.lng);

            lat = response.results[0].geometry.location.lat;
            lng = response.results[0].geometry.location.lng;

            var citymap = {
                property: {
                    center: {lat: lat, lng: lng},
                    population: 100
                }
            };

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: lat, lng: lng},
                mapTypeId: 'terrain'
            });

            for (var city in citymap) {
                var cityCircle = new google.maps.Circle({
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#FF0000',
                    fillOpacity: 0.35,
                    map: map,
                    center: citymap[city].center,
                    radius: Math.sqrt(citymap[city].population) * 100
                });
            }
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=markMap"></script>
</body>
</html>

