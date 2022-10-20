<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Crud Laravel</title>
</head>
{{-- <style>
    body {
        width: 100vw;
        height: 100vh;
        margin: 0;
        padding: 0;
    }

    .bg-image {
        width: 100%;
        min-height: 100%;
        background: url('https://free4kwallpapers.com/uploads/originals/2022/03/28/anime-landscape-for-desktop-scenery-clouds-stars-buildings-wallpaper.jpg');
        background-position: center;
        background-size: cover;
    }
</style> --}}

<body class="bg-image">
    <h1 class="text-center mb-4">Data Pegawai</h1>

    <div class="container">
        {{-- Button Tambah --}}
        <a href={{ route('tambahpegawai') }} type="button" class="btn btn-success">Tambah</a>
        <div class="row">
            <div class="row g-3 align-items-center">
                {{-- Search --}}
                <div class="col-auto">
                    <form action="/pegawai" method="GET">
                        <input type="search" name="search" class="form-control" aria-describedby="passwordHelpInline">
                    </form>
                </div>
                {{-- Export PDF --}}
                <div class="col-auto">
                    <a href="{{ route('export.pdf') }}" type="button" class="btn btn-info">Export PDF</a>
                </div>
            </div>
            {{-- Sweet Allert --}}
            {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Image</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Telepon</th>
                        <th scope="col">Di buat</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $index => $row)
                        <tr>
                            <th scope="row">{{ $index + $data->firstItem() }}</th>
                            <td>{{ $row->nama }}</td>
                            <td>
                                <img src="{{ asset('imagepegawai/' . $row->image) }}" alt=""
                                    style="width: 40px">
                            </td>
                            <td>{{ $row->jeniskelamin }}</td>
                            <td>{{ $row->nomortelepon }}</td>
                            <td>{{ $row->created_at->format('D M Y') }}</td>
                            <td>
                                {{-- Edit --}}
                                <a href="tampilkandata/{{ $row->id }}" class="btn btn-info">Edit</a>
                                {{-- Delete --}}
                                <form action="{{ route('delete', $row->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button class="btn btn-danger border-0 delete"
                                        data-id={{ $row->nama }}>Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>


    <!-- Jquery! -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- Sweet allert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $('.delete').click(function(event) {
            var form = $(this).closest("form");
            var pegawaiid = $(this).attr('data-id');
            event.preventDefault();
            swal({
                    title: "Apakah Kamu yakin ?",
                    text: "Menghapus " + pegawaiid + " ",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("data tidak jadi dihapus");
                    }
                });
        })
    </script>

    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>


</body>

</html>
