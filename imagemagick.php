
<?php 

$pdf_file   = ($_SERVER['DOCUMENT_ROOT'] . '/gck/pdf/1995DCS.pdf');
$save_to    = 'demo.jpg';

//$img = new imagick();
//$img = new imagick($_SERVER['DOCUMENT_ROOT'] . '/gck/out.jpg');
$img = new Imagick($_SERVER['DOCUMENT_ROOT'] . '/gck/pdf/1995DCS.pdf');


//this must be called before reading the image, otherwise has no effect - &quot;-density {$x_resolution}x{$y_resolution}&quot;
//this is important to give good quality output, otherwise text might be unclear
$img->setResolution(200,200);

//read the pdf
$img->readImage("{$pdf_file}[0]");

//reduce the dimensions - scaling will lead to black color in transparent regions
$img->scaleImage(200,0);

//set new format
$img->setImageFormat('jpg');

// -flatten option, this is necessary for images with transparency, it will produce white background for transparent regions
$img = $img->flattenImages();

//save image file
//$img->writeImages($save_to, false);
$img->writeImages($_SERVER['DOCUMENT_ROOT'] . '/gck/pdf/1995DCS.jpg', true);

//echo the jpg image
header("Content-type: image/".$img->getImageFormat());
echo $img;	//same as echo $img-&gt;getImageBlob();

?>