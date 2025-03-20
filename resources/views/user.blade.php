{{-- <!DOCTYPE html>
<html>
<body>
    <h1>Data User</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>Jumlah Pengguna</th>
        </tr>
        <tr>
            <td>{{ $jumlahPengguna }}</td>
        </tr>
    </table>
</body>
</html> --}}

{{-- <!DOCTYPE html>
<html>
<body>
    <h1>Data ID Level Pengguna</h1>
    @if($data->count() > 0)
        <table border="1" cellpadding="2" cellspacing="0">
            <tr>
                <th>ID Level Pengguna</th>
            </tr>
            @foreach($data as $user)
            <tr>
                <td>{{ $user->level_id }}</td>  
            </tr>
            @endforeach
        </table>
    @else
        <p>Tidak ada data user dengan level ID 2.</p>
    @endif
</body>
</html> --}}

<!DOCTYPE html>
<html>
<body>
    <h1>Data User</h1>
    <a href="/user/tambah">+Tambah User</a>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Nama</td>
            <td>ID Level Pengguna</td>
            <td>Aksi</td>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->level_id }}</td>
            <td><a href="/user/ubah/{{$d->user_id}}">Ubah</a> | <a href="/user/hapus/{{$d->user_id}}">Hapus</a></td>
        </tr>\
        @endforeach
    </table>  
</body>
</html>
