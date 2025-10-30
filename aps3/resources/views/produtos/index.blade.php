<!DOCTYPE html>
<html>
<head>
    <title>Produtos</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>

    @if (session('success'))
        <p style='color: green;'>{{ session('success') }}</p>
    @endif

    <form action='/produtos' method='POST'>
        @csrf
        <input type='text' name='nome' placeholder='Nome do produto' required>
        <input type='number' step='0.01' name='preco' placeholder='Preço' required>
        <button type='submit'>Salvar</button>
    </form>

    <h2>Lista de Produtos</h2>
    <ul>
@foreach ($produtos as $produto)
    <li>{{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}</li>
@endforeach

    </ul>
</body>
</html>
