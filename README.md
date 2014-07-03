yii2-kohanaimage
=======================


composer.json
===================
````````
"require": {
    "yii2-kohanaimage": "*"
},
````````

### Example
`````````````````````
header("Content-Type: image/jpg");
$pathToFile = 'f:/1.jpg';
$pathToFile2 = 'f:/2.jpg';
echo Image::load($pathToFile)->render('png');
echo Image::load($pathToFile)->crop(100, 100)->render();
echo Image::load($pathToFile)->resize(100, 100, Image::INVERSE)->render();
echo Image::load($pathToFile)->resize(100, null)->render();
echo Image::load($pathToFile)->resize(null, 100)->render();
echo Image::load($pathToFile)->rotate(45)->render();
echo Image::load($pathToFile)->resize(400, null)->sharpen(20)->render();
echo Image::load($pathToFile)->rotate(45)->watermark(Image::load($pathToFile2))->render();
`````````````````````

### Properties
`````````````````````
Image::load($pathToFile)->width;
Image::load($pathToFile)->height;
Image::load($pathToFile)->type;
Image::load($pathToFile)->mime;
`````````````````````

### Methods
````````````````````
background()
crop()
factory()
flip()
reflection()
render()
resize()
rotate()
save()
sharpen()
watermark()
`````````````````````

### Ref
```````````
http://kohanaframework.org/3.2/guide/api/Image
````````````