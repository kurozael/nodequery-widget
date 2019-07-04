# nodequery-widget

## Setup

Make sure the data/ directory is writeable (777) so that the image file can be written to.

#### ImageMagick

```apt-get install php5-imagick```  
```php5enmod imagick```

## Config

Open conf.json and add your NodeQuery API key to `api_key`.

## Using

```<img src="http://yourwebsite.com/status/widget.php?server=YOUR_NODEQUERY_SERVER_NAME"/>```

#### Example Output

![Example](http://i.imgur.com/xGLkDW7.png)