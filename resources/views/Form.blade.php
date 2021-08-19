<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário Store</title>
</head>
<body>

<h2>Editar Store</h2>

{{ $data->id }}

<form action="{{ url("api/update/{$data->id}") }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <label for="name_fantasy">Nome: </lab   el>
    <input type="text" name="name_fantasy" value="{{ $data['name_fantasy'] ?? ''}}">
    <input type="file" name="image">
    <input type="submit">
</form>
    <a href="{{ url('api/update/2') }}">Aqui</a>
</body>
</html>