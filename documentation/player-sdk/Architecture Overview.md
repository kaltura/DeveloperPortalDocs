# Architecture Overview

The Kaltura player architecture design to allow seamless expirence between mutltiple playback engines and platforms.  
The kaltura player wrap the playback engine with the same interface and events and by that allow the same plugin code to work across multiple platofrms including iOS,Android and web.  
Each platform support different types of streaming capabilites and DRM and the player will choose the best streaming technologie and DRM if needed.  
Plugins can be with or without UI and can work cross platforms, Some plugins need native support such as chromecast,DRM and Ads.
The player-sdk provide this features out of the box.  
The Player expose API for all platform, we expose basic API and common. If you're an iOS developer and you already work with AVFoundation you should expect the same API + Kaltura player API.  
The player API support sending notificaition to the player, listen to events and evaulates properties.  
Each player config will include the UICONF object which include the player configuration - which plugins should we load.  
Every componenet of the player is a plugin.  

### Kaltura Player v2 Toolkit Architecture Diagram

The following diagram visualizes the architecture of Kaltura Player , and highlights its flexibility and robustness across platforms and devices: 

![](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram outlines, we can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with the HTML5 runtime and Adobe flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Player v2 Toolkit experience. 

### Why Native?
What advantages are gained by going native? Here is a feature list that will help explain the advantages of Kaltura Player Toolkit in native environments:

              | iOS WebView              | iOS Native |Android WebView | Android Native |
------------- | -----------------        | ---------- | -------------- | ---------------|
CSS skin      | Not supported on iPhone  | Supported  | Supported | Supported
JS Plugins    | Supported                | Supported  | Supported | Supported
Apple HLS Playback[AES]| Supported            | Supported  | Broken support across fragmented | Supported
MPEG-Dash     |Unsupported|Supported via partners software players| Supported, with consistent experience across android versions | Supported
AutoPlay     | Not supported  | Supported  | Not supported  | Supported
Chromecast     | Not supported  | Supported  | supported  | Supported
DRM     | Not supported  | Supported  | Not supported  | Supported
Ads     | Supported without dual buffer | Supported  | Supported without dual buffer   | Supported


## Version managment
In order to use the player-sdk you'll need 2 main version - one for the player-sdk and one for the html5 lib.
The html5 lib is configured in the UICONF object and the best practice here is to use the latest version. you can alwayes upgrade using the player studio.  
As for the SDK - use the latest tag of the SDK.




