$(document).ready(function () {
    var counter;
    var counterInterval;
    var intervalTime = 30; // 30 seconds for images
    var lastMediaCount = null;
    var selectedCasinoId = Cookies.get("casino_id");
    var cacheKey = 'carousel_data_' + selectedCasinoId;

    // Crear el div del contador una sola vez
    var $counterDisplay = $('<div class="counter">30</div>');
    $('body').append($counterDisplay);  // Añadido una vez al cargar la página
/*
    function checkForUpdates() {
        $.ajax({
            url: '../admin/optimized-check-updates.php',
            method: 'GET',
            data: { casino_id: selectedCasinoId },
            success: function (data) {
                if (lastMediaCount === null || lastMediaCount !== data.media_count) {
                    updateCarousel(data.media);
                }
                lastMediaCount = data.media_count;
            },
            error: function() {
                console.log("Error fetching updates, using cache if available.");
                var cachedData = localStorage.getItem(cacheKey);
                if (cachedData) {
                    updateCarousel(JSON.parse(cachedData));
                }
            }
        });
    }

*/

function checkForUpdates() {
    $.ajax({
        url: '../admin/optimized-check-updates.php',
        method: 'GET',
        data: { casino_id: selectedCasinoId },
        success: function (data) {
            // Actualiza el carrusel si hay cambios en la cantidad de medios
            if (lastMediaCount === null || lastMediaCount !== data.media_count) {
                updateCarousel(data.media);
            }
            
            // Guarda la nueva cuenta de medios
            lastMediaCount = data.media_count;
            
            // Comprueba si el número de elementos es 0
            var $carouselItems = $('#carousel1 .carousel-inner .item');
            if ($carouselItems.length === 0) {
                console.log("No hay elementos en el carrusel. Recargando la página en 2 minutos.");
                
                // Configura una recarga automática de la página después de 2 minutos
                setTimeout(function() {
                    location.reload();
                }, 30000); // 120,000 milisegundos = 2 minutos
            }
        },
        error: function() {
            console.log("Error fetching updates, using cache if available.");
            var cachedData = localStorage.getItem(cacheKey);
            if (cachedData) {
                updateCarousel(JSON.parse(cachedData));
            }
        }
    });
}



    function updateCarousel(newMedia) {
        var $carousel = $('#carousel1 .carousel-inner');
        var currentItems = $carousel.children('.item').toArray();
        var currentIndex = $carousel.children('.item.active').index();

        // Remove items that are no longer present
        currentItems.forEach(function(item) {
            var src = $(item).find('img, video source').attr('src');
            if (!newMedia.some(media => media.src === src)) {
                $(item).remove();
            }
        });

        // Add new items
        newMedia.forEach(function(item, index) {
            var $existingItem = $carousel.find('img[src="' + item.src + '"], video source[src="' + item.src + '"]').closest('.item');
            if ($existingItem.length === 0) {
                var $newItem = $('<div class="item">');
                if (item.type === 'video') {
                    $newItem.append('<video class="full-width-video" muted><source src="' + item.src + '" type="video/mp4"></video>');
                } else {
                    $newItem.append('<img src="' + item.src + '" alt="Media" loading="lazy">');
                }
                $carousel.append($newItem);
            }
        });

        // Ensure the active item hasn't changed
        var $items = $carousel.children('.item');
        if (currentIndex >= 0 && currentIndex < $items.length) {
            $items.removeClass('active');
            $items.eq(currentIndex).addClass('active');
        } else if ($items.length > 0) {
            $items.first().addClass('active');
        }

        // Reinitialize the carousel if needed
        if ($('#carousel1').data('bs.carousel')) {
            $('#carousel1').carousel('pause');
            $('#carousel1').carousel('cycle');
        } else {
            initializeCarousel();
        }

        handleVideoPlayback(); // Asegúrate de que el video se maneje después de la actualización
    }
/*
function updateCarousel(newMedia) {
    var $carousel = $('#carousel1 .carousel-inner');
    var currentItems = $carousel.children('.item').toArray();
    var currentIndex = $carousel.children('.item.active').index();

    // Remove items that are no longer present
    currentItems.forEach(function(item) {
        var src = $(item).find('img, video source').attr('src');
        if (!newMedia.some(media => media.src === src)) {
            $(item).remove();
        }
    });

    // Add new items
    newMedia.forEach(function(item) {
        var $existingItem = $carousel.find('img[src="' + item.src + '"], video source[src="' + item.src + '"]').closest('.item');
        if ($existingItem.length === 0) {
            var $newItem = $('<div class="item">');
            if (item.type === 'video') {
                $newItem.append('<video class="full-width-video" muted><source src="' + item.src + '" type="video/mp4"></video>');
            } else {
                $newItem.append('<img src="' + item.src + '" alt="Media" loading="lazy">');
            }
            $carousel.append($newItem);
        }
    });

    var $items = $carousel.children('.item');

    // Si no hay elementos en el carrusel, recargar la página
    if ($items.length === 0) {
        console.log("No items found in the carousel. Reloading the page.");
        location.reload();
    } else {
        // Asegurarse de que el item activo no ha cambiado
        if (currentIndex >= 0 && currentIndex < $items.length) {
            $items.removeClass('active');
            $items.eq(currentIndex).addClass('active');
        } else {
            $items.removeClass('active');
            $items.first().addClass('active'); // Marcar el primer elemento como activo
        }

        // Reanudar el carrusel si ya está inicializado
        if ($('#carousel1').data('bs.carousel')) {
            $('#carousel1').carousel('cycle');
        } else {
            initializeCarousel(); // Inicializar el carrusel si no está activo
        }

        handleVideoPlayback(); // Asegurarse de que el video se maneje después de la actualización
    }
}

*/
    function initializeCarousel() {
        var cachedData = localStorage.getItem(cacheKey);
        if (cachedData) {
            updateCarousel(JSON.parse(cachedData));
        }

        $('#carousel1').carousel({
            interval: false
        });

        $('#carousel1').on('slid.bs.carousel', handleVideoPlayback);

        // Hacer una verificación inicial solo si `selectedCasinoId` está definido
        if (selectedCasinoId !== undefined) {
            handleVideoPlayback();
            checkForUpdates(); // Initial check
        }
    }

    function updateCounterDisplay() {
        $counterDisplay.text(counter);  // Actualizar el texto en lugar de crear un nuevo div
    }

    function startCounter(duration) {
        counter = duration;
        updateCounterDisplay();
        clearInterval(counterInterval);
        counterInterval = setInterval(function () {
            counter--;
            updateCounterDisplay();
            if (counter <= 0) {
                clearInterval(counterInterval);
                $('#carousel1').carousel('next');
            }
        }, 1000);
    }

    function handleVideoPlayback() {
        var $activeItem = $('.carousel-inner .item.active');
        var $video = $activeItem.find('video');

        if ($video.length > 0) {
            $('#carousel1').carousel('pause');
            $video[0].play();
            $video[0].onended = function () {
                $('#carousel1').carousel('cycle');
                $('#carousel1').carousel('next');
            };
            startCounter(Math.ceil($video[0].duration));
        } else {
            startCounter(intervalTime);
        }
    }

    setInterval(checkForUpdates, 30000); // Check every 30 seconds

    if (selectedCasinoId === undefined) {
        $('#casinoModal').modal('show');
    } else {
        initializeCarousel();
        checkForUpdates(); // Initial check
    }

    $('#carousel1').on('slide.bs.carousel', function (e) {
        if (counter > 0) {
            e.preventDefault();
        }
    });

    $('img, video').on('error', function () {
        console.error('Error loading:', this.src);
        reloadWithDelay(5000);
    });

});

function guardarCasino() {
    var selectedCasinoId = document.getElementById("casinoSelect").value;
    Cookies.set("casino_id", selectedCasinoId, { expires: 365 });
    $('#casinoModal').modal('hide');
    location.reload();
}

function reloadWithDelay(delay) {
    setTimeout(() => {
        location.reload();
    }, delay);
}


