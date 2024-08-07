function toggleEdit() {
  const editForm = document.getElementById('editForm');
  const displayArea = document.getElementById('displayArea');
  const editButton = document.getElementById('editButton');
  if (editForm.style.display === 'none' || editForm.style.display === '') {
    editForm.style.display = 'block';
    displayArea.style.display = 'none';
    editButton.style.display = 'none';
  } else {
    editForm.style.display = 'none';
    displayArea.style.display = 'block';
    editButton.style.display = 'block';
  }
}
