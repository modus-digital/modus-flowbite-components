import { handleDropzoneColor, truncateFileName, formatFileSize } from './helpers';

type HandleFilesConfig = {
    placeholder: HTMLDivElement;
    content: HTMLDivElement;
}

const primaryColor = handleDropzoneColor(window.ModusUIConfig.primary_color);
const handleFiles = (files: FileList | null, config: HandleFilesConfig) => {
    if (!files) return;

    config.placeholder.classList.add('hidden');
    config.content.classList.remove('hidden');

    for (const file of files) {
        const filePreviewElement = document.createElement('div');
        const fileInfoElement = document.createElement('div');
        const fileNameElement = document.createElement('span');

        filePreviewElement.classList.add(
            'file-preview', 
            'flex', 
            'justify-between', 
            'items-center', 
            'bg-gray-100', 
            'dark:bg-gray-700', 
            'rounded', 
            'p-2',
            'mb-2',
            'group',
            'hover:bg-gray-200',
            'dark:hover:bg-gray-600',
            'transition-all',
            'duration-200'
        );
        
        fileInfoElement.classList.add('flex', 'items-center', 'gap-3');
        fileNameElement.classList.add('text-gray-900', 'dark:text-white', 'truncate', 'max-w-[200px]');
        fileNameElement.textContent = `${truncateFileName(file.name, 20)} (${formatFileSize(file.size)})`;

        // Create preview element (either image or icon)
        let previewElement: HTMLElement;
        if (file.type.startsWith('image/')) {
            previewElement = document.createElement('img') as HTMLImageElement;
            (previewElement as HTMLImageElement).src = URL.createObjectURL(file);
            previewElement.classList.add('w-6', 'h-6', 'rounded', 'object-cover', 'flex-shrink-0');
        } else {
            previewElement = document.createElement('div');
            previewElement.classList.add('flex-shrink-0', 'text-gray-500', 'dark:text-gray-400');
            previewElement.innerHTML = '<svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2h-7Z" clip-rule="evenodd"/></svg>';
        }

        fileInfoElement.appendChild(previewElement);
        fileInfoElement.appendChild(fileNameElement);

        const removeButton: HTMLButtonElement = document.createElement('button');
        removeButton.classList.add('text-gray-500', 'dark:text-gray-400', 'duration-200','p-1.5','rounded-full','group-hover:bg-red-100','group-hover:text-red-600','dark:group-hover:bg-red-900/30','dark:group-hover:text-red-400','outline-none','focus:ring-2','focus:ring-red-500/50');
        removeButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>';

        removeButton.addEventListener('click', () => {
            filePreviewElement.remove();

            if (config.content.children.length === 0) {
                config.placeholder.classList.remove('hidden');
                config.content.classList.add('hidden');
            }
        });

        filePreviewElement.appendChild(fileInfoElement);
        filePreviewElement.appendChild(removeButton);

        config.content.appendChild(filePreviewElement);
    }
}

const initDropzone = (target: string) => {
    const dropzone: HTMLDivElement = document.querySelector(`[data-dropzone-target="${target}"]`) as HTMLDivElement;
    if (!dropzone) throw new Error(`Dropzone with target ${target} not found`);

    const fileInput: HTMLInputElement = dropzone.querySelector('input[type="file"]') as HTMLInputElement;
    const content: HTMLDivElement = dropzone.querySelector('.dropzone-content') as HTMLDivElement;
    const placeholder: HTMLDivElement = dropzone.querySelector('.dropzone-placeholder') as HTMLDivElement;

    dropzone.addEventListener('dragover', (event: DragEvent) => { event.preventDefault(); dropzone.classList.add(primaryColor); console.log('dragover'); });
    dropzone.addEventListener('dragleave', (event: DragEvent) => { event.preventDefault(); dropzone.classList.remove(primaryColor) });
    dropzone.addEventListener('drop', (event: DragEvent) => { 
        event.preventDefault();
        dropzone.classList.remove(primaryColor);
        
        if (!event.dataTransfer) return;
        handleFiles(event.dataTransfer.files, { placeholder, content });
    });
    dropzone.addEventListener('click', (event: MouseEvent) => {
        const target = event.target as HTMLElement;
        if (target === dropzone || !target.closest('.file-preview')) {
            fileInput.click();
        }
    });

    fileInput.addEventListener('change', () => handleFiles(fileInput.files, { placeholder, content }));
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-dropzone-target]').forEach((element) => {
        const target = element.getAttribute('data-dropzone-target') as string;
        initDropzone(target);
    });
});
