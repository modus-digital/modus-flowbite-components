import { ToastOptions } from './types/toasts';

window.toast = function (message: string, options: ToastOptions) {
    window.dispatchEvent(new CustomEvent('toast', {
        detail: {
            message: message,
            title: options.title || null,
            level: options.level || 'info'
        }
    }));
};