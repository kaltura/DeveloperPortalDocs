# Architecture Overview

The Kaltura Player v2 Toolkit, aka Player v2, greatly simplifies the configuration and skinning of Kaltura players vs. previous versions. 

### Kaltura Player v2 Toolkit Architecture Diagram

The following diagram visualizes the architecture of Kaltura Player v2 Toolkit, and highlights its flexibility and robustness across platforms and devices: 

![](https://knowledge.kaltura.com/sites/default/files/styles/large/public/kaltura-player-toolkit.png)

As the diagram outlines, we can leverage native components for [iOS](https://github.com/kaltura/player-sdk-native-ios/) and [Android](https://github.com/kaltura/player-sdk-native-android) in conjunction with the HTML5 runtime and Adobe flash or Microsoft Silverlight plugins, to transcend platform limitations across devices and browsers, while delivering the full Player v2 Toolkit experience. 

### Why Native?
What advantages are gained by going native? Here is a feature list that will help explain the advantages of Kaltura Player Toolkit in native environments:

              | iOS WebView              | iOS Native |Android WebView | Android Native |
------------- | -----------------        | ---------- | -------------- | ---------------|
css skin      | Not supported on iPhone  | Supported  | Supported |
JS Plugins    | Supported                | Supported  | Supported |
Apple HLS Playback| Supported            | Supported  | Broken support across fragmented | platform
MPEG-Dash     |Unsupported, dependent on Apple|Supported via partners software players| Supported, with consistent experience across android versions |