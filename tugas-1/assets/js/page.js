window.setTimeout(function () {
    $("#myAlert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 3000);
$(document).ready(function () {
    $('#example').DataTable();
});
function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        window.location.href = 'delete.php?id=' + id;
    }
}

function previewImage() {
    const gambarInput = document.getElementById('gambarInput');
    const gambarPreview = document.getElementById('gambarPreview');

    if (gambarInput.files && gambarInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            gambarPreview.src = e.target.result;
            gambarPreview.style.display = 'block';
        }

        reader.readAsDataURL(gambarInput.files[0]);
    }
}
