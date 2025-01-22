import { ToastOptions } from './toasts';
import { ModusUIConfig } from './config';

declare global {
    interface Window {
        toast: (message: string, options: ToastOptions) => void;
        ModusUIConfig: ModusUIConfig;
    }
}
