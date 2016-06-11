<!DOCTYPE html>
<html>
<head>
    <title>Add product</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">

<nav class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::to('products') }}">Product Alert</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('products') }}">View All Products</a></li>
        <li><a href="{{ URL::to('products/create') }}">Create a Product</a>
    </ul>
</nav>

<h1>Create a Product</h1>

<!-- if there are creation errors, they will show here -->
@if (Session::get('errors'))
    {{ Html::ul($errors->all()) }}
@endif

{{ Form::open(array('url' => 'products')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('art', 'Article') }}
        {{ Form::text('art', old('art'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Create the Product!', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

</div>
</body>
</html>
