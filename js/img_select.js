const fileInput = document.querySelector('#file-img input[type=file]');
fileInput.onchange = () => {
  if (fileInput.files.length > 0) {
    const fileName = document.querySelector('#file-img .file-name');
    fileName.textContent = fileInput.files[0].name;
  } 
} 
