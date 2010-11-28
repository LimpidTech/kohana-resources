# kohana-resources
#### Brandon R. Stoner <monokrome@monokro.me>

## What is this?
This is a module for loading static files through the Kohana 3 View renderer. More documentation will come later, but for now install the module and add the following above your default routes:

    Route::set('resource', 'resource/<identifier>', array('identifier' => '.+'))
               ->defaults(array(
                   'controller' => 'resource',
                   'action'     => Kohana::config('resources.default_action'),
               ));

Now, if you have a view with the filename **styles/common.css.php** you can access CSS files from your views directory with the URI **/resource/styles/common.css** and you will get your CSS file back.

## What's coming next?

A few features are planned, and I'm sure that I'll be adding more to this list in the future.

* Caching of resources *(hence, don't use request data in your media files' PHP)*
* External storage *(Amazon S3 and other portable backends)*
* Collective resources for combining files

