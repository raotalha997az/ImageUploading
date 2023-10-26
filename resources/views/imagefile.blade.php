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
            <a href="imagefile.html"
              ><img src="image_icon_153794.png" alt=""
            /></a>
            <div>Img 1</div>
          </div>
        </div>
      </body>
    </html>
  </body>
</html>
