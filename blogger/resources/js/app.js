import 'tinymce/tinymce';
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/content/default/content.min.css';
import 'tinymce/skins/content/default/content.css';
import 'tinymce/icons/default/icons';
import 'tinymce/themes/silver/theme';
import 'tinymce/models/dom/model';
import './bootstrap';
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";
window.Alpine = Alpine;
Alpine.start();

window.addEventListener('DOMContentLoaded', () => {
    tinymce.init({
        selector: '.tinyMce',
        skin: false,
        content_css: false
    });
});
