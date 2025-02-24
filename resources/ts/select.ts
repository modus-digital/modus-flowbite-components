interface SelectOption {
    value: string;
    label: string;
}

interface SelectConfig {
    name: string;
    options: SelectOption[];
    placeholder: string;
    value: string | string[];
    required: boolean;
    searchable: boolean;
    multiple: boolean;
}

interface AlpineInstance {
    $watch: (property: string, callback: (value: any) => void) => void;
    $el: HTMLElement;
    $nextTick: (callback: () => void) => void;
    error: boolean;
    selectedValue: string | string[];
    multiple: boolean;
    searchable: boolean;
    options: SelectOption[];
    isOpen: boolean;
}

function select(config: SelectConfig) {
    return {
        name: config.name,
        options: config.options || [],
        isOpen: false,
        selectedValue: config.multiple ? (config.value ? [config.value] : []) : config.value,
        search: '',
        error: false,
        searchable: config.searchable,
        multiple: config.multiple,

        get selectedLabel() {
            if (this.multiple) {
                if (!this.selectedValue.length) return config.placeholder;
                return this.options
                    .filter(opt => (this.selectedValue as string[]).includes(opt.value))
                    .map(opt => opt.label)
                    .join(', ');
            }
            if (!this.selectedValue) return config.placeholder;
            const option = this.options.find(opt => opt.value === this.selectedValue);
            return option ? option.label : config.placeholder;
        },

        get filteredOptions() {
            return this.options.filter(option => 
                option.label.toLowerCase().includes(this.search.toLowerCase())
            );
        },

        toggle() {
            this.isOpen = !this.isOpen;
        },

        close() {
            this.isOpen = false;
            this.search = '';
        },

        select(option: SelectOption) {
            if (this.multiple) {
                const values = this.selectedValue as string[];
                const index = values.indexOf(option.value);
                if (index === -1) {
                    values.push(option.value);
                } else {
                    values.splice(index, 1);
                }
                this.selectedValue = [...values];
            } else {
                this.selectedValue = option.value;
                this.close();
            }
        },

        isSelected(option: SelectOption) {
            return this.multiple 
                ? (this.selectedValue as string[]).includes(option.value)
                : option.value === this.selectedValue;
        },

        init(this: AlpineInstance) {
            if (config.required) {
                this.$watch('selectedValue', (value) => {
                    this.error = this.multiple 
                        ? !(value as string[]).length 
                        : !value;
                });
            }
        }
    };
}

// Replace the bottom part with this new code
declare global {
    interface Window {
        Alpine: any;
    }
}

// Check if Alpine is available and register the component
if (window.Alpine) {
    window.Alpine.data('select', select);
} else {
    // If Alpine isn't available yet, wait for alpine:init event
    document.addEventListener('alpine:init', () => {
        window.Alpine.data('select', select);
    });
}

export default select;
