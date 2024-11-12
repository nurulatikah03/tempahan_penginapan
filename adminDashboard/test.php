<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<style>
    .rounded-button {
        border-radius: 25px;
        margin: 15px 16px;
        padding: 10px 30px;
    }
</style>

<body>

        <!-- Button trigger delete modal -->
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 25px; top: 25px;"></button>
                        <div class="text-center p-4">
                            <img src="assets/icon-svg/alert.svg" alt="Alert Icon" class="mb-3" style="height: 100px">
                        </div>
                        <div class="text-center">
                            <h1 class="modal-title fs-5" id="deleteModalLabel">Delete [room-name]?</h1>
                        
                            <p class="pt-3"> action cannot be undone. </p>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-secondary rounded-button" data-bs-dismiss="modal">No, Keep it.</button>
                            <button type="button" class="btn btn-danger rounded-button">Yes, Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>