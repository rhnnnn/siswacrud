// image preview upload 

function previewImage() {
    const fileInput = document.getElementById("file-input");
    const imagePreview = document.getElementById("image-preview");

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = "block";
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.src = "";
        imagePreview.style.display = "none";
    }
}

function previewImageEdit() {
    const fileInputEdit = document.getElementById("file-input-edit");
    const imagePreviewEdit = document.getElementById("image-preview-edit");

    if (fileInputEdit.files && fileInputEdit.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreviewEdit.src = e.target.result;
            imagePreviewEdit.style.display = "block";
        };

        reader.readAsDataURL(fileInputEdit.files[0]);
    } else {
        // imagePreviewEdit.src = "";
        imagePreviewEdit.style.display = "block";
    }
}