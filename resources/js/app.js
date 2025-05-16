import './bootstrap';
import '../css/app.css';
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.Livewire = Livewire;

Alpine.start();
