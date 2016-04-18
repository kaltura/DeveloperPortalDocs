---
layout: page
title: Player Plugins in the SDK - Supported plugins, using plugins in the SDK, considerations
---

In this document we'll define the supported player plugins on the player-sdk.

All plugins can be included using the player studio, edit the uiconf object or changing the configuration in the config object.

---

| Plugin  | Desciption | iOS  | Android |
|:------------- |:------------- |:---------------:| :-------------:|
| controlBarContainer | The controls container, can change the hover mode of this plugin      | V |         V |
| titleLabel    | Show the title at the top        |    V |         V |
| logo |        |               V |         V |
| loadingSpinner |        |               V |         V |
| closedCaptions | Out of band caption        |               V |         V |
| watermark |        |               V |         V |
| theme | Custom style for the player - Supported only for the web theme, Mobile is TBD       |               V |         V |
| infoScreen |        |               V |         V |
| share |  The share use native capabilites for social networks - TODO:Add link to doc      |               V |         V |
| youbora |  analytics plugin - add link      |               V |         V |
| DoubleClick | Ads - Full native support      |               V |         V |
| multiDrm | in order to enable DRM you'll need to enable this plugin       |               V |         V |
| Strings |  in order to overwrite player strings      |               V |         V |
| chromecast |  by default this plugin is enable     |               V |         V |
| airPlay |  by default this plugin is enable     |               V |         X |
| pipBtn | picture in picture -  by default this plugin is enable and will work on supported devices   |               V |         X |


