# Dynamic Routing

- [Introduction](#introduction)
    - [Terminology](#terminology)


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

**Route Provider** - An implementation of the `ElementsFramework\DynamicRouting\Interfaces\RouteProvider` interface bundled in Element packages which provide routes that need to be registered for an Element to work. This class will then link to the DynamicRouter which will create the routes if missing.

**Route Handler** - Implementation of `ElementsFramework\DynamicRouting\Handler\AbstractRouteTypeHandler` which defines the action that will be ran when a route using that handler is triggered and defines its parameters and configuration.

**Route Compiler** - Fetches the dynamic routes from the database and compiles them into a static routes file for faster route matching.

**Route Publisher** - Creates new routes that are registered in newly registered *route providers*, and removes any routes that are no longer registered in any *route provider*.


