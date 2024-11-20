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
<?php

include_once '../Models/room.php';
$room = Room::getRoomById('1'); ?>

<body>

    <?php
    $url = $room->getRoomImageByType($room->getId(), 'add'); // Get the list of image URLs
    $oldUrl = 'assets/images/background/FjKtytrXoAMVQuZ.jpg';
    $newURL = 'assets/images/background/room1.jpg';
    ?>
<div id="image-grid" class="grid-container">
    <!-- 9 grid cells -->
    <div class="grid-item" data-index="1"></div>
    <div class="grid-item" data-index="2"></div>
    <div class="grid-item" data-index="3"></div>
    <div class="grid-item" data-index="4"></div>
    <div class="grid-item" data-index="5"></div>
    <div class="grid-item" data-index="6"></div>
    <div class="grid-item" data-index="7"></div>
    <div class="grid-item" data-index="8"></div>
    <div class="grid-item" data-index="9"></div>
</div>

<style>
.grid-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    width: 100%;
    max-width: 600px;
    margin: auto;
}
.grid-item {
    width: 100%;
    padding-top: 100%; /* Aspect ratio 1:1 */
    position: relative;
    border: 1px solid #ccc;
    background-color: #f9f9f9;
    overflow: hidden;
    cursor: pointer;
}
.grid-item img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.grid-item .placeholder {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #aaa;
}
</style>

    <form action="test3.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <?php
            for ($i = 1; $i <= 9; $i++):
                $image = isset($url[$i - 1]) ? htmlspecialchars($url[$i - 1]) : null; // Get the image for the current slot, or set null if none
            ?>
                <div class="col-md-4 mb-3">
                    <div class="drop-area" id="drop-area-<?php echo $i; ?>" onclick="document.getElementById('fileInput-<?php echo $i; ?>').click();">
                        <?php if ($image): ?>
                            <img src="../<?php echo $image; ?>" alt="Image <?php echo $i; ?>" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
                        <?php else: ?>
                            <p>Click to select file <?php echo $i; ?></p>
                        <?php endif; ?>
                        <input type="file" id="fileInput-<?php echo $i; ?>" name="files[]" accept="image/*" style="display: none;">
                    </div>
                    <div class="preview-container" id="preview-container-<?php echo $i; ?>"></div>
                </div>
            <?php endfor; ?>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    <script>
        for (let i = 1; i <= 9; i++) {
            const dropArea = document.getElementById(`drop-area-${i}`);
            const fileInput = document.getElementById(`fileInput-${i}`);
            const previewContainer = document.getElementById(`preview-container-${i}`);

            dropArea.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', handleFiles);
            dropArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropArea.classList.add('highlight');
            });

            dropArea.addEventListener('dragleave', () => dropArea.classList.remove('highlight'));

            dropArea.addEventListener('drop', (e) => {
                e.preventDefault();
                dropArea.classList.remove('highlight');
                const files = e.dataTransfer.files;
                handleFiles({
                    target: {
                        files
                    }
                });
            });

            function handleFiles(e) {
                const files = e.target.files;
                previewContainer.innerHTML = '';
                for (const file of files) {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onloadend = () => {
                        const img = document.createElement('img');
                        img.src = reader.result;
                        img.classList.add('preview-image');
                        previewContainer.appendChild(img);
                        dropArea.style.display = 'none';
                    };
                }
            }
        }
    </script>


    <script>

    </script>


</body>

</html>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</script>

<script>

</script>



</body>

</html>