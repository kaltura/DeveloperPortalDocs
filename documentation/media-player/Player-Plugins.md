---
layout: page
title: Player Plugins: Extending Player Functionality
---

The Kaltura player architecture uses plugins to extend the player functionality. All of the player controls and core functionalities are implemented as plugins.  
This approach provides separation of concerns and code isolation when implementing player features.   

Plugins communicate with the player using its API. Plugins also have direct access to the player core engine and a dedicated interface to access and change the player UI.  
Plugins can utilize the player ability to communicate with the Kaltura platform API thus gaining access to the Kaltura platform services.    

As reference to what you can do with player plugins, you can review the existing core player plugins -  

* You can turn plugins on and off as well as configure plugin properties using the [Player Studio](http://knowledge.kaltura.com/universal-studio-information-guide).
* You can also view many plugins in action in the [player demo pages](http://player.kaltura.com/docs/chaptersView). 


## Considerations for Creating Player Plugins

You can create your own custom plugin in order to extend player functionality. Plugins code structure is rather simple but please consider there is much to learn and many best practices to follow in order to develop plugins correctly. This guide provides all the required information. 

Please note that a lot can be achieved simply by using the player API without the need to create a custom plugin. 

So when should you consider custom plugin development? If you need to achieve any of the tasks below, you should consider developing a custom plugin:

* You want to reuse your plugin logic across multiple players
* You need to change player look and feel
* You need to add visual controls to the player
* You need access to the Kaltura platform services
* You need to use the player templating engine to render data
* You need direct access to player properties and methods that are not exposed in the player API
* You want to provide an interface to configure your plugin properties
* You want to expose your plugin API to other developers

### Plugin Code Structure

As a JavaScript module, your plugin will be defined as a literal object notation, where properties and methods are separated with commas.  

Also, pay attention to JS scope when registering to player events, and the use of "this". The scope within your event handler will not be the overall plugin scope.  

### Deploying and Sharing Player Plugins

Once your plugin code and optional CSS files are ready, you will need to prepare it for deployment. It is recommended to [minify your Javascript and CSS files](https://developers.google.com/speed/docs/insights/MinifyResources) for faster load time. 
When you deploy the player plugin files on a server to be accessible to the player, consider the following:

1. Host the external files on a dedicated server, preferably a CDN for best performance, and ensure your server has [CORS headers](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing) enabling loading assets from other domains
2. Make sure you set the correct relative links or full paths in your Flashvars settings
3. Ensure that your assets could be loaded from both http and https, and when directing the player to load the assets, use protocol agnostic URL notation (`://` instead of `http://`). Also ensure that your server has a valid SSL certificate.
4. If you need to load more than one icon, consider using an icon font
5. If you need to load more than one image, use [CSS sprite sheets](https://css-tricks.com/css-sprites/)

### MediaWiki and jQuery Libraries

The Kaltura player uses jQuery which means you can use jQuery statements in your code without worrying about loading the jQuery library yourself.   

The player also includes the MediaWiki library that can be referenced anywhere in the code by using the mw global variable.    
The MediaWiki library provides utility functions to detect browsers and devices, time manipulation, formatters and additional utilities.   

> To learn more about which methods are available via the MediaWiki library, [explore the library code on GitHub](https://github.com/kaltura/mwEmbed/tree/master/modules/MwEmbedSupport/mediawiki). 

## Player Plugins Architecture

### Loading the Plugin Scripts via Player Embed

In order to load the plugin code in the Kaltura player, host the plugin files in a server that will be accessible to the player, and reference the plugin in the embed code Flashvars (or in the player UIConf using Studio):

```javascript
kWidget.embed({
        "targetId": "kaltura_player",
        "wid": "_27017",
        "uiconf_id": 29667911,
        "flashvars": {
            //This line adds your custom plugin
            "myCustomPluginName": {
                //This line turn on the plugin
                'plugin': true,
                //This line sets the plugin file path
                "iframeHTML5Js" : "myCustomPluginName.js"
            },
        },
        "entry_id": "1_1611vudr"
    });
```

> **Note:** The plugin name as defined in your code is used as a key for the Flashvars config parameters definitions. 
> You must also set the "plugin" property to true and provide a relative or full link to your Javascript file holding the plugin code using the "iframeHTML5Js" property.

### The Plugin Wrapper and Plugin Manager

The code structure of a custom plugin JavaScript file include two important classes: Kaltura plugin wrapper and plugin manager definitions.

When creating a new custom plugin, begin by wrapping your plugin code inside the plugin wrapper. The wrapper takes care of injecting your plugin code to the player during player initialization. 

You use the player's plugin manager to register your plugin, defining your plugin name (always use camelCase naming, no spaces nor underscores) and base class: 

```javascript
mw.kalturaPluginWrapper(function(){
    mw.PluginManager.add('myCustomPluginName', mw.KBaseComponent.extend({
        // plugin code
    }));
});
```


### Plugin Base Inheritance

The second parameter passed to the plugin manager is the plugin code that should extend one of the player base plugin classes:

* `mw.KBaseComponent`: is the most commonly used class based which includes all the required function for a visual / non-visual plugin
* `mw.KBaseScreen`: extends the mw.KBaseComponent class and provides the ability to manage screen overlays above the player using templates
* `mw.KBaseMediaList`: extends the mw.KBaseComponent class and provides functionality for creating and playing lists of video content 

Most often mw.KBaseComponent will be the best choice of base class to start your plugin from. The examples below will focus mainly on these common scenarios.

### defaultConfig and Plugin Config Parameters

To define public properties for your plugin that can be changed using embed code Flashvars or via Player Studio UIVars, you will need to define a `defaultConfig` JSON object in your plugin code.
 
For each property you should specify a default value.

```javascript
mw.kalturaPluginWrapper(function(){
    mw.PluginManager.add('myCustomPluginName', mw.KBaseComponent.extend({
        // public properties
        defaultConfig: {
	        // the container for the button
            parent: "controlsContainer",    
            // the display order ( based on layout )
            order: 81,                      
            // the display importance, determines when the item is removed from DOM
            displayImportance: 'low',       
            // the alignment of the button
            align: "right",                 
            // custom property and custom value
            myProp: "myValue"               
        }
        
        // The rest of your plugin code comes here...
    }));
});
```

In this example, the `parent`, `order`, `displayImportance` and align properties are `KBaseComponent` properties that control plugin rendering and handled in the `mw.KBaseComponent` class. 
`myProp` is a new property defined by this plugin.

#### Accessing Plugin Properties in the Plugin Code
Within your plugin code, you can get the property value using the `getConfig` method:

```javascript
//will log the value of myProp ("myValue")
console.log(this.getConfig("myProp"));
```

### Reference the Player Element Inside the Plugin Code:

Throughout your custom plugin code, you have direct access to the player by using the `getPlayer` method which returns the `embedPlayer` object. 
This object exposes all of the player methods and properties (not just the public ones exposed by the player API).   

For example, to get a reference to the native video element of the current player you can use:

```javascript
this.getPlayer().getPlayerElement();
```


## The Player Plugin Lifecycle

### isSafeEnviornment

This optional method can be declared in order to define cases in which the plugin doesn't load. The method should return a boolean value. true means the plugin should load. false means the plugin should not load.

For example, if you want your plugin to load only on mobile devices:  

```javascript
mw.kalturaPluginWrapper(function(){
    mw.PluginManager.add('myCustomPluginName', mw.KBaseComponent.extend({
        isSafeEnviornment:function(){
            // load the plugin only on mobile devices:
            return mw.isMobileDevice();     
        }
    }));
});
```

### setup

The setup method is the first method that is called once the plugin loads. You don't need to call it yourself, you just need to define it.
It is the entry point fore the plugin code. This is the place to write your initialization code and add event bindings if needed:

```javascript
mw.kalturaPluginWrapper(function(){
    mw.PluginManager.add('myCustomPluginName', mw.KBaseComponent.extend({
        setup: function(){
            // initialization code goes here.
            // call a method for event bindings:
            this.addBindings();             
        }
    }));
});
```

### Event Bindings

Your plugin can register to any event triggered by the player. You register to events using the bind method. 

Syntax:  `this.bind(eventName, callback, once);`
Where eventName is the name of the event to register to, callback is the callback function to execute and once, when set to true, binds to this event only once. 

```javascript 
mw.kalturaPluginWrapper(function(){
    mw.PluginManager.add('myCustomPluginName', mw.KBaseComponent.extend({
        setup: function(){
            // initialization code goes here.
            // call a method for event bindings:
            this.addBindings();             
        },
        addBindings: function() {
            this.bind('playerReady', function(){
                alert("player is ready");
            });
        }
    }));
});
```

unregistering events is done by the unbind method which accepts the event name and remove the listener to it: `this.unbind('playerReady');`

#### Namespaces

When you bind events within your plugin, the plugin name is used as a namespace for the event registration automatically.   
This allows isolation between multiple plugins that register to the same events. Learn more about event name spacing.   

Using the unbind method does the same and unbinds the event with the specific plugin namespace only.   

You can also unbind all of the plugin events by not sending an event parameter to the unbind method. This will cause unbinding of all the plugin name space events.
Such global unbinding should be used when destroying the plugin. 

```javascript
// remove all of the plugin event listeners using the plugin name space:
this.unbind(); 
```

### getComponent and parent

If your component has visual representation, you will need to define the `getComponent` method. This method should return a jQuery DOM element that is rendered in the player interface.

The `parent` container in which your component is rendered is defined by the `parent` property, and can be overridden in the embed Flashvars or Studio UIVars definitions. 

#### There are 3 optional parents

* `controlsContainer`: renders the component in the player bottom control bar
* `topBarContainer`: renders the component in the player top control bar
* `videoHolder`: renders the component over the video itself

Your `getComponent` method is the place to define your component look and feel as well as its actions. 

The returned jQuery object should be created only once (single tone) so best practice is to save it as a plugin property commonly named `$el`:

```javascript
getComponent: function() {
    var _this = this;
    if( !this.$el ) {
        this.$el = $( '<button />' )
            .attr( 'title', 'Play' )
            .addClass( 'btn icon-play' + this.getCssClass() )
            .click( function() {
                _this.togglePlayback();
            });
    }
    return this.$el;
}
```

### getCssClass

As you can see in the example above, when defining your plugin DOM element CSS classes, you should use the  `this.getCssClass()` method.   
This method adds some css classes to handle alignment (as defined in the `align` Flashvar property), display importance and more.

Another class name that will be added by this method is a class named by your component name. You can use this class name to add plugin specific CSS rules in your plugin custom CSS file. In our example, your component will get the `myCustomPluginName` class name.
 
### onEnable / onDisable

During video playback, you might want to disable your plugin in some scenarios. For example when loading data or when an ad is playing.

You can "announce" your plugin as disabled or enabled by calling `this.onDisable()` and `this.onEnable()` accordingly. 

Disabling the plugin adds the "disabled" class to the plugin element and sets its `isDisabled` property to `true`. Enabling it removes the class and sets `isDisabled` to `false`.

Note that calling the `onDisable` method doesn't disable the plugin, it just adds the disabled class and set the `isDisabled` property to `true`. 
It is up to you to add logic to your code and disable any functionality when the `isDisabled` property is `true`. 

A simple `if (!this.isDisabled)` conditional statement before any functionality should provide a proper disabled state. 
You can also override your plugin disabled CSS class rules using a plugin custom CSS as explained below.
 
### show / hide

On some cases you might want to completely hide your component element during playback. 

Use `this.hide()` to hide the component and `this.show()` to show it again.
 
### Accessing the Player Interface

In order to access the player controls and interface, you can use jQuery class selectors. The player also provides methods to access its main DOM elements:

* `getInterface()`: returns a jQuery object representing the entire player interface
* `getVideoHolder()`: returns a jQuery object representing the video holder DIV containing the video display and all elements displayed over the video
* `getVideoDisplay()`: returns a jQuery object representing the DIV holding the video object 
* `getControlBarContainer()`: returns a jQuery object representing the bottom control bar holding the player controls
* `getTopBarContainer()`: returns a jQuery object representing the top control bar
* `getPlayerPoster()`: returns a jQuery object representing the video poster image

For example, selecting all the buttons in the bottom control bar:

```javascript
this.getPlayer().getControlBarContainer().find('.btn');
```

### Determining Player State and Ads Playback

In many cases you would like to know the player current state: is it playing, paused, is an ad currently playing etc. Determining the state of the player can be done in the following ways:

* Events registration: register to player events such as the `playerStateChange` event. For more information, check the events section in the Player API article.
* Check player properties, for example: `this.getPlayer().paused`. 
* Examine the player state classes. For more information check the Player state CSS classes in the player customization article. 
* To determine if an ad is currently playing use: `this.getPlayer().isInSequence()`. `true` indicates an ad is currently playing.

#### Example: disable your plugin during ad playback

```javascript
addBindings: function() {
    var _this = this;
    this.bind('AdSupport_StartAdPlayback', function(){
        _this.onDisable();
    });
    this.bind('AdSupport_EndAdPlayback', function(){
        _this.onEnable();
    });
}
```

### Calling Player Methods Using the Player API

While you can call the player methods directly from your plugin, it is better the use the player API for that.   
The player API makes sure your command is executed seamlessly across multiple playback engines and handles possible errors.  
To call a player method using the API, use the `sendNotification` method. For more information, check the Player API guide.   

#### Example: switching the currently playing media

```javascript
this.getPlayer().sendNotification("changeMedia", { "entryId" : "0_wm82kqmm" });
```

### Event dispatching

You might want to dispatch events from your plugin to be used by other plugins or as an external API for other developers.  
Plugins dispatch events using the player `triggerHelper` method. Try to use descriptive event names for ease of use.  

You can also pass additional parameters with your event by passing a parameters array as a second argument to the triggerHelper method:

```javascript
this.getPlayer().triggerHelper('myCustomEventName', [param1, param2, param3]);
```

#### Example: dispatch custom event when a button is clicked

```javascript
getComponent: function() {
    var _this = this;
    if( !this.$el ) {
        this.$el = $( '<button />' )
            .attr( 'title', 'Click Me!' )
            .addClass( 'btn icon-myicon' + this.getCssClass() )
            .click( function() {
                _this.fireMyCustomEvent();
            });
    }
    return this.$el;
},
fireMyCustomEvent: function(){
	// dispatch the 'myCustomEventName' event
    this.getPlayer().triggerHelper('myCustomEventName'); 
}
```

### Destroying the plugin

While the destroy method is not called automatically by the player, it is highly advised to define it when you need to preform any cleanup.  
Call the destroy function when you no longer want your plugin to perform any logic or when you want to remove it from the player DOM.  

> **NOTE:** You must call `this._super()` in your destroy function in order to invoke the destroy function in your parent class which unbinds and removes your plugin from the DOM.

#### Example: Destroying the plugin when the entry is switched

```javasript
addBindings: function() {
    var _this = this;
    this.bind('onChangeMedia', function(){
        _this.destroy();
    });
},
destroy: function(){
    // plugin cleanup code here...
    this._super();
}
```

## Custom Plugin CSS 

You can define a custom CSS file to be loaded with your custom plugin. In this CSS you can define custom CSS classes used by your plugin.   

Important considerations:

* You can also use this file to override other player CSS classes. Use the `!important` directive to make sure these rules are overridden.   
* If you need to use external assets such as images and fonts, reference it in your CSS using relative links, and use CSS sprite sheets where applicable.  
* You can also consider using CSS Data URIs to include inline images and icons or icon fonts for multiple vector icons. [Learn more about icon fonts](http://www.w3schools.com/icons/).

To define a custom CSS file, use the `iframeHTML5Css` property in your custom plugin parameters:

```javascript
kWidget.embed({
        "targetId": "kaltura_player",
        "wid": "_27017",
        "uiconf_id": 29667911,
        "flashvars": {
            //This line adds your custom plugin:
            "myCustomPluginName": {
                'plugin': true,
                "iframeHTML5Js" : "myCustomPluginName.js",
                //This line sets the plugin custom CSS file path:
                "iframeHTML5Css" : "myCustomCSS.css"
            },
        },
        "entry_id": "1_1611vudr"
    });
```

> **Note:** The link to your CSS file can be relative or absolute.
