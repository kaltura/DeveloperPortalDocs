---
layout: page
title: Kaltura Player UI Localization
---

The Kaltura player supports localization for most languages by specifying the language corresponding locale key.   
For a full listing of supported locale keys, look here. Setting a local key translates all UI labels, messages and tooltips to the required language.  

> **NOTE:** Not all locales support all of the player UI components. While the basic UI is fully supported, some plugins might not have all the local translations available.

## Setting the desired player locale
By default, all players fallback to English unless the locale is defined otherwise.  

You can define the required locale using the Flashvar: `localizationCode`. This can be set in the Player Studio UIVars section or on the page using embed Flashvars.

For example: 

* Setting the locale to German via Player Studio UIVars:
```
localizationCode=de
```
* Setting the locale to German ("de") via embed Flashvars:
```javascript
'flashvars': { 
    'localizationCode':'de' 
}
```
   
You can also have the player set the locale automatically according to the locale provided by the web browser. This locale will be the same locale defined in the user's operating system.   

To have the locale set automatically, set `localizationCode` to `auto`:   

* Browser based automatic locale via Player Studio UIVars:
```
localizationCode=auto
```
* Browser based automatic locale via embed Flashvars:
```javascript
'flashvars': { 
    'localizationCode':'auto' 
}
```

## Custom localized strings
You can add missing strings or change existing strings for any locale using the `strings` plugin.   
The strings plugin defines keys and values for all player labels and tooltips. 

> [Review the complete list of available strings keys and default English values](http://player.kaltura.com/modules/KalturaSupport/tests/StringsLocale.html).  

To override existing key values or define values for keys that are currently not available in your locale, you can configure the strings plugin either in Studio under the Strings section or in your embed code Flashvars.

* Custom localized strings via Player Studio **Strings** (each line is a UIVar key=value pair):
```
mwe-embedplayer-play_clip=Click%20to%20play
es.mwe-embedplayer-play_clip=Reproducir%20clip
```

> **Note:** When using the Strings section in the Player Studio, you only need to specify the language code for languages other than English.

* Custom localized strings via embed Flashvars:
```javascript
'flashvars': { 
    "strings":{ 
        "en":{ 
            "mwe-embedplayer-play_clip": "Click to play", 
		}, 
        "es":{ 
            "mwe-embedplayer-play_clip": "Reproducir clip", 
        } 
    } 
}
```
