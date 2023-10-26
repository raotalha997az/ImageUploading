<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="index.css" />
    <title>Document</title>
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

    .form-container {
      width: 100vw;
      height: 100vh;
      background-color: #08b4b4;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .upload-files-container {
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
      border: 2px dashed #08b4b4;
      border-radius: 40px;
      margin: 10px 0 15px;
      padding: 30px 50px;
      width: 420px;
      text-align: center;
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
  </style>
  <body>
    <form class="form-container d-flex" enctype="multipart/form-data" method="POST" action="{{route('uploading')}}">
     @csrf
      <div class="upload-files-container mb-2">
        <div class="folder col-auto d-flex">
          <input
            type="text"
            placeholder=" Enter folder name"
            class="form-control"
            name="file_name"
          />
          {{-- <button id="btn" class="btn" type="button">
            <a href="folder.html">create</a>
          </button> --}}
        </div>
        {{-- <div class="line"></div>
        <hr />
        <label class="for-label">Image</label>
        <input type="file" class="form-control" id="image" placeholder="Upload Image">
        <button onclick="consolevalue()" type="button">Console</button>
        <div class="drag-file-area">
          <span class="material-icons-outlined upload-icon"> file_upload </span>
          <h3 class="dynamic-message">Drag & drop any file here</h3>
          <label class="label">
            or
            <span class="browse-files">
              <input type="file" class="default-file-input" />
              <span class="browse-files-text">browse file</span>
              <span>from device</span>
            </span>
          </label>
        </div>
        <span class="cannot-upload-message">
          <span class="material-icons-outlined">error</span> Please select a
          file first
          <span class="material-icons-outlined cancel-alert-button"
            >cancel</span
          >
        </span> 
        <div class="file-block">
          <div class="file-info">
            <span class="material-icons-outlined file-icon">description</span>
            <span class="file-name"> </span> | <span class="file-size"> </span>
          </div>
          <span class="material-icons remove-file-icon">delete</span>
          <div class="progress-bar"></div>
        </div> --}}
        <button type="submit" class="upload-button">Upload</button>
      </div>
    </form>

    <script>
      var isAdvancedUpload = (function () {
        var div = document.createElement("div");
        return (
          ("draggable" in div || ("ondragstart" in div && "ondrop" in div)) &&
          "FormData" in window &&
          "FileReader" in window
        );
      })();

      let draggableFileArea = document.querySelector(".drag-file-area");
      let uploadIcon = document.querySelector(".upload-icon");
      let dragDropText = document.querySelector(".dynamic-message");
      let fileInput = document.querySelector(".default-file-input");
      let cannotUploadMessage = document.querySelector(
        ".cannot-upload-message"
      );
      let cancelAlertButton = document.querySelector(".cancel-alert-button");
      let uploadedFile = document.querySelector(".file-block");
      let uploadButton = document.querySelector(".upload-button");
      let fileFlag = 0;
      let filesToUpload = [];

      fileInput.addEventListener("click", () => {
        fileInput.value = "";
        console.log(fileInput.value);
      });

      fileInput.addEventListener("change", (e) => {
        filesToUpload = [];
        for (let i = 0; i < fileInput.files.length; i++) {
          if (fileInput.files[i].type === "") {
            for (let j = 0; j < fileInput.files[i].webkitEntries.length; j++) {
              if (fileInput.files[i].webkitEntries[j].isFile) {
                filesToUpload.push(fileInput.files[i].webkitEntries[j].file);
              }
            }
          } else {
            filesToUpload.push(fileInput.files[i]);
          }
        }
        if (filesToUpload.length > 0) {
          renderFilesToUpload();
        }
      });

    //   function renderFilesToUpload() {
    //     uploadedFile.innerHTML = "";
    //     filesToUpload.forEach((file, index) => {
    //       let fileBlock = document.createElement("div");
    //       fileBlock.classList.add("file-info");
    //       let fileInfo = document.createElement("span");
    //       let fileInfo1 = document.createElement("input");
    //       fileInfo1.type = "file";
    //     //   fileInfo1.value = file;


    //       fileInfo.textContent = `${file.name} - ${(file.size / 1024).toFixed(
    //         1
    //       )} KB`;
    //       fileInfo1.name = ` pictures[${index}]['name']`;
    //     //   fileInfo1.value = `${file.name}`;
    //         fileInfo1.uploadedFile(file);
    //       fileBlock.appendChild(fileInfo);
    //       fileBlock.appendChild(fileInfo1);
    //       uploadedFile.appendChild(fileBlock);
    //     });

    //     uploadedFile.style.cssText = "display: flex;";
    //   }
    function renderFilesToUpload() {
    uploadedFile.innerHTML = "";
    uploadedFile.addEventListener('dragover', handleDragOver);
    uploadedFile.addEventListener('drop', handleDrop);

    filesToUpload.forEach((file, index) => {

         // Get a reference to our file input
    const fileInput = document.querySelector('input[type="file"]');

// Create a new File object
const myFile = new File(['Hello World!'], 'myFile.txt', {
    type: 'text/plain',
    lastModified: new Date(),
});

// Now let's create a DataTransfer to get a FileList
const dataTransfer = new DataTransfer();
dataTransfer.items.add(myFile);
fileInput.files = dataTransfer.files;


        let fileBlock = document.createElement("div");
        fileBlock.classList.add("file-info");
        let fileInfo = document.createElement("span");
        let fileInfo1 = document.createElement("input");
        fileInfo1.type = "file";

        fileInfo.textContent = `${file.name} - ${(file.size / 1024).toFixed(1)} KB`;
        fileInfo1.name = `pictures[${index}]['name']`;

        fileBlock.appendChild(fileInfo);
        fileBlock.appendChild(fileInfo1);
        uploadedFile.appendChild(fileBlock);
    });

    uploadedFile.style.cssText = "display: flex;";

    function handleDragOver(event) {
        event.preventDefault();
    }

    function handleDrop(event) {
        event.preventDefault();

        const file = event.dataTransfer.files[0];
        const inputElement = event.target.querySelector('input[type="file"]');

        if (file && inputElement) {
            inputElement.files = event.dataTransfer.files;
        }
    }
}

uploadButton.addEventListener("click", () => {
    let isFileUploaded = fileInput.value;

    if (isFileUploaded != "") {
        if (fileFlag == 0) {
            fileFlag = 1;
            var width = 0;
            var id = setInterval(frame, 50);

            function frame() {
                if (width >= 390) {
                    clearInterval(id);
                    uploadButton.innerHTML = `<span class="material-icons-outlined upload-button-icon"> check_circle </span> Uploaded`;

                    // Get the file input elements
                    const fileInputs = document.querySelectorAll('.file-info input[type="file"]');

                    // Create FormData object
                    const formData = new FormData();

                    // Append files to FormData
                    fileInputs.forEach((input, index) => {
                        const file = input.files[0];
                        formData.append(`pictures[${index}]['name']`, file);
                    });

                    // Send FormData using XMLHttpRequest
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '/upload', true);

                    xhr.onload = function() {
                        if (xhr.status >= 200 && xhr.status < 400) {
                            // The request was successful
                            console.log('Files uploaded successfully');
                        } else {
                            // An error occurred during the request
                            console.error('Error uploading files');
                        }
                    };

                    xhr.onerror = function() {
                        // An error occurred during the request
                        console.error('Error uploading files');
                    };

                    xhr.send(formData);
                } else {
                    width += 5;
                    // Adjust the progress bar width as needed
                    // progressBar.style.width = width + "px";
                }
            }
        }
    } else {
        cannotUploadMessage.style.cssText = "display: flex; animation: fadeIn linear 1.5s;";
    }
});


      uploadButton.addEventListener("click", () => {
        let isFileUploaded = fileInput.value;
        if (isFileUploaded != "") {
          if (fileFlag == 0) {
            fileFlag = 1;
            var width = 0;
            var id = setInterval(frame, 50);
            function frame() {
              if (width >= 390) {
                clearInterval(id);
                uploadButton.innerHTML = `<span class="material-icons-outlined upload-button-icon"> check_circle </span> Uploaded`;
              } else {
                width += 5;
                // Adjust the progress bar width as needed
                // progressBar.style.width = width + "px";
              }
            }
          }
        } else {
          cannotUploadMessage.style.cssText =
            "display: flex; animation: fadeIn linear 1.5s;";
        }
      });

      cancelAlertButton.addEventListener("click", () => {
        cannotUploadMessage.style.cssText = "display: none;";
      });

      if (isAdvancedUpload) {
        [
          "drag",
          "dragstart",
          "dragend",
          "dragover",
          "dragenter",
          "dragleave",
          "drop",
        ].forEach((evt) =>
          draggableFileArea.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
          })
        );

        ["dragover", "dragenter"].forEach((evt) => {
          draggableFileArea.addEventListener(evt, (e) => {
            e.preventDefault();
            e.stopPropagation();
            uploadIcon.innerHTML = "file_download";
            dragDropText.innerHTML = "Drop your file here!";
          });
        });

        draggableFileArea.addEventListener("drop", (e) => {
          uploadIcon.innerHTML = "check_circle";
          dragDropText.innerHTML = "File Dropped Successfully!";
          let files = e.dataTransfer.files;
          for (let i = 0; i < files.length; i++) {
            if (files[i].type === "") {
              for (let j = 0; j < files[i].webkitEntries.length; j++) {
                if (files[i].webkitEntries[j].isFile) {
                  filesToUpload.push(files[i].webkitEntries[j].file);
                }
              }
            } else {
              filesToUpload.push(files[i]);
            }
          }
          renderFilesToUpload();
          // Clear input value after drop
          fileInput.value = "";
          fileFlag = 0;
        });
      }
      function consolevalue(){
      var a =  document.getElementById('image').value;
      console.log(a);
      }

   
    </script>
  </body>
</html>
