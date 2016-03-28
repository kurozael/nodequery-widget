
<?php

/* Create a new imagick object */
$im = new Imagick();

/* Create new image. This will be used as fill pattern */
$im->newPseudoImage(50, 50, "gradient:red-black");

/* Create imagickdraw object */
$draw = new ImagickDraw();

/* Start a new pattern called "gradient" */
$draw->pushPattern('gradient', 0, 0, 50, 50);

/* Composite the gradient on the pattern */
$draw->composite(Imagick::COMPOSITE_OVER, 0, 0, 50, 50, $im);

/* Close the pattern */
$draw->popPattern();

/* Use the pattern called "gradient" as the fill */
$draw->setFillPatternURL('#gradient');

/* Set font size to 52 */
$draw->setFontSize(52);

/* Annotate some text */
$draw->annotation(20, 50, "Hello World!");

/* Create a new canvas object and a white image */
$canvas = new Imagick();
$canvas->newImage(350, 70, "white");

/* Draw the ImagickDraw on to the canvas */
$canvas->drawImage($draw);

/* 1px black border around the image */
$canvas->borderImage('black', 1, 1);

/* Set the format to PNG */
$canvas->setImageFormat('png');

/* Output the image */
header("Content-Type: image/png");

/* Clean the output buffer before rendering. */
ob_clean();

echo $canvas;
?>
