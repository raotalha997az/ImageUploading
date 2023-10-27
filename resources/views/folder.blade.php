<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="index.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
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

    #btn {
        margin-top: 15px;
        margin-left: 20px;
        width: 100px;
        height: 40px;
        background-color: #08b4b4;
    }

    input[type="text"] {
        width: 300px;
        border: none;
        border-bottom: 2px solid #08b4b4af;
        border-radius: 4px;
        padding: 10px;
        margin: 10px;
        outline: none;
    }

    .container1 {
        width: 100vw;
        height: 100vh;
        background-color: #08b4b4;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .folder-container {
        width: 80vw;
        height: 80vh;
        background-color: #ffffff;

        padding: 30px 60px;
        border-radius: 40px;
        display: flex;

        flex-direction: column;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 10px 20px,
            rgba(0, 0, 0, 0.28) 0px 6px 6px;
    }

    img {
        height: 110px;
        width: 110px;
    }

    a {
        color: #ffffff;
        text-decoration: none;
    }

    .folder {
        display: flex;
        justify-content: center;
        text-align: center;
    }
    header {
        width: 100vw;
        border: 2px solid rgba(255, 0, 0, 0.)
    }
</style>

<body>
    <div class="container1">
        <div class="folder-container mb-2 d-flex">
            <div class="header d-flex">
                <h1 class="text-center" >Folders</h1>
                <button type="button" style="width: 200px;margin-left:70%" class="btn" id="btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Create
                  </button>
            </div>
            
            <div class="container">
                <div class="row">
                    @foreach ($folders as $folder)
                        <div class="col-md-3 mt-5 ">
                          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAAB9CAMAAAC4XpwXAAAA5FBMVEX/z2b///8AAAD/vCv/0Wf/wy2SbRmYmJjdt1oEAAB6WhWt3ui/9f+n1t7/zFwWEQl6ZDH/2GsXFxc4KQmoqKiQkJCgoKDZpCWoiURwVBP/pDb5+fn/rDiJiYmNaRh6Txq2trZ6enqachpwShjAwMDm5uZUVFSM6v/U1NQxIwizhR5wcHDnrCckJCRCMgsrKytlZWV+0ugOFxpDNhpPQCA4IwwuHgrunDOdZiHjkjC8eSitcSVXOROR1+io7/95ytkxP0NhfYOnw8jW+v/G6O5cRQ/MmiMiGQZgTSa/nE2XfT7/xkxzH3JTAAAClklEQVRoge3baVMaQRAG4HVkOTRIOETZg6wGiCACUSCHmsscJv7//5PpWSAG0Jrp7R2pst8vfNmah56Z2oHabWfrKeOw/pz1dqtW10mrTa+fdIR2RifEel3fhtRJ9dAMF2KfUI9gwG7vQCu9KVwdkuk+DJd13W2tuG4Wrj+i0qH0hqat/GNC3jkVotDXxyXfpJt850yIgUHpC55k6zlyoB0znbB6jE639iidjMfpVJOP1Im2HlanqR6tz9ZeVBAZjmrthPqcRyb0k+mzycem006my+qriEwm05Li/WS6PPIQCYLg3XvgjxLquHieF3wAvr3QUWXgEgAP1dcXeq+ZtZXmR8l7cu07M93tJdm+xrkMvOBK3ivmesOq/lrqr+Tnxujnxd2Uc/0Wcr5ef5F2Pr2BbKReVIkv3C2mkOvPkMpju+4L4F9T3naTy4f2/Lebm+/DlHUhqldr9SEc/KPUdZV7eqWmon51+FHNLFH8fW8PdXL8Y42e5BdaS+4l0c2XdbLnuv3qiu7jcfU3fJzJODrZgyO1Sqe3YKgLRw+P9Z9kusLHurjSt90ukW6Iz/QGjW427Qt9h0SPTHFK3bhySt10zR/WLeErutuX975Kbt80ofm0r+oHgwQnhWnly/qvBLZ55cu6SqGEyq05vqqPf+dx0TxYHtX/lDPImNsr+ssyZhB0/tdLeVQJRPqF3dKXdMsTzzrrrLPOOuuss84666yzzjrrrLPOOuuss84666yzzrp9/eypnkkNhBiqvgnLz+PuQO8XhDhVPSOWp16VDq+cRHG/DP45LCJ3i7Yb34nfGZkeIp9BIwItR/Cqj4ju9UkVLEXME6J6xIiS20L0xxGlo9rs/vUG5uylNm8x3Ii+SNafmf4X+FmtCiQYY4AAAAAASUVORK5CYII=" height="100px" width="100px" alt="">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                class="bi bi-filetype-jpg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5Zm-4.34 8.132c.076.153.123.317.14.492h-.776a.797.797 0 0 0-.097-.249.689.689 0 0 0-.17-.19.707.707 0 0 0-.237-.126.96.96 0 0 0-.299-.044c-.285 0-.507.1-.665.302-.156.201-.234.484-.234.85v.498c0 .234.032.439.097.615a.881.881 0 0 0 .304.413.87.87 0 0 0 .519.146.967.967 0 0 0 .457-.096.67.67 0 0 0 .272-.264c.06-.11.091-.23.091-.363v-.255H8.24v-.59h1.576v.798c0 .193-.032.377-.097.55a1.29 1.29 0 0 1-.293.458 1.37 1.37 0 0 1-.495.313c-.197.074-.43.111-.697.111a1.98 1.98 0 0 1-.753-.132 1.447 1.447 0 0 1-.533-.377 1.58 1.58 0 0 1-.32-.58 2.482 2.482 0 0 1-.105-.745v-.506c0-.362.066-.678.2-.95.134-.271.328-.482.582-.633.256-.152.565-.228.926-.228.238 0 .45.033.636.1.187.066.347.158.48.275.133.117.238.253.314.407ZM0 14.786c0 .164.027.319.082.465.055.147.136.277.243.39.11.113.245.202.407.267.164.062.354.093.569.093.42 0 .748-.115.984-.345.238-.23.358-.566.358-1.005v-2.725h-.791v2.745c0 .202-.046.357-.138.466-.092.11-.233.164-.422.164a.499.499 0 0 1-.454-.246.577.577 0 0 1-.073-.27H0Zm4.92-2.86H3.322v4h.791v-1.343h.803c.287 0 .531-.057.732-.172.203-.118.358-.276.463-.475.108-.201.161-.427.161-.677 0-.25-.052-.475-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.546 1.333a.795.795 0 0 1-.085.381.574.574 0 0 1-.238.24.794.794 0 0 1-.375.082H4.11v-1.406h.66c.218 0 .389.06.512.182.123.12.185.295.185.521Z" />
                            </svg> <br> --}}
                            <p for="form-label" class="text-dark"><a class="text-dark fw-bold"
                                    href="{{ route('foldersId', ['id' => $folder->id]) }}">{{ $folder->folder_name }} </a></p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->

  
  <!-- Modal --> <form action="{{route('foldercreate')}}" method="POST">
            @csrf
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Folder</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <div class="modal-body">
            <input type="text" class="form-control" id="input_text" placeholder="Enter folder name" name="folder_name">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn mb-3" id="btn" > Create</button>
        </div>
   
      </div>
    </div>
  </div> </form>
</body>

</html>
