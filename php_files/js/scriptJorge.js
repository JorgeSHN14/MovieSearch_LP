function updatePreview() {
  var inputUrl = document.getElementById('imagenInput').value;
  var previewContainer = document.getElementById('imageContainer');
  var previewImage = document.getElementById('imagenPrevisualizacion');

  if (inputUrl.trim() === "") {
    previewImage.src = './src/default.webp';
  } else {
    previewImage.src = inputUrl;
  }
}