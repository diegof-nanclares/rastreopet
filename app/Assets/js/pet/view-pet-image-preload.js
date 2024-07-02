const fileInput = document.getElementById('fileInput');
const imagePreview = document.getElementById('imagePreview');

    imagePreview.addEventListener('click', () => {
    fileInput.click();
});

    fileInput.addEventListener('change', (event) => {
    const selectedFile = event.target.files[0];

    if (selectedFile) {
    const reader = new FileReader();

    reader.onload = (e) => {
    imagePreview.src = e.target.result;
};

    reader.readAsDataURL(selectedFile);
}
});
