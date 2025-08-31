<?php

// Copy carousel images
$carouselSource = 'public/Slides/';
$carouselDest = 'storage/app/public/carousel/';

$carouselImages = [
    'football-1.jpg',
    'cricket-1.jpg', 
    'football-2.jpg',
    'pool-1.jpg'
];

foreach ($carouselImages as $image) {
    if (file_exists($carouselSource . $image)) {
        copy($carouselSource . $image, $carouselDest . $image);
        echo "Copied: $image to carousel\n";
    }
}

// Copy turf images
$turfSource = 'public/Turf/';
$turfDest = 'storage/app/public/turfs/';

$turfImages = [
    'turf-1.jpg',
    'turf-2.jpg',
    'turf-3.jpg'
];

foreach ($turfImages as $image) {
    if (file_exists($turfSource . $image)) {
        copy($turfSource . $image, $turfDest . $image);
        echo "Copied: $image to turfs\n";
    }
}

echo "Image copying completed!\n";
