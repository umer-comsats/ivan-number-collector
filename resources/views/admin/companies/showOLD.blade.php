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
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
      </div>
      <div class="login-box">
        <form class="login-form" id="number" action="#" method="post">
            @csrf
            <input type="hidden" name="company_id" value="{{ $company->id }}">
            <p class="text-center"><img src="{{ asset('logo/'.$company->logo_path) }}" height="100" class="img-fluid" alt=""></p>
          <h3 class="login-head">{{ $company->name }}</h3>
          <div class="form-group">
            <label class="control-label">Enter your mobile number to join</label>
            <input class="form-control" type="number" placeholder="Enter number" name="phone_number" id="phone_number" autocomplete="off" autofocus>
          </div>
          <div class="form-group btn-container">
            <button class="btn btn-primary btn-block" type="button" onclick="sendNumber(this)"><i class="fa fa-sign-in fa-lg fa-fw"></i>Submit</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="/js/plugins/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        function sendNumber(e) {
            e.preventDefault;
            $.ajax({
                url: '{{ route('admin.numbers.store') }}',
                type: "POST",
                data: $("#number").serialize(),
                success: function(data) {
                    toastr.success(data.message);
                    $("#phone_number").val("")
                },
                error: function(data) {
                    toastr.error(data.responseJSON.message)
                }

            });
        }
        
    </script>
  </body>
</html>