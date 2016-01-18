<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autenticación</title>

    <!-- Bootstrap -->
    <link href="<?=URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="well" style="margin-top: 200px;">
                <form method="post" role="form" action="/oauth">
                    <div class="form-group">
                        <img src="https://www.claveunica.cl/assets/img/logo.png">
                    </div>
                    <h2 class="form-signin-heading">Por favor, ingrese con su cuenta de ClaveUnica</h2>
                    <input type="submit" class="btn btn-lg btn-primary btn-block" value="Siguiente">
                </form>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?=URL::asset('bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<script src="<?=URL::asset('js/backend.js')?>"></script>
</body>
</html>
