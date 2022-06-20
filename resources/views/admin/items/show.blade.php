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
    <title>Select Items</title>
    <style>
        .material-half-bg .cover {
            background-color: #292929;
        }
        .box {
            min-width: 300px;
        }
    </style>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
      </div>
      <div class="box bg-white p-5">
        <form class="login-form" id="number" action="{{ route('admin.numbers.store_item') }}" method="post">
            @csrf
            <input type="hidden" name="number_id" value="{{ $number_id }}">
          <h3 class="login-head">Select Items</h3>
          @foreach ($company->items as $item)
          <div class="animated-checkbox">
            <label>
              <input type="checkbox" name="items[]" value="{{ $item->name }}"><span class="label-text">{{ $item->name }}</span>
            </label>
          </div>
          @endforeach
          <div class="form-group btn-container mt-3">
            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Submit</button>
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
        
    </script>
  </body>
</html>