<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
    margin-top: -120px;
    margin-left: 40%;
    width: 20%;
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
  .upload-files-container {
    border: 2px solid red;
    background-color: #ffffff;
    width: 520px;
    padding: 30px 60px;
    border-radius: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 10px 20px,
      rgba(0, 0, 0, 0.28) 0px 6px 6px;
  }
  .drag-file-area {
    background-color:#08b4b470;
    border-radius: 40px; 
    width: 520px;
    text-align: center;
margin-left: auto;
margin-right: auto;
  }
  .line {
    border: 2px solid #08b4b4;
    width: 520px;
    margin-top: 20px;
  }
  .drag-file-area .upload-icon {
    font-size: 50px;
  }
  .drag-file-area h3 {
    font-size: 26px;
    margin: 15px 0;
  }
  .drag-file-area label {
    font-size: 19px;
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
  .default-file-input {
    opacity: 0;
  }
  .cannot-upload-message {
    background-color: #ffc6c4;
    font-size: 17px;
    display: flex;
    align-items: center;
    margin: 5px 0;
    padding: 5px 10px 5px 30px;
    border-radius: 5px;
    color: #bb0000;
    display: none;
  }
  @keyframes fadeIn {
    0% {
      opacity: 0;
    }
    100% {
      opacity: 1;
    }
  }
  .cannot-upload-message span,
  .upload-button-icon {
    padding-right: 10px;
  }
  .cannot-upload-message span:last-child {
    padding-left: 20px;
    cursor: pointer;
  }
  .file-block {
    overflow: scroll;
    color: #f7fff7;
    background-color: #0b8dad;
    transition: all 1s;
    width: 430px;
    position: relative;
    display: none;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    margin: 10px 0 15px;
    padding: 10px 20px;
    border-radius: 25px;
    cursor: pointer;
  }
  .file-info {
    display: flex;
    align-items: center;
    font-size: 15px;
  }
  .file-icon {
    margin-right: 10px;
  }
  .file-name,
  .file-size {
    padding: 0 3px;
  }
  .remove-file-icon {
    cursor: pointer;
  }
  
  .progress-bar {
    display: flex;
    position: absolute;
    bottom: 0;
    left: 4.5%;
    width: 0;
    height: 5px;
    border-radius: 25px;
    background-color: #4bb543;
  }

  a {
    color: white;
    text-decoration: none;
  }
  .upload-button {
    font-family: "Montserrat";
    background-color: #08b4b4;
    color: #f7fff7;
    display: flex;
    align-items: center;
    font-size: 18px;
    border: none;
    border-radius: 20px;
    margin: 10px;
    padding: 7.5px 50px;
    cursor: pointer;
  }
  .upload-button {
    font-family: "Montserrat";
    background-color: #08b4b4;
    color: #f7fff7;
    display: flex;
    align-items: center;
    font-size: 18px;
    border: none;
    border-radius: 20px;
    margin: 10px;
    padding: 7.5px 50px;
    cursor: pointer;
  }
  input[type="file"]{
    margin: 10px 0 15px;
    padding: 30px 50px;
    border: 2px dashed #08b4b4;
    border-radius: 40px;
    width: 420px;
    height: 200px;
    text-align: center;
    padding-top: 30%;
    padding-bottom: 30%;
    padding-left: 25%;

  }
  #input_text{
 margin-left: auto;
 margin-right: auto;
    }
</style>
<body>

<div class="container1">
    <div class="container mt-3">
        <form action="{{ route('imguploading') }}" class="form-container d-flex" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="container card mt-5">
            <div class="row mt-5">
              <div class="col">
                <input type="text" class="form-control" id="input_text" placeholder="Enter folder name" name="folder_name">
              </div>
            </div>

<div class="drag-file-area">
  <span class="material-icons-outlined upload-icon"> file_upload </span>
  <h3 class="dynamic-message">Drag & drop any file in the box</h3>
  <label class="label">
    or
    <span class="browse-files">
  <div class="border1">
    <input type="file" class="form-control " id="default-file-input"  name="uploads[]" multiple>
  </div>
    </span>
  </label>
</div>
{{-- asd --}}
     <div class="row mt-5">
              <div class="col"> 
              </div>
            </div>
            <div class="mt-5">
              <button type="submit" id="btn"  class="btn">Submit</button>
            </div>
          </div>
        </form>     
</div>
</div>
</body>
</html>
