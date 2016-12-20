# Architecture Overview

The Kaltura player architecture design to allow seamless expirence between mutltiple playback engines and platforms.  The Kaltura player wrap the playback engine with the same interface and events and by that allow the same plugin code to work across multiple platofrms including iOS,Android and web. 

Each platform support different types of streaming capabilites and DRM and the Player will choose the best streaming technologie and DRM if needed.  

Plugins can be with or without UI and can work cross platforms; some plugins require native support, such as Chromecast, DRM and Ads.
The Player-SDK provides this features out-of-the-box.

The Player exposes APIs for all platforms, exposing both basic and common APIs. If you are an iOS developer and you already work with AVFoundation, you should expect the same API plus the Kaltura Player API. 

The Player API supports sending notifications to the Player, listening to events, and evaulating properties. Each Player configuration will include the **UICONF** object, which includes the Player configuration and which plugin(s) should be loaded.

**Note:** Every component of the Player is a plugin.  

### Kaltura Player v2 Toolkit Architecture Diagram

The following diagram visualizes the architecture of the Kaltura Player, and highlights its flexibility and robustness across platforms and devices: 

![Kaltura Player Diagram](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram outlines, we can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with the HTML5 runtime and Adobe flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Player v2 Toolkit experience. 

### Why Native?
What advantages are gained by going native? Here is a feature list that will help explain the advantages of the Kaltura Player Toolkit in native environments:

              | iOS WebView              | iOS Native |Android WebView | Android Native |
------------- | -----------------        | ---------- | -------------- | ---------------|
CSS skin      | Not supported on iPhone  | Supported  | Supported | Supported
JS Plugins    | Supported                | Supported  | Supported | Supported
Apple HLS Playback[AES]| Supported            | Supported  | Broken support across fragmented | Supported
MPEG-Dash     |Not supported|Supported via partners software players| Supported, with consistent experience across Android versions | Supported
AutoPlay     | Not supported  | Supported  | Not supported  | Supported
Chromecast     | Not supported  | Supported  | supported  | Supported
DRM     | Not supported  | Supported  | Not supported  | Supported
Ads     | Supported without dual buffer | Supported  | Supported without dual buffer   | Supported


## Version managment
In order to use the Player-SDK, you will need two main versions - one for the Player-SDK and one for the html5 lib.
* The html5 lib is configured in the UICONF object and the best practice here is to use the latest version (you can alwayes upgrade using the Player studio). 
* For the SDK, always use the latest tag of the SDK.




