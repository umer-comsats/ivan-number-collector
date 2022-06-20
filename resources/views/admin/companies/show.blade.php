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
    <title>{{ $company->name }}</title>
    <style>
        body, html {
            height: 100vh;
        }
        .brand {
            height: 50vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
        }
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo h1 {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 10px 0;
        }
        .tagline {
            position: absolute;
            bottom: 0;
        }
        .tagline p {
            padding: 20px;
            text-align: center;
        }
        .number {
            height: 50vh;
            background: #000;
        }
        .number-display {
            height: 20%;
            letter-spacing: 0.3em;
            background: #ccc;
            color: rgb(91, 91, 91);
            text-transform: uppercase;
            font-size: 1.4em;
            font-weight: 600;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .numpad {
            background: #000;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 80%;
            color: #fff
        }
        .numpad .col-4 {
            text-align: center;
            font-size: 1.3em;
            font-weight: 700;
        }
        .col-4 {
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        hr {
            border-bottom: 1px solid #fff;
            width: 90%;
        }
    </style>
  </head>
  <body>
    <form class="login-form d-none" id="number">
        @csrf
        <input type="hidden" name="company_id" value="{{ $company->id }}">
        <input class="form-control" type="text" placeholder="Enter number" name="phone_number" id="phone_number" autofocus>
    </form>
    <div class="brand">
        <div class="logo">  
            @if (isset($company->logo_path))
            <img src="{{ asset('logo/'.$company->logo_path) }}" class="img-fluid" style="height: 100px;" alt="">
            @else
            <h1>{{ $company->name }}</h1>
            @endif
        </div>
        <div class="tagline">
            <p>{{ $company->action_line }}</p>
        </div>
    </div>
    <div class="number">
        <div class="number-display">
            Enter Number
        </div>
        <div class="numpad">
            <div class="container">
                <div class="row">
                    <div class="col-4">1<hr></div>
                    <div class="col-4">2<hr></div>
                    <div class="col-4">3<hr></div>
                </div>
                <div class="row">
                    <div class="col-4">4<hr></div>
                    <div class="col-4">5<hr></div>
                    <div class="col-4">6<hr></div>
                </div>
                <div class="row">
                    <div class="col-4">7<hr></div>
                    <div class="col-4">8<hr></div>
                    <div class="col-4">9<hr></div>
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
        $(".col-4").click(e => {
            let value = $(e.target).text();
            if(!isNaN(value)) {
                let current = $(".number-display");
                let currentText = $(".number-display").text();
                if(!isNaN(currentText)) {
                    current.text(currentText+value);
                    document.getElementById("phone_number").value = currentText+value;
                }else{
                    current.text(value);
                    document.getElementById("phone_number").value = value;
                }
            }else{
                if(value == "Clear") {
                    $(".number-display").text("Enter Number");
                    document.getElementById("phone_number").value = "";
                }else{
                    $.ajax({
                    url: '{{ route('admin.numbers.store') }}',
                    type: "POST",
                    data: $("#number").serialize(),
                    success: function(data) {
                        toastr.success(data.message);
                        $(".number-display").text("Enter Number");
                        document.getElementById("phone_number").value = "";
                    },
                    error: function(data) {
                        toastr.error(data.responseJSON.message)
                    }

                });
                }
            }
        })
    </script>
  </body>
</html>