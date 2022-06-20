<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <title>Company Name</title>
    <style>
        .logo {
            height: 20vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo h1 {
            padding: 10px;
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
        .tagline p {
            padding: 20px;
            text-align: center;
        }
        .number {
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .number-display {
            padding: 20px;
            letter-spacing: 0.3em;
            background: #ccc;
            color: rgb(91, 91, 91);
            text-align: center;
            text-transform: uppercase;
            font-size: 1.4em;
            font-weight: 600;
        }
        .numpad {
            background: #000;
            height: 100%;
            color: #fff
        }
        .numpad .col-4 {
            text-align: center;
            font-size: 1.3em;
            font-weight: 700;
            padding: 10px;
        }
        hr {
            border-bottom: 1px solid #fff;
            width: 90%;
        }
    </style>
  </head>
  <body>
    <div class="brand">
        <div class="logo">
            <h1>Your Logo Here</h1>
        </div>
        <div class="tagline">
            <p>Enter your mobile number to join!</p>
        </div>
    </div>
    <div class="number">
        <div class="number-display">
            Enter Number
        </div>
        <div class="numpad">
            <div class="container pt-3 pb-4">
                <div class="row">
                    <div class="col-4">1 <hr></div>
                    <div class="col-4">2 <hr></div>
                    <div class="col-4">3 <hr></div>
                </div>
                <div class="row">
                    <div class="col-4">4 <hr></div>
                    <div class="col-4">5 <hr></div>
                    <div class="col-4">6 <hr></div>
                </div>
                <div class="row">
                    <div class="col-4">7 <hr></div>
                    <div class="col-4">8 <hr></div>
                    <div class="col-4">9 <hr></div>
                </div>
                <div class="row">
                    <div class="col-4">Clear</div>
                    <div class="col-4">0</div>
                    <div class="col-4">Submit</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Essential javascripts for application to work-->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="/js/plugins/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if ($message = Session::get('message'))
            toastr.error('{{ $message }}')
        @endif
    </script>
  </body>
</html>