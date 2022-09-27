var editButtons = document.querySelectorAll('.edit-button')

editButtons.forEach((item) => {
    item.addEventListener('click', function(e) {
        element = e.currentTarget;
        var parent = element.closest('.task-item');

        var id = parent.querySelector('.task-item__id').dataset.id;
        var text = parent.querySelector('.task-item__text').innerText;

        var editForm = document.querySelector('.editing-form');
        editForm.querySelector('input[name="id"]').value = id;
        editForm.querySelector('textarea[name="text"]').innerText = text;

        editForm.classList.remove("hidden");
        document.querySelector('.creation-form').classList.add("hidden");
    });
});

var editForm = document.querySelector('.editing-form');
if (editForm != undefined) {
    editForm.querySelector('button[name="cancel"]').addEventListener('click', function() {
        editForm.classList.add("hidden");
        document.querySelector('.creation-form').classList.remove("hidden");
    });
}
