---
layout: page
title: Customizing the Kaltura Player's Look-and-Feel and Behavior
weight: 404 
---

The Kaltura Player look-and-feel is derived from the Player's skin, which consists of CSS classes and graphical assets such as icons and fonts; and from its Javascript code, which is used to define user interactions and UI behaviour.   

You can customize the Player look-and-feel in a number of ways. A lot of customization can be done using the Player plugins, Player properties, and templating mechanism. More advanced customization can be achieved using custom CSS loading, external assets, and skin overrides. Custom Javascript code can also be used in order to change the UI behavior.  

This article covers these customization topics - from the simplest options to the more advanced and complex ones.

## Player and Plugin Properties  

You can set Player properties to change the Player behavior; for example, setting the 'EmbedPlayer.HidePosterOnStart' property to 'true' will change the behavior of the Player, so that instead of showing the poster image (the default thumbnail set on the entry) on start, the video's first frame will be shown instead.

Many plugins have properties that affect the Player look-and-feel. For example, the controlBarContainer plugin has an "hover" property that defines hovering controls:   

```javascript
'flashvars':{
    'controlBarContainer': {
        'plugin': true,
        'hover': true
    }
}
```

## Predefined Skin Selection  

The Kaltura Player has two available skins: 

* The "kdark" default skin 
* The "ott", which is a custom skin for OTT products.   

You can choose to use either of these skins or, if you create your own custom skin, select it the same way:  

```javascript
'flashvars': {
    'layout':{
        'skin':'ott'
    }
}
```

> Note: The OTT skin is available only for basic configuration Players. It does not support all of the Kaltura Player plugins.
 
## The "Theme" Plugin  

The "theme" plugin allows setting colors and sizes for all of the Player's buttons and basic UI elements, such as the scrubber, icons etc.  
You can access the theme plugin properties using Studio as explained below. 
You can also use the embed code Flashvars object in order to set a theme plugin properties for a specific Player instance.  
It is highly advised to use the theme plugin, instead of writing your own custom CSS file, to prevent redundant assets loading and to boost Player performances.  

## Plugin Templates

Some of the Player plugins use templates to render its content. You can change this template easily using the plugin properties.  
You can load external templets to override the default template, which changes both the look-and-feel and the data displayed. This is achieved by overriding the path to the template tmpl.html file of the specific plugin. 

For example, to override the template of the shared plugin, create your own tmpl.html file (based on the default template path), and in the Flashvars, pass this parameter:

```javascript
'flashvars': {
    'share':{
        'templatePath':'https://link-to-my-custom-template.com/templatefile.tmpl.html'
    }
}
```

Or, via UIVars in the Player Studio, pass the following:

```
share.templatePath=https://link-to-my-custom-template.com/templatefile.tmpl.html
```

> Note: When creating and loading external resources such as template files, please review the "Managing External Assets" section below for additional information.

### Plugins that Support Templates  

The following plugins support the Player templates:

| Plugin       | Flashvar     | Default template path     |
|:---|:---|:---|
| Share             | templatePath            |  [share/share.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/share/share.tmpl.html) |
| infoScreen	| templatePath	| [info/info.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/info/info.tmpl.html) |
| related	| templatePath	| [related/related.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/related/related.tmpl.html) |
| playlistAPI	| templatePath	| [playlist/playList.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/playlist/playList.tmpl.html) | 
| chapters	| templatePath	| [chapters/chapters.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/chapters/chapters.tmpl.html) |
| actionForm	| templatePath	| [CallToAction/templates/collect-form.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/CallToAction/templates/collect-form.tmpl.html) |
| actionButtons	 | templatePath	 | [CallToAction/templates/action-buttons.tmpl.html](https://github.com/kaltura/mwEmbed/blob/master/modules/CallToAction/templates/action-buttons.tmpl.html) |

> See the article [Playlist with custom template and paging](http://player.kaltura.com/modules/KalturaSupport/tests/PlaylistPagingTemplate.html) for a rich example of using custom template to customize the playlist plugin UI and behavior.

## Curly-brackets Data Binding  

Templates work by substituting data bindings against the current Player instance data values. Almost all of the plugin configuration options and data parameters that are displayed on the Player UI are exposed as bindable parameters.   

The following example shows how to display the entry view count on the Player's title bar next to the entry name:  

```
"{mediaProxy.entry.name} has {mediaProxy.entry.views|numberWithCommasNumber} views". 
```

> The default value of the title bar text is `"{mediaProxy.entry.name}"`.

The result is a Player where the title bar shows a message like this "My Video Name has 10,000,000 views" (instead of "My Video Name").

### Formatters  

The pipe+commands ("|numberWithCommasNumber") used after the binded parameter name are called "formatters", and they provide a means of formatting the dates, time, numbers and strings easily according to a known algorithm, or by specifying your custom javascript functions.

The default formaters include:

* `timeFormat`: Takes the time in seconds and returns it in a hh:mm:ss format
* `dateFormat`: Takes a time stamp and returns it in a javascript toString format
* `numberWithCommas`: Takes a number and returns a number with comas

In addition, you can also create and add your own [custom formatters](http://player.kaltura.com/modules/KalturaSupport/tests/CustomFormaters.qunit.html).

## External CSS Assets  

Many Player plugins use private CSS files that target the plugin UI and screens. These plugins include the playlist, chapters, share, and many more. These CSS files can be overridden by defining the `iframeHTML5Css` property in the plugin configuration and setting it to an external CSS file overriding the internal CSS class names.   

> Note: When creating and loading external resources such as template file, remember to review the "Managing External Assets" section below for additional information.

### Common Plugins and their Default CSS Files  

The following is a list of common plugins and their default css files:

| Plugin | Default CSS file
|:---|:---|
| Share	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/share/share.css |
| infoScreen	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/info/info.css |
| related	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/related/related.css |
| playlistAPI	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/playlist/playList.css |
| chapters	| https://github.com/kaltura/mwEmbed/blob/master/modules/KalturaSupport/components/chapters/chapters.css |

> See the article [Playlist with custom template and paging](http://player.kaltura.com/modules/KalturaSupport/tests/PlaylistPagingTemplate.html) for a rich example of using custom template to customize the playlist plugin UI and behavior.


## Core Player Skin External CSS Overrides  

Another customization option is to load an external CSS file that overrides the Player core CSS classes.  

1. In order to override the class names defined in the core CSS files, create your external custom CSS file with the **same** class names you wish to override, and then load it using the `IframeCustomPluginCss1` Flashvar.  
2. You can define more than one custom CSS files and name the Flashvars accordingly: `IframeCustomPluginCss1`, `IframeCustomPluginCss2`,  `IframeCustomPluginCss3`, etc.
3. In order to verify that your class definitions override the core definitions, always add the `!important` rule to your CSS definitions.   

> Note: You can reference external assets in your CSS files, such as images and fonts, by using either relative or full paths to these assets.    

> We recommend embedding small assets (such as icons) as base64 inside the CSS file to improve loading time.

### Core Player Skins CSS Files  

The following is a list of core Player skin CSS files:
| Skin name | Core CSS file |
|:---|:---|
| kdark	| https://github.com/kaltura/mwEmbed/blob/master/skins/kdark/css/layout.css |
| ott | 	https://github.com/kaltura/mwEmbed/blob/master/skins/ott/css/layout.css |

> See the article [Kaltura Player External Skin Overrides Recipe](https://developer.kaltura.com/recipes/player_external_skin_overrides/)
for a rich example of using custom CSS and external resources.

## Custom Interactivity with Javascript  

You can add your own Javascript code, which will be loaded and run within the Player iframe, by setting the `IframeCustomPluginJs1` Flashvar to point to your custom JS files. This allows you to register for Player events or to add custom interactivity to the Player without creating a full Player plugin.   

> See the article [External Resources Recipe](http://player.kaltura.com/modules/KalturaSupport/tests/ExternalResources.qunit.html) for a rich example of using external Javascript resources.


## Player States CSS  

CSS states are CSS classes that are added to the outermost interface element in given Player state. These are very useful for  building the desired look-and-feel quickly for a given Player state, without involving a lot of complicated javascript bindings.   

* `.fullscreen` - The Player in fullscreen
* `.mobile` - Indicates that the end user is currently on a mobile device (phones and tablets)
* `.touch` - Indicates that the end user is currently on a touch device
* `.player-out` - The focus is on the out screenz (can be used to to hide the control bar)
* `.start-state` - The focus is on the start screen (before the end user clicked Play)
* `.load-state` - The focus is on the loading state (on startup, change media)
* `.play-state` - The Player is currently playing
* `.pause-state` - The Player was paused.
* `.end-state` - The focus is on the end screen (the video completed)
* `.adplay-state` - The Player is currently playing an ad
* `.disabled` - The current component is "disabled", i.e., the click or touch binding for this button is not active. 
* `.size-tiny` – Less than 300px
* `.size-small` – Less than 450px
* `.size-medium` – Less than 700px
* `.size-large` – More than 700px

### Examples using CSS States  

Consider that the following redBox elements are on-screen:

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

#### Hiding RedBox when the Mouse Cursor Goes Over  

Add the following to the CSS definitions:

```css
.player-out .redBox { display: none; }
```

As a default, set your UI to be visible, and when it should be hidden, use the `.player-out` class to hide the redBox element.

#### Increase RedBox Size if the Player Enters Fullscreen  

```css
.fullscreen .redBox { width: 300px; height: 300px; }
``` 

#### Change RedBox BG Color to Green when Video is Paused  

```css
.pause-state .redBox { background-color: green; }
```

#### CSS Animations Between Player States  

You can also make use of CSS animations to transition between Player states. For example, to transition the redBox box size transformation when entering a fullscreen state:

```css
.redBox { transition: width 0.3s ease-in-out, height 0.3s ease-in-out;}
.fullscreen .redBox { width: 300px; height: 300px; }
```

## Managing External Assets  

External assets, such as tmpl.html, CSS, JS, images, and font files, can all be used by the Player. When directing the Player to load these assets, make sure to consider the following:  

1. Host the external files on a dedicated server, preferably a CDN, for best performance, and verify that your server has [CORS headers](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing) that enable loading assets from other domains.
2. Make sure you set the correct relative links or full paths in your Flashvars settings.
3. Verify that your assets can be loaded from both http and https, and when directing the Player to load the assets, use protocol agnostic URL notation (`://` instead of `http://`). Also verify that your server has a valid SSL certificate.
4. If you need to load more than one icon, consider using an icon font.
5. If you need to load more than one image, use [CSS sprite sheets](https://css-tricks.com/css-sprites).
