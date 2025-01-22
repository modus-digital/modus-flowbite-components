export type ToastLevel = 'info' | 'success' | 'warning' | 'error';

export interface ToastOptions {
    title?: string;
    level?: ToastLevel;
}