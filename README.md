# php-image-converter readme

PHP Script that can be used to resize an image and save it in various formats.

## Functionality
The script has two functions:

1. resize_image($file, $w, $h, $crop=FALSE)
This function accepts the following parameters:

$file (required): The path to the image file to be resized.
$w (required): The desired width of the output image.
$h (required): The desired height of the output image.
$crop (optional): A boolean parameter indicating whether to crop the image or not. If TRUE, the function will crop the image to fit the aspect ratio of the output dimensions. If FALSE, the function will resize the image to fit within the output dimensions without cropping.
The function first retrieves the current width and height of the image file using the getimagesize function. It then calculates the aspect ratio of the image and determines the new dimensions of the output image based on the desired width and height parameters. If the $crop parameter is TRUE, the function will crop the image to fit the output dimensions. Otherwise, it will resize the image to fit within the output dimensions without cropping.

The function then determines the file type of the input image based on its extension and creates an image resource using the corresponding imagecreatefrom function. It creates a new image resource using the calculated output dimensions and uses the imagecopyresampled function to copy and resample the input image to the output image. The function then returns the output image resource.

2. renderImage($dst, $outputFormat = 'jpeg', $output = null, $quality = 7)
This function accepts the following parameters:

$dst (required): The image resource returned by the resize_image function.
$outputFormat (optional): The desired output format of the image. Default is jpeg. Supported formats are jpg, png, gif, webp, and avif.
$output (optional): The path to the output file. If not specified, the function will output the image directly to the browser.
$quality (optional): The quality of the output image. This parameter only applies to the jpeg, webp, and avif formats. Default is 7. The value should be between 0 and 10.
The function first determines the desired output format and sets the appropriate content type header if the $output parameter is not specified. It then uses the corresponding image function to output the image to either a file or the browser.

## Supported Formats
JPEG, JPG, PNG, GIF, WEBP, AVIF

## Usage
To use the script, simply call the resize_image function and pass in the required parameters. The function will return the resized image resource. You can then call the renderImage function to output the resized image in the desired format.

## For example:

**$img = resize_image("sample.png", 500, 500);**<br />
**renderImage($img, 'gif');**<br />
This code will resize the sample.png image to 500x500 pixels and output it as a GIF file. If you want to output the image to a file instead of the browser, you can specify the output path in the $output parameter:

**$img = resize_image("sample.png", 500, 500, true);**<br />
**renderImage($img, 'jpg', 'output.jpg', 5);**<br />
This code will crop the sample.png image to 500x500 pixels, save it as a JPEG file with a quality of 50, and output it to the output.jpg file.

**$img = resize_image("sample.png", 500, 500);**<br />
**renderImage($img);**<br />
This code will resize the sample.png image to 500x500 pixels, output as a default JPEG file with a default quality of 70.

## note
The avif format required PHP 8.0+
