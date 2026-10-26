<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Buku</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Penulis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->description }}</td>
                    <td>Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>{{ $book->author->name ?? '-' }}</td>
                </tr>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
