export const handleDropzoneColor = (color: string) => {
    switch (color) {
        default:
        case 'blue':
            return 'border-blue-500';

        case 'red':
            return 'border-red-500';

        case 'green':
            return 'border-green-500';

        case 'purple':
            return 'border-purple-500';

        case 'pink':
            return 'border-pink-500';
    }
}

export const truncateFileName = (name: string, maxLength: number = 20) => {
    const extensionIndex = name.lastIndexOf('.');
    const fileName = name.slice(0, extensionIndex);
    const extension = name.slice(extensionIndex);

    return fileName.length > maxLength
        ? `${fileName.slice(0, maxLength)}...${extension}`
        : name;
}

export const formatFileSize = (size: number) => {
    const units = ['B', 'KB', 'MB', 'GB', 'TB'];

    let unitIndex = 0;

    while (size >= 1024 && unitIndex < units.length - 1) {
        size /= 1024;
        unitIndex++;
    }
    
    return `${unitIndex === 0 ? Math.round(size) : size.toFixed(2)} ${units[unitIndex]}`;
}
