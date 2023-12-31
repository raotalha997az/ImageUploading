@extends('layout.app')
<link rel="icon" href="{{ asset('/assets/images/supply_logo_2.png') }}" type="image/x-icon">
@section('content')

    <body>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>Document</title>
            <link rel="stylesheet" href="index.css" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                crossorigin="anonymous" />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>
        </head>
        <style>
            :root {
                --blue: #08b4b4af;
            }

            @import url("https://fonts.googleapis.com/css2?family=Montserrat&display=swap");

            body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Montserrat", sans-serif;
            }

            input[type="file"] {

                border: 2px dashed #08b4b4;
                border-radius: 40px;
                text-align: center;


            }

            .row {}

            .modal-header,
            .modal,
            .modal-content {
                padding-left: 20px;
                margin-left: 20px;
            }

            #btn {
                margin-top: 15px;
                margin-left: 20px;
                width: 250px;
                height: 40px;
                border-radius: 6px;
                background-color: #f1f1f1;
                padding-left: 50px;
                padding-right: 50px;
            }

            #movebtn {
                background: white;
                margin-left: 40%;
                margin-right: 40%;
                width: 30%;
            }

            input[type="text"] {
                width: 300px;
                border: none;
                border-bottom: 2px solid #f1f1f1;
                border-radius: 4px;
                padding: 10px;
                margin: 10px;
                outline: none;
            }

            .container1 {
                width: 100vw;
                height: 100vh;
                background-color: #f1f1f1;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .container3 {
                width: 80vw;
                height: 80vh;

                background: white;
                box-shadow: rgba(0, 0, 0, 0.24) 0px 10px 20px,
                    rgba(187, 179, 179, 0.28) 0px 6px 6px;
            }

            #scroller::-webkit-scrollbar {
                width: 5px;

            }

            /* Track */
            #scroller::-webkit-scrollbar-track {
                background: #aca8a8;
            }

            /* Handle */
            #scroller::-webkit-scrollbar-thumb {
                background: transparent;
            }

            /* Handle on hover */
            #scroller::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .folder-container {
                padding-top: 10%;
                width: 80vw;
                height: 80vh;


            }

            .folder-container1 {

                width: 80vw;
                height: 10vh;

            }

            .container2 {
                display: flex;
                flex-direction: column;
                background: #ffffff;
                margin-left: -70px;
                margin-right: -70px;
                margin-top: -40px;

            }


            .form-check {
                margin-right: 20px;
            }

            img {
                height: 110px;
                width: 110px;
            }

            .drag-file-area label .browse-files-text {
                color: #08b4b4;
                font-weight: bolder;
                cursor: pointer;
            }

            .browse-files span {
                position: relative;
                top: -25px;
            }

            .container {
                padding: 2rem 0rem;
            }

            h4 {
                margin: 2rem 0rem 1rem;
            }

            .table-image {

                td,
                th {
                    vertical-align: middle;
                }
            }

            .move-right {
                float: right !important;
            }
        </style>


        <body>

            <div class="container1">
                <div class="container3">
                    <h1 class="text-center">{{ Auth::user()->name }}</h1>
                    <form action="{{ route('insert.Image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="container"> --}}
                        <div class="container2">
                            <div class="row">
                                <div class="col-lg-6">
                                    @if ($folder->main_folder_id == 0)
                                        <a href="{{ route('folders.show') }}" class="btn-sm m-2  btn btn-primary">Back</a>
                                    @elseif($folder->main_folder_id != 0)
                                        <a href="{{ route('foldersId', [$main_folder->id, $main_folder->folder_name]) }}"
                                            class="btn-sm m-2  btn btn-primary">Back</a>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    {{-- <button type="button" style="width: 200px;margin-left:65%  @if (!$isAdmin) display:none; @endif" class="btn"
                                        id="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Create
                                    </button> --}}
                                    {{-- upload only admin --}}
                                    <button type="button"
                                        style="width: 200px; margin-left: 65%; @if (!$isAdmin) display:none; @endif"
                                        class="btn" id="btn" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        Create
                                    </button>

                                </div>
                            </div>
                            <div class="folder-container1 mb-2 d-flex">
                                <div class="header d-flex  align-items-center" 
                                    style="width: 100%; justify-content: flex-end;">

                                    <span class="browse-files col-auto" style="margin-left: 30%;">
                                        {{-- upload only admin --}}
                                        <input type="file" class="form-control col-auto" id="default-file-input"
                                            name="uploads[]" multiple
                                            style="@if (!$isAdmin) display:none; @endif">
                                        {{-- <input type="file" class="form-control col-auto" id="default-file-input"
                                            name="uploads[]" multiple > --}}
                                        <input type="hidden" id="folder_id" value="{{ $folder->id }}" name="folder_id">
                                        <input type="hidden" id="folder_id" value="{{ $folder->folder_name }}"
                                            name="folder_name">
                                    </span>
                                    {{-- upload only admin --}}
                                    <button type="submit" id="btn" class="btn mb-3 btn-md"
                                        style="@if (!$isAdmin) display:none; @endif">
                                        Submit
                                    </button>
                                    {{-- <button type="submit" id="btn" class="btn mb-3 btn-md" margin-left: 65%; >
                                    Submit
                                </button> --}}
                                    {{-- <button class="btn btn-primary col-auto m-3 btn mb-3 btn-md"
                                        onclick="ExportToExcel('xlsx')"
                                        style="@if (!$isAdmin)  @endif">Export to Excel</button> --}}
                                    <button class="btn btn-primary col-auto m-3 btn mb-3 btn-md move-right"
                                        onclick="ExportToExcel('xlsx')">
                                        Export to Excel
                                    </button>


                                </div>
                            </div>
                    </form>
                    <div class=""> {{-- folder-container mb-2 d-flex --}}
                        {{-- sessions messages  --}}
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session()->get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @elseif (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session()->get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif


                        <div id="scroller" style="overflow: scroll;height:68vh">
                            <div class="row">
                                <div class="col-12" style="width:100%; ">
                                    <table class="table table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th colspan="5">
                                                    <center>
                                                        <h1 class="text-center col-14" style="width: fit-content">
                                                            {{ $folders->folder_name }}</h1>
                                                    </center>
                                                </th>
                                            </tr>
                                        </thead>

                                        <thead>
                                            <th>S No.</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Images Path </th>
                                            <th scope="col">Images Name</th>
                                            <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                {{-- {{dd($images)}} --}}
                                                @foreach ($images as $image)
                                                    <label>
                                                        <input type="hidden" value="{{ $image->id }}"
                                                            id="del{{ $image->id }}" />
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td> <img src="{{ $image->path_name }}"
                                                                alt="{{ $image->picture_name }}" class="rounded" /> </td>
                                                        <td><a href="{{ $image->path_name }}"
                                                                target="_blank">{{ $image->path_name }}</a></td>

                                                        <td> <label class="form-label" name="pictures"
                                                                value="">{{ $image->picture_name }}</label></td>
                                                    </label>
                                                    <td class="d-flex justify-content-evenly">

                                                        <a href="{{ $image->path_name }}" target="_blank"> <button
                                                                type="button" class="btn btn-primary">
                                                                <i class="fa fa-eye"></i>
                                                            </button></a>


                                                        <form class="delete-image-form" method="POST"
                                                            action="{{ route('delete.picture', ['id' => $image->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="folder_id"
                                                                value="{{ $folder->id }}">
                                                            <input type="hidden" name="picture_id"
                                                                value="{{ $image->id }}">
                                                            {{-- delete only admin --}}
                                                            <button type="submit" class="btn btn-danger delete-image-btn"
                                                                type="submit"
                                                                style="@if (!$isAdmin) display:none; @endif">
                                                                <i class="fa fa-trash"></i>
                                                            </button>

                                                        </form>

                                                    </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                    <div class="container">
                                        <div class="row m-5">
                                            @foreach ($subfolders as $folder)
                                                <div class="col-md-3 float-end">
                                                    <a class="text-dark fw-bold"
                                                        href="{{ route('foldersId', ['id' => $folder->id, 'folder_name' => $folder->folder_name]) }}">
                                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAAB9CAMAAAC4XpwXAAAA5FBMVEX/z2b///8AAAD/vCv/0Wf/wy2SbRmYmJjdt1oEAAB6WhWt3ui/9f+n1t7/zFwWEQl6ZDH/2GsXFxc4KQmoqKiQkJCgoKDZpCWoiURwVBP/pDb5+fn/rDiJiYmNaRh6Txq2trZ6enqachpwShjAwMDm5uZUVFSM6v/U1NQxIwizhR5wcHDnrCckJCRCMgsrKytlZWV+0ugOFxpDNhpPQCA4IwwuHgrunDOdZiHjkjC8eSitcSVXOROR1+io7/95ytkxP0NhfYOnw8jW+v/G6O5cRQ/MmiMiGQZgTSa/nE2XfT7/xkxzH3JTAAAClklEQVRoge3baVMaQRAG4HVkOTRIOETZg6wGiCACUSCHmsscJv7//5PpWSAG0Jrp7R2pst8vfNmah56Z2oHabWfrKeOw/pz1dqtW10mrTa+fdIR2RifEel3fhtRJ9dAMF2KfUI9gwG7vQCu9KVwdkuk+DJd13W2tuG4Wrj+i0qH0hqat/GNC3jkVotDXxyXfpJt850yIgUHpC55k6zlyoB0znbB6jE639iidjMfpVJOP1Im2HlanqR6tz9ZeVBAZjmrthPqcRyb0k+mzycem006my+qriEwm05Li/WS6PPIQCYLg3XvgjxLquHieF3wAvr3QUWXgEgAP1dcXeq+ZtZXmR8l7cu07M93tJdm+xrkMvOBK3ivmesOq/lrqr+Tnxujnxd2Uc/0Wcr5ef5F2Pr2BbKReVIkv3C2mkOvPkMpju+4L4F9T3naTy4f2/Lebm+/DlHUhqldr9SEc/KPUdZV7eqWmon51+FHNLFH8fW8PdXL8Y42e5BdaS+4l0c2XdbLnuv3qiu7jcfU3fJzJODrZgyO1Sqe3YKgLRw+P9Z9kusLHurjSt90ukW6Iz/QGjW427Qt9h0SPTHFK3bhySt10zR/WLeErutuX975Kbt80ofm0r+oHgwQnhWnly/qvBLZ55cu6SqGEyq05vqqPf+dx0TxYHtX/lDPImNsr+ssyZhB0/tdLeVQJRPqF3dKXdMsTzzrrrLPOOuuss84666yzzjrrrLPOOuuss84666yzzrp9/eypnkkNhBiqvgnLz+PuQO8XhDhVPSOWp16VDq+cRHG/DP45LCJ3i7Yb34nfGZkeIp9BIwItR/Cqj4ju9UkVLEXME6J6xIiS20L0xxGlo9rs/vUG5uylNm8x3Ii+SNafmf4X+FmtCiQYY4AAAAAASUVORK5CYII="
                                                            height="100px" width="100px" alt="">
                                                    </a>
                                                    <p for="form-label" class="text-dark">
                                                        <a class="text-dark fw-bold"
                                                            href="{{ route('foldersId', ['id' => $folder->id, 'folder_name' => $folder->folder_name]) }}"
                                                            style="text-decoration: none">
                                                            {{ $folder->folder_name }}
                                                        </a>
                                                    </p>
                                                    @if ($folder->main_folder_id == 0)
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                            onclick="destroyfol('{{ $folder->id }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @elseif($folder->main_folder_id != 0)
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                            onclick="destroyfol('{{ $folder->id }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    {{-- Folders image table --}}
                                    <div class="row">
                                        {{-- <div class="col-12" style="width:100%; display:none;"> --}}
                                        <div class="col-12" style="width:100%; display:none;">
                                            {{-- <table class="table table-bordered" id="tbl_exporttable_to_xls">
                                                <thead>
                                                    <tr>
                                                    <tr>
                                                        <th>Internal ID</th>
                                                        <th>ITEM IMAGE URL 1</th>
                                                            <th>ITEM IMAGE URL 2</th>
                                                            <th>ITEM IMAGE URL 3</th>
                                                            <th>ITEM IMAGE URL 4</th>
                                                            <th>ITEM IMAGE URL 5</th>
                                                            <th>ITEM IMAGE URL 6</th>
                                                            <th>ITEM IMAGE URL 7</th>
                                                            <th>ITEM IMAGE URL 8</th>
                                                            @if (count($subfolders) > 0)
                                                            @php
                                                                $firstFolderImages = App\Models\Picture::where('folder_id', $subfolders[0]->id)->get();
                                                            @endphp
                                                            @foreach ($firstFolderImages as $index => $image)
                                                                <th>ITEM IMAGE URL {{ $index + 1 }}</th>
                                                            @endforeach
                                                        @endif

                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($subfolders as $folder)
                                                        <tr>
                                                            <td>{{ $folder->folder_name }}</td>
                                                            @php
                                                                $images = App\Models\Picture::where('folder_id', $folder->id)->get();
                                                            @endphp
                                                            @foreach ($images as $image)
                                                                <td> {{ $image->path_name }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table> --}}
                                            @php
                                                $maxImageCount = 0;
                                                $folderWithMaxImages = null;
                                            @endphp

                                            @foreach ($subfolders as $folder)
                                                @php
                                                    $imageCount = App\Models\Picture::where('folder_id', $folder->id)->count();
                                                    if ($imageCount > $maxImageCount) {
                                                        $maxImageCount = $imageCount;
                                                        $folderWithMaxImages = $folder;
                                                    }
                                                @endphp
                                            @endforeach

                                            <table class="table table-bordered" id="tbl_exporttable_to_xls">
                                                <thead>
                                                    <tr>
                                                        <th>Internal ID</th>
                                                        @if ($folderWithMaxImages)
                                                            @php
                                                                $maxImages = App\Models\Picture::where('folder_id', $folderWithMaxImages->id)->get();

                                                            @endphp
                                                            @foreach ($maxImages as $index => $image)
                                                                <th>ITEM IMAGE URL {{ $index + 1 }}</th>
                                                            @endforeach
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($subfolders as $folder)
                                                        <tr>
                                                            <td>{{ $folder->folder_name }}</td>
                                                            @php
                                                                $images = App\Models\Picture::where('folder_id', $folder->id)->get();
                                                            @endphp
                                                            @foreach ($images as $image)
                                                                <td>{{ $image->path_name }}</td>
                                                            @endforeach
                                                            @for ($i = 0; $i < $maxImageCount - count($images); $i++)
                                                                <td></td>
                                                            @endfor
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="old_folder" value="{{ $folder->folder_name }}">
                                {{-- {{dd($images)}} --}}
                                <div class="image-container">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Delete Modal --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Folder</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>are you sure to delete this folder</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                <form id="destroyfol" class="delete-image-form" method="POST"
                                    action="{{ route('folderdestroy') }}">
                                    @csrf

                                    <input type="hidden" name="folder_id" id="folder_id_delete">

                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Delete Modal End --}}
                <!--Create Sub Folder Modal -->
                <form action="{{ route('subfoldercreate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="folder_id" value="{{ $folders->id }}">
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Folder</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="text" class="form-control" id="input_text"
                                        placeholder="Enter folder name" name="folder_name">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn mb-3" id="btn"> Create</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <script>
                    function ExportToExcel(type, fn, dl) {
                        var elt = document.getElementById('tbl_exporttable_to_xls');
                        var wb = XLSX.utils.table_to_book(elt, {
                            sheet: "sheet1"
                        });
                        var currentDate = new Date();
                        var day = currentDate.getDate().toString().padStart(2, '0');
                        var month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
                        var year = currentDate.getFullYear();
                        var formattedDate = day + '-' + month + '-' + year;
                        var fileName = 'Image-Report (' + formattedDate + ').xlsx';

                        return dl ?
                            XLSX.write(wb, {
                                bookType: type,
                                bookSST: true,
                                type: 'base64'
                            }) :
                            XLSX.writeFile(wb, fn || fileName);
                    }

                    function destroyfol(id) {
                        console.log(id);
                        $('#folder_id_delete').val(id);
                    }
                </script>
        </body>

        </html>
    </body>
@endsection

</html>
