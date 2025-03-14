<!DOCTYPE html>
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
</html>

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

{{-- <!DOCTYPE html>
<html>
<body>
    <h1>Data User</h1>
    @if($data->count() > 0)
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr>
        @foreach($data as $user)
        <tr>
            <td>{{ $user->user_id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ $user->level_id }}</td>
        </tr>
        @endforeach
    </table>
    @else
    <p>Tidak ada data user dengan level ID 2.</p>
@endif
</body>
</html> --}}
