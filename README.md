Based on: www.jointswp.com  
### Installation
- Clone repo
- Inside Project Directory Run ```npm install``` or ```sudo npm install```
- Inside Project Directory Run ```bower install``` or ```sudo bower install --allow-root```
- Inside Project Directory Run ```gulp```
- Use ```gulp watch``` to compile SASS and JS on the fly.

Just prior to launch, update the ```gulpfile.js``` file to:

```php
.pipe(sass({ 
  outputStyle: 'compressed',
    sourceComments: false,
}))
```
