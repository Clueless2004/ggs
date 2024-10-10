const gallery = document.querySelector('.gallery');
    const images = document.querySelectorAll('.gallery-images img');
    let currentIndex = 0;

    // Function to show the current image based on index
    function showImage(index) {
        images.forEach((img) => {
            img.classList.remove('active');  // Remove the active class from all images
        });
        images[index].classList.add('active');  // Add the active class to the current image
    }

    // Listen to scroll events on the gallery container
    gallery.addEventListener('wheel', (event) => {
        if (event.deltaY > 0) {
            // Scroll down: show next image if not at the last image
            if (currentIndex < images.length - 1) {
                currentIndex++;
                showImage(currentIndex);
            }
        } else {
            // Scroll up: show previous image if not at the first image
            if (currentIndex > 0) {
                currentIndex--;
                showImage(currentIndex);
            }
        }
        event.preventDefault();  // Prevent default scroll behavior
    });

    // Event listeners for the up and down buttons
    document.querySelector('.arrow.up').addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            showImage(currentIndex);
        }
    });

    document.querySelector('.arrow.down').addEventListener('click', () => {
        if (currentIndex < images.length - 1) {
            currentIndex++;
            showImage(currentIndex);
        }
    });

    // Initial display: show the first image
    showImage(currentIndex);