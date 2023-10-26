<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>


    <div class="container mt-3">
        <form action="{{ route('imguploading') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="container card mt-5">
            <div class="row mt-5">
              <div class="col">
                <input type="text" class="form-control" placeholder="Enter folder name" name="folder_name">
              </div>
            </div>
            <div class="row mt-5">
              <div class="col">
                <input type="file" class="form-control"  name="uploads[]" multiple>
              </div>
            </div>
            <div class=" mt-5">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>     
</div>

</body>
</html>
