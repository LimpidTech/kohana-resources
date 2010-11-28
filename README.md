# kohana-resources
#### Brandon R. Stoner <monokrome@monokro.me>

## What is this?
This is a module for loading static files through the Kohana 3 View renderer. More documentation will come later, but for now install the module and add the following above your default routes:

    Route::set('resource', 'resource/<identifier>', array('identifier' => '.+'))
               ->defaults(array(
                   'controller' => 'resource',
                    'action'     => Kohana::config('resources.default_action'),
              ));

