document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-pin-target]').forEach((target) => {
        function focusNextInput(el: HTMLInputElement, prevId: string | null, nextId: string | null): void {
            if (el.value.length === 0) {
                if (prevId) {
                    const prevElement = document.getElementById(prevId);
                    if (prevElement instanceof HTMLElement) {
                        prevElement.focus();
                    }
                }
            } else {
                if (nextId) {
                    const nextElement = document.getElementById(nextId);
                    if (nextElement instanceof HTMLElement) {
                        nextElement.focus();
                    }
                }
            }
        }
        
        (document.querySelectorAll('[data-focus-input-init]') as NodeListOf<HTMLInputElement>).forEach((element) => {
            element.addEventListener('keyup', function(this: HTMLInputElement) {
                const prevId = this.getAttribute('data-focus-input-prev');
                const nextId = this.getAttribute('data-focus-input-next');
                focusNextInput(this, prevId, nextId);
            });
            
            // Handle paste event to split the pasted code into each input
            element.addEventListener('paste', function(this: HTMLInputElement, event: Event) {
                const pasteEvent = event as ClipboardEvent;
                pasteEvent.preventDefault();
                const pasteData = pasteEvent.clipboardData?.getData('text') || '';
                const digits = pasteData.replace(/\D/g, ''); // Only take numbers from the pasted data
        
                // Get all input fields
                const inputs = document.querySelectorAll<HTMLInputElement>('[data-focus-input-init]');
                
                // Iterate over the inputs and assign values from the pasted string
                inputs.forEach((input, index) => {
                    if (digits[index]) {
                        input.value = digits[index];
                        // Focus the next input after filling the current one
                        const nextId = input.getAttribute('data-focus-input-next');
                        if (nextId) {
                            const nextElement = document.getElementById(nextId);
                            if (nextElement instanceof HTMLElement) {
                                nextElement.focus();
                            }
                        }
                    }
                });
            });
        });
    });
});
