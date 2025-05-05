<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 14px; }
        th { background-color: #f4f4f4; }
        h1 { font-size: 18px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h1 class="text-center">Daftar Siswa</h1>
    
    <table>
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siswa as $s)
                <tr>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas }}</td>
                    <td>
                        @switch($s->jurusan)
                            @case('br') Bisnis Ritel @break
                            @case('dkv1') Desain Komunikasi Visual 1 @break
                            @case('dkv2') Desain Komunikasi Visual 2 @break
                            @case('rpl') Rekayasa Perangkat Lunak @break
                            @case('mp') Manajemen Perkantoran @break
                            @case('ak') Akuntansi @break
                        @endswitch
                    </td>
                    <td>{{ ucfirst($s->jenis_kelamin) }}</td>
                    <td>{{ $s->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
