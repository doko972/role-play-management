document.addEventListener('DOMContentLoaded', (event) => {
    const button = document.querySelector('#emoji-button');
    const picker = new EmojiButton();
    picker.on('emoji', emoji => {
        document.querySelector('#post-content').value += emoji;
    });
    button.addEventListener('click', () => {
        picker.togglePicker(button);
    });
});