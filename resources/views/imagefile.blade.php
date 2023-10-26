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
        <link
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous"
        />
        <script
          src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
          crossorigin="anonymous"
        ></script>
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
          <div class="folder-container mb-2 d-flex">
            <h1 class="text-center">Files</h1>
            @foreach($images as $image)
            <img src="{{ $image->path_name }}" alt="{{ $image->picture_name }}">
            @endforeach
              </div>
        </div>



{{-- html css --}}

<div class="image-container">
  <label>
    <img src="image1.png" alt="Image 1" class="image" />
    <input type="checkbox" class="checkbox" value="image_1" />
  </label>
</div>

<div class="image-container">
  <label>
    <img src="image2.png" alt="Image 2" class="image" />
    <input type="checkbox" class="checkbox" value="image_2" />
  </label>
</div>

<!-- Button trigger modal -->
<button
  type="button"
  class="btn btn-primary movebtn"
  data-bs-toggle="modal"
  data-bs-target="#staticBackdrop"
>
  Move
</button>

<!-- Modal -->
<div
  class="modal fade"
  id="staticBackdrop"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">
          <img src="image1.png" alt="" height="100px" width="100px" />
        </h1>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">...</div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal"
        >
          Close
        </button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<script>
  const checkboxes = document.querySelectorAll(".checkbox");
  const selectedImages = [];

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", (event) => {
      const value = event.target.value;
      if (event.target.checked) {
        selectedImages.push(value);
      } else {
        const index = selectedImages.indexOf(value);
        if (index > -1) {
          selectedImages.splice(index, 1);
        }
      }
      console.log(selectedImages);
    });
  });

  // html css end here
      </body>
    </html>
  </body>
</html>
