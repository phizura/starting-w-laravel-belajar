// delete handler
document.addEventListener("DOMContentLoaded", function () {
    const delConfirmButtons = document.querySelectorAll(".del-confirm-btn");

    delConfirmButtons.forEach(function (button) {
        button.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent the default form submission

            const form = this.closest("form"); // Get the closest form element

            Swal.fire({
                title: "Are you sure?",
                text: "Post ini akan terhapus secara permanen, periksa terlebih dahulu!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus post!",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
