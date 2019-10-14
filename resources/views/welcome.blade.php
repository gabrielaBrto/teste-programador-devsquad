<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">      
    </head>
    <body>
        <div class="top-left header">
            <img src="{{asset('img/logo.svg')}}" alt="">
        </div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="imagem">
                    <img src="{{asset('img/austin-distel-wawEfYdpkag-unsplash.png')}}" alt="">
                    <div class="texto">
                        <span>Fast and Simple,</span>
                        <span>Unsecured</span>
                        <span>funding.</span>
                    </div>
                    <div class="conteudo">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi sint voluptate architecto, quidem ab aliquam. Cupiditate sequi non officiis voluptates ad exercitationem rem beatae quod laboriosam, dicta aperiam inventore quo.
                    </div>
                    <div class="button">
                        <button class="button">Apply Now</button>
                    </div>
                    <div class="conteudo2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut molestiae atque inventore nisi dicta dolores veritatis, esse fugit ducimus amet non corrupti aliquam vitae quam doloribus obcaecati voluptatibus numquam eligendi?
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="texto-bold">
                Getting <span>capital</span> for your business is complicated
            </div>
            <div class="texto-bold2">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </div>
        </div>
    </body>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
