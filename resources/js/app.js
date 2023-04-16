import './bootstrap';
import '../sass/app.scss'
import '../css/style.css';

import Alpine from 'alpinejs';
import mask from '@alpinejs/mask'

window.Alpine = Alpine;
Alpine.plugin(mask)
Alpine.start();
