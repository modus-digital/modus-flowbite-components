type PrimaryColor = 'blue' | 'red' | 'green' | 'purple' | 'pink';
type ToastPosition = 'top-right' | 'top-left' | 'bottom-right' | 'bottom-left';

export type ModusUIConfig = {
    prefix: string;
    primary_color: PrimaryColor;
    toasts: {
        position: ToastPosition;
        duration: number;
    };
}