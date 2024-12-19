document.addEventListener('DOMContentLoaded', function () {
    for (let i = 1; i <= 2; i++) {
        const dropArea = document.getElementById(`drop-area-${i}`);
        const fileInput = document.getElementById(`fileElem-${i}`);
        const newImageMessage = document.getElementById(`new-image-message-${i}`);

        // Add click event listener to open file dialog
        dropArea.addEventListener('click', () => {
            fileInput.click();
        });

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults);
        });

        // Highlight drop zone when dragging over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.add('highlight');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => {
                dropArea.classList.remove('highlight');
            });
        });

        // Handle dropped files
        dropArea.addEventListener('drop', function (e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            handleFile(files[0], dropArea, fileInput, newImageMessage);
        });

        // Handle file selection through input
        fileInput.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                handleFile(this.files[0], dropArea, fileInput, newImageMessage);
            }
        });
    }
});

// Prevent default behaviors for drag-and-drop
function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

// Handle file preview
function handleFile(file, dropArea, fileInput, newImageMessage) {
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const imageUrl = e.target.result;
            dropArea.style.backgroundImage = `url(${imageUrl})`;
            dropArea.style.backgroundSize = 'cover';
            dropArea.style.backgroundPosition = 'center';
            dropArea.textContent = ''; // Clear the text inside the drop area

            // Show the new image message
            newImageMessage.style.display = 'block';
        };

        reader.readAsDataURL(file);

        // Update the hidden file input
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        fileInput.files = dataTransfer.files;
    }
}

/**
 * Updates the preview box with the selected image.
 * @param {HTMLInputElement} input - The file input element.
 * @param {number} index - The index of the image slot.
 */
function previewImage(input, index) {
    const file = input.files[0];
    const preview = document.getElementById(`previewAdd-${index}`);
    preview.innerHTML = ""; // Clear existing content

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement("img");
            img.src = e.target.result;
            img.className = "img-fluid";
            img.style = "height: 100%; width: 100%; object-fit: cover;";
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}

function handleFileSelect(input) {
    const container = document.getElementById('imagePreviewContainer');

    Array.from(input.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const previewBox = document.createElement('div');
            previewBox.className = 'preview-box position-relative';
            previewBox.dataset.fileIndex = index;
            previewBox.innerHTML = `
										<div class="preview-link" style="border: 2px solid #ccc; border-radius: 25px; height: 250px; width: 250px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
											<img src="${e.target.result}" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
										</div>
										<button type="button" class="btn delete-btn" onclick="deletePreview(this)">Delete</button>
									`;
            container.appendChild(previewBox);
        };
        reader.readAsDataURL(file);
    });
}

function deletePreview(button) {
    const previewBox = button.closest('.preview-box');
    const fileIndex = parseInt(previewBox.dataset.fileIndex);

    // Remove preview box from DOM
    previewBox.remove();

    // Update files array by removing deleted file
    const input = document.getElementById('fileElemAdd');
    const dt = new DataTransfer();

    Array.from(input.files)
        .filter((_, index) => index !== fileIndex)
        .forEach(file => dt.items.add(file));

    input.files = dt.files;
}