# Dynamic Routing

- [Introduction](#introduction)
    - [Terminology](#terminology)
- [Installation](#installation)
    - [Initial Setup](#initial-setup)
    - [Configuration](#configuration)
- [Basic Usage](#basic-usage)
    - [Create A Route](#create-a-route)
    - [Command Line](#command-line)
- [Route Providers](#route-providers)
    - [Custom Route Providers](#custom-route-providers)
- [Route Handlers](#route-handlers)
    - [Included Route Handlers](#included-route-handlers)
    - [Custom Route Handlers](#custom-route-handlers)


<a name="introduction"></a>
## Introduction

Dynamic routing is a Laravel package that enables route management at runtime by persisting dynamic routes in the database. This can be used to create routes in a CMS, such as one provided by the Elements Framework, and edit the route URL patterns for routes published by other Elements.

#### Goals
- Create custom routes at runtime.
- Easy implementation of custom dynamic route actions.
- Allow Elements (components) to publish their own routes which can be edited on runtime.
- Automated addition/removal of routes when integrating/removing Elements.
- Be cacheable.


<a name="terminology"></a>
### Terminology

**Dynamic Route** - Route that is loaded from the database opposing to being hard-coded in the application codebase.

**Route Provider** - An implementation of the `ElementsFramework\DynamicRouting\Interfaces\RouteProvider` interface which provides routes that need to be registered for an Element to work. This class will then link to the DynamicRouter which will create the routes if missing.

**Route Handler** - Implementation of `ElementsFramework\DynamicRouting\Handler\AbstractRouteTypeHandler` which defines the action that will be ran when a route using that handler is triggered and defines its parameters and configuration.

**Route Compiler** - Fetches the dynamic routes from the database and compiles them into a static routes file for faster route matching.

**Route Publisher** - Creates new routes that are registered in newly registered *route providers*, and removes any routes that are no longer registered in any *route provider*.


<a name="installation"></a>
## Installation

Laravel 5.3 is required to use this package.

#### Via Composer
You can install the package trough composer by running

    composer require elementsframework/dynamic-routing


<a name="initial-setup"></a>
### Initial Setup

To set-up this package you have to go trough the following steps.

#### Registering the component
Open `config/app.php` and add the package service provider in your *providers* array:

    ElementsFramework\DynamicRouting\DynamicRoutingServiceProvider::class

#### Publishing the configuration file
Use Artisan in your project root to publish the configuration files:

    php artisan vendor:publish

#### Create your dynamic routes cache file
In your `config/dynamic-routing.php` you can set up the file where the dynamic routes will be cached by setting the `compiled-routes-path` key (Default: `web/dynamic.php`). **Make sure you create that file manually and make it writeable.**

#### Running the included database migrations
Use Artisan in your project root to run the migrations and create a table for your dynamic routes:

    php artisan migrate

#### Registering routes
Open `app/Providers/RouteServiceProvider.php` and modify your `map()` method to include the dynamic route map.

    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
        /* Add the line below */
        ElementsFramework\DynamicRouting\Service\DynamicRouteMapper::mapDynamicRoutes();
    }

<a name="configuration"></a>
### Configuration

The package publishes a configuration file in `config/dynamic-routing.php` in which you can do the following:

- Define the middleware dynamic routes will go trough. (Default: web)
- Define the file where the routes will be cached.
- Register route handlers.
- Register route providers.


<a name="basic-usage"></a>
## Basic Usage
This package will not register any routes on its own, you have to persist some `DynamicRoute` objects to register new routes.

<a name="create-a-route"></a>
### Create A Route
The `DynamicRoute` class is a regular Eloquent model so we can use the regular create and save methods to modify them.

    DynamicRoute::create([
        // HTTP method this route will use (any/get/post/update/delete...)
        'method' => 'get',

        // Optional: Route name that can be used to link to the page from other documents
        'name' => 'marketing.bike',

        // Laravel route pattern, can include attributes if the route handler supports them
        'pattern' => '/sale/bike/{bikeId}',

        // Registered handler name that this route will use to return the response
        'handler' => 'BikeSalePageHandler',

        // Configuration JSON which attributes are defined by the route handler (this can contain information needed to process the route that is set upon route creation
        'configuration' => '{"type":"winter-sale"}',
    ]);

**When we create the route, it will NOT be accessable until we re-compile the cache.**

If you are providing an user interface for route manipulation, you can use the bundled `RouteDeclarationCompiler`'s `compileToFile()` method to do so.

If you however, want to re-compile manually, you can use the bundled command:

    php artisan dynamic-route:compile

<a name="command-line"></a>
### Command Line
The following Artisan commands become available after you install this package:

      dynamic-route:compile           Compiles all dynamic routes to a static file.
      dynamic-route:provided:cleanup  Cleans up all routes that are persisted but no longer provided by registered route providers.
      dynamic-route:provided:publish  Publishes all routes provided by the registered route providers.
      dynamic-route:provided:sync     Runs the publish and cleanup command in one go.


<a name="route-providers"></a>
## Route Providers
Route providers are an implementation of the `ElementsFramework\DynamicRouting\Interfaces\RouteProvider` interface. They provide definitions for default routes that are created when you run the `dynamic-route:provided:publish` Artisan command.

To make the dynamic router aware of the route provider, you have to first register it in the `config/dynamic-routing.php` configuration file.

Route providers are usually bundled in other packages as they provide routes that are necessary for the package to work. The advantage of using route providers over regular static routes is that these can be edited to prevent route overlap and provide better SEO URL's for the current application context.

<a name="custom-route-providers"></a>
### Custom Route Providers
You can implement your own route provider by implementing the `RouteProvider` interface which requires you to implement a `getDefaultDynamicRoutes()` method. This method needs to return an array of `DynamicRoute` objects.

**Example:**

    class TestRouteProvider implements RouteProvider
    {
        /**
         * Returns an array of unpersisted DynamicRoute objects which will
         * be created if they already don't exist.
         * @return DynamicRoute[]
         */
        public static function getDefaultDynamicRoutes()
        {
            return [
                new DynamicRoute(['method' => 'get', 'name' => 'publishedRoute', 'pattern' => '/published', 'handler' => 'RedirectRouteHandler', 'configuration' => ['target' => 'http://www.google.hr']]),
            ];
        }
    }



<a name="route-handlers"></a>
## Route Handlers

You can think of route handlers as actions for dynamic routes. The only difference between actions and route handlers is the handlers ability to read the stored configuration array and provide different responses.

The configuration array is used for attaching metadata to the route upon creation that is used to return a response, but a user should not include it in his request.

**Example:**
We have a `BikeSalePageHandler` (from the route example above) which takes a `bikeId` attribute from the user and returns a bike sales page filled with information on that specific bike. Configuration can be used to add the  template type used to show the sales page (winter-sale or summer-sale). This template needs to be chosen by the site admin when creating the route and is stored along with the route, as opposed to the regular `bikeId` attribute that user needs to provide.

<a name="included-route-handlers"></a>
### Included Route Handlers
This package has the following common use route handlers included and registered. These can be used right away and are examples for how to implement your own custom route handlers.

#### ControllerActionRouteHandler
Will return a response based on the `target` property in the configuration array. The `target` property defines which controller/action will be triggered by using the regular Laravel action string (Ex. `Namespace\Controller@getResponse`).

#### RedirectRouteHandler
Will redirect the user to a URL provided by the `target` property in the configuration array.


<a name="custom-route-handlers"></a>
### Custom Route Handlers
To create a custom route handler just create a implementation of the `ElementsFramework\DynamicRouting\Handler\AbstractRouteTypeHandler`. This abstract class requires you to implement 2 methods:

        /**
         * Uses the user input and the route definition to build and return a response for the user.
         * @param Request $request
         * @param DynamicRoute $route
         * @return Response
         */
        abstract public function process(Request $request, DynamicRoute $route);

        /**
         * Checks if the given route object is a valid route that can be handled with this handler.
         * @param DynamicRoute $route
         * @return boolean
         */
        abstract public static function isValid(DynamicRoute $route);

