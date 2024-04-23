import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if (document.getElementById('dropzone')) {
    const dropzone = new Dropzone('#dropzone', {
        acceptedFiles: '.png, .jpg, .jpeg, .gif',
        addRemoveLinks: true,
        maxFiles: 1,
        uploadMultiple: false,
        init: function () {
            if (document.getElementById('hdn_image').value.trim()) {
                const publicImage = {};
                publicImage.size = 1234;
                publicImage.name = document.getElementById('hdn_image').value;

                this.options.addedfile.call(this, publicImage);
                this.options.thumbnail.call(this, publicImage, `/uploads/${publicImage.name}`);

                publicImage.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    });

    dropzone.on('success', function (file, response) {
        document.getElementById('hdn_image').value = response.image;
    });

    dropzone.on('removedfile', function () {
        document.getElementById('hdn_image').value = '';
    });
}