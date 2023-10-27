<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
.modal-header , .modal , .modal-content{
  padding-left: 20px;
  margin-left: 20px;
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
        .form-check{
          margin-right: 20px;
        }
        img {
            height: 110px;
            width: 110px;
        }
    </style>

    <body>
        <div class="container1">
          <form action="{{route('picture.move')}}" method="POST" >
            @csrf
            <div class="folder-container mb-2 d-flex">
                <h1 class="text-center">{{ $folders->folder_name }}</h1>
                <input type="hidden" name="old_folder" value="{{$folder->folder_name}}" >
                {{-- {{dd($images)}} --}}
                <div class="image-container" style="overflow: scroll">
                      @foreach ($images as $image)
                        <label class="m-5">
                            <img src="{{ $image->path_name }}" alt="{{ $image->picture_name }}" class="image" />
                            <input type="checkbox" class="checkbox" name="pictures[{{$loop->iteration}}]['pricture_id']" value="{{ $image->id }}" />
                        </label>
                        @endforeach
                    </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary movebtn" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"> Move </button>
            </div>
        </div>



        {{-- html css --}}


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel"> </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                  <div class="modal-body col-auto">
                    @foreach ($foldersall as $folder)  
                    <div class="d-flex m-5">
                      <input type="radio"  class="form-check" value="{{$folder->id}}" name="folder_id">
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAAB9CAMAAAC4XpwXAAAA5FBMVEX/z2b///8AAAD/vCv/0Wf/wy2SbRmYmJjdt1oEAAB6WhWt3ui/9f+n1t7/zFwWEQl6ZDH/2GsXFxc4KQmoqKiQkJCgoKDZpCWoiURwVBP/pDb5+fn/rDiJiYmNaRh6Txq2trZ6enqachpwShjAwMDm5uZUVFSM6v/U1NQxIwizhR5wcHDnrCckJCRCMgsrKytlZWV+0ugOFxpDNhpPQCA4IwwuHgrunDOdZiHjkjC8eSitcSVXOROR1+io7/95ytkxP0NhfYOnw8jW+v/G6O5cRQ/MmiMiGQZgTSa/nE2XfT7/xkxzH3JTAAAClklEQVRoge3baVMaQRAG4HVkOTRIOETZg6wGiCACUSCHmsscJv7//5PpWSAG0Jrp7R2pst8vfNmah56Z2oHabWfrKeOw/pz1dqtW10mrTa+fdIR2RifEel3fhtRJ9dAMF2KfUI9gwG7vQCu9KVwdkuk+DJd13W2tuG4Wrj+i0qH0hqat/GNC3jkVotDXxyXfpJt850yIgUHpC55k6zlyoB0znbB6jE639iidjMfpVJOP1Im2HlanqR6tz9ZeVBAZjmrthPqcRyb0k+mzycem006my+qriEwm05Li/WS6PPIQCYLg3XvgjxLquHieF3wAvr3QUWXgEgAP1dcXeq+ZtZXmR8l7cu07M93tJdm+xrkMvOBK3ivmesOq/lrqr+Tnxujnxd2Uc/0Wcr5ef5F2Pr2BbKReVIkv3C2mkOvPkMpju+4L4F9T3naTy4f2/Lebm+/DlHUhqldr9SEc/KPUdZV7eqWmon51+FHNLFH8fW8PdXL8Y42e5BdaS+4l0c2XdbLnuv3qiu7jcfU3fJzJODrZgyO1Sqe3YKgLRw+P9Z9kusLHurjSt90ukW6Iz/QGjW427Qt9h0SPTHFK3bhySt10zR/WLeErutuX975Kbt80ofm0r+oHgwQnhWnly/qvBLZ55cu6SqGEyq05vqqPf+dx0TxYHtX/lDPImNsr+ssyZhB0/tdLeVQJRPqF3dKXdMsTzzrrrLPOOuuss84666yzzjrrrLPOOuuss84666yzzrp9/eypnkkNhBiqvgnLz+PuQO8XhDhVPSOWp16VDq+cRHG/DP45LCJ3i7Yb34nfGZkeIp9BIwItR/Cqj4ju9UkVLEXME6J6xIiS20L0xxGlo9rs/vUG5uylNm8x3Ii+SNafmf4X+FmtCiQYY4AAAAAASUVORK5CYII=" style="height: 50px;width:50px;"  alt="">
                        <label for="folder_id" class="form-label" style="margin-left: 20px">{{$folder->folder_name}}</label>
                    </div>                 
                @endforeach  
                  </div> 
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
      </form>
        <script>
            function folderId(id){
              console.log(id);
            }
        </script>

    </body>

    </html>
</body>

</html>
