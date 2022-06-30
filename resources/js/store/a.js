require('../bootstrap');
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import swal from 'sweetalert2';
window.Swal = swal;

require('select2');
require('flatpickr');
require('dropzone');
require('quill');