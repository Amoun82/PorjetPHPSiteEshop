document
  .getElementById("photo-input")
  .addEventListener("change", function (event) {
    var file = event.target.files[0];
    var imageURL = URL.createObjectURL(file);
    document.getElementById("article-image").src = imageURL;
  });


// a fait plus tard

//   <label for="exampleInputEmail1" class="form-label mb-0 fw-bold">Image :</label>
//           <input type="file" class="form-control mb-3" id="photo-input" name="photo" value=""></input>