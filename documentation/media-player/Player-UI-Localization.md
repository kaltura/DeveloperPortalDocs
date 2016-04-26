---
layout: page
title: Kaltura Player UI Localization
---

The Kaltura Player supports localization for most languages, by specifying the language-corresponding locale key.   
For a *full listing of supported locale keys* look here. Setting a locale key translates all UI labels, messages and tooltips to the required language.  

> **NOTE:** Not all locales are supported in all of the player UI components. While the basic UI is fully supported, some plugins might not have all local translations available.

## Setting the Desired Player Locale

By default, all Players fall back to English unless the locale is defined otherwise.  

You can define the required locale using the Flashvar `localizationCode`. This can be set in the Player Studio UIVars section or on the page using embed Flashvars.

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
   
You can also have the Player set the locale automatically according to the locale provided by the web browser. This locale will be the same locale defined in the end user's operating system.   

To have the locale set automatically by setting `localizationCode` to `auto`, using one of the following options:

* Browser-based automatic locale via Player Studio UIVars:

```
localizationCode=auto
```

* Browser-based automatic locale via embed Flashvars:

```javascript
'flashvars': { 
    'localizationCode':'auto' 
}
```

## Custom Localized Strings

You can add missing strings or change existing strings for any locale using the `strings` plugin.   
The strings plugin defines keys and values for all Player labels and tooltips. 

> [Review the complete list of available strings keys and default English values](http://player.kaltura.com/modules/KalturaSupport/tests/StringsLocale.html).  

{% extlink Review the complete list of available strings keys and default English values http://player.kaltura.com/modules/KalturaSupport/tests/StringsLocale.html %}

To override existing key values or define values for keys that are currently not available in your locale, configure the strings plugin either in the Player Studio under the Strings section or in your embed code Flashvars.

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
