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

// image preview edit
document.addEventListener("DOMContentLoaded", function () {
    const fotoURLs = document.querySelectorAll("div[data-foto-url]");

    fotoURLs.forEach(function (cardBody) {
        const photoURL = cardBody.getAttribute("data-foto-url");
        const identifier = cardBody.querySelector("img").id.split("-")[3];
        const imagePreview = document.getElementById("image-preview-edit-" + identifier);

        // console.log(identifier)

        if (photoURL) {
            imagePreview.src = photoURL;
        } else {
            imagePreview.src = "../assets/img/default/OIP.jpeg"; // Use your default image path
        }
    });
});

function previewImageEdit(identifier) {
    const fileInputEdit = document.getElementById("file-input-edit-" + identifier);
    const imagePreviewEdit = document.getElementById("image-preview-edit-" + identifier);

    if (fileInputEdit.files && fileInputEdit.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreviewEdit.src = e.target.result;
            imagePreviewEdit.style.display = "block";
        };

        reader.readAsDataURL(fileInputEdit.files[0]);
    } else {
        // If no file is selected, set the image to the database photo
        const fotoURL = document.getElementById("up-preview-image-" + identifier).getAttribute("data-foto-url");
        imagePreviewEdit.src = fotoURL;
        imagePreviewEdit.style.display = "block";
    }
}

// function liveSearch() {
//     $('#search').on('keyup', function() {
//         var query = $(this).val()
//         if (query !== '') {
//             $.ajax({
//                 url: '/search', // Replace with the appropriate route URL
//                 type: 'GET',
//                 data: { query: query },
//                 success: function(data) {
//                     $('#search-results').html(data)
//                 }
//             })
//         } else {
//             $('#search-results').empty()
//         }
//     })
// }

$(document).ready(function () {
    $("#search").on("keyup", function () {
        let value = $(this).val().toLowerCase();
        let url = new URL(window.location.href);
        url.searchParams.set("search", value);
        url.searchParams.delete("page");

        $.ajax({
            url: newURL,
            success: function (result) {
                $("#table-body").html($(result).find("#table-body").html());

                $(".pagination a").each(function () {
                    let href = $(this).attr("href");
                    href = href.split("?")[0] + "?" + url.searchParams.toString();
                    $(this).attr("href", href);
                });
            },
        });
    });
});
