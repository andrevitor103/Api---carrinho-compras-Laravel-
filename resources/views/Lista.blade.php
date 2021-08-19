<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Store</title>
</head>
<body>

    @if ($data->links())
            {{ print_r('oii') }}
    @else
            {{ print_r('Erro') }}
    @endif

    <h2>Óla mundo Laravel ...</h2>
    <form action="{{ url("lista/filter") }}" method="post">
        @csrf
        <input type="text" name="search" id="search">
        <input type="submit" value="filtrar">
    </form>
    <table>
        <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <tr>
        @forelse ($data as  $datas)
            <td><img src="{{ url("storage/{$datas->image}") }}" alt="" style="width: 60px;" /></td>
            <td>{{ $datas['name_fantasy'] }}</td>
            <td>{{ $datas['email'] }}</td>
            <td> <a href="{{ route('edit.lista',$datas->id) }}"><button>Editar</button></a> </td>
            </tr>
        @empty
            <td>Sem dados</td>
        @endforelse
        </tbody>
    </table>
    
    @if (isset($filters))
        {{ $data->appends($filters)->links() }}
    @else
        {{ $data->links() }}
    @endif

    <a href="{{ route('lista2') }}"><button class="btn btn-primary">Editar</button></a>
</body>
</html>

