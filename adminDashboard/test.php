<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<style>
    .drop-area {
        width: 50%;
        height: 200px;
        max-width: 800px;
        max-height: 200px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .drop-area.highlight {
        border-color: #2196f3;
        background-color: rgba(33, 150, 243, 0.1);
    }

    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
        justify-content: center;
        padding-left: 20px;
        padding-right: 20px;
    }

    .preview-image {
        max-width: 200px;
        max-height: 200px;
        object-fit: cover;
    }

    .modal-lg-custom {
        max-width: 1000px;
    }

    .remove-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(255, 0, 0, 0.089);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        width: 20px;
        height: 20px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .remove-button:hover {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        width: 20px;
        height: 20px;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Popup container */
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    /* The actual popup (appears on top) */
    .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class when clicking on the popup container (hide and show the popup) */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<body>
    <h1>Drag-and-Drop File Uploader</h1>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary rounded-button" data-bs-toggle="modal" data-bs-target="#uploadModal-1">
        Open Uploader 1
    </button>
    <button type="button" class="btn btn-primary rounded-button" data-bs-toggle="modal" data-bs-target="#uploadModal-2">
        Open Uploader 2
    </button>

    <form action="test2.php" method="post" enctype="multipart/form-data">
        <div class="drop-area" id="drop-area">
            <p>Drag & Drop your files here or click to select files</p>
            <input type="file" id="fileElem" multiple accept="image/*" style="display:none" name="file2">
        </div>
        <button type="submit">Submit</button>
    </form>
    <div id="preview-container"></div>

    <script>
        let dropArea = document.getElementById('drop-area');
        let fileElem = document.getElementById('fileElem');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        // Highlight drop area when item is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);

        // Trigger file input when clicking on the drop area
        dropArea.addEventListener('click', () => fileElem.click());

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function highlight(e) {
            dropArea.classList.add('highlight');
        }

        function unhighlight(e) {
            dropArea.classList.remove('highlight');
        }

        function handleDrop(e) {
            let dt = e.dataTransfer;
            let files = dt.files;

            handleFiles(files);
        }

            function handleFiles(files, previewContainer, dropAreaId) {
            const dropArea = document.getElementById(dropAreaId);
            
            // Clear drop area content
            dropArea.innerHTML = '';
            dropArea.style.padding = '0'; // Remove padding for image fit
            
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    const preview = document.createElement('div');
                    preview.style.position = 'relative';
                    preview.style.width = '100%';
                    preview.style.height = '100%';
        
                    reader.onload = function(e) {
                        const newImgURL = e.target.result;
                        preview.innerHTML = `
                            <img src="${newImgURL}" style="
                                width: auto;
                                height: auto;
                                max-width: 800px;
                                max-height: 200px;
                                object-fit: cover;
                                border-radius: 8px;
                            ">
                            <input type="hidden" name="newImgURLs[]" value="${newImgURL}">
                        `;
                        dropArea.appendChild(preview);
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
        }
        
        // Update event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileElem');
            const dropAreaId = 'drop-area';
        
            fileInput.addEventListener('change', function(e) {
                handleFiles(this.files, null, dropAreaId);
            });
        
            const dropArea = document.getElementById(dropAreaId);
            dropArea.addEventListener('drop', function(e) {
                e.preventDefault();
                const dt = e.dataTransfer;
                const files = dt.files;
                handleFiles(files, null, dropAreaId);
            });
        });
        
    </script>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</script>

<script>

</script>



</body>

</html>