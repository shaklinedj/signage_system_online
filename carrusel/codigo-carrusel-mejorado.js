$(document).ready(function () {
    const INTERVAL_TIME = 30; // 30 segundos para imágenes
    const UPDATE_INTERVAL = 60000; // Verificar actualizaciones cada 60 segundos
    let counter;
    let counterInterval;
    let lastMediaCount = null;
    const selectedCasinoId = Cookies.get("casino_id");
    const cacheKey = `carousel_data_${selectedCasinoId}`;

    // Crear el display del contador una sola vez
    const $counterDisplay = $('<div class="counter" aria-live="polite">30</div>');
    $('body').append($counterDisplay);

    function checkForUpdates() {
        $.ajax({
            url: '../admin/optimized-check-updates.php',
            method: 'GET',
            data: { casino_id: selectedCasinoId },
            dataType: 'json'
        })
        .done(function (data) {
            if (lastMediaCount === null || lastMediaCount !== data.media_count) {
                updateCarousel(data.media);
            }
            lastMediaCount = data.media_count;
            handleEmptyCarousel();
        })
        .fail(function() {
            console.error("Error al obtener actualizaciones, usando caché si está disponible.");
            const cachedData = localStorage.getItem(cacheKey);
            if (cachedData) {
                updateCarousel(JSON.parse(cachedData));
            }
        });
    }

    function handleEmptyCarousel() {
        const $carouselItems = $('#carousel1 .carousel-inner .item');
        if ($carouselItems.length === 0) {
            console.warn("No hay elementos en el carrusel. Recargando la página en 2 minutos.");
            setTimeout(() => location.reload(), 120000);
        }
    }

    function updateCarousel(newMedia) {
        const $carousel = $('#carousel1 .carousel-inner');
        const currentItems = $carousel.children('.item').get();
        const currentIndex = $carousel.children('.item.active').index();

        // Eliminar elementos que ya no están presentes
        currentItems.forEach(item => {
            const src = $(item).find('img, video source').attr('src');
            if (!newMedia.some(media => media.src === src)) {
                $(item).remove();
            }
        });

        // Añadir nuevos elementos
        newMedia.forEach(item => {
            const $existingItem = $carousel.find(`img[src="${item.src}"], video source[src="${item.src}"]`).closest('.item');
            if ($existingItem.length === 0) {
                const $newItem = $('<div class="item">');
                if (item.type === 'video') {
                    $newItem.append(`<video class="full-width-video" muted><source src="${item.src}" type="video/mp4"></video>`);
                } else {
                    $newItem.append(`<img src="${item.src}" alt="Contenido del carrusel" loading="lazy">`);
                }
                $carousel.append($newItem);
            }
        });

        updateActiveItem(currentIndex);
        handleVideoPlayback();
    }

    function updateActiveItem(currentIndex) {
        const $items = $('#carousel1 .carousel-inner .item');
        $items.removeClass('active');
        if (currentIndex >= 0 && currentIndex < $items.length) {
            $items.eq(currentIndex).addClass('active');
        } else if ($items.length > 0) {
            $items.first().addClass('active');
        }
    }

    function initializeCarousel() {
        const cachedData = localStorage.getItem(cacheKey);
        if (cachedData) {
            updateCarousel(JSON.parse(cachedData));
        }

        $('#carousel1').carousel({ interval: false })
            .on('slid.bs.carousel', handleVideoPlayback)
            .on('slide.bs.carousel', function (e) {
                if (counter > 0) {
                    e.preventDefault();
                }
            });

        if (selectedCasinoId) {
            handleVideoPlayback();
            checkForUpdates();
        }
    }

    function updateCounterDisplay() {
        $counterDisplay.text(counter);
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
        const $activeItem = $('.carousel-inner .item.active');
        const $video = $activeItem.find('video');

        if ($video.length > 0) {
            $('#carousel1').carousel('pause');
            $video[0].play();
            $video[0].onended = function () {
                $('#carousel1').carousel('next');
            };
            startCounter(Math.ceil($video[0].duration));
        } else {
            startCounter(INTERVAL_TIME);
        }
    }

    setInterval(checkForUpdates, UPDATE_INTERVAL);

    if (selectedCasinoId === undefined) {
        $('#casinoModal').modal('show');
    } else {
        initializeCarousel();
    }

    $('img, video').on('error', function () {
        console.error('Error al cargar:', this.src);
        setTimeout(() => location.reload(), 5000);
    });
});

function guardarCasino() {
    const selectedCasinoId = document.getElementById("casinoSelect").value;
    Cookies.set("casino_id", selectedCasinoId, { expires: 365 });
    $('#casinoModal').modal('hide');
    location.reload();
}