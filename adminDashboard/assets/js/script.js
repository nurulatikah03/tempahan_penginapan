    document.addEventListener('DOMContentLoaded', function() {
        // Setup for each modal (1-3)
        for (let i = 1; i <= 3; i++) {
            const modal = document.getElementById(`uploadModal-${i}`);
            const dropArea = document.getElementById(`drop-area-${i}`);
            const previewContainer = document.getElementById(`preview-container-${i}`);
            const fileInput = document.getElementById(`fileElem-${i}`);
            
            // Add click event listener for the drop area
            dropArea.addEventListener('click', () => {
                fileInput.click();
            });
            
            // Clear previews when modal closes
            modal.addEventListener('hidden.bs.modal', function() {
                previewContainer.innerHTML = '';
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
            dropArea.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files, previewContainer);
            });
        }
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Create an array to store image URLs
    let newImgURLs = [];
    
    document.addEventListener('DOMContentLoaded', function() {
        // Setup for each modal (1-3)
        for (let i = 1; i <= 3; i++) {
            const fileInput = document.getElementById(`fileElem-${i}`);
            const previewContainer = document.getElementById(`preview-container-${i}`);
            
            fileInput.addEventListener('change', function(e) {
                handleFiles(this.files, previewContainer);
            });
        }
    });

    
    function handleFiles(files, previewContainer) {
        previewContainer.innerHTML = '';
        
        Array.from(files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                const preview = document.createElement('div');
                preview.style.position = 'relative';
                preview.style.display = 'inline-block';
                
                reader.onload = function(e) {
                    // Store the Data URL
                    const newImgURL = e.target.result;
                    newImgURLs.push(newImgURL);
                    preview.innerHTML = `
                        <a href="javascript:void(0)" onclick="this.parentElement.remove()" class="preview-link">
                            <img src="${newImgURL}" class="preview-image" style="border-radius: 25px;">
                            <span class="remove-button">Padam</span>
                        </a>
                        <input type="hidden" name="newImgURLs[]" value="${newImgURL}">
                    `;
                };
                
                reader.readAsDataURL(file);
                previewContainer.appendChild(preview);
            }
        });
        
    }