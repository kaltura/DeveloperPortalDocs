---
layout: page
title: Kaltura Player Look & Feel and Behavior Customization
---

The Kaltura player look and feel is derived from its skin and code. The skin consists of CSS classes and graphical assets such as icons and fonts.
Javascript code is used to define user interactions and UI behaviour.   

You can customize the player look and feel in few ways. A lot of customization can be done using the player plugins, player properties and templating mechanism.   
More advanced customization can be achieved using custom CSS loading, external assets and skin overrides. Custom Javascript code can also be used in order to change the UI behavior.  

This article covers these topics from the simplest options to the more advanced and complicated ones.

## Player and plugin properties

You can set player properties in order to change the player behavior. For example, setting the 'EmbedPlayer.HidePosterOnStart' property to true will show the video first frame instead of the poster image (default thumbnail set on the entry) on start.  
Many plugins have properties that affect the player look and feel. For example, the controlBarContainer plugin has an "hover" property that defines hovering controls:   

```javascript
'flashvars':{
    'controlBarContainer': {
        'plugin': true,
        'hover': true
    }
}
```

## Predefined skin selection

The Kaltura player has 2 available skins you can choose from: "kdark" which is the default skin and "ott" which is a custom skin for OTT products.   
You can select any of these skins or, if you create your own custom skin, you can select it the same way:  

```javascript
'flashvars': {
    'layout':{
        'skin':'ott'
    }
}
```

> **NOTE:** The OTT skin is available only for basic configuration players. It doesn't support all of the Kaltura player plugins.
 
## The "theme" plugin

The "theme" plugin allows setting colors and size for all of the player's buttons and basic UI elements such as the scrubber, icons etc.  
You can access the theme plugin properties using Studio as explained here. 
You can also use the embed code flashvars object in order to set a theme plugin properties for a specific player instance.  
It is highly advised to use the theme plugin when applicable over writing your own custom CSS file in order to prevent redundant assets loading and to boost player performances.  

## Plugin Templates

Some of the player plugins use templates to render its content. You can change this template easily using the plugin properties.  
You can load external templets to override the default template thus changing both the look and feel and the displayed data.  
This is achieved by overriding the path to the template tmpl.html file of the specific plugin. 

For example, to override the template of the share plugin, create your own tmpl.html file (based on the default template path) and in the Flashvars pass this parameter:

```javascript
'flashvars': {
    'share':{
        'templatePath':'https://link-to-my-custom-template.com/templatefile.tmpl.html'
    }
}
```

Or via UIVars in the Player Studio, pass:

```
share.templatePath=https://link-to-my-custom-template.com/templatefile.tmpl.html
```

> **NOTE:** When creating and loading external resources such as template files, please consult with the "Managing external assets" section below.

### Plugins that support templates

| Plugin       | Flashvar     | Default template path     |
|:---|:---|:---|
| Share             | templatePath            |  https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/share/share.tmpl.html |
| infoScreen	| templatePath	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/info/info.tmpl.html |
| related	| templatePath	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/related/related.tmpl.html |
| playlistAPI	| templatePath	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/playlist/playList.tmpl.html | 
| chapters	| templatePath	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/chapters/chapters.tmpl.html |
| actionForm	| templatePath	| https://github.com/kaltura/mwEmbed/blob/master/modules/CallToAction/templates/collect-form.tmpl.html |
| actionButtons	 | templatePath	 | https://github.com/kaltura/mwEmbed/blob/master/modules/CallToAction/templates/action-buttons.tmpl.html |

> Review: [Playlist with custom template and paging](http://player.kaltura.com/modules/KalturaSupport/tests/PlaylistPagingTemplate.html) for a rich example of using custom template to customize the playlist plugin UI and behavior.

## Curly-brackets data binding

Templates work by substituting data bindings against the current player instance data values. Almost all plugin configuration options and data parameters that are displayed on the player UI are exposed as bindable parameters.   

The example below shows how to display the entry view count on the player's title bar next to the entry name:  

```
"{mediaProxy.entry.name} has {mediaProxy.entry.views|numberWithCommasNumber} views". 
```

> The default value of the title bar text is `"{mediaProxy.entry.name}"`.

So the result is a player where the title bar shows a message like this "My Video Name has 10,000,000 views" (instead of "My Video Name").

### Formatters

Note the use of pipe+command ("|numberWithCommasNumber") after the binded parameter name - These are called "formatters", and they provide a means to easily format dates, time, numbers and strings according to known algorithm or by specifying one's custom javascript functions.

Default formaters include:

* `timeFormat` - takes time in seconds and returns hh:mm:ss format
* `dateFormat` - takes a time stamp returns javascript toString format
* `numberWithCommas` - takes a number and returns number with comas

You can also add your own custom formatters. [Click here to learn about creating your own custom formatters](http://player.kaltura.com/modules/KalturaSupport/tests/CustomFormaters.qunit.html).

## External CSS assets

Many player plugins use private CSS files which target the plugin UI and screens. Such plugins are playlist, chapters, share and many more.  
These CSS files can be overridden by defining the `iframeHTML5Css` property in the plugin configuration and setting it to an external CSS file overriding the internal CSS class names.   

> **NOTE:** When creating and loading external resources such as template files, please consult with the "Managing external assets" section below.

### Common plugins and their default CSS files

| Plugin | Default CSS file
|:---|:---|
| Share	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/share/share.css |
| infoScreen	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/info/info.css |
| related	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/related/related.css |
| playlistAPI	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/playlist/playList.css |
| chapters	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/chapters/chapters.css |

> Review: [Playlist with custom template and paging](http://player.kaltura.com/modules/KalturaSupport/tests/PlaylistPagingTemplate.html) for a rich example of using custom template to customize the playlist plugin UI and behavior.


## Core Player Skin External CSS Overrides

You can load an external CSS file which overrides the player core CSS classes.  

In order to override class names defined in the core CSS files, create your external custom CSS with the same class names you wish to override and load it using the `IframeCustomPluginCss1` Flashvar.  
You can define more than one custom CSS files and name the Flashvars accordingly: `IframeCustomPluginCss1`, `IframeCustomPluginCss2`,  `IframeCustomPluginCss3`, etc.   

In order to make sure your class definitions override the core definitions, always add the `!important` rule to your CSS definitions.   

> **Note:** You can reference external assets in your CSS files such as images and fonts. You can use either relative or full paths to these assets.    
> We recommend embedding small assets (such as icons) as base64 inside the CSS file to improve loading time.

### Core Player Skins CSS Files

| Skin name | Core CSS file |
|:---|:---|
| kdark	| https://github.com/kaltura/mwEmbed/blob/master/skins/kdark/css/layout.css |
| ott | 	https://github.com/kaltura/mwEmbed/blob/master/skins/ott/css/layout.css |

> Review: [Kaltura Player External Skin Overrides Recipe](https://developer.kaltura.com/recipes/player_external_skin_overrides/)
for a rich example of using custom CSS and external resources.

## Custom Interactivity with Javascript

You can add your own Javascript code which will be loaded and run within the player iframe, by setting the `IframeCustomPluginJs1` Flashvar pointing to your custom JS files.   
This allows you to register for player events or add custom interactivity to the player without creating a full player plugin.   

> Review: [External Resources Recipe](http://player.kaltura.com/modules/KalturaSupport/tests/ExternalResources.qunit.html) for a rich example of using external Javascript resources.


## Player States CSS

CSS states are CSS classes that are added to the outer most interface element at given player state. These are very useful for quickly building a given look and feel at a given player state, without involving a lot of complicated javascript bindings.   

* `.fullscreen` - The player in fullscreen
* `.mobile` - Indicates that we're currently on a mobile device (phones and tablets).
* `.touch` - Indicates that we're currently on touch device.
* `.player-out` - The player is focus out ( I use it to hide the control bar ).
* `.start-state` - The player is on start screen ( before user clicked play ).
* `.load-state` - The player is in loading state ( on startup, change media ).
* `.play-state` - The player is playing.
* `.pause-state` - The player was paused.
* `.end-state` - The player is on end screen ( video completed )
* `.adplay-state` - The player is currently playing an ad.
* `.disabled` - The current component is "disabled" i.e the click or touch binding for this button is not active. 
* `.size-tiny` – less than 300px
* `.size-small` – less than 450px
* `.size-medium` – less than 700px
* `.size-large` – more than 700px

### Examples using CSS States

Consider we have this on-screen redBox element:

* The HTML object:

```html
<div class="redBox"></div>
```

* The CSS definition:

```css
.redBox {
    width: 100px;
    height: 100px;
    background-color: red;
}
```

#### Hiding redBox when mouse cursor over the player 

To the CSS definitions add:

```css
.player-out .redBox { display: none; }
```

As default, have your UI visible, and when it should be hidden use the `.player-out` class to hide the redBox element.

#### Increase redBox size if player enters fullscreen 

```css
.fullscreen .redBox { width: 300px; height: 300px; }
``` 

#### Change redBox bg color to green when video is paused

```css
.pause-state .redBox { background-color: green; }
```

#### CSS Animations Between Player States

You can also make use of CSS animations to transition between player states.   
For example, to transition the redBox box size transformation when entering fullscreen state:

```css
.redBox { transition: width 0.3s ease-in-out, height 0.3s ease-in-out;}
.fullscreen .redBox { width: 300px; height: 300px; }
```

## Managing external assets

External assets such as tmpl.html, CSS, JS, images and font files can be used by the player. When directing the player to load these assets, make sure to consider the following:  

1. Host the external files on a dedicated server, preferably a CDN for best performance, and ensure your server has [CORS headers](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing) enabling loading assets from other domains
2. Make sure you set the correct relative links or full paths in your Flashvars settings
3. Ensure that your assets could be loaded from both http and https, and when directing the player to load the assets, use protocol agnostic URL notation (`://` instead of `http://`). Also ensure that your server has a valid SSL certificate.
4. If you need to load more than one icon, consider using an icon font
5. If you need to load more than one image, use [CSS sprite sheets](https://css-tricks.com/css-sprites/)
