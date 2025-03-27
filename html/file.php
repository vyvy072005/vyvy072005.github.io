<?php
header('Content-Type: image/png');

//Холст картинки
$width = 950;
$height = 900;
$image = imagecreatetruecolor($width, $height);

// цвета задаём
$background = imagecolorallocate($image, 180, 200, 255); // Голубой




$bblue = imagecolorallocate($image, 39, 49, 110);
$yellow = imagecolorallocate($image, 228, 222, 2);
$green = imagecolorallocate($image, 103, 179, 45);
$orange = imagecolorallocate($image, 237, 117, 4);
$red = imagecolorallocate($image, 187, 16, 92);
$pink = imagecolorallocate($image, 239, 131, 128);
$blue = imagecolorallocate($image, 36, 165, 194);
$perp = imagecolorallocate($image, 120, 65, 148);


// фоновая заливка холста
imagefill($image, 0, 0, $background);



//голова

$points = array(
    400,  180,  // x1, y1
    390, 270,  // x2, y2
    230, 240   // x3, y3
);
imagefilledpolygon($image, $points, $yellow);




//правый рог
$points = array(
    375,  70,  // x1, y1
    400, 140,  // x2, y2
    357, 210   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    390,  110,  // x1, y1
    400, 138,  // x2, y2
    620, 90   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    540,  95,  // x1, y1
    620, 5,  // x2, y2
    570, 95   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    580,  90,  // x1, y1
    650, 1,  // x2, y2
    620, 90   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);

//левый рог

$points = array(
    360,  190,  // x1, y1
    340, 90,  // x2, y2
    320, 140   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    330,  110,  // x1, y1
    320, 140,  // x2, y2
    200, 120   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    240,  120,  // x1, y1
    200, 70,  // x2, y2
    210, 120   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    200,  120,  // x1, y1
    185, 120,  // x2, y2
    150, 35   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);



$points = array(
    730, 680,  // x1, y1
    720, 690,
	790, 750,	// x2, y2
    800, 740   // x3, y3
	
);
imagefilledpolygon($image, $points, $bblue);
$points = array(
    800, 740,  // x1, y1
    790, 755,
	820, 840,	// x2, y2
    840, 830   // x3, y3
	
);
imagefilledpolygon($image, $points, $bblue);


//хвостик

$points = array(
    760, 405,  // x1, y1
    740, 500,  // x2, y2
    720, 450   // x3, y3
);
imagefilledpolygon($image, $points, $red);


//шея

$points = array(
    400,  190,  // x1, y1
    470, 425,  // x2, y2
    370, 425   // x3, y3
);
imagefilledpolygon($image, $points, $green);


//ноги бедра

$points = array(
    350,  440,  // x1, y1
    350, 510,  // x2, y2
    200, 400   // x3, y3
);
imagefilledpolygon($image, $points, $orange);

//тело
imagefilledrectangle($image, 346, 420, 740, 570, $blue);
imagerectangle($image, 346, 420, 740, 570, $blue);


$points = array(
    410,  520,  // x1, y1
    410, 620,  // x2, y2
    220, 490   // x3, y3
);
imagefilledpolygon($image, $points, $red);

$points = array(
    745,  600,  // x1, y1
    745, 650,  // x2, y2
    800, 650   // x3, y3
);
imagefilledpolygon($image, $points, $blue);

$points = array(
    745, 720,  // x1, y1
    733, 510,  // x2, y2
    600, 560   // x3, y3
);
imagefilledpolygon($image, $points, $pink);


imagefilledellipse($image, 660, 500, 176, 176, $perp);



//ноги
$points = array(
    200, 390,  // x1, y1
    210, 410,
	70, 530,	// x2, y2
    60, 520   // x3, y3
	
);
imagefilledpolygon($image, $points, $green);

$points = array(
    230, 480,  // x1, y1
    210, 490,
	280, 650,	// x2, y2
    300, 645   // x3, y3
	
);
imagefilledpolygon($image, $points, $yellow);

$points = array(
    800, 645,  // x1, y1
    790, 660,
	890, 780,	// x2, y2
    900, 770   // x3, y3
	
);
imagefilledpolygon($image, $points, $orange);



//копытв

$points = array(
    60, 520,  // x1, y1
    62, 570,  // x2, y2
    100, 540   // x3, y3
);
imagefilledpolygon($image, $points, $bblue);

$points = array(
    280, 610,  // x1, y1
    280, 660,  // x2, y2
    320, 630   // x3, y3
);
imagefilledpolygon($image, $points, $pink);


$points = array(
    835, 820,  // x1, y1
    820, 865,  // x2, y2
    866, 855   // x3, y3
);
imagefilledpolygon($image, $points, $red);

$points = array(
   884, 760,  // x1, y1
    890, 800,  // x2, y2
    926, 770   // x3, y3
);
imagefilledpolygon($image, $points, $green);



// вывод изображения
imagepng($image);
imagedestroy($image);
?>
