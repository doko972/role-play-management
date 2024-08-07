function toggleEditForm(postId) {
    const form = document.getElementById(`editForm-${postId}`);
    if (form.classList.contains('editForm')) {
        form.classList.remove('editForm');
    } else {
        form.classList.add('editForm');
    }
}