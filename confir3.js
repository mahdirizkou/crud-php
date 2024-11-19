function confirmDelete(id) {
    if (confirm("Are you sure you want to delete this ligne?")) {
        window.location.href = "delete3.php?id=" + id;
    }
}