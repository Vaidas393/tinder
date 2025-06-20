import './bootstrap';
import 'emoji-picker-element';

window.insertEmojiToInput = function(emoji) {
    const input = document.querySelector('.input-msg-text');
    if (input) {
        const start = input.selectionStart;
        const end = input.selectionEnd;
        const value = input.value;
        input.value = value.substring(0, start) + emoji + value.substring(end);
        input.dispatchEvent(new Event('input', { bubbles: true }));
        input.focus();
        input.selectionStart = input.selectionEnd = start + emoji.length;
    }
}

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
