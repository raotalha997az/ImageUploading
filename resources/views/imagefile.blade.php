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
    </style>

    <body>
        <div class="container1">
          <form action="{{route('picture.move')}}" method="POST" >
            @csrf
            <div class="folder-container mb-2 d-flex">
                <h1 class="text-center">{{ $folders->folder_name }}</h1>
                <input type="hidden" name="old_folder" value="{{$folder->folder_name}}" >
                {{-- {{dd($images)}} --}}
                @foreach ($images as $image)
                    <div class="image-container">
                        <label>
                            <img src="{{ $image->path_name }}" alt="{{ $image->picture_name }}" class="image" />
                            <input type="checkbox" class="checkbox" name="pictures[{{$loop->iteration}}]['pricture_id']" value="{{ $image->id }}" />
                        </label>
                    </div>
                @endforeach

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


                        @foreach ($foldersall as $folder)
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                    fill="currentColor" class="bi bi-filetype-jpg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5Zm-4.34 8.132c.076.153.123.317.14.492h-.776a.797.797 0 0 0-.097-.249.689.689 0 0 0-.17-.19.707.707 0 0 0-.237-.126.96.96 0 0 0-.299-.044c-.285 0-.507.1-.665.302-.156.201-.234.484-.234.85v.498c0 .234.032.439.097.615a.881.881 0 0 0 .304.413.87.87 0 0 0 .519.146.967.967 0 0 0 .457-.096.67.67 0 0 0 .272-.264c.06-.11.091-.23.091-.363v-.255H8.24v-.59h1.576v.798c0 .193-.032.377-.097.55a1.29 1.29 0 0 1-.293.458 1.37 1.37 0 0 1-.495.313c-.197.074-.43.111-.697.111a1.98 1.98 0 0 1-.753-.132 1.447 1.447 0 0 1-.533-.377 1.58 1.58 0 0 1-.32-.58 2.482 2.482 0 0 1-.105-.745v-.506c0-.362.066-.678.2-.95.134-.271.328-.482.582-.633.256-.152.565-.228.926-.228.238 0 .45.033.636.1.187.066.347.158.48.275.133.117.238.253.314.407ZM0 14.786c0 .164.027.319.082.465.055.147.136.277.243.39.11.113.245.202.407.267.164.062.354.093.569.093.42 0 .748-.115.984-.345.238-.23.358-.566.358-1.005v-2.725h-.791v2.745c0 .202-.046.357-.138.466-.092.11-.233.164-.422.164a.499.499 0 0 1-.454-.246.577.577 0 0 1-.073-.27H0Zm4.92-2.86H3.322v4h.791v-1.343h.803c.287 0 .531-.057.732-.172.203-.118.358-.276.463-.475.108-.201.161-.427.161-.677 0-.25-.052-.475-.158-.677a1.176 1.176 0 0 0-.46-.477c-.2-.12-.443-.179-.732-.179Zm.546 1.333a.795.795 0 0 1-.085.381.574.574 0 0 1-.238.24.794.794 0 0 1-.375.082H4.11v-1.406h.66c.218 0 .389.06.512.182.123.12.185.295.185.521Z" />
                                </svg> <br>
                                <label for="folder_id">{{$folder->folder_name}}</label>
                                <input type="radio" class="form-check" value="{{$folder->id}}" name="folder_id">
                        @endforeach
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{-- <div class="modal-body"></div> --}}
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
