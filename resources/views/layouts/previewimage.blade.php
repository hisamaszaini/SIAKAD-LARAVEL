<script>
    document.getElementById('image-upload').addEventListener('change', function() {
        const file = this.files[0];
        const previewContainer = document.getElementById('image-preview');

        if (file && file.type.match('image.*')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageUrl = e.target.result;
                previewContainer.style.backgroundImage = `url(${imageUrl})`;
                previewContainer.style.backgroundSize = 'cover';
                previewContainer.style.backgroundPosition = 'center';
                previewContainer.style.height = '200px';
                previewContainer.innerHTML = ''; 
            };

            reader.readAsDataURL(file);
        } else {
            previewContainer.style.backgroundImage = 'none';
            previewContainer.innerHTML = '<label for="image-upload" id="image-label">Choose File</label>';
        }
    });
</script>