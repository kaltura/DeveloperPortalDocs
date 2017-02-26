---
layout: page
---

## Supported DRM Schemes  

The following DRM schemes are supported in iOS devices:

### FairPlay  

* Supported in iOS versions 8 and up
* Offline playback is supported in iOS 10 and up
  * Our interim solution for iOS 8 and 9 is Widevine Classic -- see below.

### Widevine Classic  

* Supported in iOS 8 and up
* Online and offline playback

<details><summary>**Get Started with Widevine Classic**</summary><p>
## Get Started

> Note: **Before you begin please make sure you have an access to [Widevine Private Repo](https://github.com/kaltura/playkit-ios-widevine)** 

To get integrated with Widevine Classic please follow below steps:

1 . Open you project's **Podfile** and add below reference on top:

```ruby
source 'https://github.com/kaltura/playkit-ios-widevine.git'
source 'https://github.com/CocoaPods/Specs.git'
```
2 . Add Widevine Classic Plugin on your Podfile:

> Note: Please make sure to add WidevineClassic plugin as written below

```ruby
 pod 'PlayKit/WidevineClassic', :git => 'https://github.com/kaltura/playkit-ios.git', :tag => 'widevine/{latest_wvm_release}'
```

3 . On your terminal run `pod update`

## Offline Widveine Playback

To get Widevine Offline playback refer to [Offline Playback](https://vpaas.kaltura.com/documentation/Mobile-Video-Player-SDKs/v3_iOS_Offline.html)

## Demo

For full sample (Wdievine Playback + Offline) refer to [Local Assets Sample](https://github.com/kaltura/playkit-ios-samples/tree/master/PlayKitApp/LocalAssetsSample)

</p></details>

## Known Limitations  
* DRM does not work on the iOS Simulator
* Widevine Classic:
  * Requires ATS to be disabled for 127.0.0.1
  * Requires Bitcode to be disabled (the core library does not support Bitcode)

</br>

## Have Questions or Need Help?

Check out the [Kaltura Player SDK Forum](https://forum.kaltura.org/c/playkit) page for different ways of getting in touch.
