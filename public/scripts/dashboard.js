// Initialize sliders for mobile view
$(document).ready(function() {
    // Only initialize sliders on mobile
    if (window.innerWidth < 768) {
        // Categories slider
        $('#categoriesSlider').flickity({
            cellAlign: 'left',
            contain: true,
            prevNextButtons: false,
            pageDots: false,
            freeScroll: true
        });

        // Products slider
        $('#productsSlider').flickity({
            cellAlign: 'left',
            contain: true,
            prevNextButtons: false,
            pageDots: false,
            freeScroll: true
        });
    }

    // Handle search form submissions
    $('#searchForm, #desktopSearchForm').on('submit', function(e) {
        e.preventDefault();
        // Implement search functionality here
        alert('Search functionality would be implemented here');
    });
});

// Re-initialize on window resize
$(window).resize(function() {
    if (window.innerWidth < 768) {
        if (!$('#categoriesSlider').hasClass('flickity-enabled')) {
            $('#categoriesSlider').flickity({
                cellAlign: 'left',
                contain: true,
                prevNextButtons: false,
                pageDots: false,
                freeScroll: true
            });
        }

        if (!$('#productsSlider').hasClass('flickity-enabled')) {
            $('#productsSlider').flickity({
                cellAlign: 'left',
                contain: true,
                prevNextButtons: false,
                pageDots: false,
                freeScroll: true
            });
        }
    } else {
        if ($('#categoriesSlider').hasClass('flickity-enabled')) {
            $('#categoriesSlider').flickity('destroy');
        }

        if ($('#productsSlider').hasClass('flickity-enabled')) {
            $('#productsSlider').flickity('destroy');
        }
    }
});