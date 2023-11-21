import './bootstrap';

import Alpine from 'alpinejs';
import ujs from '@rails/ujs';

window.Alpine = Alpine;

Alpine.start();

// const ujs = require('@rails/ujs');
ujs.start();
